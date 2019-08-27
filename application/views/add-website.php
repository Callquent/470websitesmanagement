<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-content">

		<section id="main-content">
			<section class="wrapper">

				<div class="row">
					<div class="col-lg-12">
						<section class="card mb-3">
							<header class="card-header">
								<?php echo lang('add_website'); ?>
							</header>
							<div class="card-body">
								<div class=" form">
									<v-form ref="form" class="form-horizontal" id="form-add-website" method="post" @submit.prevent="f_submitForm">
											<h4 class=""><?php echo lang('general_information'); ?></h4>
											<v-flex xs12 sm6 d-flex>
												<v-text-field v-model="newWebSite.name_website" label="<?php echo lang('name_add_website'); ?>"></v-text-field>
											</v-flex>
											<v-flex xs12 sm6 d-flex>
												<v-text-field v-model="newWebSite.url_website" label="<?php echo lang('url_add_website'); ?>"></v-text-field>
											</v-flex>
											<v-flex xs12 sm6 d-flex>
												<v-select v-model="newWebSite.id_category" :items="list_category" item-text="name_category" item-value="id_category" label="Choose category"></v-select>
											</v-flex>
											<v-flex xs12 sm6 d-flex>
												<v-select v-model="newWebSite.id_language" :items="list_language" item-text="name_language" item-value="id_language" label="Choose language"></v-select>
											</v-flex>

											<v-container fluid>
												<p>Voulez vous ajouter un acces FTP ?</p>
												<v-radio-group v-model="display_ftp" row>
													<v-radio label="Oui" value="true"></v-radio>
													<v-radio label="Non" value="false"></v-radio>
												</v-radio-group>
											</v-container>
											<v-container v-if="display_ftp == 'true'" fluid>
												<v-layout column>
													<v-flex xs12>
														<v-card>
															<v-card-title primary-title>
																<div>
																	<div slot="header"><?php echo lang('ftp'); ?></div>
																	<v-text-field v-model="newWebSite.host_ftp" label="<?php echo lang('host_ftp'); ?>"></v-text-field>
																	<v-text-field v-model="newWebSite.login_ftp" label="<?php echo lang('login_ftp'); ?>"></v-text-field>
																	<v-text-field v-model="newWebSite.password_ftp" label="<?php echo lang('password_ftp'); ?>"></v-text-field>
																</div>
															</v-card-title>
														</v-card>
													</v-flex>
												</v-layout>
											</v-container>

											<v-container fluid>
												<p>Voulez vous ajouter un acces Database ?</p>
												<v-radio-group v-model="display_db" row>
													<v-radio label="Oui" value="true"></v-radio>
													<v-radio label="Non" value="false"></v-radio>
												</v-radio-group>
											</v-container>
											<v-container v-if="display_db == 'true'" fluid>
												<v-layout column>
													<v-flex xs12>
														<v-card>
															<v-card-title primary-title>
																<div>
																	<div slot="header"><?php echo lang('sql'); ?></div>
																	<v-text-field v-model="newWebSite.host_sql" label="<?php echo lang('host_sql'); ?>"></v-text-field>
																	<v-text-field v-model="newWebSite.name_sql" label="<?php echo lang('name_sql'); ?>"></v-text-field>
																	<v-text-field v-model="newWebSite.login_sql" label="<?php echo lang('login_sql'); ?>"></v-text-field>
																	<v-text-field v-model="newWebSite.password_sql" label="<?php echo lang('password_sql'); ?>"></v-text-field>
																</div>
															</v-card-title>
														</v-card>
													</v-flex>
												</v-layout>
											</v-container>

											<v-container fluid>
												<p>Voulez vous ajouter un acces Backoffice ?</p>
												<v-radio-group v-model="display_bo" row>
													<v-radio label="Oui" value="true"></v-radio>
													<v-radio label="Non" value="false"></v-radio>
												</v-radio-group>
											</v-container>
											<v-container v-if="display_bo == 'true'" fluid>
												<v-layout column>
													<v-flex xs12>
														<v-card>
															<v-card-title primary-title>
																<div>
																	<div slot="header"><?php echo lang('backoffice'); ?></div>
																	<v-text-field v-model="newWebSite.host_backoffice" label="<?php echo lang('host_backoffice'); ?>"></v-text-field>
																	<v-text-field v-model="newWebSite.login_backoffice" label="<?php echo lang('login_backoffice'); ?>"></v-text-field>
																	<v-text-field v-model="newWebSite.password_backoffice" label="<?php echo lang('password_backoffice'); ?>"></v-text-field>
																</div>
															</v-card-title>
														</v-card>
													</v-flex>
												</v-layout>
											</v-container>

											<v-container fluid>
												<p>Voulez vous ajouter un acces Htaccess ?</p>
												<v-radio-group v-model="display_htaccess" row>
													<v-radio label="Oui" value="true"></v-radio>
													<v-radio label="Non" value="false"></v-radio>
												</v-radio-group>
											</v-container>
											<v-container v-if="display_htaccess == 'true'" fluid>
												<v-layout column>
													<v-flex xs12>
														<v-card>
															<v-card-title primary-title>
																<div>
																	<div slot="header"><?php echo lang('htaccess'); ?></div>
																	<v-text-field v-model="newWebSite.login_htaccess" label="<?php echo lang('login_htaccess'); ?>"></v-text-field>
																	<v-text-field v-model="newWebSite.password_htaccess" label="<?php echo lang('password_htaccess'); ?>"></v-text-field>
																</div>
															</v-card-title>
														</v-card>
													</v-flex>
												</v-layout>
											</v-container>

									  <div class="form-group">
										  <div class="col-lg-offset-3 col-lg-6">
											  <button class="btn btn-primary"><?php echo lang('save'); ?></button>
										  </div>
									  </div>
									</v-form>
									<div id="results">
										<v-snackbar v-model="message.success" color="success" :timeout="message.timeout" top right><?php echo lang('website_registered'); ?></v-snackbar>
										<v-snackbar v-model="message.error" color="error" :timeout="message.timeout" :top="message.y" :left="message.x"><?php echo lang('website_registered'); ?></v-snackbar>
										<v-alert  type="success"></v-alert>
										<v-alert v-if="message.error" type="error"><?php echo lang('website_not_registered'); ?></v-alert>
									</div>
								</div>

							</div>
						</section>
					</div>
				</div>
			</section>
		</section>
	</div>
  </div>
