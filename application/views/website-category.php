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
                              <table class="table table-striped table-hover table-bordered table-dashboard" id="table-dashboard">
                                <thead>
                                  <tr>
                                      <th>Nom</th>
                                      <th>Site Web</th>
                                      <th>Adresse IP</th>
                                      <th>Catégorie</th>
                                      <th>Langages</th>
                                      <th>Access FTP</th>
                                      <th>Access SQL</th>
                                      <th>Access Back office</th>
                                      <th>Envoyer</th>
                                      <?php if ($user_role[0]->name == "Developper") { ?>
                                        <th>Modifier</th>
                                        <th>Supprimer</th>
                                      <?php } ?>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($all_websites->result() as $row) { ?>
                                    <tr>
                                      <td ><?php echo $row->w_title; ?></td>
                                      <td><a href="<?php echo prep_url($row->w_url_rw); ?>" target="_blank"><?php echo $row->w_url_rw; ?></a></td>
                                      <td><?php echo ($this->input->valid_ip(gethostbyname($row->w_url_rw))?gethostbyname($row->w_url_rw):"ADRESSE IP NON VALIDE"); ?></td>
                                      <td><?php echo $row->c_title; ?></td>
                                      <td><?php echo $row->l_title; ?></td>
                                      <td><a class="access-ftp" href="javascript:;" data-toggle="modal" data-target="#view-ftp" data-id="'.$row->w_id.'">Access FTP</a></td>
                                      <td><a class="access-sql" href="javascript:;" data-toggle="modal" data-target="#view-database" data-id="'.$row->w_id.'">Access SQL</a></td>
                                      <td><a class="access-back-office" href="javascript:;" data-toggle="modal" data-target="#view-backoffice" data-id="'.$row->w_id.'">Access Back office</a></td>
                                      <?php if ($user_role[0]->name == "Developper") { ?>
                                        <td><a class="email" href="javascript:;" data-toggle="modal" data-target="#email">Email</a></td>
                                        <td><a id="edit-dashboard" href="'.site_url('dashboard/edit-website/'.$row->w_id).'">Edit</a></td>
                                        <td><a id="delete-dashboard" href="'.site_url('dashboard/delete-website/'.$row->w_id).'">Delete</a></td>
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

      <div class="modal fade" id="view-ftp" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Afficher FTP</h4>
            </div>
            <div class="modal-body">
              <form id="acces-ftp" class="form-horizontal" role="form">
                <fieldset>
                 <table class="table table-striped table-hover table-bordered table-dashboard" id="table-ftp-dashboard">
                      <thead>
                        <tr>
                            <th>Hote FTP</th>
                            <th>Login FTP</th>
                            <th>Password FTP</th>
                            <?php if ($user_role[0]->name == "Developper") { ?>
                              <th>Modifier</th>
                              <th>Supprimer</th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="view-database" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Afficher SQL</h4>
            </div>
            <div class="modal-body">
              <form id="acces-sql" class="form-horizontal" role="form">
                <fieldset>
                 <table class="table table-striped table-hover table-bordered table-dashboard" id="table-database-dashboard">
                      <thead>
                        <tr>
                            <th>Serveur SQL</th>
                            <th>Nom de la base</th>
                            <th>Login SQL</th>
                            <th>Mot de Passe SQL</th>
                            <?php if ($user_role[0]->name == "Developper") { ?>
                              <th>Modifier</th>
                              <th>Supprimer</th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="view-backoffice" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Afficher le site web</h4>
            </div>
            <div class="modal-body">
              <form id="acces-backoffice" class="form-horizontal" role="form">
                <fieldset>
                 <table class="table table-striped table-hover table-bordered table-dashboard" id="table-backoffice-dashboard">
                      <thead>
                        <tr>
                            <th>Admin Login</th>
                            <th>Admin Mot de passe</th>
                            <?php if ($user_role[0]->name == "Developper") { ?>
                              <th>Modifier</th>
                              <th>Supprimer</th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="email" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header modal-header-warning">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Envoyer un email à un client</h4>
            </div>
            <form id="form-email" method="post" action="<?php echo site_url('/dashboard/contact'); ?>">
              <div class="modal-body">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="checkbox">
                  <label>
                    <input name="check_ftp" type="checkbox"> Acces FTP
                  </label>
                  <label>
                    <input name="check_sql" type="checkbox"> Acces Base de Donnée
                  </label>
                  <label>
                    <input name="check_backoffice" type="checkbox"> Acces Backoffice
                  </label>
                </div>
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