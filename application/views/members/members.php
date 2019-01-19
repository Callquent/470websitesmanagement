<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">
  <div id="contacts" class="page-layout simple left-sidebar-floating">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo lang('members'); ?></h2>
    </div>
    <div class="page-content-wrapper">
        <aside class="page-sidebar p-6" data-fuse-bar="contacts-sidebar" data-fuse-bar-media-step="md">
            <div class="page-sidebar-card">
                <div class="header p-4">
                    <div class="row no-gutters align-items-center">
                        <span class="w-40 avatar circle green" data-toggle="tooltip" data-placement="top" title="" data-original-title="<?php echo $login; ?>" value="<?php echo $login; ?>"><?php echo substr($login, 0, 2); ?></span>
                        <span class="font-weight-bold"><?php echo $login; ?></span>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="content">
                    <ul class="nav flex-column groups-members">
                        <div class="divider"></div>
                        <li class="nav-item">
                            <a class="all-groups-members nav-link ripple active fuse-ripple-ready" href="#">
                                <span>All</span>
                            </a>
                        </li>
                        <div class="divider"></div>
                        <li class="subheader">Groups</li>
                        <div class="divider"></div>
                        <?php foreach ($list_groups->result() as $row){  ?>
                            <li class="nav-item">
                                <a class="nav-link ripple active fuse-ripple-ready" href="#">
                                    <span><?php echo $row->name; ?></span>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </aside>
        <div class="page-content p-4 p-sm-6">
            <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" width="100%" id="table-members">
                <thead>
                  <tr>
                      <th class="all"></th>
                      <th class="desktop">Name</th>
                      <th class="desktop">Email</th>
                      <th class="desktop">Groupe</th>
                      <th class="desktop"><?php echo lang('actions'); ?></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($list_users->result() as $row) { ?>
                    <tr>
                        <td>
                            <label class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input">
                                <span class="custom-control-indicator fuse-ripple-ready"></span>
                            </label>
                        </td>
                        <td><?php echo $row->name_user; ?></td>
                        <td><?php echo $row->email; ?></td>
                        <td><?php echo $row->name_group; ?></td>
                        <td>
                            <div class="dropdown show actions">
                                <a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
                                  <i class="icon icon-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                  <a class="dropdown-item" id="edit-members" href="<?php echo site_url('members/edit/'.$row->id); ?>"><i class="fa fa-pencil"></i> Edit</a>
                                  <a class="dropdown-item" id="delete-members" href="<?php echo site_url('members/delete/'.$row->id); ?>"><i class="fa fa-trash"></i> Delete</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                  <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
  </div>
</div>
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="members-edit" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Form Members</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="" id="form-edit-user" role="form">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Group</label>
                        <select name="members" class="form-control">
                        <?php foreach ($list_groups->result() as $row){  ?>
                            <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">

var v = new Vue({
    el: '#app',
    data : {
        steps: <?php echo json_encode($all_card_tasks->result_array()); ?>,
        users: <?php echo json_encode($list_users->result_array()); ?>,
        dialog_add_task: false,
        dialog_add_card: false,
        currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
        id_project: window.location.href.split('/').pop(),
        id_card: <?php echo json_encode($all_card_tasks->row()->id_card_tasks); ?>,
        headers: [
            { text: 'Name Task', value: 'name_task', sortable: false},
            { text: 'User', value: 'username' },
            { text: 'Actions', value: 'name', sortable: false }
        ],
        newCard:{
            name_card_tasks:"",
            id_card_task: <?php echo $all_card_tasks->num_rows()+1; ?>,
            min: "1",
            max: <?php echo $all_card_tasks->num_rows()+1; ?>,
        },
        newTask:{
            nametask:'',
            user:'',
        },
        check_tasks_complete:0,
        valueDeterminate: 0,
        title_card_tasks:"",
        list_tasks: [],
    },
    created(){
        this.displayPage();
    },
    methods:{
        displayPage(){
            var formData = new FormData(); 
            formData.append("id_project_tasks",this.id_project);
            formData.append("id_card_tasks",this.id_card);
            axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
                if(response.status = 200){
                    if (response.data.card_tasks.tasks != null) {
                        for (var i = 0; i < response.data.card_tasks.tasks.length; ++i) {
                            
                            if (response.data.card_tasks.tasks[i].check_tasks=="1") {
                                response.data.card_tasks.tasks[i].check_tasks = true;
                                v.check_tasks_complete++;
                            } else {
                                response.data.card_tasks.tasks[i].check_tasks=false;
                            }
                            v.list_tasks.push(response.data.card_tasks.tasks[i]);
                        }
                    }
                    v.valueDeterminate = v.f_isNaN((v.check_tasks_complete/v.list_tasks.length)*100);
                    v.title_card_tasks = response.data.title_card_tasks;
                }else{

                }
            })
        },
        f_createCard(){
            var formData = new FormData();
            formData.append("name_card_tasks",v.newCard.name_card_tasks);
            formData.append("id_card_task",v.newCard.id_card_task);
            formData.append("id_project_tasks",v.id_project);
            axios.post(this.currentRoute+"/create-card-tasks/", formData).then(function(response){
                if(response.status = 200){
                    v.steps.push({title_card_tasks: v.newCard.name_card_tasks,id_card_tasks: v.newCard.id_card_task,id_project_tasks: v.id_project});
                    v.newCard.max = v.newCard.max + 1;
                    v.dialog_add_card = false;
                }else{

                }
            })
        },
        deleteCard(item){
            var formData = new FormData();
            formData.append("id_project_tasks",this.id_project);
            formData.append("id_card_task",this.id_card);
            if (confirm('Are you sure you want to delete this item?') == true) {
                axios.post(this.currentRoute+"/delete-card-tasks/", formData).then(function(response){
                    if(response.status = 200){
                        const index = v.steps.indexOf(item);
                        v.steps.splice(index, 1);
                        v.newCard.max = v.newCard.max - 1
                    }else{

                    }
                })
            }
        },
        f_checkTask(item){
            var formData = new FormData();
            formData.append("id_project_tasks",this.id_project);
            formData.append("id_card_tasks",this.id_card);
            formData.append("id_task",item.id_task);
            formData.append("check_tasks",item.check_tasks);
            axios.post(this.currentRoute+"/check-tasks/", formData).then(function(response){
                if(response.status = 200){
                    // item.check_tasks = (item.check_tasks=1?true:false);
                    if (item.check_tasks == 1) {
                        v.valueDeterminate = v.f_isNaN((v.check_tasks_complete+1)/v.list_tasks.length*100)
                        v.check_tasks_complete++
                    } else {
                        v.valueDeterminate = v.f_isNaN((v.check_tasks_complete-1)/v.list_tasks.length*100)
                        v.check_tasks_complete--
                    }
                    
                    /*v.steps = response.data.card_tasks.name_tasks_status
                    Object.assign(v.steps[v.steps.indexOf(item)], v.editedItem)*/
                }else{

                }
            })
        },
        f_createTask(){
            var formData = new FormData();
            formData.append("nametask",this.newTask.nametask);
            formData.append("user",this.newTask.user);
            formData.append("id_project_tasks",this.id_project);
            formData.append("id_card_tasks",this.id_card);
            axios.post(this.currentRoute+"/create-task/", formData).then(function(response){
                if(response.status = 200){
                    v.list_tasks.push({name_task: v.newTask.nametask,username: v.newTask.user})
                }else{

                }
            })
        },
        deleteTask(item){
            var formData = new FormData();
            formData.append("id_project_tasks",this.id_project);
            formData.append("id_card_tasks",this.id_card);
            formData.append("id_task",item.id_task);
            if (confirm('Are you sure you want to delete this item?') == true) {
                axios.post(this.currentRoute+"/delete_task/", formData).then(function(response){
                    if(response.status = 200){
                        const index = v.list_tasks.indexOf(item)
                        v.list_tasks.splice(index, 1)
                    }else{

                    }
                })
            }
        },
        f_isNaN(val) {
            if (isNaN(val)) {
                return 0;
            } else {
                return val;
            }
        }
    }
})

</script>
<script type="text/javascript">
var EditableTable = function () {

    return {
        init: function () {
        function restoreRow(pTable, nRow) {
            var aData = pTable.row(nRow).data();
            var jqTds = $('>td', nRow);

            for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
                pTable.cell(nRow, i).data(aData[i]).draw();
            }
        }
            var nEditingMembers = null;
            var membersTable = $('#table-members').DataTable({
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
            function editRowMembers(membersTable, nRow, nUrl) {
              var aData = membersTable.row(nRow).data();
              var jqTds = $('>td', nRow);
              jqTds[2].innerHTML = '<input type="text" class="form-control small" id="email_member" value="' + aData[2] + '">';

                $.getJSON(window.location.href+'/loadGroup/', function( data ) {
                    MembersList = '<select id="type_member" class="form-control">';
                        $.each( data, function( key, val ) {
                            if ( val.name == aData[3] ) {
                                MembersList += '<option value="'+val.id+'" selected>'+ val.name + '</option>';
                            } else{
                                MembersList += '<option value="'+val.id+'">'+ val.name + '</option>';
                            }
                        });
                        MembersList += '</select>';
                    jqTds[3].innerHTML = MembersList;
                });

              jqTds[4].innerHTML = '<a id="edit-members" href="'+nUrl+'" class="btn btn-white"><i class="icon-check" value="check"></i></a><a id="cancel-members" href="" class="btn btn-white"><i class="icon-close"></i></a>';
            }
            function saveRowMembers(membersTable, nRow, nUrl) {
                var jqInputs = $('input', nRow);
                membersTable.cell(nRow, 2).data(jqInputs[1].value).draw();
                var jqSelects = $('select', nRow);
                membersTable.cell(nRow, 3).data(jqSelects[0].options[jqSelects[0].selectedIndex].text).draw();
                membersTable.cell(nRow, 4).data(membersTable.row(nRow).data()[4]).draw();
            }
            function deleteRowMembers(membersTable, nRow, nUrl) {
                var aData = membersTable.row(nRow).data();
                var jqTds = $('>td', nRow);
                jqTds[4].innerHTML = '<a id="delete-members" href="'+nUrl+'" class="btn btn-white"><i class="icon-check" value="check"></i></a><a id="cancel-members" href="" class="btn btn-white"><i class="icon-close"></i></a>';
            }
            $(document).on('click', '#table-members #cancel-members', function (e) {
                e.preventDefault();
                if ($(this).attr("data-mode") == "new") {
                    var nRow = $(this).parents('tr')[0];
                    membersTable.fnDeleteRow(nRow);
                } else {
                    restoreRow(membersTable, nEditingMembers);
                    nEditingMembers = null;
                }
            });
            $(document).on('click', '#table-members #edit-members', function (e) {
                e.preventDefault();

                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                
                if (nEditingMembers !== null && nEditingMembers != nRow) {
                    restoreRow(membersTable, nEditingMembers);
                    editRowMembers(membersTable, nRow, nUrl);
                    nEditingMembers = nRow;
                } else if (nEditingMembers == nRow && $(this).find("i").attr("value") == "check") {

                    var emailmember = $('#email_member').val();
                    var idgroup_member_old = $('#type_member option[selected]').val();
                    var idgroup_member_new = $('#type_member').val();
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        data: {'emailmember':emailmember,'idgroup_member_old':idgroup_member_old,'idgroup_member_new':idgroup_member_new},
                        success: function(msg){
                            saveRowMembers(membersTable, nEditingMembers, nUrl);
                            nEditingMembers = null;
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                } else {
                    editRowMembers(membersTable, nRow, nUrl);
                    nEditingMembers = nRow;
                }
            });
            $(document).on('click', '#table-members #delete-members', function (e) {
                var nRow = $(this).parents('tr')[0];
                var nUrl = $(this).attr('href');
                if (nEditingMembers != nRow) {
                    deleteRowMembers(membersTable, nRow, nUrl);
                    nEditingMembers = nRow;
                } else if (nEditingMembers == nRow && $(this).find("i").attr("value") == "check") {
                    $.ajax({
                        type: "POST",
                        url: $(this).attr('href'),
                        success: function(msg){
                            var nRow = $('#table-members #delete-members').parents('tr');
                            membersTable.row(nRow).remove().draw();
                        },
                        error: function(msg){
                            console.log(msg);
                        }
                    });
                }
                e.preventDefault();
            });
            $('.groups-members .nav-link').on( 'click', function () {
                membersTable.columns(3).search( $(this).text().trim() ).draw();
            });
            $('.groups-members .all-groups-members.nav-link').on( 'click', function () {
                membersTable.columns(3).search("").draw();
            });
        }

    };

}();
$(document).ready(function(){

    EditableTable.init();

        $('#members-edit').on('show.bs.modal', function (event) {
            var id = $(event.relatedTarget).data('id');
            var idgroup;
            $.getJSON( window.location.href+'/userGroup/'+id, function( data ) {
                idgroup = data;
                var modal = $(this);
                $('#form-edit-user').attr('action', window.location.href+'/edit/'+id+'/'+idgroup)
                $('#members-edit select[name="members"] option').each(function() {
                    if ($(this).val() == idgroup) {
                        $(this).prop('selected', true);
                    }
                });         
            });
        }); 
  });
</script>
<?php $this->load->view('include/footer.php'); ?>