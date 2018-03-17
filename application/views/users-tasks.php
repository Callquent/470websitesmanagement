<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
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
                          <div class="row">
                              <div class="col-sm-12 float-right">
                                  <div class="float-right">
                                  </div>
                              </div>
                          </div>
                          <div class="adv-table editable-table">
                              <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-users-tasks">
                                  <thead>
                                    <tr>
                                        <th class="all"><?php echo lang('name'); ?></th>
                                        <th class="desktop">Tasks Progress</th>
                                        <th class="desktop">Tasks Completed</th>
                                        <th class="desktop">All Tasks</th>
                                        <th class="desktop">Email</th>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <th class="desktop"><?php echo lang('actions'); ?></th>
                                        <?php } ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($all_tasks_per_user->result() as $row) { ?>
                                      <tr>
                                        <td><?php echo $row->username; ?></td>
                                        <td><span class="badge badge-warning"><?php echo $row->all_tasks_progress_user; ?></span></td>
                                        <td><span class="badge badge-success"><?php echo $row->all_tasks_completed_user; ?></span></td>
                                        <td><span class="badge badge-info"><?php echo $row->all_tasks_user; ?></span></td>
                                        <td><?php echo $row->email; ?></td>
                                        <td>
                                          <div class="dropdown show actions">
                                              <a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
                                                <i class="fa fa-ellipsis-v"></i>
                                              </a>
                                              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" id="email" href="mailto:<?php echo $row->email; ?>" ><i class="fa fa-envelope"></i> Email</a>
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
      var users_tasksTable = $('#table-users-tasks').dataTable({
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
  });
</script>
<?php $this->load->view('include/footer.php'); ?>