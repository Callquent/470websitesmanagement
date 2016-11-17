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
                        Export
                    </header>
                    <div class="panel-body">
                        <div class="position-center">

			                        <form class="form-horizontal" id="form-export" method="post" action="<?php echo site_url('/export/export-470websitesmanagement/'); ?>">
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label col-lg-3">Clé secrète :</label>
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
                                            <label class="col-sm-3 control-label">Choix le type d'exportation :</label>

                                            <div class="col-sm-9 icheck minimal">
                                                <div class="radio single-row">
                                                    <input tabindex="3" type="radio" name="demo-radio" id="radio_quick_export" checked>
                                                    <label>Tous les sites web</label>
                                                </div>

                                                <div class="radio single-row">
                                                    <input tabindex="3" type="radio" name="demo-radio" id="radio_custom_export">
                                                    <label>Selectionnez vos sites web</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group export-search-table last">
                                            <label class="control-label col-md-3">Listes Sites Web :</label>
                                            <div class="col-md-9">
                                                <select name="websites[]" class="multi-select" multiple="" id="my_multi_select3" >
                                                    <?php foreach ($all_websites->result() as $row) {  ?>
                                                        <option value="<?php echo $row->w_id; ?>"><?php echo $row->w_url_rw; ?></option>
                                                    <?php } ?>
                                                </select>
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
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
</section>
<?php $this->load->view('include/footer.php'); ?>