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
                    <div class="row-fluid" id="draggable_portlets">
                        <div class="col-md-3 column sortable ui-sortable">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-default">
                                        <div class="card-header">
                                            Project Details
                                        </div>
                                        <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h1 class="no-margin"><?php echo $project->title_project_tasks; ?></h5>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="no-margin"><?php echo lang('time_spent'); ?></h5>
                                                            </div>
                                                            
                                                            <div class="col-md-6 text-right">
                                                                <h5 class="no-margin"><?php echo $datetimestart; ?> <?php echo lang('days'); ?></h5>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="no-margin m-t-5"><?php echo lang('remaining_time'); ?></h5>
                                                            </div>
                                                            
                                                            <div class="col-md-6 text-right">
                                                                <h5 class="no-margin m-t-5"><?php echo $datetimedeadline; ?> <?php echo lang('days'); ?></h5>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12 m-t-5">
                                                                <h6 class="no-margin m-b-10">Taches réalisées : <?php echo $percentage_project->percentage; ?>%</h6>
                                                                <div class="progress m-t-5 m-b-10">
                                                                    <div class="progress-bar progress-bar-success progress-bar-striped active" style="width:<?php echo $percentage_project->percentage; ?>%">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h6 class="no-margin m-b-10">Assigned to</h6>
                                                                <img src="assets/images/faces/face5.png" class="img-rounded img-responsive img-sm" alt="">
                                                                <img src="assets/images/faces/face6.png" class="img-rounded img-responsive img-sm" alt="">
                                                                <img src="assets/images/faces/face7.png" class="img-rounded img-responsive img-sm" alt="">
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h6 class="no-margin">Project details</h6>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-xs-6">
                                                                        <h5>Company</h5>
                                                                        <h5>Client name</h5>
                                                                        <h5>Assignee</h5>
                                                                        <h5>Reported to</h5>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-6 col-xs-6 text-right">
                                                                        <h5>ABC Ltd.</h5>
                                                                        <h5>Client name</h5>
                                                                        <h5>Ann Porter</h5>
                                                                        <h5>John Deo</h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h6 class="no-margin m-b-10">Options</h6>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <div class="checker border-info text-info"><span class="checked"><input type="checkbox" class="control-info" checked="checked"></span></div>
                                                                        Make this project a priority
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <div class="checker border-info text-info"><span class="checked"><input type="checkbox" class="control-info" checked="checked"></span></div>
                                                                        Send project report by email
                                                                    </label>
                                                                </div>
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <div class="checker border-info text-info"><span><input type="checkbox" class="control-info"></span></div>
                                                                        Send all notifications by email
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 column sortable ui-sortable">
                            <!-- BEGIN Portlet PORTLET-->
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
                                        <a class="btn btn-default btn-primary mb-3" href="<?php echo site_url('/all-projects/'); ?>"><span><i class="fa fa-angle-double-left"></i></span> Retour</a>
                                        <a class="access-list-tasks btn btn-sm btn-success mb-3" href="javascript:void(0);" data-toggle="modal" data-target="#view-list-tasks"><span><i class="fa fa-plus"></i></span> Ajouter une Liste</a>
                                    </div>
                                </div>
                            </div>
                            <div class="adv-table editable-table">
                                <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-tasks">
                                    <thead>
                                      <tr>
                                          <th class="all"><?php echo lang('name'); ?></th>
                                          <th class="desktop">Description</th>
                                          <th class="desktop">Priority</th>
                                          <th class="desktop">Status</th>
                                          <th class="desktop">Member</th>
                                          <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                            <th class="desktop"><?php echo lang('actions'); ?></th>
                                          <?php } ?>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php foreach ($all_list_tasks->result() as $row_list_tasks) { ?>
                                        <tr>
                                            <td colspan="6"><?php echo $row_list_tasks->title_list_task; ?> <a class="access-list-tasks btn btn-sm btn-success mb-3" href="javascript:void(0);" data-toggle="modal" data-target="#view-task"  data-id="<?php echo $row_list_tasks->id_list_tasks; ?> "><i class="fa fa-plus"></i> Ajouter une tache</a></td>
                                        </tr>
                                         <?php foreach ($row_list_tasks->tasks as $row) { ?>
                                            <tr>
                                                <?php if ($row->id_list_tasks==$row_list_tasks->id_list_tasks) { ?>
                                                    <td><?php echo $row->name_task; ?></td>
                                                    <td><?php echo $row->description_task; ?></td>
                                                    <td><?php echo $row->name_tasks_priority; ?></td>
                                                    <td><?php echo $row->name_tasks_status; ?></td>
                                                    <td><?php echo $row->username; ?></td>
                                                    <td>
                                                        <div class="dropdown show actions">
                                                          <a class="btn btn-secondary dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-bars"></i>
                                                          </a>
                                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                            <a class="dropdown-item" id="edit-dashboard" href="<?php echo site_url('language/edit-language/'.$row->id_task); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                                            <a class="dropdown-item" id="delete-dashboard" href="<?php echo site_url('language/edit-language/'.$row->id_task); ?>"><i class="fa fa-trash"></i> Delete</a>
                                                          </div>
                                                        </div>
                                                    </td>
                                                <?php } ?>
                                            </tr>
                                        <?php } ?>
                                      <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>


                        </div>
                    </div>
                </div>
            </div>
            </section>
        </section>
    </div>
  </div>
</div>
<div class="modal fade" id="view-list-tasks" tabindex="-1" role="dialog" aria-labelledby="view-list-tasks" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter une liste de tâches</h4>
      </div>
        <form id="form-list-tasks" method="post" action="<?php echo site_url('/all-projects/create-list-tasks/'.$id_project_tasks); ?>">
          <div class="modal-body">
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                <div class="col-lg-12">
                  <input class="form-control" type="text" name="titlelisttasks" placeholder="Titre Liste Tasks" required />
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
<div class="modal fade" id="view-task" tabindex="-1" role="dialog" aria-labelledby="view-task" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter une tâche</h4>
      </div>
        <form id="form-task" method="post" action="<?php echo site_url('/all-projects/create-task/'.$id_project_tasks); ?>">
          <div class="modal-body">
            <div class="form-group">
                <input type="hidden" class="form-control" id="idlisttasks" name="idlisttasks">
            </div>
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                <div class="col-lg-12">
                  <input class="titlelisttasks form-control" type="text" name="titletask" placeholder="Titre Task" required />
                </div>
            </div>
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                <div class="col-lg-12">
                  <textarea class="titlelisttasks form-control" type="text" name="descriptiontask" placeholder="Description Task" required></textarea>
                </div>
            </div>
            <div class="form-group ">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('languages'); ?></label>
                <div class="col-lg-6">
                  <select name="tasksstatus" class="form-control">
                  <?php foreach ($all_tasks_status->result() as $row){  ?>
                      <option value="<?php echo $row->id_tasks_status; ?>"><?php echo $row->name_tasks_status; ?></option>
                  <?php } ?>
                  </select>
                </div>
            </div>
            <div class="form-group ">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('languages'); ?></label>
                <div class="col-lg-6">
                  <select name="taskspriority" class="form-control">
                  <?php foreach ($all_tasks_priority->result() as $row){  ?>
                      <option value="<?php echo $row->id_tasks_priority; ?>"><?php echo $row->name_tasks_priority; ?></option>
                  <?php } ?>
                  </select>
                </div>
            </div>
            <div class="form-group ">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('languages'); ?></label>
                <div class="col-lg-6">
                  <select name="user" class="form-control">
                  <?php foreach ($list_users->result() as $row){  ?>
                      <option value="<?php echo $row->id; ?>"><?php echo $row->name_user; ?></option>
                  <?php } ?>
                  </select>
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
<?php $this->load->view('include/footer.php'); ?>
