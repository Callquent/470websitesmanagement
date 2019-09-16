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
	<body id="<?php echo $this->uri->segment('1'); ?>" class="lock-screen layout layout-vertical layout-left-navigation layout-below-toolbar">
		<main>
			<div id="app">
				<v-app>
					<div id="wrapper">
						<div class="content-wrapper">
							<div class="content custom-scrollbar">
								<div id="register" class="p-8">
									<div class="form-wrapper md-elevation-8 p-8">
										<div class="logo">
											<img src="<?php echo img_url('app/logo-470websitesmanagement.svg'); ?>" alt="">
										</div>
										<div class="title mt-4 mb-8">Create an account</div>
										<v-form ref="form" class="form-horizontal"  action="<?php echo site_url('registration/create'); ?>" method="post" id="loginform">
											<v-text-field type="text" id="registerFormInputName" name="name" label="Name"></v-text-field>
											<v-text-field type="email" id="registerFormInputEmail" name="email" label="Email address"></v-text-field>
											<v-text-field type="password" id="registerFormInputPassword" name="password" label="Password"></v-text-field>
											<v-text-field type="password" id="registerFormInputPasswordConfirm" name="password_confirm" label="Password (Confirm)"></v-text-field>
											<v-row>
												<v-col cols="12" md="9">
													<v-text-field type="text" name="captcha" label="Code"></v-text-field>
												</v-col>
												<v-col cols="12" md="3">
													<img src="<?php echo site_url('registration/captcha'); ?>"/>
												</v-col>
											</v-row>
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
											<v-row justify="center">
												<v-btn type="submit" color="blue darken-1" flat x-large>CREATE MY ACCOUNT</v-btn>
											</v-row>
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
										</v-form>
										<div class="login d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
											<span class="text mr-sm-2">Already have an account?</span>
											<a class="link text-secondary" href="<?php echo site_url('index'); ?>">Log in</a>
										</div>
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
			created(){
				this.displayPage();
			},
			methods:{
				displayPage(){

				},
			}
		});
		</script>
<?php $this->load->view('include/footer.php'); ?>