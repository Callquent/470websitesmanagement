<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
	<div class="page-layout simple full-width">
		<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
			<h2 class="doc-title" id="content"><?php echo lang('permission_group_members'); ?></h2>
		</div>

		<v-container fluid grid-list-sm>
			<v-layout row wrap>
			  <v-flex xs12>
					<v-card>
						<template>
								<v-data-table
									:headers="headers"
									:items="list_group_permissions"
									class="elevation-1"
									:footer-props="{
									'items-per-page-options': [10,20,50,100]
									}"
								>						
									<template v-slot:body="{ items }">
										<tr v-for="item in items" :key="item.name">
											<td v-for="(group_permissions, index) in item">
												<span v-if="index == 0">{{ group_permissions.name }}</span>
												<v-checkbox v-else-if="group_permissions.check_group_perm && group_permissions.name == 'Admin'" input-value="true" value disabled></v-checkbox>
												<v-checkbox v-else v-model="group_permissions.check_group_perm" @change="group_permissions.check_group_perm == true?f_allow_permissions(group_permissions):f_deny_permissions(group_permissions)"></v-checkbox>
											</td>
										</tr>
									</template>
								</v-data-table>
						</template>
					</v-card>
			  </v-flex>
			</v-layout>
		</v-container>
	</div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
	var v = new Vue({
		el: '#app',
		vuetify: new Vuetify(),
		data : {
			sidebar:"members",
			currentRoute: window.location.href,
			list_permissions: <?php echo json_encode($all_permissions); ?>,
			headers: <?php echo json_encode($header_groups); ?>,
			list_group_permissions: <?php echo json_encode($list_group_perms); ?>,
		},
		mixins: [mixin],
		created(){
			this.displayPage();
		},
		methods:{
			displayPage(){

			},
			f_allow_permissions(item){
				var formData = new FormData(); 
				formData.append("group_id",item.id);
				formData.append("perm_id",item.perm_id);
				axios.post(this.currentRoute+"/allow-permissions/", formData).then(function(response){
				})
			},
			f_deny_permissions(item){
				var formData = new FormData(); 
				formData.append("group_id",item.id);
				formData.append("perm_id",item.perm_id);
				axios.post(this.currentRoute+"/deny-permissions/", formData).then(function(response){
				})
			},
		}
	});
</script>
<?php $this->load->view('include/footer.php'); ?>