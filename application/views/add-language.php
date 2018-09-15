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
							  Ajouter un langage
						  </header>
						  <div class="card-body">
							  <div class=" form">
								  <form class="form-horizontal " id="form-add-language" method="post" action="<?php echo site_url('/add-language/submit'); ?>">
									<div class="row-fluid">
									  <h4 class=""><?php echo lang('general_information'); ?></h4>
									  <hr>
									  <div class="form-group ">
										  <label for="cname" class="control-label col-lg-3"><?php echo lang('name_add_language'); ?></label>
										  <div class="col-lg-6">
											<input class="form-control" type="text" name="language" placeholder="Language" required />
										  </div>
									  </div>
									</div>
									<div class="form-group">
										<div class="col-lg-offset-3 col-lg-6">
											<button class="btn btn-primary" type="submit"><?php echo lang('save'); ?></button>
											<button class="btn btn-default" type="button"><?php echo lang('cancel'); ?></button>
										</div>
									</div>
								  </form>
								  <div id="results">
									  <div class="alert alert-success alert-block"><h4><i class="icon-ok-sign"></i><?php echo lang('language_registered'); ?></h4></div>
									  <div class="alert alert-danger alert-block"><h4><i class="icon-ok-sign"></i><?php echo lang('language_not_registered'); ?></h4></div>
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
	$("#form-add-language").submit(function(e){
	  $.ajax({
		type: "POST",
		url: $(this).attr('action'),
		data:$(this).serialize(),
		success: function(msg){
		  console.log(msg);
		  $("#form-add-language").fadeOut('slow');
		  $('#results .alert-success').fadeIn('fast');
		  setTimeout(function() {
			$('#results .alert-success').fadeOut('slow');
			$("#form-add-language").find("input[type=text], textarea").val("");
			$("#form-add-language").fadeIn('slow');
		  }, 3000 );
		},
		error: function(msg){
		  console.log(msg);
		  $("#form-add-language").fadeOut('slow');
		  $('#results .alert-danger').fadeIn('fast');
		  setTimeout(function() {
			$('#results .alert-danger').fadeOut('slow');
			$("#form-add-language").find("input[type=text], textarea").val("");
			$("#form-add-language").fadeIn('slow');
		  }, 3000 );
		}
	  });
	  e.preventDefault();
	});
  });
</script>
<?php $this->load->view('include/footer.php'); ?>