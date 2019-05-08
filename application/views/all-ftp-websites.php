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
                                <td><a :href="currentRoute+'/'+props.item.id_website">Connect FTP</a></td>
                            </template>
                        </v-data-table>
                </template>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </div>
</div>
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
            headers: [
                { text: '<?php echo lang('name'); ?>', value: 'name' },
                { text: '<?php echo lang('website'); ?>', value: 'website'},
                { text: '<?php echo lang('ftp'); ?>', value: 'ftp'},
            ],
            list_website_ftp: <?php echo json_encode($all_websites->result_array()); ?>,
        },
        mixins: [mixin],
    });
</script>
<?php $this->load->view('include/footer.php'); ?>