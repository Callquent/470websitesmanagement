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
                                    <h2><?php echo $row_list_tasks->name_card_tasks; ?></h2>
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
                                        <h2><?php echo $row_list_tasks->name_card_tasks; ?></h2>
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
                                        <h2><?php echo $row_list_tasks->name_card_tasks; ?></h2>
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
    <scrumboard-board>
        <mat-sidenav-container class="mat-drawer-container mat-sidenav-container">
            <mat-sidenav-content>
                <div id="board" class="ng-tns-c39-37" style="flex-direction: row; box-sizing: border-box; display: flex;">
                    <div fxflex="" style="flex: 1 1 0%; box-sizing: border-box;" class="board-content-wrapper p-16 p-md-24">
                        <div fxlayout="row" ngxdroppable="list" style="flex-direction: row; box-sizing: border-box; display: flex;" class="board-content ngx-dnd-container p-16 p-md-24 ng-trigger ng-trigger-animateStagger">
                            <scrumboard-board-list class="scrumboard-board-list list-wrapper ngx-dnd-item ng-tns-c39-37 ng-trigger ng-trigger-animate ng-star-inserted" ngxdraggable="" style="">
                                <div class="list mat-elevation-z1" fxlayout="column" style="flex-direction: column; box-sizing: border-box; display: flex;">
                                    <div class="list-header" fxflex="" fxlayout="row" fxlayoutalign="space-between center" style="flex-direction: row; box-sizing: border-box; display: flex; place-content: center space-between; align-items: center; flex: 1 1 1e-09px;">
                                        <scrumboard-board-edit-list-name fxflex="1 0 auto" style="flex: 1 0 auto; box-sizing: border-box; flex-direction: row; display: flex;">
                                            <div class="list-header-name ng-star-inserted" fxflex="1 0 auto" style="flex: 1 0 auto; box-sizing: border-box;"> TO-DO</div>
                                        </scrumboard-board-edit-list-name>
                                        <div fxflex="0 1 auto" style="flex: 0 1 auto; box-sizing: border-box;">
                                            <button aria-haspopup="true" class="list-header-option-button mat-icon-button" mat-icon-button=""><span class="mat-button-wrapper"><mat-icon class="mat-icon material-icons" role="img" aria-hidden="true">more_vert</mat-icon></span><div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                            <mat-menu class="ng-tns-c35-40"></mat-menu>
                                        </div>
                                    </div>
                                    <div class="list-content" fxlayout="column" style="flex-direction: column; box-sizing: border-box; display: flex;">
                                        <div class="list-cards ngx-dnd-container custom-scrollbar ps ps--active-y" fuseperfectscrollbar="" ngxdroppable="card">
                                            <scrumboard-board-card @click="f_dialog_editCard(card_tasks_to_do)" v-for="card_tasks_to_do in list_card_tasks_to_do" class="scrumboard-board-card ngx-dnd-item ng-star-inserted" ngxdraggable="" style="">
                                                <div class="list-card-details">
                                                    <div class="list-card-sort-handle">
                                                        <mat-icon class="icon s16 mat-icon material-icons" mat-font-icon="icon-cursor-move" role="img" aria-hidden="true"></mat-icon>
                                                    </div>
                                                    <div class="list-card-labels ng-star-inserted" fxlayout="row wrap" style="flex-flow: row wrap; box-sizing: border-box; display: flex;">
                                                        <span class="list-card-label orange-400 ng-star-inserted" aria-describedby="cdk-describedby-message-32" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span>
                                                        <span class="list-card-label blue-600 ng-star-inserted" aria-describedby="cdk-describedby-message-33" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span>
                                                    </div>
                                                    <div class="list-card-name">{{ card_tasks_to_do.name_card_tasks }}</div>
                                                    <div class="list-card-badges ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                                        <span class="badge due-date overdue ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><span>{{card_tasks_to_do.name_tasks_priority}}</span></span><span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-16 mat-icon material-icons" role="img" aria-hidden="true">check_circle</mat-icon><span>{{card_tasks_to_do.count_tasks_check_per_card}}</span><span>/</span><span>{{card_tasks_to_do.count_tasks_per_card}}</span></span>
                                                    </div>
                                                </div>
                                            </scrumboard-board-card>
                                        </div>
                                    </div>
                                    <div class="list-footer">
                                        <scrumboard-board-add-card>
                                            <div @click="display_card = false" class="add-card-button ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;" v-if="display_card">
                                                <mat-icon class="s-20 mat-icon material-icons" role="img" aria-hidden="true">add</mat-icon>
                                                <div>Add a card</div>
                                            </div>
                                            <div class="add-card-form-wrapper ng-star-inserted" v-else>
                                                <form class="add-card-form ng-pristine ng-invalid ng-touched" style="flex-direction: column; box-sizing: border-box; display: flex;">
                                                    <v-text-field label="Name Card Task" v-model="newCard.name_card_tasks" required :rules="[() => newCard.name_card_tasks.length > 0 || 'Required field']"></v-text-field>
                                                    <v-select v-model="newCard.id_priority" slot="input" label="Choose Priority" single-line autofocus :items="list_tasks_priority" item-text="name_tasks_priority" item-value="id_tasks_priority"></v-select>
                                                    <div class="pl-8" fxlayout="row" fxlayoutalign="space-between center" style="flex-direction: row; box-sizing: border-box; display: flex; place-content: center space-between; align-items: center;">
                                                        <v-btn @click="f_createCard">Add</v-btn>
                                                        <button class="cancel-button mat-icon-button" @click="display_card = true"><span class="mat-button-wrapper"><i class="icon-close"></i></span></button>
                                                    </div>
                                                </form>
                                            </div>
                                        </scrumboard-board-add-card>
                                    </div>
                                </div>
                            </scrumboard-board-list>

                            <scrumboard-board-list class="scrumboard-board-list list-wrapper ngx-dnd-item ng-tns-c39-37 ng-trigger ng-trigger-animate ng-star-inserted" ngxdraggable="" style="">
                                <div class="list mat-elevation-z1" fxlayout="column" style="flex-direction: column; box-sizing: border-box; display: flex;">
                                    <div class="list-header" fxflex="" fxlayout="row" fxlayoutalign="space-between center" style="flex-direction: row; box-sizing: border-box; display: flex; place-content: center space-between; align-items: center; flex: 1 1 1e-09px;">
                                        <scrumboard-board-edit-list-name fxflex="1 0 auto" style="flex: 1 0 auto; box-sizing: border-box; flex-direction: row; display: flex;">
                                            <div class="list-header-name ng-star-inserted" fxflex="1 0 auto" style="flex: 1 0 auto; box-sizing: border-box;"> IN PROGRESS</div>
                                        </scrumboard-board-edit-list-name>
                                        <div fxflex="0 1 auto" style="flex: 0 1 auto; box-sizing: border-box;">
                                            <button aria-haspopup="true" class="list-header-option-button mat-icon-button" mat-icon-button=""><span class="mat-button-wrapper"><mat-icon class="mat-icon material-icons" role="img" aria-hidden="true">more_vert</mat-icon></span><div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                            <mat-menu class="ng-tns-c35-40"></mat-menu>
                                        </div>
                                    </div>
                                    <div class="list-content" fxlayout="column" style="flex-direction: column; box-sizing: border-box; display: flex;">
                                        <div class="list-cards ngx-dnd-container custom-scrollbar ps ps--active-y" fuseperfectscrollbar="" ngxdroppable="card">
                                            <scrumboard-board-card @click="f_dialog_editCard(card_tasks_in_progress)" v-for="card_tasks_in_progress in list_card_tasks_in_progress" class="scrumboard-board-card ngx-dnd-item ng-star-inserted" ngxdraggable="" style="">
                                                <div class="list-card-details">
                                                    <div class="list-card-sort-handle">
                                                        <mat-icon class="icon s16 mat-icon material-icons" mat-font-icon="icon-cursor-move" role="img" aria-hidden="true"></mat-icon>
                                                    </div>
                                                    <div class="list-card-labels ng-star-inserted" fxlayout="row wrap" style="flex-flow: row wrap; box-sizing: border-box; display: flex;">
                                                        <span class="list-card-label orange-400 ng-star-inserted" aria-describedby="cdk-describedby-message-32" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span>
                                                        <span class="list-card-label blue-600 ng-star-inserted" aria-describedby="cdk-describedby-message-33" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span>
                                                    </div>
                                                    <div class="list-card-name">{{ card_tasks_in_progress.name_card_tasks }}</div>
                                                    <div class="list-card-badges ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                                        <span class="badge due-date overdue ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><span>{{card_tasks_in_progress.name_tasks_priority}}</span></span><span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-16 mat-icon material-icons" role="img" aria-hidden="true">check_circle</mat-icon><span>{{card_tasks_in_progress.count_tasks_check_per_card}}</span><span>/</span><span>{{card_tasks_in_progress.count_tasks_per_card}}</span></span>
                                                    </div>
                                                </div>
                                            </scrumboard-board-card>
                                        </div>
                                    </div>
                                    <div class="list-footer">
                                        <scrumboard-board-add-card>
                                            <div class="add-card-button ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                                <mat-icon class="s-20 mat-icon material-icons" role="img" aria-hidden="true">add</mat-icon>
                                                <div>Add a card</div>
                                            </div>
                                        </scrumboard-board-add-card>
                                    </div>
                                </div>
                            </scrumboard-board-list>

                            <scrumboard-board-list class="scrumboard-board-list list-wrapper ngx-dnd-item ng-tns-c39-37 ng-trigger ng-trigger-animate ng-star-inserted" ngxdraggable="" style="">
                                <div class="list mat-elevation-z1" fxlayout="column" style="flex-direction: column; box-sizing: border-box; display: flex;">
                                    <div class="list-header" fxflex="" fxlayout="row" fxlayoutalign="space-between center" style="flex-direction: row; box-sizing: border-box; display: flex; place-content: center space-between; align-items: center; flex: 1 1 1e-09px;">
                                        <scrumboard-board-edit-list-name fxflex="1 0 auto" style="flex: 1 0 auto; box-sizing: border-box; flex-direction: row; display: flex;">
                                            <div class="list-header-name ng-star-inserted" fxflex="1 0 auto" style="flex: 1 0 auto; box-sizing: border-box;"> COMPLETED</div>
                                        </scrumboard-board-edit-list-name>
                                        <div fxflex="0 1 auto" style="flex: 0 1 auto; box-sizing: border-box;">
                                            <button aria-haspopup="true" class="list-header-option-button mat-icon-button" mat-icon-button=""><span class="mat-button-wrapper"><mat-icon class="mat-icon material-icons" role="img" aria-hidden="true">more_vert</mat-icon></span><div class="mat-button-ripple mat-ripple mat-button-ripple-round" matripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                            <mat-menu class="ng-tns-c35-40"></mat-menu>
                                        </div>
                                    </div>
                                    <div class="list-content" fxlayout="column" style="flex-direction: column; box-sizing: border-box; display: flex;">
                                        <div class="list-cards ngx-dnd-container custom-scrollbar ps ps--active-y" fuseperfectscrollbar="" ngxdroppable="card">
                                            <scrumboard-board-card @click="f_dialog_editCard(card_tasks_completed)" v-for="card_tasks_completed in list_card_tasks_completed" class="scrumboard-board-card ngx-dnd-item ng-star-inserted" ngxdraggable="" style="">
                                                <div class="list-card-details">
                                                    <div class="list-card-sort-handle">
                                                        <mat-icon class="icon s16 mat-icon material-icons" mat-font-icon="icon-cursor-move" role="img" aria-hidden="true"></mat-icon>
                                                    </div>
                                                    <div class="list-card-labels ng-star-inserted" fxlayout="row wrap" style="flex-flow: row wrap; box-sizing: border-box; display: flex;">
                                                        <span class="list-card-label orange-400 ng-star-inserted" aria-describedby="cdk-describedby-message-32" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span>
                                                        <span class="list-card-label blue-600 ng-star-inserted" aria-describedby="cdk-describedby-message-33" cdk-describedby-host="" style="touch-action: none; user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></span>
                                                    </div>
                                                    <div class="list-card-name">{{ card_tasks_completed.name_card_tasks }}</div>
                                                    <div class="list-card-badges ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                                        <span class="badge due-date overdue ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><span>{{card_tasks_completed.name_tasks_priority}}</span></span><span class="badge check-items ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="s-16 mat-icon material-icons" role="img" aria-hidden="true">check_circle</mat-icon><span>{{card_tasks_completed.count_tasks_check_per_card}}</span><span>/</span><span>{{card_tasks_completed.count_tasks_per_card}}</span></span>
                                                    </div>
                                                </div>
                                            </scrumboard-board-card>
                                        </div>
                                    </div>
                                    <div class="list-footer">
                                        <scrumboard-board-add-card>
                                            <div class="add-card-button ng-star-inserted" fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;">
                                                <mat-icon class="s-20 mat-icon material-icons" role="img" aria-hidden="true">add</mat-icon>
                                                <div>Add a card</div>
                                            </div>
                                        </scrumboard-board-add-card>
                                    </div>
                                </div>
                            </scrumboard-board-list>

                            <scrumboard-board-add-list class="new-list-wrapper ng-trigger ng-trigger-animate" ngxdraggable="">
                                <div class="list new-list mat-elevation-z1">
                                    <button class="new-list-form-button mat-button ng-star-inserted" mat-button="" style=""><span class="mat-button-wrapper"><div fxlayout="row" fxlayoutalign="start center" style="flex-direction: row; box-sizing: border-box; display: flex; max-height: 100%; place-content: center flex-start; align-items: center;"><mat-icon class="red mat-icon material-icons" role="img" aria-hidden="true">add</mat-icon><span>Add a list</span></div></span><div class="mat-button-ripple mat-ripple" matripple=""></div><div class="mat-button-focus-overlay"></div></button>
                                </div>
                            </scrumboard-board-add-list>
                        </div>
                    </div>
                </div>
            </mat-sidenav-content>
        </mat-sidenav-container>
    </scrumboard-board>
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

