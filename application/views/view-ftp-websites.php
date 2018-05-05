<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<pre>
    <code></code>
</pre>
<div class="content custom-scrollbar ps ps--theme_default ps--active-y">
    <div id="file-manager" class="page-layout simple right-sidebar">

                        <div class="page-content-wrapper custom-scrollbar ps ps--theme_default ps--active-y">

                            <div class="page-header bg-secondary text-auto p-6">

                                <div class="header-content d-flex flex-column justify-content-between">

                                    <div class="toolbar row no-gutters justify-content-between">

                                        <button type="button" class="btn btn-icon fuse-ripple-ready">
                                            <i class="icon icon-menu"></i>
                                        </button>

                                        <div class="right-side row no-gutters">

                                            <a href="<?php echo site_url('ftp-websites/uploadftp/'.$id_ftp_websites); ?>" class="btn btn-icon fuse-ripple-ready">
                                                <i class="icon icon-arrow-left-thick"></i>
                                            </a>

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
                                    <input type="file" class="custom-file-input" id="customFile">
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
                                                <i class="icon-folder-move"></i>
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
                                                <td class="owner d-none d-sm-table-cell"></td>
                                                <td class="size d-none d-sm-table-cell"><?php echo $row["size"]; ?></td>
                                                <td class="last-modified d-none d-lg-table-cell"><?php echo $row["last_modified"]; ?></td>
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
</div>
<div class="modal fade" id="modal-create-folder" tabindex="-1" role="dialog" aria-labelledby="modal-create-folder" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Creation du dossier</h4>
      </div>
        <form id="form-create-folder" method="post" action="<?php echo site_url('ftp-websites/mkdirftp/'.$id_ftp_websites); ?>">
          <div class="modal-body">
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                <div class="col-lg-12">
                  <input class="form-control" type="text" name="namefolder" id="namefolder" required />
                </div>
            </div>
          </div>
          <div class="modal-footer ">
            <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-share"></span><?php echo lang('save'); ?></button>
            <button type="button" class="btn btn-default btn-lg" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span><?php echo lang('cancel'); ?></button>
          </div>
        </form>
    </div>
  </div>
</div>
<div id="contextMenu" class="dropdown clearfix">
    <div class="dropdown-menu" style="display:block;position:static;margin-bottom:5px;">
        <a class="dropdown-item fuse-ripple-ready" id="editfile" href="<?php echo site_url('ftp-websites/readfileftp/'.$id_ftp_websites); ?>">Editer</a>
        <a class="dropdown-item fuse-ripple-ready" href="#">Renommer</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item fuse-ripple-ready" id="createfolder" href="javascript:void(0);" data-toggle="modal" data-target="#modal-create-folder">Créer un dossier</a>
        <a class="dropdown-item fuse-ripple-ready" id="downloadfolder" href="<?php echo site_url('ftp-websites/downloadftp/'.$id_ftp_websites); ?>">Télécharger</a>
        <input type="file" name="download-ftp" id="download-ftp" style="display: none;">
        <div class="dropdown-divider"></div>
        <a class="dropdown-item fuse-ripple-ready" id="deleteftp" href="<?php echo site_url('ftp-websites/deleteftp/'.$id_ftp_websites); ?>">Supprimer</a>
    </div>
</div>
<div class="context-menu-mobile"></div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){

        var folderselect_contextmenu;
        $('.list-view').on('contextmenu', 'tr',function(e) {
            /*$('<select id="monselect">').append('<option value="foo">foo</option>').append('<option value="bar">bar</option>').appendTo('.context-menu-mobile');
            $('#monselect').click();*/
            folderselect_contextmenu = $(this);
            if (e.pageY+$("#contextMenu").height() >= $(window).height()) {
                $("#contextMenu").css({
                  display: "block",
                  left: e.pageX,
                  top: e.pageY-$("#contextMenu").height()+20
                });
            } else {
                $("#contextMenu").css({
                  display: "block",
                  left: e.pageX,
                  top: e.pageY
                });
            }
            
             return false;
        });
        /*$(".content").scroll(function() {
            $("#contextMenu").hide();
        });*/
        $('html').click(function() {
            $("#contextMenu").hide();
        });
        $('#form-create-folder').on('submit', function(e) {
            $.ajax({
                    type: "POST",
                    url: $(this).attr('action'),
                    data: 'createfolder='+$("#path").text()+$("#namefolder").val(),
                    success: function(msg){
                        $('#modal-create-folder').modal('hide')
                        $(folderselect_contextmenu).after($("#namefolder").val())
                    },
                    error: function(msg){
                        console.log(msg);
                    }
            });
            e.preventDefault();
        });
        $('#editfile').on('click', function(e) {
            $.ajax({
                    type: "POST",
                    url: $(this).attr("href"),
                    data: 'folderdelete='+$("#path").text()+folderselect_contextmenu.find(".name").text(),
                    success: function(msg){
                        results = JSON.parse(msg);
                        $('pre code').each(function(i, block) {
                            hljs.highlightBlock(block);
                        });
                        $('pre code').append(results);
                    },
                    error: function(msg){
                        console.log(msg);
                    }
            });
            e.preventDefault();
        });
        $('#downloadfolder').on('click', function(e) {
            /*$('#download-ftp').click();
            e.preventDefault();*/
        });
        $('#deleteftp').on('click', function(e) {
            $.ajax({
                    type: "POST",
                    url: $(this).attr("href"),
                    data: 'folderdelete='+$("#path").text()+folderselect_contextmenu.find(".name").text(),
                    success: function(msg){
                        $(folderselect_contextmenu).remove();
                    },
                    error: function(msg){
                        console.log(msg);
                    }
            });
            e.preventDefault();
        });
        $('.list-view').on('click', 'tr',function(e) {
            $('.list-view tr').removeClass();
            $(this).addClass("select-ftp-blue");
        });
        $('.list-view').on('dblclick', 'tr',function(e) {    
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
                        results = JSON.parse(msg);
                        $("#path").text($("#path").text() == '/' ?path+elementfolder:path+'/'+elementfolder);
                        $('<tr>').append(
                                $('<td class="file-icon">').html('<i class="icon-folder"></i>'),
                                $('<td class="name">').html(".."),
                                $('<td class="type d-none d-md-table-cell">').html("folder"),
                                $('<td>').html(""),
                                $('<td>').html(""),
                                $('<td>').html(""),
                                $('<td>').html(""),
                            ).appendTo('.list-view');
                        $.each(results, function(i, item) {
                            var $tr = $('<tr>').append(
                                $('<td class="file-icon">').html('<i class="icon-'+item.icon+'"></i>'),
                                $('<td class="name">').html(item.title),
                                $('<td class="type d-none d-md-table-cell">').html(item.icon),
                                $('<td class="owner d-none d-sm-table-cell">').html(""),
                                $('<td class="size d-none d-sm-table-cell">').html(item.size),
                                $('<td class="last-modified d-none d-lg-table-cell">').html(item.last_modified),
                                $('<td class="d-table-cell d-xl-none">').html(""),
                            ).appendTo('.list-view');
                        });
                    },
                    error: function(msg){
                        console.log(msg);
                    }
            });
            e.preventDefault();
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