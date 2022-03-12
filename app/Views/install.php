<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow"  />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php echo css_url('css/perfect-scrollbar.min.css'); ?>
		<?php echo css_url('plugins/vuetify/vuetify.css'); ?>
		<?php echo css_url('css/style.css'); ?>
		<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
		<?php echo css_url('css/materialdesignicons.min.css'); ?>
		<link rel="shortcut icon" href="<?php echo img_url('app/favicon-470websitesmanagement-32x32.png'); ?>" />
	</head>
	<body class="lock-screen layout layout-vertical layout-left-navigation layout-below-toolbar media-step-xl">
		<main>
			<div id="app">
				<v-app>
					<v-container fluid fill-height>
						<v-layout align-center justify-center>
							<v-row>
								<v-col cols="12">
									<v-row align="center" justify="center">
										<v-img
										max-width="145"
										aspect-ratio="1"
										src="<?php echo img_url('app/logo-470websitesmanagement.svg'); ?>"
										>
										</v-img>
									</v-row>
								</v-col>
								<v-col cols="12">
									<template>
									  <div>
										<v-stepper v-model="stepper_install">
										  <v-stepper-header>
											<template v-for="n in steps">
												<v-stepper-step :step="n">	Step {{ n }}</v-stepper-step>
												<v-divider v-if="n !== steps"></v-divider>
											</template>
										  </v-stepper-header>

										  <v-stepper-items>
											<v-stepper-content step="1">
												<h2>First Step</h2>
												<section>
													<form class="form-horizontal form-step1" method="post" id="loginform">
														<v-row>
															<v-col cols="4">
																<v-subheader>Database Name</v-subheader>
															</v-col>
															<v-col cols="8">
																<v-text-field type="text" v-model="newDatabase.database_name" label="Database Name"></v-text-field>
															</v-col>
														</v-row>
														<v-row>
															<v-col cols="4">
																<v-subheader>Database Username</v-subheader>
															</v-col>
															<v-col cols="8">
																<v-text-field type="text" v-model="newDatabase.database_username" label="Database Username"></v-text-field>
															</v-col>
														</v-row>
														<v-row>
															<v-col cols="4">
																<v-subheader>Database Password</v-subheader>
															</v-col>
															<v-col cols="8">
																<v-text-field type="text"  v-model="newDatabase.database_password" label="Database Password"></v-text-field>
															</v-col>
														</v-row>
														<v-row>
															<v-col cols="4">
																<v-subheader>Database Host</v-subheader>
															</v-col>
															<v-col cols="8">
																<v-text-field type="text"  v-model="newDatabase.database_host" label="Database Host"></v-text-field>
															</v-col>
														</v-row>
														</form>
												</section>

											  <v-btn
												color="primary"
												@click="f_stepOne"
											  >
												Continue
											  </v-btn>

											  <v-btn text>Cancel</v-btn>
											</v-stepper-content>
											<v-stepper-content step="2">
												<h2>Second Step</h2>
												<section>
													<form class="form-horizontal form-step2" method="post" id="loginform">
														<v-row>
															<v-col cols="4">
																<v-subheader>Username</v-subheader>
															</v-col>
															<v-col cols="8">
																<v-text-field type="text" v-model="newUser.username" label="Username"></v-text-field>
															</v-col>
														</v-row>
														<v-row>
															<v-col cols="4">
																<v-subheader>Email</v-subheader>
															</v-col>
															<v-col cols="8">
																<v-text-field type="email" v-model="newUser.email" label="Email"></v-text-field>
															</v-col>
														</v-row>
														<v-row>
															<v-col cols="4">
																<v-subheader>Password</v-subheader>
															</v-col>
															<v-col cols="8">
																<v-text-field type="text" v-model="newUser.password" label="Password"></v-text-field>
															</v-col>
														</v-row>
													</form>
												</section>
											  <v-btn
												color="primary"
												@click="f_stepTwo"
											  >
												Continue
											  </v-btn>

											  <v-btn text>Cancel</v-btn>
											</v-stepper-content>
											<v-stepper-content step="3">
												<h2>Third Step</h2>
												<section>
													<p>Welcome to 470WEBSITESMANAGEMENT</p>
												</section>
											  <v-btn
												color="primary"
												@click="f_stepThree"
											  >
												Continue
											  </v-btn>

											  <v-btn text>Cancel</v-btn>
											</v-stepper-content>
										  </v-stepper-items>
										</v-stepper>
									  </div>
									</template>
								</v-col>
							</v-row>
						</v-layout>
					</v-container>
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
				currentRoute: window.location.href,
				stepper_install: 1,
				steps: 3,
				newDatabase:{
					database_name:"",
					database_username:"",
					database_password:"",
					database_host:"localhost",
				},
				newUser:{
					username:"",
					email:"",
					password:"",
				},
			},
			created(){
				this.displayPage();
			},
			methods:{
				displayPage(){

				},
				f_stepOne(){
					var formData = new FormData();
					formData.append("database_name",v.newDatabase.database_name);
					formData.append("database_username",v.newDatabase.database_username);
					formData.append("database_password",v.newDatabase.database_password);
					formData.append("database_host",v.newDatabase.database_host);
					axios.post(this.currentRoute+"index.php/install/step1/", formData).then(function(response){
						if(response.status = 200){
							v.stepper_install = 2;
						}
					})
				},
				f_stepTwo(){
					var formData = new FormData();
					formData.append("username",v.newUser.username);
					formData.append("email",v.newUser.email);
					formData.append("password",v.newUser.password);
					axios.post(this.currentRoute+"index.php/install/step2/", formData).then(function(response){
						if(response.status = 200){
							v.stepper_install = 3;
						}
					})
				},
				f_stepThree(){
					axios.get(this.currentRoute+"index.php/install/step3/").then(function(response){
						if(response.status = 200){
							location.reload();
						}
					})
				},
			}
		});
	</script>
	</body>
</html>