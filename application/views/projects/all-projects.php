<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-content">

	  <v-container fluid grid-list-sm>
	    <v-layout row wrap>
	    	<v-flex xs2>
			    		
				<v-toolbar color="light-blue" dark>
					<v-toolbar-title>Project</v-toolbar-title>
				</v-toolbar>
				<v-card>
					<v-container
					fluid
					grid-list-lg
					>
						<v-layout row wrap>
							<v-flex xs12>
								<template>
									<v-text-field v-model="Project.name_project_tasks" label="Name Project"></v-text-field>
								</template>
							</v-flex>
						</v-layout>
					</v-container>
				</v-card>

				<v-toolbar color="light-blue" dark>
					<v-toolbar-title>Members</v-toolbar-title>
				</v-toolbar>
				<v-card>
					<v-container
					fluid
					grid-list-lg
					>
						<v-layout row wrap>
							<v-flex xs12>
								<template>
									<v-text-field v-model="Project.name_project_tasks" label="Name Project"></v-text-field>
								</template>
							</v-flex>
						</v-layout>
					</v-container>
				</v-card>

				<v-toolbar color="light-blue" dark>
					<v-toolbar-title>Status</v-toolbar-title>
				</v-toolbar>
				<v-card>
					<v-container
					fluid
					grid-list-lg
					>
						<v-layout row wrap>
							<v-flex xs12>
								<template>
									<v-list>
										<v-list-item>
											<v-list-item-content>
												<v-list-item-title>item</v-list-item-title>
											</v-list-item-content>
											<v-list-item-content>
												<v-list-item-title>item</v-list-item-title>
											</v-list-item-content>
										</v-list-item>
									</v-list>
									<table>
										<td>
											<span class="badge badge-success">Success</span>
											<span class="badge badge-warning">In progress</span>
		                                </td>
									</table>
								</template>
							</v-flex>
						</v-layout>
					</v-container>
				</v-card>

			</v-flex> 
			<v-flex xs10>
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
							<template v-slot:top>
								<v-toolbar flat color="white">
											<v-spacer></v-spacer>
								  <v-dialog v-model="dialog_add_project" max-width="500px">
									<template v-slot:activator="{ on }">
										<v-btn color="primary" dark class="mb-2" v-on="on">New Project</v-btn>
									</template>
								    <v-card>
								      <v-card-title>
								        <span class="headline">New Project</span>
								      </v-card-title>

								      <v-card-text>
								        <v-container grid-list-md>
								          <v-layout wrap>
								          		<v-flex xs12>
													
												<v-autocomplete
												v-model="Project.name_website"
												:items="autocomplete_website"
												:loading="isLoading"
												:search-input.sync="search"
												color="white"
												hide-no-data
												hide-selected
												item-text="url_website"
												item-value="id_website"
												label="Website"
												placeholder="Name Website"
												return-object
												></v-autocomplete>

												</v-flex>
												<v-flex xs12>
													<v-text-field v-model="Project.name_project_tasks" label="Name Project"></v-text-field>
												</v-flex>
								            	<v-flex xs12 lg6>
													<v-menu
													    ref="menu"
													    :close-on-content-click="false"
													    v-model="menu1"
													    :nudge-right="40"
													    lazy
													    transition="scale-transition"
													    offset-y
													    full-width
													    min-width="290px"
													  >
													  <template v-slot:activator="{ on }">
													    <v-text-field
													      slot="activator"
													      v-model="Project.started_project_tasks"
													      label="Picker in menu"
													      prepend-icon="event"
													      readonly
													      v-on="on"
													    ></v-text-field>
													   </template>
													    <v-date-picker v-model="Project.started_project_tasks" no-title @input="menu1 = false"> </v-date-picker>
													</v-menu>
											      </v-flex>

												<v-flex xs12 lg6>
													<v-menu
													    ref="menu"
													    :close-on-content-click="false"
													    v-model="menu2"
													    :nudge-right="40"
													    lazy
													    transition="scale-transition"
													    offset-y
													    full-width
													    min-width="290px"
													  >
													  <template v-slot:activator="{ on }">
													    <v-text-field
													      slot="activator"
													      v-model="Project.deadline_project_tasks"
													      label="Picker in menu"
													      prepend-icon="event"
													      readonly
													      v-on="on"
													    ></v-text-field>
													   </template>
													    <v-date-picker v-model="Project.deadline_project_tasks" no-title @input="menu2 = false"></v-date-picker>
													</v-menu>
												</v-flex>
								          </v-layout>
								        </v-container>
								      </v-card-text>

								      <v-card-actions>
										<div class="flex-grow-1"></div>
										<v-btn color="blue darken-1" text @click="f_editProject()">Save</v-btn>
										<v-btn color="blue darken-1" text @click="f_dialog_close()">Cancel</v-btn>
								      </v-card-actions>
								    </v-card>
								  </v-dialog>
								</v-toolbar>
							</template>
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
						    <template v-slot:item.member="props">
						        	<span v-for="itemUser in props.item.users_to_project">
						            	<v-avatar color="red">
											<span class="white--text headline">{{ itemUser.username.substr(0, 2) }}</span>
										</v-avatar>
									</span>
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
			</div>
		</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
	    data : {
	    	sidebar:"projects",
	    	menu1: false,
	    	menu2: false,
	    	autocomplete_website: <?php echo json_encode($all_websites->result_array()); ?>,
	        dialog_add_project: false,
	        currentRoute: window.location.href,
	        headers: [
	        	{ text: '<?php echo lang('website'); ?>', value: 'url_website' },
				{ text: '<?php echo lang('name'); ?>', value: 'name_website' },
				{ text: 'Started on', value: 'started_project_tasks' },
				{ text: 'Deadline', value: 'deadline_project_tasks' },
				{ text: 'Status', value: 'status' },
				{ text: 'Progress', value: 'progress' },
				{ text: 'Member', value: 'member' },
	            { text: '<?php echo lang("actions"); ?>', value: 'actions'},
	        ],
	        list_projects: <?php echo json_encode($all_projects->result_array()); ?>,
			Project:{
				id_project_tasks:"",
				name_website:"",
				name_project_tasks: "",
				started_project_tasks: new Date().toISOString().substr(0, 10),
				deadline_project_tasks: new Date().toISOString().substr(0, 10),
			},
			defaultProject:{
	        	id_project_tasks:"",
				name_website:"",
				name_project_tasks: "",
				started_project_tasks: new Date().toISOString().substr(0, 10),
				deadline_project_tasks: new Date().toISOString().substr(0, 10),
			},
			editedIndexProject: -1,
	    },
	    mixins: [mixin],
	    created(){
	        this.displayPage();
	    },
	    methods:{
	        displayPage(){

	        },
	        f_editProject(){
	    		var formData = new FormData();
				
				formData.append("name_project",v.Project.name_project_tasks);
				formData.append("date_started",v.Project.started_project_tasks);
				formData.append("date_deadline",v.Project.deadline_project_tasks);
				if (v.editedIndexProject > -1) {
					formData.append("id_project",v.Project.id_project_tasks);
					axios.post(v.currentRoute+"/edit-project/", formData).then(function(response){
						v.dialog_add_project = false;
						Object.assign(v.list_projects[v.editedIndexProject], v.Project)
					})	
				} else {
					formData.append("id_website",v.Project.name_website.id_website);
					axios.post(v.currentRoute+"/create-project/", formData).then(function(response){
						v.dialog_add_project = false;
						//v.list_projects.push(v.editedItem)
					})
				}

			},
			f_dialog_close () {
				v.dialog_add_project = false
				setTimeout(() => {
					v.Project = Object.assign({}, v.defaultProject)
					v.editedIndexProject = -1
				}, 300)
			},
			f_dialog_editProject(item){
				var formData = new FormData();
				v.editedIndexProject = v.list_projects.indexOf(item);
				v.Project = Object.assign({}, item);
				v.Project.name_website = item.url_website;
				v.dialog_add_project = true;
			},
	        f_deleteProject(item){
	            var formData = new FormData();
	            formData.append("id_project",item.id_project_tasks);
	            if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete-project/", formData).then(function(response){
						const index = v.list_projects.indexOf(item);
						v.list_projects.splice(index, 1);
					})
				}
	        },
	    }
	});
</script>
<?php $this->load->view('include/footer.php'); ?>
