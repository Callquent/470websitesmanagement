<?php $this->load->view('include/header.php'); ?>

<section id="container" >
<?php $this->load->view('include/navbar.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
    <section id="main-content">
        <section class="wrapper">
        <!-- BEGIN MAIN CONTENT -->
            <div class="row">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <div class="card mb-3">
                        <header class="card-header">
                            Editable Table
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                        </header>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" id="member-finder" class="form-control" placeholder="Search a member...">
                                </div>
                            </div>
                            <div class="row">




                            <?php foreach($list_users->result() as $row){ ?>
                                <div class="col-md-4 member-entry member-entry-<?php echo $row->id; ?>">
                                    <section class="card mb-3">

                                        <div class="list-item" data-id="item-3">
                                            <span class="w-40 avatar circle green"><i class="away b-white avatar-right"></i> <?php echo substr($row->name_user, 0, 2); ?></span>
                                            <div class="list-body">
                                                <a href="app.user.detail.html#item-3" class="item-title _500"><?php echo $row->name_user; ?></a>
                                                <div class="item-except text-sm text-muted h-1x"><?php echo $row->email; ?></div>
                                                <div class="item-tag tag hide"><?php echo $row->name_group; ?></div>
                                            </div>
                                            <div>
                                                <div class="item-action dropdown">
                                                    <a href="#" data-toggle="dropdown" class="text-muted"><i class="fa fa-fw fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right text-color" role="menu">
                                                        <a href="#members-edit" data-toggle="modal" data-id="<?php echo $row->id; ?>" class="dropdown-item"><i class="fa fa-pencil"></i> Modifier </a>
                                                        <a class="dropdown-item"><i class="fa fa-reply"></i> Supprimer</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php if($row->name_group=="Admin"){ ?>
                                            <div class="twt-feed red-bg">
                                        <?php } elseif($row->name_group=="Developper"){ ?>
                                            <div class="twt-feed blue-bg">
                                        <?php } elseif($row->name_group=="Marketing") { ?>
                                            <div class="twt-feed gray-bg">
                                        <?php } elseif($row->name_group=="Public") { ?>
                                            <div class="twt-feed green-bg">
                                       <?php } elseif($row->name_group=="Unknown") { ?>
                                            <div class="twt-feed white-bg">
                                        <?php } ?>
                                            <div class="fa fa-user wtt-mark"></div>
                                            <a>
                                                <img alt="" src="<?php echo img_url('users/Sauron_eye_barad_dur.jpg'); ?>">
                                            </a>
                                            <h1><?php echo $row->name_user; ?></h1>
                                            <h2><?php echo $row->name_group; ?></h2>
                                            <a href="mailto:<?php echo $row->email; ?>"><?php echo $row->email; ?></a>
                                        </div>
                                        <div class="weather-category twt-category">
                                            <!-- <ul>
                                                <li class="active">
                                                    <h5>750</h5>
                                                    Tweets
                                                </li>
                                                <li>
                                                    <h5>865</h5>
                                                    Following
                                                </li>
                                                <li>
                                                    <h5>3645</h5>
                                                    Followers
                                                </li>
                                            </ul> -->
                                        </div>
                                        <div class="twt-write col-sm-12">
                                            <a href="#members-edit" data-toggle="modal" data-id="<?php echo $row->id; ?>" class="btn btn-primary" id="edit-user">Modifier</a>
                                            <a href="<?php echo site_url('members/delete/'.$row->id); ?>" class="btn btn-danger" id="delete-user">Supprimer</a>
                                        </div>
                                        <footer class="twt-footer">
                                            <i class="fa fa-calendar"></i>
                                            <?php echo $row->last_login; ?>
                                        </footer>
                                    </section>
                                </div>
                            <?php } ?>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        <!-- END MAIN CONTENT -->
        </section>
    </section>
    <!--main content end-->
</section>
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
<?php $this->load->view('include/footer.php'); ?>