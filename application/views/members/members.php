<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('members'); ?></h2>
	</div>
	<div class="page-content-wrapper">
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
									<template v-slot:top>
										<v-toolbar flat color="white">
											<v-spacer></v-spacer>
											<v-dialog v-model="dialog_add_user" max-width="500px">
												<template v-slot:activator="{ on }">
													<v-btn color="primary" dark class="mb-2" v-on="on">New User</v-btn>
												</template>
												<v-card>
													<v-card-title>
														<span class="headline">Add User</span>
													</v-card-title>

													<v-card-text>
														<v-container>
															<v-row>
																<v-col cols="12" sm="12" md="12">
																	<v-text-field v-model="addUser.name_user" label="Name User"></v-text-field>
																</v-col>
																<v-col cols="12" sm="12" md="12">
																	<v-text-field v-model="addUser.email" label="Email"></v-text-field>
																</v-col>
																<v-col cols="12" sm="12" md="12">
																	<v-text-field v-model="addUser.password" label="Password" type="password"></v-text-field>
																</v-col>
																<v-col cols="12" sm="12" md="12">
																	<v-text-field v-model="addUser.password_confirm" label="Password Confirm" type="password"></v-text-field>
																</v-col>
															</v-row>
														</v-container>
													</v-card-text>
													<div id="results">
														<v-alert v-for="error in result.errors" v-model="result.alert" type="error"> {{ error }}</v-alert>
													</div>
													<v-card-actions>
														<div class="flex-grow-1"></div>
														<v-btn color="blue darken-1" text @click="f_addUser()">Save</v-btn>
														<v-btn color="blue darken-1" text @click="dialog_add_user = false">Cancel</v-btn>
													</v-card-actions>
												</v-card>
											</v-dialog>
										</v-toolbar>
									</template>
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
													<v-icon>mdi-dots-vertical</v-icon>
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