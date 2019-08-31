<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('members'); ?></h2>
	</div>
	<div class="page-content-wrapper">
		<!-- <aside class="page-sidebar p-6" data-fuse-bar="contacts-sidebar" data-fuse-bar-media-step="md">
			<div class="page-sidebar-card">
				<div class="header p-4">
					<div class="row no-gutters align-items-center">
						<span class="w-40 avatar circle green" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $login; ?>" value="<?php echo $login; ?>"><?php echo substr($login, 0, 2); ?></span>
						<span class="font-weight-bold"><?php echo $login; ?></span>
					</div>
				</div>
				<div class="divider"></div>
				<div class="content">
					<ul class="nav flex-column groups-members">
						<div class="divider"></div>
						<li class="nav-item">
							<a class="all-groups-members nav-link ripple active fuse-ripple-ready" href="#">
								<span>All</span>
							</a>
						</li>
						<div class="divider"></div>
						<li class="subheader">Groups</li>
						<div class="divider"></div>
						<?php foreach ($list_groups->result() as $row){  ?>
							<li class="nav-item">
								<a class="nav-link ripple active fuse-ripple-ready" href="#">
									<span><?php echo $row->name; ?></span>
								</a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</aside> -->

		<v-container fluid grid-list-sm>
			<v-layout row wrap>

				<v-flex xs12 sm2>
					<v-card>
						<v-toolbar color="light-blue">
							<v-toolbar-title>Groups</v-toolbar-title>
						</v-toolbar>
						<v-list>
							<v-list-item-group>
								<v-list-item v-for="group in list_user_groups" @click="search">
									<v-list-item-content>
										<v-list-item-title>{{ group.name }}</v-list-item-title>
									</v-list-item-content>
								</v-list-item>
							</v-list-item-group>
						</v-list>
					</v-card>
				</v-flex>

				<v-flex xs12 sm10>
					<v-toolbar flat color="white">
					  <v-spacer></v-spacer>
					  <v-dialog v-model="dialog_add_user" max-width="500px">
						<v-btn slot="activator" color="primary" class="mb-2">New User</v-btn>
						<v-card>
						  <v-card-title>
							<span class="headline">Add User</span>
						  </v-card-title>

						  <v-card-text>
							<v-container grid-list-md>
							  <v-layout wrap>
								<v-flex xs12 sm12 md12>
									<v-text-field v-model="addUser.name_user" label="Name User"></v-text-field>
								</v-flex>
								<v-flex xs12 sm12 md12>
									<v-text-field v-model="addUser.email" label="Email"></v-text-field>
								</v-flex>
								<v-flex xs12 sm12 md12>
									<v-text-field v-model="addUser.password" label="Password" type="password"></v-text-field>
								</v-flex>
								<v-flex xs12 sm12 md12>
									<v-text-field v-model="addUser.password_confirm" label="Password Confirm" type="password"></v-text-field>
								</v-flex>
							  </v-layout>
							</v-container>
						  </v-card-text>
							<div id="results">
								<v-alert v-for="error in result.errors" v-model="result.alert" type="error"> {{ error }}</v-alert>
							</div>
						  <v-card-actions>
							<v-spacer></v-spacer>
							<v-btn color="blue" flat @click="f_addUser()">Save</v-btn>
							<v-btn color="blue" flat @click="dialog_add_user = false">Cancel</v-btn>
						  </v-card-actions>
						</v-card>
					  </v-dialog>
					</v-toolbar>

					<v-card>
						<template>
								<v-data-table
									:headers="headers"
									:items="filteredItems"
									class="elevation-1"
									:footer-props="{
									'items-per-page-options': [10,20,50,100]
									}"
								>
									<template v-slot:item.username="props">
										{{ props.item.name_user }}
									</template>
									<template v-slot:item.email="props">
										{{ props.item.email }}
									</template>
									<template v-slot:item.groups="props">
										{{ props.item.name_group }}
									</template>
									<template v-slot:item.actions="props">
										<v-menu bottom left>
											<template v-slot:activator="{ on }">
												<v-btn flat icon v-on="on" color="grey darken-1">
													<v-icon>more_vert</v-icon>
												</v-btn>
											</template>
											<v-divider></v-divider>
											<v-list>
												<v-list-item @click="dialogUser(props.item)" id="edit-members">
														<v-list-item-title>Edit</v-list-item-title>
												</v-list-item>
												<?php if($this->aauth->is_group_allowed('delete_website',$user_role[0]->name)) { ?>
												<v-list-item  @click="f_deleteUser(props.item)"  id="delete-dashboard">
														<v-list-item-title><?php echo lang('delete') ?></v-list-item-title>
												</v-list-item>
												<?php } ?>
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

