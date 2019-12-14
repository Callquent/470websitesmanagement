<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
	<div class="page-layout simple full-width">
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
								@click.native="changeCard(list_card_tasks[n-1].id_card_tasks)"
								:step="n"
								:edit-icon="'check'"
								editable
								:complete="list_card_tasks[n-1].name_tasks_status=='completed' ? true : false"
								>
								<span>{{ list_card_tasks[n-1].name_card_tasks }}</span>
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
										<v-toolbar-title>{{ current_card.name_card_tasks }}</v-toolbar-title>
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
													<v-list-item-title @click="editCard(step)">Editer</v-list-item-title>
												</v-list-item>
												<v-list-item>
													<v-list-item-title @click="deleteCard(step)">Supprimer</v-list-item-title>
												</v-list-item>
											</v-list>
										</v-menu>
									</v-toolbar>

									<v-card>
										<div>
											<span>{{ current_card.count_tasks_check_per_card }} / {{ list_tasks.length }}</span>
											<v-progress-linear v-model="valueDeterminate" height="25">
												<strong>{{ Math.ceil(valueDeterminate) }}%</strong>
											</v-progress-linear>
										</div>
										<v-data-table
											:headers="headers"
											:items="list_tasks"
											item-key="name_task"
											class="elevation-1"
											:items-per-page="-1"
											:footer-props="{
											'items-per-page-options': [10, 20, 30, 40, 50]
											}"
										>
											<template v-slot:top>
												<v-toolbar flat color="white">
													<v-spacer></v-spacer>
													<v-dialog v-model="dialog_add_task" max-width="500px">
														<template v-slot:activator="{ on }">
															<v-btn color="primary" dark class="mb-2" v-on="on">New Task</v-btn>
														</template>
														<v-card>
														  <v-card-title>
															<span class="headline">Tasks</span>
														  </v-card-title>

															<v-card-text>
																<v-container>
																	<v-row>
																		<v-col cols="12" sm="12" md="12">
																			<v-text-field label="Titre Task" v-model="editTask.name_task" required></v-text-field>
																		</v-col>
																		<v-col cols="12" sm="12" md="12">
																			<v-autocomplete
																			  v-model="editTask.id_user"
																			  :items="users"
																			  chips
																			  item-text="name_user"
																			  item-value="id"
																			  label="Name User">
																				<template v-slot:selection="data">
																					<v-chip
																					v-bind="data.attrs"
																					:input-value="data.selected"
																					close
																					@click="data.select"
																					@click:close="remove(data.item)"
																					>
																						<v-avatar left>
																							<v-img :src="data.item.avatar"></v-img>
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
																		</v-col>
																	</v-row>
																</v-container>
															</v-card-text>

															<v-card-actions>
																<div class="flex-grow-1"></div>
																<v-btn color="blue darken-1" text @click="saveTask()">Save</v-btn>
																<v-btn color="blue darken-1" text @click="dialog_add_task = false">Cancel</v-btn>
															</v-card-actions>
														</v-card>
													</v-dialog>
												</v-toolbar>
											</template>
											<template v-slot:item.check_tasks="props">
												<v-checkbox @change="f_checkTask(props.item)" v-model="props.item.check_tasks" false-value="0" true-value="1" primary hide-details></v-checkbox>
											</template>
											<template v-slot:item.name_task="props">
												{{ props.item.name_task }}
											</template>
											<template v-slot:item.username="props">
												{{ props.item.username }}
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
														<v-list-item @click="f_editTask(props.item)">
															<v-list-item-title id="edit-project" ><?php echo lang('edit') ?></v-list-item-title>
														</v-list-item>
														<v-list-item @click="f_deleteTask(props.item)">
															<v-list-item-title id="delete-project"><?php echo lang('delete') ?></v-list-item-title>
														</v-list-item>
													</v-list>
												</v-menu>
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
			<div class="flex-grow-1"></div>
			<v-btn color="blue darken-1" text @click="f_createCard()">Save</v-btn>
			<v-btn color="blue darken-1" text @click="dialog_add_card = false">Cancel</v-btn>
		</v-card-actions>
		<v-card-actions>
	</v-card>
