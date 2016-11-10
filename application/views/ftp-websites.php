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




                            <div class="container">
                                <div class="panel panel-default">
                                    <div class="panel-heading">Treeview List</div>
                                    <div class="panel-body">
                                        <!-- TREEVIEW CODE -->
                                        <ul class="treeview">
                                            <li><a href="#">Tree</a>
                                                <ul>
                                                    <li><a href="#">Branch</a></li>
                                                    <li><a href="#">Branch</a>
                                                        <ul>
                                                            <li><a href="#">Stick</a></li>
                                                            <li><a href="#">Stick</a></li>
                                                            <li><a href="#">Stick</a>
                                                                <ul>
                                                                    <li><a href="#">Twig</a></li>
                                                                    <li><a href="#">Twig</a></li>
                                                                    <li><a href="#">Twig</a></li>
                                                                    <li><a href="#">Twig</a>
                                                                        <ul>
                                                                            <li><a href="#">Leaf</a></li>
                                                                            <li><a href="#">Leaf</a></li>
                                                                            <li><a href="#">Leaf</a></li>
                                                                            <li><a href="#">Leaf</a></li>
                                                                            <li><a href="#">Leaf</a></li>
                                                                            <li><a href="#">Leaf</a></li>
                                                                            <li><a href="#">Leaf</a></li>
                                                                            <li><a href="#">Leaf</a></li>
                                                                            <li><a href="#">Leaf</a></li>
                                                                        </ul>
                                                                    </li>
                                                                    <li><a href="#">Twig</a></li>
                                                                    <li><a href="#">Twig</a></li>
                                                                </ul>
                                                            </li>
                                                            <li><a href="#">Stick</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Branch</a></li>
                                                    <li><a href="#">Branch</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <!-- TREEVIEW CODE -->
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