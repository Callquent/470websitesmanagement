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
                            <?php var_dump($list); ?>

            <div class="row">

                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            Tree Style #1
                          <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <div id="FlatTree" class="tree tree-plus-minus">
                                <div class = "tree-folder" style="display:none;">
                                    <div class="tree-folder-header">
                                        <i class="fa fa-folder"></i>
                                        <div class="tree-folder-name"></div>
                                    </div>
                                    <div class="tree-folder-content"></div>
                                    <div class="tree-loader" style="display:none"></div>
                                </div>
                                <div class="tree-item" style="display:none;">
                                    <i class="tree-dot"></i>
                                    <div class="tree-item-name"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="panel">
                        <div class="panel-heading">
                            Tree Style #2
                         <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                            </span>
                        </div>
                        <div class="panel-body">
                            <div id="FlatTree2" class="tree">
                                <div class = "tree-folder" style="display:none;">
                                    <div class="tree-folder-header">
                                        <i class="fa fa-folder"></i>
                                        <div class="tree-folder-name"></div>
                                    </div>
                                    <div class="tree-folder-content"></div>
                                    <div class="tree-loader" style="display:none"></div>
                                </div>
                                <div class="tree-item" style="display:none;">
                                    <i class="tree-dot"></i>
                                    <div class="tree-item-name"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
  var tree_data = JSON.parse('<?php echo $tree_data; ?>');
</script>
<?php $this->load->view('include/footer.php'); ?>