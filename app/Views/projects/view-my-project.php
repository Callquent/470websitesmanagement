<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
	<div class="page-layout simple full-width">
		<v-layout>
			<v-flex xs3>
				<v-list two-line>
					<v-subheader>
						TO DO
					</v-subheader>
					<draggable v-model="list_card_tasks_to_do" :options="{group:'people'}" style="min-height: 10px" >
						<template v-for="item in list_card_tasks_to_do">
							<v-card @click="dialog_card = true"
									class="mx-auto my-12"
									max-width="374"
								>
									<v-card-title>{{item.name_card_tasks}}</v-card-title>
									<v-divider class="mx-4"></v-divider>
									<v-card-text>
										<v-avatar color="red">
											<span class="white--text headline">CJ</span>
										</v-avatar>
									</v-card-text>
								</v-card>
						</template>
					</draggable>
					<v-btn color="deep-purple lighten-2" block text @click="dialog_card = true">Add Card</v-btn>
				</v-list>
			</v-flex>
			<v-flex xs3>
				<v-list two-line>
					<v-subheader>
						IN PROGRESS
					</v-subheader>
					<draggable v-model="list_card_tasks_in_progress" :options="{group:'people'}" style="min-height: 10px">
						<template v-for="item in list_card_tasks_in_progress">
								<v-card
										class="mx-auto my-12"
										max-width="374"
									>
										<v-card-title>{{item.name_card_tasks}}</v-card-title>
										<v-divider class="mx-4"></v-divider>
										<v-card-text>
											<v-avatar color="red">
												<span class="white--text headline">CJ</span>
											</v-avatar>
										</v-card-text>
									</v-card>
						</template>
					</draggable>
					<v-btn color="deep-purple lighten-2" block text @click="dialog_card = true">Add Card</v-btn>
				</v-list>
			</v-flex>
			<v-flex xs3>
				<v-list two-line>
					<v-subheader>
						COMPLETED
					</v-subheader>
					<draggable v-model="list_card_tasks_completed" :options="{group:'people'}" style="min-height: 10px">
						<template v-for="item in list_card_tasks_completed">
								<v-card
										class="mx-auto my-12"
										max-width="374"
									>
										<v-card-title>{{item.name_card_tasks}}</v-card-title>
										<v-divider class="mx-4"></v-divider>
										<v-card-text>
											<v-avatar color="red">
												<span class="white--text headline">CJ</span>
											</v-avatar>
										</v-card-text>
									</v-card>
						</template>
					</draggable>
					<v-btn color="deep-purple lighten-2" block text @click="dialog_card = true">Add Card</v-btn>
				</v-list>
			</v-flex>
			<!-- <v-flex xs3>
				<v-list two-line>
					<v-subheader>
						CANCELLED
					</v-subheader>
					<draggable v-model="items4" :options="{group:'people'}" style="min-height: 10px">
						<template v-for="item in items4">
								<v-card
										class="mx-auto my-12"
										max-width="374"
									>
										<v-card-title>{{item.title}}</v-card-title>
										<v-divider class="mx-4"></v-divider>
										<v-card-text>
											<v-avatar color="red">
												<span class="white--text headline">CJ</span>
											</v-avatar>
										</v-card-text>
									</v-card>
						</template>
					</draggable>
					<v-btn color="deep-purple lighten-2" block text @click="dialog_card = true">Add Card</v-btn>
				</v-list>
			</v-flex> -->
		</v-layout>
	</div>
</div>

