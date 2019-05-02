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
								<v-spacer></v-spacer>
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
									:rows-per-page-items="[10,20,50,100]"
									:search="search"
								>
									<template slot="items" slot-scope="props">
										<td>
											<v-edit-dialog
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
										</td>
										<td>
											<v-edit-dialog
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
										</td>
										<td>{{ props.item.address_ip }}</td>
										<td>
											<v-edit-dialog
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
										</td>
										<td>
											<v-edit-dialog
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
										</td>
										<td>
											<a :href="currentRoute+'/'+props.item.id_website"><i class="icon icon-eye"></i></a>
										</td>
										<td class="text-xs-left">
											<div class="dropdown show actions">
												<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
													<i class="icon icon-dots-vertical"></i>
												</a>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
													<a class="dropdown-item" id="edit-dashboard" :href="'http://'+props.item.url_website" target="_blank"><i class="icon-link-variant"></i>Open URL Website</a>
													<a class="dropdown-item email" href="javascript:void(0);" data-toggle="modal" data-target="#email" data-id="'.$row->id_website.'"><i class="fa fa-envelope"></i><?php echo lang('email') ?></a>
													<?php if($this->aauth->is_group_allowed('delete_website',$user_role[0]->name)) { ?>
													<div class="dropdown-divider"></div>
													<a class="dropdown-item" id="delete-dashboard" @click="f_deleteWebsite(props.item)"><i class="fa fa-trash"></i><?php echo lang('delete') ?></a>
													<?php } ?>
												</div>
											</div>
										</td>
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

	  <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="email" aria-hidden="true">
		<div class="modal-dialog">
		  <div class="modal-content">
			<div class="modal-header modal-header-warning">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			  <h4 class="modal-title custom_align" id="Heading">Envoyer un email à un client</h4>
			</div>
			<form id="form-email" method="post" action="<?php echo site_url('/all-websites/contact'); ?>">
			  <div class="modal-body">
				<div class="input-group">
				  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
				  <input type="email" class="form-control" name="email" placeholder="Email">
				</div>
				<div class="form-check form-check-inline">
				  <label class="form-check-label">
					  <input name="check_bo" type="checkbox" class="form-check-input">
					  <span class="checkbox-icon fuse-ripple-ready"></span>
					  <span>Acces Backoffice</span>
				  </label>
				</div>
				<div class="form-check form-check-inline">
				  <label class="form-check-label">
					  <input name="check_ftp" type="checkbox" class="form-check-input">
					  <span class="checkbox-icon fuse-ripple-ready"></span>
					  <span>Acces FTP</span>
				  </label>
				</div>
				<div class="form-check form-check-inline">
				  <label class="form-check-label">
					  <input name="check_db" type="checkbox" class="form-check-input">
					  <span class="checkbox-icon fuse-ripple-ready"></span>
					  <span>Acces Base de Donnée</span>
				  </label>
				</div>
				</div>
			  </div>
			  <div class="modal-footer ">
				<button type="submit" class="btn btn-warning btn-lg"> Envoyer</button>
				<button type="button" class="btn btn-default btn-lg" data-dismiss="modal"> Annuler</button>
			  </div>
			</form>
		  </div>
		</div>
	  </div>
	  
			</div>
		</div>
	</v-app>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
	    data : {
	    	sidebar:"general",
	    	search:"",
	    	dialog_email: false,
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
<script type="text/javascript">
$(document).ready(function(){
	$('#email').on('show.bs.modal',function(event){
	  var modal = $(this);
	  var id = $(event.relatedTarget).data('id');
	  
	  $('[name="id"]').val(id);
	});
	$("#form-email").submit(function(e){
	  $.ajax({
		type: "POST",
		url: $(this).attr('action'),
		data: $(this).serialize(),
		success: function(msg){
		  $("#email").modal('hide');
		},
		error: function(msg){
		  console.log(msg.responseText);
		}
	  });
	  e.preventDefault();
	});

});
</script>
<?php $this->load->view('include/footer.php'); ?>