<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('dashboard'); ?></h2>
	</div>
	<div class="page-content">
	  <section id="main-content" >
		  <section class="wrapper">

		  <div class="row">
			  <div class="col-sm-12">
				  <section class="card mb-3">
					  <header class="card-header">
						  <?php echo lang('dashboard'); ?>
					  </header>
					  <div class="card-body">
						<div class="row">
							<div class="col-sm-6">
								<section class="card mb-3">
									<header class="card-header">
									  <h4><?php echo lang('website_per_languages'); ?></h4>
									</header>
									<div class="card-body">
										<div id="pie-chart-language" style="height: 400px;">
											<svg></svg>
										</div>
									</div>
								</section>
							</div>
							<div class="col-sm-6">
								<section class="card mb-3">
									<header class="card-header">
									  <h4><?php echo lang('website_per_categories'); ?></h4>
									</header>
									<div class="card-body">
										<div id="pie-chart-category" style="height: 400px;">
											<svg></svg>
										</div>
									</div>
								</section>
							</div>
						</div>
					  <div class="card-body">
						  <div class="whois-list">
								<template>
									<v-data-table
										:headers="headers"
										:items="list_whois"
										class="elevation-1"
									>
										<template v-slot:item.name_whois="props">
											{{ props.item.name_whois }}
										</template>
										<template v-slot:item.website="props">
											{{ props.item.website }}
										</template>
										<template v-slot:item.hosting="props">
											{{ props.item.hosting }}
										</template>
										<template v-slot:item.date_delivery="props">
											{{ props.item.date_delivery }}
										</template>
										<template v-slot:item.date_expiration="props">
											{{ props.item.date_expiration }}
										</template>
										<template v-slot:item.whois="props">
											<v-btn @click="f_dialog_Whois(props.item)" icon color="grey darken-1">
												<v-icon>mdi-eye</v-icon>
											</v-btn>
										</template>
									</v-data-table>
								</template>
						  </div>

						  <div class="row whois-calendar">
							  <aside class="col-lg-12">
									<div id="calendar" class="has-toolbar"></div>
							  </aside>
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
<v-dialog v-model="dialog_whois" width="800">
	<v-card>
		<v-card-title class="headline green lighten-2" primary-title>
			<?php echo lang('whois'); ?>
		</v-card-title>

		<v-card-text>
			<v-container grid-list-md>
				<v-layout wrap>
					<v-flex xs12>
						<pre>{{ registar_whois }}</pre>
					</v-flex>
				</v-layout>
			</v-container>
			<small>*indicates required field</small>
		</v-card-text>
	</v-card>
</v-dialog>
			</div>
		</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
		data : {
			sidebar:"general",
			dialog_whois: false,
			registar_whois: '',
			currentRoute: window.location.href,
			headers: [
				{ text: 'Nom', value: 'name_whois'},
				{ text: 'Site Web', value: 'website' },
				{ text: 'Hebergeur', value: 'hosting'},
				{ text: 'Date de mise en ligne', value: 'date_delivery'},
				{ text: 'Date d\'expiration', value: 'date_expiration'},
				{ text: 'Whois', value: 'whois'},
			],
			list_whois: <?php echo json_encode($all_whois_renew_tomonth->result_array()); ?>,
		},
		mixins: [mixin],
		created(){

		},
		methods:{

		}
	});
</script>
<script type="text/javascript">
  var pieDataLanguage = JSON.parse('<?php echo $chart_language; ?>');
  var pieDataCategory = JSON.parse('<?php echo $chart_category; ?>');

  $(document).ready(function(){
	var pieChartLanguage = {
		options: {
			chart: {
				type              : 'pieChart',
				height            : 400,
				x                 : function (d)
				{
					return d.key;
				},
				y                 : function (d)
				{
					return d.y;
				},
				showLabels        : true,
				transitionDuration: 500,
				labelThreshold    : 0.01,
				legend            : {
					margin: {
						top   : 5,
						right : 35,
						bottom: 5,
						left  : 0
					}
				}
			}
		},
		data   : pieDataLanguage
	};
	var pieChartCategory = {
		options: {
			chart: {
				type              : 'pieChart',
				height            : 400,
				x                 : function (d)
				{
					return d.key;
				},
				y                 : function (d)
				{
					return d.y;
				},
				showLabels        : true,
				transitionDuration: 500,
				labelThreshold    : 0.01,
				legend            : {
					margin: {
						top   : 5,
						right : 35,
						bottom: 5,
						left  : 0
					}
				}
			}
		},
		data   : pieDataCategory
	};

	nv.addGraph(function ()
	{
		var chart = nv.models.pieChart()
			.options({
				type              : 'pieChart',
				height            : 400,
				x                 : function (d)
				{
					return d.key;
				},
				y                 : function (d)
				{
					return d.y;
				},
				showLabels        : true,
				transitionDuration: 500,
				labelThreshold    : 0.01
			});

		chart.legend.margin({
				top   : 5,
				right : 35,
				bottom: 5,
				left  : 0
			}
		);

		var chartlanguage = d3.select('#pie-chart-language svg');
		var chartDataLanguage;

		initChart();

		nv.utils.windowResize(chart.update);

		function initChart()
		{
			chartDataLanguage = pieChartLanguage.data;
			chartlanguage.datum(chartDataLanguage).call(chart);
		}

		return chart;
	});
	nv.addGraph(function ()
	{
		var chart = nv.models.pieChart()
			.options({
				type              : 'pieChart',
				height            : 400,
				x                 : function (d)
				{
					return d.key;
				},
				y                 : function (d)
				{
					return d.y;
				},
				showLabels        : true,
				transitionDuration: 500,
				labelThreshold    : 0.01
			});

		chart.legend.margin({
				top   : 5,
				right : 35,
				bottom: 5,
				left  : 0
			}
		);

		var chartcategory = d3.select('#pie-chart-category svg');
		var chartDataCategory;

		initChart();

		nv.utils.windowResize(chart.update);

		function initChart()
		{
			chartDataCategory = pieChartCategory.data;
			chartcategory.datum(chartDataCategory).call(chart);
		}

		return chart;
	});

	  $(document).on('click', '.access-whois', function(e) {
		var id = $(this).data('id');
		$.ajax({
		  type: "POST",
		  url: window.location.href+'/modal-whois/'+id,
		  success: function(data){    
			$( "#view-whois .modal-body" ).append("<pre>"+data+"</pre>");
		  },
		  error: function(){
			alert("failure");
		  }
		});
		e.preventDefault();
	  });
	  $('#view-whois').on('hide.bs.modal',function(event){
		$( "#view-whois .modal-body pre" ).remove();
	  });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>