<v-dialog
      v-model="dialog_card"
      width="720"
    >
    <v-card>
        <v-card-title class="headline green lighten-2" primary-title>
          Card
        </v-card-title>

        <v-card-text>
            <v-container grid-list-md>
                <v-layout wrap>
                    <v-flex xs12>
                        <v-text-field label="Titre Card Task" v-model="card_tasks.name_card_tasks" required></v-text-field>
                    </v-flex>
                    <v-flex xs12>
                        <v-textarea v-model="card_tasks.description_card_tasks">
                            <div slot="label">Decription Card Task <small>(optional)</small></div>
                        </v-textarea>
                    </v-flex>
                    <v-flex xs6>
                        Priority
                    </v-flex>
                    <v-flex xs6>
                        User
                    </v-flex>
                    <v-flex xs12>
                        <div>{{card_tasks.count_tasks_check_per_card}} / {{card_tasks.count_tasks_per_card}} <v-progress-linear v-model="valueDeterminate"></v-progress-linear></div>
                        <v-card>
                            <template>
                                <v-data-table
                                    :headers="headers"
                                    :items="card_tasks.tasks"
                                    item-key="name_task"
                                    select-all
                                    class="elevation-1"
                                >
                                    <template slot="items" slot-scope="props">
                                        <td><v-checkbox @change="f_checkTask(props.item)" v-model="props.item.check_tasks == 1" primary hide-details></v-checkbox></td>
                                        <td>{{ props.item.name_task }}</td>
                                        <td>{{ props.item.username }}</td>
                                        <td>
                                            <a class="dropdown-item" id="edit-task" @click="editTask()"><i class="icon icon-pencil"></i><?php echo lang('edit') ?></a>
                                        </td>
                                    </template>
                                </v-data-table>
                            </template>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
            <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="f_createCard()">Save</v-btn>
            <v-btn color="blue darken-1" flat @click="dialog_card = false">Close</v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>

