<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('websites_management'); ?></h2>
    </div>
    <div class="page-content">

      <section id="main-content">
          <section class="wrapper">

          <div class="row">
              <div class="col-sm-12">
                  <section class="card mb-3">
                      <header class="card-header">
                          <?php echo lang('websites_management'); ?>
                          <span class="tools float-right">
                              <a href="javascript:;" class="fa fa-chevron-down"></a>
                              <a href="javascript:;" class="fa fa-cog"></a>
                              <a href="javascript:;" class="fa fa-times"></a>
                           </span>
                      </header>
                      <div class="card-body">
                          <div class="row">
                              <div class="col-sm-12">
                                    <h4><?php echo lang('number_websites_management'); ?><?php echo $all_domains; ?> <?php echo lang('domains'); ?> <?php echo $all_subdomains; ?> <?php echo lang('sub_domains'); ?></h4>
                              </div>
                          </div>
                          <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-dashboard">
                              <thead>
                                <tr>
                                    <th class="all"><?php echo lang('name'); ?></th>
                                    <th class="desktop"><?php echo lang('website'); ?></th>
                                    <th class="desktop"><?php echo lang('address_ip'); ?></th>
                                    <th class="desktop"><?php echo lang('categories'); ?></th>
                                    <th class="desktop"><?php echo lang('languages'); ?></th>
                                    <th class="desktop"><?php echo lang('access_ftp'); ?></th>
                                    <th class="desktop"><?php echo lang('access_sql'); ?></th>
                                    <th class="desktop"><?php echo lang('access_backoffice'); ?></th>
                                    <th class="desktop"><?php echo lang('access_htaccess'); ?></th>
                                    <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                                      <th class="desktop"><?php echo lang('actions'); ?></th>
                                    <?php } ?>
                                </tr>
                              </thead>
                              <tbody>

                              </tbody>
                          </table>
                      </div>
                  </section>
              </div>
          </div>
          </section>
      </section>
    </div>
  </div>
