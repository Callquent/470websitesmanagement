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

<div class="nav notify-row" id="top_menu">
    <a href="<?php echo site_url('add-website'); ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Create Website</a>
    <a href="<?php echo site_url('add-category'); ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Create Category</a>
    <a href="<?php echo site_url('add-language'); ?>" class="btn btn-success"><i class="fa fa-plus-circle"></i> Create Language</a>
</div>

<div class="top-nav clearfix">
    <ul class="nav pull-right top-menu">
        <li class="dropdown language">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <?php 
                switch ($language) {
                    case "english":
                        echo "<img alt=\"\" src=".img_url('flags/us.png').">&nbsp;<span class=\"username\">English</span>";
                        break;
                    case "french":
                        echo "<img alt=\"\" src=".img_url('flags/fr.png').">&nbsp;<span class=\"username\">French</span>";
                        break;
                }
                ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <?php 
                switch ($language) {
                    case "english":
                        echo "<li><a href=".site_url('dashboard/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> French</a></li>";
                        break;
                    case "french":
                        echo "<li><a href=".site_url('dashboard/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
                        break;
                }
                ?>
            </ul>
        </li>
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="<?php echo img_url('users/Sauron_eye_barad_dur.jpg'); ?>">
                <span class="username"><?php echo $login; ?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="<?php echo site_url('profile'); ?>"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <li><a href="<?php echo site_url('settings'); ?>"><i class="fa fa-cog"></i> Settings</a></li>
                <li><a href="<?php echo site_url('index/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
    </ul>
</div>
</header>