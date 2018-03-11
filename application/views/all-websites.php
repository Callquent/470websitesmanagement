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
              <div class="col-sm-12">
                  <section class="card mb-3">
                      <header class="card-header">
                          <?php echo lang('websites_management'); ?>
                          <span class="tools float-right">
                              <a href="javascript:;" class="fa fa-chevron-down"></a>
                              <a href="javascript:;" class="fa fa-cog"></a>
                              <a href="javascript:;" class="fa fa-times"></a>
                           </span>
                      </header>
                      <div class="card-body">
                          <div class="row">
                              <div class="col-sm-12">
                                    <h4><?php echo lang('number_websites_management'); ?><?php echo $all_domains; ?> <?php echo lang('domains'); ?> <?php echo $all_subdomains; ?> <?php echo lang('sub_domains'); ?></h4>
                              </div>
                          </div>
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
                  </section>
              </div>
          </div>
          </section>
      </section>
    </div>
  </div>
</div>
      <div class="modal fade" id="view-ftp" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_ftp'); ?></h4>
            </div>
            <div class="modal-body">
              <form id="acces-ftp" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-ftp-dashboard">
                      <thead>
                        <tr>
                            <th class="all"><?php echo lang('host_ftp'); ?></th>
                            <th class="desktop"><?php echo lang('login_ftp'); ?></th>
                            <th class="desktop"><?php echo lang('password_ftp'); ?></th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop"><?php echo lang('actions'); ?></th>
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
              <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_sql'); ?></h4>
            </div>
            <div class="modal-body">
              <form id="acces-sql" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-database-dashboard">
                      <thead>
                        <tr>
                            <th class="all"><?php echo lang('host_sql'); ?></th>
                            <th class="desktop"><?php echo lang('name_sql'); ?></th>
                            <th class="desktop"><?php echo lang('login_sql'); ?></th>
                            <th class="desktop"><?php echo lang('password_sql'); ?></th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop"><?php echo lang('actions'); ?></th>
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
              <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_backoffice'); ?></h4>
            </div>
            <div class="modal-body">
              <form id="acces-backoffice" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-backoffice-dashboard">
                      <thead>
                        <tr>
                            <th class="all"><?php echo lang('host_backoffice'); ?></th>
                            <th class="desktop"><?php echo lang('login_backoffice'); ?></th>
                            <th class="desktop"><?php echo lang('password_backoffice'); ?></th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop"><?php echo lang('actions'); ?></th>
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
              <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_htaccess'); ?></h4>
            </div>
            <div class="modal-body">
              <form id="acces-htaccess" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-htaccess-dashboard">
                      <thead>
                        <tr>
                            <th class="all"><?php echo lang('login_htaccess'); ?></th>
                            <th class="desktop"><?php echo lang('password_htaccess'); ?></th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop"><?php echo lang('actions'); ?></th>
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