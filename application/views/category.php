<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('categories'); ?></h2>
    </div>
    <div class="page-content">
      <section id="main-content">
          <section class="wrapper">

          <div class="row">
              <div class="col-sm-12">
                  <section class="card mb-3">
                      <header class="card-header">
                          Editable Table
                          <span class="tools pull-right">
                              <a href="javascript:;" class="fa fa-chevron-down"></a>
                              <a href="javascript:;" class="fa fa-cog"></a>
                              <a href="javascript:;" class="fa fa-times"></a>
                           </span>
                      </header>
                      <div class="card-body">
                          <div class="adv-table editable-table ">
                              <div class="clearfix">
                                  <div class="btn-group pull-right">
                                      <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                      </button>
                                      <ul class="dropdown-menu pull-right">
                                          <li><a href="#">Print</a></li>
                                          <li><a href="#">Save as PDF</a></li>
                                          <li><a href="#">Export to Excel</a></li>
                                      </ul>
                                  </div>
                              </div>
                                <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-category">
                                  <thead>
                                    <tr>
                                        <th>Catégorie</th>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <th>Modifier</th>
                                          <th>Supprimer</th>
                                        <?php } ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($all_categories->result() as $row) { ?>
                                      <tr>
                                        <td><?php echo $row->title_category; ?></td>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <td><a id="edit-dashboard" href="<?php echo site_url('category/edit-category/'.$row->c_id); ?>">Edit</a></td>
                                          <td><a id="delete-dashboard" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete-category" data-id="<?php echo $row->c_id; ?>">Delete</a></td>
                                        <?php } ?>
                                      </tr>
                                    <?php } ?>
                                  </tbody>
                                </table>
                          </div>
                      </div>
                  </section>
              </div>
          </div>
          </section>
      </section>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-delete-category" tabindex="-1" role="dialog" aria-labelledby="modal-delete-category" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete Category</h4>
      </div>
      <form id="form-category" method="post" action="#">
        <div class="modal-body">
        </div>
        <div class="modal-footer ">
          <button type="submit" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-share"></span> Envoyer</button>
          <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    var nEditingCategory = null;
    var ElementDelete = null;
        var categoryTable = $('#table-category').dataTable({
      "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ]
        });
        function restoreRow(pTable, nRow) {
            var aData = pTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                pTable.fnUpdate(aData[i], nRow, i, false);
            }

            pTable.fnDraw();
        }
    function editRowCategory(categoryTable, nRow, nUrl) {
            var aData = categoryTable.fnGetData(nRow);
            var jqTds = $('>td', nRow);
            var categoryList;
            jqTds[0].innerHTML = '<input type="text" class="form-control small" id="titlecategory" value="' + aData[0] + '">';
            jqTds[1].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'">Save</a>';
            jqTds[2].innerHTML = '<a id="cancel-dashboard" href="javascript:void(0);">Cancel</a>';
        }
        function saveRowCategory(categoryTable, nRow, nUrl) {
            var jqInputs = $('input', nRow);
            categoryTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
            categoryTable.fnUpdate('<a id="edit-dashboard" href="'+nUrl+'">Edit</a>', nRow, 1, false);
            categoryTable.fnUpdate('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>', nRow, 2, false);
            categoryTable.fnDraw();
        }

    $('#modal-delete-category').on('show.bs.modal',function(event) {
      if (confirm('Voulez vous supprimer cette enregistrement')) {
        var modal = $(this);
        var id = $(event.relatedTarget).data('id');

        $('#form-category').attr("action",window.location.href+'/delete-category/'+id);
        $.getJSON( window.location.href+'/loadCategories/', function( data ) {
          categoryList = '<select id="category" name="category" class="form-control">';
          $.each( data, function( key, val ) {
            if ( id != val.c_id ) {
              categoryList += '<option value="'+val.c_id+'">'+ val.c_title + '</option>';
            }
          });
          categoryList += '</select>';
          $( "#modal-delete-category .modal-body" ).append( categoryList );
        });
            }
    });
    $('#modal-delete-category').on('hidden.bs.modal',function(event) {
      $('#category').remove();
    });
    $('#form-category').submit(function(e) {
            $.ajax({
                type: "POST",
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                success: function(msg){
                  $('#modal-delete-category').modal('hide');
                    var nRow = $(ElementDelete).parents('tr')[0];
                    categoryTable.fnDeleteRow(nRow);
                },
                error: function(msg){
                    console.log(msg);
                }
            });
            e.preventDefault();
    });
        $(document).on('click', '#table-category #cancel-dashboard', function (e) {
            e.preventDefault();
            if ($(this).attr("data-mode") == "new") {
                var nRow = $(this).parents('tr')[0];
                categoryTable.fnDeleteRow(nRow);
            } else {
                restoreRow(categoryTable, nEditingCategory);
                nEditingCategory = null;
            }
        });
        $(document).on('click', '#table-category #edit-dashboard', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var nUrl = $(this).attr('href');
            
            if (nEditingCategory !== null && nEditingCategory != nRow) {
                restoreRow(categoryTable, nEditingCategory);
                editRowCategory(categoryTable, nRow, nUrl);
                nEditingCategory = nRow;
            } else if (nEditingCategory == nRow && this.innerHTML == "Save") {
                var titlecategory = $('#titlecategory').val();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    data: 'titlecategory='+titlecategory,
                    success: function(msg){
                        console.log(msg);
                        saveRowCategory(categoryTable, nEditingCategory, nUrl);
                        nEditingCategory = null;
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            } else {
                editRowCategory(categoryTable, nRow, nUrl);
                nEditingCategory = nRow;
            }
        });
        $(document).on('click', '#table-category #delete-dashboard', function (e) {
            ElementDelete = this;
        });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>