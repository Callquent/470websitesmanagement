<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="file-codemirror">
    <a class="btn btn-icon btn-close change-view fuse-ripple-ready float-right d-none" data-view="agendaWeek" aria-label="Week" style="z-index: 9999;"><i class="icon icon-close"></i></a>
    <a class="btn btn-icon btn-save change-view fuse-ripple-ready float-right d-none" href="<?php echo site_url('ftp-websites/writefileftp/'.$id_ftp_websites); ?>" data-view="agendaWeek" aria-label="Week" style="z-index: 9999;"><i class="icon icon-content-save"></i></a>
</div>
<div class="content custom-scrollbar">
    <div id="file-manager" class="page-layout simple right-sidebar">
                        <div class="page-content-wrapper custom-scrollbar">
                            <div class="page-header bg-secondary text-auto p-6">
                                <div class="header-content d-flex flex-column justify-content-between">
                                    <div class="toolbar row no-gutters justify-content-between">

                                        <button type="button" class="btn btn-icon fuse-ripple-ready">
                                            <i class="icon icon-menu"></i>
                                        </button>

                                        <div class="right-side row no-gutters">

                                            <a href="<?php echo site_url('/ftp-websites/'); ?>" class="btn btn-icon fuse-ripple-ready">
                                                <i class="icon icon-arrow-left-thick"></i>
                                            </a>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="breadcrumb text-truncate row no-gutters align-items-center pl-0 pl-sm-20 col-md-8">
                                            <span id="path" class="h4"><?php echo $path_server; ?></span>
                                        </div>
                                        <div id="loading-time" class="col-md-4">
                                            <ul></ul>
                                        </div>
                                    </div>

                                </div>
                                <form enctype="multipart/form-data" action="<?php echo site_url('/ftp-websites/uploadftp/'.$id_ftp_websites); ?>" method="post" id="form-upload-ftp">
                                    <button id="add-file-button" type="button" class="btn btn-danger btn-fab fuse-ripple-ready" aria-label="Add file">
                                        <input type="file" class="custom-file-input" name="uploadfile" id="uploadfile">
                                        <i class="icon icon-plus"></i>
                                    </button>
                                    
                                </form>
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
                                            <td class="d-table-cell d-xl-none"></td>
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
                                                    <a class="btn btn-icon btn-info-file fuse-ripple-ready" data-fuse-bar-toggle="file-manager-info-sidebar">
                                                        <i class="icon icon-information-outline"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>

                        <aside class="page-sidebar custom-scrollbar" data-fuse-bar="file-manager-info-sidebar" data-fuse-bar-position="right" data-fuse-bar-media-step="lg" data-ps-id="2d326bff-bcc9-55e4-5390-5e14cdb1eaeb">
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
                                <div>
                                    <div class="title-file mb-2"></div>
                                    <div class="subtitle text-muted">
                                        <span>Edited</span>
                                        : May 8, 2017
                                    </div>
                                </div>

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

                                        <tbody>
                                            <tr class="type">
                                                <th class="pl-6">Type</th>
                                                <td></td>
                                            </tr>

                                            <tr class="size">
                                                <th class="pl-6">Size</th>
                                                <td></td>
                                            </tr>

                                            <tr class="location">
                                                <th class="pl-6">Location</th>
                                                <td></td>
                                            </tr>

                                            <tr class="owner">
                                                <th class="pl-6">Owner</th>
                                                <td></td>
                                            </tr>

                                            <tr class="modified">
                                                <th class="pl-6">Modified</th>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
        <a class="dropdown-item fuse-ripple-ready" id="downloadftp" href="<?php echo site_url('ftp-websites/downloadftp/'.$id_ftp_websites); ?>">Télécharger</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item fuse-ripple-ready" id="deleteftp" href="<?php echo site_url('ftp-websites/deleteftp/'.$id_ftp_websites); ?>">Supprimer</a>
    </div>
