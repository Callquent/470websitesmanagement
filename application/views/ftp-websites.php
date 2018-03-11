<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-content">

        <section id="main-content">
            <section class="wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <section class="card mb-3">
                            <header class="card-header">
                                Ajouter un site web
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="fa fa-cog" href="javascript:;"></a>
                                    <a class="fa fa-times" href="javascript:;"></a>
                                 </span>
                            </header>
                            <div class="card-body">

                                <div class="adv-table editable-table ">
                                    <div class="clearfix">
                                        <div class="btn-group"></div>
                                    </div>
                                    <div class="space15"></div>
                                    <?php if(empty($all_storage_server)){ ?>
                                        <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-ftpwebsites">
                                            <thead>
                                              <tr>
                                                <th class="all"><?php echo lang('name'); ?></th>
                                                <th class="desktop"><?php echo lang('website'); ?></th>
                                                <th class="desktop">FTP</th>
                                              </tr>
                                            </thead>
                                            <tbody>
                                              <?php foreach ($all_websites->result() as $row) { ?>
                                                <tr>
                                                    <td><?php echo $row->name_website ?></td>
                                                    <td><a href="<?php echo prep_url($row->url_website); ?>" target="_blank"><?php echo $row->url_website; ?></a></td>
                                                    <td><a href="<?php echo site_url('ftp-websites/'.$row->w_id); ?>">Connect FTP</a></td>
                                                </tr>
                                              <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>




                                <?php if(!empty($all_storage_server)){ ?>

                                    <?php if(!empty($all_storage_local)){ ?>
                                    <div class="row">
                                        <div class="col-sm-12 float-right">
                                            <div class="float-right">
                                                <a class="btn btn-default btn-primary mb-3" href="<?php echo site_url('/ftp-websites/'); ?>"><span><i class="fa fa-angle-double-left"></i></span> Retour</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="path-local" value="<?php echo $path_local; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="path-server" value="<?php echo $path_server; ?>">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <ul class="treeviewlocal">
                                                <?php foreach ($all_storage_local as $row) {  ?>
                                                    <li class="tree-branch" id="<?php echo $row["title"]; ?>" >
                                                        <a href="javascript:void(0)"><i class="<?php echo $row["icon"]; ?>"></i>
                                                            <span class="name"><?php echo $row["title"]; ?></span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="treeviewserver">
                                                <?php foreach ($all_storage_server as $row) {  ?>
                                                <li class="tree-branch" id="<?php echo $row["title"]; ?>" >
                                                    <a href="javascript:void(0)"><i class="<?php echo $row["icon"]; ?>"></i>
                                                        <span class="name"><?php echo $row["title"]; ?></span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" class="form-control" id="path-server" value="<?php echo $path_server; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="treeviewserver">
                                                <?php foreach ($all_storage_server as $row) {  ?>
                                                <li class="tree-branch" id="<?php echo $row["title"]; ?>" >
                                                    <a href="javascript:void(0)"><i class="<?php echo $row["icon"]; ?>"></i>
                                                        <span class="name"><?php echo $row["title"]; ?></span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <ul id="contextMenu" class="dropdown-menu" role="menu" style="display:none" >
                                        <li><a tabindex="-1" href="javascript:void(0)">Creer</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Telecharger</a></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Couper</a></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Copier</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Renommer</a></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Supprimer</a></li>
                                    </ul>
                                <?php } ?>

                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer.php'); ?>