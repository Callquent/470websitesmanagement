<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('websites_management'); ?></h2>
	</div>
	<div class="page-content">

	  <section id="main-content">
		  <section class="wrapper">

		  <div class="row">
			  <div class="col-sm-12">
				  <section class="card mb-3">
					  <header class="card-header">
						  <?php echo lang('websites_management'); ?>
					  </header>

					<v-card>
						<template>
								<v-data-table
									:headers="headers"
									:items="list_website"
									class="elevation-1"
									:rows-per-page-items="[10,20,50,100]"
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
												label="Choose category"
												single-line
												autofocus
												:items="list_category"
												item-text="title_category"
												item-value="id_category">
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
												single-line
												autofocus
												:items="list_language"
												item-text="title_language"
												item-value="id_language">
												</v-select>
											</v-edit-dialog>
										</td>
										<td>
											<a :href="'http://'+props.item.url_website" target="_blank"><i class="icon-link-variant"></i></a>
											<a @click="f_opendialog_Access(props.item)"><i class="icon icon-eye"></i></a>
										</td>
										<td class="text-xs-left">
											<div class="dropdown show actions">
												<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
													<i class="icon icon-dots-vertical"></i>
												</a>
												<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
													<a class="dropdown-item" id="delete-dashboard" @click="dialogLanguage(props.item)"><i class="fa fa-trash"></i><?php echo lang('delete') ?></a>
												</div>
											</div>
										</td>
									</template>
								</v-data-table>
						</template>
					</v-card>


					  <div class="card-body">
						  <div class="row">
							  <div class="col-sm-12">
									<h4><?php echo lang('number_websites_management'); ?><?php echo $all_domains; ?> <?php echo lang('domains'); ?> <?php echo $all_subdomains; ?> <?php echo lang('sub_domains'); ?></h4>
							  </div>
						  </div>
						  <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-dashboard">
							  <thead>
								<tr>
									<th class="all"><?php echo lang('name'); ?></th>
									<th class="desktop"><?php echo lang('website'); ?></th>
									<th class="desktop"><?php echo lang('address_ip'); ?></th>
									<th class="desktop"><?php echo lang('name_category'); ?></th>
									<th class="desktop"><?php echo lang('name_language'); ?></th>
									<th class="desktop"><?php echo lang('access_ftp'); ?></th>
									<th class="desktop"><?php echo lang('access_sql'); ?></th>
									<th class="desktop"><?php echo lang('access_backoffice'); ?></th>
									<th class="desktop"><?php echo lang('access_htaccess'); ?></th>
									<?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
									  <th class="desktop"><?php echo lang('actions'); ?></th>
									<?php } ?>
								</tr>
							  </thead>
							  <tbody>

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
	  <div class="modal fade" id="view-ftp" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header modal-header-success">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			  <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_ftp'); ?></h4>
			</div>
			<div class="modal-body">
			  <form id="acces-ftp" class="form-horizontal" role="form" action="#">
				<fieldset>
				 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-ftp-dashboard">
					  <thead>
						<tr>
							<th class="all"><?php echo lang('host_ftp'); ?></th>
							<th class="desktop"><?php echo lang('login_ftp'); ?></th>
							<th class="desktop"><?php echo lang('password_ftp'); ?></th>
							<?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
							  <th class="desktop"><?php echo lang('actions'); ?></th>
							<?php } ?>
						</tr>
					  </thead>
					  <tbody>

					  </tbody>
				  </table>
				</fieldset>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="modal fade" id="view-database" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header modal-header-success">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			  <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_sql'); ?></h4>
			</div>
			<div class="modal-body">
			  <form id="acces-sql" class="form-horizontal" role="form" action="#">
				<fieldset>
				 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-database-dashboard">
					  <thead>
						<tr>
							<th class="all"><?php echo lang('host_sql'); ?></th>
							<th class="desktop"><?php echo lang('name_sql'); ?></th>
							<th class="desktop"><?php echo lang('login_sql'); ?></th>
							<th class="desktop"><?php echo lang('password_sql'); ?></th>
							<?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
							  <th class="desktop"><?php echo lang('actions'); ?></th>
							<?php } ?>
						</tr>
					  </thead>
					  <tbody>

					  </tbody>
				  </table>
				</fieldset>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="modal fade" id="view-backoffice" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header modal-header-success">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			  <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_backoffice'); ?></h4>
			</div>
			<div class="modal-body">
			  <form id="acces-backoffice" class="form-horizontal" role="form" action="#">
				<fieldset>
				 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-backoffice-dashboard">
					  <thead>
						<tr>
							<th class="all"><?php echo lang('host_backoffice'); ?></th>
							<th class="desktop"><?php echo lang('login_backoffice'); ?></th>
							<th class="desktop"><?php echo lang('password_backoffice'); ?></th>
							<?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
							  <th class="desktop"><?php echo lang('actions'); ?></th>
							<?php } ?>
						</tr>
					  </thead>
					  <tbody>

					  </tbody>
				  </table>
				</fieldset>
			  </form>
			</div>
		  </div>
		</div>
	  </div>
	  <div class="modal fade" id="view-htaccess" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
		<div class="modal-dialog modal-lg">
		  <div class="modal-content">
			<div class="modal-header modal-header-success">
			  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			  <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_htaccess'); ?></h4>
			</div>
			<div class="modal-body">
			  <form id="acces-htaccess" class="form-horizontal" role="form" action="#">
				<fieldset>
				 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-htaccess-dashboard">
					  <thead>
						<tr>
							<th class="all"><?php echo lang('login_htaccess'); ?></th>
							<th class="desktop"><?php echo lang('password_htaccess'); ?></th>
							<?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
							  <th class="desktop"><?php echo lang('actions'); ?></th>
							<?php } ?>
						</tr>
					  </thead>
					  <tbody>

					  </tbody>
				  </table>
				</fieldset>
			  </form>
			</div>
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
			<form id="form-email" method="post" action="<?php echo site_url('/all-websites/contact/'); ?>">
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