</div>
			</div>
		</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
		data : {
			display_ftp: 'false',
			display_db: 'false',
			display_bo: 'false',
			display_htaccess: 'false',
			currentRoute: window.location.href,
			id_website: window.location.href.split('/').pop(),
			list_category: <?php echo json_encode($all_categories->result_array()); ?>,
			list_language: <?php echo json_encode($all_languages->result_array()); ?>,
			newWebSite:{
				name_website:"",
				url_website:"",	
				id_category:"",
				id_language:"",
				host_ftp:"",
				login_ftp:"",
				password_ftp:"",
				host_db:"",
				name_db:"",
				login_db:"",
				password_db:"",
				host_bo:"",
				login_bo:"",
				password_bo:"",
				login_htaccess:"",
				password_htaccess:""
			},
			message:{
				success: false,
				error: false,
				timeout: 6000,
			},
		},
		mixins: [mixin],
		created(){

		},
		methods:{
	        f_submitForm () {
				var formData = new FormData();
				formData.append("name_website",v.newWebSite.name_website);
				formData.append("url_website",v.newWebSite.url_website);
				formData.append("id_category",v.newWebSite.id_category);
				formData.append("id_language",v.newWebSite.id_language);
				formData.append("host_ftp",v.newWebSite.host_ftp);
				formData.append("login_ftp",v.newWebSite.login_ftp);
				formData.append("password_ftp",v.newWebSite.password_ftp);
				formData.append("host_db",v.newWebSite.host_db);
				formData.append("name_db",v.newWebSite.name_db);
				formData.append("login_db",v.newWebSite.login_db);
				formData.append("password_db",v.newWebSite.password_db);
				formData.append("host_bo",v.newWebSite.host_bo);
				formData.append("login_bo",v.newWebSite.login_bo);
				formData.append("password_bo",v.newWebSite.password_bo);
				formData.append("login_htaccess",v.newWebSite.login_htaccess);
				formData.append("password_htaccess",v.newWebSite.password_htaccess);
				axios.post(this.currentRoute+"/submit/", formData).then(function(response){
					if(response.status = 200){
						v.message.success = true;
						v.$refs.form.reset();
					} else {
						v.message.error = true;
	                }
	            })
	        },
		}
	});
</script>
<?php $this->load->view('include/footer.php'); ?>