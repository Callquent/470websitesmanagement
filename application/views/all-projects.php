<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-content">
      
      <section id="main-content">
          <section class="wrapper">

          <div class="row">
              <div class="col-sm-2">
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
                          <h4 class="">Projects</h4>
                          <hr>
                          <input type="text" class="form-control" name="searchproject" id="searchProjects" >
                      </div>
                  </section>
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
                          <h4 class="">Membres</h4>
                          <hr>
                          <input type="text" class="form-control" name="search" id="searchMembers" >
                      </div>
                  </section>
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
                          <h4 class="">Status</h4>
                          <hr>
                      </div>
                  </section>
              </div>
              <div class="col-sm-10">
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
                          <div class="row">
                              <div class="col-sm-12 float-right">
                                  <div class="float-right">
                                      <a class="access-project btn btn-sm btn-success mb-3" href="javascript:void(0);" data-toggle="modal" data-target="#create-project"><span><i class="fa fa-plus"></i></span> Ajouter un Projet</a>
                                  </div>
                              </div>
                          </div>
                          <div class="adv-table editable-table">
                              <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-projects">
                                  <thead>
                                    <tr>
                                        <th class="all"><?php echo lang('website'); ?></th>
                                        <th class="desktop"><?php echo lang('name'); ?></th>
                                        <th class="desktop">Started on</th>
                                        <th class="desktop">Deadline</th>
                                        <th class="desktop">Status</th>
                                        <th class="desktop">Progress</th>
                                        <th class="desktop">Member</th>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <th class="desktop"><?php echo lang('actions'); ?></th>
                                        <?php } ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($all_projects->result() as $row) { ?>
                                      <tr>
                                        <td><?php echo $row->name_website; ?></td>
                                        <td><?php echo $row->name_project_tasks; ?></td>
                                        <td><?php echo $row->started_project_tasks; ?></td>
                                        <td><?php echo $row->deadline_project_tasks; ?></td>
                                        <td><span class="badge badge-danger">Canceled</span></td>
                                        <td>
                                          <div class="progress progress-striped active progress-sm"><?php echo $row->percentage_tasks; ?>%
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row->percentage_tasks; ?>%"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <?php foreach ($row->users_to_project as $row_user) { ?>
                                            <span class="w-40 avatar circle green" value="<?php echo $row_user->username; ?>"><?php echo substr($row_user->username, 0, 2); ?></span>
                                          <?php } ?>
                                        </td>
                                        <td>
                                          <div class="dropdown show actions">
                                            <a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
                                              <i class="fa fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                              <a class="dropdown-item" id="view-project" href="<?php echo site_url('all-projects/'.$row->id_project_tasks); ?>"><i class="fa fa-eye"></i> View</a>
                                              <div class="dropdown-divider"></div>
                                              <a class="dropdown-item" id="edit-project" href="<?php echo site_url('all-projects/edit_projects/'.$row->id_project_tasks); ?>"><i class="fa fa-pencil"></i>  <?php echo lang('edit') ?></a>
                                              <a class="dropdown-item" id="delete-project" href="'.site_url('all-projects/delete-website/'.$row->w_id).'"><i class="fa fa-trash"></i> Delete</a>
                                            </div>
                                          </div>
                                        </td>
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
<div class="modal fade" id="create-project" tabindex="-1" role="dialog" aria-labelledby="create-project" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter un projet</h4>
      </div>
            <form id="form-projects" method="post" action="<?php echo site_url('/all-projects/create-projects/'); ?>">
              <div class="modal-body">
                <div class="form-group">
                    <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                    <div class="col-lg-12">
                      <select name="websites" class="form-control">
                      <?php foreach ($all_websites->result() as $row){  ?>
                          <option value="<?php echo $row->w_id; ?>"><?php echo $row->name_website; ?></option>
                      <?php } ?>
                      </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                    <div class="col-lg-12">
                      <input class="form-control" type="text" name="titleproject" placeholder="Titre Projet" required />
                    </div>
                </div>
                <div class="form-group">
                      <label class="control-label">Date Range</label>
                      <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                          <input type="text" class="form-control dpd1" type="date" name="datestarted">
                          <span class="input-group-addon">To</span>
                          <input type="text" class="form-control dpd2" type="date" name="datedeadline">
                      </div>
                </div>
              </div>
              <div class="modal-footer ">
                <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-share"></span><?php echo lang('save'); ?></button>
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><?php echo lang('cancel'); ?></button>
              </div>
            </form>
    </div>
  </div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    $("#form-projects").submit(function(e){
      $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(msg){
          $('#create-project').modal('hide');
        },
        error: function(msg){
          console.log(msg.responseText);
        }
      });
      e.preventDefault();
    });

    var nEditingProject = null;
    var ElementDelete = null;
    var projectsTable = $('#table-projects').DataTable({
      "columnDefs": [{
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
    function editRowProjects(projectsTable, nRow, nUrl) {
      var aData = projectsTable.fnGetData(nRow);
      var jqTds = $('>td', nRow);
      var languageList;
      jqTds[1].innerHTML = '<input type="text" class="form-control small" id="nameproject" value="' + aData[1] + '">';
      jqTds[2].innerHTML = '<input type="text" class="form-control small" id="startedproject" value="' + aData[2] + '">';
      jqTds[3].innerHTML = '<input type="text" class="form-control small" id="deadlineproject" value="' + aData[3] + '">';
      jqTds[7].innerHTML = '<a id="edit-project" href="'+nUrl+'" class="btn btn-white"><i class="fa fa-check" value="check"></i></a><a id="cancel-project" href="" class="btn btn-white"><i class="fa fa-close"></i></a>';
    }
    function saveRowProjects(projectsTable, nRow, nUrl) {
      var jqInputs = $('input', nRow);
      projectsTable.fnUpdate(jqInputs[0].value, nRow, 1, false);
      projectsTable.fnUpdate(jqInputs[1].value, nRow, 2, false);
      projectsTable.fnUpdate(jqInputs[2].value, nRow, 3, false);
      projectsTable.fnUpdate('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-project" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>', nRow, 7, false);
      projectsTable.fnDraw();
    }
    function restoreRow(pTable, nRow) {
      var aData = pTable.fnGetData(nRow);
      var jqTds = $('>td', nRow);

      for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
          pTable.fnUpdate(aData[i], nRow, i, false);
      }

      pTable.fnDraw();
    }
    $(document).on('click', '#table-projects #cancel-project', function (e) {
        e.preventDefault();
        if ($(this).attr("data-mode") == "new") {
            var nRow = $(this).parents('tr')[0];
            projectsTable.fnDeleteRow(nRow);
        } else {
            restoreRow(projectsTable, nEditingProject);
            nEditingProject = null;
        }
    });
    $(document).on('click', '#table-projects #edit-project', function (e) {
        e.preventDefault();

        var nRow = $(this).parents('tr')[0];
        var nUrl = $(this).attr('href');
        
        if (nEditingProject !== null && nEditingProject != nRow) {
            restoreRow(projectsTable, nEditingProject);
            editRowProjects(projectsTable, nRow, nUrl);
            nEditingProject = nRow;
        } else if (nEditingProject == nRow && $(this).find("i").attr("value") == "check") {
            var nameproject = $('#nameproject').val();
            var startedproject = $('#startedproject').val();
            var deadlineproject = $('#deadlineproject').val();
            $.ajax({
                type: "POST",
                url: $(this).attr('href'),
                data: {'nameproject':nameproject,'startedproject':startedproject,'deadlineproject':deadlineproject},
                success: function(msg){
                    console.log(msg);
                    saveRowProjects(projectsTable, nEditingProject, nUrl);
                    nEditingProject = null;
                },
                error: function(msg){
                    console.log(msg);
                }
            });
        } else {
            editRowProjects(projectsTable, nRow, nUrl);
            nEditingProject = nRow;
        }
    });
    $(document).on('click', '#table-projects #delete-project', function (e) {
        ElementDelete = this;
    });

    $('#searchProjects').on( 'keyup', function () {
        projectsTable.columns(1).search( this.value ).draw();
    });
    $('#searchMembers').on( 'keyup', function () {
        projectsTable.columns(6).search( this.value ).draw();
    });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>