<v-dialog v-model="dialog_add_task" persistent width="500">
    <v-card>
        <v-card-title class="headline green lighten-2" primary-title>
            Ajouter une tâche
        </v-card-title>

        <v-card-text>
            <v-container grid-list-md>
                <v-layout wrap>
                    <v-flex xs12>
                        <v-text-field label="Titre Task"  v-model="newTask.nametask" required :rules="[() => !!newTask.nametask || 'Name is required']"></v-text-field>
                    </v-flex>
                </v-layout>
            </v-container>
            <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
            <v-btn color="blue darken-1" flat @click="f_createTask()">Save</v-btn>
            <v-btn color="blue darken-1" flat @click="dialog_add_task = false">Close</v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>
            </div>
        </div>
    </v-app>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
    var v = new Vue({
        el: '#app',
        data : {
            dialog_add_task: false,
            dialog_card: false,
            list_card_tasks_to_do: <?php echo json_encode($all_card_tasks_to_do->result_array()); ?>,
            list_card_tasks_in_progress: <?php echo json_encode($all_card_tasks_in_progress->result_array()); ?>,
            list_card_tasks_completed: <?php echo json_encode($all_card_tasks_completed->result_array()); ?>,
            list_tasks_priority: <?php echo json_encode($all_tasks_priority->result_array()); ?>,
            currentRoute: window.location.href.substr(0, window.location.href.lastIndexOf('/')),
            id_project: window.location.href.split('/').pop(),
            id_card: "",
            user_profil: <?php echo json_encode($user_role[0]); ?>,
            headers: [
                { text: 'Name Task', value: 'name_task', sortable: false},
                { text: 'User', value: 'username' },
                { text: 'Actions', value: 'name', sortable: false }
            ],
            card_tasks:[],
            newCard:{
                name_card_tasks:"",
                id_card_task: <?php echo $all_card_tasks->num_rows()+1; ?>,
                id_priority:"",
            },
            newTask:{
                nametask:'',
            },
            display_card:true,
            valueDeterminate: 0,
        },
        mixins: [mixin],
        created(){
            this.displayPage();
        },
        methods:{
            displayPage(){
                this.card_tasks.tasks = (this.card_tasks.tasks == null ? [] : this.card_tasks.tasks);
                this.valueDeterminate = this.f_isNaN((this.card_tasks.count_tasks_completed/this.card_tasks.tasks.length)*100);
            },
            f_dialog_editCard(card_tasks){
                var formData = new FormData(); 
                formData.append("id_project_tasks",card_tasks.id_project_tasks);
                formData.append("id_card_tasks",card_tasks.id_card_tasks);
                axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
                    if(response.status = 200){
                        v.card_tasks = response.data.card_tasks;
                    }else{

                    }
                })
                v.dialog_card = true;
            },
            f_checkTask(item){
                var formData = new FormData();
                formData.append("id_project_tasks",item.id_project_tasks);
                formData.append("id_card_tasks",item.id_card_tasks);
                formData.append("id_task",item.id_task);
                formData.append("check_tasks",(item.check_tasks^=1));
                axios.post(this.currentRoute+"/check-tasks/", formData).then(function(response){
                    if(response.status = 200){
                        v.editCard = response.data.card_tasks;
                        v.valueDeterminate = v.f_isNaN((v.editCard.count_tasks_completed)/v.card_tasks.tasks.length*100)
                        Object.assign(v.card_tasks, v.editCard);
                        //change status
                        var index = v.list_card_tasks.findIndex(i => i.id_card_tasks === item.id_card_tasks)
                        v.list_card_tasks[index].name_tasks_status = response.data.card_tasks.name_tasks_status;
                    }else{

                    }
                })
            },
            f_createCard(){
                var formData = new FormData();
                formData.append("name_card_tasks",v.newCard.name_card_tasks);
                formData.append("id_project_tasks",v.id_project);
                formData.append("id_card_task",v.newCard.id_card_task);
                formData.append("id_tasks_priority",v.newCard.id_priority);
                axios.post(this.currentRoute+"/create-card-tasks/", formData).then(function(response){
                    if(response.status = 200){
                        response.data.card_tasks.count_tasks_per_card++;
                        v.list_card_tasks_to_do.push(response.data.card_tasks);
                        v.id_card = v.newCard.id_card_task;
                        v.dialog_add_task = true;
                        v.display_card = true;
                    }else{

                    }
                })
            },
            f_editCard(card_tasks){
                var formData = new FormData(); 
                formData.append("id_project_tasks",card_tasks.id_project_tasks);
                formData.append("id_card_tasks",card_tasks.id_card_tasks);
                axios.post(this.currentRoute+"/view-card-tasks/", formData).then(function(response){
                    if(response.status = 200){
                        v.card_tasks = response.data.card_tasks;
                    }else{

                    }
                })
                v.dialog_card = true;
            },
            f_createTask(){
                var formData = new FormData();
                formData.append("nametask",v.newTask.nametask);
                formData.append("id_user",v.user_profil.user_id);
                formData.append("id_project_tasks",v.id_project);
                formData.append("id_card_tasks",v.id_card);
                axios.post(this.currentRoute+"/create-task/", formData).then(function(response){
                    if(response.status = 200){
                        v.dialog_add_task = false;
                    }else{

                    }
                })
            },
            f_isNaN(val) {
                if (isNaN(val)) {
                    return 0;
                } else {
                    return val;
                }
            }
        }
    });

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
        /*$("#form-list-tasks").submit(function(e){
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
        });*/

</script>
<?php $this->load->view('include/footer.php'); ?>
