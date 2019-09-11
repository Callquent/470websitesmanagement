<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
    <div class="page-layout simple full-width">
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
                                    :footer-props="{
                                    'items-per-page-options': [10,20,50,100]
                                    }"
                                >
                                    <template v-slot:item.name_members="props">
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
                                    </template>
                                    <template v-slot:item.definition="props">
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
                                    </template>
                                    <template v-slot:item.actions="props">
                                        <v-menu bottom left>
                                            <template v-slot:activator="{ on }">
                                                <v-btn flat icon v-on="on" color="grey darken-1">
                                                    <v-icon>mdi-dots-vertical</v-icon>
                                                </v-btn>
                                            </template>
                                            <v-list>
                                                <?php if($this->aauth->is_group_allowed('delete_website',$user_role[0]->name)) { ?>
                                                <v-list-item @click="f_deleteGroupMember(props.item)" id="delete-dashboard">
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

            </div>
        </div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
    var v = new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data : {
            sidebar:"members",
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
        mixins: [mixin],
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
    });
</script>
<?php $this->load->view('include/footer.php'); ?>