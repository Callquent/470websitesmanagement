<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-content">

	  <v-container fluid grid-list-sm>
	    <v-layout row wrap>
			<v-flex xs12>
		  		<v-card>
	                <template>
						<v-data-table
						    :headers="headers"
						    :items="list_projects"
						    class="elevation-1"
						    :items-per-page="-1"
							:footer-props="{
							'items-per-page-options': [10, 20, 30, 40, 50]
							}"
						>
						    <template v-slot:item.name_website="props">
						    	{{ props.item.name_website }}
						    </template>
						    <template v-slot:item.name_project_tasks="props">
						        {{ props.item.name_project_tasks }}
						    </template>
						    <template v-slot:item.started_project_tasks="props">
						        {{ props.item.started_project_tasks }}
						    </template>
						    <template v-slot:item.deadline_project_tasks="props">
						        {{ props.item.deadline_project_tasks }}
						    </template>
						    <template v-slot:item.status="props">
									<span v-if="props.item.percentage_tasks == '100'" class="badge badge-success">Success</span>
									<span v-else class="badge badge-warning">In progress</span>
						    </template>
						    <template v-slot:item.progress="props">
						        	<div class="progress">
										  <div class="progress-bar" role="progressbar" :style="{width: props.item.percentage_tasks + '%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ props.item.percentage_tasks }}%
										  </div>
									</div>
							</template>
						    <template v-slot:item.actions="props">
								<v-menu bottom left>
									<template v-slot:activator="{ on }">
										<v-btn icon v-on="on" color="grey darken-1">
											<v-icon>mdi-dots-vertical</v-icon>
										</v-btn>
									</template>
									<v-divider></v-divider>
									<v-list>
										<v-list-item :href="currentRoute+'/'+props.item.id_project_tasks">
											<v-list-item-title id="view-project" >View</v-list-item-title>
										</v-list-item>
										<v-list-item @click="f_dialog_editProject(props.item)">
											<v-list-item-title id="edit-project" ><?php echo lang('edit') ?></v-list-item-title>
										</v-list-item>
										<v-list-item @click="f_deleteProject(props.item)">
											<v-list-item-title id="delete-project"><?php echo lang('delete') ?></v-list-item-title>
										</v-list-item>
									</v-list>
								</v-menu>
						    </template>
						</v-data-table>
	                </template>
	            </v-card>
	      </v-flex>
	    </v-layout>
	  </v-container>

	</div>
  </div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
		data : {
			sidebar:"projects",
			currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
	        headers: [
	        	{ text: '<?php echo lang('website'); ?>', value: 'url_website' },
				{ text: '<?php echo lang('name'); ?>', value: 'name_website' },
				{ text: 'Started on', value: 'started_project_tasks' },
				{ text: 'Deadline', value: 'deadline_project_tasks' },
				{ text: 'Status', value: 'status' },
				{ text: 'Progress', value: 'progress' },
	            { text: '<?php echo lang("actions"); ?>', value: 'actions'},
	        ],
	        list_projects: <?php echo json_encode($all_projects->result_array()); ?>,

		},
		mixins: [mixin],
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