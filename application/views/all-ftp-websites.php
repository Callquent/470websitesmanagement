<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-content">

        <section id="main-content">
            <section class="wrapper">

                <div class="row">
                    <div class="col-lg-12">
                        <section class="card mb-3">
                            <header class="card-header">
                                Ajouter un site web
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="fa fa-cog" href="javascript:;"></a>
                                    <a class="fa fa-times" href="javascript:;"></a>
                                 </span>
                            </header>
                            <div class="card-body">

                                <div class="adv-table editable-table ">
                                    <div class="clearfix">
                                        <div class="btn-group"></div>
                                    </div>
                                    <div class="space15"></div>
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

                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </section>
    </div>
  </div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
        var ftpwebsitesTable = $('#table-ftpwebsites').dataTable({
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
  });
</script>
<?php $this->load->view('include/footer.php'); ?>