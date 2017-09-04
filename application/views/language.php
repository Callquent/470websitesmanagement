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
                <section class="card mb-3">
                    <header class="card-header">
                        Editable Table
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="card-body">
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
                              <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-language">
                                <thead>
                                  <tr>
                                      <th>Langage</th>
                                      <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                      <?php } ?>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($all_languages->result() as $row) { ?>
                                    <tr>
                                      <td><?php echo $row->l_title; ?></td>
                                      <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                        <td><a id="edit-dashboard" href="<?php echo site_url('language/edit-language/'.$row->l_id); ?>">Edit</a></td>
                                        <td><a id="delete-dashboard" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete-language" data-id="<?php echo $row->l_id; ?>">Delete</a></td>
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

<div class="modal fade" id="modal-delete-language" tabindex="-1" role="dialog" aria-labelledby="modal-delete-language" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete Language</h4>
      </div>
      <form id="form-language" method="post" action="#">
        <div class="modal-body">
        </div>
        <div class="modal-footer ">
          <button type="submit" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-share"></span> Envoyer</button>
          <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
        </div>
      </form>
    </div>
  </div>
</div>
<?php $this->load->view('include/footer.php'); ?>