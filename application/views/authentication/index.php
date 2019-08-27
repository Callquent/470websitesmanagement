<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow"  />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php echo css_url('css/perfect-scrollbar.min.css'); ?>
		<?php echo css_url('css/theme.css'); ?>
		<?php echo css_url('css/style.css'); ?>
		<?php echo css_url('plugins/vuetify/vuetify.css'); ?>
		<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
		<link rel="shortcut icon" href="<?php echo img_url('app/favicon-470websitesmanagement-32x32.png'); ?>" />
	</head>
	<body id="<?php echo $this->uri->segment('1'); ?>" class="lock-screen layout layout-vertical layout-left-navigation layout-below-toolbar media-step-xl">
		<main>
			<div id="app">
				<v-app>
					<div id="wrapper">
						<div class="content-wrapper">
							<div class="content custom-scrollbar">
			                    <div id="login" class="p-8">
			                        <div class="form-wrapper md-elevation-8 p-8">
			                            <div class="logo">
			                                <img src="<?php echo img_url('app/logo-470websitesmanagement.svg'); ?>" alt="">
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
			                                    <a @click="dialog_remindpassword = true" class="forgot-password text-secondary mb-4">Forgot Password?</a>
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
							<v-dialog v-model="dialog_remindpassword" width="800">
								<v-card>
									<v-card-title class="headline green lighten-2" primary-title>
										Forgot Password ?
									</v-card-title>
									<v-card-text>
										<v-container grid-list-md>
											<v-layout wrap>
												<v-flex xs12>
													<v-text-field label="Email" v-model="email_reset" required></v-text-field>
												</v-flex>
											</v-layout>
										</v-container>
										<small>*indicates required field</small>
									</v-card-text>
									<v-card-actions>
										<v-spacer></v-spacer>
										<v-btn color="blue darken-1" flat @click="f_remindPassword()">Save</v-btn>
										<v-btn color="blue darken-1" flat @click="dialog_remindpassword = false">Close</v-btn>
									</v-card-actions>
								</v-card>
							</v-dialog>
							<v-dialog v-model="dialog_resetpassword" width="800">
								<v-card>
									<v-card-title class="headline green lighten-2" primary-title>
										Forgot Password Verification ?
									</v-card-title>
									<v-card-text>
										<v-container grid-list-md>
											<v-layout wrap>
												<v-flex xs12>
													<v-text-field label="Code verification" v-model="code_reset" required></v-text-field>
												</v-flex>
											</v-layout>
										</v-container>
										<small>*indicates required field</small>
									</v-card-text>
									<v-card-actions>
										<v-spacer></v-spacer>
										<v-btn color="blue darken-1" flat @click="f_resetPassword()">Save</v-btn>
										<v-btn color="blue darken-1" flat @click="dialog_remindpassword = false">Close</v-btn>
									</v-card-actions>
								</v-card>
							</v-dialog>
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
				</v-app>
			</div>
		</main>
		<?php echo js_url('plugins/vue.js'); ?>
		<?php echo js_url('plugins/vuetify/vuetify.js'); ?>
		<?php echo js_url('plugins/axios.min.js'); ?>
		<script type="text/javascript">
		var v = new Vue({
			el: '#app',
			vuetify: new Vuetify(),
			data : {
				dialog_remindpassword: false,
				dialog_resetpassword: false,
				email_reset: '',
				code_reset: '',
				currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
			},
			created(){
				this.displayPage();
			},
			methods:{
				displayPage(){

				},
				f_remindPassword(){
					var formData = new FormData(); 
					formData.append("email_reset",this.email_reset);
					axios.post(this.currentRoute+"/index/remind_password/", formData).then(function(response){
						if(response.status = 200){
							v.dialog_remindpassword = false;
							v.dialog_resetpassword = true;
						}else{

						}
					})
				},
				f_resetPassword(){
					var formData = new FormData(); 
					formData.append("code_reset",this.code_reset);
					axios.post(this.currentRoute+"/index/reset_password/", formData).then(function(response){
						if(response.status = 200){
							v.dialog_resetpassword = false;
						}else{

						}
					})
				},
			}
		});
		</script>
<?php $this->load->view('include/footer.php'); ?>