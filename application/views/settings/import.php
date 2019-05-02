<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
    <div class="page-content">

        <section id="main-content">
            <section class="wrapper">

            <div class="row">
                <div class="col-sm-12">
                    <section class="card mb-3">
                        <header class="card-header">
                            <?php echo lang('import'); ?>
                        </header>
                        <div class="card-body">
                            <div class="position-center">

    			                        <form class="form-horizontal" id="form-import" method="post" action="<?php echo site_url('/import/import-470websitesmanagement/'); ?>" enctype="multipart/form-data">
    			                            <div class="form-group">
                                                <label class="col-sm-3 control-label col-lg-3"><?php echo lang('save_key_secrete'); ?></label>
                                                <div class="col-lg-6">
    			                                    <input type="text" class="form-control" name="keysecrete" id="keysecrete" placeholder="Cle Secrete">
    			                                </div>
    			                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label col-lg-3"><?php echo lang('charge_file_470'); ?></label>
                                                <div class="col-lg-6">
                                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                <span class="btn btn-white btn-file">
                                                                    <span class="fileupload-new"><i class="icon icon-attachment"></i> Select file</span>
                                                                    <span class="fileupload-exists"><i class="icon icon-replay"></i> Change</span>
                                                                    <input type="file" name="importfile" class="default" />
                                                                </span>
                                                        <span class="fileupload-preview" style="margin-left:5px;"></span>
                                                        <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                                    </div>
                                                </div>
                                            </div>
    			                            <div class="form-group">
    			                                <div class="col-lg-offset-2 col-lg-10">
    			                                    <button type="submit" class="btn btn-danger"><?php echo lang('import'); ?></button>
    			                                </div>
    			                            </div>
    			                        </form>
                                        <div id="results">
                                            <div class="alert alert-success alert-block fade in"><h4><i class="icon-ok-sign"></i>L'exportation a bien été effectué !</h4></div>
                                            <div class="alert alert-danger alert-block fade in"><h4><i class="icon-ok-sign"></i>Votre fichier ou votre clé n'est pas valide.</h4></div>
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
            </div>
        </div>
    </v-app>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
    var v = new Vue({
        el: '#app',
        data : {
            sidebar:"administration",
        },
        created(){
            this.displayPage();
        },
        methods:{
            displayPage(){

            },
        }
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){
        $("#results .alert-success").hide();
        $("#results .alert-danger").hide();
        $('#form-import').submit(function(e) {
            var formData = new FormData($(this)[0]);

            $.ajax({
                type: "POST",
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                cache : false,
                contentType : false,
                processData : false,
                success: function(response){
                    if(response.type != 'error'){
                        $("#form-import").fadeOut('slow');
                        $('#results .alert-success').fadeIn('fast');
                        setTimeout(function() {
                            $('#results .alert-success').fadeOut('slow');
                            $("#form-import").find("input[type=text], textarea").val("");
                            $("#form-import").fadeIn('slow');
                        }, 3000 );
                    } else {
                        $("#form-import").fadeOut('slow');
                        $('#results .alert-danger').fadeIn('fast');
                        setTimeout(function() {
                            $('#results .alert-danger').fadeOut('slow');
                            $("#form-import").find("input[type=text], textarea").val("");
                            $("#form-import").fadeIn('slow');
                        }, 3000 );
                    }
                },
                error: function(response){
                    $("#form-import").fadeOut('slow');
                    $('#results .alert-danger').fadeIn('fast');
                    setTimeout(function() {
                        $('#results .alert-danger').fadeOut('slow');
                        $("#form-import").find("input[type=text], textarea").val("");
                        $("#form-import").fadeIn('slow');
                    }, 3000 );
                }
            });
            e.preventDefault();
        });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>