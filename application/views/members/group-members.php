<?php $this->load->view('include/header.php'); ?>
<div class="custom-scrollbar">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content">Group Members</h2>
    </div>

  <v-container fluid grid-list-sm>
    <v-layout row wrap>
      <v-flex xs12>
            <v-toolbar flat color="white">
              <v-spacer></v-spacer>
              <v-dialog v-model="dialog_groups_member" max-width="500px">
                <v-btn slot="activator" color="primary" dark class="mb-2">New Groups Member</v-btn>
                <v-card>
                  <v-card-title>
                    <span class="headline">Add Groups Member</span>
                  </v-card-title>

                  <v-card-text>
                    <v-container grid-list-md>
                      <v-layout wrap>
                        <v-flex xs12>
                          <v-text-field v-model="addGroupMember.group_name" label="Name Group"></v-text-field>
                          <v-text-field v-model="addGroupMember.definition" label="Definition"></v-text-field>
                        </v-flex>
                      </v-layout>
                    </v-container>
                  </v-card-text>

                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" flat @click="f_addGroupMember()">Save</v-btn>
                    <v-btn color="blue darken-1" flat @click="dialog_groups_member = false">Cancel</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-toolbar>

            <v-card>
                <template>
                        <v-data-table
                            :headers="headers"
                            :items="list_groups_users"
                            class="elevation-1"
                            :rows-per-page-items="[10,20,50,100]"
                        >
                            <template slot="items" slot-scope="props">
                                <td>
                                    <v-edit-dialog
                                        class="text-xs-right"
                                        @open="props.item._name = props.item.name"
                                        @save="f_editGroupMember(props.item)"
                                        @cancel="props.item.name = props.item._name || props.item.name"
                                        large
                                        lazy
                                      >{{ props.item.name }}
                                        <v-text-field
                                            slot="input"
                                            label="Edit"
                                            v-model="props.item.name"
                                            single-line
                                            counter
                                            autofocus
                                        ></v-text-field>
                                    </v-edit-dialog>
                                </td>
                                <td>
                                    <v-edit-dialog
                                        class="text-xs-right"
                                        @open="props.item._definition = props.item.definition"
                                        @save="f_editGroupMember(props.item)"
                                        @cancel="props.item.definition = props.item._definition || props.item.definition"
                                        large
                                        lazy
                                      >{{ props.item.definition }}
                                        <v-text-field
                                            slot="input"
                                            label="Edit"
                                            v-model="props.item.definition"
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
                                            <a class="dropdown-item" id="delete-dashboard" @click="f_deleteGroupMember(props.item)"><i class="fa fa-trash"></i><?php echo lang('delete') ?></a>
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
        dialog_groups_member: false,
        dialog: false,
        currentRoute: window.location.href,
        headers: [
            { text: 'Name Members', value: 'name_members' },
            { text: 'Definition', value: 'definition' },
            { text: '<?php echo lang("actions"); ?>', value: 'actions'},
        ],
        list_groups_users: <?php echo json_encode($list_groups_users); ?>,
        list_delete_language: [],
        addGroupMember: {
            group_name: '',
            definition: '',
        },
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
        f_addGroupMember(){
            var formData = new FormData(); 
            formData.append("group_name",v.addGroupMember.group_name);
            formData.append("definition",v.addGroupMember.definition);
            axios.post(this.currentRoute+"/add-group-members/", formData).then(function(response){
                v.dialog_groups_member = false;
                //v.list_language.push(response.data);
            })
        },
        f_editGroupMember(item){
            var formData = new FormData();
            formData.append("id_group_members",item.id);
            formData.append("group_name",item.name);
            formData.append("definition",item.definition);
            axios.post(this.currentRoute+"/edit-group-members/", formData).then(function(response){
                
            })
        },
        f_deleteGroupMember(item){
            var formData = new FormData(); 
            formData.append("id_group_members",item.id);
            axios.post(this.currentRoute+"/delete-group-members/", formData).then(function(response){
                v.list_groups_users.splice(v.list_groups_users.indexOf(item), 1)
            })
        },
    }
})
</script>
<?php $this->load->view('include/footer.php'); ?>