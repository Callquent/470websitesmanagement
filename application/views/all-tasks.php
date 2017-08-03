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
                <a href="http://localhost:8080/470websitesmanagement/index.php/add-website" class="btn btn-success"><i class="fa fa-plus-circle"></i> Ajouter une tache</a>
                <section class="panel">
                    <header class="panel-heading">
                        Editable Table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <h4 class="">Projects</h4>
                        <hr>
                    </div>
                </section>
                <section class="panel">
                    <header class="panel-heading">
                        Editable Table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <h4 class="">Membres</h4>
                        <hr>
                          <?php foreach($list_users->result() as $row){ ?>
                          <div>
                            <img alt="" src="http://localhost:8080/470websitesmanagement/assets/img/users/Sauron_eye_barad_dur.jpg" width="32px" height="32px">
                            <span class="username"><?php echo $row->name_user; ?></span>
                          </div>
                          <?php } ?>
                          
                    </div>
                </section>
                <section class="panel">
                    <header class="panel-heading">
                        Editable Table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <h4 class="">Status</h4>
                        <hr>
                    </div>
                </section>
            </div>
            <div class="col-sm-10">
                <section class="panel">
                    <header class="panel-heading">
                        Editable Table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <h4><?php echo lang('number_websites_management'); ?><?php echo $all_domains; ?> <?php echo lang('domains'); ?> <?php echo $all_subdomains; ?> <?php echo lang('sub_domains'); ?></h4>
                                </div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-dashboard">
                                <thead>
                                  <tr>
                                      <th class="all"><?php echo lang('name'); ?></th>
                                      <th class="desktop">Started on</th>
                                      <th class="desktop">Deadline</th>
                                      <th class="desktop">Status</th>
                                      <th class="desktop">Progress</th>
                                      <th class="desktop">Member</th>
                                      <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                        <th class="desktop"><?php echo lang('edit'); ?></th>
                                        <th class="desktop"><?php echo lang('delete'); ?></th>
                                      <?php } ?>
                                  </tr>
                                </thead>
                                <tbody>

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
<?php $this->load->view('include/footer.php'); ?>