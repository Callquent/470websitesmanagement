<?php $this->load->view('include/header.php'); ?>

<section id="container" >
<?php $this->load->view('include/navbar.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

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
                        <input type="text" class="form-control" name="website" id="autocomplete" placeholder="Search Member" >
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
                                </div>
                            </div>
                        </div>
                        <div class="adv-table editable-table">
                            <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-tasks">
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
                                      <td><?php echo $row->title_project_tasks; ?></td>
                                      <td><?php echo $row->started_project_tasks; ?></td>
                                      <td><?php echo $row->deadline_project_tasks; ?></td>
                                      <td>
                                        <div class="progress progress-striped active progress-sm"><?php echo $row->percentage_tasks; ?>%
                                          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $row->percentage_tasks; ?>%"></div>
                                        </div>
                                      </td>
                                      <td><span class="badge badge-danger">Canceled</span></td>
                                      <td>
                                        <div class="dropdown show actions">
                                          <a class="btn btn-secondary dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-bars"></i>
                                          </a>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            <a class="dropdown-item" id="view-project" href="<?php echo site_url('my-tasks/'.$row->id_project_tasks); ?>"><i class="fa fa-eye"></i> View</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" id="edit-project" href="'.site_url('my-tasks/'.$row->id_project_tasks).'"><i class="fa fa-pencil"></i> Edit</a>
                                            <a class="dropdown-item" id="delete-project" href="'.site_url('my-tasks/delete-website/'.$row->w_id).'"><i class="fa fa-trash"></i> Delete</a>
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
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
</section>
<?php $this->load->view('include/footer.php'); ?>