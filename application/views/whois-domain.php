<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('whois_domain'); ?></h2>
    </div>
    <div class="page-content">
      <section id="main-content">
          <section class="wrapper">

          <div class="row">
              <div class="col-sm-12">
                  <section class="card mb-3">
                      <header class="card-header">
                        <span class="tools pull-right">


                              <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  <?php echo lang('type'); ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" id="button-whois-calendar" href="javascript:;"><?php echo lang('calendar'); ?></a>
                                  <a class="dropdown-item" id="button-whois-list" href="javascript:;"><?php echo lang('list'); ?></a>
                                </div>
                              </div>

                            <div class="btn-group pull-right">
                              <a href="javascript:;" id="load-refresh-whois" class="btn btn-primary" role="button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading ...">Refresh</a>
                            </div>
                           </span>
                      </header>
                      <div class="card-body">
                          <div class="adv-table editable-table ">
                              <div class="clearfix">
                                  <div class="btn-group">
                                      <h4><?php echo lang('domain_name_included'); ?> : .com, .net, .ca, .org, .za, .uk, .ie, .paris, .ovh, .fr, .re, .pf, .nc, .it, .pt, .se, .fi, .ru, .cn, .jp, .dk, .pl, .cz</h4>
                                  </div>

                              </div>
                              <div class="space15"></div>
                              <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-whois">
                                  <thead>
                                    <tr>
                                        <th class="all">Nom</th>
                                        <th class="desktop">Site Web</th>
                                        <th class="desktop">Hebergeur</th>
                                        <th class="desktop">Date de mise en ligne</th>
                                        <th class="desktop">Date d'expiration</th>
                                        <th class="desktop">Whois</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                  </tbody>
                              </table>
                          </div>

                          <div class="row whois-calendar">
                              <aside class="col-lg-12">
                                    <div id="calendar" class="has-toolbar"></div>
                              </aside>
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
      <div class="modal fade" id="view-whois" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Afficher Whois</h4>
            </div>
            <div class="modal-body">
              <form id="acces-ftp" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-hover table-bordered table-dashboard" id="table-ftp-dashboard">
                      <thead>
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
<?php $this->load->view('include/footer.php'); ?>