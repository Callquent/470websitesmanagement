<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content">{{ website.url_website }}</h2>
		<a href="<?php echo site_url('all-websites'); ?>" class="btn btn-icon fuse-ripple-ready">
			<i class="icon icon-arrow-left-thick s-10"></i>
		</a>
	</div>
	<div class="page-content">

	  <section id="main-content">
		  <section class="wrapper">

		  <div class="row">
			  <div class="col-sm-12">
				  <section class="card mb-3">

					<v-card>
						<template>
							<v-container fluid grid-list-sm>
								<v-layout row wrap>
									<v-flex xs6 md6 sm12>
										<?php if($this->aauth->is_group_allowed('create_access_ftp',$user_role[0]->name)) { ?>
										<v-toolbar flat color="white">
										  <v-spacer></v-spacer>
										  <v-dialog v-model="dialog_ftp" max-width="500px">
										    <v-btn slot="activator" color="primary" dark class="mb-2">New Ftp</v-btn>
										    <v-card>
										      <v-card-title>
										        <span class="headline">Add Ftp</span>
										      </v-card-title>
										      <v-card-text>
										        <v-container grid-list-md>
										          <v-layout wrap>
										            <v-flex xs12 sm6 md4>
										              <v-text-field v-model="editedFtp.host_ftp" label="<?php echo lang("host_ftp"); ?>"></v-text-field>
										            </v-flex>
										            <v-flex xs12 sm6 md4>
										              <v-text-field v-model="editedFtp.login_ftp" label="<?php echo lang("login_ftp"); ?>"></v-text-field>
										            </v-flex>
										            <v-flex xs12 sm6 md4>
										              <v-text-field v-model="editedFtp.password_ftp" label="<?php echo lang("password_ftp"); ?>"></v-text-field>
										            </v-flex>
										          </v-layout>
										        </v-container>
										      </v-card-text>
										      <v-card-actions>
										        <v-spacer></v-spacer>
										        <v-btn color="blue darken-1" flat @click="closeFTP()">Cancel</v-btn>
										        <v-btn color="blue darken-1" flat @click="saveFTP()">Save</v-btn>
										      </v-card-actions>
										    </v-card>
										  </v-dialog>
										</v-toolbar>
										<?php } ?>
										<section class="card mb-3">
											<header class="card-header">
												<?php echo lang('access_ftp'); ?>
											</header>
											<v-data-table :headers="headers_ftp" :items="list_ftp">
												<template slot="items" slot-scope="props">
													<td>{{ props.item.host_ftp }}</td>
													<td>{{ props.item.login_ftp }}</td>
													<td>{{ props.item.password_ftp }}</td>
													<td>
														<div class="dropdown show actions">
															<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
																<i class="icon icon-dots-vertical"></i>
															</a>
															<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
																<a class="dropdown-item" id="edit-task" @click="f_editFtp(props.item)"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
																<a class="dropdown-item" id="delete-task" @click="f_deleteFtp(props.item)" ><i class="icon icon-trash"></i><?php echo lang('delete') ?></a>
															</div>
														</div>
													</td>
												</template>
											</v-data-table>
										</section>
									</v-flex>
									<v-flex xs6 md6 sm12>
										<?php if($this->aauth->is_group_allowed('create_access_database',$user_role[0]->name)) { ?>
									    <v-toolbar flat color="white">
									      <v-spacer></v-spacer>
									      <v-dialog v-model="dialog_database" max-width="500px">
									        <v-btn slot="activator" color="primary" dark class="mb-2">New Database</v-btn>
									        <v-card>
									          <v-card-title>
									            <span class="headline">Add Database</span>
									          </v-card-title>
									          <v-card-text>
									            <v-container grid-list-md>
									              <v-layout wrap>
									                <v-flex xs12 sm6 md4>
									                  <v-text-field v-model="editedDatabase.host_database" label="<?php echo lang("host_sql"); ?>"></v-text-field>
									                </v-flex>
									                <v-flex xs12 sm6 md4>
									                  <v-text-field v-model="editedDatabase.name_database" label="<?php echo lang("name_sql"); ?>"></v-text-field>
									                </v-flex>
									                <v-flex xs12 sm6 md4>
									                  <v-text-field v-model="editedDatabase.login_database" label="<?php echo lang("login_sql"); ?>"></v-text-field>
									                </v-flex>
									                <v-flex xs12 sm6 md4>
									                  <v-text-field v-model="editedDatabase.password_database" label="<?php echo lang("password_sql"); ?>"></v-text-field>
									                </v-flex>
									              </v-layout>
									            </v-container>
									          </v-card-text>
									          <v-card-actions>
									            <v-spacer></v-spacer>
									            <v-btn color="blue darken-1" flat @click="closeDatabase()">Cancel</v-btn>
									            <v-btn color="blue darken-1" flat @click="saveDatabase()">Save</v-btn>
									          </v-card-actions>
									        </v-card>
									      </v-dialog>
									    </v-toolbar>
										<?php } ?>
										<section class="card mb-3">
											<header class="card-header">
												<?php echo lang('access_sql'); ?>
											</header>
											<v-data-table :headers="headers_database" :items="list_database">
												<template slot="items" slot-scope="props">
													<td>{{ props.item.host_database }}</td>
													<td>{{ props.item.name_database }}</td>
													<td>{{ props.item.login_database }}</td>
													<td>{{ props.item.password_database }}</td>
													<td>
														<div class="dropdown show actions">
															<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
																<i class="icon icon-dots-vertical"></i>
															</a>
															<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
																<a class="dropdown-item" id="edit-task" @click="f_editDatabase(props.item)"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
																<a class="dropdown-item" id="delete-task" @click="f_deleteDatabase(props.item)" ><i class="icon icon-trash"></i><?php echo lang('delete') ?></a>
															</div>
														</div>
													</td>
												</template>
											</v-data-table>
										</section>

									</v-flex>
									<v-flex xs6 md6 sm12>
										<?php if($this->aauth->is_group_allowed('create_access_backoffice',$user_role[0]->name)) { ?>
										<v-toolbar flat color="white">
										  <v-spacer></v-spacer>
										  <v-dialog v-model="dialog_backoffice" max-width="500px">
										    <v-btn slot="activator" color="primary" dark class="mb-2">New Backoffice</v-btn>
										    <v-card>
										      <v-card-title>
										        <span class="headline">Add Backoffice</span>
										      </v-card-title>
										      <v-card-text>
										        <v-container grid-list-md>
										          <v-layout wrap>
										            <v-flex xs12 sm6 md4>
										              <v-text-field v-model="editedBackoffice.host_backoffice" label="<?php echo lang("host_backoffice"); ?>"></v-text-field>
										            </v-flex>
										            <v-flex xs12 sm6 md4>
										              <v-text-field v-model="editedBackoffice.login_backoffice" label="<?php echo lang("login_backoffice"); ?>"></v-text-field>
										            </v-flex>
										            <v-flex xs12 sm6 md4>
										              <v-text-field v-model="editedBackoffice.password_backoffice" label="<?php echo lang("password_backoffice"); ?>"></v-text-field>
										            </v-flex>
										          </v-layout>
										        </v-container>
										      </v-card-text>
										      <v-card-actions>
										        <v-spacer></v-spacer>
										        <v-btn color="blue darken-1" flat @click="closeBackoffice()">Cancel</v-btn>
										        <v-btn color="blue darken-1" flat @click="saveBackoffice()">Save</v-btn>
										      </v-card-actions>
										    </v-card>
										  </v-dialog>
										</v-toolbar>
										<?php } ?>
										<section class="card mb-3">
											<header class="card-header">
												<?php echo lang('access_backoffice'); ?>
											</header>
											<v-data-table :headers="headers_backoffice" :items="list_backoffice">
												<template slot="items" slot-scope="props">
													<td>{{ props.item.host_backoffice }}</td>
													<td>{{ props.item.login_backoffice }}</td>
													<td>{{ props.item.password_backoffice }}</td>
													<td>
														<div class="dropdown show actions">
															<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
																<i class="icon icon-dots-vertical"></i>
															</a>
															<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
																<a class="dropdown-item" id="edit-task" @click="f_editBackoffice(props.item)"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
																<a class="dropdown-item" id="delete-task" @click="f_deleteBackoffice(props.item)" ><i class="icon icon-trash"></i><?php echo lang('delete') ?></a>
															</div>
														</div>
													</td>
												</template>
											</v-data-table>
										</section>

									</v-flex>
									<v-flex xs6 md6 sm12>
										<?php if($this->aauth->is_group_allowed('create_access_htaccess',$user_role[0]->name)) { ?>
										<v-toolbar flat color="white">
										  <v-spacer></v-spacer>
										  <v-dialog v-model="dialog_htaccess" max-width="500px">
										    <v-btn slot="activator" color="primary" dark class="mb-2">New Htaccess</v-btn>
										    <v-card>
										      <v-card-title>
										        <span class="headline">Add Htaccess</span>
										      </v-card-title>
										      <v-card-text>
										        <v-container grid-list-md>
										          <v-layout wrap>
										            <v-flex xs12 sm6 md4>
										              <v-text-field v-model="editedHtaccess.login_htaccess" label="<?php echo lang("login_htaccess"); ?>"></v-text-field>
										            </v-flex>
										            <v-flex xs12 sm6 md4>
										              <v-text-field v-model="editedHtaccess.password_htaccess" label="<?php echo lang("password_htaccess"); ?>"></v-text-field>
										            </v-flex>
										          </v-layout>
										        </v-container>
										      </v-card-text>
										      <v-card-actions>
										        <v-spacer></v-spacer>
										        <v-btn color="blue darken-1" flat @click="closeHtaccess()">Cancel</v-btn>
										        <v-btn color="blue darken-1" flat @click="saveHtaccess()">Save</v-btn>
										      </v-card-actions>
										    </v-card>
										  </v-dialog>
										</v-toolbar>
										<?php } ?>
										<section class="card mb-3">
											<header class="card-header">
												<?php echo lang('access_htaccess'); ?>
											</header>
											<v-data-table :headers="headers_htaccess" :items="list_htaccess">
												<template slot="items" slot-scope="props">
													<td>{{ props.item.login_htaccess }}</td>
													<td>{{ props.item.password_htaccess }}</td>
													<td>
														<div class="dropdown show actions">
															<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
																<i class="icon icon-dots-vertical"></i>
															</a>
															<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
																<a class="dropdown-item" id="edit-task" @click="f_editHtaccess(props.item)"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
																<a class="dropdown-item" id="delete-task" @click="f_deleteHtaccess(props.item)" ><i class="icon icon-trash"></i><?php echo lang('delete') ?></a>
															</div>
														</div>
													</td>
												</template>
											</v-data-table>
										</section>

									</v-flex>
								</v-layout>
							</v-container>
						</template>
					</v-card>
				  </section>
			  </div>
		  </div>
		  </section>
	  </section>
	</div>
  </div>
