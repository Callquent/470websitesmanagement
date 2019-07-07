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
                        <a href="<?php echo site_url('all-ftp-websites'); ?>" class="btn btn-icon fuse-ripple-ready">
                            <i class="icon icon-arrow-left-thick s-10"></i>
                        </a>
                        <div class="right-side row no-gutters">
                            <a @click="f_refresh()" class="btn btn-icon fuse-ripple-ready">
                                <i class="icon icon-refresh s-10"></i>
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
                    <v-menu offset-y>
                        <button slot="activator" id="add-file-button" type="button" class="btn btn-danger btn-fab fuse-ripple-ready">
                            <i class="icon icon-plus"></i>
                        </button>
                        <v-list>
                            <v-list-tile>
                                <v-list-tile-title>Choisir un fichier</v-list-tile-title>
                                <input type="file" ref="file" class="custom-file-input" name="uploadfile" id="uploadfile" @change="f_uploadFile()" />
                            </v-list-tile>
                            <v-list-tile>
                                <v-list-tile-title>Choisir un dossier</v-list-tile-title>
                                <input type="file" ref="folder" class="custom-file-input" name="uploadfile[]" id="uploadfolder" @change="f_uploadFolder()" webkitdirectory mozdirectory msdirectory odirectory directory multiple />
                            </v-list-tile>
                        </v-list>
                    </v-menu>
                </form>
            </div>
            <!-- / HEADER -->

            <!-- CONTENT -->
            <div class="page-content custom-scrollbar ps ps--theme_default" data-ps-id="fe3679bb-d2bd-acef-4e6e-4ec75edc10b1">
                <v-card height="100%" @contextmenu="f_showContextMenu">
                    <template>
                        <v-data-table
                            :headers="headers_ftp"
                            :items="list_view_ftp"
                            class="elevation-1"
                            :rows-per-page-items="[-1]"
                        >
                            <template slot="items" slot-scope="props">
                                <tr @click="f_openFile_details(props.item)" @dblclick="f_openFolder(props.item)">
                                    <td class="file-icon" ><i :class="[props.item.icon,{'icon-cut' : cutfile.old_path+cutfile.file == path+props.item.title }]"></i></td>
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
        <aside v-if="aside_file_details" class="page-sidebar custom-scrollbar" data-fuse-bar="file-manager-info-sidebar" data-fuse-bar-position="right" data-fuse-bar-media-step="lg">
            <!-- SIDEBAR HEADER -->
            <div class="header bg-secondary text-auto d-flex flex-column justify-content-between p-6">
                <!-- TOOLBAR -->
                <div class="toolbar row no-gutters align-items-center justify-content-end">
                    <button @click="f_downloadFile(file_details)" type="button" class="btn btn-icon fuse-ripple-ready">
                        <i class="icon icon-download"></i>
                    </button>
                    <button  @click="aside_file_details=false" type="button" class="btn btn-icon fuse-ripple-ready">
                        <i class="icon-close"></i>
                    </button>
                </div>
                <div>
                    <div class="title-file mb-2">{{ file_details.title }}</div>
                    <div class="subtitle text-muted">
                        <span>Edited</span>
                        : {{ file_details.last_modified }}
                    </div>
                </div>
            </div>
            <!-- / SIDEBAR HEADER -->

            <!-- SIDENAV CONTENT -->
            <div class="content">
                <div class="file-details">
                    <div class="preview file-icon row no-gutters align-items-center justify-content-center">
                        <i class="s-25" :class="file_details.icon"></i>
                    </div>
                    <div class="offline-switch row no-gutters align-items-center justify-content-between px-6 py-4"></div>
                    <div class="title px-6 py-4">Info</div>
                    <table class="table">
                        <tbody>
                            <tr class="type">
                                <th class="pl-6">Type</th>
                                <td>{{ file_details.type }}</td>
                            </tr>
                            <tr class="size">
                                <th class="pl-6">Size</th>
                                <td>{{ file_details.size }}</td>
                            </tr>
                            <tr class="owner">
                                <th class="pl-6">Owner</th>
                                <td>{{ file_details.owner }}</td>
                            </tr>
                            <tr class="modified">
                                <th class="pl-6">Modified</th>
                                <td>{{ file_details.last_modified }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </aside>
    </div>
</div>

    <v-dialog v-model="dialog_renameFile" width="500">
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
    <v-dialog v-model="dialog_createFolder" width="500">
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

    <v-dialog v-model="dialog_chmodPermissions" width="500">
      <v-card>
        <v-card-title
          class="headline grey lighten-2"
          primary-title
        >
          Change Chmod
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
                <table>
                    <tr>
                        <td>Owner</td>
                        <td><v-checkbox v-model="chmod[0].chmod_check" @change='f_checkboxChmodPermissions(chmod[0])' label="Read"></v-checkbox></td>
                        <td><v-checkbox v-model="chmod[1].chmod_check" @change='f_checkboxChmodPermissions(chmod[1])' label="Write"></v-checkbox></td>
                        <td><v-checkbox v-model="chmod[2].chmod_check" @change='f_checkboxChmodPermissions(chmod[2])' label="Execute"></v-checkbox></td>
                    </tr>
                    <tr>
                        <td>Group</td>
                        <td><v-checkbox v-model="chmod[3].chmod_check" @change='f_checkboxChmodPermissions(chmod[3])' label="Read"></v-checkbox></td>
                        <td><v-checkbox v-model="chmod[4].chmod_check" @change='f_checkboxChmodPermissions(chmod[4])' label="Write"></v-checkbox></td>
                        <td><v-checkbox v-model="chmod[5].chmod_check" @change='f_checkboxChmodPermissions(chmod[5])' label="Execute"></v-checkbox></td>
                    </tr>
                    <tr>
                        <td>Other</td>
                        <td><v-checkbox v-model="chmod[6].chmod_check" @change='f_checkboxChmodPermissions(chmod[6])' label="Read"></v-checkbox></td>
                        <td><v-checkbox v-model="chmod[7].chmod_check" @change='f_checkboxChmodPermissions(chmod[7])' label="Write"></v-checkbox></td>
                        <td><v-checkbox v-model="chmod[8].chmod_check" @change='f_checkboxChmodPermissions(chmod[8])' label="Execute"></v-checkbox></td>
                    </tr>
                </table>
                <v-text-field v-model="total_chmod" mask="###" hint="This field uses maxlength attribute" label="Limit exceeded"></v-text-field>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="f_chmodPermissions()">Save</v-btn>
            <v-btn color="blue darken-1" flat @click="dialog_chmodPermissions = false">Close</v-btn>
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
        <v-list-tile @click='f_viewFile(contextMenu.selected_item)'>
          <v-list-tile-title>Editer</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click='renameItem()'>
          <v-list-tile-title>Renommer</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click='cutfile.cut_active == false?f_cutFile(contextMenu.selected_item):f_pasteFile(contextMenu.selected_item)'>
          <v-list-tile-title v-if="cutfile.cut_active == false">Cut</v-list-tile-title>
          <v-list-tile-title v-else>Paste</v-list-tile-title>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile @click='dialog_createFolder = true'>
          <v-list-tile-title>Créer un dossier</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click='f_downloadFile(contextMenu.selected_item)'>
          <v-list-tile-title>Télécharger</v-list-tile-title>
        </v-list-tile>
        <v-list-tile @click='f_dialog_chmodPermissions'>
          <v-list-tile-title>Chmod</v-list-tile-title>
        </v-list-tile>
        <v-list-tile>
          <v-list-tile-title>Décompresser</v-list-tile-title>
        </v-list-tile>
        <v-divider></v-divider>
        <v-list-tile @click='f_deleteFile(contextMenu.selected_item)'>
          <v-list-tile-title>Supprimer</v-list-tile-title>
        </v-list-tile>
      </v-list>
    </v-menu>
            </div>
        </div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
    var v = new Vue({
        el: '#app',
        data : {
            dialog_renameFile: false,
            dialog_createFolder: false,
            dialog_chmodPermissions: false,
            aside_file_details: false,
            file_details:{icon: '', title: '', size: '', type: '', last_modified: '', chmod: '', owner: ''},
            createfolder:'',
            renamefile:'',
            cutfile:{old_path:'',file:'',cut_active:false},
            currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
            id_website: window.location.href.split('/').pop(),
            list_view_ftp: <?php echo json_encode($all_storage_server); ?>,
            path: '<?php echo $path_server; ?>',
            chmod: [{chmod_check: false, value:400},{chmod_check: false, value:200},{chmod_check: false, value:100},{chmod_check: false, value:40},{chmod_check: false, value:20},{chmod_check: false, value:10},{chmod_check: false, value:4},{chmod_check: false, value:2},{chmod_check: false, value:1}],
            total_chmod: "000",
            headers_ftp: [
                { text: '', value: 'icon', sortable: false},
                { text: 'Name', value: 'name'},
                { text: 'Size', value: 'size'},
                { text: 'Type', value: 'type' },
                { text: 'Last Modified', value: 'last_modified' },
                { text: 'Chmod', value: 'chmod'},
                { text: 'Owner', value: 'owner'},
            ],
            headers_list_chmod: [
                { text: '', value: 'action', sortable: false},
                { text: 'Read', value: 'read'},
                { text: 'Write', value: 'write' },
                { text: 'Execute', value: 'execute'},
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
        mixins: [mixin],
        created(){

        },
        methods:{
            f_showContextMenu (e) {
                if (e.target.localName == "i") {
                    var filename = e.target.parentElement.parentElement.getElementsByClassName("name")[0].innerHTML;
                } else if(e.target.localName == "th") {
                    var filename = "";
                } else {
                    var filename = e.target.parentElement.getElementsByClassName("name")[0].innerHTML;
                }
                v.contextMenu.selected_item = this.list_view_ftp.find( item => item.title === filename);
                e.preventDefault()
                this.contextMenu.showMenu = false
                if (filename != ".." && filename != "") {
                    this.contextMenu.x = e.clientX
                    this.contextMenu.y = e.clientY
                    this.$nextTick(() => {
                        this.contextMenu.showMenu = true
                    })
                }
            },
            f_refresh () {
                var formData = new FormData(); 
                formData.append("path",v.path);
                axios.post(this.currentRoute+"/refreshftp/"+this.id_website, formData).then(function(response){
                    if(response.status = 200){
                        v.list_view_ftp = [];
                        v.list_view_ftp = response.data.folder;
                    }else{

                    }
                })
            },
            f_openFolder (item) {
                var formData = new FormData(); 
                formData.append("path",v.path);
                formData.append("file",item.title);
                axios.post(this.currentRoute+"/openfolderftp/"+this.id_website, formData).then(function(response){
                    if(response.status = 200){
                        v.list_view_ftp = [];
                        v.list_view_ftp = response.data.folder;
                        v.path = response.data.path;
                    }else{

                    }
                })
            },
            f_openFile_details (item){
                v.file_details = item;
                v.aside_file_details = true;
            },
            f_viewFile(item){
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
            f_saveCodemirror(){
                var formData = new FormData();
                formData.append("path",v.path);
                formData.append("file",v.contextMenu.selected_item.title);
                formData.append("content",v.code);
                if (confirm('Are you sure you want to delete this item?') == true) {
                    axios.post(this.currentRoute+"/writefileftp/"+this.id_website, formData).then(function(response){
                        if(response.status = 200){
                            v.codemirror_show = false;
                        }else{

                        }
                    })
                }
            },
            f_closeCodemirror (){
                v.codemirror_show = false;
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
            f_uploadFolder(){
                v.file = this.$refs.folder.files[0];
                var formData = new FormData();
                formData.append('uploadfile', v.file);
                formData.append('path', v.path);
                formData.append("file",v.file.name);
                /*for( var i = 0; i < v.file.length; i++ ){
                let file = v.file[i];

                formData.append('files[' + i + ']', file);
                }*/
                axios.post(this.currentRoute+"/uploadftp/"+this.id_website, formData).then(function(response){
                    if(response.status = 200){
                        v.list_view_ftp.push(response.data);
                    }else{

                    }
                })
            },
            f_downloadFile(item){
                v.contextMenu.selected_item = item;
                var formData = new FormData();
                formData.append("path",v.path);
                formData.append("file",v.contextMenu.selected_item.title);
                formData.append("chmod_permissions",v.contextMenu.selected_item.chmod.charAt(0));
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
            f_dialog_chmodPermissions(){
                v.dialog_chmodPermissions = true;
                v.total_chmod = 0;
                var n = 0,m = 0;
                for (var i = 0; i < v.contextMenu.selected_item.chmod.length; i++) {
                    
                    if (i >= 1 && i <= 3)
                        m = 100;
                    if (i >= 4 && i <= 6)
                        m = 10;
                    if (i >= 7 && i <= 9)
                        m = 1;
                    
                    var l = v.contextMenu.selected_item.chmod.substr(i, 1);
                    
                    if (l != "d" && l != "-") {
                        
                        if (l == "r") {
                            n = 4;
                            v.chmod[i-1].chmod_check = true;
                        }
                        if (l == "w") {
                            n = 2;
                            v.chmod[i-1].chmod_check = true;
                        }
                        if (l == "x") {
                            n = 1;
                            v.chmod[i-1].chmod_check = true;
                        }
                        
                        v.total_chmod += n * m;
                    }
                }
            },
            f_checkboxChmodPermissions (item) {
                if (item.chmod_check == true) {
                    v.total_chmod = v.total_chmod + item.value;
                } else {
                    v.total_chmod = v.total_chmod - item.value;
                }
            },
            f_chmodPermissions(){
                var formData = new FormData();
                formData.append('chmod', v.total_chmod);
                formData.append('path', v.path);
                formData.append("file",v.contextMenu.selected_item.title);
                axios.post(this.currentRoute+"/chmodftp/"+this.id_website, formData).then(function(response){
                    if(response.status = 200){
                        console.log(response);
                    }else{

                    }
                })
            },
            f_cutFile(item){
                v.cutfile.old_path = v.path;
                v.cutfile.file = item.title;
                v.cutfile.cut_active = true;
            },
            f_pasteFile(item){
                var cutIndex = v.list_view_ftp.indexOf(v.list_view_ftp.find( search => search.title === v.cutfile.file));
                var formData = new FormData();
                formData.append('old_path', v.cutfile.old_path);
                formData.append('new_path', v.path);
                formData.append("file", v.cutfile.file);
                axios.post(this.currentRoute+"/moveftp/"+this.id_website, formData).then(function(response){
                    if(response.status = 200){
                        v.cutfile = Object.assign({}, {old_path: '', file: '', cut_active: false});
                        if (cutIndex == -1) {
                            v.list_view_ftp.push(response.data);
                        }
                    }else{

                    }
                })
            },
            f_test(){
                var formData = new FormData();
                formData.append('path', v.path);
                formData.append("file",v.file.name);
                axios.post(this.currentRoute+"/test/"+this.id_website, formData).then(function(response){
                    if(response.status = 200){
                        
                    }else{

                    }
                })
            },
            f_deleteFile(item){
                var formData = new FormData();
                formData.append("path",v.path);
                formData.append("file",item.title);
                formData.append("chmod_permissions",item.chmod.charAt(0));
                if (confirm('Are you sure you want to delete this item?') == true) {
                    axios.post(this.currentRoute+"/deleteftp/"+this.id_website, formData).then(function(response){
                        if(response.status = 200){
                            const index = v.list_view_ftp.indexOf(v.contextMenu.selected_item);
                            v.list_view_ftp.splice(index, 1);
                        }else{

                        }
                    })
                }
            },
        },
    });
</script>
<?php $this->load->view('include/footer.php'); ?>