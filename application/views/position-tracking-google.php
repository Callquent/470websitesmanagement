<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-content">
		
		<section id="main-content">
			<section class="wrapper">

			<div class="row">
				<div class="col-sm-12">
					<section class="card mb-3">
						<header class="card-header">
							Editable Table
						</header>
						<div class="card-body">
							<div class="row">
								<div class="col-sm-12">
									<h4><?php echo lang('number_websites_management'); ?><?php echo $all_domains; ?> <?php echo lang('domains'); ?> <?php echo $all_subdomains; ?> <?php echo lang('sub_domains'); ?></h4>
								</div>
							</div>
							<table class="table table-striped table-hover table-bordered table-dashboard" id="table-dashboard">
								<thead>
								  <tr>
									  <th>Nom</th>
									  <th>Site Web</th>
									  <th>Adresse IP</th>
									  <th>Mots Clés</th>
									  <th>Statistiques</th>
								  </tr>
								</thead>
								<tbody>

								</tbody>
							</table>
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
	</v-app>
</div>
<?php $this->load->view('include/footer.php'); ?>