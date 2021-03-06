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
                <div class="col-lg-12">
                    <section class="card mb-3">
                        <header class="card-header">
                            Ajouter un langage
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="card-body">
                            <div class=" form">
                                <form class="form-horizontal " id="form-add-language" method="post" action="<?php echo site_url('/add-language/submit'); ?>">
                                  <div class="row-fluid">
                                    <h4 class=""><?php echo lang('general_information'); ?></h4>
                                    <hr>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3"><?php echo lang('name_add_language'); ?></label>
                                        <div class="col-lg-6">
                                          <input class="form-control" type="text" name="language" placeholder="Language" required />
                                        </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-3 col-lg-6">
                                          <button class="btn btn-primary" type="submit"><?php echo lang('save'); ?></button>
                                          <button class="btn btn-default" type="button"><?php echo lang('cancel'); ?></button>
                                      </div>
                                  </div>
                                </form>
                                <div id="results">
                                    <div class="alert alert-success alert-block fade in"><h4><i class="icon-ok-sign"></i><?php echo lang('language_registered'); ?></h4></div>
                                    <div class="alert alert-danger alert-block fade in"><h4><i class="icon-ok-sign"></i><?php echo lang('language_not_registered'); ?></h4></div>
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
<?php $this->load->view('include/footer.php'); ?>