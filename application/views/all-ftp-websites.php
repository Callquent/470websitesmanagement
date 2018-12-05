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


  <!-- <div class="page-layout simple full-width">
    <div class="page-content">

        <section id="main-content">
            <section class="wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <section class="card mb-3">
                            <header class="card-header">
                                Ajouter un site web
                            </header>
                            <div class="card-body">
                                <?php if(empty($all_storage_server)){ ?>
                                    <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-ftpwebsites">
                                        <thead>
                                          <tr>
                                            <th class="all"><?php echo lang('name'); ?></th>
                                            <th class="desktop"><?php echo lang('website'); ?></th>
                                            <th class="desktop">FTP</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          <?php foreach ($all_websites->result() as $row) { ?>
                                            <tr>
                                                <td><?php echo $row->name_website ?></td>
                                                <td><a href="<?php echo prep_url($row->url_website); ?>" target="_blank"><?php echo $row->url_website; ?></a></td>
                                                <td><a href="<?php echo site_url('ftp-websites/'.$row->w_id); ?>">Connect FTP</a></td>
                                            </tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                <?php } ?>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </div>
  </div> -->
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
/*  $(document).ready(function(){
        var ftpwebsitesTable = $('#table-ftpwebsites').DataTable({
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
            "responsive": {
                'details': {
                   
                }
            },
            "columnDefs": [{ // set default column settings
                'orderable': true,
                'targets': [0]
            }, {
                "searchable": true,
                "targets": [0]
            }],
            "order": [
                [0, "asc"]
            ]
        });
  });*/
</script>
<?php $this->load->view('include/footer.php'); ?>