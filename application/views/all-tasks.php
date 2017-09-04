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
                <a class="access-project btn btn-success mb-3" href="javascript:void(0);" data-toggle="modal" data-target="#view-project" data-id="335"><i class="fa fa-plus-circle"></i> Ajouter un Projet</a>
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
                        <h4 class="">Membres</h4>
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
                        <div class="adv-table editable-table">
                            <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-tasks">
                                <thead>
                                  <tr>
                                      <th class="all"><?php echo lang('name'); ?></th>
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
                                  <?php foreach ($all_tasks->result() as $row) { ?>
                                    <tr>
                                      <td><?php echo $row->c_title; ?></td>
                                      <?php if ($user_role[0]->name == "Developper") { ?>
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
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
</section>

<div class="modal fade" id="view-project" tabindex="-1" role="dialog" aria-labelledby="view-project" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter un projet</h4>
      </div>
            <form id="form-email" method="post" action="<?php echo site_url('/all-websites/contact/'); ?>">
              <div class="modal-body">
                <div class="input-group">
                  <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="input-group">
                      <label class="control-label">Date Range</label>
                      <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                          <input type="text" class="form-control dpd1" name="from">
                          <span class="input-group-addon">To</span>
                          <input type="text" class="form-control dpd2" name="to">
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