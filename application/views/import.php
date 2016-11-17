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
                        Import
                    </header>
                    <div class="panel-body">
                        <div class="position-center">

			                        <form class="form-horizontal" id="form-import" method="post" action="<?php echo site_url('/import/import-470websitesmanagement/'); ?>" enctype="multipart/form-data">
			                            <div class="form-group">
                                            <label class="col-sm-3 control-label col-lg-3">Clé secrète :</label>
                                            <div class="col-lg-6">
			                                    <input type="text" class="form-control" name="keysecrete" id="keysecrete" placeholder="cle secrete">
			                                </div>
			                            </div>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-lg-3">Charger votre fichier .470</label>
                                            <div class="col-lg-6">
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
			                                    <button type="submit" class="btn btn-danger">Import</button>
			                                </div>
			                            </div>
			                        </form>
                                    <div id="results">
                                        <div class="alert alert-success alert-block fade in"><h4><i class="icon-ok-sign"></i>L'exportation a bien été effectué !</h4></div>
                                        <div class="alert alert-danger alert-block fade in"><h4><i class="icon-ok-sign"></i>Votre fichier ou votre clé n'est pas valide.</h4></div>
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