<v-dialog
	v-model="dialog_card"
	width="720"
	>
	<v-card>
		<v-card-title class="headline green lighten-2" primary-title>
			Card
		</v-card-title>
		<v-card-text>
			<v-container grid-list-md>
				<v-layout wrap>
					<v-flex xs12>
						<v-text-field label="Titre Card Task" v-model="card_tasks.name_card_tasks" required></v-text-field>
					</v-flex>
					<v-flex xs12>
						<v-textarea v-model="card_tasks.description_card_tasks">
							<div slot="label">Decription Card Task <small>(optional)</small></div>
						</v-textarea>
					</v-flex>
					<v-flex xs6>
							Priority
					</v-flex>
					<v-flex xs6>
							User
					</v-flex>
					<v-flex xs12>
						<div>{{card_tasks.count_tasks_check_per_card}} / {{card_tasks.count_tasks_per_card}} <v-progress-linear v-model="valueDeterminate"></v-progress-linear></div>
						<v-card>
							<template>
								<v-data-table
										:headers="headers"
										:items="card_tasks.tasks"
										item-key="name_task"
										select-all
										class="elevation-1"
								>
									<template slot="items" slot-scope="props">
										<td><v-checkbox @change="f_checkTask(props.item)" v-model="props.item.check_tasks == 1" primary hide-details></v-checkbox></td>
										<td>{{ props.item.name_task }}</td>
										<td>{{ props.item.username }}</td>
										<td>
											<a class="dropdown-item" id="edit-task" @click="editTask()"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
										</td>
									</template>
								</v-data-table>
							</template>
						</v-card>
					</v-flex>
				</v-layout>
			</v-container>
			<small>*indicates required field</small>
		</v-card-text>
		<v-card-actions>
				<div class="flex-grow-1"></div>
				<v-btn color="primary" text @click="f_createCard()">Save</v-btn>
				<v-btn color="primary" text @click="dialog_card = false">Close</v-btn>
		</v-card-actions>
	</v-card>
</v-dialog>
<v-dialog v-model="dialog_add_task" persistent width="500">
		<v-card>
			<v-card-title class="headline green lighten-2" primary-title>
					Ajouter une tâche
			</v-card-title>

			<v-card-text>
				<v-container grid-list-md>
					<v-layout wrap>
						<v-flex xs12>
								<v-text-field label="Titre Task"  v-model="newTask.nametask" required :rules="[() => !!newTask.nametask || 'Name is required']"></v-text-field>
						</v-flex>
					</v-layout>
				</v-container>
				<small>*indicates required field</small>
			</v-card-text>
			<v-card-actions>
				<v-spacer></v-spacer>
					<v-btn color="primary" flat @click="f_createTask()">Save</v-btn>
					<v-btn color="primary" flat @click="dialog_add_task = false">Close</v-btn>
			</v-card-actions>
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
						dialog_add_task: false,
						dialog_card: false,
						list_card_tasks_to_do: <?php echo json_encode($all_card_tasks_to_do->result_array()); ?>,
						list_card_tasks_in_progress: <?php echo json_encode($all_card_tasks_in_progress->result_array()); ?>,
						list_card_tasks_completed: <?php echo json_encode($all_card_tasks_completed->result_array()); ?>,
						list_tasks_priority: <?php echo json_encode($all_tasks_priority->result_array()); ?>,
						current_project: <?php echo json_encode($project); ?>,
						current_card: <?php echo json_encode($card_tasks); ?>,
						headers: [
							{ text: '', value: 'check_tasks', sortable: false},
							{ text: 'Name Task', value: 'name_task', sortable: false},
							{ text: 'User', value: 'username' },
							{ text: 'Actions', value: 'actions', sortable: false }
						],
						user_profil: <?php echo json_encode($user_role[0]); ?>,
						card_tasks:[],
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
				created(){
						this.displayPage();
				},
				methods:{
						displayPage(){
								this.card_tasks.tasks = (this.card_tasks.tasks == null ? [] : this.card_tasks.tasks);
								this.valueDeterminate = this.f_isNaN((this.card_tasks.count_tasks_completed/this.card_tasks.tasks.length)*100);
						},
						f_isNaN(val) {
								if (isNaN(val)) {
										return 0;
								} else {
										return val;
								}
						},
						f_editTask(item){
							this.editedTaskIndex = this.list_tasks.indexOf(item);
							this.editTask = Object.assign({}, item);
							var formData = new FormData();
							formData.append("id_user",this.editTask.id_user);
							formData.append("id_task",this.editTask.id_task);
							if (this.editedTaskIndex > -1) {
								axios.post(this.currentRoute+"/view-task/", formData).then(function(response){
									if(response.status = 200){
										v.list_tasks_hours = response.data.tasks_hours;
									}else{

									}
								})
							} 

							this.dialog.add_task = true;
						},

				}
		});
</script>
<?php $this->load->view('include/footer.php'); ?>
