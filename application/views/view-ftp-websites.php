<?php $this->load->view('include/header.php'); ?>
<div class="editor-file" v-if="codemirror_show">
    <md-card >
        <md-card-actions>
            <v-btn color="success" @click='f_saveCodemirror()'>Save</v-btn>
            <v-btn color="error" @click='f_closeCodemirror()'>Close</v-btn>
        </md-card-actions>
            <md-card-media>
          <div class="vue">
            <div class="codemirror">
                <codemirror v-model="code" :options="cmOptions">
                    
                </codemirror>
            </div>
          </div>
        </md-card-media>
    </md-card>
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
                            <span id="path" class="h4">{{ path }}</span>
                        </div>
                        <div id="loading-time" class="col-md-4">
                            <ul></ul>
                        </div>
                    </div>
                </div>
                <form enctype="multipart/form-data" method="post" id="form-upload-ftp">
                    <button id="add-file-button" type="button" class="btn btn-danger btn-fab fuse-ripple-ready">
                        <input type="file" ref="file" class="custom-file-input" name="uploadfile" id="uploadfile" @change="f_uploadFile()">
                        <i class="icon icon-plus"></i>
                    </button>
                    
                </form>
            </div>
            <!-- / HEADER -->

            <!-- CONTENT -->
            <div class="page-content custom-scrollbar ps ps--theme_default" data-ps-id="fe3679bb-d2bd-acef-4e6e-4ec75edc10b1">
                <v-card @contextmenu="f_showContextMenu">
                    <template>
                        <v-data-table
                            :headers="headers"
                            :items="list_view_ftp"
                            class="elevation-1"
                            :rows-per-page-items="[-1]"
                        >
                            <template slot="items" slot-scope="props">
                                <tr @dblclick="f_openFolder(props.item)">
                                    <td class="file-icon"><i :class="'icon-'+props.item.type"></i></td>
                                    <td class="name">{{ props.item.title }}</td>
                                    <td>{{ props.item.size }}</td>
                                    <td>{{ props.item.type }}</td>
                                    <td>{{ props.item.last_modified }}</td>
                                    <td>{{ props.item.chmod }}</td>
                                    <td>{{ props.item.owner }}</td>
                                </tr>
                            </template>
                        </v-data-table>
                    </template>
                </v-card>
            </div>
        </div>
        <aside class="page-sidebar custom-scrollbar" data-fuse-bar="file-manager-info-sidebar" data-fuse-bar-position="right" data-fuse-bar-media-step="lg">
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

    <v-dialog
      v-model="dialog_renameFile"
      width="500"
    >
      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Rename File
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
             <v-flex xs12 sm6>
                <v-text-field v-model="renamefile" required></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="f_renameFile()">Save</v-btn>
            <v-btn color="blue darken-1" flat @click="dialog_renameFile = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-dialog
      v-model="dialog_createFolder"
      width="500"
    >
      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Create Folder
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
             <v-flex xs12 sm6>
                <v-text-field v-model="createfolder" label="Name Folder*" required></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="f_createFolder()">Save</v-btn>
            <v-btn color="blue darken-1" flat @click="dialog_createFolder = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-menu
      transition="scale-transition"
      v-model="contextMenu.showMenu"
      :position-x="contextMenu.x"
      :position-y="contextMenu.y"
      absolute
      offset-y
    >
      <v-list>
        <v-list-tile @click='f_editFile(contextMenu.selected_item)'>
          <v-list-tile-title>Editer</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click='renameItem()'>
          <v-list-tile-title>Renommer</v-list-tile-title>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile @click='dialog_createFolder = true'>
          <v-list-tile-title>Créer un dossier</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click='f_downloadFile(contextMenu.selected_item)'>
          <v-list-tile-title>Télécharger</v-list-tile-title>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile @click='f_deleteFile(contextMenu.selected_item)'>
          <v-list-tile-title>Supprimer</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
