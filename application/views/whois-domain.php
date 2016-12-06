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
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <h4>Nom de Domaine inclus : .com, .net, .org, .uk, .ie, .paris, .ovh, .fr, .it, .se, .fi, .ru, .cn, .jp, .dk, .pl</h4>
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
                    </div>
                </section>
            </div>
        </div>
        </section>
    </section>
</section>
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