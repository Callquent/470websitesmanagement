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
                        Editable Table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group">
                                    <h4>Nom de Domaine inclus : .com, .net, .org, .uk, .cn, .paris, .ovh, .fr, .it, .ru, .pl</h4>
                                </div>
                                <div class="btn-group pull-right">
                                    <a href="#" id="load-whois" class="btn btn-primary" role="button">Télécharger Whois</a>
                                </div>

                                <div class="progress progress-striped active progress-sm">
                                    <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
                                        <span class="sr-only">45% Complete</span>
                                    </div>
                                </div>

                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-hover table-bordered table-dashboard" id="table-whois">
                                <thead>
                                  <tr>
                                      <th>Nom</th>
                                      <th>Site Web</th>
                                      <th>Hebergeur</th>
                                      <th>Date de mise en ligne</th>
                                      <th>Date d'expiration</th>
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
<?php $this->load->view('include/footer.php'); ?>