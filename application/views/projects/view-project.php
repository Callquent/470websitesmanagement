<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">

	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo $project->name_project_tasks; ?></h2>
		<a href="<?php echo site_url('/all-projects'); ?>" class="btn btn-icon fuse-ripple-ready">
			<i class="icon icon-arrow-left-thick"></i>
		</a>
		
	</div>





	<v-container fluid grid-list-sm>
		<v-layout row wrap>
			<v-flex hidden-sm-and-down md2>
				<v-stepper v-model="stepper" non-linear vertical>
					<template v-for="n in list_card_tasks.length">
						<v-stepper-step
							@click.native="changeCard(list_card_tasks[n-1].order_card_tasks)"
							:step="n"
							:edit-icon="'check'"
							editable
							:complete="list_card_tasks[n-1].name_tasks_status=='completed' ? true : false"
							>
							<span>{{ list_card_tasks[n-1].name_card_tasks  }}</span>
						</v-stepper-step>
						<v-stepper-content :step="list_card_tasks[n-1].order_card_tasks"></v-stepper-content>
					</template>
				</v-stepper>
			</v-flex>
			<v-flex xs12 md10>
				<div class="step-content">
					<div class="setup-content" id="step-1">
						<div class="course-step ng-tns-c58-59" fuseperfectscrollbar="">
							<div class="course-step-content" id="course-step-content">

		<v-toolbar color="indigo" dark>
			<v-toolbar-side-icon></v-toolbar-side-icon>
			<v-toolbar-title>{{ card_tasks.name_card_tasks }}</v-toolbar-title>
			<v-spacer></v-spacer>
			<a id="add-event-button" class="btn btn-danger btn-fab fuse-ripple-ready" @click="dialog_add_card = true">
					<i class="icon icon-plus"></i>
				</a>
			<v-menu bottom left>
				<template v-slot:activator="{ on }">
					<v-btn dark icon v-on="on">
					<v-icon>mdi-dots-vertical</v-icon>
					</v-btn>
				</template>
				<v-list>
					<v-list-item>
						<v-list-item-title @click="deleteCard(step)">Editer</v-list-item-title>
					</v-list-item>
					<v-list-item>
						<v-list-item-title @click="deleteCard(step)">Supprimer</v-list-item-title>
					</v-list-item>
				</v-list>
			</v-menu>
		</v-toolbar>

        <v-card>
				<div>
					<span>{{card_tasks.count_tasks_check_per_card}} / {{card_tasks.tasks.length}}</span>
					<v-progress-linear v-model="valueDeterminate" height="25">
						<strong>{{ Math.ceil(valueDeterminate) }}%</strong>
					</v-progress-linear>
				</div>
				
									<v-toolbar flat color="white">
									  <v-spacer></v-spacer>
										<v-dialog v-model="dialog_add_task" width="500">
											<v-btn slot="activator" color="primary" dark class="mb-2">New Task</v-btn>
											<v-card>
												<v-card-title class="headline green lighten-2" primary-title>
													Ajouter une tâche
												</v-card-title>

												<v-card-text>
													<v-container grid-list-md>
														<v-layout wrap>
															<v-flex xs12>
																<v-text-field label="Titre Task"  v-model="newTask.nametask" required></v-text-field>
															</v-flex>
															<v-flex xs12>
																<v-autocomplete
													              v-model="newTask.user"
													              :items="users"
													              box
													              chips
													              label="Select"
													              item-text="name_user"
													              item-value="id">
													              <template
													                slot="selection"
													                slot-scope="data"
													              >
													                <v-chip
													                  :selected="data.selected"
													                  close
													                  class="chip--select-multi"
													                  @input="remove(data.item)"
													                >
													                  <v-avatar>
													                    <img :src="data.item.avatar">
													                  </v-avatar>
													                  {{ data.item.name_user }}
													                </v-chip>
													              </template>
													              <template
													                slot="item"
													                slot-scope="data"
													              >
													                <template v-if="typeof data.item !== 'object'">
													                  <v-list-item-content v-text="data.item"></v-list-item-content>
													                </template>
													                <template v-else>
																		<v-avatar color="red">
																			<span class="white--text headline">J</span>
																		</v-avatar>
													                    <v-list-item-title v-html="data.item.name_user"></v-list-item-title>
													                </template>
													              </template>
													            </v-autocomplete>
															</v-flex>
														</v-layout>
													</v-container>
													<small>*indicates required field</small>
										        </v-card-text>
										        <v-card-actions>
										          <v-spacer></v-spacer>
										        	<v-btn color="blue darken-1" flat @click="f_createTask()">Save</v-btn>
										        	<v-btn color="blue darken-1" flat @click="dialog_add_task = false">Close</v-btn>
										        </v-card-actions>
											</v-card>
										</v-dialog>
									</v-toolbar>

									<v-data-table
										:headers="headers"
										:items="card_tasks"
										item-key="name_task"
										select-all
										class="elevation-1"
									>
										<template slot="items" slot-scope="props">
											<td><v-checkbox @change="f_checkTask(props.item)" v-model="props.item.check_tasks == 1" primary hide-details></v-checkbox></td>
											<td>{{ props.item.name_task }}</td>
											<td>{{ props.item.username }}</td>
											<td>
												<div class="dropdown show actions">
													<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
														<i class="icon icon-dots-vertical"></i>
													</a>
													<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
														<a class="dropdown-item" id="edit-task" @click="editTask()"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
														<a class="dropdown-item" id="delete-task" @click="deleteTask(props.item)" ><i class="icon icon-trash"></i><?php echo lang('delete') ?></a>
													</div>
												</div>
											</td>
										</template>
									</v-data-table>
								</v-card>


								<div class="step-navigation hidden-md-and-up">
									<button class="prevBtn mat-accent white-fg mat-fab" @click="f_prevBtn(--id_card)" v-if="first_step != stepper">
										<span class="mat-button-wrapper">
											<i class="icon-chevron-left" aria-hidden="true"></i>
										</span>
										<div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
										<div class="mat-button-focus-overlay"></div>
									</button>
									<button class="nextBtn mat-accent white-fg mat-fab" @click="f_nextBtn(++id_card)"  v-if="last_step != stepper">
										<span class="mat-button-wrapper">
											<i class="icon-chevron-right" aria-hidden="true"></i>
										</span>
										<div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
										<div class="mat-button-focus-overlay"></div>
									</button>
								</div>

							</div>
						</div>
					</div>
				</div>

				
			</v-flex>
		</v-layout>
	</v-container>
