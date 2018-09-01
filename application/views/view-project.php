<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
    <div class="page-header bg-secondary text-auto p-6 row no-gutters align-items-center justify-content-between">
        <h2 class="doc-title" id="content"><?php echo $project->name_project_tasks; ?></h2>
        <a href="<?php echo site_url('/all-projects/'); ?>" class="btn btn-icon fuse-ripple-ready">
            <i class="icon icon-arrow-left-thick"></i>
        </a>
        <button id="add-event-button" type="button" class="btn btn-danger btn-fab fuse-ripple-ready" aria-label="Add event">
            <i class="icon icon-plus"></i>
        </button>
    </div>
    <div class="page-content">
      <section id="main-content" >
          <section class="wrapper">
            <div class="row">
                <div class="col-sm-12">


<div class="ng-tns-c58-59 ng-star-inserted">
    <div class="page-layout simple left-sidebar inner-scroll" id="academy-course">
        <aside class="sidebar left-positioned open locked-open col-md-2">
            <div class="content">
                <div class="steps">
                    <?php foreach ($all_card_tasks->result() as $row_list_tasks) { ?>
                        <?php if ($row_list_tasks->id_list_tasks==1) { ?>
                            <a href="#step-<?php echo $row_list_tasks->id_list_tasks; ?>" class="step ng-tns-c58-59 current first ng-star-inserted">
                                <div class="index"><span class="ng-tns-c58-59"><?php echo $row_list_tasks->id_list_tasks; ?></span></div>
                                <div class="title"><?php echo $row_list_tasks->title_card_tasks; ?></div>
                            </a>
                        <?php } else { ?>
                            <a href="#step-<?php echo $row_list_tasks->id_list_tasks; ?>" class="step ng-tns-c58-59 ng-star-inserted">
                                <div class="index"><span class="ng-tns-c58-59"><?php echo $row_list_tasks->id_list_tasks; ?></span></div>
                                <div class="title"><?php echo $row_list_tasks->title_card_tasks; ?></div>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
        </aside>
        <div class="center col-md-10">
            <div class="header mat-accent-bg p-24" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                <button class="sidebar-toggle mr-16 mat-icon-button" fxhide.gt-md="" mat-icon-button="" style="display: none;"><span class="mat-button-wrapper"><mat-icon class="mat-icon ng-tns-c58-59 material-icons" role="img" aria-hidden="true">menu</mat-icon></span>
                    <div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
                    <div class="mat-button-focus-overlay"></div>
                </button>
                <button class="mr-16 mat-icon-button" mat-icon-button="" tabindex="0"><span class="mat-button-wrapper"><mat-icon class="mat-icon ng-tns-c58-59 material-icons" role="img" aria-hidden="true">arrow_back</mat-icon></span>
                    <div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
                    <div class="mat-button-focus-overlay"></div>
                </button>
                <div class="ng-tns-c58-59">
                    <h2 class="ng-tns-c58-59">Basics of Angular</h2></div>
            </div>
            <div class="step-content">
                <div class="row setup-content" id="step-1">
                    <div class="course-step ng-tns-c58-59" fuseperfectscrollbar="">
                        <div class="course-step-content" id="course-step-content">
                            <h1>Step 1 - Introduction</h1>
                            <div class="adv-table editable-table ">
                                <table class="table table-striped table-bordered table-hover dt-responsive table-dashboard" id="table-view-project">
                                  <thead>
                                    <th class="all">check</th>
                                    <th class="desktop">Name Tasks</th>
                                    <th class="desktop">User</th>
                                  </thead>
                                  <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="step-navigation">
                <button class="prevBtn mat-accent white-fg mat-fab" mat-fab="" disabled="" style="display: none;"><span class="mat-button-wrapper"><mat-icon class="mat-icon ng-tns-c58-59 material-icons" role="img" aria-hidden="true">chevron_left</mat-icon></span>
                    <div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
                    <div class="mat-button-focus-overlay"></div>
                </button>
                <button class="nextBtn mat-accent white-fg mat-fab" mat-fab="" style="display: block;"><span class="mat-button-wrapper"><mat-icon class="mat-icon ng-tns-c58-59 material-icons" role="img" aria-hidden="true">chevron_right</mat-icon></span>
                    <div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
                    <div class="mat-button-focus-overlay"></div>
                </button>
                <button class="done mat-green-600-bg mat-fab mat-accent" mat-fab="" routerlink="/apps/academy/courses" tabindex="0" disabled="" style="display: none;"><span class="mat-button-wrapper"><mat-icon class="mat-icon ng-tns-c58-59 material-icons" role="img" aria-hidden="true">check</mat-icon></span>
                    <div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div>
                    <div class="mat-button-focus-overlay"></div>
                </button>
            </div>
        </div>
    </div>
</div>



            </div>
        </div>
    </section>
</section>









        
        <!-- <section id="main-content">
            <section class="wrapper">
            <div class="row">
                <div class="col-sm-12">
                            <div class="container-fluid">
                    <div class="row" id="sortableKanbanBoards">
                        <div class="card card-primary kanban-col custom-scrollbar">
                            <div class="card card-default">
                                <div class="card-header">
                                    Project Details
                                </div>
                                <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h1 class="title-view-project"><?php echo $project->name_project_tasks; ?></h5>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="no-margin"><?php echo lang('time_spent'); ?></h5>
                                                    </div>
                                                    
                                                    <div class="col-md-6 text-right">
                                                        <h5 class="no-margin"><?php echo $datetimestart; ?> <?php echo lang('days'); ?></h5>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 class="no-margin m-t-5"><?php echo lang('remaining_time'); ?></h5>
                                                    </div>
                                                    
                                                    <div class="col-md-6 text-right">
                                                        <h5 class="no-margin m-t-5"><?php echo $datetimedeadline; ?> <?php echo lang('days'); ?></h5>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12 m-t-5">
                                                        <h6 class="no-margin m-b-10">Taches réalisées : <?php echo $percentage_project->percentage; ?>%</h6>
                                                        <div class="progress m-t-5 m-b-10">
                                                            <div class="progress-bar progress-bar-success progress-bar-striped active" style="width:<?php echo $percentage_project->percentage; ?>%">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h6 class="no-margin m-b-10">Assigned to</h6>
                                                        <?php foreach ($all_users_to_project->result() as $row_user) { ?>
                                                            <span class="w-40 avatar circle green" data-toggle="tooltip" data-placement="top" title="<?php echo $row_user->username; ?>" value="<?php echo $row_user->username; ?>"><?php echo substr($row_user->username, 0, 2); ?></span>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h6 class="no-margin">Project details</h6>
                                                        <div class="row">
                                                            <div class="col-md-6 col-xs-6">
                                                                <h5><?php echo lang('website'); ?></h5>
                                                                <h5>List Task</h5>
                                                            </div>
                                                            <div class="col-md-6 col-xs-6 text-right">
                                                                <h5><?php echo $project->url_website; ?></h5>
                                                                <h5><?php echo $all_card_tasks->num_rows(); ?></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h6 class="no-margin m-b-10">Options</h6>
                                                        <div class="checkbox">
                                                            <label>
                                                                <div class="checker border-info text-info"><span class="checked"><input type="checkbox" class="control-info" checked="checked"></span></div>
                                                                Make this project a priority
                                                            </label>
                                                        </div>
                                                        <a class="access-list-tasks btn btn-sm btn-success mb-3 fuse-ripple-ready" href="javascript:void(0);" data-toggle="modal" data-target="#view-list-tasks"><span><i class="fa fa-plus"></i></span> Send mail All project</a>
                                                    </div>
                                                </div>
                                </div>
                            </div>
                        </div>



            <div class="card card-primary kanban-col custom-scrollbar">
                <div class="card-header">
                    TODO
                </div>
                <div class="card-body">
                    <div id="TODO" class="kanban-centered">

                    <?php foreach ($all_card_tasks_to_do->result() as $row_list_tasks) { ?>
                        <a class="kanban-entry grab" href="<?php echo site_url('/all-projects/view_card_tasks/'); ?>" draggable="true" data-toggle="modal" data-target="#view-card-tasks"  data-id="<?php echo $row_list_tasks->id_list_tasks; ?>">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><?php echo $row_list_tasks->title_card_tasks; ?></h2>
                                    <span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                         <span class="badge badge-dark"><?php echo $row_list_tasks->count_tasks_completed ." / ".count($row_list_tasks->tasks); ?></span>
                                    </span>
                                </div>
                            </div>
                        </a>
                    <?php } ?>

                    </div>
                </div>
                <div class="card-footer">
                    <a class="add-card-link" href="#">Add a card...</a>
                    <div class="add-card-form">
                        <form id="form-list-tasks" method="post" action="<?php echo site_url('/all-projects/create-list-tasks/'.$project->id_project_tasks); ?>">
                            <div class="form-group">
                                <input type="text" class="form-control" id="titlelisttasks" name="titlelisttasks" placeholder="Titre Liste Tasks" required >
                                <label for="titlelisttasks">Titre Liste Tasks</label>
                                </small>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary fuse-ripple-ready">Sign in</button>
                                </div>
                                <div class="col-sm-2">
                                    <a href="javascript:void(0);">
                                        <i class="icon icon-close"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card card-primary kanban-col custom-scrollbar">
                <div class="card-header">
                    DOING
                </div>
                <div class="card-body">
                    <div id="DOING" class="kanban-centered">

                        <?php foreach ($all_card_tasks_in_progress->result() as $row_list_tasks) { ?>
                            <a class="kanban-entry grab" href="<?php echo site_url('/all-projects/view_card_tasks/'); ?>" draggable="true" data-toggle="modal" data-target="#view-card-tasks"  data-id="<?php echo $row_list_tasks->id_list_tasks; ?>">
                                <div class="kanban-entry-inner">
                                    <div class="kanban-label">
                                        <h2><?php echo $row_list_tasks->title_card_tasks; ?></h2>
                                        <span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                             <span class="badge badge-dark"><?php echo $row_list_tasks->count_tasks_completed ." / ".count($row_list_tasks->tasks); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="card card-primary kanban-col custom-scrollbar">
                <div class="card-header">
                    DONE
                </div>
                <div class="card-body">
                    <div id="DONE" class="kanban-centered">

                        <?php foreach ($all_card_tasks_completed->result() as $row_list_tasks) { ?>
                            <a class="kanban-entry grab" href="<?php echo site_url('/all-projects/view_card_tasks/'); ?>" draggable="true" data-toggle="modal" data-target="#view-card-tasks"  data-id="<?php echo $row_list_tasks->id_list_tasks; ?>">
                                <div class="kanban-entry-inner">
                                    <div class="kanban-label">
                                        <h2><?php echo $row_list_tasks->title_card_tasks; ?></h2>
                                        <span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                             <span class="badge badge-dark"><?php echo $row_list_tasks->count_tasks_completed ." / ".count($row_list_tasks->tasks); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>


                    </div>
                </div>
            </div>


                </div>
                    </div>
                </div>
            </div>
            </section>
        </section> -->
    </div>
  </div>
</div>
<div class="modal fade" id="view-card-tasks" tabindex="-1" role="dialog" aria-labelledby="view-card-tasks" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter une tâche</h4>
      </div>
          <div class="modal-body">
            <div class="form-group">
                <input type="hidden" class="form-control" id="idlisttasks" name="idlisttasks">
            </div>
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3">title tasks</label>
                <div class="col-lg-12">
                  <input class="form-control" type="text" name="titlelisttasks" id="titlelisttasks" placeholder="Titre Liste Tasks" required />
                </div>
            </div>
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3">description tasks</label>
                <div class="col-lg-12">
                  <textarea class="form-control" type="text" name="descriptiontask" id="descriptiontask" placeholder="Description Task" required></textarea>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <select name="tasksstatus" class="form-control">
                    <?php foreach ($all_tasks_status->result() as $row){  ?>
                      <option value="<?php echo $row->id_tasks_status; ?>"><?php echo $row->name_tasks_status; ?></option>
                    <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <select name="taskspriority" class="form-control">
                    <?php foreach ($all_tasks_priority->result() as $row){  ?>
                      <option value="<?php echo $row->id_tasks_priority; ?>"><?php echo $row->name_tasks_priority; ?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>

            <span class="section-title" fxflex="" style="flex: 1 1 0%; box-sizing: border-box;">Pages</span>
            <span class="checklist-progress-value"></span>
            <div class="progress" style="height:4px;">
                <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div id="tasks"></div>
            <form id="form-task" method="post" action="<?php echo site_url('/all-projects/create-task/'.$project->id_project_tasks); ?>">
                <div class="form-row">
                    <div class="form-group col-md-7">
                      <input class="titletasks form-control" type="text" name="titletask" placeholder="Titre Task" required />
                    </div>
                    <div class="form-group col-md-5">
                        <a href="javascript:void(0);" class="add-user"><i class="icon icon-plus-circle"></i></a>
                        <input id="autocomplete-user" class="form-control" type="text" name="titletask" placeholder="Titre Task" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-share"></span>ADD Tasks</button>
                    </div>
                </div>
            </form>

          </div>
    </div>
  </div>
</div>

<div class="modal fade" id="view-send-mail" tabindex="-1" role="dialog" aria-labelledby="view-send-mail" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-warning">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter une tâche</h4>
      </div>
          <div class="modal-body">

            <form id="form-task" method="post" action="<?php echo site_url('/all-projects/create-task/'.$project->id_project_tasks); ?>">
                <div class="form-row">
                    <div class="form-group col-md-7">
                      <input class="titletasks form-control" type="text" name="titletask" placeholder="Titre Task" required />
                    </div>
                    <div class="form-group col-md-5">
                        <a href="javascript:void(0);" class="add-user"><i class="icon icon-plus-circle"></i></a>
                        <input id="autocomplete-user" class="form-control" type="text" name="titletask" placeholder="Titre Task" required />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-share"></span>ADD Tasks</button>
                    </div>
                </div>
            </form>

          </div>
    </div>
  </div>
</div>


<?php $this->load->view('include/javascript.php'); ?>
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
            var nEditingViewProject = null;
            var ElementDelete = null;
            var viewprojectTable = $('#table-view-project').DataTable({
                  "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "Tous"]],
                  "order": [],
                  "dom": 'lBfrtip',
                  "buttons": [
                      {
                          extend: 'collection',
                          text: 'Export',
                          buttons: [
                              'copy',
                              'excel',
                              'csv',
                              'pdf',
                              'print'
                          ]
                      }
                  ],
                  responsive: {
                          details: {
                             
                          }
                      },
                      columnDefs: [ {
                          className: 'control',
                          orderable: false,
                          targets:   0
                      } ],
            });
        }
    };

}();
$(document).ready(function(){

    EditableTable.init();
/*    var table = $('#table-view-project').DataTable();
 
table.rows.add( [ {
        "titre":       "Tiger Nixon",
        "toto":   "System Architect"
    }, {
        "titre": "Garrett Winters",
        "toto": "Director"
    } ] )
    .draw();
*/

    var navListItems = $('.steps a'),
        allWells = $('.setup-content'),
        allNextBtn = $('.nextBtn'),
        allPrevBtn = $('.prevBtn');

   /* allWells.hide();*/

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this);

        $.ajax({
            type: "POST",
            async:false,
            url: window.location.href.substr(0, window.location.href.lastIndexOf('/') + 1)+'view_card_tasks/',
            data: {'idproject':window.location.href.split('/').pop() ,'idcard':$(this).find('.index').text()},
            success: function(data){
                var jsdata = JSON.parse(data);

                console.log($item);

                $(".setup-content").attr("id",$item.attr('href').substr(1,$item.attr('href').length));
                
                $("#table-view-project").DataTable().rows().remove().draw();
                $("#table-view-project").DataTable().rows.add(jsdata).draw();
            },
            error: function(msg){
                console.log(msg.responseText);
            }
        });


        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('current').removeClass('completed');
            $.each( $('.steps a'), function(i, item) {
                if (i < $item.index()) {
                    $(item).addClass('completed');
                } else if (i==$item.index()) {
                    $(item).addClass('current');
                }
            });
            /*allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();*/
        }


    });

    allPrevBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            prevStepSteps = $('.steps a[href="#' + $('.step-content').children(":visible").attr("id") + '"]').prev();

            prevStepSteps.removeAttr('disabled').trigger('click');
    });

    allNextBtn.click(function(){

        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('.steps a[href="#' + $('.step-content').children(":visible").attr("id") + '"]').next(),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i< curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('.steps a.current').trigger('click');




    


   /* var autocomplete_user = JSON.parse('<?php echo json_encode($users); ?>');

    $('#autocomplete-user').autocomplete({
        lookup: autocomplete_user,
        onSelect: function (suggestion) {
        }
    });
    $(".add-user").click(function() {
        $('#autocomplete-user').show().focus();
        $(this).hide();
    });
    $('#autocomplete-user').blur(function() {
        $(".add-user").show();
        $(this).hide();
    });

    $(".add-card-link").click(function() {
        $(this).hide();
        $(".add-card-form").slideDown();
    });
    $(".add-card-form a").click(function() {
        $(".add-card-form").hide();
        $(".add-card-link").show();
    });
    
    $(".kanban-entry").click(function(e){
        var idcard = $(this).data('id');
        $.ajax({
            type: "POST",
            url: $(this).attr('href'),
            data: {'idproject':window.location.href.split('/').pop() ,'idcard':idcard},
            success: function(data){
                $('#view-card-tasks #titlelisttasks').empty();
                $('#view-card-tasks #descriptiontask').empty();
                $('#view-card-tasks #tasks').empty();
                $('#view-card-tasks .checklist-progress-value').empty();
                var jsdata = JSON.parse(data);

                $('#view-card-tasks #titlelisttasks').val(jsdata.card_tasks.title_card_tasks);
                $('#view-card-tasks #descriptiontask').val(jsdata.card_tasks.description_card_tasks);
                $('#view-card-tasks .checklist-progress-value').append(jsdata.card_tasks.count_tasks_completed+' / '+jsdata.card_tasks.tasks.length);
                $('#view-card-tasks .progress-bar').css({ width: (jsdata.card_tasks.count_tasks_completed/jsdata.card_tasks.tasks.length)*100+'%' });
                $.each(jsdata.card_tasks.tasks, function(i, item) {
                    $('#tasks').append('<div class="todo-item pr-2 py-4 ripple row no-gutters flex-wrap flex-sm-nowrap align-items-center fuse-ripple-ready"><label class="custom-control custom-checkbox"><input type="checkbox" value="'+jsdata.card_tasks.tasks[i].id_task+'" class="form-check-input"><span class="checkbox-icon fuse-ripple-ready"></span></label><input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="'+jsdata.card_tasks.tasks[i].name_task+'"><span class="w-40 avatar circle green" data-toggle="tooltip" data-placement="top" title="" value="'+jsdata.card_tasks.tasks[i].username+'" data-original-title="quentin">'+jsdata.card_tasks.tasks[i].username+'</span></div><div class="buttons col-12 col-sm-auto d-flex align-items-center justify-content-end"><button type="button" class="btn btn-icon fuse-ripple-ready"><i class="icon icon-dots-vertical"></i></button></div>');
                });


            },
            error: function(msg){
                console.log(msg.responseText);
            }
        });
        e.preventDefault();
    });
    $("#form-list-tasks").submit(function(e){
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(msg){
                console.log(msg.responseText);
            },
            error: function(msg){
                console.log(msg.responseText);
            }
        });
        e.preventDefault();
    });
    $("#form-task").submit(function(e){
        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(msg){
                console.log(msg.responseText);
            },
            error: function(msg){
                console.log(msg.responseText);
            }
        });
        e.preventDefault();
    });
    $(document).on("click", ".checkbox-icon", function(e) {
        $.ajax({
            type: "POST",
            url: window.location.href.substr(0, window.location.href.lastIndexOf('/') + 1)+'/edit-tasks/'+id,
            data: $(this).serialize(),
            success: function(msg){
                console.log(msg.responseText);
            },
            error: function(msg){
                console.log(msg.responseText);
            }
        });
        e.preventDefault();
    });
    $('#view-task').on('show.bs.modal', function (event) {
        var idlisttasks = $(event.relatedTarget).data('id');

        $(this).find('.modal-body input#idlisttasks').val(idlisttasks);
    });


            var kanbanCol = $('.card-body');
            kanbanCol.css('max-height', (window.innerHeight - 380) + 'px');

            var kanbanColCount = parseInt(kanbanCol.length);
            $('.container-fluid').css('min-width', (kanbanColCount * 350) + 'px');

            draggableInit();

            $('.card-header').click(function() {
                var $cardBody = $(this).parent().children('.card-body');
                $cardBody.slideToggle();
            });
        function draggableInit() {
            var sourceId;
            $('[draggable=true]').bind('dragstart', function (event) {
                sourceId = $(this).parent().attr('id');
                event.originalEvent.dataTransfer.setData("text/plain", event.target.getAttribute('id'));
            });
            $('.card-body').bind('dragover', function (event) {
                event.preventDefault();
            });
            $('.card-body').bind('drop', function (event) {
                var children = $(this).children();
                var targetId = children.attr('id');
                if (sourceId != targetId) {
                    var elementId = event.originalEvent.dataTransfer.getData("text/plain");
                    $('#processing-modal').modal('toggle'); //before post
                    setTimeout(function () {
                        var element = document.getElementById(elementId);
                        children.prepend(element);
                        $('#processing-modal').modal('toggle'); // after post
                    }, 1000);
                }
                event.preventDefault();
            });
        }*/






    

});
</script>

<?php $this->load->view('include/footer.php'); ?>