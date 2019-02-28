<?php $this->load->view('include/header.php'); ?>
<div class="custom-scrollbar">
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
							:items="list_permissions"
							class="elevation-1"
							:rows-per-page-items="[-1]"
						>
							<template slot="headers" slot-scope="props">
								<tr>
									<th>
										Permisssion
									</th>
									<th v-for="header in props.headers" :key="header.name" >
										{{ header.name }}
									</th>
								</tr>
							</template>
							<template slot="items" slot-scope="props">
								<td>
									{{ props.item.name}}
								</td>
								<td>
									<v-checkbox></v-checkbox>
								</td>
							</template>
						</v-data-table>
				</template>
			</v-card>
	  </v-flex>
	</v-layout>
  </v-container>
</div>

<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
	el: '#app',
	data : {
		currentRoute: window.location.href,
		/*headers: [
			{ text: '<?php echo lang("language"); ?>', value: 'langage' },
			{ text: '<?php echo lang("actions"); ?>', value: 'actions'},
		],*/
		list_permissions: <?php echo json_encode($all_permissions); ?>,
		headers: <?php echo json_encode($list_groups_users); ?>,
	},
	created(){
		this.displayPage();
	},
	methods:{
		displayPage(){

		},
	}
})
</script>
<?php $this->load->view('include/footer.php'); ?>