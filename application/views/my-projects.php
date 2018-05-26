<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('websites_management'); ?></h2>
    </div>
    <div class="page-content">
      <section id="main-content">
          <section class="wrapper">

          <div class="row">
            <div class="col-12 col-sm-6 col-xl-3 p-3">
              <div class="widget widget2 card">
                  <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                      <div class="col">
                          <span class="h6">Critical</span>
                      </div>
                      <button type="button" class="btn btn-icon fuse-ripple-ready">
                          <i class="icon icon-dots-vertical"></i>
                      </button>
                  </div>

                  <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                      <div class="title text-danger"><?php echo $all_tasks_priority_to_user->all_tasks_critical_user; ?></div>
                      <div class="sub-title h6 text-muted">TASKS</div>
                  </div>

                  <div class="widget-footer p-4 bg-light row no-gutters align-items-center">
                      <span class="text-muted">Yesterday's:</span>
                      <span class="ml-2">2</span>
                  </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 p-3">
              <div class="widget widget2 card">
                  <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                      <div class="col">
                          <span class="h6">Hight</span>
                      </div>
                      <button type="button" class="btn btn-icon fuse-ripple-ready">
                          <i class="icon icon-dots-vertical"></i>
                      </button>
                  </div>

                  <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                      <div class="title text-warning"><?php echo $all_tasks_priority_to_user->all_tasks_hight_user; ?></div>
                      <div class="sub-title h6 text-muted">TASKS</div>
                  </div>

                  <div class="widget-footer p-4 bg-light row no-gutters align-items-center">
                      <span class="text-muted">Yesterday's:</span>
                      <span class="ml-2">2</span>
                  </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 p-3">
              <div class="widget widget2 card">
                  <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                      <div class="col">
                          <span class="h6">Medium</span>
                      </div>
                      <button type="button" class="btn btn-icon fuse-ripple-ready">
                          <i class="icon icon-dots-vertical"></i>
                      </button>
                  </div>

                  <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                      <div class="title text-primary"><?php echo $all_tasks_priority_to_user->all_tasks_medium_user; ?></div>
                      <div class="sub-title h6 text-muted">TASKS</div>
                  </div>

                  <div class="widget-footer p-4 bg-light row no-gutters align-items-center">
                      <span class="text-muted">Yesterday's:</span>
                      <span class="ml-2">2</span>
                  </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3 p-3">
              <div class="widget widget2 card">
                  <div class="widget-header pl-4 pr-2 row no-gutters align-items-center justify-content-between">
                      <div class="col">
                          <span class="h6">Low</span>
                      </div>
                      <button type="button" class="btn btn-icon fuse-ripple-ready">
                          <i class="icon icon-dots-vertical"></i>
                      </button>
                  </div>

                  <div class="widget-content pt-2 pb-8 d-flex flex-column align-items-center justify-content-center">
                      <div class="title text-info"><?php echo $all_tasks_priority_to_user->all_tasks_low_user; ?></div>
                      <div class="sub-title h6 text-muted">TASKS</div>
                  </div>

                  <div class="widget-footer p-4 bg-light row no-gutters align-items-center">
                      <span class="text-muted">Yesterday's:</span>
                      <span class="ml-2">2</span>
                  </div>
              </div>
            </div>
          </div>
          <div class="row">
              <div class="col-sm-2">
                  <section class="card mb-3">
                      <header class="card-header">
                          Editable Table
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
                                  </div>
                              </div>
                          </div>
                          <div class="adv-table editable-table">
                              <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-my-projects">
                                  <thead>
                                    <tr>
                                        <th class="all"><?php echo lang('website'); ?></th>
                                        <th class="desktop"><?php echo lang('name'); ?></th>
                                        <th class="desktop">Started on</th>
                                        <th class="desktop">Deadline</th>
                                        <th class="desktop">Progress</th>
                                        <th class="desktop">Status</th>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <th class="desktop"><?php echo lang('actions'); ?></th>
                                        <?php } ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($all_projects_per_users->result() as $row) { ?>
                                      <tr>
                                        <td><?php echo $row->name_website; ?></td>
                                        <td><?php echo $row->name_project_tasks; ?></td>
                                        <td><?php echo $row->started_project_tasks; ?></td>
                                        <td><?php echo $row->deadline_project_tasks; ?></td>
                                        <td>
                                          <div class="progress progress-striped active progress-sm"><?php echo $row->percentage_tasks; ?>%
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row->percentage_tasks; ?>%"></div>
                                          </div>
                                        </td>
                                        <td>
                                          <span class="badge badge-danger"><?php echo $row->priority_project_tasks->all_tasks_critical_user; ?> Critical</span><span class="badge badge-warning"><?php echo $row->priority_project_tasks->all_tasks_hight_user; ?> Hight</span><span class="badge badge-primary"><?php echo $row->priority_project_tasks->all_tasks_medium_user; ?> Medium</span><span class="badge badge-success"><?php echo $row->priority_project_tasks->all_tasks_low_user; ?> Low</span>
                                        </td>
                                        <td>
                                          <div class="dropdown show actions">
                                              <a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
                                                <i class="icon icon-dots-vertical"></i>
                                              </a>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" id="view-project" href="<?php echo site_url('my-tasks/'.$row->id_project_tasks); ?>"><i class="fa fa-eye"></i> View</a>
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
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    var myprojectsTable = $('#table-my-projects').DataTable({
              'columnDefs': [{ // set default column settings
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

    $('#searchProjects').on( 'keyup', function () {
        myprojectsTable.columns(1).search( this.value ).draw();
    });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>