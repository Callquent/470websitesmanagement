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


<!-- Form Module-->
<!-- <div class="module form-module">
	<div class="toggle"><i class="fa fa-times fa-pencil"></i>
		<div class="tooltip">Click Me</div>
	</div>
	<div class="form-login-account">
		<h2>Login to your account</h2>
		<form action="<?php echo site_url('index'); ?>" method="post" id="loginform" class="form-horizontal" role="form">
			<input type="text" name="email" id="email" placeholder="Email"/>
			<input type="password" name="password" id="password" placeholder="Password"/>
			<button>Login</button>
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
		</form>
	</div>
	<div class="form-create-account">
		<h2>Create an account</h2>
		<form action="<?php echo site_url('index/registration'); ?>" method="post" id="signupform" class="form-horizontal" role="form">
			<input type="text" name="name" placeholder="Username"/>
			<input type="email" name="email" placeholder="Email Address"/>
			<input type="password" name="password" placeholder="Password"/>
			<button>Register</button>
		</form>
	</div>
	<div class="forgot-your-password">
		<h2>Forgot Password ?</h2>
		<form action="<?php echo site_url('index/remind_password'); ?>" method="post" id="forgotpasswordform" class="form-horizontal" role="form">
			<input type="email" name="emailreset" placeholder="Email Address"/>
			<button>Reset Password</button>
		</form>
	</div>
	<div class="verification-code">
		<h2>Verification code</h2>
		<form action="<?php echo site_url('index/reset_password'); ?>" method="post" id="forgotpasswordform" class="form-horizontal" role="form">
			<input type="text" name="code" placeholder="Verification code"/>
			<button>Reset Password</button>
		</form>
	</div>
	<div class="cta"><a class="link-forgot-password" href="javascript:;">Forgot your password?</a></div>
</div> -->








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
			            <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

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
		<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
		  <div class="modal-dialog">
		      <div class="modal-content">
		          <div class="modal-header">
		              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		              <h4 class="modal-title">Forgot Password ?</h4>
		          </div>
					<form action="<?php echo site_url('index/remind_password'); ?>" method="post" id="forgotpasswordform" class="form-horizontal" role="form">
			          <div class="modal-body">
			              <p>Enter your e-mail address below to reset your password.</p>
			              <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
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