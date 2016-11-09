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
			                        <form class="form-horizontal" id="form-import" method="post" action="<?php echo site_url('/import/import-470websitesmanagement/'); ?>" enctype="multipart/form-data">
			                            <div class="form-group">
                                            <label class="control-label col-md-3">Clé secrète</label>
                                            <div class="controls col-md-9">
			                                    <input type="text" class="form-control" name="keysecrete" id="keysecrete" placeholder="cle secrete">
			                                </div>
			                            </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Charger votre fichier .470</label>
                                            <div class="controls col-md-9">
                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                            <span class="btn btn-white btn-file">
                                                                <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select file</span>
                                                                <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                                <input type="file" name="importfile" class="default" />
                                                            </span>
                                                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                </div>
                                            </div>
                                        </div>
			                            <div class="form-group">
			                                <div class="col-lg-offset-2 col-lg-10">
			                                    <button type="submit" class="btn btn-danger">Sign in</button>
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