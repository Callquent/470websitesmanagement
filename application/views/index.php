<?php $this->load->view('include/header.php'); ?>

<div class="pen-title">
	<h1>Websites Management</h1>
</div>
<!-- Form Module-->
<div class="module form-module">
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
</div>

<?php $this->load->view('include/footer.php'); ?>