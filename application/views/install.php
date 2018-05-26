<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow"  />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo css_url('css/bootstrap.min.css'); ?>
    <?php echo css_url('css/bootstrap-table.min.css'); ?>
    <?php echo css_url('css/theme.css'); ?>
    <?php echo css_url('css/theme-responsive.css'); ?>
    <?php echo css_url('css/jquery.steps.css'); ?>
    <?php echo css_url('css/style.css'); ?>
    <link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  </head>
  <body class="lock-screen">

<div class="pen-title">
  <img src="<?php echo img_url('app/logo-470websitesmanagement.png'); ?>" alt="">
</div>

<!--sidebar end-->
    <!--main content start-->
    <section class="container">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <section class="card mb-3">
                    <div class="card-body">
                        <div id="wizard-vertical">
                            <h2>First Step</h2>
                            <section>
                                <form class="form-horizontal form-step1" method="post" id="loginform">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <input type="text" name="databasename" class="form-control">
                                                <label for="database-name">Database Name</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control">
                                                <label for="username">Username</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="password" class="form-control">
                                                <label for="password">Password</label>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="databasehost" class="form-control" value="localhost">
                                                <label class="database-host">Database Host</label>
                                            </div>
                                        </div>
                                    </form>
                            </section>
                            <h2>Second Step</h2>
                            <section>
                                <form class="form-horizontal form-step2" method="post" id="loginform">
                                    <div class="col-lg-8">
                                        <div class="form-group">
                                            <input type="text" name="username" class="form-control">
                                            <label for="username">Username</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="email" class="form-control">
                                            <label for="email">Email</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="password" class="form-control">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>
                                </form>
                            </section>
                            <h2>Third Step</h2>
                            <section>
                                <p>Welcome to 470WEBSITESMANAGEMENT</p>
                            </section>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>

    <?php echo js_url('js/jquery.min.js'); ?>
    <?php echo js_url('js/bootstrap.min.js'); ?>
    <script>
        $(function ()
        {
            
                $("#wizard-vertical").steps({
                    headerTag: "h2",
                    bodyTag: "section",
                    transitionEffect: "slideLeft",
                    stepsOrientation: "vertical",
                    <?php if($install_database == true) { ?>
                        startIndex: 1,
                    <?php } ?>
                    onStepChanging: function (event, currentIndex, newIndex) {
                        var move = true;
                        if (currentIndex == 0) {
                            $.ajax({
                                type: "POST",
                                url: window.location.href+'index.php/install/step1/',
                                async: false,
                                data: $('.form-step1').serialize(),
                                success: function(data){
                                    move = true;
                                },
                                error: function(msg){
                                    move = false;
                                }
                            });
                        }else if (currentIndex == 1) {
                            $.ajax({
                                type: "POST",
                                url: window.location.href+'index.php/install/step2/',
                                async: false,
                                data: $('.form-step2').serialize(),
                                success: function(data){
                                    move = true;
                                },
                                error: function(msg){
                                    move = false;
                                }
                            });
                        }
                        return move;
                    },
                    onFinished: function (event, currentIndex) {
                            $.ajax({
                                type: "POST",
                                url: window.location.href+'index.php/install/step3/',
                                async: false,
                                success: function(data){
                                    location.reload();
                                },
                                error: function(msg){
                                    move = false;
                                }
                            });
                    },
                    saveState: true
                });
            
        });
    </script>
    <?php echo js_url('js/jquery.dcjqaccordion.2.7.js'); ?>
    <?php echo js_url('js/mobile-detect.min.js'); ?>
    <?php echo js_url('js/perfect-scrollbar.jquery.min.js'); ?>
    <?php echo js_url('js/fuse-html.min.js'); ?>
    <?php echo js_url('js/jquery-steps/jquery.steps.js'); ?>
    <?php echo js_url('js/scripts.js'); ?>