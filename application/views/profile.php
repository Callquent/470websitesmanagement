<?php $this->load->view('include/header.php'); ?>

<section id="container" >
<?php $this->load->view('include/navbar.php'); ?>
<?php $this->load->view('include/sidebar.php'); ?>
<section id="main-content">
        <section class="wrapper">
        <!-- page start-->

        <div class="row">
            <div class="col-md-12">
                <section class="card mb-3">
                    <div class="card-body profile-information">
                       <div class="col-md-3">
                           <div class="profile-pic text-center">
                               <img src="<?php echo img_url('users/Sauron_eye_barad_dur.jpg'); ?>" alt="">
                           </div>
                       </div>
                       <div class="col-md-6">
                           <div class="profile-desk">
                               <h1><?php echo $user->username; ?></h1>
                               <span class="text-muted"<?php echo lang('date_create_profile'); ?><?php echo $user->date_created; ?></span>
                              <div class="change-password">
                                <form action="<?php echo site_url('profile/change-password'); ?>" method="post" id="changepassword-form" class="form-horizontal" role="form">
                                  <input class="form-control input-lg" name="newpassword" placeholder="<?php echo lang('enter_new_password'); ?>" type="password">
                                  <button class="btn btn-primary" type="submit"><?php echo lang('modify'); ?></button>
                                  <?php if($this->session->flashdata('success')){ ?>
                                  <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('success'); ?> <a class="close" data-dismiss="alert" href="#">×</a>
                                  </div>
                                  <?php } ?>
                                </form>
                              </div>
                           </div>
                       </div>
                       <div class="col-md-3">
                           <div class="profile-statistics">
                               <h1><?php echo lang('email'); ?></h1>
                               <p><a href="mailto:<?php echo $user->email; ?>"><?php echo $user->email; ?></a></p>
                               <h1><?php echo lang('permission'); ?></h1>
                               <p><?php echo $user_role[0]->name; ?></p>
                           </div>
                       </div>
                    </div>
                </section>
            </div>
        </div>
        <!-- page end-->
        </section>
    </section>
</section>
<?php $this->load->view('include/footer.php'); ?>