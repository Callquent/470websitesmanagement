<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">

	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between" v-if="display_table_whois">
		<h2 class="doc-title" id="content"><?php echo lang('whois_domain'); ?></h2>
		<div class="toolbar row no-gutters align-items-center">
			<button @click="f_whoisCalendar" id="calendar-today-button" type="button" class="btn btn-icon fuse-ripple-ready" aria-label="Today">
				<i class="icon icon-calendar-today"></i>
			</button>
			<button  @click="displayPage" type="button" class="btn btn-icon change-view fuse-ripple-ready" data-view="agendaWeek" aria-label="Week">
				<i class="icon icon-view-week"></i>
			</button>
		</div>
	</div>
	<div class="page-header bg-secondary text-auto p-6" v-else>
		<div class="header-content d-flex flex-column justify-content-between">
			<div class="header-top d-flex flex-column flex-sm-row align-items-center  justify-content-center justify-content-sm-between">
				<div class="logo row align-items-center no-gutters mb-4 mb-sm-0">
					<i class="logo-icon icon-calendar-today mr-4"></i>
					<span class="logo-text h4">Calendar</span>
				</div>
				<div class="toolbar row no-gutters align-items-center">
					<button @click="f_whoisCalendar" id="calendar-today-button" type="button" class="btn btn-icon fuse-ripple-ready" aria-label="Today">
						<i class="icon icon-calendar-today"></i>
					</button>
					<button @click="displayPage" type="button" class="btn btn-icon change-view fuse-ripple-ready" data-view="agendaWeek" aria-label="Week">
						<i class="icon icon-view-week"></i>
					</button>
				</div>
			</div>
			<div class="header-bottom row align-items-center justify-content-center">
				<button id="calendar-previous-button" type="button" class="btn btn-icon fuse-ripple-ready" aria-label="Previous" @click="$refs.calendar.prev()">
					<i class="icon icon-chevron-left"></i>
				</button>
				<div id="calendar-view-title" class="h5">{{ calendar.date }}</div>
				<button id="calendar-next-button" type="button" class="btn btn-icon fuse-ripple-ready" aria-label="Next" @click="$refs.calendar.next()">
					<i class="icon icon-chevron-right"></i>
				</button>
			</div>
		</div>
	</div>



	<div class="page-content">
	  <section id="main-content">
		  <section class="wrapper">

		  <div class="row">
			  <div class="col-sm-12">
				  <section class="card mb-3">
					  <div class="card-body">
						  <div class="whois-list" v-if="display_table_whois">
								<h4><?php echo lang('domain_name_included'); ?> : .com, .net, .ca, .org, .za, .uk, .ie, .paris, .ovh, .fr, .re, .pf, .nc, .it, .pt, .se, .fi, .ru, .cn, .jp, .dk, .pl, .cz</h4>
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
											<td class="text-xs-left"><a @click="f_dialog_Whois(props.item)"><i class="icon icon-eye"></i></a></td>
											<td class="text-xs-left"><a @click="f_whoisRefreshDomain(props.item)"><i class="icon icon-refresh"></i></a></td>
										</template>
									</v-data-table>
								</template>
						  </div>

						  <div class="row whois-calendar" v-else>






					<div id="calendar" class="page-layout simple full-width">


						<!-- CONTENT -->
						<div class="page-content p-6">
							<v-layout wrap>
								<v-flex xs12 class="mb-3">
									<v-sheet height="500">
										<v-calendar
											ref="calendar"
											v-model="calendar.date"
											:now="calendar.today"
											:value="calendar.today"
											color="primary"
										  >
											<template
											  slot="day"
											  slot-scope="{ date }"
											>
											  <template v-for="event in eventsMap[date]">
												<v-menu
												  :key="event.title"
												  v-model="event.open"
												  full-width
												  offset-x
												>
												  <div
													v-if="!event.time"
													slot="activator"
													v-ripple
													class="my-event"
													v-html="event.title"
												  ></div>
												  <v-card
													color="grey lighten-4"
													min-width="350px"
													flat
												  >
													<v-toolbar
													  color="primary"
													  dark
													>
													  <v-btn icon>
														<v-icon>edit</v-icon>
													  </v-btn>
													  <v-toolbar-title v-html="event.title"></v-toolbar-title>
													  <v-spacer></v-spacer>
													  <v-btn icon>
														<v-icon>favorite</v-icon>
													  </v-btn>
													  <v-btn icon>
														<v-icon>more_vert</v-icon>
													  </v-btn>
													</v-toolbar>
													<v-card-title primary-title>
													  <span v-html="event.details"></span>
													</v-card-title>
													<v-card-actions>
													  <v-btn
														flat
														color="secondary"
													  >
														Cancel
													  </v-btn>
													</v-card-actions>
												  </v-card>
												</v-menu>
											  </template>
											</template>
										</v-calendar>
									</v-sheet>
								</v-flex>
							</v-layout>
						</div>
					</div>





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
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
	el: '#app',
	data : {
		dialog_whois: false,
		registar_whois: '',
		display_table_whois: true,
		currentRoute: window.location.href,
		headers: [
			{ text: 'Nom', value: 'name_whois'},
			{ text: 'Site Web', value: 'website' },
			{ text: 'Hebergeur', value: 'hosting'},
			{ text: 'Date de mise en ligne', value: 'date_delivery'},
			{ text: 'Date d\'expiration', value: 'date_expiration'},
			{ text: 'Whois', value: 'whois'},
			{ text: 'Refresh', value: 'refresh'},
		],
		list_whois: [],
		calendar: {
			today:  '<?php echo date("Y-m-d"); ?>',
			date:  '<?php echo date("Y-m-d"); ?>',
			events: [],
		},
	},
	computed: {
	  // convert the list of events into a map of lists keyed by date
	  eventsMap () {
		const map = {}
		this.calendar.events.forEach(e => (map[e.date] = map[e.date] || []).push(e))
		return map
	  }
	},
	created(){
		this.displayPage();
	},
	methods:{
		displayPage(){
			axios.get(this.currentRoute+"/ajaxWhois/").then(function(response){
				if(response.status = 200){
					v.list_whois = response.data;
					v.display_table_whois = true;
				}else{

				}
			})
		},
		f_whoisCalendar(){
			axios.get(this.currentRoute+"/ajaxCalendarWhois/").then(function(response){
				if(response.status = 200){
					v.calendar.events = response.data;
					v.display_table_whois = false;
				}else{

				}
			})
		},
		f_whoisRefreshDomain(item){
			var editedIndex = this.list_whois.indexOf(item);
			var formData = new FormData(); 
			formData.append("id_whois",item.id_whois);
			formData.append("url_website",item.website);
			axios.post(this.currentRoute+"/ajaxRefreshDomain/", formData).then(function(response){
				if(response.status = 200){
					Object.assign(v.list_whois[editedIndex], response.data);
				}else{

				}
			})
		},
		f_dialog_Whois(item){
			v.dialog_whois = true;
			v.registar_whois = item.whois;
		},
	}
})
</script>
<?php $this->load->view('include/footer.php'); ?>