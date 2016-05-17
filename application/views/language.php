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
                                <div class="btn-group pull-right">
                                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="#">Print</a></li>
                                        <li><a href="#">Save as PDF</a></li>
                                        <li><a href="#">Export to Excel</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="space15"></div>
                              <table class="table table-striped table-hover table-bordered table-dashboard" id="table-language">
                                <thead>
                                  <tr>
                                      <th>Langage</th>
                                      <?php if ($user_role[0]->name == "Developper") { ?>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                      <?php } ?>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($all_languages->result() as $row) { ?>
                                    <tr>
                                      <td><?php echo $row->l_title; ?></td>
                                      <?php if ($user_role[0]->name == "Developper") { ?>
                                        <td><a id="edit-dashboard" href="<?php echo site_url('language/edit-language/'.$row->l_id); ?>">Edit</a></td>
                                        <td><a id="delete-dashboard" href="<?php echo site_url('language/delete-language/'.$row->l_id); ?>">Delete</a></td>
                                    <?php } ?>
                                    </tr>
                                  <?php } ?>
                                </tbody>
                              </table>
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