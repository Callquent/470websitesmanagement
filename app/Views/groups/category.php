<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
	<div class="page-layout simple full-width">
		<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
			<h2 class="doc-title" id="content"><?php echo lang('categories'); ?></h2>
		</div>
		<v-container fluid grid-list-sm>
			<v-layout row wrap>
			  <v-flex xs12>
					<v-card>
						<template>
								<v-data-table
									:headers="headers"
									:items="list_category"
									:footer-props="{
									'items-per-page-options': [10,20,50,100]
									}"
								>
									<template v-slot:top>
										<v-toolbar flat color="white">
											<v-spacer></v-spacer>
											<v-dialog v-model="dialog_add_category" max-width="500px">
												<template v-slot:activator="{ on }">
													<v-btn color="primary" dark class="mb-2" v-on="on">New Category</v-btn>
												</template>
												<v-card>
												  <v-card-title>
													<span class="headline">Add Category</span>
												  </v-card-title>

													<v-card-text>
														<v-container>
															<v-row>
																<v-col cols="12" sm="12" md="12">
																	<v-text-field
																	v-model="addCategory.name"
																	label="add category"
																	></v-text-field>
																</v-col>
															</v-row>
														</v-container>
													</v-card-text>

													<v-card-actions>
														<div class="flex-grow-1"></div>
														<v-btn color="blue darken-1" text @click="f_addCategory()">Save</v-btn>
														<v-btn color="blue darken-1" text @click="dialog_add_category = false">Cancel</v-btn>
													</v-card-actions>
												</v-card>
											</v-dialog>
										</v-toolbar>
									</template>
									<template v-slot:item.category="props">
									  <v-edit-dialog
									  class="text-xs-right"
									  @open="props.item._name_category = props.item.name_category"
									  @save="f_editCategory(props.item)"
									  @cancel="props.item.name_category = props.item._name_category || props.item.name_category"
									  large
									  lazy
									  >{{ props.item.name_category }}
									  	<v-text-field
										slot="input"
										label="Edit"
										v-model="props.item.name_category"
										single-line
										counter
										autofocus
										></v-text-field>
									  </v-edit-dialog>
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
												<v-list-item  @click="dialogCategory(props.item)"  id="delete-dashboard">
														<v-list-item-title><?php echo lang('delete') ?></v-list-item-title>
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
	</div>
</div>

<v-dialog v-model="dialog" width="500">
	<v-card>
		<v-card-title
		  class="headline grey lighten-2"
		  primary-title
		>
		  Privacy Policy
		</v-card-title>

		<v-card-text>
		  <v-container grid-list-md>
			<v-layout wrap>
			 <v-flex xs12 sm6>
				<v-select
					v-model="deleteCategory.id_move_category"
							:items="list_delete_category"
							label="Choose category"
							item-text="name_category"
							item-value="id_category"
							required
				></v-select>
			  </v-flex>
			</v-layout>
		  </v-container>
		  <small>*indicates required field</small>
		</v-card-text>
		<v-card-actions>
		  <v-spacer></v-spacer>
			<v-btn color="blue darken-1" text @click="f_deleteCategory()">Save</v-btn>
			<v-btn color="blue darken-1" text @click="dialog = false">Close</v-btn>
		</v-card-actions>
	</v-card>
</v-dialog>
<v-snackbar v-model="message.success" color="success" :timeout="message.timeout" top right><?php echo lang('category_registered'); ?></v-snackbar>
<v-snackbar v-model="message.error" color="error" :timeout="message.timeout" :top="message.y" :left="message.x"><?php echo lang('category_registered'); ?></v-snackbar>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
		data : {
			sidebar:"groups",
			dialog_add_category: false,
			dialog: false,
			currentRoute: window.location.href,
			headers: [
				{ text: '<?php echo lang("category"); ?>', value: 'category' },
				{ text: '<?php echo lang("actions"); ?>', value: 'actions'},
			],
			list_category: <?php echo json_encode($all_categories->result_array()); ?>,
			list_delete_category: [],
			addCategory: {
				name: '',
			},
			deleteCategory:{
				id_move_category: '',
				id_delete_category: '',
			},
			message:{
				success: false,
				error: false,
				timeout: 6000,
			},
		},
		mixins: [mixin],
		created(){
			this.displayPage();
		},
		methods:{
			displayPage(){

			},
			f_addCategory(){
				var formData = new FormData(); 
				formData.append("category",v.addCategory.name);
				axios.post(this.currentRoute+"/add-category/", formData).then(function(response){
					v.message.success = true;
					v.dialog_add_category = false;
					v.list_category.push(response.data);
				})
			},
			f_editCategory(item){
				var formData = new FormData(); 
				formData.append("id_category",item.id_category);
				formData.append("name_category",item.name_category);
				axios.post(this.currentRoute+"/edit-category/", formData).then(function(response){
					
				})
			},
			dialogCategory(item){
				this.dialog = true;
				this.deleteCategory.id_delete_category = item.id_category;
				this.list_delete_category = this.list_category.slice();
				this.list_delete_category.splice(this.list_delete_category.indexOf(item), 1);
			},
			f_deleteCategory(){
				var formData = new FormData(); 
				formData.append("id_move_category",this.deleteCategory.id_move_category);
				formData.append("id_delete_category",this.deleteCategory.id_delete_category);
				axios.post(this.currentRoute+"/delete-category/", formData).then(function(response){
					v.dialog = false;
					v.list_category = v.list_delete_category.slice();
				})
			},
		}
	});
</script>
<?php $this->load->view('include/footer.php'); ?>