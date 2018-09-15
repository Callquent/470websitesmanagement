<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
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
									<form class="form-horizontal" id="form-add-website" method="post" action="<?php echo site_url('/add-website/submit'); ?>">
										<div class="row-fluid">
											<h4 class=""><?php echo lang('general_information'); ?></h4>
											<hr>
											<div class="col-lg-6">
											  <div class="form-group ">
												<input type="text" name="nom" class="form-control">
												<label for="cname"><?php echo lang('name_add_website'); ?></label>
											  </div>
											  <div class="form-group ">
												  <input type="text" name="url" class="form-control">
												  <label for="curl"><?php echo lang('url_add_website'); ?></label>
											  </div>
											</div>

											<div class="form-group ">
												<label for="curl" class="control-label col-lg-3"><?php echo lang('languages'); ?></label>
												<div class="col-lg-6">
												  <select name="languages" class="add-website-languages" class="form-control">
												  <?php foreach ($all_languages->result() as $row){  ?>
													  <option value="<?php echo $row->id_language; ?>"><?php echo $row->title_language; ?></option>
												  <?php } ?>
												  </select>
												</div>
											</div>
											<div class="form-group ">
												<label for="curl" class="control-label col-lg-3"><?php echo lang('categories'); ?></label>
												<div class="col-lg-6">
												  <select name="categories" class="add-website-categories" class="form-control">
												  <?php foreach ($all_categories->result() as $row){  ?>
													  <option value="<?php echo $row->id_category; ?>"><?php echo $row->title_category; ?></option>
												  <?php } ?>
												  </select>
												</div>
											</div>
										  </div>
										<div id="accordion">
										  <div class="card">
											<div class="card-header" id="headingOne">
											  <h5 class="mb-0">
												<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
												  <?php echo lang('ftp'); ?>
												</button>
											  </h5>
											</div>

											<div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
											  <div class="card-body">
												<div class="row-fluid">
													<div class="col-lg-6">
													  <div class="form-group ">
														<input type="text" name="hostftp" class="form-control">
														<label for="hostftp"><?php echo lang('host_ftp'); ?></label>
													  </div>
													  <div class="form-group ">
														  <input type="text" name="loginftp" class="form-control">
														  <label for="loginftp"><?php echo lang('login_ftp'); ?></label>
													  </div>
													  <div class="form-group ">
														  <input type="text" name="passwordftp" class="form-control">
														  <label for="passwordftp"><?php echo lang('password_ftp'); ?></label>
													  </div>
													</div>
												</div>
											  </div>
											</div>
										  </div>
										  <div class="card">
											<div class="card-header" id="headingTwo">
											  <h5 class="mb-0">
												<button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
												  <?php echo lang('sql'); ?>
												</button>
											  </h5>
											</div>
											<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
											  <div class="card-body">
												  <div class="row-fluid">
													<div class="form-group">
														<input type="text" name="hostsql" class="form-control">
														<label for="hostsql"><?php echo lang('host_sql'); ?></label>
													</div>
													<div class="form-group ">
														<input type="text" name="namedatabase" class="form-control">
														<label for="namedatabase"><?php echo lang('name_sql'); ?></label>
													</div>
													<div class="form-group ">
													  <input type="text" name="loginsql" class="form-control">
													  <label for="loginsql"><?php echo lang('login_sql'); ?></label>
													</div>
													<div class="form-group ">
														<input type="text" name="passwordsql" class="form-control">
														<label for="passwordsql"><?php echo lang('password_sql'); ?></label>
													</div>
												  </div>
											  </div>
											</div>
										  </div>
										  <div class="card">
											<div class="card-header" id="headingThree">
											  <h5 class="mb-0">
												<button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
												  <?php echo lang('backoffice'); ?>
												</button>
											  </h5>
											</div>
											<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
											  <div class="card-body">
												  <div class="row-fluid">
													<div class="form-group ">
														<input type="text" name="adminhost" class="form-control">
														<label for="adminhost"><?php echo lang('host_backoffice'); ?></label>
													</div>
													<div class="form-group ">
														<input type="text" name="adminlogin" class="form-control">
														<label for="adminlogin"><?php echo lang('login_backoffice'); ?></label>
													</div>
													<div class="form-group ">
														<input type="text" name="adminpassword" class="form-control">
														<label for="adminpassword"><?php echo lang('password_backoffice'); ?></label>
													</div>
												  </div>
											  </div>
											</div>
										  </div>
										  <div class="card">
											<div class="card-header" id="headingFour">
											  <h5 class="mb-0">
												<button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
												  <?php echo lang('htaccess'); ?>
												</button>
											  </h5>
											</div>
											<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
											  <div class="card-body">
												  <div class="row-fluid">
													<div class="form-group ">
														<input type="text" name="loginhtaccess" class="form-control">
														<label for="loginhtaccess"><?php echo lang('login_htaccess'); ?></label>
													</div>
													<div class="form-group ">
														<input type="text" name="passwordhtaccess" class="form-control">
														<label for="passwordhtaccess"><?php echo lang('password_htaccess'); ?></label>
													</div>
												  </div>
											  </div>
											</div>
										  </div>
										</div>

									  <div class="form-group">
										  <div class="col-lg-offset-3 col-lg-6">
											  <button class="btn btn-primary" type="submit" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading ..."><?php echo lang('save'); ?></button>
											  <button class="btn btn-default" type="button"><?php echo lang('cancel'); ?></button>
										  </div>
									  </div>
									</form>
									<div id="results">
										<div class="alert alert-success alert-block"><h4><i class="icon-ok-sign"></i><?php echo lang('website_registered'); ?></h4></div>
										<div class="alert alert-danger alert-block"><h4><i class="icon-ok-sign"></i><?php echo lang('website_not_registered'); ?></h4></div>
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
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
		$("#results .alert-success").hide();
		$("#results .alert-danger").hide();
		$("#form-add-website").submit(function(e){
			$("#form-add-website button[type='submit']").button('loading');
			$.ajax({
				type: "POST",
				url: $(this).attr('action'),
				data:$(this).serialize(),
				success: function(msg){
					$("#form-add-website button[type='submit']").button('reset');
					$("#form-add-website").fadeOut('slow');
					$('#results .alert-success').fadeIn('fast');
					$('.badge-all-websites').text(parseInt($(".badge-all-websites").text())+1);

					$("badge-language-"+$('#form-add-website .add-website-languages option:selected').text()).text(parseInt($("badge-language-"+$('#form-add-website .add-website-languages option:selected').text()).text())+1);
					setTimeout(function() {
						$('#results .alert-success').fadeOut('slow');
						$("#form-add-website").find("input[type=text], textarea").val("");
						$("#form-add-website").fadeIn('slow');
					}, 3000 );
				},
				error: function(msg){
					$("#form-add-website button[type='submit']").button('reset');
					$("#form-add-website").fadeOut('slow');
					$('#results .alert-danger').fadeIn('fast');
					setTimeout(function() {
						$('#results .alert-danger').fadeOut('slow');
						$("#form-add-website").find("input[type=text], textarea").val("");
						$("#form-add-website").fadeIn('slow');
					}, 3000 );
				}
			});
			e.preventDefault();
		});
  });
</script>
<?php $this->load->view('include/footer.php'); ?>