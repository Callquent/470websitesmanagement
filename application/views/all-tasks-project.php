<?php $this->load->view('include/header.php'); ?>

<section id="container" >
<?php $this->load->view('include/navbar.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
<section id="main-content">
<section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-sm-12">
                <a class="btn btn-default btn-primary mb-3" href="<?php echo site_url('/all-projects/'); ?>"><i class="fa fa-angle-double-left"></i> Retour</a>
                <a class="access-list-tasks btn btn-sm btn-success mb-3" href="javascript:void(0);" data-toggle="modal" data-target="#view-list-tasks"><span><i class="fa fa-plus"></i></span> Ajouter une Liste</a>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="row-fluid" id="draggable_portlets">
                    <div class="col-md-3 column sortable ui-sortable">
                        <!-- BEGIN Portlet PORTLET-->

                                <div class="card card-danger">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                A faire
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="elements">
                                                    <form class="header-form" action="#">
                                                        <div class="form-group has-feedback has-feedback-left">
                                                            <input type="search" class="form-control" placeholder="Enter keyword here...">
                                                            <div class="form-control-feedback">
                                                                <i class="icon-search4 text-size-base text-muted"></i>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">

                                  
                                    

                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                            <?php foreach ($all_list_tasks->result() as $row) { ?>
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                  <h5 class="mb-0">
                                                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $row->id_list_task; ?>" aria-expanded="false" aria-controls="collapse<?php echo $row->id_list_task; ?>">
                                                       <?php echo $row->title_list_task; ?>
                                                    </a>
                                                  </h5>
                                                </div>

                                                <div id="collapse<?php echo $row->id_list_task; ?>" class="collapse" role="tabpanel" aria-labelledby="headingOne">
                                                  <div class="card-block">
                                        <ul class="to-do-list" id="sortable-todo">
                                            <li class="clearfix">
                                                <span class="drag-marker">
                                                <i></i>
                                                </span>
                                                <div class="todo-check pull-left">
                                                    <input type="checkbox" value="None" id="todo-check"/>
                                                    <label for="todo-check"></label>
                                                </div>
                                                <p class="todo-title">
                                                    sdhfhsd gsdf shjbfhsdb fhdbhjsdb h
                                                </p>
                                                <div class="todo-actionlist pull-right clearfix">
                                                    <a href="#" class="todo-done"><i class="fa fa-check"></i></a>
                                                    <a href="#" class="todo-edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <span class="drag-marker">
                                                <i></i>
                                                </span>
                                                <div class="todo-check pull-left">
                                                    <input type="checkbox" value="None" id="todo-check1"/>
                                                    <label for="todo-check1"></label>
                                                </div>
                                                <p class="todo-title">
                                                    Donec quam libero, rutrum non gravida
                                                </p>
                                                <div class="todo-actionlist pull-right clearfix">
                                                    <a href="#" class="todo-done"><i class="fa fa-check"></i></a>
                                                    <a href="#" class="todo-edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="#" class="todo-remove"><i class="fa fa-times"></i></a>
                                                </div>
                                            </li>
                                        </ul>
                                                  </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>


                                        <div class="todo-action-bar">
                                            <div class="row">
                                                <div class="col-xs-4 btn-todo-select">
                                                    <button type="submit" class="btn btn-default"><i class="fa fa-check"></i> Select All</button>
                                                </div>
                                                <div class="col-xs-4 todo-search-wrap">
                                                    <input type="text" class="form-control search todo-search pull-right" placeholder=" Search">
                                                </div>
                                                <div class="col-xs-4 btn-add-task">
                                                    <button type="submit" class="btn btn-default btn-primary"><i class="fa fa-plus"></i> Add Task</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                    </div>
                    <div class="col-md-3 column sortable ui-sortable">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-success">
                                    <div class="card-header">
                                        Tache réaliser
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="fa fa-cog" href="javascript:;"></a>
                                    <a class="fa fa-times" href="javascript:;"></a>
                                </span>
                                    </div>
                                    <div class="card-body">
                                        Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                                        Cras mattis consectetur purus sit amet fermentum. Duis mollis.
                                        Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                                        Cras mattis consectetur purus sit amet fermentum. Duis mollis. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                                        Cras mattis consectetur purus sit amet fermentum. Duis mollis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 column sortable ui-sortable">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card card-default">
                                    <div class="card-header">
                                        Portlet 7
                                <span class="tools pull-right">
                                    <a class="fa fa-chevron-down" href="javascript:;"></a>
                                    <a class="fa fa-cog" href="javascript:;"></a>
                                    <a class="fa fa-times" href="javascript:;"></a>
                                </span>
                                    </div>
                                    <div class="card-body">
                                        Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                                        Cras mattis consectetur purus sit amet fermentum. Duis mollis.
                                        Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                                        Cras mattis consectetur purus sit amet fermentum. Duis mollis. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
                                        Cras mattis consectetur purus sit amet fermentum. Duis mollis.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
</section>

<div class="modal fade" id="view-list-tasks" tabindex="-1" role="dialog" aria-labelledby="view-project" aria-hidden="true">
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
<?php $this->load->view('include/footer.php'); ?>