<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow"  />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo css_url('css/perfect-scrollbar.min.css'); ?>
		<?php echo css_url('plugins/vuetify/vuetify.min.css'); ?>
		<?php echo css_url('css/style.css'); ?>
		<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
		<?php echo css_url('css/materialdesignicons.min.css'); ?>
		<link rel="shortcut icon" href="<?php echo img_url('app/favicon-470websitesmanagement-32x32.png'); ?>" />
	</head>
	<body id="<?php echo $this->uri->segment('1'); ?>" class="lock-screen layout layout-vertical layout-left-navigation layout-below-toolbar">
		<main>
			<div id="app">
				<v-app>
					<v-container fluid fill-height>
						<v-row>
	        				<v-col cols="12">
								<v-card
								max-width="500"
								class="d-flex align-content-center flex-wrap mx-auto pa-12"
								>
									<v-card-text>
										<v-row align="center" justify="center">
											<v-img
											max-width="145"
											aspect-ratio="1"
											src="<?php echo img_url('app/logo-470websitesmanagement.svg'); ?>"
											>
											</v-img>
										</v-row>
										<v-row align="center" justify="center">
											<div class="title mt-4 mb-8">Create an account</div>
										</v-row>
										<v-form ref="form" class="form-horizontal"  action="<?php echo site_url('registration/create'); ?>" method="post" id="loginform">
											<v-text-field type="text" id="registerFormInputName" name="name" label="Name"></v-text-field>
											<v-text-field type="email" id="registerFormInputEmail" name="email" label="Email address"></v-text-field>
											<v-text-field
											:append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
											:rules="[rules.required, rules.min]"
											:type="show_password ? 'text' : 'password'"
											hint="At least 8 characters"
											@click:append="show_password = !show_password"
											id="registerFormInputPassword"
											name="password"
											label="Password"></v-text-field>
											<v-text-field
											:append-icon="show_password_confirmation ? 'mdi-eye' : 'mdi-eye-off'"
											:rules="[rules.required, rules.min]"
											:type="show_password_confirmation ? 'text' : 'password'"
											hint="At least 8 characters"
											@click:append="show_password_confirmation = !show_password_confirmation"
											id="registerFormInputPasswordConfirm"
											name="password_confirm"
											label="Password (Confirm)"></v-text-field>
											<v-row>
												<v-col cols="12" md="9">
													<v-text-field type="text" name="captcha" label="Code"></v-text-field>
												</v-col>
												<v-col cols="12" md="3">
													<img src="<?php echo site_url('registration/captcha'); ?>"/>
												</v-col>
											</v-row>
											<div class="terms-conditions row align-items-center justify-content-center pt-4 mb-8">
												<v-checkbox name="accept_terms">
													<template v-slot:label>
														<div>
															I read and accept
																<a
																target="_blank"
																href="<?php echo site_url('terms-and-conditions'); ?>"
																@click.stop
																>
																terms and conditions
																</a>
														</div>
													</template>
												</v-checkbox>
											</div>
											<v-row justify="center">
												<v-btn type="submit" color="primary" x-large>CREATE MY ACCOUNT</v-btn>
											</v-row>
											<?php if($this->session->flashdata('success')){ ?>
												<v-alert type="success" dismissible>
													<?php echo $this->session->flashdata('success'); ?> <a class="close" data-dismiss="alert">×</a>
												</v-alert>
											<?php } ?>
											<?php if($this->session->flashdata('danger')){ ?>
												<v-alert type="error" dismissible>
													<?php echo $this->session->flashdata('danger'); ?>
												</v-alert>
											<?php } ?>

											<?php if(validation_errors()){
												echo validation_errors('<v-alert type="error" dismissible>', '</v-alert>');
											} ?>
										</v-form>
										<div class="login d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
											<span class="text mr-sm-2">Already have an account?</span>
											<a class="link text-secondary" href="<?php echo site_url('index'); ?>">Log in</a>
										</div>
									</v-card-text>
									<v-card-actions>

									</v-card-actions>
								</v-card>
							</v-col>
						</v-row>
					</v-container>
				</v-app>
			</div>
		</main>
		<?php echo js_url('plugins/vue.min.js'); ?>
		<?php echo js_url('plugins/vuetify/vuetify.min.js'); ?>
		<?php echo js_url('plugins/axios.min.js'); ?>
		<script type="text/javascript">
		var v = new Vue({
			el: '#app',
			vuetify: new Vuetify(),
			data : {
				show_password: false,
				show_password_confirmation: false,
				rules: {
					required: value => !!value || 'Required.',
					min: v => v.length >= 8 || 'Min 8 characters',
					emailMatch: () => (`The email and password you entered don't match`),
				},
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
	</body>
</html>