<v-dialog v-model="dialog_edit_user" max-width="500px">
	<v-card>
	  <v-card-title>
		<span class="headline">Edit User</span>
	  </v-card-title>

	  <v-card-text>
		<v-container grid-list-md>
		  <v-layout wrap>
			<v-flex xs12 sm6 md4>
				<v-text-field v-model="editUser.name_user" label="Name User" disabled></v-text-field>
			</v-flex>
			<v-flex xs12 sm6 md4>
				<v-text-field v-model="editUser.email" label="Email"></v-text-field>
			</v-flex>
			<v-flex xs12 sm6 md4>
				<v-select
				v-model="editUser.name_group"
				slot="input"
				:items="list_user_groups"
				item-text="name"
				label="Choose Groups"
				single-line
				autofocus
				persistent-hint
				return-object>
				</v-select>
			</v-flex>
		  </v-layout>
		</v-container>
	  </v-card-text>

	  <v-card-actions>
		<v-spacer></v-spacer>
		<v-btn color="blue" flat @click="f_editUser()">Save</v-btn>
		<v-btn color="blue" flat @click="dialog_edit_user = false">Cancel</v-btn>
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
			search: '',
			sidebar:"members",
			dialog_add_user: false,
			dialog_edit_user: false,
			result: {
				alert: false,
				errors: '',
			},
			users: <?php echo json_encode($list_users->result_array()); ?>,
			list_user_groups: <?php echo json_encode($list_groups->result_array()); ?>,
			currentRoute: window.location.href,
			headers: [
				{ text: 'Name User', value: 'username'},
				{ text: 'Email', value: 'email' },
				{ text: 'Groupes', value: 'groups' },
				{ text: 'Actions', value: 'actions', sortable: false }
			],
			addUser:{
				id: '',
				name_user: '',
				email: '',
				password: '',
				password_confirm: '',
				name_group: 'Unknown',
			},
			editUser:{
				id: '',
				email: '',
				name_user: '',
				name_group: '',
				old_name_group: '',
			},
			editIndexUser: -1,
		},
		mixins: [mixin],
		created(){
			this.displayPage();
		},
		computed: {
					filteredItems() {
			      return this.users.filter((i) => {
			        return !this.foodType || (i.name_group === this.foodType);
			      })
			    },
		},
		methods:{
			displayPage(){

			},
			dialogUser(item){
				this.dialog_edit_user = true;
				this.editIndexUser = this.users.indexOf(item);
				this.editUser = Object.assign({}, item);
				var old_name_group = v.list_user_groups.filter(function (el) {
					return el.name == item.name_group;
				})
				this.editUser.name_group = Object.assign({},old_name_group[0]);
				this.editUser.old_name_group = Object.assign({},old_name_group[0]);
			},
			f_addUser(){
					var formData = new FormData();
					formData.append("name",v.addUser.name_user);
					formData.append("email",v.addUser.email);
					formData.append("password",v.addUser.password);
					formData.append("password_confirm",v.addUser.password_confirm);
					axios.post(this.currentRoute+"/create-user/", formData).then(function(response){
						if(response.status = 200){
							if (response.data.length == 0) {
								v.users.push(v.addUser);
								v.dialog_add_user = false;
							} else {
								v.result.errors = response.data;
								v.result.alert = true;
							}
						}else{

						}
					})
			},
			f_editUser(){
					var formData = new FormData();
					formData.append("id_user",v.editUser.id);
					formData.append("email_user",v.editUser.email);
					formData.append("old_idgroup_user",v.editUser.old_name_group.id);
					formData.append("new_idgroup_user",v.editUser.name_group.id);
					axios.post(this.currentRoute+"/edit-user/", formData).then(function(response){
						if(response.status = 200){
							Object.assign(v.users[v.editIndexUser], {id: v.editUser.id,email: v.editUser.email,name_user: v.editUser.name_user,name_group: v.editUser.name_group.name})
							v.dialog_edit_user = false;
						}else{

						}
					})
			},
			f_deleteUser(item){
				var formData = new FormData();
				formData.append("id_user",item.id);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete-user/", formData).then(function(response){
						if(response.status = 200){
							const index = v.users.indexOf(item)
							v.users.splice(index, 1)
						}else{

						}
					})
				}
			},
		}
	});
</script>
<?php $this->load->view('include/footer.php'); ?>