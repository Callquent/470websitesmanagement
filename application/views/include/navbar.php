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
    <a href="<?php echo site_url('export'); ?>" class="btn btn-warning"><i class="fa fa-share"></i> Export</a>
    <a href="<?php echo site_url('import'); ?>" class="btn btn-warning"><i class="fa fa-reply"></i> Import</a>
</div>

<div class="top-nav clearfix">
    <ul class="nav pull-right top-menu">
        <li class="dropdown language">
            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <?php 
                switch ($this->session->userdata('language')) {
                    case "english":
                        echo "<img alt=\"\" src=".img_url('flags/us.png').">&nbsp;<span class=\"username\">English</span>";
                        break;
                    case "french":
                        echo "<img alt=\"\" src=".img_url('flags/fr.png').">&nbsp;<span class=\"username\">Français</span>";
                        break;
                    case "italy":
                        echo "<img alt=\"\" src=".img_url('flags/it.png').">&nbsp;<span class=\"username\">Italiano</span>";
                        break;
                    case "spanish":
                        echo "<img alt=\"\" src=".img_url('flags/es.png').">&nbsp;<span class=\"username\">Español</span>";
                        break;
                    case "germany":
                        echo "<img alt=\"\" src=".img_url('flags/de.png').">&nbsp;<span class=\"username\">Deutch</span>";
                        break;
                    case "russian":
                        echo "<img alt=\"\" src=".img_url('flags/ru.png').">&nbsp;<span class=\"username\">Български</span>";
                        break;
                }
                ?>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <?php 
                switch ($this->session->userdata('language')) {
                    case "english":
                        echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
                        echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
                        echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
                        echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
                        echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
                        break;
                    case "french":
                        echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
                        echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
                        echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
                        echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
                        echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
                        break;
                    case "italy":
                        echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
                        echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
                        echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
                        echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
                        echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
                        break;
                    case "spanish":
                        echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
                        echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
                        echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
                        echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
                        echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
                        break;
                    case "germany":
                        echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
                        echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
                        echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
                        echo "<li><a href=".site_url('settings/languages/russian')."><img alt=\"\" src=".img_url('flags/ru.png')."> Български</a></li>";
                        echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
                        break;
                    case "russian":
                        echo "<li><a href=".site_url('settings/languages/english')."><img alt=\"\" src=".img_url('flags/us.png')."> English</a></li>";
                        echo "<li><a href=".site_url('settings/languages/french')."><img alt=\"\" src=".img_url('flags/fr.png')."> Français</a></li>";
                        echo "<li><a href=".site_url('settings/languages/italy')."><img alt=\"\" src=".img_url('flags/it.png')."> Italiano</a></li>";
                        echo "<li><a href=".site_url('settings/languages/germany')."><img alt=\"\" src=".img_url('flags/de.png')."> Deutch</a></li>";
                        echo "<li><a href=".site_url('settings/languages/spanish')."><img alt=\"\" src=".img_url('flags/es.png')."> Español</a></li>";
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