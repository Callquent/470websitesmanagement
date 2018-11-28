<?php $this->load->view('include/header.php'); ?>

<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo $project->name_project_tasks; ?></h2>
		<a href="<?php echo site_url('/all-projects/'); ?>" class="btn btn-icon fuse-ripple-ready">
			<i class="icon icon-arrow-left-thick"></i>
		</a>
		<a id="add-event-button" class="btn btn-danger btn-fab fuse-ripple-ready" href="javascript:void(0);" data-toggle="modal" data-target="#create-card-task">
			<i class="icon icon-plus"></i>
		</a>
	</div>
	<div class="page-content">
	  <section id="main-content" >
		  <section class="wrapper">
			<div class="row">
				<div class="col-sm-12">



<div class="ng-tns-c58-59 ng-star-inserted">
	<div class="page-layout simple left-sidebar inner-scroll" id="academy-course">
		<aside class="sidebar left-positioned open locked-open col-md-2 d-none d-lg-block">
			<div class="content ">

				<v-stepper non-linear vertical>
					<template v-for="step in steps">
						<v-stepper-step 
							
							@click.native="changeCard(step.id_card_tasks)"
							editable
							:step="step.id_card_tasks">
							{{ step.title_card_tasks }}
						</v-stepper-step>
						<v-stepper-content :step="step.id_card_tasks"></v-stepper-content>
					</template>
				</v-stepper>
  

<aside class="sidebar left-positioned open locked-open col-md-2 d-none d-lg-block">
			<div class="content ">
				<div class="steps">
					<?php foreach ($all_card_tasks->result() as $key => $row_list_tasks) { ?>
						<?php if ($row_list_tasks->id_card_tasks==1) { ?>
							<a href="#step-<?php echo $row_list_tasks->id_card_tasks; ?>" class="step ng-tns-c58-59 current first ng-star-inserted <?php echo $row_list_tasks->name_tasks_status; ?>">
								<div class="index">
									<span data-val="<?php echo $row_list_tasks->id_card_tasks; ?>"><?php echo $row_list_tasks->id_card_tasks; ?></span>
									<?php echo ($row_list_tasks->id_tasks_status == 3?'<i class="icon icon-check-circle"></i>':'') ?>
								</div>
								<div class="title"><?php echo $row_list_tasks->title_card_tasks; ?></div>
							</a>
						<?php } else { ?>
							<a href="#step-<?php echo $row_list_tasks->id_card_tasks; ?>" class="step ng-tns-c58-59 ng-star-inserted <?php echo $row_list_tasks->name_tasks_status; ?>">
								<div class="index">
									<span data-val="<?php echo $row_list_tasks->id_card_tasks; ?>"><?php echo $row_list_tasks->id_card_tasks; ?></span>
									<?php echo ($row_list_tasks->id_tasks_status == 3?'<i class="icon icon-check-circle"></i>':'') ?>
								</div>
								<div class="title"><?php echo $row_list_tasks->title_card_tasks; ?></div>
							</a>
						<?php } ?>
					<?php } ?>
				</div>
			</div>
		</aside>


			</div>
		</aside>
		<div class="center col-md-10">
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
									  	<a class="dropdown-item fuse-ripple-ready" href="javascript:void(0);" data-toggle="modal" data-target="#create-task"><i class="fa fa-eye"></i> Ajouter</a>
										<a class="dropdown-item fuse-ripple-ready" id="delete-card-tasks" @click="deleteCard(step)"><i class="fa fa-eye"></i> Supprimer</a>
										<div class="dropdown-divider"></div>
									  </div>
								  </div>								
							</div>
							<section class="card mb-3">
							  <header class="card-header">
								  <?php echo lang('websites_management'); ?>
							  </header>

								<div class="card-body">

									<template>
										<v-data-table
											v-model="selected"
											:headers="headers"
											:items="list_tasks"
											select-all
											class="elevation-1"
										>
											<template slot="items" slot-scope="props">
												<td><v-checkbox @change="test()" v-model="props.selected" primary hide-details></v-checkbox></td>
												<td>{{ props.item.name_task }}</td>
												<td class="text-xs-left">{{ props.item.username }}</td>
												<td class="justify-center layout px-0">
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

								</div>
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
		</div>
	</div>
</div>



			</div>
		</div>
	</section>
</section>

	</div>
  </div>
</div>
<div class="modal fade" id="create-card-task" tabindex="-1" role="dialog" aria-labelledby="create-card-task" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header modal-header-success">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
		<h4 class="modal-title custom_align" id="Heading">Ajouter une card de tâches</h4>
	  </div>
		<form id="form-card-tasks" @submit.prevent="createCard">
		  <div class="modal-body">
			<div class="form-group">
				<label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
				<div class="col-lg-12">
				  <input class="form-control" type="text" name="name_card_tasks" placeholder="Titre Liste Tasks" v-model="newCard.name_card_tasks" required />
				</div>
			</div>
			<div class="form-group">
				<input class="form-control md-has-value" type="number" name="id_card_task"  v-model.number="newCard.id_card_task" value="<?php echo $all_card_tasks->num_rows()+1; ?>" min="1" max="<?php echo $all_card_tasks->num_rows()+1; ?>"  required>
				<label for="example-number-input">Number</label>
			</div>
		  </div>
		  <div class="modal-footer ">
			<button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-share"></span><?php echo lang('save'); ?></button>
			<button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><?php echo lang('cancel'); ?></button>
		  </div>
		</form>
	</div>
  </div>
