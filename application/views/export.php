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
			                        <form class="form-horizontal" id="form-export" role="form" method="post" action="<?php echo site_url('/export/export-470websitesmanagement/'); ?>">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-lg-3">Clé secrète</label>
                                            <div class="col-lg-6">
                                                <div class="input-group m-bot15">
                                                    <input type="text" name="keysecrete" id="keysecrete" class="form-control" value="<?php echo $key_secrete; ?>">
                                                    <span class="input-group-btn">
                                                        <a href="<?php echo site_url('/export/generate-key/'); ?>" class="btn btn-success">Generate</a>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
			                                <div class="col-lg-offset-2 col-lg-10">
			                                    <button type="submit" class="btn btn-info">Export</button>
			                                </div>
			                            </div>
			                        </form>
                                </div>
                            </div>
                            <div class="space15"></div>
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