<v-dialog v-model="dialog_access" width="800">
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
											<a class="dropdown-item" id="edit-task" @click="editTask()"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
											<a class="dropdown-item" id="delete-task" @click="deleteTask(props.item)" ><i class="icon icon-trash"></i><?php echo lang('delete') ?></a>
										</div>
									</div>
								</td>
							</template>
						</v-data-table>
					</v-flex>
					<v-flex xs12>
						<v-data-table :headers="headers_ftp" :items="list_database">
							<template slot="items" slot-scope="props">
								<td>{{ props.item.host_ftp }}</td>
								<td>{{ props.item.login_ftp }}</td>
								<!-- <td>{{ props.item.password_ftp }}</td> -->
								<td>ezf</td>
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
					</v-flex>
					<v-flex xs12>
						<v-data-table :headers="headers_ftp" :items="list_backoffice">
							<template slot="items" slot-scope="props">
								<td>{{ props.item.host_ftp }}</td>
								<td>{{ props.item.login_ftp }}</td>
								<!-- <td>{{ props.item.password_ftp }}</td> -->
								<td>ezf</td>
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
					</v-flex>
					<v-flex xs12>
						<v-data-table :headers="headers_ftp" :items="list_htaccess">
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
											<a class="dropdown-item" id="edit-task" @click="editTask()"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
											<a class="dropdown-item" id="delete-task" @click="deleteTask(props.item)" ><i class="icon icon-trash"></i><?php echo lang('delete') ?></a>
										</div>
									</div>
								</td>
							</template>
						</v-data-table>
					</v-flex>
				</v-layout>
			</v-container>
			<small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
        	<v-btn color="blue darken-1" flat @click="f_createCard()">Save</v-btn>
        	<v-btn color="blue darken-1" flat @click="dialog_access = false">Close</v-btn>
        </v-card-actions>
	</v-card>
</v-dialog>

