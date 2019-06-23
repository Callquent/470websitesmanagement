<?php $this->load->view('include/header.php'); ?>
<div class="custom-scrollbar">
    <div class="page-layout simple full-width">
        <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
            <h2 class="doc-title" id="content"><?php echo lang('ftp'); ?></h2>
        </div>

      <v-container fluid grid-list-sm>
        <v-layout row wrap>
          <v-flex xs12>
            <v-card>
                <template>
                        <v-data-table
                            :headers="headers"
                            :items="list_website_ftp"
                            class="elevation-1"
                            :rows-per-page-items="[10,20,50,100]"
                        >
                            <template slot="items" slot-scope="props">
                                <td>{{ props.item.name_website }}</td>
                                <td><a :href="'http://'+props.item.url_website" target="_blank">{{props.item.url_website}}</a></td>
                                <td><a href="javascript:void(0);" @click="dialogFtp(props.item)">Connect FTP</a></td>
                            </template>
                        </v-data-table>
                </template>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </div>
</div>

<v-dialog v-model="dialog_ftp" width="500">
      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Choix du FTP
        </v-card-title>

        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
             <v-flex xs12 sm6>
                <v-select
                    :items="website_by_ftp"
                    label="Choose FTP"
                    item-text="login_ftp"
                    item-value="id_ftp"
                    required
                ></v-select>
              </v-flex>
            </v-layout>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="f_connectFtpWebsite()">Save</v-btn>
            <v-btn color="blue darken-1" flat @click="dialog_ftp = false">Cancel</v-btn>
        </v-card-actions>
      </v-card>
</v-dialog>

            </div>
        </div>
    </v-app>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
    var v = new Vue({
        el: '#app',
        data : {
            sidebar:"general",
            currentRoute: window.location.href,
            dialog_ftp: false,
            headers: [
                { text: '<?php echo lang('name'); ?>', value: 'name' },
                { text: '<?php echo lang('website'); ?>', value: 'website'},
                { text: '<?php echo lang('ftp'); ?>', value: 'ftp'},
            ],
            website_by_ftp: [],
            list_website_ftp: <?php echo json_encode($all_websites->result_array()); ?>,
        },
        mixins: [mixin],
        created(){
            this.displayPage();
        },
        methods:{
            displayPage(){

            },
            dialogFtp(item){
                var formData = new FormData(); 
                formData.append("id_website",item.id_website);
                axios.post(this.currentRoute+"/view-ftp-website/", formData).then(function(response){
                    if(response.status = 200){
                        v.dialog_ftp = true;
                        v.website_by_ftp = response.data;
                    }
                })
            },
            f_connectFtpWebsite(){
                var formData = new FormData(); 
                formData.append("id_ftp",item.id_ftp);
                axios.post(this.currentRoute+"/ftp-websites/"+item.id_website, formData).then(function(response){
                    if(response.status = 200){
                        v.dialog_ftp = true;
                        v.website_by_ftp = response.data;
                    }
                })
            },
        }
    });
</script>
<?php $this->load->view('include/footer.php'); ?>