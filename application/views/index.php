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
		<?php echo css_url('js/data-tables/Buttons/css/buttons.dataTables.css'); ?>
		<?php echo css_url('css/theme.css'); ?>
		<?php echo css_url('css/theme-responsive.css'); ?>
		<?php echo css_url('css/style.css'); ?>
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	</head>
	<body class="lock-screen">

<div class="pen-title">
	<h1>470 WEBSITES MANAGEMENT</h1>
</div>

	<div class="container">

		<form action="<?php echo site_url('index'); ?>" method="post" id="loginform" class="form-signin">
			<h2 class="form-signin-heading">sign in now</h2>
			<div class="login-wrap">
			    <div class="user-login-info">
			        <input type="text" name="email" id="email" class="form-control" placeholder="Email" autofocus>
			        <input type="password" name="password" id="password" class="form-control" placeholder="Password">
			    </div>
			    <label class="checkbox">
			        <input type="checkbox" value="remember-me"> Remember me
			        <span class="pull-right">
			            <a data-toggle="modal" href="#remindpassword"> Forgot Password?</a>

			        </span>
			    </label>
			    <button class="btn btn-lg btn-login btn-block" type="submit">Sign in</button>
				<?php if($this->session->flashdata('success')){ ?>
				<div class="alert alert-success">
					<?php echo $this->session->flashdata('success'); ?> <a class="close" data-dismiss="alert" href="#">×</a>
				</div>
				<?php } ?>
				<?php if($this->session->flashdata('disconnect')){ ?>
				<div class="alert alert-danger">
					<?php echo $this->session->flashdata('disconnect'); ?> <a class="close" data-dismiss="alert" href="#">×</a>
				</div>
				<?php } ?>

				<?php if(validation_errors()){
					echo validation_errors('<div class="alert alert-danger">', ' <a class="close" data-dismiss="alert" href="#">×</a></div>');
				} ?>
			    <div class="registration">
			        Don't have an account yet?
			        <a class="" href="<?php echo site_url('registration'); ?>">
			            Create an account
			        </a>
			    </div>

			</div>
		</form>
		<!-- Modal -->
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="remindpassword" class="modal fade">
		  <div class="modal-dialog">
		      <div class="modal-content">
		          <div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		              <h4 class="modal-title">Forgot Password ?</h4>
		          </div>
					<form action="<?php echo site_url('index/remind_password'); ?>" method="post" id="forgotpasswordform" class="form-horizontal" role="form">
			          <div class="modal-body">
			              <p>Enter your e-mail address below to reset your password.</p>
			              <input type="text" name="emailreset" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
			          </div>
			          <div class="modal-footer">
			              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
			              <button class="btn btn-success" type="submit">Submit</button>
			          </div>
			        </form>
		      </div>
		  </div>
		</div>
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="resetpassword" class="modal fade">
		  <div class="modal-dialog">
		      <div class="modal-content">
		          <div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		              <h4 class="modal-title">Forgot Password Verification ?</h4>
		          </div>
					<form action="<?php echo site_url('index/reset_password'); ?>" method="post" id="forgotpasswordform" class="form-horizontal" role="form">
			          <div class="modal-body">
			              <p>Enter your code verification below to reset your password.</p>
			              <input type="text" name="codereset" placeholder="Code verification" autocomplete="off" class="form-control placeholder-no-fix">
			          </div>
			          <div class="modal-footer">
			              <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
			              <button class="btn btn-success" type="submit">Submit</button>
			          </div>
			        </form>
		      </div>
		  </div>
		</div>
	</div>

<?php $this->load->view('include/footer.php'); ?>