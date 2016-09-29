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
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            Tree Style #2
                        </div>
                        <div class="panel-body">
                            <ul class="tree tree-folder-select" role="tree" id="myTree">
                              <li class="tree-branch hide" data-template="treebranch" role="treeitem" aria-expanded="false">
                                <div class="tree-branch-header">
                                  <button type="button" class="glyphicon icon-caret glyphicon-play"><span class="sr-only">Open</span></button>
                                  <button type="button" class="tree-branch-name">
                                    <span class="glyphicon icon-folder glyphicon-folder-close"></span>
                                    <span class="tree-label"></span>
                                  </button>
                                </div>
                                <ul class="tree-branch-children" role="group"></ul>
                                <div class="tree-loader" role="alert">Loading...</div>
                              </li>
                              <li class="tree-item hide" data-template="treeitem" role="treeitem">
                                <button type="button" class="tree-item-name">
                                  <span class="glyphicon icon-item fueluxicon-bullet"></span>
                                  <span class="tree-label"></span>
                                </button>
                              </li>
                            </ul>
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