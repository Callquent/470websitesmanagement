<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('websites_management'); ?></h2>
	</div>
	<div class="page-content">

		<v-container fluid grid-list-sm>
			<v-layout row wrap>
				<v-flex xs12>
					<v-card>
						<template>
							<v-card-title>
								Search ...
								<div class="flex-grow-1"></div>
								<v-text-field
								v-model="search"
								append-icon="search"
								label="Search"
								single-line
								hide-details
								></v-text-field>
							</v-card-title>
							<v-data-table
									:headers="headers"
									:items="list_website"
									class="elevation-1"
									:search="search"
									:footer-props="{
									'items-per-page-options': [10,20,50,100]
									}"
								>
										<template v-slot:item.name_website="props">
											<v-edit-dialog
												:return-value.sync="props.item.name_website"
												@open="props.item._name_website = props.item.name_website"
												@save="f_editWebsite(props.item)"
												@cancel="props.item.name_website = props.item._name_website || props.item.name_website"
												large
												lazy
											  >{{ props.item.name_website }}
												<v-text-field
													slot="input"
													label="Edit"
													v-model="props.item.name_website"
													single-line
													counter
													autofocus
												></v-text-field>
											</v-edit-dialog>
										</template>
										<template v-slot:item.url_website="props">
											<v-edit-dialog
												:return-value.sync="props.item.url_website"
												@open="props.item._url_website = props.item.url_website"
												@save="f_editWebsite(props.item)"
												@cancel="props.item.url_website = props.item._url_website || props.item.url_website"
												large
												lazy>{{ props.item.url_website }}
													<v-text-field
														slot="input"
														label="Edit"
														v-model="props.item.url_website"
														single-line
														counter
														autofocus
													></v-text-field>
											</v-edit-dialog>
										</template>
										<template v-slot:item.address_ip="props">
											{{ props.item.address_ip }}
										</template>
										<template v-slot:item.name_category="props">
											<v-edit-dialog
												:return-value.sync="props.item.name_category"
												@open="props.item._name_category = props.item.name_category"
												@save="f_editWebsite(props.item)"
												@cancel="props.item.name_category = props.item._name_category || props.item.name_category"
												large
												lazy
											  >{{ props.item.name_category }}
												<v-select
												v-model="props.item.id_category"
												slot="input"
												:items="list_category"
												item-text="name_category"
												item-value="id_category"
												label="Choose category"
												single-line
												autofocus
												persistent-hint
												return-object>
												</v-select>
											</v-edit-dialog>
										</template>
										<template v-slot:item.name_language="props">
											<v-edit-dialog
												:return-value.sync="props.item.name_language"
												@open="props.item._name_language = props.item.name_language"
												@save="f_editWebsite(props.item)"
												@cancel="props.item.name_language = props.item._name_language || props.item.name_language"
												large
												lazy
											  >{{ props.item.name_language }}
												<v-select
												v-model="props.item.id_language"
												slot="input"
												label="Choose language"
												:items="list_language"
												item-text="name_language"
												item-value="id_language"
												single-line
												autofocus>
												</v-select>
											</v-edit-dialog>
										</template>
										<template v-slot:item.access="props">
											<v-btn :href="currentRoute+'/'+props.item.id_website" flat icon color="grey darken-1">
												<v-icon>remove_red_eye</v-icon>
											</v-btn>
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
													<v-list-item :href="'http://'+props.item.url_website" target="_blank" id="edit-dashboard">
															<v-list-item-title>Open URL Website</v-list-item-title>
													</v-list-item>
													<?php if($this->aauth->is_group_allowed('delete_website',$user_role[0]->name)) { ?>
													<v-list-item  @click="f_deleteWebsite(props.item)"  id="delete-dashboard">
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


	  
			</div>
		</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
	    data : {
	    	sidebar:"general",
	    	search:"",
	        currentRoute: window.location.href,
			headers: [
				{ text: '<?php echo lang("name"); ?>', value: 'name_website'},
				{ text: '<?php echo lang("website"); ?>', value: 'url_website'},
				{ text: '<?php echo lang("address_ip"); ?>', value: 'address_ip' },
				{ text: '<?php echo lang("categories"); ?>', value: 'name_category'},
				{ text: '<?php echo lang("languages"); ?>', value: 'name_language'},
				{ text: '<?php echo lang("access"); ?>', value: 'access'},
				{ text: '<?php echo lang("actions"); ?>', value: 'actions' },
			],
	        list_website: <?php echo json_encode($all_websites->result_array()); ?>,
	        list_category: <?php echo json_encode($all_categories->result_array()); ?>,
	        list_language: <?php echo json_encode($all_languages->result_array()); ?>,
	        list_ftp:  [],
	        list_database:  [],
	        list_backoffice:  [],
	        list_htaccess:  [],
	    },
	    mixins: [mixin],
	    created(){
	        this.displayPage();
	    },
	    methods:{
	        displayPage(){

	        },
	        f_editWebsite(item){
				var formData = new FormData(); 
				formData.append("id_website",item.id_website);
				formData.append("name_website",item.name_website);
				formData.append("url_website",item.url_website);
				formData.append("id_category",item.id_category);
				formData.append("id_language",item.id_language);
				axios.post(this.currentRoute+"/edit-website/", formData).then(function(response){
					console.log(response);
				})
			},
			f_opendialog_Access(item){
				var formData = new FormData();
				formData.append("id_website",item.id_website);
				axios.post(this.currentRoute+"/view-access-website/", formData).then(function(response){
					if(response.status = 200){
						v.list_ftp = response.data.ftp;
						v.list_database = response.data.databas;
						v.list_backoffice = response.data.backoffice;
						v.list_htaccess = response.data.htaccess;
					}else{

					}
				})
				v.dialog_access = true;
			},
			f_deleteWebsite(item){
				var formData = new FormData();
				formData.append("id_website",item.id_website);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete-website/", formData).then(function(response){
						if(response.status = 200){
							const index = v.list_website.indexOf(item)
							v.list_website.splice(index, 1)
						}else{

						}
					})
				}
			}
	    }
	});
</script>
<?php $this->load->view('include/footer.php'); ?>