</div>
<div class="context-menu-mobile"></div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
$(function(){
    // Initialize the jQuery File Upload plugin
    $('#form-upload-ftp').fileupload({
        dropZone: $('#drop'),
        add: function (e, data) {
            
            var tpl = $('<li class="working"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');
            $('#loading-time ul').empty();
            tpl.find('p').text(data.files[0].name).append('<i>' + formatFileSize(data.files[0].size) + '</i>');
            data.context = tpl.appendTo('#loading-time ul');
            tpl.find('input').knob();
            tpl.find('span').click(function(){
                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }
                tpl.fadeOut(function(){
                    tpl.remove();
                });
            });
            var jqXHR = data.submit();
        },
        progress: function(e, data){
            var progress = parseInt(data.loaded / data.total * 100, 10);
            data.context.find('input').val(progress).change();
            if(progress == 100){
                data.context.removeClass('working');
                data.context.find('span').html('<i class="icon-check"></i>');

                var formData = new FormData();

                formData.append('uploadfile', data.files[0]);
                formData.append('path', $("#path").text()+data.files[0].name);
                $.ajax({
                    type: "POST",
                    url: $(this).attr("action"),
                    data: formData,
                    processData: false,
                    contentType: false, 
                    success: function(msg){
                        console.log(msg);
                        results = JSON.parse(data);
                        $("#path").text(results[0][0].path_server);
                        $('<tr>').append(
                                $('<td class="file-icon">').html('<i class="icon-'+item.icon+'"></i>'),
                                $('<td class="name">').html(item.title),
                                $('<td class="type d-none d-md-table-cell">').html(item.icon),
                                $('<td class="owner d-none d-sm-table-cell">').html(""),
                                $('<td class="size d-none d-sm-table-cell">').html(item.size),
                                $('<td class="last-modified d-none d-lg-table-cell">').html(item.last_modified),
                                $('<td class="d-table-cell d-xl-none">').html(""),
                            ).appendTo('.list-view');

                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
                e.preventDefault();
            }
        },
        fail:function(e, data){
            data.context.addClass('error');
        }
    });
    function formatFileSize(bytes) {
        if (typeof bytes !== 'number') {
            return '';
        }
        if (bytes >= 1000000000) {
            return (bytes / 1000000000).toFixed(2) + ' GB';
        }
        if (bytes >= 1000000) {
            return (bytes / 1000000).toFixed(2) + ' MB';
        }
        return (bytes / 1000).toFixed(2) + ' KB';
    }

});

  $(document).ready(function(){

        var folderselect_contextmenu;
        var editor;
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
        $("#file-manager .page-content-wrapper").scroll(function() {
            $("#contextMenu").hide();
        });
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
                    data: 'file='+$("#path").text()+folderselect_contextmenu.find(".name").text(),
                    success: function(msg){
                        results = JSON.parse(msg);
                        $('.CodeMirror').remove();
                        $('.file-codemirror').append('<textarea class="cm-s-monokai CodeMirror codemirror-textarea"></textarea>');
                        $('.btn-close').removeClass( "d-none" ).addClass( "d-block" );
                        $('.btn-save').removeClass( "d-none" ).addClass( "d-block" );
                        
                        $('.CodeMirror').html(results);
                        var code = $(".CodeMirror")[0];
                        editor = CodeMirror.fromTextArea(code,{
                            theme: "monokai",
                            lineNumbers: true,
                            styleActiveLine: true,
                            matchBrackets: true,
                            scrollbarStyle: "overlay",
                            viewportMargin: Infinity
                        });
                    },
                    error: function(msg){
                        console.log(msg);
                    }
            });
            e.preventDefault();
        });
        $('.file-codemirror .btn-close').on('click', function(e) {
            $('.CodeMirror').remove();
            $('.btn-close').removeClass( "d-block" ).addClass( "d-none" );
            $('.btn-save').removeClass( "d-block" ).addClass( "d-none" );
        });
        $('.file-codemirror .btn-save').on('click', function(e) {
            /*console.log(editor.getValue());*/
            $.ajax({
                    type: "POST",
                    url: $(this).attr("href"),
                    data: 'file='+$("#path").text()+folderselect_contextmenu.find(".name").text()+'content='+editor.getValue(),
                    success: function(msg){
                        alert("File saved!");
                        console.log(msg);
                    },
                    error: function(msg){
                        console.log(msg);
                    }
            });
        });
        $('.btn-info-file').on('click', function(e) {
            $("aside .title-file").text($(this).parents().eq(1).find(".name").text());

             $("aside .type td").text($(this).parents().eq(1).find(".type").text());
             $("aside .size td").text($(this).parents().eq(1).find(".size").text());
             $("aside .location td").text($(this).parents().eq(1).find(".location").text());
             $("aside .owner td").text($(this).parents().eq(1).find(".owner").text());
             $("aside .modified td").text($(this).parents().eq(1).find(".last-modified").text());
        });
        
        $('#downloadftp').on('click', function(e) {
            var path = $("#path").text()+folderselect_contextmenu.find(".name").text();
            var file = folderselect_contextmenu.find(".name").text();
            $.ajax({
                type: "POST",
                url: $(this).attr('href'),
                data: {'path':path,'file':file},
                success: function(response, status, xhr) {
                    var disposition = xhr.getResponseHeader('Content-Disposition');
                    if (disposition && disposition.indexOf('attachment') !== -1) {
                        var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                        var matches = filenameRegex.exec(disposition);
                        if (matches != null && matches[1]) file = matches[1].replace(/['"]/g, '');
                    }

                    var type = xhr.getResponseHeader('Content-type', 'application/x-www-form-urlencoded');
                    var blob = new Blob([response], { type: type });

                    if (typeof window.navigator.msSaveBlob !== 'undefined') {
                        window.navigator.msSaveBlob(blob, file);
                    } else {
                        var URL = window.URL || window.webkitURL;
                        var downloadUrl = URL.createObjectURL(blob);

                        if (file) {
                            var a = document.createElement("a");
                            if (typeof a.download === 'undefined') {
                                window.location = downloadUrl;
                            } else {
                                a.href = downloadUrl;
                                a.download = file;
                                document.body.appendChild(a);
                                a.click();
                            }
                        } else {
                            window.location = downloadUrl;
                        }

                        setTimeout(function () { URL.revokeObjectURL(downloadUrl); }, 100); // cleanup
                    }
                }
            });
            e.preventDefault();

        /*var parameters = new FormData();

        parameters.append('path', $("#path").text()+folderselect_contextmenu.find(".name").text());
        parameters.append('file', folderselect_contextmenu.find(".name").text());

        var xhr = new XMLHttpRequest();
        xhr.open("POST", $(this).attr('href'), true);

        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xhr.send(parameters);*/

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
                    data: 'path='+($('#path').text() == '/' ? path+elementfolder : path+'/'+elementfolder),
                    success: function(data){
                        $('.list-view tbody').empty();
                        results = JSON.parse(data);
                        $("#path").text(results[0][0].path_server);
                        $('<tr>').append(
                                $('<td class="file-icon">').html('<i class="icon-folder"></i>'),
                                $('<td class="name">').html(".."),
                                $('<td class="type d-none d-md-table-cell">').html("folder"),
                                $('<td>').html(""),
                                $('<td>').html(""),
                                $('<td>').html(""),
                                $('<td>').html(""),
                            ).appendTo('.list-view');
                        $.each(results[1], function(i, item) {
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
                    error: function(data){
                        console.log(data);
                    }
            });
            e.preventDefault();
        });

  });
</script>
<?php $this->load->view('include/footer.php'); ?>