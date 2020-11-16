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
	<body id="<?php echo $this->uri->segment('1'); ?>" class="lock-screen layout layout-vertical layout-left-navigation layout-below-toolbar media-step-xl">
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
											<div class="title mt-4 mb-8">Log in to your account</div>
										</v-row>
										<v-form ref="form" class="form-horizontal" id="loginform" method="post" name="loginForm" action="<?php echo site_url('index'); ?>">
											<v-text-field type="text" name="email" id="email" label="Email"></v-text-field>
											<v-text-field
											:append-icon="show_password ? 'mdi-eye' : 'mdi-eye-off'"
											:rules="[rules.required, rules.min]"
											:type="show_password ? 'text' : 'password'"
											hint="At least 8 characters"
											@click:append="show_password = !show_password"
											name="password"
											id="password"
											label="Password"></v-text-field>
											<div class="remember-forgot-password row no-gutters align-items-center justify-content-between pt-4">
												<div class="mb-4">
												</div>
												<a @click="dialog_remindpassword = true" class="forgot-password text-secondary mb-4">Forgot Password?</a>
											</div>
											<v-row justify="center">
												<v-btn type="submit" x-large>LOG IN</v-btn>
											</v-row>
											<?php if($this->session->flashdata('success')){ ?>
												<v-alert type="success" dismissible>
													<?php echo $this->session->flashdata('success'); ?>
												</v-alert>
											<?php } ?>
											<?php if($this->session->flashdata('disconnect')){ ?>
												<v-alert type="error" dismissible>
													<?php echo $this->session->flashdata('disconnect'); ?> <a class="close" data-dismiss="alert" href="#">×</a>
												</v-alert>
											<?php } ?>
											<?php if(validation_errors()){
												echo validation_errors('<v-alert type="error" dismissible>', ' </v-alert>');
											} ?>
										</v-form>
										<div class="register d-flex flex-column flex-sm-row align-items-center justify-content-center mt-8 mb-6 mx-auto">
											<span class="text mr-sm-2">Don't have an account?</span>
											<a class="link text-secondary" href="<?php echo site_url('registration'); ?>">Create an account</a>
										</div>
									</v-card-text>
									<v-card-actions>

									</v-card-actions>
								</v-card>
								<v-dialog v-model="dialog_remindpassword" width="800">
									<v-card>
										<v-card-title class="headline green lighten-2 white--text" primary-title>
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
											<v-btn color="success" flat @click="f_remindPassword()">Save</v-btn>
											<v-btn color="error" flat @click="dialog_remindpassword = false">Close</v-btn>
										</v-card-actions>
									</v-card>
								</v-dialog>
								<v-dialog v-model="dialog_resetpassword" width="800">
									<v-card>
										<v-card-title class="headline green lighten-2 white--text" primary-title>
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
											<v-btn color="success" flat @click="f_resetPassword()">Save</v-btn>
											<v-btn color="error" flat @click="dialog_remindpassword = false">Close</v-btn>
										</v-card-actions>
									</v-card>
								</v-dialog>
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
				dialog_remindpassword: false,
				dialog_resetpassword: false,
				email_reset: '',
				code_reset: '',
				currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
				show_password: false,
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
	</body>
</html>