</div>
			</div>
		</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		data : {
			dialog_ftp: false,
			dialog_database: false,
			dialog_backoffice: false,
			dialog_htaccess: false,
		    currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
		    id_website: window.location.href.split('/').pop(),
			headers_ftp: [
				{ text: '<?php echo lang("host_ftp"); ?>', value: 'host_ftp'},
				{ text: '<?php echo lang("login_ftp"); ?>', value: 'login_ftp'},
				{ text: '<?php echo lang("password_ftp"); ?>', value: 'password_ftp'},
				{ text: '<?php echo lang("actions"); ?>', value: 'actions' },
			],
			headers_database: [
				{ text: '<?php echo lang("host_sql"); ?>', value: 'host_database'},
				{ text: '<?php echo lang("name_sql"); ?>', value: 'name_database'},
				{ text: '<?php echo lang("login_sql"); ?>', value: 'login_database'},
				{ text: '<?php echo lang("password_sql"); ?>', value: 'password_database'},
				{ text: '<?php echo lang("actions"); ?>', value: 'actions' },
			],
			headers_backoffice: [
				{ text: '<?php echo lang("host_backoffice"); ?>', value: 'host_backoffice'},
				{ text: '<?php echo lang("login_backoffice"); ?>', value: 'login_backoffice'},
				{ text: '<?php echo lang("password_backoffice"); ?>', value: 'password_backoffice'},
				{ text: '<?php echo lang("actions"); ?>', value: 'actions' },
			],
			headers_htaccess: [
				{ text: '<?php echo lang("login_htaccess"); ?>', value: 'login_htaccess'},
				{ text: '<?php echo lang("password_htaccess"); ?>', value: 'password_htaccess'},
				{ text: '<?php echo lang("actions"); ?>', value: 'actions' },
			],
			editedFtpIndex: -1,
			editedDatabaseIndex: -1,
			editedBackofficeIndex: -1,
			editedHtaccessIndex: -1,
			editedFtp: {
				id_ftp: '',
				host_ftp: '',
				login_ftp: '',
				password_ftp: '',
			},
			editedDatabase: {
				id_database: '',
				host_database: '',
				name_database: '',
				login_database: '',
				password_database: '',
			},
			editedBackoffice: {
				id_backoffice: '',
				host_backoffice: '',
				login_backoffice: '',
				password_backoffice: '',
			},
			editedHtaccess: {
				id_htaccess: '',
				login_htaccess: '',
				password_htaccess: '',
			},
			website:  <?php echo json_encode($website); ?>,
		    list_ftp:  <?php echo json_encode($ftp); ?>,
		    list_database:  <?php echo json_encode($database); ?>,
		    list_backoffice:  <?php echo json_encode($backoffice); ?>,
		    list_htaccess:  <?php echo json_encode($htaccess); ?>,
		},
		mixins: [mixin],
		watch: {
			dialog_ftp (val) {
				val || this.closeFTP()
			},
			dialog_database (val) {
				val || this.closeDatabase()
			},
			dialog_backoffice (val) {
				val || this.closeBackoffice()
			},
			dialog_htaccess (val) {
				val || this.closeHtaccess()
			}
		},
		created(){
		    this.displayPage();
		},
		methods:{
		    displayPage(){

		    },
			f_editFtp (item) {
				this.editedFtpIndex = this.list_ftp.indexOf(item)
				this.editedFtp = Object.assign({}, item)
				this.dialog_ftp = true
			},
			f_editDatabase (item) {
				this.editedDatabaseIndex = this.list_database.indexOf(item)
				this.editedDatabase = Object.assign({}, item)
				this.dialog_database = true
			},
			f_editBackoffice (item) {
				this.editedBackofficeIndex = this.list_backoffice.indexOf(item)
				this.editedBackoffice = Object.assign({}, item)
				this.dialog_backoffice = true
			},
			f_editHtaccess (item) {
				this.editedHtaccessIndex = this.list_htaccess.indexOf(item)
				this.editedHtaccess = Object.assign({}, item)
				this.dialog_htaccess = true
			},
			f_deleteFtp (item) {
				var formData = new FormData();
				formData.append("id_website",v.id_website);
				formData.append("id_ftp",item.id_ftp);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete-ftp-website/", formData).then(function(response){
						if(response.status = 200){
							const index = v.list_ftp.indexOf(item);
							v.list_ftp.splice(index, 1);
						}
					})
				}
			},
			f_deleteDatabase (item) {
				var formData = new FormData();
				formData.append("id_website",v.id_website);
				formData.append("id_database",item.id_database);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete-database-website/", formData).then(function(response){
						if(response.status = 200){
							const index = v.list_database.indexOf(item);
							v.list_database.splice(index, 1);
						}
					})
				}
			},
			f_deleteBackoffice (item) {
				var formData = new FormData();
				formData.append("id_website",v.id_website);
				formData.append("id_backoffice",item.id_backoffice);
				if (confirm('Are you sure you want to delete this item?') == true) {
					axios.post(this.currentRoute+"/delete-backoffice-website/", formData).then(function(response){
						if(response.status = 200){
							const index = v.list_backoffice.indexOf(item);
							v.list_backoffice.splice(index, 1);
						}
					})
				}
			},
			f_deleteHtaccess (item) {
				var formData = new FormData();
				formData.append("id_website",v.id_website);
				formData.append("id_htaccess",item.id_htaccess);
				axios.post(this.currentRoute+"/delete-htaccess-website/", formData).then(function(response){
					if(response.status = 200){
						const index = v.list_htaccess.indexOf(item);
		    			v.list_htaccess.splice(index, 1);
					}
				})
			},
			saveFTP () {
				var formData = new FormData();
				formData.append("id_website",v.id_website);
				formData.append("hote_ftp",v.editedFtp.host_ftp);
				formData.append("login_ftp",v.editedFtp.login_ftp);
				formData.append("password_ftp",v.editedFtp.password_ftp);
				if (this.editedFtpIndex > -1) {
					formData.append("id_ftp",v.editedFtp.id_ftp);
					axios.post(this.currentRoute+"/edit-ftp-website/", formData).then(function(response){
						if(response.status = 200){
							Object.assign(v.list_ftp[v.editedFtpIndex], v.editedFtp)
						}
					})
				} else {
					axios.post(this.currentRoute+"/create-ftp-website/", formData).then(function(response){
						if(response.status = 200){
							v.list_ftp.push(v.editedFtp)
						}
					})
				}
				this.closeFTP()
			},
			saveDatabase () {
				var formData = new FormData();
				formData.append("id_website",v.id_website);
				formData.append("hote_database",v.editedDatabase.host_database);
				formData.append("name_database",v.editedDatabase.name_database);
				formData.append("login_database",v.editedDatabase.login_database);
				formData.append("password_database",v.editedDatabase.password_database);
				if (this.editedDatabaseIndex > -1) {
					formData.append("id_database",v.editedDatabase.id_database);
					axios.post(this.currentRoute+"/edit-database-website/", formData).then(function(response){
						if(response.status = 200){
							Object.assign(v.list_database[v.editedDatabaseIndex], v.editedDatabase)
						}
					})
				} else {
					axios.post(this.currentRoute+"/create-database-website/", formData).then(function(response){
						if(response.status = 200){
							v.list_database.push(v.editedDatabase)
						}
					})
				}
				this.closeDatabase()
			},
			saveBackoffice () {
				var formData = new FormData();
				formData.append("id_website",v.id_website);
				formData.append("hote_backoffice",v.editedBackoffice.host_backoffice);
				formData.append("login_backoffice",v.editedBackoffice.login_backoffice);
				formData.append("password_backoffice",v.editedBackoffice.password_backoffice);
				if (this.editedBackofficeIndex > -1) {
					formData.append("id_backoffice",v.editedBackoffice.id_backoffice);
					axios.post(this.currentRoute+"/edit-backoffice-website/", formData).then(function(response){
						if(response.status = 200){
							Object.assign(v.list_backoffice[v.editedBackofficeIndex], v.editedBackoffice)
						}
					})
				} else {
					axios.post(this.currentRoute+"/create-backoffice-website/", formData).then(function(response){
						if(response.status = 200){
							v.list_backoffice.push(v.editedBackoffice)
						}
					})
				}
				this.closeBackoffice()
			},
			saveHtaccess () {
				var formData = new FormData();
				formData.append("id_website",v.id_website);
				formData.append("login_htaccess",v.editedHtaccess.login_htaccess);
				formData.append("password_htaccess",v.editedHtaccess.password_htaccess);
				if (this.editedHtaccessIndex > -1) {
					formData.append("id_htaccess",v.editedHtaccess.id_htaccess);
					axios.post(this.currentRoute+"/edit-htaccess-website/", formData).then(function(response){
						if(response.status = 200){
							Object.assign(v.list_htaccess[v.editedHtaccessIndex], v.editedHtaccess)
						}
					})
				} else {
					axios.post(this.currentRoute+"/create-htaccess-website/", formData).then(function(response){
						if(response.status = 200){
							v.list_htaccess.push(v.editedHtaccess)
						}
					})
				}
				this.closeHtaccess()
			},
			closeFTP () {
				this.dialog_ftp = false
				setTimeout(() => {
					this.editedFtp = Object.assign({}, {id_ftp: '', host_ftp: '', login_ftp: '', password_ftp: ''})
					this.editedFtpIndex = -1
				}, 300)
			},
			closeDatabase () {
				this.dialog_database = false
				setTimeout(() => {
					this.editedDatabase = Object.assign({}, {id_database: '', host_database: '', name_database: '', login_database: '', password_database: ''})
					this.editedDatabaseIndex = -1
				}, 300)
			},
			closeBackoffice () {
				this.dialog_backoffice = false
				setTimeout(() => {
					this.editedBackoffice = Object.assign({}, {id_backoffice: '', host_backoffice: '', login_backoffice: '', password_backoffice: ''})
					this.editedBackofficeIndex = -1
				}, 300)
			},
			closeHtaccess () {
				this.dialog_htaccess = false
				setTimeout(() => {
					this.editedHtaccess = Object.assign({}, {id_htaccess: '', login_htaccess: '', password_htaccess: ''})
					this.editedHtaccessIndex = -1
				}, 300)
			}
		}
	});
</script>
<?php $this->load->view('include/footer.php'); ?>