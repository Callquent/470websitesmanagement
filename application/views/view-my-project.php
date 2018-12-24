<?php $this->load->view('include/header.php'); ?>
<div class="content custom-scrollbar">

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
                        <a class="kanban-entry grab" href="<?php echo site_url('/all-projects/view-card-tasks/'); ?>" draggable="true" data-toggle="modal" data-target="#view-card-tasks"  data-id="<?php echo $row_list_tasks->id_card_tasks; ?>">
                            <div class="kanban-entry-inner">
                                <div class="kanban-label">
                                    <h2><?php echo $row_list_tasks->title_card_tasks; ?></h2>
                                    <span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                         <span class="badge badge-dark"><?php echo $row_list_tasks->count_tasks_check_per_card ." / ".$row_list_tasks->count_tasks_per_card; ?></span>
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
                            <a class="kanban-entry grab" href="<?php echo site_url('/all-projects/view-card-tasks/'); ?>" draggable="true" data-toggle="modal" data-target="#view-card-tasks"  data-id="<?php echo $row_list_tasks->id_card_tasks; ?>">
                                <div class="kanban-entry-inner">
                                    <div class="kanban-label">
                                        <h2><?php echo $row_list_tasks->title_card_tasks; ?></h2>
                                        <span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                             <span class="badge badge-dark"><?php echo $row_list_tasks->count_tasks_check_per_card ." / ".$row_list_tasks->count_tasks_per_card; ?></span>
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
                            <a class="kanban-entry grab" href="<?php echo site_url('/all-projects/view-card-tasks/'); ?>" draggable="true" data-toggle="modal" data-target="#view-card-tasks"  data-id="<?php echo $row_list_tasks->id_card_tasks; ?>">
                                <div class="kanban-entry-inner">
                                    <div class="kanban-label">
                                        <h2><?php echo $row_list_tasks->title_card_tasks; ?></h2>
                                        <span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                             <span class="badge badge-dark"><?php echo $row_list_tasks->count_tasks_check_per_card ." / ".$row_list_tasks->count_tasks_per_card; ?></span>
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

        
<content>
<scrumboard-board><mat-sidenav-container class="mat-drawer-container mat-sidenav-container"><mat-sidenav-content><div id="board" class="ng-tns-c39-37" style="flex-direction: row; box-sizing: border-box; display: flex;"><div fxflex="" style="flex: 1 1 0%; box-sizing: border-box;" class="board-content-wrapper p-16 p-md-24"><div fxlayout="row" ngxdroppable="list" style="flex-direction: row; box-sizing: border-box; display: flex;" class="board-content ngx-dnd-container p-16 p-md-24 ng-trigger ng-trigger-animateStagger">
    <scrumboard-board-list class="scrumboard-board-list list-wrapper ngx-dnd-item ng-tns-c39-37 ng-trigger ng-trigger-animate ng-star-inserted" ngxdraggable="" style=""><div class="list mat-elevation-z1" fxlayout="column" style="flex-direction: column; box-sizing: border-box; display: flex;"><div class="list-header" fxflex="" fxlayout="row" fxlayoutalign="space-between center" style="flex-direction: row; box-sizing: border-box; display: flex; place-content: center space-between; align-items: center; flex: 1 1 1e-09px;">
        <scrumboard-board-edit-list-name fxflex="1 0 auto" style="flex: 1 0 auto; box-sizing: border-box; flex-direction: row; display: flex;"><!----><div class="list-header-name ng-star-inserted" fxflex="1 0 auto" style="flex: 1 0 auto; box-sizing: border-box;"> Design</div>
        </scrumboard-board-edit-list-name><div fxflex="0 1 auto" style="flex: 0 1 auto; box-sizing: border-box;"><button aria-haspopup="true" class="list-header-option-button mat-icon-button" mat-icon-button=""><span class="mat-button-wrapper"><mat-icon class="mat-icon material-icons" role="img" aria-hidden="true">more_vert</mat-icon></span><div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div><div class="mat-button-focus-overlay"></div></button><mat-menu class="ng-tns-c35-40"><!----></mat-menu></div></div><div class="list-content" fxlayout="column" style="flex-direction: column; box-sizing: border-box; display: flex;"><div class="list-cards ngx-dnd-container ps ps--active-y" fuseperfectscrollbar="" ngxdroppable="card"><scrumboard-board-card class="scrumboard-board-card ngx-dnd-item ng-star-inserted" ngxdraggable="" style=""><!----><div class="list-card-cover ng-star-inserted"><img src="assets/images/scrumboard/mail.jpg"></div><div class="list-card-details"><div class="list-card-sort-handle"><mat-icon class="icon s16 mat-icon material-icons" mat-font-icon="icon-cursor-move" role="img" aria-hidden="true"></mat-icon></div><!----><div class="list-card-labels ng-star-inserted" fxlayout="row wrap" style="flex-flow: row wrap; box-sizing: border-box; display: flex;"><!----><span class="list-card-label orange-400 ng-star-inserted" aria-describedby="cdk-describedby-message-32" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span><!----><span class="list-card-label blue-600 ng-star-inserted" aria-describedby="cdk-describedby-message-33" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span><!----></div><div class="list-card-name">Change background colors</div><!----><div class="list-card-badges ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><!----><span class="badge due-date overdue ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-16 mat-icon material-icons" role="img" aria-hidden="true">access_time</mat-icon><span>Aug 29, 2017</span></span><!----><span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-16 mat-icon material-icons" role="img" aria-hidden="true">check_circle</mat-icon><span>2</span><span>/</span><span>7</span></span></div><!----><div class="list-card-members ng-star-inserted" fxlayout="row" style="flex-direction: row; box-sizing: border-box; display: flex;"><!----><div class="list-card-member ng-star-inserted"><img class="list-card-member-avatar" aria-describedby="cdk-describedby-message-34" cdk-describedby-host="" src="assets/images/avatars/james.jpg" style="touch-action: none; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div></div></div><div class="list-card-footer" fxlayout="row" fxlayoutalign="space-between center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center space-between; align-items: center;"><div fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><!----><span class="list-card-footer-item ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-18 mat-icon material-icons" role="img" aria-hidden="true">remove_red_eye</mat-icon></span><!----></div><div fxlayout="row" fxlayoutalign="end center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-end; align-items: center;"><!----><span class="list-card-footer-item ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-18 mat-icon material-icons" role="img" aria-hidden="true">attachment</mat-icon><span class="value">2</span></span><!----><span class="list-card-footer-item ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-18 mat-icon material-icons" role="img" aria-hidden="true">comment</mat-icon><span class="value">2</span></span></div></div></scrumboard-board-card><scrumboard-board-card class="scrumboard-board-card ngx-dnd-item ng-star-inserted" ngxdraggable="" style=""><!----><div class="list-card-details"><div class="list-card-sort-handle"><mat-icon class="icon s16 mat-icon material-icons" mat-font-icon="icon-cursor-move" role="img" aria-hidden="true"></mat-icon></div><!----><div class="list-card-labels ng-star-inserted" fxlayout="row wrap" style="flex-flow: row wrap; box-sizing: border-box; display: flex;"><!----><span class="list-card-label orange-400 ng-star-inserted" aria-describedby="cdk-describedby-message-32" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span><!----><span class="list-card-label red-500 ng-star-inserted" aria-describedby="cdk-describedby-message-35" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span><!----></div><div class="list-card-name">Mail app new layout</div><!----><!----><div class="list-card-members ng-star-inserted" fxlayout="row" style="flex-direction: row; box-sizing: border-box; display: flex;"><!----><div class="list-card-member ng-star-inserted"><img class="list-card-member-avatar" aria-describedby="cdk-describedby-message-6" cdk-describedby-host="" src="assets/images/avatars/alice.jpg" style="touch-action: none; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div><div class="list-card-member ng-star-inserted"><img class="list-card-member-avatar" aria-describedby="cdk-describedby-message-36" cdk-describedby-host="" src="assets/images/avatars/danielle.jpg" style="touch-action: none; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div><div class="list-card-member ng-star-inserted"><img class="list-card-member-avatar" aria-describedby="cdk-describedby-message-34" cdk-describedby-host="" src="assets/images/avatars/james.jpg" style="touch-action: none; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div><div class="list-card-member ng-star-inserted"><img class="list-card-member-avatar" aria-describedby="cdk-describedby-message-37" cdk-describedby-host="" src="assets/images/avatars/vincent.jpg" style="touch-action: none; user-select: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></div></div></div><div class="list-card-footer" fxlayout="row" fxlayoutalign="space-between center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center space-between; align-items: center;"><div fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><!----><!----><span class="list-card-footer-item ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-18 mat-icon material-icons" role="img" aria-hidden="true">description</mat-icon></span></div><div fxlayout="row" fxlayoutalign="end center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-end; align-items: center;"><!----><span class="list-card-footer-item ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-18 mat-icon material-icons" role="img" aria-hidden="true">attachment</mat-icon><span class="value">0</span></span><!----><span class="list-card-footer-item ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-18 mat-icon material-icons" role="img" aria-hidden="true">comment</mat-icon><span class="value">0</span></span></div></div></scrumboard-board-card><div class="ps__rail-x" style="left: 0px; top: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; left: 0px; height: 248px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 98px;"></div></div></div></div><div class="list-footer"><scrumboard-board-add-card><!----><div class="add-card-button ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-20 mat-icon material-icons" role="img" aria-hidden="true">add</mat-icon><div>Add a card</div></div></scrumboard-board-add-card></div></div></scrumboard-board-list>

