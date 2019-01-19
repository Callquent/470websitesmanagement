<?php $this->load->view('include/header.php'); ?>
<div class="custom-scrollbar">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('categories'); ?></h2>
	</div>

  <v-container fluid grid-list-sm>
    <v-layout row wrap>
      <v-flex xs12>
            <v-toolbar flat color="white">
              <v-spacer></v-spacer>
              <v-dialog v-model="dialog_add_category" max-width="500px">
                <v-btn slot="activator" color="primary" dark class="mb-2">New Category</v-btn>
                <v-card>
                  <v-card-title>
                    <span class="headline">Add Category</span>
                  </v-card-title>

                  <v-card-text>
                    <v-container grid-list-md>
                      <v-layout wrap>
                        <v-flex xs12>
                          <v-text-field v-model="addCategory.name" label="add category"></v-text-field>
                        </v-flex>
                      </v-layout>
                    </v-container>
                  </v-card-text>

                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="f_addCategory()">Save</v-btn>
                    <v-btn color="blue darken-1" flat @click="dialog_add_category = false">Cancel</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>

	  		<v-card>
                <template>
                        <v-data-table
                            :headers="headers"
                            :items="list_category"
                            class="elevation-1"
                            :rows-per-page-items="[10,20,50,100]"
                        >
                            <template slot="items" slot-scope="props">
                                <td>
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
								</td>
                                <td class="text-xs-left">
									<div class="dropdown show actions">
										<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
											<i class="icon icon-dots-vertical"></i>
										</a>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
											<a class="dropdown-item" id="delete-dashboard" @click="dialogCategory(props.item)"><i class="fa fa-trash"></i><?php echo lang('delete') ?></a>
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

<v-dialog
      v-model="dialog"
      width="500"
    >
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
        	<v-btn color="blue darken-1" flat @click="f_deleteCategory()">Save</v-btn>
        	<v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
        </v-card-actions>
	</v-card>
</v-dialog>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
    el: '#app',
    data : {
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
    },
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
                v.dialog_add_category = false;
                //v.list_category.push(response.data);
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
})
</script>
<?php $this->load->view('include/footer.php'); ?>