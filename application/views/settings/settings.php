<?php $this->load->view('include/header.php'); ?>
	<div class="content custom-scrollbar">
		<div class="page-layout simple full-width">
			<div class="page-content">

				<section id="main-content">
					<section class="wrapper">

					<div class="row">
						<div class="col-md-12">
							<section class="card mb-3">
								<header class="card-header">
									Advanced File Input
								</header>
								<div class="card-body">
					<li class="dropdown language">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
							<?php 
							switch ($this->session->userdata('language')) {
								case "english":
									echo "<img alt=\"\" src=".img_url('flags/us.png').">&nbsp;<span class=\"username\">English</span>";
									break;
								case "french":
									echo "<img alt=\"\" src=".img_url('flags/fr.png').">&nbsp;<span class=\"username\">Français</span>";
									break;
								case "italy":
									echo "<img alt=\"\" src=".img_url('flags/it.png').">&nbsp;<span class=\"username\">Italiano</span>";
									break;
								case "spanish":
									echo "<img alt=\"\" src=".img_url('flags/es.png').">&nbsp;<span class=\"username\">Español</span>";
									break;
								case "germany":
									echo "<img alt=\"\" src=".img_url('flags/de.png').">&nbsp;<span class=\"username\">Deutch</span>";
									break;
								case "russian":
									echo "<img alt=\"\" src=".img_url('flags/ru.png').">&nbsp;<span class=\"username\">Български</span>";
									break;
							}
							?>
							<b class="caret"></b>
						</a>
						<ul class="dropdown-menu">
							<?php 
							switch ($this->session->userdata('language')) {
								case "english":
									echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
									echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
									echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
									echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
									echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
									break;
								case "french":
									echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
									echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
									echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
									echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
									echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
									break;
								case "italy":
									echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
									echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
									echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
									echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
									echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
									break;
								case "spanish":
									echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
									echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
									echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
									echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
									echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
									break;
								case "germany":
									echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
									echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
									echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
									echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
									echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
									break;
								case "russian":
									echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
									echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
									echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
									echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
									echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
									break;
							}
							?>
						</ul>
					</li>
									<form action="#" class="form-horizontal ">
										<div class="form-group last">
											<label class="control-label col-md-3">Image Upload</label>
											<div class="col-md-9">
												<div class="fileupload fileupload-new" data-provides="fileupload">
													<input type="text" class="form-control">
													<div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
														<img src="" alt="" />
													</div>
													<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
													<div>
															   <span class="btn btn-white btn-file">
															   <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>
															   <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
															   <input type="file" class="default" />
															   </span>
														<a class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
													</div>
												</div>
												<div>
													<span class="label label-danger">NOTE!</span>
													<span>
													 Attached image thumbnail is
													 supported in Latest Firefox, Chrome, Opera,
													 Safari and Internet Explorer 10 only
													</span>
												</div>
												<button type="submit" class="btn btn-info">Submit</button>
											</div>
										</div>

									</form>
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
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
		data : {
			sidebar:"administration",
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
<?php $this->load->view('include/footer.php'); ?>