<scrumboard-board-add-list class="new-list-wrapper ng-trigger ng-trigger-animate" ngxdraggable=""><div class="list new-list mat-elevation-z1"><!----><button class="new-list-form-button mat-button ng-star-inserted" mat-button="" style=""><span class="mat-button-wrapper"><div fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="red mat-icon material-icons" role="img" aria-hidden="true">add</mat-icon><span>Add a list</span></div></span><div class="mat-button-ripple mat-ripple" matripple=""></div><div class="mat-button-focus-overlay"></div></button><!----></div></scrumboard-board-add-list></div></div></div></mat-sidenav-content></mat-sidenav-container></scrumboard-board>
</content>



</div>
<div class="modal fade" id="view-list-tasks" tabindex="-1" role="dialog" aria-labelledby="view-list-tasks" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter une liste de tâches</h4>
      </div>
        <form id="form-list-tasks" method="post" action="<?php echo site_url('/all-projects/create-list-tasks/'.$id_project_tasks); ?>">
          <div class="modal-body">
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                <div class="col-lg-12">
                  <input class="form-control" type="text" name="titlelisttasks" placeholder="Titre Liste Tasks" required />
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
<div class="modal fade" id="view-task" tabindex="-1" role="dialog" aria-labelledby="view-task" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter une tâche</h4>
      </div>
        <form id="form-task" method="post" action="<?php echo site_url('/all-projects/create-task/'.$id_project_tasks); ?>">
          <div class="modal-body">
            <div class="form-group">
                <input type="hidden" class="form-control" id="idlisttasks" name="idlisttasks">
            </div>
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                <div class="col-lg-12">
                  <input class="titlelisttasks form-control" type="text" name="titletask" placeholder="Titre Task" required />
                </div>
            </div>
            <div class="form-group">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('websites'); ?></label>
                <div class="col-lg-12">
                  <textarea class="titlelisttasks form-control" type="text" name="descriptiontask" placeholder="Description Task" required></textarea>
                </div>
            </div>
            <div class="form-group ">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('languages'); ?></label>
                <div class="col-lg-6">
                  <select name="tasksstatus" class="form-control">
                  <?php foreach ($all_tasks_status->result() as $row){  ?>
                      <option value="<?php echo $row->id_tasks_status; ?>"><?php echo $row->name_tasks_status; ?></option>
                  <?php } ?>
                  </select>
                </div>
            </div>
            <div class="form-group ">
                <label for="curl" class="control-label col-lg-3"><?php echo lang('languages'); ?></label>
                <div class="col-lg-6">
                  <select name="taskspriority" class="form-control">
                  <?php foreach ($all_tasks_priority->result() as $row){  ?>
                      <option value="<?php echo $row->id_tasks_priority; ?>"><?php echo $row->name_tasks_priority; ?></option>
                  <?php } ?>
                  </select>
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



