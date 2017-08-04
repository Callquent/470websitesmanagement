<?php $this->load->view('include/header.php'); ?>

<section id="container" >
<?php $this->load->view('include/navbar.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
<!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo lang('websites_management'); ?>
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
                                      <th class="desktop"><?php echo lang('website'); ?></th>
                                      <th class="desktop"><?php echo lang('address_ip'); ?></th>
                                      <th class="desktop"><?php echo lang('categories'); ?></th>
                                      <th class="desktop"><?php echo lang('languages'); ?></th>
                                      <th class="desktop"><?php echo lang('access_ftp'); ?></th>
                                      <th class="desktop"><?php echo lang('access_sql'); ?></th>
                                      <th class="desktop"><?php echo lang('access_backoffice'); ?></th>
                                      <th class="desktop"><?php echo lang('access_htaccess'); ?></th>
                                      <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                        <th class="desktop"><?php echo lang('actions'); ?></th>
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
      <div class="modal fade" id="view-ftp" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Afficher FTP</h4>
            </div>
            <div class="modal-body">
              <form id="acces-ftp" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-ftp-dashboard">
                      <thead>
                        <tr>
                            <th class="all">Hote FTP</th>
                            <th class="all">Login FTP</th>
                            <th class="all">Password FTP</th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop">Modifier</th>
                              <th class="desktop">Supprimer</th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="view-database" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Afficher SQL</h4>
            </div>
            <div class="modal-body">
              <form id="acces-sql" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-database-dashboard">
                      <thead>
                        <tr>
                            <th class="all">Serveur SQL</th>
                            <th class="all">Nom de la base</th>
                            <th class="all">Login SQL</th>
                            <th class="all">Mot de Passe SQL</th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop">Modifier</th>
                              <th class="desktop">Supprimer</th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="view-backoffice" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Afficher le site web</h4>
            </div>
            <div class="modal-body">
              <form id="acces-backoffice" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-backoffice-dashboard">
                      <thead>
                        <tr>
                            <th class="all">Admin Host</th>
                            <th class="all">Admin Login</th>
                            <th class="all">Admin Mot de passe</th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop">Modifier</th>
                              <th class="desktop">Supprimer</th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="view-htaccess" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Afficher le site web</h4>
            </div>
            <div class="modal-body">
              <form id="acces-htaccess" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-htaccess-dashboard">
                      <thead>
                        <tr>
                            <th class="all">Login Htaccess</th>
                            <th class="all">Mot de passe Htaccess</th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop">Modifier</th>
                              <th class="desktop">Supprimer</th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="email" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header modal-header-warning">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Envoyer un email à un client</h4>
            </div>
            <form id="form-email" method="post" action="<?php echo site_url('/all-websites/contact/'); ?>">
              <div class="modal-body">
                <div class="input-group">
                  <input type="hidden" value="" name="id">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="checkbox">
                  <label>
                    <input name="check_bo" type="checkbox"> Acces Backoffice
                  </label>
                  <label>
                    <input name="check_ftp" type="checkbox"> Acces FTP
                  </label>
                  <label>
                    <input name="check_db" type="checkbox"> Acces Base de Donnée
                  </label>
                </div>
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