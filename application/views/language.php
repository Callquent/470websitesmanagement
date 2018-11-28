<?php $this->load->view('include/header.php'); ?>
<div class="custom-scrollbar">
	<div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
		<h2 class="doc-title" id="content"><?php echo lang('languages'); ?></h2>
	</div>

  <v-container fluid grid-list-sm>
    <v-layout row wrap>
      <v-flex xs12>
	  	<v-app>
	  		<v-card>
                <template>
                        <v-data-table
                            :headers="headers"
                            :items="list_language"
                            class="elevation-1"
                            :rows-per-page-items="[10,20,50,100]"
                        >
                            <template slot="items" slot-scope="props">
                                <td>
                                	<v-edit-dialog
							            class="text-xs-right"
							            @open="props.item._title_language = props.item.title_language"
							            @save="f_editLanguage(props.item)"
							            @cancel="props.item.title_language = props.item._title_language || props.item.title_language"
							            large
							            lazy
							          >{{ props.item.title_language }}
										<v-text-field
											slot="input"
											label="Edit"
											v-model="props.item.title_language"
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
											<a class="dropdown-item" id="edit-dashboard"><i class="fa fa-pencil"></i><?php echo lang('edit') ?></a>
											<a class="dropdown-item" id="delete-dashboard" @click="dialogLanguage(props.item)"><i class="fa fa-trash"></i><?php echo lang('delete') ?></a>
										</div>
									</div>
                                </td>
                            </template>
                        </v-data-table>
                </template>
            </v-card>
        </v-app>
      </v-flex>
    </v-layout>
  </v-container>
</div>
						 <!--  <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-language">
							<thead>
							  <tr>
								  <th>Langage</th>
								  <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
									<th>Modifier</th>
									<th>Supprimer</th>
								  <?php } ?>
							  </tr>
							</thead>
							<tbody>
							  <?php foreach ($all_languages->result() as $row) { ?>
								<tr>
								  <td><?php echo $row->title_language; ?></td>
								  <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
									<td><a id="edit-dashboard" href="<?php echo site_url('language/edit-language/'.$row->id_language); ?>">Edit</a></td>
									<td><a id="delete-dashboard" href="javascript:void(0);" data-toggle="modal" data-target="#modal-delete-language" data-id="<?php echo $row->id_language; ?>">Delete</a></td>
								  <?php } ?>
								</tr>
							  <?php } ?>
							</tbody>
						  </table> -->


<!-- 	<div class="modal fade" id="modal-delete-language" tabindex="-1" role="dialog" aria-labelledby="modal-delete-language" aria-hidden="true">
	  <div class="modal-dialog">
		<div class="modal-content">
		  <div class="modal-header modal-header-success">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
			<h4 class="modal-title custom_align" id="Heading">Delete Language</h4>
		  </div>
		  <form id="form-language" method="post" action="#">
			<div class="modal-body">
				<select id="language" name="language" class="form-control">
					<option v-for="item_language in list_language" :value="item_language.id_language">{{ item_language.title_language }}</option>
				</select>
			</div>
			<div class="modal-footer ">
			  <button type="submit" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-share"></span> Envoyer</button>
			  <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
			</div>
		  </form>
		</div>
	  </div>
	</div>
 -->


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
                	v-model="deleteLanguage.id_move_language"
					:items="list_delete_language"
					label="Choose language"
					item-text="title_language"
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
        	<v-btn color="blue darken-1" flat @click="f_deleteLanguage()">Save</v-btn>
        	<v-btn color="blue darken-1" flat @click="dialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>






<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
    el: '#app',
    data : {
    	dialog: false,
        currentRoute: window.location.href,
        headers: [
            { text: '<?php echo lang("language"); ?>', value: 'langage' },
            { text: '<?php echo lang("actions"); ?>', value: 'actions'},
        ],
        list_language: [],
        list_delete_language: [],
        deleteLanguage:{
        	id_move_language: '',
        	id_delete_language: '',
        },
    },
    created(){
        this.displayPage();
    },
    methods:{
        displayPage(){

        },
        f_editLanguage(item){
            var formData = new FormData(); 
            formData.append("id_language",item.id_language);
            formData.append("title_language",item.title_language);
            axios.post(this.currentRoute+"/edit-language/", formData).then(function(response){
                
            })
        },
		dialogLanguage(item){
			this.dialog = true;
			this.deleteLanguage.id_delete_language = item.id_language;
			/*this.list_delete_language = this.list_language.filter(function (el) {
				return el.title_language !== item.title_language
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
})
v.list_language = <?php echo json_encode($all_languages->result_array()); ?>;
</script>
<?php $this->load->view('include/footer.php'); ?>