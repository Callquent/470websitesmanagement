<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow"  />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo css_url('css/bootstrap.min.css'); ?>
        <?php echo css_url('css/perfect-scrollbar.min.css'); ?>
        <?php echo css_url('css/theme.css'); ?>
        <?php echo css_url('css/style.css'); ?>
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
        <link rel="shortcut icon" href="<?php echo img_url('app/favicon-470websitesmanagement-32x32.png'); ?>" />
	</head>
	<body id="<?php echo $this->uri->segment('1'); ?>" class="lock-screen layout layout-vertical layout-left-navigation layout-below-toolbar">
        <main>
            <div id="wrapper">
                <div class="content-wrapper">
                    <div class="content custom-scrollbar">
                        <div id="register" class="p-8">
                            <div class="form-wrapper md-elevation-8 p-8">
                                <div class="logo">
                                    <img src="<?php echo img_url('app/logo-470websitesmanagement.svg'); ?>" alt="">
                                </div>
                                <div class="title mt-4 mb-8">Create an account</div>
                                <form action="<?php echo site_url('registration/create'); ?>" method="post" id="loginform">
                                    <div class="form-group mb-4">
                                        <input type="text" class="form-control" id="registerFormInputName" name="name">
                                        <label for="registerFormInputName">Name</label>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="email" class="form-control" id="registerFormInputEmail" name="email">
                                        <label for="registerFormInputEmail">Email address</label>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" class="form-control" id="registerFormInputPassword" name="password">
                                        <label for="registerFormInputPassword">Password</label>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="password" class="form-control" id="registerFormInputPasswordConfirm" name="password_confirm">
                                        <label for="registerFormInputPasswordConfirm">Password (Confirm)</label>
                                    </div>
                                    <div class="form-group mb-4">
                                        <input type="text" name="captcha" placeholder="Code">
                                        <img src="<?php echo site_url('registration/captcha'); ?>"/>
                                    </div>
                                    <div class="terms-conditions row align-items-center justify-content-center pt-4 mb-8">
                                        <div class="form-check mr-1 mb-1">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" name="accept_terms">
                                                <span class="checkbox-icon fuse-ripple-ready"></span>
                                                <span>I read and accept</span>
                                            </label>
                                        </div>
                                        <a href="<?php echo site_url('terms-and-conditions'); ?>" class="text-secondary mb-1">terms and conditions</a>
                                    </div>
                                    <button type="submit" class="submit-button btn btn-block btn-secondary my-4 mx-auto fuse-ripple-ready" aria-label="LOG IN">
                                        CREATE MY ACCOUNT
                                    </button>
                                    <?php if($this->session->flashdata('success')){ ?>
                                    <div class="alert alert-success">
                                        <?php echo $this->session->flashdata('success'); ?> <a class="close" data-dismiss="alert">×</a>
                                    </div>
                                    <?php } ?>
                                    <?php if($this->session->flashdata('danger')){ ?>
                                    <div class="alert alert-danger">
                                        <?php echo $this->session->flashdata('danger'); ?> <a class="close" data-dismiss="alert">×</a>
                                    </div>
                                    <?php } ?>

                                    <?php if(validation_errors()){
                                        echo validation_errors('<div class="alert alert-danger">', ' <a class="close" data-dismiss="alert">×</a></div>');
                                    } ?>
                                </form>
                                <div class="login d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
                                    <span class="text mr-sm-2">Already have an account?</span>
                                    <a class="link text-secondary" href="<?php echo site_url('index'); ?>">Log in</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
<?php $this->load->view('include/javascript.php'); ?>
<?php $this->load->view('include/footer.php'); ?>