</v-dialog>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
		data : {
			sidebar:"projects",
			currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
			dialog_add_card: false,
			dialog_add_task: false,
			first_step: 1,
			last_step: <?php echo json_encode($all_card_by_project->num_rows()); ?>,
			stepper: "",
			list_tasks_priority: <?php echo json_encode($all_tasks_priority->result_array()); ?>,
			list_card_tasks: <?php echo json_encode($all_card_by_project->result_array()); ?>,
			list_tasks: <?php echo json_encode($all_tasks_by_card->result_array()); ?>,
			users: <?php echo json_encode($list_users->result_array()); ?>,
			id_project: window.location.href.split('/').pop(),
			current_card: <?php echo json_encode($card_tasks); ?>,
			headers: [
				{ text: '', value: 'check_tasks', sortable: false},
				{ text: 'Name Task', value: 'name_task', sortable: false},
				{ text: 'User', value: 'username' },
				{ text: 'Actions', value: 'actions', sortable: false }
			],
			newCard:{
				name_card_tasks:"",
				order_card_task: <?php echo $order_card_tasks; ?>,
				id_priority:"",
				min: "1",
				max: <?php echo $order_card_tasks; ?>,
			},
			editCard:[],
			editedTaskIndex: -1,
			editTask:{
				name_task:'',
				id_user:'',
			},
			valueDeterminate: 0,
		},
		mixins: [mixin],
		created(){
			this.displayPage();
		},
		methods:{
			displayPage(){
				this.list_tasks.tasks = (this.list_tasks.tasks == null ? [] : this.list_tasks.tasks);
				this.valueDeterminate = this.f_isNaN((this.current_card.count_tasks_check_per_card/this.list_card_tasks.length)*100);
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
				formData.append("id_card_tasks",id_card_task);
				axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
					if(response.status = 200){
						if (response.data.all_tasks_by_card == null) {
							v.list_tasks = [];
						} else {
							v.list_tasks = response.data.all_tasks_by_card;
						}
						v.current_card = response.data.card_tasks;

						v.valueDeterminate = v.f_isNaN((v.current_card.count_tasks_check_per_card/v.list_card_tasks.length)*100);
					}else{

					}
				})
			},
			f_createCard(){
				var formData = new FormData();
				formData.append("name_card_tasks",v.newCard.name_card_tasks);
				formData.append("id_project_tasks",v.id_project);
				formData.append("id_tasks_priority",v.newCard.id_priority);
				formData.append("order_card_tasks",v.newCard.order_card_task);
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
				formData.append("id_task",item.id_task);
				formData.append("id_card_tasks",item.id_card_tasks);
				formData.append("check_tasks",(item.check_tasks));
				axios.post(this.currentRoute+"/check-tasks/", formData).then(function(response){
					if(response.status = 200){
						v.editCard = response.data.list_tasks;
						//v.valueDeterminate = v.f_isNaN((v.editCard.count_tasks_check_per_card)/v.list_tasks.length*100)
						Object.assign(v.list_tasks, v.editCard);
						//change status
						/*var index = v.list_card_tasks.findIndex(i => i.id_card_tasks === item.id_card_tasks)
						v.list_card_tasks[index].name_tasks_status = response.data.list_tasks.name_tasks_status;*/
						if (response.data.check_tasks == 0) {
							v.current_card.count_tasks_check_per_card--
						} else {
							v.current_card.count_tasks_check_per_card++
						}
					}else{

					}
				})
			},
			f_editTask(item){
				this.editedTaskIndex = this.list_tasks.indexOf(item);
				this.editTask = Object.assign({}, item);
				this.dialog_add_task = true;
			},
			saveTask(){
				var formData = new FormData();
				formData.append("name_task",this.editTask.name_task);
				formData.append("id_user",this.editTask.id_user);
				formData.append("id_card_tasks",this.current_card.id_card_tasks);
				if (this.editedTaskIndex > -1) {
					formData.append("id_task",this.editTask.id_task);
					axios.post(this.currentRoute+"/edit-task/", formData).then(function(response){
						if(response.status = 200){
							Object.assign(v.list_tasks[v.editedTaskIndex], v.editTask)
						}else{

						}
					})
				} else {
					axios.post(this.currentRoute+"/create-task/", formData).then(function(response){
						if(response.status = 200){
							v.list_tasks.push({name_task: v.editTask.name_task,username: v.editTask.username})
						}else{

						}
					})
				}
				this.dialog_add_task = false;
			},
			f_deleteTask(item){
				var formData = new FormData();
				formData.append("id_task",item.id_task);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete_task/", formData).then(function(response){
						if(response.status = 200){
							const index = v.list_tasks.indexOf(item)
							v.list_tasks.splice(index, 1)
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