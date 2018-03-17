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
                                <?php echo lang('add_website'); ?>
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="fa fa-cog" href="javascript:;"></a>
                                    <a class="fa fa-times" href="javascript:;"></a>
                                 </span>
                            </header>
                            <div class="card-body">
                                <div class=" form">
                                    <form class="form-horizontal" id="form-add-website" method="post" action="<?php echo site_url('/add-website/submit'); ?>">
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
                                                  <select name="languages" class="add-website-languages" class="form-control">
                                                  <?php foreach ($all_languages->result() as $row){  ?>
                                                      <option value="<?php echo $row->l_id; ?>"><?php echo $row->title_language; ?></option>
                                                  <?php } ?>
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <label for="curl" class="control-label col-lg-3"><?php echo lang('categories'); ?></label>
                                                <div class="col-lg-6">
                                                  <select name="categories" class="add-website-categories" class="form-control">
                                                  <?php foreach ($all_categories->result() as $row){  ?>
                                                      <option value="<?php echo $row->c_id; ?>"><?php echo $row->title_category; ?></option>
                                                  <?php } ?>
                                                  </select>
                                                </div>
                                            </div>
                                          </div>

                                        <div>
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                        <div class="row-fluid">
                                                            <h4 class=""><i class="fa fa-plus-square"></i> FTP</h4>
                                                            <hr>
                                                        </div>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseOne" class="card-collapse collapse">
                                                <div class="card-body">

                                                    <div class="row-fluid">
                                                        <div class="form-group ">
                                                            <label for="comment" class="control-label col-lg-3"><?php echo lang('host_ftp'); ?></label>
                                                            <div class="col-lg-6">
                                                                <input class="form-control" type="text" name="hostftp" placeholder="Host FTP">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="comment" class="control-label col-lg-3"><?php echo lang('login_ftp'); ?></label>
                                                            <div class="col-lg-6">
                                                              <input class="form-control" type="text" name="loginftp" placeholder="Login FTP">
                                                            </div>
                                                        </div>
                                                        <div class="form-group ">
                                                            <label for="comment" class="control-label col-lg-3"><?php echo lang('password_ftp'); ?></label>
                                                            <div class="col-lg-6">
                                                                <input class="form-control" type="text" name="passwordftp" placeholder="Mot de Passe FTP">
                                                            </div>
                                                        </div>
                                                      </div>


                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                        <div class="row-fluid">
                                                            <h4 class=""><i class="fa fa-plus-square"></i> SQL</h4>
                                                            <hr>
                                                        </div>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="card-collapse collapse">
                                                <div class="card-body">

                                                  <div class="row-fluid">
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('host_sql'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="hostsql" placeholder="Host SQL">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('name_sql'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="namedatabase" placeholder="Nom de la base">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('login_sql'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="loginsql" placeholder="Login SQL">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('password_sql'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="passwordsql" placeholder="Mot de Passe SQL">
                                                        </div>
                                                    </div>
                                                  </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                        <div class="row-fluid">
                                                            <h4 class=""><i class="fa fa-plus-square"></i> Back Office</h4>
                                                            <hr>
                                                        </div>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseThree" class="card-collapse collapse">
                                                <div class="card-body">
                                                
                                                  <div class="row-fluid">
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('host_backoffice'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="adminhost" placeholder="Admin Host">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('login_backoffice'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="adminlogin" placeholder="Admin Login">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('password_backoffice'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="adminpassword" placeholder="Admin Mot de Passe">
                                                        </div>
                                                    </div>
                                                  </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="card-header">
                                                <h4 class="card-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
                                                        <div class="row-fluid">
                                                            <h4 class=""><i class="fa fa-plus-square"></i> Htaccess</h4>
                                                            <hr>
                                                        </div>
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseFour" class="card-collapse collapse">
                                                <div class="card-body">
                                                
                                                  <div class="row-fluid">
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('login_htaccess'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="loginhtaccess" placeholder="Login Htaccess">
                                                        </div>
                                                    </div>
                                                    <div class="form-group ">
                                                        <label for="comment" class="control-label col-lg-3"><?php echo lang('password_htaccess'); ?></label>
                                                        <div class="col-lg-6">
                                                            <input class="form-control" type="text" name="passwordhtaccess" placeholder="Mot de Passe Htaccess">
                                                        </div>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        </div>


                                      <div class="form-group">
                                          <div class="col-lg-offset-3 col-lg-6">
                                              <button class="btn btn-primary" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading ..."><?php echo lang('save'); ?></button>
                                              <button class="btn btn-default" type="button"><?php echo lang('cancel'); ?></button>
                                          </div>
                                      </div>
                                    </form>
                                    <div id="results">
                                        <div class="alert alert-success alert-block"><h4><i class="icon-ok-sign"></i><?php echo lang('website_registered'); ?></h4></div>
                                        <div class="alert alert-danger alert-block"><h4><i class="icon-ok-sign"></i><?php echo lang('website_not_registered'); ?></h4></div>
                                    </div>
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
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
        $("#results .alert-success").hide();
        $("#results .alert-danger").hide();
        $("#form-add-website").submit(function(e){
            $("#form-add-website button[type='submit']").button('loading');
            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data:$(this).serialize(),
                success: function(msg){
                    $("#form-add-website button[type='submit']").button('reset');
                    $("#form-add-website").fadeOut('slow');
                    $('#results .alert-success').fadeIn('fast');
                    $('.badge-all-websites').text(parseInt($(".badge-all-websites").text())+1);

                    $("badge-language-"+$('#form-add-website .add-website-languages option:selected').text()).text(parseInt($("badge-language-"+$('#form-add-website .add-website-languages option:selected').text()).text())+1);
                    setTimeout(function() {
                        $('#results .alert-success').fadeOut('slow');
                        $("#form-add-website").find("input[type=text], textarea").val("");
                        $("#form-add-website").fadeIn('slow');
                    }, 3000 );
                },
                error: function(msg){
                    $("#form-add-website button[type='submit']").button('reset');
                    $("#form-add-website").fadeOut('slow');
                    $('#results .alert-danger').fadeIn('fast');
                    setTimeout(function() {
                        $('#results .alert-danger').fadeOut('slow');
                        $("#form-add-website").find("input[type=text], textarea").val("");
                        $("#form-add-website").fadeIn('slow');
                    }, 3000 );
                }
            });
            e.preventDefault();
        });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>