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
                            <div class="adv-table editable-table ">
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <h4>Gestion du parc : <?php echo $all_domains; ?> Domaines et <?php echo $all_subdomains; ?> Sous-domaines</h4>
                                    </div>
                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-hover table-bordered table-dashboard" id="table-dashboard">
                                    <thead>
                                      <tr>
                                          <th>Nom</th>
                                          <th>Site Web</th>
                                          <th>Adresse IP</th>
                                          <th>Mots Clés</th>
                                          <th>Statistiques</th>
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
    </div>
  </div>
</div>
<?php $this->load->view('include/footer.php'); ?>