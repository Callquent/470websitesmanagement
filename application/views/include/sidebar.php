<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">

            <div class="user-profile-container">
                <div class="user-profile clearfix">
                    <div class="admin-user-thumb">
                        <img alt="" src="<?php echo img_url('users/Sauron_eye_barad_dur.jpg'); ?>" class="img-circle">
                    </div>
                    <div class="admin-user-info">
                        <ul class="user-info">
                            <li><span class="text-semibold text-size-large"><?php echo $login; ?></span></li>
                            <li><span><small><?php echo $user_role[0]->name; ?></small></span></li>
                        </ul>
                        <div class="logout-icon"><a href="<?php echo site_url('index/logout'); ?>"><i class="fa fa-sign-out"></i></a></div>
                    </div>
                    
                </div>              
            </div>


            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="<?php echo site_url('dashboard'); ?>">
                        <i class="fa fa-dashboard"></i>
                        <span><?php echo lang('dashboard'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-desktop"></i>
                        <span><?php echo lang('websites_management'); ?></span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo site_url('all-websites'); ?>"><?php echo lang('all_websites'); ?> <span class="badge"><?php echo $all_count_websites->count_all_websites; ?></span></a></li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-plus"></i><?php echo lang('website_languages'); ?></a>
                            <ul class="sub">
                                <?php foreach ($all_count_websites_per_language->result() as $row) {  ?>
                                <li><a href="<?php echo site_url('all-websites/language/'.$row->l_title_url); ?>"><?php echo $row->l_title; ?> <span class="badge"><?php echo $row->count_websites_per_language; ?></span></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-plus"></i><?php echo lang('website_categories'); ?></a>
                            <ul class="sub">
                                <?php foreach ($all_count_websites_per_category->result() as $row) {  ?>
                                <li><a href="<?php echo site_url('all-websites/category/'.$row->c_title_url); ?>"><?php echo $row->c_title; ?> <span class="badge"><?php echo $row->count_websites_per_category; ?></span></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="<?php echo site_url('ftp-websites'); ?>">
                        <i class="fa fa-exchange"></i>
                        <span>FTP Websites</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('whois-domain'); ?>">
                        <i class="fa fa-file"></i>
                        <span>Whois Domain</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-tasks"></i>
                        <span>Projects</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo site_url('all-projects'); ?>">All Projects</a></li>
                        <li><a href="<?php echo site_url('my-tasks'); ?>">My Tasks <span class="badge"><?php echo $all_count_websites->count_all_websites; ?></span></a></li>
                    </ul>
                </li>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-list-ul"></i>
                        <span>Scrapper SEO</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo site_url('search-scrapper-google'); ?>">Search Scrapper Google</a></li>
                        <li><a href="<?php echo site_url('website-scrapper-google'); ?>">Website Scrapper Google</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-bar-chart"></i>
                        <span>Position Tracking</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo site_url('position-tracking-google'); ?>">Position Tracking Google</a></li>
                        <li><a href="<?php echo site_url('edit-keyword-google'); ?>">Edit Keyword Google</a></li>
                    </ul>
                </li>
                <?php if ($user_role[0]->name == "Admin") { ?>
                <li class="list-title-sidebar">
                    <span><?php echo lang('groups'); ?></span>
                </li>
                <li class="sub-menu">
                    <a href="<?php echo site_url('language'); ?>">
                        <i class="fa fa-code"></i>
                        <span><?php echo lang('languages'); ?></span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('category'); ?>">
                        <i class="fa fa-th"></i>
                        <span><?php echo lang('categories'); ?></span>
                    </a>
                </li>
                <li class="list-title-sidebar">
                    <span><?php echo lang('management'); ?></span>
                </li>
                <li>
                    <a href="<?php echo site_url('members'); ?>">
                        <i class="fa fa-users"></i>
                        <span><?php echo lang('members'); ?></span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>        
    </div>
</aside>