</div>
      <div class="modal fade" id="view-ftp" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_ftp'); ?></h4>
            </div>
            <div class="modal-body">
              <form id="acces-ftp" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-ftp-dashboard">
                      <thead>
                        <tr>
                            <th class="all"><?php echo lang('host_ftp'); ?></th>
                            <th class="desktop"><?php echo lang('login_ftp'); ?></th>
                            <th class="desktop"><?php echo lang('password_ftp'); ?></th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop"><?php echo lang('actions'); ?></th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="view-database" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_sql'); ?></h4>
            </div>
            <div class="modal-body">
              <form id="acces-sql" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-database-dashboard">
                      <thead>
                        <tr>
                            <th class="all"><?php echo lang('host_sql'); ?></th>
                            <th class="desktop"><?php echo lang('name_sql'); ?></th>
                            <th class="desktop"><?php echo lang('login_sql'); ?></th>
                            <th class="desktop"><?php echo lang('password_sql'); ?></th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop"><?php echo lang('actions'); ?></th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="view-backoffice" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_backoffice'); ?></h4>
            </div>
            <div class="modal-body">
              <form id="acces-backoffice" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-backoffice-dashboard">
                      <thead>
                        <tr>
                            <th class="all"><?php echo lang('host_backoffice'); ?></th>
                            <th class="desktop"><?php echo lang('login_backoffice'); ?></th>
                            <th class="desktop"><?php echo lang('password_backoffice'); ?></th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop"><?php echo lang('actions'); ?></th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="view-htaccess" tabindex="-1" role="dialog" aria-labelledby="view" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header modal-header-success">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading"><?php echo lang('access_htaccess'); ?></h4>
            </div>
            <div class="modal-body">
              <form id="acces-htaccess" class="form-horizontal" role="form" action="#">
                <fieldset>
                 <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-htaccess-dashboard">
                      <thead>
                        <tr>
                            <th class="all"><?php echo lang('login_htaccess'); ?></th>
                            <th class="desktop"><?php echo lang('password_htaccess'); ?></th>
                            <?php if ($user_role[0]->name == "Admin" || $user_role[0]->name == "Developper") { ?>
                              <th class="desktop"><?php echo lang('actions'); ?></th>
                            <?php } ?>
                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal fade" id="email" tabindex="-1" role="dialog" aria-labelledby="email" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header modal-header-warning">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
              <h4 class="modal-title custom_align" id="Heading">Envoyer un email à un client</h4>
            </div>
            <form id="form-email" method="post" action="<?php echo site_url('/all-websites/contact/'); ?>">
              <div class="modal-body">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                  <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="checkbox">
                  <label>
                    <input name="check_bo" type="checkbox"> Acces Backoffice
                  </label>
                  <label>
                    <input name="check_ftp" type="checkbox"> Acces FTP
                  </label>
                  <label>
                    <input name="check_db" type="checkbox"> Acces Base de Donnée
                  </label>
                </div>
              </div>
              <div class="modal-footer ">
                <button type="submit" class="btn btn-warning btn-lg"><span class="glyphicon glyphicon-share"></span> Envoyer</button>
                <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Annuler</button>
              </div>
            </form>
          </div>
        </div>
      </div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
    var nEditingDatabase = null;
    var nEditingFtp = null;
    var nEditingBackoffice = null;
    var nEditingHtaccess = null;

    var language = "<?php echo lang('websites_management'); ?>";
    var ftpTable = $('#table-ftp-dashboard').dataTable({
          'columnDefs': [{
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
    var dbTable = $('#table-database-dashboard').dataTable({
          'columnDefs': [{
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
    var boTable = $('#table-backoffice-dashboard').dataTable({
          'columnDefs': [{
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
    var htTable = $('#table-htaccess-dashboard').dataTable({
          'columnDefs': [{
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
            function editRowWebsiteFtp(ftpTable, nRow, nUrl) {
                var aData = ftpTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="hoteftp" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="loginftp" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="form-control small" id="passwordftp" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="fa fa-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="fa fa-close"></i></a>';
            }
            function saveRowWebsiteFtp(ftpTable, nRow, nUrl) {
                var jqInputs = $('input', nRow);
                ftpTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                ftpTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                ftpTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                ftpTable.fnUpdate('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-dashboard" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>', nRow, 3, false);
                ftpTable.fnDraw();
            }
            function editRowWebsiteDatabase(dbTable, nRow, nUrl) {
                var aData = dbTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="hotedatabase" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="namedatabase" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="form-control small" id="logindatabase" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<input type="text" class="form-control small" id="passworddatabase" value="' + aData[3] + '">';
                jqTds[4].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="fa fa-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="fa fa-close"></i></a>';
            }
            function saveRowWebsiteDatabase(dbTable, nRow, nUrl) {
                var jqInputs = $('input', nRow);
                dbTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                dbTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                dbTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                dbTable.fnUpdate(jqInputs[3].value, nRow, 3, false);
                dbTable.fnUpdate('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-dashboard" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>', nRow, 4, false);
                dbTable.fnDraw();
            }
            function editRowWebsiteBackoffice(boTable, nRow, nUrl) {
                var aData = boTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="hotebackoffice" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="loginbackoffice" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<input type="text" class="form-control small" id="passwordbackoffice" value="' + aData[2] + '">';
                jqTds[3].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="fa fa-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="fa fa-close"></i></a>';
            }
            function saveRowWebsiteBackoffice(boTable, nRow, nUrl) {
                var jqInputs = $('input', nRow);
                boTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                boTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                boTable.fnUpdate(jqInputs[2].value, nRow, 2, false);
                boTable.fnUpdate('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-dashboard" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>', nRow, 3, false);
                boTable.fnDraw();
            }
            function editRowWebsiteHtaccess(htTable, nRow, nUrl) {
                var aData = htTable.fnGetData(nRow);
                var jqTds = $('>td', nRow);
                jqTds[0].innerHTML = '<input type="text" class="form-control small" id="loginhtaccess" value="' + aData[0] + '">';
                jqTds[1].innerHTML = '<input type="text" class="form-control small" id="passwordhtaccess" value="' + aData[1] + '">';
                jqTds[2].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="fa fa-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="fa fa-close"></i></a>';
            }
            function saveRowWebsiteHtaccess(htTable, nRow, nUrl) {
                var jqInputs = $('input', nRow);
                htTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                htTable.fnUpdate(jqInputs[1].value, nRow, 1, false);
                htTable.fnUpdate('<div class="dropdown show actions"><a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" ><i class="fa fa-ellipsis-v"></i></a><div class="dropdown-menu" aria-labelledby="dropdownMenuLink"><a class="dropdown-item" id="edit-dashboard" href="'+nUrl+'"><i class="fa fa-pencil"></i><?php echo lang('edit'); ?></a>', nRow, 2, false);
                htTable.fnDraw();
            }
            $(document).on('click', '#table-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingDashboard !== null && nEditingDashboard != nRow) {
                    restoreRow(dashboardTable, nEditingDashboard);
                    editRowWebsiteInfo(dashboardTable, nRow, nUrl);
                    nEditingDashboard = nRow;
                } else if (nEditingDashboard == nRow && $(this).find("i").attr("value") == "check") {
                    var id = $('#id').val();
                    var titlewebsite = $('#titlewebsite').val();
                    var website = $('#website').val();
                    var category = $('#category').val();
                    var language = $('#language').val();
                    var datecreatewebsite = $('#datecreatewebsite').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'id':id,'titlewebsite':titlewebsite,'website':website,'category':category,'language':language},
                        success: function(msg){
                            saveRowWebsiteInfo(dashboardTable, nEditingDashboard);
                            nEditingDashboard = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteInfo(dashboardTable, nRow, nUrl);
                    nEditingDashboard = nRow;
                }
            });

            $(document).on('click', '#table-ftp-dashboard #cancel-dashboard', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    ftpTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(ftpTable, nEditingFtp);
                    nEditingFtp = null;
                }
            });

            $(document).on('click', '#table-ftp-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingFtp !== null && nEditingFtp != nRow) {
                    restoreRow(ftpTable, nEditingFtp);
                    editRowWebsiteFtp(ftpTable, nRow, nUrl);
                    nEditingFtp = nRow;
                } else if (nEditingFtp == nRow && $(this).find("i").attr("value") == "check") {
                    var hoteftp = $('#hoteftp').val();
                    var loginftp = $('#loginftp').val();
                    var passwordftp = $('#passwordftp').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'hoteftp':hoteftp,'loginftp':loginftp,'passwordftp':passwordftp},
                        success: function(msg){
                            console.log(msg);
                            saveRowWebsiteFtp(ftpTable, nEditingFtp, nUrl);
                            nEditingFtp = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteFtp(ftpTable, nRow, nUrl);
                    nEditingFtp = nRow;
                }
            });

            $(document).on('click', '#table-database-dashboard #cancel-dashboard', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    dbTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(dbTable, nEditingDatabase);
                    nEditingDatabase = null;
                }
            });
            $(document).on('click', '#table-database-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingDatabase !== null && nEditingDatabase != nRow) {
                    restoreRow(dbTable, nEditingDatabase);
                    editRowWebsiteDatabase(dbTable, nRow, nUrl);
                    nEditingDatabase = nRow;
                } else if (nEditingDatabase == nRow && $(this).find("i").attr("value") == "check") {
                    var hotedatabase = $('#hotedatabase').val();
                    var namedatabase = $('#namedatabase').val();
                    var logindatabase = $('#logindatabase').val();
                    var passworddatabase = $('#passworddatabase').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'hotedatabase':hotedatabase,'namedatabase':namedatabase,'logindatabase':logindatabase,'passworddatabase':passworddatabase},
                        success: function(msg){
                            console.log(msg);
                            saveRowWebsiteDatabase(dbTable, nEditingDatabase, nUrl);
                            nEditingDatabase = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteDatabase(dbTable, nRow, nUrl);
                    nEditingDatabase = nRow;
                }
            });


            $(document).on('click', '#table-backoffice-dashboard #cancel-dashboard', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    boTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(boTable, nEditingBackoffice);
                    nEditingBackoffice = null;
                }
            });
            $(document).on('click', '#table-backoffice-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingBackoffice !== null && nEditingBackoffice != nRow) {
                    restoreRow(boTable, nEditingBackoffice);
                    editRowWebsiteBackoffice(boTable, nRow, nUrl);
                    nEditingBackoffice = nRow;
                } else if (nEditingBackoffice == nRow && $(this).find("i").attr("value") == "check") {
                    var hotebackoffice = $('#hotebackoffice').val();
                    var loginbackoffice = $('#loginbackoffice').val();
                    var passwordbackoffice = $('#passwordbackoffice').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'hotebackoffice':hotebackoffice ,'loginbackoffice':loginbackoffice,'passwordbackoffice':passwordbackoffice},
                        success: function(msg){
                            saveRowWebsiteBackoffice(boTable, nEditingBackoffice, nUrl);
                            nEditingBackoffice = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteBackoffice(boTable, nRow, nUrl);
                    nEditingBackoffice = nRow;
                }
            });


            $(document).on('click', '#table-htaccess-dashboard #cancel-dashboard', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    htTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(htTable, nEditingHtaccess);
                    nEditingHtaccess = null;
                }
            });
            $(document).on('click', '#table-htaccess-dashboard #edit-dashboard', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingHtaccess !== null && nEditingHtaccess != nRow) {
                    restoreRow(htTable, nEditingHtaccess);
                    editRowWebsiteHtaccess(htTable, nRow, nUrl);
                    nEditingHtaccess = nRow;
                } else if (nEditingHtaccess == nRow && $(this).find("i").attr("value") == "check") {
                    var loginhtaccess = $('#loginhtaccess').val();
                    var passwordhtaccess = $('#passwordhtaccess').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'loginhtaccess':loginhtaccess,'passwordhtaccess':passwordhtaccess},
                        success: function(msg){
                            saveRowWebsiteHtaccess(htTable, nEditingHtaccess, nUrl);
                            nEditingHtaccess = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowWebsiteHtaccess(htTable, nRow, nUrl);
                    nEditingHtaccess = nRow;
                }
            });


    if (window.location.href.split('/')[window.location.href.split('/').length-3] == "all-websites") {
        var url = window.location.href.replace(/(\/[^\/]+){2}\/?$/, '');
    } 
    else{
        var url = window.location.href;
    }
    $(document).on('click', '.access-ftp', function(e) {
      var id = $(this).data('id');
      $.ajax({
        type: "POST",
        url: url+'/modal-ftp-website/'+id,
        success: function(data){
          var jsdata = JSON.parse(data);
          $('#table-ftp-dashboard').dataTable().fnAddData(jsdata);
        },
        error: function(msg){
          console.log(msg.responseText);
        }
      });
      e.preventDefault();
    });
    
    $('#view-ftp').on('hide.bs.modal',function(event){
      $('#table-ftp-dashboard').dataTable().fnClearTable();
    });
    $(document).on('click', '.access-sql', function(e) {

      var id = $(this).data('id');
      $.ajax({
        type: "POST",
        url: url+'/modal-database-website/'+id,
        success: function(data){
          var jsdata = JSON.parse(data);
          $('#table-database-dashboard').dataTable().fnAddData(jsdata);
        },
        error: function(msg){
          console.log(msg.responseText);
        }
      });
      e.preventDefault();
    });
    $('#view-database').on('hide.bs.modal',function(event){
      $('#table-database-dashboard').dataTable().fnClearTable();
    });
    $(document).on('click', '.access-backoffice', function(e) {

      var id = $(this).data('id');
      $.ajax({
        type: "POST",
        url: url+'/modal-backoffice-website/'+id,
        success: function(data){
          var jsdata = JSON.parse(data);
          $('#table-backoffice-dashboard').dataTable().fnAddData(jsdata);
        },
        error: function(msg){
          console.log(msg.responseText);
        }
      });
      e.preventDefault();
    });
    $('#view-backoffice').on('hide.bs.modal',function(event){
      $('#table-backoffice-dashboard').dataTable().fnClearTable();
    });
    $(document).on('click', '.access-htaccess', function(e) {

      var id = $(this).data('id');
      $.ajax({
        type: "POST",
        url: url+'/modal-htaccess-website/'+id,
        success: function(data){
          var jsdata = JSON.parse(data);
          $('#table-htaccess-dashboard').dataTable().fnAddData(jsdata);
        },
        error: function(msg){
          console.log(msg.responseText);
        }
      });
      e.preventDefault();
    });
    $('#view-htaccess').on('hide.bs.modal',function(event){
      $('#table-htaccess-dashboard').dataTable().fnClearTable();
    });
    $('#email').on('show.bs.modal',function(event){
      var modal = $(this);
      var id = $(event.relatedTarget).data('id');
      
      $('[name="id"]').val(id);
    });
    $("#form-email").submit(function(e){
      $.ajax({
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function(msg){
          $("#email").modal('hide');
        },
        error: function(msg){
          console.log(msg.responseText);
        }
      });
      e.preventDefault();
    });

    EditableTable.init();
  });
</script>
<?php $this->load->view('include/footer.php'); ?>