var v = new Vue({
    el: '#app',
    data : {
        dialog_renameFile: false,
        dialog_createFolder: false,
        createfolder:'',
        renamefile:'',
        uploadfile:'',
        currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
        id_website: window.location.href.split('/').pop(),
        list_view_ftp: <?php echo json_encode($all_storage_server); ?>,
        path: '<?php echo $path_server; ?>',
        headers: [
            { text: '', value: 'icon', sortable: false},
            { text: 'Name', value: 'name'},
            { text: 'Size', value: 'size'},
            { text: 'Type', value: 'type' },
            { text: 'Last Modified', value: 'last_modified' },
            { text: 'Chmod', value: 'chmod'},
            { text: 'Owner', value: 'owner'},
        ],
        codemirror_show: false,
        code: '',
        cmOptions: {
            tabSize: 4,
            mode: 'text/javascript',
            theme: 'monokai',
            lineNumbers: true,
            line: true,
        },
        contextMenu:{
            showMenu: false,
            x: 0,
            y: 0,
            selected_item: [],
        },
    },
    created(){

    },
    methods:{
        f_showContextMenu (e) {
            var filename = $('table tbody').find("tr:hover .name").text();
            v.contextMenu.selected_item = this.list_view_ftp.find( item => item.title === filename);
            e.preventDefault()
            this.contextMenu.showMenu = false
            this.contextMenu.x = e.clientX
            this.contextMenu.y = e.clientY
            this.$nextTick(() => {
                this.contextMenu.showMenu = true
            })
        },
        f_openFolder (item) {
            var formData = new FormData(); 
            formData.append("path",v.path);
            formData.append("file",item.title);
            axios.post(this.currentRoute+"/refreshfolderserver/"+this.id_website, formData).then(function(response){
                if(response.status = 200){
                    v.list_view_ftp = [];
                    v.list_view_ftp = response.data.folder;
                    v.path = response.data.path;
                }else{

                }
            })
        },
        f_editFile(item){
            var formData = new FormData();
            formData.append("path",v.path);
            formData.append("file",item.title);
            axios.post(this.currentRoute+"/readfileftp/"+this.id_website, formData).then(function(response){
                if(response.status = 200){
                    v.codemirror_show = true;
                    v.code = response.data;
                }else{

                }
            })
        },
        renameItem () {
            v.renamefile = v.contextMenu.selected_item.title;
            v.dialog_renameFile = true;
        },
        f_renameFile(){
            var formData = new FormData();
            formData.append("path",v.path);
            formData.append("oldrenamefile",v.contextMenu.selected_item.title);
            formData.append("renamefile",v.renamefile);
            axios.post(this.currentRoute+"/renameftp/"+this.id_website, formData).then(function(response){
                if(response.status = 200){
                    v.contextMenu.selected_item.title = v.renamefile;
                    v.dialog_renameFile = false;
                }else{

                }
            })
        },
        f_createFolder(item){
            var formData = new FormData();
            formData.append("path",v.path);
            formData.append("createfolder",v.createfolder);
            axios.post(this.currentRoute+"/mkdirftp/"+this.id_website, formData).then(function(response){
                if(response.status = 200){
                    v.list_view_ftp.push(response.data);
                    v.dialog_createFolder = false;
                }else{

                }
            })
        },
        f_uploadFile(){
            v.file = this.$refs.file.files[0];
            var formData = new FormData();
            formData.append('uploadfile', v.file);
            formData.append('path', v.path);
             formData.append("file",v.file.name);
            axios.post(this.currentRoute+"/uploadftp/"+this.id_website, formData).then(function(response){
                if(response.status = 200){
                    v.list_view_ftp.push(response.data);
                }else{

                }
            })
        },
        f_downloadFile(item){
            var formData = new FormData();
            formData.append("path",v.path);
            formData.append("file",item.title);
            axios({
                method: 'POST',
                url: this.currentRoute+"/downloadftp/"+this.id_website,
                data: formData,
                responseType:'blob',
                }).then(function(response){
                    let blob = new Blob([response.data], {type: response.data.type});
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = v.contextMenu.selected_item.title;
                    link.click();
            })
        },
        f_deleteFile(item){
            var formData = new FormData();
            formData.append("path",v.path);
            formData.append("file",item.title);
            axios.post(this.currentRoute+"/deleteftp/"+this.id_website, formData).then(function(response){
                if(response.status = 200){
                    const index = v.list_view_ftp.indexOf(v.contextMenu.selected_item)
                    confirm('Are you sure you want to delete this item?') && v.list_view_ftp.splice(index, 1)
                }else{

                }
            })
        },
        f_closeCodemirror (){
            v.codemirror_show = false;
        },

    },
});

/*$(function(){
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
*/
$(document).ready(function(){

        $('.btn-info-file').on('click', function(e) {
            $("aside .title-file").text($(this).parents().eq(1).find(".name").text());

             $("aside .type td").text($(this).parents().eq(1).find(".type").text());
             $("aside .size td").text($(this).parents().eq(1).find(".size").text());
             $("aside .location td").text($(this).parents().eq(1).find(".location").text());
             $("aside .owner td").text($(this).parents().eq(1).find(".owner").text());
             $("aside .modified td").text($(this).parents().eq(1).find(".last-modified").text());
        });
        $('.list-view').on('click', 'tr',function(e) {
            $('.list-view tr').removeClass();
            $(this).addClass("select-ftp-blue");
        });

});
</script>
<?php $this->load->view('include/footer.php'); ?>