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
                            <?php echo lang('add_website'); ?>
                            <span class="tools pull-right">
                                <a class="fa fa-chevron-down" href="javascript:;"></a>
                                <a class="fa fa-cog" href="javascript:;"></a>
                                <a class="fa fa-times" href="javascript:;"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class=" form">
                                <form class="form-horizontal " id="form-add-website" method="post" action="<?php echo site_url('/add-website/submit'); ?>">
                                  <div class="row-fluid">
                                    <h4 class=""><?php echo lang('general_information'); ?></h4>
                                    <hr>
                                    <div class="form-group ">
                                        <label for="cname" class="control-label col-lg-3"><?php echo lang('name_add_website'); ?></label>
                                        <div class="col-lg-6">
                                          <input class="form-control" type="text" name="nom" placeholder="Nom" required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="cemail" class="control-label col-lg-3"><?php echo lang('url_add_website'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="url" placeholder="Site Web" required />
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="curl" class="control-label col-lg-3"><?php echo lang('languages'); ?></label>
                                        <div class="col-lg-6">
                                          <select name="languages" class="form-control">
                                          <?php foreach ($all_languages->result() as $row){  ?>
                                              <option value="<?php echo $row->l_id; ?>"><?php echo $row->l_title; ?></option>
                                          <?php } ?>
                                          </select>
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="curl" class="control-label col-lg-3"><?php echo lang('categories'); ?></label>
                                        <div class="col-lg-6">
                                          <select name="categories" class="form-control">
                                          <?php foreach ($all_categories->result() as $row){  ?>
                                              <option value="<?php echo $row->c_id; ?>"><?php echo $row->c_title; ?></option>
                                          <?php } ?>
                                          </select>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row-fluid">
                                    <h4 class=""><i class="fa fa-plus-square"></i> FTP</h4>
                                    <hr>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('host_ftp'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="hostftp" placeholder="Host FTP">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('login_ftp'); ?></label>
                                        <div class="col-lg-6">
                                          <input class="form-control" type="text" name="loginftp" placeholder="Login FTP">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('password_ftp'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="passwordftp" placeholder="Mot de Passe FTP">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row-fluid">
                                    <h4 class=""><i class="fa fa-plus-square"></i> SQL</h4>
                                    <hr>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('host_sql'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="hostsql" placeholder="Host SQL">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('name_sql'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="namedatabase" placeholder="Nom de la base">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('login_sql'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="loginsql" placeholder="Login SQL">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('password_sql'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="passwordsql" placeholder="Mot de Passe SQL">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="row-fluid">
                                    <h4 class=""><i class="fa fa-plus-square"></i> Back Office</h4>
                                    <hr>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('login_backoffice'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="adminlogin" placeholder="Admin Login">
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <label for="ccomment" class="control-label col-lg-3"><?php echo lang('password_backoffice'); ?></label>
                                        <div class="col-lg-6">
                                            <input class="form-control" type="text" name="adminpassword" placeholder="Admin Mot de Passe">
                                        </div>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                      <div class="col-lg-offset-3 col-lg-6">
                                          <button class="btn btn-primary" type="submit"><?php echo lang('save'); ?></button>
                                          <button class="btn btn-default" type="button"><?php echo lang('cancel'); ?></button>
                                      </div>
                                  </div>
                                </form>
                                <div id="results">
                                    <div class="alert alert-success alert-block fade in"><h4><i class="icon-ok-sign"></i>Votre site web a bien été enregistré !</h4></div>
                                    <div class="alert alert-danger alert-block fade in"><h4><i class="icon-ok-sign"></i>Votre nom de domaine n'est pas valide.</h4></div>
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