<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
    el: '#app',
    data : {
    	dialog_access: false,
        currentRoute: window.location.href,
		headers: [
			{ text: '<?php echo lang("name"); ?>', value: 'name'},
			{ text: '<?php echo lang("website"); ?>', value: 'website'},
			{ text: '<?php echo lang("address_ip"); ?>', value: 'address_ip' },
			{ text: '<?php echo lang("categories"); ?>', value: 'categories'},
			{ text: '<?php echo lang("languages"); ?>', value: 'languages'},
			{ text: '<?php echo lang("access"); ?>', value: 'access'},
			{ text: '<?php echo lang("actions"); ?>', value: 'actions' },
		],
		headers_ftp: [
			{ text: '<?php echo lang("host_ftp"); ?>', value: 'host_ftp'},
			{ text: '<?php echo lang("login_ftp"); ?>', value: 'login_ftp'},
			{ text: '<?php echo lang("password_ftp"); ?>', value: 'password_ftp'},
			{ text: '<?php echo lang("actions"); ?>', value: 'actions' },
		],
		headers_database: [
			{ text: '<?php echo lang("host_sql"); ?>', value: 'host_sql'},
			{ text: '<?php echo lang("name_sql"); ?>', value: 'name_sql'},
			{ text: '<?php echo lang("login_sql"); ?>', value: 'login_sql'},
			{ text: '<?php echo lang("password_sql"); ?>', value: 'password_sql'},
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
        list_website: <?php echo json_encode($websites); ?>,
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
			formData.append("id_website",item.id);
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
			formData.append("id_website",item.id);
			axios.post(this.currentRoute+"/view-access-website/", formData).then(function(response){
				if(response.status = 200){
					console.log(response);
					v.list_ftp = response.data.ftp;
					v.list_database = response.data.databas;
					v.list_backoffice = response.data.backoffice;
					v.list_htaccess = response.data.htaccess;
				}else{

				}
			})
			v.dialog_access = true;
		},
    }
})




	var EditableTable = function () {

		return {
			init: function () {
				function restoreRow(pTable, nRow) {
					var aData = pTable.row(nRow).data();
					var jqTds = $('>td', nRow);

					for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
						pTable.cell(nRow, i).data(aData[i]).draw();
					}
				}
					var nEditingDatabase = null;
					var nEditingFtp = null;
					var nEditingBackoffice = null;
					var nEditingHtaccess = null;

					var language = "<?php echo lang('websites_management'); ?>";
					var ftpTable = $('#table-ftp-dashboard').DataTable({
						  'columnDefs': [{
						  'orderable': true,
						  'targets': [0]
					  }, {
						  "searchable": true,
						  "targets": [0]
					  }],
					  "order": [
						  [0, "asc"]
					  ]
					});
					var dbTable = $('#table-database-dashboard').DataTable({
						  'columnDefs': [{
						  'orderable': true,
						  'targets': [0]
					  }, {
						  "searchable": true,
						  "targets": [0]
					  }],
					  "order": [
						  [0, "asc"]
					  ]
					});
					var boTable = $('#table-backoffice-dashboard').DataTable({
						  'columnDefs': [{
						  'orderable': true,
						  'targets': [0]
					  }, {
						  "searchable": true,
						  "targets": [0]
					  }],
					  "order": [
						  [0, "asc"]
					  ]
					});
					var htTable = $('#table-htaccess-dashboard').DataTable({
						  'columnDefs': [{
						  'orderable': true,
						  'targets': [0]
					  }, {
						  "searchable": true,
						  "targets": [0]
					  }],
					  "order": [
						  [0, "asc"]
					  ]
					});
					function editRowWebsiteFtp(ftpTable, nRow, nUrl) {
						var aData = ftpTable.row(nRow).data();
						var jqTds = $('>td', nRow);
						jqTds[0].innerHTML = '<input type="text" class="form-control small" id="hoteftp" value="' + aData[0] + '">';
						jqTds[1].innerHTML = '<input type="text" class="form-control small" id="loginftp" value="' + aData[1] + '">';
						jqTds[2].innerHTML = '<input type="text" class="form-control small" id="passwordftp" value="' + aData[2] + '">';
						jqTds[3].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="icon-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="icon-close"></i></a>';
					}
					function saveRowWebsiteFtp(ftpTable, nRow, nUrl) {
						var jqInputs = $('input', nRow);
						ftpTable.cell(nRow, 0).data(jqInputs[0].value).draw();
						ftpTable.cell(nRow, 1).data(jqInputs[1].value).draw();
						ftpTable.cell(nRow, 2).data(jqInputs[2].value).draw();
						ftpTable.cell(nRow, 3).data('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="icon icon-dots-vertical"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-dashboard" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>').draw();
					}
					function editRowWebsiteDatabase(dbTable, nRow, nUrl) {
						var aData = dbTable.row(nRow).data();
						var jqTds = $('>td', nRow);
						jqTds[0].innerHTML = '<input type="text" class="form-control small" id="hotedatabase" value="' + aData[0] + '">';
						jqTds[1].innerHTML = '<input type="text" class="form-control small" id="namedatabase" value="' + aData[1] + '">';
						jqTds[2].innerHTML = '<input type="text" class="form-control small" id="logindatabase" value="' + aData[2] + '">';
						jqTds[3].innerHTML = '<input type="text" class="form-control small" id="passworddatabase" value="' + aData[3] + '">';
						jqTds[4].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="icon-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="icon-close"></i></a>';
					}
					function saveRowWebsiteDatabase(dbTable, nRow, nUrl) {
						var jqInputs = $('input', nRow);
						dbTable.cell(nRow, 0).data(jqInputs[0].value).draw();
						dbTable.cell(nRow, 1).data(jqInputs[1].value).draw();
						dbTable.cell(nRow, 2).data(jqInputs[2].value).draw();
						dbTable.cell(nRow, 3).data(jqInputs[3].value).draw();
						dbTable.cell(nRow, 4).data('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="icon icon-dots-vertical"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-dashboard" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>').draw();
					}
					function editRowWebsiteBackoffice(boTable, nRow, nUrl) {
						var aData = boTable.row(nRow).data();
						var jqTds = $('>td', nRow);
						jqTds[0].innerHTML = '<input type="text" class="form-control small" id="hotebackoffice" value="' + aData[0] + '">';
						jqTds[1].innerHTML = '<input type="text" class="form-control small" id="loginbackoffice" value="' + aData[1] + '">';
						jqTds[2].innerHTML = '<input type="text" class="form-control small" id="passwordbackoffice" value="' + aData[2] + '">';
						jqTds[3].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="icon-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="icon-close"></i></a>';
					}
					function saveRowWebsiteBackoffice(boTable, nRow, nUrl) {
						var jqInputs = $('input', nRow);
						boTable.cell(nRow, 0).data(jqInputs[0].value).draw();
						boTable.cell(nRow, 1).data(jqInputs[1].value).draw();
						boTable.cell(nRow, 2).data(jqInputs[2].value).draw();
						boTable.cell(nRow, 3).data('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="icon icon-dots-vertical"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-dashboard" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>').draw();
					}
					function editRowWebsiteHtaccess(htTable, nRow, nUrl) {
						var aData = htTable.row(nRow).data();
						var jqTds = $('>td', nRow);
						jqTds[0].innerHTML = '<input type="text" class="form-control small" id="loginhtaccess" value="' + aData[0] + '">';
						jqTds[1].innerHTML = '<input type="text" class="form-control small" id="passwordhtaccess" value="' + aData[1] + '">';
						jqTds[2].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="icon-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="icon-close"></i></a>';
					}
					function saveRowWebsiteHtaccess(htTable, nRow, nUrl) {
						var jqInputs = $('input', nRow);
						htTable.cell(nRow, 0).data(jqInputs[0].value).draw();
						htTable.cell(nRow, 1).data(jqInputs[1].value).draw();
						htTable.cell(nRow, 2).data('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="icon icon-dots-vertical"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-dashboard" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>').draw();
					}

			$(document).on('click', '#table-ftp-dashboard #cancel-dashboard', function (e) {
				e.preventDefault();
				if ($(this).attr("data-mode") == "new") {
					var nRow = $(this).parents('tr')[0];
					ftpTable.fnDeleteRow(nRow);
				} else {
					restoreRow(ftpTable, nEditingFtp);
					nEditingFtp = null;
				}
			});

			$(document).on('click', '#table-ftp-dashboard #edit-dashboard', function (e) {
				e.preventDefault();

				var nRow = $(this).parents('tr')[0];
				var nUrl = $(this).attr('href');
				
				if (nEditingFtp !== null && nEditingFtp != nRow) {
					restoreRow(ftpTable, nEditingFtp);
					editRowWebsiteFtp(ftpTable, nRow, nUrl);
					nEditingFtp = nRow;
				} else if (nEditingFtp == nRow && $(this).find("i").attr("value") == "check") {
					var hoteftp = $('#hoteftp').val();
					var loginftp = $('#loginftp').val();
					var passwordftp = $('#passwordftp').val();
					$.ajax({
						type: "POST",
						url: $(this).attr('href'),
						data: {'hoteftp':hoteftp,'loginftp':loginftp,'passwordftp':passwordftp},
						success: function(msg){
							console.log(msg);
							saveRowWebsiteFtp(ftpTable, nEditingFtp, nUrl);
							nEditingFtp = null;
						},
						error: function(msg){
							console.log(msg);
						}
					});
				} else {
					editRowWebsiteFtp(ftpTable, nRow, nUrl);
					nEditingFtp = nRow;
				}
			});

			$(document).on('click', '#table-database-dashboard #cancel-dashboard', function (e) {
				e.preventDefault();
				if ($(this).attr("data-mode") == "new") {
					var nRow = $(this).parents('tr')[0];
					dbTable.fnDeleteRow(nRow);
				} else {
					restoreRow(dbTable, nEditingDatabase);
					nEditingDatabase = null;
				}
			});
			$(document).on('click', '#table-database-dashboard #edit-dashboard', function (e) {
				e.preventDefault();

				var nRow = $(this).parents('tr')[0];
				var nUrl = $(this).attr('href');
				
				if (nEditingDatabase !== null && nEditingDatabase != nRow) {
					restoreRow(dbTable, nEditingDatabase);
					editRowWebsiteDatabase(dbTable, nRow, nUrl);
					nEditingDatabase = nRow;
				} else if (nEditingDatabase == nRow && $(this).find("i").attr("value") == "check") {
					var hotedatabase = $('#hotedatabase').val();
					var namedatabase = $('#namedatabase').val();
					var logindatabase = $('#logindatabase').val();
					var passworddatabase = $('#passworddatabase').val();
					$.ajax({
						type: "POST",
						url: $(this).attr('href'),
						data: {'hotedatabase':hotedatabase,'namedatabase':namedatabase,'logindatabase':logindatabase,'passworddatabase':passworddatabase},
						success: function(msg){
							console.log(msg);
							saveRowWebsiteDatabase(dbTable, nEditingDatabase, nUrl);
							nEditingDatabase = null;
						},
						error: function(msg){
							console.log(msg);
						}
					});
				} else {
					editRowWebsiteDatabase(dbTable, nRow, nUrl);
					nEditingDatabase = nRow;
				}
			});


			$(document).on('click', '#table-backoffice-dashboard #cancel-dashboard', function (e) {
				e.preventDefault();
				if ($(this).attr("data-mode") == "new") {
					var nRow = $(this).parents('tr')[0];
					boTable.fnDeleteRow(nRow);
				} else {
					restoreRow(boTable, nEditingBackoffice);
					nEditingBackoffice = null;
				}
			});
			$(document).on('click', '#table-backoffice-dashboard #edit-dashboard', function (e) {
				e.preventDefault();

				var nRow = $(this).parents('tr')[0];
				var nUrl = $(this).attr('href');
				
				if (nEditingBackoffice !== null && nEditingBackoffice != nRow) {
					restoreRow(boTable, nEditingBackoffice);
					editRowWebsiteBackoffice(boTable, nRow, nUrl);
					nEditingBackoffice = nRow;
				} else if (nEditingBackoffice == nRow && $(this).find("i").attr("value") == "check") {
					var hotebackoffice = $('#hotebackoffice').val();
					var loginbackoffice = $('#loginbackoffice').val();
					var passwordbackoffice = $('#passwordbackoffice').val();
					$.ajax({
						type: "POST",
						url: $(this).attr('href'),
						data: {'hotebackoffice':hotebackoffice ,'loginbackoffice':loginbackoffice,'passwordbackoffice':passwordbackoffice},
						success: function(msg){
							saveRowWebsiteBackoffice(boTable, nEditingBackoffice, nUrl);
							nEditingBackoffice = null;
						},
						error: function(msg){
							console.log(msg);
						}
					});
				} else {
					editRowWebsiteBackoffice(boTable, nRow, nUrl);
					nEditingBackoffice = nRow;
				}
			});


			$(document).on('click', '#table-htaccess-dashboard #cancel-dashboard', function (e) {
				e.preventDefault();
				if ($(this).attr("data-mode") == "new") {
					var nRow = $(this).parents('tr')[0];
					htTable.fnDeleteRow(nRow);
				} else {
					restoreRow(htTable, nEditingHtaccess);
					nEditingHtaccess = null;
				}
			});
			$(document).on('click', '#table-htaccess-dashboard #edit-dashboard', function (e) {
				e.preventDefault();

				var nRow = $(this).parents('tr')[0];
				var nUrl = $(this).attr('href');
				
				if (nEditingHtaccess !== null && nEditingHtaccess != nRow) {
					restoreRow(htTable, nEditingHtaccess);
					editRowWebsiteHtaccess(htTable, nRow, nUrl);
					nEditingHtaccess = nRow;
				} else if (nEditingHtaccess == nRow && $(this).find("i").attr("value") == "check") {
					var loginhtaccess = $('#loginhtaccess').val();
					var passwordhtaccess = $('#passwordhtaccess').val();
					$.ajax({
						type: "POST",
						url: $(this).attr('href'),
						data: {'loginhtaccess':loginhtaccess,'passwordhtaccess':passwordhtaccess},
						success: function(msg){
							saveRowWebsiteHtaccess(htTable, nEditingHtaccess, nUrl);
							nEditingHtaccess = null;
						},
						error: function(msg){
							console.log(msg);
						}
					});
				} else {
					editRowWebsiteHtaccess(htTable, nRow, nUrl);
					nEditingHtaccess = nRow;
				}
			});
		}
	};

}(); 

