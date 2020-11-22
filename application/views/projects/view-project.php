<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
	<div class="page-layout simple full-width">
		<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
			<v-row no-gutters>
				<v-col md="3">
					<h2 class="doc-title" id="content">{{ current_project.name_project_tasks }}</h2>
				</v-col>
				<v-col md="3" offset-md="6">
					<span class="display-1 no-margin"><?php echo lang('time_spent'); ?></span>
					<span class="no-margin"><?php echo $datetimestart; ?> <?php echo lang('days'); ?></span>
					<br/>
					<span class="display-1 no-margin m-t-5"><?php echo lang('remaining_time'); ?></span>
					<span class="no-margin m-t-5"><?php echo $datetimedeadline; ?> <?php echo lang('days'); ?></span>
				</v-col>
			</v-row>
			<v-progress-linear :value="current_project.percentage_tasks" height="25">
				<strong>{{ Math.ceil(current_project.percentage_tasks) }}%</strong>
			</v-progress-linear>
		</div>
		<v-container fluid grid-list-sm>
			<v-layout row wrap>
				<v-flex hidden-sm-and-down md2>
					<v-btn color="primary" flat @click="dialog_add_card.show = true" block>ADD TASK</v-btn>
					<v-stepper v-model="step.current_step" non-linear vertical>
						<template v-for="n in list_card_tasks.length">
							<v-stepper-step
								@click.native="changeCard(list_card_tasks[n-1].id_card_tasks)"
								:step="n"
								:edit-icon="'check'"
								editable
								:complete="list_card_tasks[n-1].tasks_status.name_tasks_status=='completed' ? true : false"
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
										
										<v-menu bottom left>
											<template v-slot:activator="{ on }">
												<v-btn dark icon v-on="on">
												<v-icon>mdi-dots-vertical</v-icon>
												</v-btn>
											</template>
											<v-list>
												<v-list-item @click="f_editCard(current_card)">
													<v-list-item-title>Editer</v-list-item-title>
												</v-list-item>
												<v-list-item @click="f_deleteCard(current_card)">
													<v-list-item-title>Supprimer</v-list-item-title>
												</v-list-item>
											</v-list>
										</v-menu>
									</v-toolbar>

									<v-card>
										<div>
											<span>{{ current_card.count_tasks_check_per_card }} / {{ list_tasks.length }}</span>
											<v-progress-linear :value="valueDeterminate" height="25">
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
																<v-btn color="blue darken-1" text @click="closeTask()">Cancel</v-btn>
															</v-card-actions>
														</v-card>
													</v-dialog>
												</v-toolbar>
											</template>
											<template v-slot:item.check_tasks="props">
												<v-checkbox @change="f_checkTask(props.item)" v-model="props.item.check_tasks" false-value="0" true-value="1" primary hide-details></v-checkbox>
											</template>
											<template v-slot:item.actions="{ item }">
												<v-menu bottom left>
													<template v-slot:activator="{ on }">
														<v-btn icon v-on="on" color="grey darken-1">
															<v-icon>mdi-dots-vertical</v-icon>
														</v-btn>
													</template>
													<v-divider></v-divider>
													<v-list>
														<v-list-item @click="f_editTask(item)">
															<v-list-item-title id="edit-project" ><?php echo lang('edit') ?></v-list-item-title>
														</v-list-item>
														<v-list-item @click="f_deleteTask(item)">
															<v-list-item-title id="delete-project"><?php echo lang('delete') ?></v-list-item-title>
														</v-list-item>
													</v-list>
												</v-menu>
											</template>
										</v-data-table>
									</v-card>


									<div class="step-navigation hidden-md-and-up">
										<button class="prevBtn mat-accent white-fg mat-fab" @click="f_prevBtn(--id_card)" v-if="step.first_step != step.current_step">
											<span class="mat-button-wrapper">
												<i class="icon-chevron-left" aria-hidden="true"></i>
											</span>
											<div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
											<div class="mat-button-focus-overlay"></div>
										</button>
										<button class="nextBtn mat-accent white-fg mat-fab" @click="f_nextBtn(++id_card)"  v-if="step.last_step != step.current_step">
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
	  v-model="dialog_add_card.show"
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
						<v-text-field label="Name Task"  v-model="editCard.name_card_tasks" required></v-text-field>
					</v-flex>
					<v-flex xs12>
						<v-textarea label="Description Task"  v-model="editCard.description_card_tasks" required></v-textarea>
					</v-flex>
					<v-flex xs12>
						<v-select
						v-model="editCard.id_tasks_priority"
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
						<v-text-field v-model="editCard.order_card_tasks" type="number" :min="dialog_add_card.min" :max="dialog_add_card.max" required></v-text-field>
					</v-flex>
				</v-layout>
			</v-container>
			<small>*indicates required field</small>
		</v-card-text>
		<v-card-actions>
			<div class="flex-grow-1"></div>
			<v-btn color="blue" text @click="saveCard()">Save</v-btn>
			<v-btn color="blue" text @click="dialog_add_card.show = false">Cancel</v-btn>
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
			sidebar:'projects',
			currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
			dialog_add_card: {
				show: false,
				min: 1,
				max: <?php echo $order_card_tasks; ?>,
			},
			dialog_add_task: false,
			step: {
				first_step: 1,
				last_step: <?php echo json_encode($all_card_by_project->num_rows()); ?>,
				current_step: '',
			},
			list_tasks_priority: <?php echo json_encode($all_tasks_priority->result_array()); ?>,
			list_card_tasks: <?php echo json_encode($all_card_by_project->result_array()); ?>,
			list_tasks: <?php echo json_encode($all_tasks_by_card); ?>,
			users: <?php echo json_encode($list_users->result_array()); ?>,
			current_project: <?php echo json_encode($project); ?>,
			current_card: <?php echo json_encode($card_tasks); ?>,
			current_order_card_tasks: <?php echo $order_card_tasks; ?>,
			headers: [
				{ text: '', value: 'check_tasks', sortable: false},
				{ text: 'Name Task', value: 'name_task', sortable: false},
				{ text: 'User', value: 'username' },
				{ text: 'Priority', value: 'tasks_priority.name_tasks_priority' },
				{ text: 'Actions', value: 'actions', sortable: false }
			],
			editedCardIndex: -1,
			editCard:{
				name_card_tasks:'',
				order_card_tasks:this.current_order_card_tasks,
				id_tasks_priority:'',
			},
			newCard:{
				name_card_tasks:'',
				description_card_tasks:'',
				id_tasks_priority:'',
				order_card_tasks:this.current_order_card_tasks,
			},
			editedTaskIndex: -1,
			editTask:{
				name_task:'',
				id_user:''
			},
			newTask:{
				name_task:'',
				id_user:'',
			},
			valueDeterminate: 0,
		},
		mixins: [mixin],
		watch: {
			dialog_add_task (val) {
				val || this.closeTask()
			},
			dialog_add_card: {
				handler: function(val) {
					val.show || this.closeCard()
				},
				deep: true
			},
		},
		created(){
			this.displayPage();
		},
		methods:{
			displayPage(){
				this.list_tasks.tasks = (this.list_tasks.tasks == null ? [] : this.list_tasks.tasks);
				this.valueDeterminate = this.f_isNaN((this.current_card.count_tasks_check_per_card/this.list_tasks.length)*100);
			},
			f_prevBtn(id_card) {
				v.step.current_step=id_card;
				this.changeCard(id_card);
			},
			f_nextBtn(id_card) {
				v.step.current_step=id_card;
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

						v.valueDeterminate = v.f_isNaN((v.current_card.count_tasks_check_per_card/v.list_tasks.length)*100);
					}else{

					}
				})
			},
			f_editCard(item){
				this.editedCardIndex = this.list_card_tasks.map(
					function (e) {
           				return e.id_card_tasks;
         			 }
         		).indexOf(item.id_card_tasks);
				this.editCard = Object.assign({}, item)
				this.dialog_add_card.show = true;
			},
			saveCard(){
				var formData = new FormData();
				formData.append("name_card_tasks",v.editCard.name_card_tasks);
				formData.append("description_card_tasks",v.editCard.description_card_tasks);
				formData.append("id_project_tasks",v.current_project.id_project_tasks);
				formData.append("id_tasks_status",v.editCard.id_tasks_status);
				formData.append("id_tasks_priority",v.editTask.id_tasks_priority);
				formData.append("order_card_tasks",v.editCard.order_card_tasks);
				if (this.editedCardIndex > -1) {
					formData.append("id_card_tasks",this.editCard.id_card_tasks);
					axios.post(this.currentRoute+"/edit-card-tasks/", formData).then(function(response){
						if(response.status = 200){
							Object.assign(v.list_card_tasks[v.editedCardIndex], v.editCard)
						}else{

						}
					})
				} else {
					axios.post(this.currentRoute+"/create-card-tasks/", formData).then(function(response){
						if(response.status = 200){
							v.list_card_tasks.push(v.editCard);
							v.dialog_add_card.max++;
						}else{

						}
					})
				}
				this.closeCard()
			},
			closeCard(){
				this.dialog_add_card.show = false;
		        setTimeout(() => {
					this.current_order_card_tasks = this.editCard.order_card_tasks;
					this.editCard = Object.assign({}, this.newCard)
					this.editedCardIndex = -1
		        }, 300)
			},
			f_deleteCard(item){
				var formData = new FormData();
				formData.append("id_project_tasks",this.current_project.id_project_tasks);
				formData.append("id_card_task",this.current_card.id_card_tasks);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete-card-tasks/", formData).then(function(response){
						if(response.status = 200){
							const index = v.list_card_tasks.indexOf(item);
							v.list_card_tasks.splice(index, 1);
							v.dialog_add_card.max--;
						}else{

						}
					})
				}
			},
			f_checkTask(item){
				var formData = new FormData();
				formData.append("id_project_tasks",this.current_project.id_project_tasks);
				formData.append("id_task",item.id_task);
				formData.append("id_card_tasks",item.id_card_tasks);
				formData.append("check_tasks",(item.check_tasks));
				axios.post(this.currentRoute+"/check-tasks/", formData).then(function(response){
					if(response.status = 200){
						v.current_project.percentage_tasks = response.data.project_percentage;
						if (response.data.check_tasks == 0) {
							v.current_card.count_tasks_check_per_card--
						} else {
							v.current_card.count_tasks_check_per_card++
						}
						v.valueDeterminate = v.f_isNaN((v.current_card.count_tasks_check_per_card/v.list_tasks.length)*100);
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
				this.closeTask()
			},
			closeTask(){
				this.dialog_add_task = false;
		        setTimeout(() => {
		          this.editTask = Object.assign({}, this.newTask)
		          this.editedTaskIndex = -1
		        }, 300)
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