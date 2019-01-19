<?php $this->load->view('include/header.php'); ?>
<div class="custom-scrollbar">

	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo $project->name_project_tasks; ?></h2>
		<a href="<?php echo site_url('/all-projects/'); ?>" class="btn btn-icon fuse-ripple-ready">
			<i class="icon icon-arrow-left-thick"></i>
		</a>
		<a id="add-event-button" class="btn btn-danger btn-fab fuse-ripple-ready" @click="dialog_add_card = true">
			<i class="icon icon-plus"></i>
		</a>
	</div>





	<v-container fluid grid-list-sm>
		<v-layout row wrap>
			<v-flex xs2>
				<v-stepper non-linear vertical>
					<template v-for="n in steps.length">
						<v-stepper-step
							@click.native="changeCard(steps[n-1].id_card_tasks)"
							:step="n"
							:edit-icon="'check'"
							editable
							:complete="steps[n-1].name_tasks_status=='completed' ? true : false"
							>
							{{ steps[n-1].title_card_tasks  }}
						</v-stepper-step>
						<v-stepper-content :step="steps[n-1].id_card_tasks"></v-stepper-content>
					</template>
				</v-stepper>
			</v-flex>
			<v-flex xs10>
				<div class="step-content">
					<div class="setup-content" id="step-1">
						<div class="course-step ng-tns-c58-59" fuseperfectscrollbar="">
							<div class="course-step-content" id="course-step-content">
								<div class="header mat-accent-bg p-24" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center; align-items: center;">
									<h2 id="title-card-tasks">{{ title_card_tasks }}</h2>
									<div class="dropdown actions">
										  <a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" aria-expanded="true">
											<i class="icon icon-dots-vertical"></i>
										  </a>
										  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
										  	<a class="dropdown-item fuse-ripple-ready" @click="dialog_add_task = true"><i class="fa fa-eye"></i> Ajouter</a>
											<a class="dropdown-item fuse-ripple-ready" id="delete-card-tasks" @click="deleteCard(step)"><i class="fa fa-eye"></i> Supprimer</a>
											<div class="dropdown-divider"></div>
										  </div>
									  </div>								
								</div>
								<div>{{check_tasks_complete}} / {{list_tasks.length}} <v-progress-linear v-model="valueDeterminate"></v-progress-linear></div>
								<section class="card mb-3">
								  <header class="card-header">
									  <?php echo lang('websites_management'); ?>
								  </header>
									<v-card>
										<template>
											<v-data-table
												:headers="headers"
												:items="list_tasks"
												item-key="name_task"
												select-all
												class="elevation-1"
											>
												<template slot="items" slot-scope="props">
													<td><v-checkbox @change="f_checkTask(props.item)" v-model="props.item.check_tasks" primary hide-details></v-checkbox></td>
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
										</template>
									</v-card>

								</section>
							</div>
						</div>
					</div>
				</div>

				<div class="step-navigation">
					<button class="prevBtn mat-accent white-fg mat-fab" style="display: none;">
						<span class="mat-button-wrapper">
							<i class="icon-chevron-left" aria-hidden="true"></i>
						</span>
						<div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
						<div class="mat-button-focus-overlay"></div>
					</button>
					<button class="nextBtn mat-accent white-fg mat-fab" style="display: block;">
						<span class="mat-button-wrapper">
							<i class="icon-chevron-right" aria-hidden="true"></i>
						</span>
						<div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
						<div class="mat-button-focus-overlay"></div>
					</button>
					<button class="done mat-green-600-bg mat-fab mat-accent" mat-fab="" routerlink="/apps/academy/courses" tabindex="0" disabled="" style="display: none;"><span class="mat-button-wrapper"><mat-icon class="mat-icon ng-tns-c58-59 material-icons" role="img" aria-hidden="true">check</mat-icon></span>
						<div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
						<div class="mat-button-focus-overlay"></div>
					</button>
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
        <v-card-title
          class="headline green lighten-2"
          primary-title
        >
          Ajouter une tâche
        </v-card-title>

        <v-card-text>
			<v-container grid-list-md>
				<v-layout wrap>
					<v-flex xs12>
						<v-text-field label="Titre Task"  v-model="newCard.name_card_tasks" required></v-text-field>
					</v-flex>
					<v-flex xs12>
						<v-text-field v-model="newCard.id_card_task" type="number" min="newCard.max" :max="newCard.max" required></v-text-field>
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
<v-dialog
      v-model="dialog_add_task"
      width="500"
    >
	<v-card>
        <v-card-title
          class="headline green lighten-2"
          primary-title
        >
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
			              item-value="name_user">
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
			                  <v-list-tile-content v-text="data.item"></v-list-tile-content>
			                </template>
			                <template v-else>
			                  <v-avatar color="red">
      <span class="white--text headline">J</span>
    </v-avatar>
			                  <v-list-tile-content>
			                    <v-list-tile-title v-html="data.item.name_user"></v-list-tile-title>
			                  </v-list-tile-content>
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
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">