$(document).ready(function(){
	if (window.location.href.split('/')[window.location.href.split('/').length-3] == "all-websites") {
		var url = window.location.href.replace(/(\/[^\/]+){2}\/?$/, '');
	} 
	else{
		var url = window.location.href;
	}
	$(document).on('click', '.access-ftp', function(e) {
	  var id = $(this).data('id');
	  $.ajax({
		type: "POST",
		url: url+'/modal-ftp-website/'+id,
		success: function(data){
		  var jsdata = JSON.parse(data);
		  $('#table-ftp-dashboard').dataTable().fnAddData(jsdata);
		},
		error: function(msg){
		  console.log(msg.responseText);
		}
	  });
	  e.preventDefault();
	});
	
	$('#view-ftp').on('hide.bs.modal',function(event){
	  $('#table-ftp-dashboard').dataTable().fnClearTable();
	});
	$(document).on('click', '.access-sql', function(e) {

	  var id = $(this).data('id');
	  $.ajax({
		type: "POST",
		url: url+'/modal-database-website/'+id,
		success: function(data){
		  var jsdata = JSON.parse(data);
		  $('#table-database-dashboard').dataTable().fnAddData(jsdata);
		},
		error: function(msg){
		  console.log(msg.responseText);
		}
	  });
	  e.preventDefault();
	});
	$('#view-database').on('hide.bs.modal',function(event){
	  $('#table-database-dashboard').dataTable().fnClearTable();
	});
	$(document).on('click', '.access-backoffice', function(e) {

	  var id = $(this).data('id');
	  $.ajax({
		type: "POST",
		url: url+'/modal-backoffice-website/'+id,
		success: function(data){
		  var jsdata = JSON.parse(data);
		  $('#table-backoffice-dashboard').dataTable().fnAddData(jsdata);
		},
		error: function(msg){
		  console.log(msg.responseText);
		}
	  });
	  e.preventDefault();
	});
	$('#view-backoffice').on('hide.bs.modal',function(event){
	  $('#table-backoffice-dashboard').dataTable().fnClearTable();
	});
	$(document).on('click', '.access-htaccess', function(e) {

	  var id = $(this).data('id');
	  $.ajax({
		type: "POST",
		url: url+'/modal-htaccess-website/'+id,
		success: function(data){
		  var jsdata = JSON.parse(data);
		  $('#table-htaccess-dashboard').dataTable().fnAddData(jsdata);
		},
		error: function(msg){
		  console.log(msg.responseText);
		}
	  });
	  e.preventDefault();
	});
	$('#view-htaccess').on('hide.bs.modal',function(event){
	  $('#table-htaccess-dashboard').dataTable().fnClearTable();
	});
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

	EditableTableManagement.init();
	EditableTable.init();
});
</script>
<?php $this->load->view('include/footer.php'); ?>