</div>
<v-dialog
      v-model="dialog_add_card"
      width="500"
    >
	<v-card>
        <v-card-title class="headline green lighten-2" primary-title>
          Ajouter une Card
        </v-card-title>

        <v-card-text>
			<v-container grid-list-md>
				<v-layout wrap>
					<v-flex xs12>
						<v-text-field label="Titre Task"  v-model="newCard.name_card_tasks" required></v-text-field>
					</v-flex>
					<v-flex xs12>
						<v-select
						v-model="newCard.id_priority"
						slot="input"
						label="Choose Priority"
						single-line
						autofocus
						:items="list_tasks_priority"
						item-text="name_tasks_priority"
						item-value="id_tasks_priority">
						</v-select>
					</v-flex>
					<v-flex xs12>
						<v-text-field v-model="newCard.order_card_task" type="number" :min="newCard.min" :max="newCard.max" required></v-text-field>
					</v-flex>
				</v-layout>
			</v-container>
			<small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
        	<v-btn color="blue darken-1" flat @click="f_createCard()">Save</v-btn>
        	<v-btn color="blue darken-1" flat @click="dialog_add_card = false">Close</v-btn>
        </v-card-actions>
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
			sidebar:"projects",
			dialog_add_task: false,
			dialog_add_card: false,
			first_step: 1,
			last_step: <?php echo json_encode($all_card_tasks->num_rows()); ?>,
			stepper: "",
	    	list_card_tasks: <?php echo json_encode($all_card_tasks->result_array()); ?>,
	    	list_tasks_priority: <?php echo json_encode($all_tasks_priority->result_array()); ?>,
	    	card_tasks: <?php echo json_encode($card_tasks->result_array()); ?>,
	        users: <?php echo json_encode($list_users->result_array()); ?>,
			currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
			id_project: window.location.href.split('/').pop(),
			id_card: <?php echo json_encode($all_card_tasks->row()->id_card_tasks); ?>,
			headers: [
				{ text: 'Name Task', value: 'name_task', sortable: false},
				{ text: 'User', value: 'username' },
				{ text: 'Actions', value: 'name', sortable: false }
			],
			newCard:{
				name_card_tasks:"",
				id_card_task: <?php echo $all_card_tasks->row()->order_card_tasks; ?>,
				id_priority:"",
				min: "1",
				max: <?php echo $order_card_tasks->row()->order_card_tasks; ?>,
			},
			editCard:[],
			newTask:{
			    nametask:'',
			    user:'',
			},
			valueDeterminate: 0,
	    },
	    mixins: [mixin],
	    created(){
			this.displayPage();
	    },
	    methods:{
	    	displayPage(){
	    		this.card_tasks.tasks = (this.card_tasks.tasks == null ? [] : this.card_tasks.tasks);
	    		this.valueDeterminate = this.f_isNaN((this.card_tasks.count_tasks_check_per_card/this.card_tasks.tasks.length)*100);
	    		
	        },
			f_prevBtn(id_card) {
				v.stepper=id_card;
				this.changeCard(id_card);
			},
			f_nextBtn(id_card) {
				v.stepper=id_card;
				this.changeCard(id_card);
			},
			changeCard(id_card_task){
				var formData = new FormData(); 
	    		formData.append("id_project_tasks",this.id_project);
				formData.append("id_card_tasks",id_card_task);
	    		axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
					if(response.status = 200){
						v.check_tasks_complete = 0;
						v.card_tasks.tasks = [];

						v.id_card = id_card_task;
						if (response.data.card_tasks.tasks != null) {
							v.card_tasks = response.data.card_tasks;
						}
						v.valueDeterminate = v.f_isNaN((v.card_tasks.count_tasks_check_per_card/v.card_tasks.tasks.length)*100);
						v.card_tasks.name_card_tasks = response.data.name_card_tasks;
					}else{

					}
				})
	        },
			f_createCard(){
				var formData = new FormData();
				formData.append("name_card_tasks",v.newCard.name_card_tasks);
				formData.append("id_project_tasks",v.id_project);
				formData.append("id_card_task",v.newCard.id_card_task);
				formData.append("id_tasks_priority",v.newCard.id_priority);
				axios.post(this.currentRoute+"/create-card-tasks/", formData).then(function(response){
					if(response.status = 200){
						v.list_card_tasks.push({name_card_tasks: v.newCard.name_card_tasks,id_card_tasks: v.newCard.id_card_task,id_project_tasks: v.id_project});
						v.newCard.max = v.newCard.max + 1;
						v.dialog_add_card = false;
					}else{

					}
				})
			},
			deleteCard(item){
				var formData = new FormData();
				formData.append("id_project_tasks",this.id_project);
				formData.append("id_card_task",this.id_card);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete-card-tasks/", formData).then(function(response){
						if(response.status = 200){
							const index = v.list_card_tasks.indexOf(item);
							v.list_card_tasks.splice(index, 1);
							v.newCard.max = v.newCard.max - 1
						}else{

						}
					})
				}
			},
			f_checkTask(item){
				var formData = new FormData();
				formData.append("id_project_tasks",this.id_project);
				formData.append("id_card_tasks",this.id_card);
				formData.append("id_task",item.id_task);
				formData.append("check_tasks",(item.check_tasks^=1));
				axios.post(this.currentRoute+"/check-tasks/", formData).then(function(response){
					if(response.status = 200){
						v.editCard = response.data.card_tasks;
						v.valueDeterminate = v.f_isNaN((v.editCard.count_tasks_check_per_card)/v.card_tasks.tasks.length*100)
						Object.assign(v.card_tasks, v.editCard);
						//change status
						var index = v.list_card_tasks.findIndex(i => i.id_card_tasks === item.id_card_tasks)
						v.list_card_tasks[index].name_tasks_status = response.data.card_tasks.name_tasks_status;
					}else{

					}
				})
			},
			f_createTask(){
				var formData = new FormData();
				formData.append("nametask",this.newTask.nametask);
				formData.append("id_user",this.newTask.user);
				formData.append("id_project_tasks",this.id_project);
				formData.append("id_card_tasks",this.id_card);
				axios.post(this.currentRoute+"/create-task/", formData).then(function(response){
					if(response.status = 200){
						v.card_tasks.tasks.push({name_task: v.newTask.nametask,username: v.newTask.user})
					}else{

					}
				})
			},
			f_editTask(){
				var formData = new FormData();
				formData.append("nametask",this.newTask.nametask);
				formData.append("id_user",this.newTask.user);
				formData.append("id_project_tasks",this.id_project);
				formData.append("id_card_tasks",this.id_card);
				axios.post(this.currentRoute+"/create-task/", formData).then(function(response){
					if(response.status = 200){
						v.card_tasks.tasks.push({name_task: v.newTask.nametask,username: v.newTask.user})
					}else{

					}
				})
			},
			deleteTask(item){
				var formData = new FormData();
				formData.append("id_project_tasks",this.id_project);
				formData.append("id_card_tasks",this.id_card);
				formData.append("id_task",item.id_task);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete_task/", formData).then(function(response){
						if(response.status = 200){
							const index = v.card_tasks.tasks.indexOf(item)
							v.card_tasks.tasks.splice(index, 1)
						}else{

						}
					})
				}
			},
			f_isNaN(val) {
				if (isNaN(val)) {
					return 0;
				} else {
					return val;
				}
			}
	    }
	});
</script>
<?php $this->load->view('include/footer.php'); ?>