var v = new Vue({
	el: '#app',
    data : {
    	steps: <?php echo json_encode($all_card_tasks->result_array()); ?>,
        users: <?php echo json_encode($list_users->result_array()); ?>,
    	dialog_add_task: false,
    	dialog_add_card: false,
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
			id_card_task: <?php echo $all_card_tasks->num_rows()+1; ?>,
			min: "1",
			max: <?php echo $all_card_tasks->num_rows()+1; ?>,
		},
		newTask:{
		    nametask:'',
		    user:'',
		},
		check_tasks_complete:0,
		valueDeterminate: 0,
        title_card_tasks:"",
        list_tasks: [],
    },
    created(){
		this.displayPage();
    },
    methods:{
    	displayPage(){
			var formData = new FormData(); 
			formData.append("id_project_tasks",this.id_project);
			formData.append("id_card_tasks",this.id_card);
    		axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
				if(response.status = 200){
					if (response.data.card_tasks.tasks != null) {
						for (var i = 0; i < response.data.card_tasks.tasks.length; ++i) {
							
							if (response.data.card_tasks.tasks[i].check_tasks=="1") {
								response.data.card_tasks.tasks[i].check_tasks = true;
								v.check_tasks_complete++;
							} else {
								response.data.card_tasks.tasks[i].check_tasks=false;
							}
							v.list_tasks.push(response.data.card_tasks.tasks[i]);
						}
					}
					v.valueDeterminate = v.f_isNaN((v.check_tasks_complete/v.list_tasks.length)*100);
					v.title_card_tasks = response.data.title_card_tasks;
				}else{

				}
			})
        },
		changeCard(id_card_task){
			var formData = new FormData(); 
    		formData.append("id_project_tasks",this.id_project);
			formData.append("id_card_tasks",id_card_task);
    		axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
				if(response.status = 200){
					v.check_tasks_complete = 0;
					v.list_tasks = [];

					v.id_card = id_card_task;
					if (response.data.card_tasks.tasks != null) {
						for (var i = 0; i < response.data.card_tasks.tasks.length; ++i) {

							if (response.data.card_tasks.tasks[i].check_tasks=="1") {
								response.data.card_tasks.tasks[i].check_tasks = true;
								v.check_tasks_complete++;
							} else {
								response.data.card_tasks.tasks[i].check_tasks=false;
							}
							v.list_tasks.push(response.data.card_tasks.tasks[i]);
						}
					}
					v.valueDeterminate = v.f_isNaN((v.check_tasks_complete/v.list_tasks.length)*100);
					v.title_card_tasks = response.data.title_card_tasks;
				}else{

				}
			})
        },
		f_createCard(){
			var formData = new FormData();
			formData.append("name_card_tasks",v.newCard.name_card_tasks);
			formData.append("id_card_task",v.newCard.id_card_task);
			formData.append("id_project_tasks",v.id_project);
			axios.post(this.currentRoute+"/create-card-tasks/", formData).then(function(response){
				if(response.status = 200){
					v.steps.push({title_card_tasks: v.newCard.name_card_tasks,id_card_tasks: v.newCard.id_card_task,id_project_tasks: v.id_project});
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
						const index = v.steps.indexOf(item);
						v.steps.splice(index, 1);
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
			formData.append("check_tasks",item.check_tasks);
			axios.post(this.currentRoute+"/check-tasks/", formData).then(function(response){
				if(response.status = 200){
					// item.check_tasks = (item.check_tasks=1?true:false);
					if (item.check_tasks == 1) {
						v.valueDeterminate = v.f_isNaN((v.check_tasks_complete+1)/v.list_tasks.length*100)
						v.check_tasks_complete++
					} else {
						v.valueDeterminate = v.f_isNaN((v.check_tasks_complete-1)/v.list_tasks.length*100)
						v.check_tasks_complete--
					}
					
					/*v.steps = response.data.card_tasks.name_tasks_status
					Object.assign(v.steps[v.steps.indexOf(item)], v.editedItem)*/
				}else{

				}
			})
		},
		f_createTask(){
			var formData = new FormData();
			formData.append("nametask",this.newTask.nametask);
			formData.append("user",this.newTask.user);
			formData.append("id_project_tasks",this.id_project);
			formData.append("id_card_tasks",this.id_card);
			axios.post(this.currentRoute+"/create-task/", formData).then(function(response){
				if(response.status = 200){
					v.list_tasks.push({name_task: v.newTask.nametask,username: v.newTask.user})
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
})

$(document).ready(function(){


	/*$("#form-task").submit(function(e){
		$.ajax({
			type: "POST",
			url: $(this).attr('action'),
			data: $(this).serialize()+"&id_project="+window.location.href.split('/').pop()+"&id_card_tasks="+$('.current .index span').attr('data-val'),
			success: function(msg){
				$("#create-task").modal('hide');
				//$("#table-view-project").DataTable().rows.add(data.list_tasks_preview).draw();
				new PNotify({
				    text    : 'Vous avez creer une nouvelle task',
				    type: 'success',
				    confirm : {
				        confirm: true,
				        buttons: [
				            {
				                text    : 'Dismiss',
				                addClass: 'btn btn-link',
				                click   : function (notice) {
				                    notice.remove();
				                }
				            },
				            null
				        ]
				    },
				    buttons : {
				        closer : false,
				        sticker: false
				    },
				    animate : {
				        animate  : true,
				        in_class : 'slideInDown',
				        out_class: 'slideOutUp'
				    },
				    addclass: 'md'
				});
			},
			error: function(msg){
				console.log(msg.responseText);
			}
		});
		e.preventDefault();
	});*/


   /*
	$(".add-user").click(function() {
		$('#autocomplete-user').show().focus();
		$(this).hide();
	});
	$('#autocomplete-user').blur(function() {
		$(".add-user").show();
		$(this).hide();
	});

	$(".add-card-link").click(function() {
		$(this).hide();
		$(".add-card-form").slideDown();
	});
	$(".add-card-form a").click(function() {
		$(".add-card-form").hide();
		$(".add-card-link").show();
	});
	
	$(".kanban-entry").click(function(e){
		var idcard = $(this).data('id');
		$.ajax({
			type: "POST",
			url: $(this).attr('href'),
			data: {'idproject':window.location.href.split('/').pop() ,'idcard':idcard},
			success: function(data){
				$('#view-card-tasks #titlelisttasks').empty();
				$('#view-card-tasks #descriptiontask').empty();
				$('#view-card-tasks #tasks').empty();
				$('#view-card-tasks .checklist-progress-value').empty();
				var jsdata = JSON.parse(data);

				$('#view-card-tasks #titlelisttasks').val(jsdata.card_tasks.title_card_tasks);
				$('#view-card-tasks #descriptiontask').val(jsdata.card_tasks.description_card_tasks);
				$('#view-card-tasks .checklist-progress-value').append(jsdata.card_tasks.count_tasks_completed+' / '+jsdata.card_tasks.tasks.length);
				$('#view-card-tasks .progress-bar').css({ width: (jsdata.card_tasks.count_tasks_completed/jsdata.card_tasks.tasks.length)*100+'%' });
				$.each(jsdata.card_tasks.tasks, function(i, item) {
					$('#tasks').append('<div class="todo-item pr-2 py-4 ripple row no-gutters flex-wrap flex-sm-nowrap align-items-center fuse-ripple-ready"><label class="custom-control custom-checkbox"><input type="checkbox" value="'+jsdata.card_tasks.tasks[i].id_task+'" class="form-check-input"><span class="checkbox-icon fuse-ripple-ready"></span></label><input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="'+jsdata.card_tasks.tasks[i].name_task+'"><span class="w-40 avatar circle green" data-toggle="tooltip" data-placement="top" title="" value="'+jsdata.card_tasks.tasks[i].username+'" data-original-title="quentin">'+jsdata.card_tasks.tasks[i].username+'</span></div><div class="buttons col-12 col-sm-auto d-flex align-items-center justify-content-end"><button type="button" class="btn btn-icon fuse-ripple-ready"><i class="icon icon-dots-vertical"></i></button></div>');
				});


			},
			error: function(msg){
				console.log(msg.responseText);
			}
		});
		e.preventDefault();
	});
	$("#form-list-tasks").submit(function(e){
		$.ajax({
			type: "POST",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(msg){
				console.log(msg.responseText);
			},
			error: function(msg){
				console.log(msg.responseText);
			}
		});
		e.preventDefault();
	});
	$("#form-task").submit(function(e){
		$.ajax({
			type: "POST",
			url: $(this).attr('action'),
			data: $(this).serialize(),
			success: function(msg){
				console.log(msg.responseText);
			},
			error: function(msg){
				console.log(msg.responseText);
			}
		});
		e.preventDefault();
	});
	$(document).on("click", ".checkbox-icon", function(e) {
		$.ajax({
			type: "POST",
			url: window.location.href.substr(0, window.location.href.lastIndexOf('/') + 1)+'/edit-tasks/'+id,
			data: $(this).serialize(),
			success: function(msg){
				console.log(msg.responseText);
			},
			error: function(msg){
				console.log(msg.responseText);
			}
		});
		e.preventDefault();
	});
	$('#view-task').on('show.bs.modal', function (event) {
		var idlisttasks = $(event.relatedTarget).data('id');

		$(this).find('.modal-body input#idlisttasks').val(idlisttasks);
	});


			var kanbanCol = $('.card-body');
			kanbanCol.css('max-height', (window.innerHeight - 380) + 'px');

			var kanbanColCount = parseInt(kanbanCol.length);
			$('.container-fluid').css('min-width', (kanbanColCount * 350) + 'px');

			draggableInit();

			$('.card-header').click(function() {
				var $cardBody = $(this).parent().children('.card-body');
				$cardBody.slideToggle();
			});
		function draggableInit() {
			var sourceId;
			$('[draggable=true]').bind('dragstart', function (event) {
				sourceId = $(this).parent().attr('id');
				event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
			});
			$('.card-body').bind('dragover', function (event) {
				event.preventDefault();
			});
			$('.card-body').bind('drop', function (event) {
				var children = $(this).children();
				var targetId = children.attr('id');
				if (sourceId != targetId) {
					var elementId = event.originalEvent.dataTransfer.getData("text/plain");
					$('#processing-modal').modal('toggle'); //before post
					setTimeout(function () {
						var element = document.getElementById(elementId);
						children.prepend(element);
						$('#processing-modal').modal('toggle'); // after post
					}, 1000);
				}
				event.preventDefault();
			});
		}*/






	

});
</script>

<?php $this->load->view('include/footer.php'); ?>