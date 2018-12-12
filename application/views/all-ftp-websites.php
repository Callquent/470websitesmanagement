<?php $this->load->view('include/header.php'); ?>
<div class="custom-scrollbar">

  <v-container fluid grid-list-sm>
    <v-layout row wrap>
      <v-flex xs12>
        <v-app>
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
                                <td><a :href="props.item.url_website">{{ props.item.url_website }}</a></td>
                                <td><a :href="currentRoute+'/'+props.item.w_id">Connect FTP</a></td>
                            </template>
                        </v-data-table>
                </template>
            </v-card>
        </v-app>
      </v-flex>
    </v-layout>
  </v-container>
</div>

</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
    el: '#app',
    data : {
        currentRoute: window.location.href,
        headers: [
            { text: '<?php echo lang('name'); ?>', value: 'name' },
            { text: '<?php echo lang('website'); ?>', value: 'website'},
            { text: '<?php echo lang('ftp'); ?>', value: 'ftp'},
        ],
        list_website_ftp: <?php echo json_encode($all_websites->result_array()); ?>,
    },
})
</script>
<?php $this->load->view('include/footer.php'); ?>