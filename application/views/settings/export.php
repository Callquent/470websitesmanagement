<?php $this->load->view('include/header.php'); ?>
    <div class="content custom-scrollbar">
        <div class="page-layout simple full-width">
            <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
                <h2 class="doc-title" id="content"><?php echo lang('export'); ?></h2>
            </div>
                <div class="card-body">
                    <div class="position-center">

                                <form class="form-horizontal" id="form-export">
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label col-lg-3"><?php echo lang('key_secrete'); ?></label>
                                        <div class="col-lg-6">
                                            <div class="input-group m-bot15">
                                                <input v-model="export_470websitesmanagement.key_secrete" type="text" id="keysecrete" class="form-control">
                                                <span class="input-group-btn">
                                                    <v-btn color="success" @click="f_generateKey">Generate</v-btn>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 control-label"><?php echo lang('choose_type_export'); ?></label>

                                        <v-radio-group v-model="export_470websitesmanagement.type_export" column>
                                            <v-radio label="<?php echo lang('all_websites_export'); ?>" value="radio_quick_export"></v-radio>
                                            <v-radio label="<?php echo lang('select_websites_export'); ?>" value="radio_custom_export"></v-radio>
                                        </v-radio-group>

                                    </div>
                                    <div class="form-group row export-search-table" v-if="export_470websitesmanagement.type_export == 'radio_custom_export'">
                                        <label class="control-label col-md-3">Listes Sites Web :</label>
                                        <div class="col-md-9">
                                            <v-select
                                                v-model="export_470websitesmanagement.websites"
                                                :items="list_websites"
                                                item-text="url_website"
                                                item-value="id_website"
                                                label="Websites"
                                                chips
                                                multiple
                                              >
                                                <template v-slot:prepend-item>
                                                  <v-list-tile
                                                    ripple
                                                    @click="toggle"
                                                  >
                                                    <v-list-tile-action>
                                                      <v-icon :color="export_470websitesmanagement.websites.length > 0 ? 'indigo darken-4' : ''">{{ icon }}</v-icon>
                                                    </v-list-tile-action>
                                                    <v-list-tile-content>
                                                      <v-list-tile-title>Select All</v-list-tile-title>
                                                    </v-list-tile-content>
                                                  </v-list-tile>
                                                  <v-divider class="mt-2"></v-divider>
                                                </template>
                                            </v-select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-lg-offset-2 col-lg-10">
                                            <v-btn @click="f_export470websitesmanagement"><?php echo lang('export'); ?></v-btn>
                                        </div>
                                    </div>
                                </form>
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
            sidebar:"administration",
            dialog_add_category: false,
            dialog: false,
            currentRoute: window.location.href,
            list_websites: <?php echo json_encode($all_websites->result_array()); ?>,
            export_470websitesmanagement:{
                key_secrete: "<?php echo $key_secrete; ?>",
                type_export: "radio_quick_export",
                websites: [],
            },
        },
        mixins: [mixin],
        created(){
            this.displayPage();
        },
        computed: {
          likesAllWebsites () {
            return this.export_470websitesmanagement.websites.length === this.list_websites.length
          },
          likesSomeWebsite () {
            return this.export_470websitesmanagement.websites.length > 0 && !this.likesAllWebsites
          },
          icon () {
            if (this.likesAllWebsites) return 'check_box'
            if (this.likesSomeWebsite) return 'indeterminate_check_box'
            return 'check_box_outline_blank'
          }
        },
        methods:{
            displayPage(){

            },
            toggle () {
                this.$nextTick(() => {
                    if (this.likesAllWebsites) {
                        this.export_470websitesmanagement.websites = [];
                    } else {
                        for (var website in this.list_websites) {
                          this.export_470websitesmanagement.websites.push(this.list_websites[website].id_website);
                        };
                        /*this.list_websites.forEach(response, function(key, value) {
                            response
                        });
*/                        
                    }
                })
            },
            f_generateKey(){
                axios.get(this.currentRoute+"/generate-key/").then(function(response){
                    if(response.status = 200){
                        v.export_470websitesmanagement.key_secrete = response.data;
                    }else{

                    }
                })
            },
            f_export470websitesmanagement(){
                var formData = new FormData(); 
                formData.append("keysecrete",v.export_470websitesmanagement.key_secrete);
                formData.append("websites",JSON.stringify(v.export_470websitesmanagement.websites));
                axios({
                    method: 'POST',
                    url: this.currentRoute+"/export-470websitesmanagement/",
                    data: formData,
                    responseType:'blob',
                }).then(function(response){
                    let blob = new Blob([response.data], {type: response.data.type});
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = "websitesmanagement.470";
                    link.click();
                })
            },
        }
    });
</script>
<?php $this->load->view('include/footer.php'); ?>