<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('languages'); ?></h2>
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
                                <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-language">
                                  <thead>
                                    <tr>
                                        <th>Langage</th>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <th>Modifier</th>
                                          <th>Supprimer</th>
                                        <?php } ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($all_languages->result() as $row) { ?>
                                      <tr>
                                        <td><?php echo $row->title_language; ?></td>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <td><a id="edit-dashboard" href="<?php echo site_url('language/edit-language/'.$row->id_language); ?>">Edit</a></td>
                                          <td><a id="delete-dashboard" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete-language" data-id="<?php echo $row->id_language; ?>">Delete</a></td>
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
<div class="modal fade" id="modal-delete-language" tabindex="-1" role="dialog" aria-labelledby="modal-delete-language" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete Language</h4>
      </div>
      <form id="form-language" method="post" action="#">
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
        var nEditingLanguage = null;
        var ElementDelete = null;
        var languageTable = $('#table-language').dataTable({
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
      function editRowLanguage(languageTable, nRow, nUrl) {
          var aData = languageTable.fnGetData(nRow);
          var jqTds = $('>td', nRow);
          var languageList;
          jqTds[0].innerHTML = '<input type="text" class="form-control small" id="titlelanguage" value="' + aData[0] + '">';
          jqTds[1].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'">Save</a>';
          jqTds[2].innerHTML = '<a id="cancel-dashboard" href="javascript:void(0);">Cancel</a>';
      }
      function saveRowLanguage(languageTable, nRow, nUrl) {
          var jqInputs = $('input', nRow);
          languageTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
          languageTable.fnUpdate('<a id="edit-dashboard" href="'+nUrl+'">Edit</a>', nRow, 1, false);
          languageTable.fnUpdate('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>', nRow, 2, false);
          languageTable.fnDraw();
      }
      function restoreRow(pTable, nRow) {
          var aData = pTable.fnGetData(nRow);
          var jqTds = $('>td', nRow);

          for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
              pTable.fnUpdate(aData[i], nRow, i, false);
          }

          pTable.fnDraw();
      }
        
    $('#modal-delete-language').on('show.bs.modal',function(event) {
      var modal = $(this);
      var id = $(event.relatedTarget).data('id');

      $('#form-language').attr("action",window.location.href+'/delete-language/'+id);
      $.getJSON( window.location.href+'/loadLanguages/', function( data ) {
        languageList = '<select id="language" name="language" class="form-control">';
        $.each( data, function( key, val ) {
          if ( id != val.id_language ) {
            languageList += '<option value="'+val.id_language+'">'+ val.l_title + '</option>';
          }
        });
        languageList += '</select>';
        $( "#modal-delete-language .modal-body" ).append( languageList );
      });
    });
    $('#modal-delete-language').on('hidden.bs.modal',function(event) {
      $('#language').remove();
    });
    $('#form-language').submit(function(e) {
            $.ajax({
                type: "POST",
                url:  $(this).attr('action'),
                data: $(this).serialize(),
                success: function(msg){
                  $('#modal-delete-language').modal('hide');
                    var nRow = $(ElementDelete).parents('tr')[0];
                    languageTable.fnDeleteRow(nRow);
                },
                error: function(msg){
                    console.log(msg);
                }
            });
            e.preventDefault();
    });
        $(document).on('click', '#table-language #cancel-dashboard', function (e) {
            e.preventDefault();
            if ($(this).attr("data-mode") == "new") {
                var nRow = $(this).parents('tr')[0];
                languageTable.fnDeleteRow(nRow);
            } else {
                restoreRow(languageTable, nEditingLanguage);
                nEditingLanguage = null;
            }
        });
        $(document).on('click', '#table-language #edit-dashboard', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var nUrl = $(this).attr('href');
            
            if (nEditingLanguage !== null && nEditingLanguage != nRow) {
                restoreRow(languageTable, nEditingLanguage);
                editRowLanguage(languageTable, nRow, nUrl);
                nEditingLanguage = nRow;
            } else if (nEditingLanguage == nRow && this.innerHTML == "Save") {
                var titlelanguage = $('#titlelanguage').val();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    data: 'titlelanguage='+titlelanguage,
                    success: function(msg){
                        console.log(msg);
                        saveRowLanguage(languageTable, nEditingLanguage, nUrl);
                        nEditingLanguage = null;
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            } else {
                editRowLanguage(languageTable, nRow, nUrl);
                nEditingLanguage = nRow;
            }
        });
        $(document).on('click', '#table-language #delete-dashboard', function (e) {
            ElementDelete = this;
        });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>