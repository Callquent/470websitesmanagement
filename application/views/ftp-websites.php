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
                    <section class="panel">
                        <header class="panel-heading">
                            Ajouter un site web
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">

                        <div class="adv-table editable-table ">
                            <div class="clearfix">
                                <div class="btn-group"></div>
                            </div>
                            <div class="space15"></div>
                            <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" id="table-dashboard">
                                <thead>
                                  <tr>
                                    <th class="desktop"><?php echo lang('name'); ?></th>
                                    <th class="all"><?php echo lang('website'); ?></th>
                                    <th>FTP</th>
                                  </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>





                            <div class="row">
                                <div class="col-md-6">
                                    <div class="portlet red-pink box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Ajax Tree with Drag & Drop </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="tree_4" class="tree-demo"> </div>
                                            <div class="alert alert-info no-margin margin-top-10"> Note! The tree nodes are loaded from ../demo/jstree_ajax_data.php via ajax. </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="portlet yellow-lemon box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Contextual Menu with Drag & Drop </div>
                                            <div class="tools">
                                                <a href="javascript:;" class="collapse"> </a>
                                                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                <a href="javascript:;" class="reload"> </a>
                                                <a href="javascript:;" class="remove"> </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div id="tree_3" class="tree-demo"> </div>
                                            <div class="alert alert-success no-margin margin-top-10"> Note! Opened and selected nodes will be saved in the user's browser, so when returning to the same tree the previous state will be restored. </div>
                                        </div>
                                    </div>
                                </div>
                            </div>




                                <div class="row">
                                    <div class="col-md-6">
                                        <!-- TREEVIEW CODE -->
                                        <ul class="treeview">
                                            <?php foreach ($all_folder_first_level as $row) {  ?>
                                            <li class="tree-branch"><a href="javascript:void(0)" class="<?php echo $row["title"]; ?>"><i class="<?php echo $row["icon"]; ?>"></i> <?php echo $row["title"]; ?></a></li>
                                            <?php } ?>
                                        </ul>
                                        <!-- TREEVIEW CODE -->
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