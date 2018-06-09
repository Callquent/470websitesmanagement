<?php $this->load->view('include/header.php'); ?>

<?php $this->load->view('include/sidebar.php'); ?>
<?php $this->load->view('include/navbar.php'); ?>
<div class="content custom-scrollbar">
  <div class="page-layout simple full-width">
    <div class="page-header light-fg d-flex flex-column justify-content-center justify-content-lg-end p-6">
        <div class="flex-column row flex-lg-row align-items-center align-items-lg-end no-gutters justify-content-between">
            <div class="user-info flex-column row flex-lg-row no-gutters align-items-center">
                <img class="profile-image avatar huge mr-6" src="<?php echo img_url('users/profile.jpg'); ?>">
                <div class="name h2 my-6"><?php echo $user->username; ?></div>
                <div class="permission my-6"><?php echo $user_role[0]->name; ?></div>
            </div>
            <div class="actions row align-items-center no-gutters">
                <button type="button" class="btn btn-primary fuse-ripple-ready" aria-label="Follow">Follow</button>
                <a href="mailto:<?php echo $user->email; ?>" class="btn btn-secondary ml-2 fuse-ripple-ready" aria-label="Send Message">Send Message</a>
            </div>
        </div>
    </div>
  <div class="page-content">

      <section id="main-content">
          <section class="wrapper">
          <div class="row">
              <div class="col-md-12">
                  <section class="card mb-3">
                      <div class="card-body profile-information">
                         <div class="col-md-3">
                             <div class="profile-pic text-center">
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
          </section>
      </section>
    </div>
  </div>
</div>
<?php $this->load->view('include/javascript.php'); ?>
<script type="text/javascript">
  $(document).ready(function(){
      $("#changepassword-form").submit(function(e){
        $.ajax({
          type: "POST",
          url: $(this).attr('action'),
          data:$(this).serialize(),
          success: function(msg){
          },
          error: function(msg){
            console.log(msg.responseText);
          }
        });
        e.preventDefault();
      });
  });
</script>
<?php $this->load->view('include/footer.php'); ?>