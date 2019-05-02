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
									<v-text-field v-model="Project.name_project_tasks" label="Name Project"></v-text-field>
								</template>
							</v-flex>
						</v-layout>
					</v-container>
				</v-card>

			</v-flex> 
			<v-flex xs10>
		  		<v-card>
	                <template>
						<v-toolbar flat color="white">
						  <v-toolbar-title>My CRUD</v-toolbar-title>
						  <v-divider
						    class="mx-2"
						    inset
						    vertical
						  ></v-divider>
						  <v-spacer></v-spacer>
						  <v-dialog v-model="dialog_add_project" max-width="500px">
						    <v-btn slot="activator" color="primary" dark class="mb-2">New Project</v-btn>
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
											    <v-text-field
											      slot="activator"
											      v-model="Project.started_project_tasks"
											      label="Picker in menu"
											      prepend-icon="event"
											      readonly
											    ></v-text-field>
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
											    <v-text-field
											      slot="activator"
											      v-model="Project.deadline_project_tasks"
											      label="Picker in menu"
											      prepend-icon="event"
											      readonly
											    ></v-text-field>
											    <v-date-picker v-model="Project.deadline_project_tasks" no-title @input="menu2 = false"></v-date-picker>
											</v-menu>
										</v-flex>
						          </v-layout>
						        </v-container>
						      </v-card-text>

						      <v-card-actions>
						        <v-spacer></v-spacer>
						 		<v-btn color="blue darken-1" flat @click="f_editProject()">Save</v-btn>
						        <v-btn color="blue darken-1" flat @click="f_dialog_close()">Cancel</v-btn>
						      </v-card-actions>
						    </v-card>
						  </v-dialog>
						</v-toolbar>
	                        <v-data-table
	                            :headers="headers"
	                            :items="list_projects"
	                            class="elevation-1"
	                            :rows-per-page-items="[10,20,50,100]"
	                        >
	                            <template slot="items" slot-scope="props">
	                                <td>{{ props.item.name_website }}</td>
	                                <td>{{ props.item.name_project_tasks }}</td>
	                                <td>{{ props.item.started_project_tasks }}</td>
	                                <td>{{ props.item.deadline_project_tasks }}</td>
	                                <td>
										<span v-if="props.item.percentage_tasks == '100'" class="badge badge-success">Success</span>
										<span v-else class="badge badge-warning">In progress</span>
	                                </td>
	                                <td>
	                                	<div class="progress">
											  <div class="progress-bar" role="progressbar" :style="{width: props.item.percentage_tasks + '%'}" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">{{ props.item.percentage_tasks }}%
											  </div>
										</div>
	                                </td>
	                                <td>
	                                	<span v-for="itemUser in props.item.users_to_project">
		                                	<v-avatar color="red">
												<span class="white--text headline">{{ itemUser.username.substr(0, 2) }}</span>
											</v-avatar>
										</span>
									</td>
	                                <td class="text-xs-left">
										<div class="dropdown show actions">
											<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
												<i class="icon icon-dots-vertical"></i>
											</a>
											<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
													<a class="dropdown-item" id="view-project" :href="currentRoute+'/'+props.item.id_project_tasks"><i class="fa fa-eye"></i> View</a>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" id="edit-project" @click="f_dialog_editProject(props.item)"><i class="fa fa-pencil"></i>  <?php echo lang('edit') ?></a>
													<a class="dropdown-item" id="delete-project" @click="f_deleteProject(props.item)"><i class="fa fa-trash"></i> <?php echo lang('delete') ?></a>
											</div>
										</div>
	                                </td>
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
	</v-app>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
	    data : {
	    	sidebar:"general",
	    	menu1: false,
	    	menu2: false,
	    	autocomplete_website: <?php echo json_encode($all_websites->result_array()); ?>,
	        dialog_add_project: false,
	        currentRoute: window.location.href,
	        headers: [
	        	{ text: '<?php echo lang('website'); ?>', value: 'website' },
				{ text: '<?php echo lang('name'); ?>', value: 'name' },
				{ text: 'Started on', value: 'started_on' },
				{ text: 'Deadline', value: 'deadline' },
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
