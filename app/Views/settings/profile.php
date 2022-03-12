<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header light-fg d-flex flex-column justify-content-center justify-content-lg-end p-6">
		<div class="flex-column row flex-lg-row align-items-center align-items-lg-end no-gutters justify-content-between">
			<div class="user-info flex-column row flex-lg-row no-gutters align-items-center">
				<img class="profile-image avatar huge mr-6" src="<?php echo img_url('users/profile.jpg'); ?>">
				<div class="name h2 my-6"><?php echo $user->username; ?></div>
				<div class="permission my-6"><?php echo $user_role[0]->name; ?></div>
			</div>
			<div class="actions row align-items-center no-gutters">
				<a href="mailto:<?php echo $user->email; ?>" class="btn btn-secondary ml-2 fuse-ripple-ready" aria-label="Send Message">Send Message</a>
			</div>
		</div>
	</div>
  <div class="page-content">

	  <section id="main-content">
		  <section class="wrapper">
		  <div class="row">
			  <div class="col-md-12">
				  <section class="card mb-3">
					  <div class="card-body profile-information">
						 <div class="col-md-3">
							 <div class="profile-pic text-center">
							 </div>
						 </div>
						 <div class="col-md-6">
							 <div class="profile-desk">
								 <h1><?php echo $user->username; ?></h1>
								 <span class="text-muted"><?php echo lang('date_create_profile'); ?><?php echo $user->date_created; ?></span>
								<div class="change-password">
									<v-card-text>
										<v-container>
											<v-row>
												<v-col cols="12" sm="12" md="12">
													<v-text-field v-model="new_password" label="<?php echo lang("enter_new_password"); ?>" type="password"></v-text-field>
												</v-col>
											</v-row>
										</v-container>
									</v-card-text>
									<v-card-actions>
										<div class="flex-grow-1"></div>
										<v-btn color="success" flat @click="f_changePassword()"><?php echo lang('modify'); ?></v-btn>
									</v-card-actions>
									<?php if($this->session->flashdata('success')){ ?>
									<div class="alert alert-success">
									  <?php echo $this->session->flashdata('success'); ?> <a class="close" data-dismiss="alert" href="#">×</a>
									</div>
									<?php } ?>
								</div>
							 </div>
						 </div>
						 <div class="col-md-3">
							 <div class="profile-statistics">
								 <h1><?php echo lang('email'); ?></h1>
								 <p><a href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?></a></p>
								 <h1><?php echo lang('permission'); ?></h1>
								 <p><?php echo $user_role[0]->name; ?></p>
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
<div id="message">
	<v-snackbar v-model="message.success" color="success" :timeout="message.timeout" top right><?php echo lang('your_password_modify'); ?></v-snackbar>
	<v-snackbar v-model="message.error" color="error" :timeout="message.timeout" :top="message.y" :left="message.x"><?php echo lang('website_registered'); ?></v-snackbar>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
    var v = new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data : {
			sidebar:"general",
			currentRoute: window.location.href,
			new_password: "",
			message:{
				success: false,
				error: false,
				timeout: 6000,
			},
        },
        mixins: [mixin],
        created(){
            this.displayPage();
        },
        methods:{
            displayPage(){

            },
            f_changePassword(){
                var formData = new FormData(); 
                formData.append("new_password",v.new_password);
                axios.post(this.currentRoute+"/change-password/", formData).then(function(response){
                    if(response.status = 200){
						v.message.success = true;
					} else {
						v.message.error = true;
	                }
                })
            }
        }
    });
</script>
<?php $this->load->view('include/footer.php'); ?>