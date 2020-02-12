<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-content">

	  <v-container fluid grid-list-sm>
	    <v-layout row wrap>
	    	<v-flex>
	    				  		<v-card>
	                <template>
						<v-data-table
						    :headers="headers"
						    :items="list_tasks_per_user"
						    class="elevation-1"
						    :items-per-page="-1"
							:footer-props="{
							'items-per-page-options': [10, 20, 30, 40, 50]
							}"
						>
							<template v-slot:item.username="props">
						    	{{ props.item.username }}
							</template>
							<template v-slot:item.all_tasks_progress_user="props">
								<v-chip color="orange" text-color="white" label>
									<span>{{ props.item.all_tasks_progress_user }}</span>
								</v-chip>
							</template>
							<template v-slot:item.all_tasks_completed_user="props">
								<v-chip color="green" text-color="white" label>
									<span>{{ props.item.all_tasks_completed_user }}</span>
								</v-chip>
							</template>
							<template v-slot:item.all_tasks_user="props">
								<v-chip color="teal" text-color="white" label>
									<span>{{ props.item.all_tasks_user }}</span>
								</v-chip>
							</template>
							<template v-slot:item.priority_project_tasks.all_tasks_critical_user="props">
								<v-chip color="teal" text-color="white" label>
									<span>{{ props.item.priority_project_tasks.all_tasks_critical_user }}</span>
								</v-chip>
							</template>
							<template v-slot:item.email="props">
								{{ props.item.email }}
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
										<v-list-item :href="'mailto:'+props.item.email">
											<v-list-item-title id="view-project" >Email</v-list-item-title>
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
	  <section id="main-content">
		  <section class="wrapper">

		  <div class="row">
			  <div class="col-sm-12">
				  <section class="card mb-3">
					  <header class="card-header">
						  Editable Table
					  </header>
					  <div class="card-body">
						  <div class="row">
							  <div class="col-sm-12 float-right">
								  <div class="float-right">
								  </div>
							  </div>
						  </div>
						  <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-users-tasks">
							  <thead>
								<tr>
									<th class="all"><?php echo lang('name'); ?></th>
									<th class="desktop">Tasks Progress</th>
									<th class="desktop">Tasks Completed</th>
									<th class="desktop">All Tasks</th>
									<th class="desktop">Tasks Priority</th>
									<th class="desktop">Email</th>
									<?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
									  <th class="desktop"><?php echo lang('actions'); ?></th>
									<?php } ?>
								</tr>
							  </thead>
							  <tbody>
								<?php foreach ($all_tasks_per_user->result() as $row) { ?>
								  <tr>
									<td><?php echo $row->username; ?></td>
									<td><span class="badge badge-warning"><?php echo $row->all_tasks_progress_user; ?></span></td>
									<td><span class="badge badge-success"><?php echo $row->all_tasks_completed_user; ?></span></td>
									<td><span class="badge badge-info"><?php echo $row->all_tasks_user; ?></span></td>
									<td>
									  <span class="badge badge-danger"><?php echo $row->priority_project_tasks->all_tasks_critical_user; ?> Critical</span><span class="badge badge-warning"><?php echo $row->priority_project_tasks->all_tasks_hight_user; ?> Hight</span><span class="badge badge-primary"><?php echo $row->priority_project_tasks->all_tasks_medium_user; ?> Medium</span><span class="badge badge-success"><?php echo $row->priority_project_tasks->all_tasks_low_user; ?> Low</span>
									</td>
									<td><?php echo $row->email; ?></td>
									<td>
									  <div class="dropdown show actions">
										  <a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
											<i class="icon icon-dots-vertical"></i>
										  </a>
										  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" id="email" href="mailto:<?php echo $row->email; ?>" ><i class="fa fa-envelope"></i> Email</a>
										  </div>
									  </div>
									</td>
								  </tr>
								<?php } ?>
							  </tbody>
						  </table>
					  </div>
				  </section>
			  </div>
		  </div>
		  </section>
	  </section>
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
		    dialog_add_project: false,
			currentRoute: window.location.href,
			headers: [
				{ text: '<?php echo lang('name'); ?>', value: 'username' },
				{ text: 'Tasks Progress', value: 'all_tasks_progress_user' },
				{ text: 'Tasks Completed', value: 'all_tasks_completed_user' },
				{ text: 'All Tasks', value: 'all_tasks_user' },
				{ text: 'Tasks Priority', value: 'progress' },
				{ text: 'Email', value: 'email' },
				{ text: '<?php echo lang("actions"); ?>', value: 'actions'},
			],
			list_tasks_per_user: <?php echo json_encode($all_tasks_per_user->result_array()); ?>,
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