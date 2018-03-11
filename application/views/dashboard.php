<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('dashboard'); ?></h2>
    </div>
    <div class="page-content">
      <section id="main-content" >
          <section class="wrapper">

          <div class="row">
              <div class="col-sm-12">
                  <section class="card mb-3">
                      <header class="card-header">
                          <?php echo lang('dashboard'); ?>
                          <span class="tools pull-right">
                              <a href="javascript:;" class="fa fa-chevron-down"></a>
                              <a href="javascript:;" class="fa fa-cog"></a>
                              <a href="javascript:;" class="fa fa-times"></a>
                           </span>
                      </header>
                      <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <section class="card mb-3">
                                    <header class="card-header">
                                      <h4><?php echo lang('website_per_languages'); ?></h4>
                                    <span class="tools pull-right">
                                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                                        <a href="javascript:;" class="fa fa-cog"></a>
                                        <a href="javascript:;" class="fa fa-times"></a>
                                     </span>
                                    </header>
                                    <div class="card-body">
                                        <div class="chartJS">
                                            <canvas id="pie-chart-language" height="250" width="800" ></canvas>
                                        </div>
                                    </div>
                                </section>
                            </div>
                            <div class="col-sm-6">
                                <section class="card mb-3">
                                    <header class="card-header">
                                      <h4><?php echo lang('website_per_categories'); ?></h4>
                                    <span class="tools pull-right">
                                        <a href="javascript:;" class="fa fa-chevron-down"></a>
                                        <a href="javascript:;" class="fa fa-cog"></a>
                                        <a href="javascript:;" class="fa fa-times"></a>
                                     </span>
                                    </header>
                                    <div class="card-body">
                                        <div class="chartJS">
                                            <canvas id="pie-chart-category" height="250" width="800" ></canvas>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="adv-table editable-table ">
                                <div class="clearfix">
                                    <div class="btn-group">
                                        <h4><?php echo lang('website_a_renew'); ?></h4>
                                    </div>

                                </div>
                                <div class="space15"></div>
                                <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-dashboard">
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
                                      <?php foreach ($all_whois_renew_tomonth->result() as $row) { ?>
                                        <tr>
                                          <td><?php echo $row->name_website; ?></td>
                                          <td><?php echo '<a href="https://www.google.com/search?q=info:'.strip_tags($row->url_website).'" target="_blank">'.strip_tags($row->url_website).'</a>'; ?></td>
                                          <td><?php echo $row->registrar; ?></td>
                                          <td><?php echo $row->creation_date; ?></td>
                                          <td><?php echo $row->expiration_date; ?></td>
                                          <td><?php echo '<a class="access-whois" href="javascript:void(0);" data-toggle="modal" data-target="#view-whois" data-id="'.$row->whois_id.'">Whois</a>'; ?></td>
                                        </tr>
                                      <?php } ?>
                                    </tbody>
                              </table>
                            </div>
                          </div>
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
<script type="text/javascript">
  var pieDataLanguage = JSON.parse('<?php echo $chart_language; ?>');
  var pieDataCategory = JSON.parse('<?php echo $chart_category; ?>');
</script>
<?php $this->load->view('include/footer.php'); ?>