</div>

<div class="modal fade" id="create-task" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Ajouter une tâche</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="form-task" @submit.prevent="createTask">
					<div class="form-group">
						<input class="titletasks form-control" type="text" name="nametask" placeholder="Titre Task" v-model="newTask.nametask" required/>
					</div>
					<div class="form-group">

<template>
  <v-card
    color="blue-grey darken-1"
    dark
  >
      <v-form>
      <v-container>
        <v-layout wrap>
          <v-flex xs12 md6>
			<v-autocomplete
              v-model="newTask.user"
              :disabled="isUpdating"
              :items="users"
              box
              chips
              color="blue-grey lighten-2"
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
                  <v-list-tile-avatar>
                    <img :src="data.item.avatar">
                  </v-list-tile-avatar>
                  <v-list-tile-content>
                    <v-list-tile-title v-html="data.item.name_user"></v-list-tile-title>
                  </v-list-tile-content>
                </template>
              </template>
            </v-autocomplete>
         </v-flex>
                 </v-layout>
      </v-container>
    </v-form>
</v-card>
</template>

						<!-- <input type="text" class="form-control" name="user" id="autocomplete-user" v-model="newTask.user">
						<label for="url-user">Url User</label> -->
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary btn-lg">ADD Tasks</button>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary fuse-ripple-ready" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary fuse-ripple-ready">Send message</button>
			</div>
		</div>
	</div>
</div>

<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
	el: '#app',
    data : {
		currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
		id_project: window.location.href.split('/').pop(),
		id_card: $('.v-stepper__step--active .v-stepper__step__step').text(),
		headers: [
			{ text: 'Name Task', value: 'name_task', sortable: false},
			{ text: 'User', value: 'username' },
			{ text: 'Actions', value: 'name', sortable: false }
		],
		newCard:{
			name_card_tasks:"",
			id_card_task:"",
		},
		newTask:{
		    nametask:'',
		    user:'',
		},
        title_card_tasks:"",
        list_tasks: [],
        steps: [],
        users: [],
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
					v.list_tasks = response.data.card_tasks.tasks;
					v.title_card_tasks = response.data.title_card_tasks;
				}else{

				}
			})
        },
        test(){
    		console.log(data);
        },
        changeCard(id_card_task){
    		var formData = new FormData(); 
    		formData.append("id_project_tasks",this.id_project);
			formData.append("id_card_tasks",id_card_task);
    		axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
				if(response.status = 200){
					v.list_tasks = response.data.card_tasks.tasks;
					v.title_card_tasks = response.data.title_card_tasks;
				}else{

				}
			})
        },
		createCard(){
			var formData = new FormData();
			formData.append("name_card_tasks",this.newCard.name_card_tasks);
			formData.append("id_card_task",this.newCard.id_card_task);
			formData.append("id_project_tasks",this.id_project);
			axios.post(this.currentRoute+"/create-card-tasks/", formData).then(function(response){
				if(response.status = 200){
					v.steps.push({title_card_tasks: v.newCard.name_card_tasks,id_card_tasks: v.newCard.id_card_task,id_project_tasks: v.id_project})
				}else{

				}
			})
		},
		deleteCard(item){
			var formData = new FormData();
			formData.append("id_project_tasks",this.id_project);
			formData.append("id_card_task",this.id_card);
			axios.post(this.currentRoute+"/delete-card-tasks/", formData).then(function(response){
				if(response.status = 200){
					const index = v.steps.indexOf(item)
					confirm('Are you sure you want to delete this item?') && v.steps.splice(index, 1)
				}else{

				}
			})
		},
		createTask(){
			var formData = new FormData();
			formData.append("nametask",this.newTask.nametask);
			formData.append("user",this.newTask.user);
			formData.append("id_project_tasks",this.id_project);
			formData.append("id_card_tasks",$('.v-stepper__step--active .v-stepper__step__step').text());
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
			axios.post(this.currentRoute+"/delete_task/", formData).then(function(response){
				if(response.status = 200){
					const index = v.list_tasks.indexOf(item)
					confirm('Are you sure you want to delete this item?') && v.list_tasks.splice(index, 1)
				}else{

				}
			})
		},
    }
})
v.steps = <?php echo json_encode($all_card_tasks->result_array()); ?>;
v.users = <?php echo json_encode($list_users->result_array()); ?>;

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
	$(document).on("change", ".checkbox-task", function(e) {
		$.ajax({
			type: "POST",
			url: window.location.href.substr(0, window.location.href.lastIndexOf('/') + 1)+'check_tasks/',
			data: {'id_project':window.location.href.split('/').pop() ,'id_card_tasks':$('.current .index span').attr('data-val') ,'id_task':$(this).val() ,'check_tasks':$(this).is(":checked")?1:0},
			success: function(msg){
				console.log(msg.responseText);
			},
			error: function(msg){
				console.log(msg.responseText);
			}
		});
		e.preventDefault();
	});



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