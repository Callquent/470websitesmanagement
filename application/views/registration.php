<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow"  />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo css_url('css/bootstrap.min.css'); ?>
		<?php echo css_url('css/bootstrap-table.min.css'); ?>
		<?php echo css_url('js/fullcalendar/bootstrap-fullcalendar.css'); ?>
		<?php echo css_url('js/bootstrap-fileupload/bootstrap-fileupload.css'); ?>
		<?php echo css_url('js/bootstrap-colorpicker/css/colorpicker.css'); ?>
		<?php echo css_url('js/data-tables/DT_bootstrap.css'); ?>
		<?php echo css_url('js/data-tables/Buttons/css/buttons.dataTables.css'); ?>
		<?php echo css_url('js/fuelux/css/tree-style.css'); ?>
		<?php echo css_url('css/theme.css'); ?>
		<?php echo css_url('css/blue-theme.css'); ?>
		<?php echo css_url('css/theme-responsive.css'); ?>
		<?php echo css_url('css/style.css'); ?>
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	</head>
	<body class="lock-screen">

<div class="pen-title">
	<h1>470 WEBSITES MANAGEMENT</h1>
</div>
    <div class="container">
      <form action="<?php echo site_url('registration'); ?>" method="post" id="loginform" class="form-signin">
        <h2 class="form-signin-heading">registration now</h2>
        <div class="login-wrap">
            <p>Enter your personal details below</p>
            <input type="text" class="form-control" name="name" placeholder="User name" autofocus>
            <input type="text" class="form-control" name="email" placeholder="Email" autofocus>
            <input type="password" class="form-control" name="password" placeholder="Password">
            <input type="password" class="form-control" placeholder="Re-type Password">
            <label class="checkbox">
                <input type="checkbox" value="agree this condition"> I agree to the Terms of Service and Privacy Policy
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Submit</button>

            <div class="registration">
                Already Registered.
                <a class="" href="<?php echo site_url('index'); ?>">
                    Login
                </a>
            </div>

        </div>
      </form>
    </div>
<?php $this->load->view('include/footer.php'); ?>