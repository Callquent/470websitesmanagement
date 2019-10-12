<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('search_scrapper_google'); ?></h2>
    </div>
        <v-container fluid grid-list-sm>
            <v-layout row wrap>
                <v-flex xs4>
                    <v-form ref="form">
                        <div class="form-group">
                            <v-autocomplete
                                @change="f_viewCardTasks"
                                :items="list_projects"
                                label="Project Tasks"
                                item-text="name_project_tasks"
                                item-value="id_project_tasks">
                            </v-autocomplete>
                        </div>
                        <div class="form-group">
                            <v-autocomplete
                                @change="f_viewTasks"
                                :items="list_card_tasks"
                                label="Card Tasks"
                                item-text="name_card_tasks"
                                item-value="id_card_tasks"
                                return-object>
                            </v-autocomplete>
                        </div>

                    </v-form>
                </v-flex>
                <v-flex xs4></v-flex>
                <v-flex xs12>
                    <template>
                        <v-data-table
                            :headers="headers"
                            :items="list_tasks"
                            class="elevation-1"
                            :items-per-page="-1"
                            :footer-props="{
                            'items-per-page-options': [10, 20, 30, 40, 50, -1]
                            }"
                        >
                         <template v-slot:top>
      <v-toolbar flat color="white">
        <v-toolbar-title>My CRUD</v-toolbar-title>
        <v-divider
          class="mx-4"
          inset
          vertical
        ></v-divider>
        <div class="flex-grow-1"></div>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">New Item</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <span class="headline">{{ formTitle }}</span>
            </v-card-title>

            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.name" label="Dessert name"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.calories" label="Calories"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.fat" label="Fat (g)"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.carbs" label="Carbs (g)"></v-text-field>
                  </v-col>
                  <v-col cols="12" sm="6" md="4">
                    <v-text-field v-model="editedItem.protein" label="Protein (g)"></v-text-field>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>

            <v-card-actions>
              <div class="flex-grow-1"></div>
              <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="save">Save</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-toolbar>
    </template>
                            <template v-slot:body="{ items }">
                                <tr :class="item.class" v-for="item in items" :key="item.name">
                                    <td>{{ item.name_task }}</td>
                                    <td>{{ item.nb_hours_tasks }}</td>
                                    <td>{{ item.date_hours_tasks }}</td>
                                    <td>
                                        <v-menu bottom left>
                                            <template v-slot:activator="{ on }">
                                                <v-btn icon v-on="on" color="grey darken-1">
                                                    <v-icon>mdi-dots-vertical</v-icon>
                                                </v-btn>
                                            </template>
                                            <v-divider></v-divider>
                                            <v-list>
                                                <v-list-item>
                                                        <v-list-item-title>Open URL Website</v-list-item-title>
                                                </v-list-item>
                                            </v-list>
                                        </v-menu>
                                    </td>
                                </tr>
                            </template>
                        </v-data-table>
                    </template>
                </v-flex>
            </v-layout>
        </v-container>
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
            dialog_serp_google: false,
            message:{
                success:'',
                error:'',
            },
            position:'',
            positions:[],
            searchGoogle:{
                keyword:'',
                url_website:'',
            },
            currentRoute: window.location.href,
            headers: [
                { text: '<?php echo lang("name_task"); ?>', value: 'name_task'},
                { text: '<?php echo lang("nb_hours_tasks"); ?>', value: 'nb_hours_tasks' },
                { text: '<?php echo lang("date_hours_tasks"); ?>', value: 'date_hours_tasks'},
                { text: '<?php echo lang("actions"); ?>', value: 'actions'},
            ],
            list_serp_search_google: [],
            list_projects: <?php echo json_encode($all_projects->result_array()); ?>,
            list_card_tasks: [],
            list_tasks: [],
        },
        mixins: [mixin],
        created(){
            this.displayPage();
        },
        methods:{
            displayPage(){

            },
            f_viewCardTasks(item){
                var formData = new FormData();
                formData.append("id_project_tasks",item);
                axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
                    v.list_card_tasks = response.data.all_card_tasks;
                })
            },
            f_viewTasks(item){
                var formData = new FormData();
                formData.append("id_project_tasks",item.id_project_tasks);
                formData.append("id_card_tasks",item.id_card_tasks);
                axios.post(this.currentRoute+"/view-tasks/", formData).then(function(response){
                    v.list_tasks = response.data.tasks;
                })
            },
        }
    });
</script>
<?php $this->load->view('include/footer.php'); ?>