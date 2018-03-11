<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('categories'); ?></h2>
    </div>
    <div class="page-content">
      <section id="main-content">
          <section class="wrapper">

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
                                <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-category">
                                  <thead>
                                    <tr>
                                        <th>Catégorie</th>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <th>Modifier</th>
                                          <th>Supprimer</th>
                                        <?php } ?>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php foreach ($all_categories->result() as $row) { ?>
                                      <tr>
                                        <td><?php echo $row->title_category; ?></td>
                                        <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                          <td><a id="edit-dashboard" href="<?php echo site_url('category/edit-category/'.$row->c_id); ?>">Edit</a></td>
                                          <td><a id="delete-dashboard" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete-category" data-id="<?php echo $row->c_id; ?>">Delete</a></td>
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
          </section>
      </section>
    </div>
  </div>
</div>
<div class="modal fade" id="modal-delete-category" tabindex="-1" role="dialog" aria-labelledby="modal-delete-category" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete Category</h4>
      </div>
      <form id="form-category" method="post" action="#">
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