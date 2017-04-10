<?php $this->load->view('include/header.php'); ?>

<section id="container" >
<?php $this->load->view('include/navbar.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        <?php echo lang('dashboard'); ?>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                      <div class="row">
                          <div class="col-sm-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                    <?php echo lang('website_per_languages'); ?>
                                  <span class="tools pull-right">
                                      <a href="javascript:;" class="fa fa-chevron-down"></a>
                                      <a href="javascript:;" class="fa fa-cog"></a>
                                      <a href="javascript:;" class="fa fa-times"></a>
                                   </span>
                                  </header>
                                  <div class="panel-body">
                                      <div class="chartJS">
                                          <canvas id="pie-chart-language" height="250" width="800" ></canvas>
                                      </div>
                                  </div>
                              </section>
                          </div>
                          <div class="col-sm-6">
                              <section class="panel">
                                  <header class="panel-heading">
                                    <?php echo lang('website_per_categories'); ?>
                                  <span class="tools pull-right">
                                      <a href="javascript:;" class="fa fa-chevron-down"></a>
                                      <a href="javascript:;" class="fa fa-cog"></a>
                                      <a href="javascript:;" class="fa fa-times"></a>
                                   </span>
                                  </header>
                                  <div class="panel-body">
                                      <div class="chartJS">
                                          <canvas id="pie-chart-category" height="250" width="800" ></canvas>
                                      </div>
                                  </div>
                              </section>
                          </div>
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
<script type="text/javascript">
  var pieDataLanguage = JSON.parse('<?php echo $chart_language; ?>');
  var pieDataCategory = JSON.parse('<?php echo $chart_category; ?>');
</script>
<?php $this->load->view('include/footer.php'); ?>