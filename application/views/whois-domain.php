<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('whois_domain'); ?></h2>
	</div>
	<div class="page-content">
	  <section id="main-content">
		  <section class="wrapper">

		  <div class="row">
			  <div class="col-sm-12">
				  <section class="card mb-3">
					  <header class="card-header">
						<span class="tools pull-right">


							  <div class="dropdown">
								<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								  <?php echo lang('type'); ?>
								</button>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								  <a class="dropdown-item" id="button-whois-calendar" href="javascript:;"><?php echo lang('calendar'); ?></a>
								  <a class="dropdown-item" id="button-whois-list" href="javascript:;"><?php echo lang('list'); ?></a>
								</div>
							  </div>

							<div class="btn-group pull-right">
							  <a href="javascript:;" id="load-refresh-whois" class="btn btn-primary" role="button" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading ...">Refresh</a>
							</div>
						   </span>
					  </header>
					  <div class="card-body">
						  <div class="whois-list">
							  <div class="clearfix">
								  <div class="btn-group">
									  <h4><?php echo lang('domain_name_included'); ?> : .com, .net, .ca, .org, .za, .uk, .ie, .paris, .ovh, .fr, .re, .pf, .nc, .it, .pt, .se, .fi, .ru, .cn, .jp, .dk, .pl, .cz</h4>
								  </div>

							  </div>

								<template>
									<v-data-table
										:headers="headers"
										:items="list_whois"
										class="elevation-1"
									>
										<template slot="items" slot-scope="props">
											<td>{{ props.item.name_whois }}</td>
											<td class="text-xs-left" v-html="props.item.website">{{ props.item.website }}</td>
											<td class="text-xs-left">{{ props.item.hosting }}</td>
											<td class="text-xs-left">{{ props.item.date_delivery }}</td>
											<td class="text-xs-left">{{ props.item.date_expiration }}</td>
											<td class="text-xs-left" v-html="props.item.whois">{{ props.item.whois }}</td>
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
				  </section>
			  </div>
		  </div>
		  </section>
	  </section>
	</div>
  </div>
</div>
	  <div class="modal fade" id="view-whois" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header modal-header-success">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			  <h4 class="modal-title custom_align" id="Heading">Afficher Whois</h4>
			</div>
			<div class="modal-body">
			  <form id="acces-ftp" class="form-horizontal" role="form" action="#">
				<fieldset>
				 <table class="table table-striped table-hover table-bordered table-dashboard" id="table-ftp-dashboard">
					  <thead>
					  </thead>
					  <tbody>

					  </tbody>
				  </table>
				</fieldset>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
	el: '#app',
	data : {
		currentRoute: window.location.href,
		headers: [
			{ text: 'Nom', value: 'name_whois'},
			{ text: 'Site Web', value: 'website' },
			{ text: 'Hebergeur', value: 'hosting'},
			{ text: 'Date de mise en ligne', value: 'date_delivery'},
			{ text: 'Date d\'expiration', value: 'date_expiration'},
			{ text: 'Whois', value: 'whois'},
		],
        list_whois: [],
    },
    created(){
		this.displayPage();
    },
    methods:{
    	displayPage(){
    		axios.get(this.currentRoute+"/ajaxWhois/").then(function(response){
				if(response.status = 200){
					v.list_whois = response.data;
				}else{

				}
			})
        },
    }
})
  $(document).ready(function(){
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
	$( "#button-whois-calendar" ).click(function() {
	  $( ".whois-list" ).hide(  );
	  $( "#calendar" ).show(  );
	  $.ajax({
		type: "POST",
		url: window.location.href+'/ajaxCalendarWhois/',
		success: function(data){
		  $( "#calendar" ).empty();
		  var dataWhoisWebsite = JSON.parse(data);
		  $('#calendar').fullCalendar({
			  header: {
				  left: 'prev,next today',
				  center: 'title',
				  right: 'year,month,basicWeek,basicDay'
			  },
			  height: 610,
			  editable: false,
			  droppable: true, // this allows things to be dropped onto the calendar !!!
			  drop: function(date, allDay) { // this function is called when something is dropped

				  // retrieve the dropped element's stored Event Object
				  var originalEventObject = $(this).data('eventObject');

				  // we need to copy it, so that multiple events don't have a reference to the same object
				  var copiedEventObject = $.extend({}, originalEventObject);

				  // assign it the date that was reported
				  copiedEventObject.start = date;
				  copiedEventObject.allDay = allDay;

				  // render the event on the calendar
				  // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
				  $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

				  // is the "remove after drop" checkbox checked?
				  if ($('#drop-remove').is(':checked')) {
					  // if so, remove the element from the "Draggable Events" list
					  $(this).remove();
				  }

			  },
			  events: dataWhoisWebsite
		  });
		},
		error: function(){
		  alert("failure");
		}
	  });
	});
	$( "#button-whois-list" ).click(function() {
	  $( ".whois-list" ).show(  );
	  $( "#calendar" ).hide(  );
	});
  });
</script>
<?php $this->load->view('include/footer.php'); ?>