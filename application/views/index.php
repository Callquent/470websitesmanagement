<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow"  />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo css_url('css/bootstrap.min.css'); ?>
		<?php echo css_url('css/theme.css'); ?>
		<?php echo css_url('css/theme-responsive.css'); ?>
		<?php echo css_url('css/style.css'); ?>
		<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
	</head>
	<body id="<?php echo $this->uri->segment('1'); ?>" class="lock-screen layout layout-vertical layout-left-navigation layout-below-toolbar media-step-xl">
		<main>
        	<div id="wrapper">
				<div class="content-wrapper">
					<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
	                    <div id="login" class="p-8">
	                        <div class="form-wrapper md-elevation-8 p-8">
	                            <div class="logo bg-secondary">
	                                <span>F</span>
	                            </div>
	                            <div class="title mt-4 mb-8">Log in to your account</div>
	                            <form name="loginForm" action="<?php echo site_url('index'); ?>" method="post" id="loginform">
	                                <div class="form-group mb-4">
	                                    <input type="text" name="email" id="email" class="form-control">
	                                    <label for="loginFormInputEmail">Email address</label>
	                                </div>
	                                <div class="form-group mb-4">
	                                    <input type="password" name="password" id="password" class="form-control">
	                                    <label for="loginFormInputPassword">Password</label>
	                                </div>
	                                <div class="remember-forgot-password row no-gutters align-items-center justify-content-between pt-4">
	                                    <div class="mb-4">
	                                    </div>
	                                    <a data-toggle="modal" href="#remindpassword" class="forgot-password text-secondary mb-4">Forgot Password?</a>
	                                </div>
	                                <button type="submit" class="submit-button btn btn-block btn-muted my-4 mx-auto fuse-ripple-ready" aria-label="LOG IN">
	                                    LOG IN
	                                </button>
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
	                            <div class="register d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
	                                <span class="text mr-sm-2">Don't have an account?</span>
	                                <a class="link text-secondary" href="<?php echo site_url('registration'); ?>">Create an account</a>
	                            </div>

	                        </div>
	                    </div>
					</div>
					<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="remindpassword" class="modal fade">
					  <div class="modal-dialog">
					      <div class="modal-content">
					          <div class="modal-header">
					              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					              <h4 class="modal-title">Forgot Password ?</h4>
					          </div>
								<form action="<?php echo site_url('index/remind_password'); ?>" method="post" id="remindpasswordform" class="form-horizontal" role="form">
						          <div class="modal-body">
						              <p>Enter your e-mail address below to reset your password.</p>
						              <input type="text" name="emailreset" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">
						          </div>
						          <div class="modal-footer">
						              <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo lang('cancel'); ?></button>
						              <button class="btn btn-success" type="submit"><?php echo lang('send'); ?></button>
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
								<form action="<?php echo site_url('index/reset_password'); ?>" method="post" id="resetpasswordform" class="form-horizontal" role="form">
						          <div class="modal-body">
						              <p>Enter your code verification below to reset your password.</p>
						              <input type="text" name="codereset" placeholder="Code verification" autocomplete="off" class="form-control placeholder-no-fix">
						          </div>
						          <div class="modal-footer">
						              <button data-dismiss="modal" class="btn btn-default" type="button"><?php echo lang('cancel'); ?></button>
						              <button class="btn btn-success" type="submit"><?php echo lang('send'); ?></button>
						          </div>
						        </form>
					      </div>
					  </div>
					</div>
				</div>
			</div>
		</main>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	$(document).ready(function(){
		$("#remindpasswordform").submit(function(e){
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(msg){
					$('#remindpassword').modal('hide');
					$('#resetpassword').modal('show');
				},
				error: function(msg){
					console.log(msg.responseText);
				}
			});
			e.preventDefault();
		});
		$("#resetpasswordform").submit(function(e){
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(msg){
					$('#resetpassword').modal('hide');
				},
				error: function(msg){
					console.log(msg.responseText);
				}
			});
			e.preventDefault();
		});
	});
</script>
<?php $this->load->view('include/footer.php'); ?>