<div class="modal fade" id="view-card-tasks" tabindex="-1" role="dialog" aria-labelledby="view-card-tasks" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header modal-header-success">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Ajouter une tâche</h4>
      </div>
          <div class="modal-body">
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
                      <input class="titletasks form-control" type="text" name="titletask" placeholder="Titre Task" required/>
                    </div>
                    <div class="form-group col-md-5">
                        <a href="javascript:void(0);" class="add-user"><i class="icon icon-plus-circle"></i></a>
                        <input id="autocomplete-user" class="form-control" type="text" name="titletask" placeholder="User" required />
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
/*$(document).ready(function(){
    function restoreRow(pTable, nRow) {
        var aData = pTable.row(nRow).data();
        var jqTds = $('>td', nRow);

        for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
            pTable.cell(nRow, i).data(aData[i]).draw();
        }
    }
    var nEditingViewProject = null;
    var ElementDelete = null;
    var viewprojectTable = $('#table-view-my-project').DataTable({
        "columnDefs": [{
            "visible": false,
            "targets": 0
        }],
        "order": [
            [0, 'asc']
        ],
        "displayLength": 25,
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;
            api.column(0, {
                page: 'current'
            }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                    last = group;
                }
            });
        }
    });
  });*/
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
        $('#view-task').on('show.bs.modal', function (event) {
            var idlisttasks = $(event.relatedTarget).data('id');

            $(this).find('.modal-body input#idlisttasks').val(idlisttasks);
        });

        function editRowProject(viewprojectTable, nRow, nUrl) {
          var aData = viewprojectTable.fnGetData(nRow);
          var jqTds = $('>td', nRow);
          var languageList;
          jqTds[1].innerHTML = '<input type="text" class="form-control small" id="nameviewproject" value="' + aData[1] + '">';
          jqTds[2].innerHTML = '<input type="text" class="form-control small" id="descriptionviewproject" value="' + aData[2] + '">';
          jqTds[3].innerHTML = '<input type="text" class="form-control small" id="priorityviewproject" value="' + aData[3] + '">';
          jqTds[7].innerHTML = '<a id="edit-dashboard" href="'+nUrl+'" class="btn btn-white"><i class="icon-check" value="check"></i></a><a id="cancel-dashboard" href="" class="btn btn-white"><i class="icon-close"></i></a>';
        }
        function saveRowLanguage(viewprojectTable, nRow, nUrl) {
          var jqInputs = $('input', nRow);
          viewprojectTable.fnUpdate(jqInputs[7].value, nRow, 7, false);
          viewprojectTable.fnUpdate('<a id="edit-dashboard" href="'+nUrl+'">Edit</a>', nRow, 1, false);
          viewprojectTable.fnUpdate('<a id="delete-dashboard" href="javascript:void(0);">Delete</a>', nRow, 2, false);
          viewprojectTable.fnDraw();
        }
        $(document).on('click', '#table-view-my-project #cancel-project', function (e) {
            e.preventDefault();
            if ($(this).attr("data-mode") == "new") {
                var nRow = $(this).parents('tr')[0];
                viewprojectTable.fnDeleteRow(nRow);
            } else {
                restoreRow(viewprojectTable, nEditingViewProject);
                nEditingViewProject = null;
            }
        });
        $(document).on('click', '#table-view-my-project #edit-project', function (e) {
            e.preventDefault();

            var nRow = $(this).parents('tr')[0];
            var nUrl = $(this).attr('href');
            
            if (nEditingViewProject !== null && nEditingViewProject != nRow) {
                restoreRow(viewprojectTable, nEditingViewProject);
                editRowProject(viewprojectTable, nRow, nUrl);
                nEditingViewProject = nRow;
            } else if (nEditingViewProject == nRow && this.innerHTML == "Save") {
                var titlelanguage = $('#titlelanguage').val();
                $.ajax({
                    type: "POST",
                    url: $(this).attr('href'),
                    data: 'titlelanguage='+titlelanguage,
                    success: function(msg){
                        console.log(msg);
                        saveRowLanguage(viewprojectTable, nEditingViewProject, nUrl);
                        nEditingViewProject = null;
                    },
                    error: function(msg){
                        console.log(msg);
                    }
                });
            } else {
                editRowProject(viewprojectTable, nRow, nUrl);
                nEditingViewProject = nRow;
            }
        });

</script>
<?php $this->load->view('include/footer.php'); ?>
