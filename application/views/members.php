<?php $this->load->view('include/header.php'); ?>

<section id="container" >
<?php $this->load->view('include/navbar.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
    <section id="main-content">
        <section class="wrapper">
        <!-- BEGIN MAIN CONTENT -->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <header class="panel-heading">
                            Editable Table
                            <span class="tools pull-right">
                                <a href="javascript:;" class="fa fa-chevron-down"></a>
                                <a href="javascript:;" class="fa fa-cog"></a>
                                <a href="javascript:;" class="fa fa-times"></a>
                             </span>
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <input type="text" id="member-finder" class="form-control" placeholder="Search a member...">
                                </div>
                            </div>
                            <div class="row">




                            <?php foreach($list_users->result() as $row){ ?>
                                <div class="col-md-4 member-entry member-entry-<?php echo $row->id; ?>">
                                    <section class="panel">
                                        <?php if($row->name_group=="Admin"){ ?>
                                            <div class="twt-feed red-bg">
                                        <?php } elseif($row->name_group=="Developper"){ ?>
                                            <div class="twt-feed blue-bg">
                                        <?php } elseif($row->name_group=="Marketing") { ?>
                                            <div class="twt-feed gray-bg">
                                        <?php } elseif($row->name_group=="Visitor") { ?>
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
                                            <p><?php echo $row->email; ?></p>
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