<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
	<div class="page-layout simple full-width">
		<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
			<h2 class="doc-title" id="content"><?php echo lang('languages'); ?></h2>
		</div>
		<v-container fluid grid-list-sm>
			<v-layout row wrap>
			  <v-flex xs12>
					<v-card>
						<template>
								<v-data-table
									:headers="headers"
									:items="list_language"
									:class="elevation-1"
									:footer-props="{
									'items-per-page-options': [10,20,50,100]
									}"
								>
									<template v-slot:top>
										<v-toolbar flat color="white">
											<v-spacer></v-spacer>
											<v-dialog v-model="dialog_add_language" max-width="500px">
												<template v-slot:activator="{ on }">
													<v-btn color="primary" dark class="mb-2" v-on="on">New Language</v-btn>
												</template>
												<v-card>
												  <v-card-title>
													<span class="headline">Add Language</span>
												  </v-card-title>

													<v-card-text>
														<v-container>
															<v-row>
																<v-col cols="12" sm="12" md="12">
																	<v-text-field v-model="addLanguage.name" label="add language"></v-text-field>
																</v-col>
															</v-row>
														</v-container>
													</v-card-text>

													<v-card-actions>
														<div class="flex-grow-1"></div>
														<v-btn color="blue darken-1" text @click="f_addLanguage()">Save</v-btn>
														<v-btn color="blue darken-1" text @click="dialog_add_language = false">Cancel</v-btn>
													</v-card-actions>
												</v-card>
											</v-dialog>
										</v-toolbar>
									</template>
									<template v-slot:item.langage="props">
										<v-edit-dialog
											class="text-xs-right"
											:return-value.sync="props.item.name_language"
											@open="props.item._name_language = props.item.name_language"
											@save="f_editLanguage(props.item)"
											@cancel="props.item.name_language = props.item._name_language || props.item.name_language"
											large
											lazy
										  >{{ props.item.name_language }}
											<v-text-field
												slot="input"
												label="Edit"
												v-model="props.item.name_language"
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
												<v-list-item  @click="dialogLanguage(props.item)"  id="delete-dashboard">
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
					v-model="deleteLanguage.id_move_language"
					:items="list_delete_language"
					label="Choose language"
					item-text="name_language"
					item-value="id_language"
					required
				></v-select>
			  </v-flex>
			</v-layout>
		  </v-container>
		  <small>*indicates required field</small>
		</v-card-text>
		<v-card-actions>
		  <v-spacer></v-spacer>
			<v-btn color="blue darken-1" @click="f_deleteLanguage()">Save</v-btn>
			<v-btn color="blue darken-1" @click="dialog = false">Close</v-btn>
		</v-card-actions>
	  </v-card>
</v-dialog>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
		data : {
			sidebar:"groups",
			dialog_add_language: false,
			dialog: false,
			currentRoute: window.location.href,
			headers: [
				{ text: '<?php echo lang("language"); ?>', value: 'langage' },
				{ text: '<?php echo lang("actions"); ?>', value: 'actions'},
			],
			list_language: <?php echo json_encode($all_languages->result_array()); ?>,
			list_delete_language: [],
			addLanguage: {
				name: '',
			},
			deleteLanguage:{
				id_move_language: '',
				id_delete_language: '',
			},
		},
		mixins: [mixin],
		created(){
			this.displayPage();
		},
		methods:{
			displayPage(){

			},
			f_addLanguage(){
				var formData = new FormData(); 
				formData.append("language",v.addLanguage.name);
				axios.post(this.currentRoute+"/add-language/", formData).then(function(response){
					v.dialog_add_language = false;
					v.list_language.push(response.data);
				})
			},
			f_editLanguage(item){
				var formData = new FormData(); 
				formData.append("id_language",item.id_language);
				formData.append("name_language",item.name_language);
				axios.post(this.currentRoute+"/edit-language/", formData).then(function(response){
					
				})
			},
			dialogLanguage(item){
				this.dialog = true;
				this.deleteLanguage.id_delete_language = item.id_language;
				/*this.list_delete_language = this.list_language.filter(function (el) {
					return el.name_language !== item.name_language
				});*/
				this.list_delete_language = this.list_language.slice();
				this.list_delete_language.splice(this.list_delete_language.indexOf(item), 1);
			},
			f_deleteLanguage(){
				var formData = new FormData(); 
				formData.append("id_move_language",this.deleteLanguage.id_move_language);
				formData.append("id_delete_language",this.deleteLanguage.id_delete_language);
				axios.post(this.currentRoute+"/delete-language/", formData).then(function(response){
					  v.dialog = false;
					v.list_language = v.list_delete_language.slice();
				})
			},
		}
	});
</script>
<?php $this->load->view('include/footer.php'); ?>