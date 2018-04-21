<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">




<div id="file-manager" class="page-layout simple right-sidebar">

                        <div class="page-content-wrapper custom-scrollbar ps ps--theme_default ps--active-y">

                            <!-- HEADER -->
                            <div class="page-header bg-secondary text-auto p-6">

                                <!-- HEADER CONTENT-->
                                <div class="header-content d-flex flex-column justify-content-between">

                                    <!-- TOOLBAR -->
                                    <div class="toolbar row no-gutters justify-content-between">

                                        <button type="button" class="btn btn-icon fuse-ripple-ready">
                                            <i class="icon icon-menu"></i>
                                        </button>

                                        <div class="right-side row no-gutters">

                                            <button type="button" class="btn btn-icon fuse-ripple-ready">
                                                <i class="icon icon-magnify"></i>
                                            </button>

                                            <button type="button" class="btn btn-icon fuse-ripple-ready">
                                                <i class="icon icon-view-module"></i>
                                            </button>

                                        </div>

                                    </div>
                                    <!-- / TOOLBAR -->

                                    <!-- BREADCRUMB -->
                                    <div class="breadcrumb text-truncate row no-gutters align-items-center pl-0 pl-sm-20">

                                        <span id="path" class="h4"><?php echo $path_server; ?></span>

                                        <i class="icon-chevron-right separator"></i>

                                        <span class="h4">Documents</span>

                                    </div>
                                    <!-- / BREADCRUMB -->

                                </div>
                                <!-- / HEADER CONTENT -->

                                <!-- ADD FILE BUTTON -->
                                <button id="add-file-button" type="button" class="btn btn-danger btn-fab fuse-ripple-ready" aria-label="Add file">
                                    <i class="icon icon-plus"></i>
                                </button>
                                <!-- / ADD FILE BUTTON -->

                            </div>
                            <!-- / HEADER -->

                            <!-- CONTENT -->
                            <div class="page-content custom-scrollbar ps ps--theme_default" data-ps-id="fe3679bb-d2bd-acef-4e6e-4ec75edc10b1">
                                <!-- LIST VIEW -->
                                <table class="table list-view">

                                    <thead>

                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th class="d-none d-md-table-cell">Type</th>
                                            <th class="d-none d-sm-table-cell">Owner</th>
                                            <th class="d-none d-sm-table-cell">Size</th>
                                            <th class="d-none d-lg-table-cell">Last Modified</th>
                                            <th class="d-table-cell d-xl-none"></th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="file-icon">
                                                <i class="icon-folder"></i>
                                            </td>
                                            <td class="name">..</td>
                                            <td class="type d-none d-md-table-cell"></td>
                                            <td class="owner d-none d-sm-table-cell"></td>
                                            <td class="size d-none d-sm-table-cell"></td>
                                            <td class="last-modified d-none d-lg-table-cell"></td>
                                            <td class="d-table-cell d-xl-none">
                                                <button type="button" class="btn btn-icon fuse-ripple-ready" data-fuse-bar-toggle="file-manager-info-sidebar">
                                                    <i class="icon icon-information-outline"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php foreach ($all_storage_server as $row) {  ?>
                                            <tr>
                                                <td class="file-icon">
                                                    <i class="icon-<?php echo $row["icon"]; ?>"></i>
                                                </td>
                                                <td class="name"><?php echo $row["title"]; ?></td>
                                                <td class="type d-none d-md-table-cell"><?php echo $row["icon"]; ?></td>
                                                <td class="owner d-none d-sm-table-cell">me</td>
                                                <td class="size d-none d-sm-table-cell"></td>
                                                <td class="last-modified d-none d-lg-table-cell">July 8, 2015</td>
                                                <td class="d-table-cell d-xl-none">
                                                    <button type="button" class="btn btn-icon fuse-ripple-ready" data-fuse-bar-toggle="file-manager-info-sidebar">
                                                        <i class="icon icon-information-outline"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>

                        <aside class="page-sidebar custom-scrollbar ps ps--theme_default ps--active-y" data-fuse-bar="file-manager-info-sidebar" data-fuse-bar-position="right" data-fuse-bar-media-step="lg" data-ps-id="2d326bff-bcc9-55e4-5390-5e14cdb1eaeb">
                            <!-- SIDEBAR HEADER -->
                            <div class="header bg-secondary text-auto d-flex flex-column justify-content-between p-6">

                                <!-- TOOLBAR -->
                                <div class="toolbar row no-gutters align-items-center justify-content-end">

                                    <button type="button" class="btn btn-icon fuse-ripple-ready">
                                        <i class="icon-delete"></i>
                                    </button>

                                    <button type="button" class="btn btn-icon fuse-ripple-ready">
                                        <i class="icon icon-download"></i>
                                    </button>

                                    <button type="button" class="btn btn-icon fuse-ripple-ready">
                                        <i class="icon icon-dots-vertical"></i>
                                    </button>

                                </div>
                                <!-- / TOOLBAR -->

                                <!-- INFO -->
                                <div>

                                    <div class="title mb-2">Work Documents</div>

                                    <div class="subtitle text-muted">
                                        <span>Edited</span>
                                        : May 8, 2017
                                    </div>

                                </div>
                                <!-- / INFO-->

                            </div>
                            <!-- / SIDEBAR HEADER -->

                            <!-- SIDENAV CONTENT -->
                            <div class="content">

                                <div class="file-details">

                                    <div class="preview file-icon row no-gutters align-items-center justify-content-center">
                                        <i class="icon-folder s-12"></i>
                                    </div>

                                    <div class="offline-switch row no-gutters align-items-center justify-content-between px-6 py-4">

                                        <span>Available Offline</span>

                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" aria-label="Toggle offline">
                                            <span class="custom-control-indicator fuse-ripple-ready"></span>
                                        </label>

                                    </div>

                                    <div class="title px-6 py-4">Info</div>

                                    <table class="table">

                                        <tbody><tr class="type">
                                            <th class="pl-6">Type</th>
                                            <td>Folder</td>
                                        </tr>

                                        <tr class="size">
                                            <th class="pl-6">Size</th>
                                            <td>-</td>
                                        </tr>

                                        <tr class="location">
                                            <th class="pl-6">Location</th>
                                            <td>My Files &gt; Documents</td>
                                        </tr>

                                        <tr class="owner">
                                            <th class="pl-6">Owner</th>
                                            <td>Me</td>
                                        </tr>

                                        <tr class="modified">
                                            <th class="pl-6">Modified</th>
                                            <td>April 8, 2017</td>
                                        </tr>

                                        <tr class="opened">
                                            <th class="pl-6">Opened</th>
                                            <td>April 8, 2017</td>
                                        </tr>

                                        <tr class="created">
                                            <th class="pl-6">Created</th>
                                            <td>April 8, 2017</td>
                                        </tr>
                                    </tbody></table>
                                </div>
                            </div>
                        </aside>
                    </div>









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

                                <?php if(!empty($all_storage_server)){ ?>

                                    <?php if(!empty($all_storage_local)){ ?>
                                    <div class="row">
                                        <div class="col-sm-12 float-right">
                                            <div class="float-right">
                                                <a class="btn btn-default btn-primary mb-3" href="<?php echo site_url('/ftp-websites/'); ?>"><span><i class="fa fa-angle-double-left"></i></span> Retour</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="path-local" value="<?php echo $path_local; ?>">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="path-server" value="<?php echo $path_server; ?>">
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <ul class="treeviewlocal">
                                                <?php foreach ($all_storage_local as $row) {  ?>
                                                    <li class="tree-branch" id="<?php echo $row["title"]; ?>" >
                                                        <a href="javascript:void(0)"><i class="<?php echo $row["icon"]; ?>"></i>
                                                            <span class="name"><?php echo $row["title"]; ?></span>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <ul class="treeviewserver">
                                                <?php foreach ($all_storage_server as $row) {  ?>
                                                <li class="tree-branch" id="<?php echo $row["title"]; ?>" >
                                                    <a href="javascript:void(0)"><i class="<?php echo $row["icon"]; ?>"></i>
                                                        <span class="name"><?php echo $row["title"]; ?></span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="hidden" class="form-control" id="path-server" value="<?php echo $path_server; ?>">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="treeviewserver">
                                                <?php foreach ($all_storage_server as $row) {  ?>
                                                <li class="tree-branch" id="<?php echo $row["title"]; ?>" >
                                                    <a href="javascript:void(0)"><i class="<?php echo $row["icon"]; ?>"></i>
                                                        <span class="name"><?php echo $row["title"]; ?></span>
                                                    </a>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <ul id="contextMenu" class="dropdown-menu" role="menu" style="display:none" >
                                        <li><a tabindex="-1" href="javascript:void(0)">Creer</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Telecharger</a></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Couper</a></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Copier</a></li>
                                        <li class="divider"></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Renommer</a></li>
                                        <li><a tabindex="-1" href="javascript:void(0)">Supprimer</a></li>
                                    </ul>
                                <?php } ?>

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
        /*$('.list-view tr').click(function() {*/
        $('.list-view').on('click', 'tr',function(e) {    
            var elementfolder = $(this).find(".name").html();
            var path = $("#path").text();
            var url = window.location.href.substring(0, window.location.href.lastIndexOf("/"));
            var id = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);
            $.ajax({
                    type: "POST",
                    url: url+'/refreshfolderserver/'+id,
                    data: 'path='+($('#path').val() == '/' ?path+elementfolder:path+'/'+elementfolder),
                    success: function(msg){
                        $('.list-view tbody').empty();
                        console.log(msg);
                        results = JSON.parse(msg);
                        $("#path").text($("#path").text() == '/' ?path+elementfolder:path+'/'+elementfolder);
                        $('<tr>').append(
                                $('<td class="file-icon">').html('<i class="icon-folder"></i>'),
                                $('<td class="name">').html(".."),
                                $('<td class="type d-none d-md-table-cell">').html("folder"),
                                $('<td>').html("test"),
                                $('<td>').html("test"),
                                $('<td>').html("test"),
                                $('<td>').html("test"),
                            ).appendTo('.list-view');
                        $.each(results, function(i, item) {
                            var $tr = $('<tr>').append(
                                $('<td class="file-icon">').html('<i class="icon-'+item.icon+'"></i>'),
                                $('<td class="name">').html(item.title),
                                $('<td class="type d-none d-md-table-cell">').html(item.icon),
                                $('<td>').html("test"),
                                $('<td>').html("test"),
                                $('<td>').html("test"),
                                $('<td>').html("test"),
                            ).appendTo('.list-view');
                        });

                        /*for(var key in results) {
                            $('ul.treeviewserver #'+elementfolder+' > ul').append('<li class="tree-branch" id="'+results[key].title+'"><a href="javascript:void(0);"><i class="'+results[key].icon+'"></i> '+results[key].title+'</a></li>');
                        }*/
                    },
                    error: function(msg){
                        console.log(msg);
                    }
            });
        });
        $('.treeviewserver').on('click', 'li',function(e) {
            
            if ($(this).find('ul').length === 0){
                var elementfolder = $(this).attr('id');
                var path = $("#path-server").val();
                /*console.log(elementfolder);*/

                var arr = $(this).parentsUntil( $( "ul.treeviewserver" ));
                var arrfilter = []

                $.each( arr, function( key, data ) {
                                arrfilter.push(data.id );
                            });

                console.log('tag : '+arrfilter);

                var url = window.location.href.substring(0, window.location.href.lastIndexOf("/"));
                var id = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);

                $.ajax({
                    type: "POST",
                    url: url+'/refreshfolderserver/'+id,
                    data: 'path='+($('#path-server').val() == '/' ?path+elementfolder:path+'/'+elementfolder),
                    success: function(msg){
                        results = JSON.parse(msg);
                        $("#path-server").val($("#path-server").val() == '/' ?path+elementfolder:path+'/'+elementfolder);
                        $('ul.treeviewserver #'+elementfolder+' a').after('<ul></ul>');
                        for(var key in results) {
                            $('ul.treeviewserver #'+elementfolder+' > ul').append('<li class="tree-branch" id="'+results[key].title+'"><a href="javascript:void(0);"><i class="'+results[key].icon+'"></i> '+results[key].title+'</a></li>');
                        }
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            } else {
                $(this).find('ul').toggle();
            }
            e.stopPropagation();
        });

        $('ul.treeviewlocal').on('click', 'li', function() {
            var elementfolder = $(this).attr('id');
            var path = $("#path-local").val();


            var url = window.location.href.substring(0, window.location.href.lastIndexOf("/"));
            var id = window.location.href.substr(window.location.href.lastIndexOf('/') + 1);

            $.ajax({
                type: "POST",
                url: url+'/refreshfolderlocal/'+id,
                data: 'path='+(elementfolder+':'),
                success: function(msg){
                    results = JSON.parse(msg);
                    $("#path-local").val($("#path-local").val() == '/' ?path+elementfolder:path+'/'+elementfolder);
                    $('ul.treeviewlocal #'+elementfolder+' a').after('<ul></ul>');
                    for(var key in results) {
                        $('ul.treeviewlocal #'+elementfolder+' a').next().append('<li class="tree-branch" id="'+results[key].title+'"><a href="javascript:void(0)"><i class="'+results[key].icon+'"></i> '+results[key].title+'</a></li>');
                    }
                },
                error: function(msg){
                    console.log(msg);
                }
            });
        });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>