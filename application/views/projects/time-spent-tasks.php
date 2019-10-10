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
                        <div class="form-group">
                            <v-btn large color="error" @click="SerpSearchGoogle"><?php echo lang('search'); ?></v-btn>
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
                            <template v-slot:body="{ items }">
                                <tr :class="item.class" v-for="item in items" :key="item.name">
                                    <td>{{ item.position }}</td>
                                    <td v-html="item.website">{{ item.website }}</td>
                                    <td>{{ item.meta_title }}</td>
                                    <td v-html="item.meta_description">{{ item.meta_description }}</td>
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
                { text: '<?php echo lang("position"); ?>', value: 'position'},
                { text: '<?php echo lang("website"); ?>', value: 'website' },
                { text: '<?php echo lang("meta_title"); ?>', value: 'meta_title'},
                { text: '<?php echo lang("meta_description"); ?>', value: 'meta_description'},
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
                    v.list_tasks = response.data.card_tasks;
                })
            },
        }
    });
</script>
<?php $this->load->view('include/footer.php'); ?>