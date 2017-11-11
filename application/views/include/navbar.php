<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">

    <a href="<?php echo site_url('dashboard'); ?>" class="logo">
        <img src="<?php echo img_url('app/logo-470websitesmanagement.png'); ?>" alt="">
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="notify-row" id="top_menu">
    <a href="<?php echo site_url('add-website'); ?>" class="btn btn-sm btn-success"><span><i class="fa fa-plus"></span></i><?php echo lang('create_website'); ?></a>
    <a href="<?php echo site_url('add-category'); ?>" class="btn btn-sm btn-success"><span><i class="fa fa-plus"></span></i><?php echo lang('create_category'); ?></a>
    <a href="<?php echo site_url('add-language'); ?>" class="btn btn-sm btn-success"><span><i class="fa fa-plus"></span></i><?php echo lang('create_language'); ?></a>

</div>

<div class="top-nav clearfix float-right">
    <?php if ($user_role[0]->name == "Admin") { ?>
        <a href="<?php echo site_url('export'); ?>" class="btn btn-sm btn-warning"><span><i class="fa fa-upload"></i></span><?php echo lang('export'); ?></a>
        <a href="<?php echo site_url('import'); ?>" class="btn btn-sm btn-warning"><span><i class="fa fa-download"></i></span><?php echo lang('import'); ?></a>
    <?php } ?>
    <a href="<?php echo site_url('export'); ?>" class="btn btn-sm btn-info"><span><i class="fa fa-refresh"></i></span><?php echo lang('update'); ?></a>
    <ul class="nav float-right top-menu">
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle">
                <img alt="" src="<?php echo img_url('users/Sauron_eye_barad_dur.jpg'); ?>">
                <span class="username"><?php echo $login; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="<?php echo site_url('profile'); ?>"><i class=" fa fa-user"></i><?php echo lang('profile'); ?></a></li>
                <li><a href="<?php echo site_url('settings'); ?>"><i class="fa fa-cog"></i><?php echo lang('settings'); ?></a></li>
                <li><a href="<?php echo site_url('index/logout'); ?>"><i class="fa fa-key"></i><?php echo lang('log_out'); ?></a></li>
            </ul>
        </li>
    </ul>
</div>
</header>