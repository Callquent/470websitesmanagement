<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"></h2>
    </div>
        <v-container fluid grid-list-sm>
            <v-layout row wrap>
                <v-flex xs12>
                    <v-form ref="form">
                        <v-container>
                            <v-row>
                                <v-col cols="12" md="4">
                                    <v-autocomplete
                                        v-model="editedTimeSpendTasks.id_project_tasks"
                                        @change="f_viewProjectTasks"
                                        :items="list_projects"
                                        label="Project Tasks"
                                        item-text="name_project_tasks"
                                        item-value="id_project_tasks">
                                    </v-autocomplete>
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-autocomplete
                                        v-model="editedTimeSpendTasks.card_tasks"
                                        @change="f_viewCardTasks"
                                        :items="list_card_tasks"
                                        label="Card Tasks"
                                        item-text="name_card_tasks"
                                        item-value="id_card_tasks"
                                        return-object>
                                    </v-autocomplete>
                                    
                                </v-col>
                                <v-col cols="12" md="4">
                                    <v-autocomplete
                                        v-model="editedTimeSpendTasks.task"
                                        @change="f_viewTasks"
                                        :items="list_tasks"
                                        label="Tasks"
                                        clearable
                                        item-text="name_task"
                                        item-value="id_task"
                                        return-object>
                                    </v-autocomplete>
                                </v-col>
                            </v-row>
                        </v-container>
                    </v-form>
                </v-flex>
                <v-flex xs12>
                    <template>
                        <v-data-table
                            :headers="headers"
                            :items="list_hours_tasks"
                            class="elevation-1"
                            :items-per-page="-1"
                            :footer-props="{
                            'items-per-page-options': [10, 20, 30, 40, 50, -1]
                            }"
                        >
                            <template v-if="editedTimeSpendTasks.task.id_task" v-slot:top>
                              <v-toolbar flat color="white">
                                <v-divider
                                  class="mx-4"
                                  inset
                                  vertical
                                ></v-divider>
                                <div class="flex-grow-1"></div>
                                <v-dialog v-model="dialog_time_spend_tasks" max-width="500px">
                                  <template v-slot:activator="{ on }">
                                    <v-btn color="primary" dark class="mb-2" v-on="on">Add hours</v-btn>
                                  </template>
                                  <v-card>
                                    <v-card-text>
                                      <v-container>
                                        <v-row>
                                          <v-col cols="12">
                                            <v-text-field
                                                v-model="editedTimeSpendTasks.nb_hours_tasks"
                                                label="Label Text"
                                                value="12:30:00"
                                                type="time"
                                            ></v-text-field>
                                          </v-col>
                                          <v-col cols="12">
                                                <v-menu
                                                    ref="menu"
                                                    v-model="menu"
                                                    :close-on-content-click="false"
                                                    :return-value.sync="date"
                                                    transition="scale-transition"
                                                    offset-y
                                                    min-width="290px"
                                                  >
                                                  <template v-slot:activator="{ on }">
                                                    <v-text-field
                                                        v-model="editedTimeSpendTasks.date_hours_tasks"
                                                        label="Picker in menu"
                                                        prepend-icon="event"
                                                        readonly
                                                        v-on="on"
                                                    ></v-text-field>
                                                   </template>
                                                   <v-date-picker v-model="editedTimeSpendTasks.date_hours_tasks" no-title scrollable>
                                                      <v-spacer></v-spacer>
                                                      <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                                                      <v-btn text color="primary" @click="$refs.menu.save(date)">OK</v-btn>
                                                    </v-date-picker>
                                                </v-menu>
                                          </v-col>
                                        </v-row>
                                      </v-container>
                                    </v-card-text>

                                    <v-card-actions>
                                      <div class="flex-grow-1"></div>
                                      <v-btn color="blue darken-1" text @click="saveTimeSpentTasks()">Save</v-btn>
                                      <v-btn color="blue darken-1" text @click="dialog_time_spend_tasks = false">Cancel</v-btn>
                                    </v-card-actions>
                                  </v-card>
                                </v-dialog>
                              </v-toolbar>
                            </template>
                            <template v-slot:body="{ items }">
                                <tr v-for="item in items" :key="item.name">
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
                                                    <v-list-item-title id="edit-project" ><?php echo lang('edit') ?></v-list-item-title>
                                                </v-list-item>
                                                <v-list-item>
                                                    <v-list-item-title id="delete-project"><?php echo lang('delete') ?></v-list-item-title>
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
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
    var v = new Vue({
        el: '#app',
        vuetify: new Vuetify(),
        data : {
            sidebar:"projects",
            dialog_time_spend_tasks: false,
            currentRoute: window.location.href,
            headers: [
                { text: '<?php echo lang("nb_hours_tasks"); ?>', value: 'nb_hours_tasks' },
                { text: '<?php echo lang("date_hours_tasks"); ?>', value: 'date_hours_tasks'},
                { text: '<?php echo lang("actions"); ?>', value: 'actions'},
            ],
            editedTimeSpendTaskIndex: -1,
            editedTimeSpendTasks: {
                id_project_tasks: '',
                card_tasks: '',
                task: '',
                nb_hours_tasks: '',
                date_hours_tasks: '',
            },
            list_serp_search_google: [],
            list_projects: <?php echo json_encode($all_projects->result_array()); ?>,
            list_card_tasks: [],
            list_tasks: [],
            list_hours_tasks: [],
        },
        mixins: [mixin],
        created(){
            this.displayPage();
        },
        methods:{
            displayPage(){

            },
            f_viewProjectTasks(item){
                var formData = new FormData();
                formData.append("id_project_tasks",item);
                axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
                    v.list_tasks = response.data.tasks;
                    v.list_card_tasks = response.data.all_card_tasks;
                })
            },
            f_viewCardTasks(item){
                var formData = new FormData();
                formData.append("id_project_tasks",item.id_project_tasks);
                formData.append("id_card_tasks",item.id_card_tasks);
                axios.post(this.currentRoute+"/view-tasks/", formData).then(function(response){
                    v.list_tasks = response.data.tasks;
                    v.list_hours_tasks = response.data.tasks_hours;
                })
            },
            f_viewTasks(item){
                var formData = new FormData();
                formData.append("id_project_tasks",item.id_project_tasks);
                formData.append("id_card_tasks",item.id_card_tasks);
                formData.append("id_task",item.id_task);
                axios.post(this.currentRoute+"/view-tasks-hours/", formData).then(function(response){
                    v.list_hours_tasks = response.data.tasks_hours;
                })
            },
            saveTimeSpentTasks () {
                var formData = new FormData();
                formData.append("id_task",v.editedTimeSpendTasks.task.id_task);
                formData.append("nb_hours_tasks",v.editedTimeSpendTasks.nb_hours_tasks);
                formData.append("date_hours_tasks",v.editedTimeSpendTasks.date_hours_tasks);
                if (this.editedTimeSpendTaskIndex > -1) {
                    formData.append("id_task",v.editedTimeSpendTasks.id_task);
                    axios.post(this.currentRoute+"/edit-tasks-hours/", formData).then(function(response){
                        if(response.status = 200){
                            Object.assign(v.list_hours_tasks[v.editedTimeSpendTaskIndex], v.editedTimeSpendTasks)
                        }
                    })
                } else {
                    axios.post(this.currentRoute+"/create-tasks-hours/", formData).then(function(response){
                        if(response.status = 200){
                           /* v.list_tasks.push({username: v.editTask.username})*/
                        }
                    })
                }
            },
        }
    });
</script>
<?php $this->load->view('include/footer.php'); ?>