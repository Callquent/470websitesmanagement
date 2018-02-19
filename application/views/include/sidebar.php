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
            <ul class="nav nav-tabs">
                <li class="">
                    <a data-toggle="tab" href="#home" aria-expanded="false"><i class="fa fa-home"></i></a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#groupes" aria-expanded="true"><i class="fa fa-tags"></i></a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#list-members" aria-expanded="true"><i class="fa fa-users"></i></a>
                </li>
                <li class="">
                    <a data-toggle="tab" href="#admin"><i class="fa fa-cogs"></i></a>
                </li>
            </ul>
            <div class="panel-body">
                <div class="tab-content">
                    <div id="home" class="tab-pane active">
                        <ul class="sidebar-menu" id="nav-accordion">
                            <li class="list-title-sidebar">
                                <span><?php echo lang('general'); ?></span>
                            </li>
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
                                    <li><a href="<?php echo site_url('all-websites'); ?>"><?php echo lang('all_websites'); ?> <span class="badge badge-all-websites"><?php echo $all_count_websites->count_all_websites; ?></span></a></li>
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-plus"></i><?php echo lang('website_languages'); ?></a>
                                        <ul class="sub">
                                            <?php foreach ($all_count_websites_per_language->result() as $row) {  ?>
                                            <li><a href="<?php echo site_url('all-websites/language/'.$row->title_url_language); ?>"><?php echo $row->title_language; ?> <span class="badge badge-language-<?php echo $row->title_language; ?>"><?php echo $row->count_websites_per_language; ?></span></a></li>
                                            <?php } ?>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:;"><i class="fa fa-plus"></i><?php echo lang('website_categories'); ?></a>
                                        <ul class="sub">
                                            <?php foreach ($all_count_websites_per_category->result() as $row) {  ?>
                                            <li><a href="<?php echo site_url('all-websites/category/'.$row->title_url_category); ?>"><?php echo $row->title_category; ?> <span class="badge badge-category-<?php echo $row->title_category; ?>"><?php echo $row->count_websites_per_category; ?></span></a></li>
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
                                    <i class="fa fa-briefcase"></i>
                                    <span>Projects</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="<?php echo site_url('all-projects'); ?>">All Projects</a></li>
                                    <li><a href="<?php echo site_url('my-tasks'); ?>">My Tasks <span class="badge"><?php echo $all_count_tasks_per_user->count_tasks_per_user; ?></span></a></li>
                                </ul>
                            </li>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-search"></i>
                                    <span>Scrapper SEO</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="<?php echo site_url('search-scrapper-google'); ?>">Search Scrapper Google</a></li>
                                    <li><a href="<?php echo site_url('website-scrapper-google'); ?>">Website Scrapper Google</a></li>
                                </ul>
                            </li>
                            <!-- <li>
                                <a href="javascript:;">
                                    <i class="fa fa-bar-chart"></i>
                                    <span>Position Tracking</span>
                                </a>
                                <ul class="sub">
                                    <li><a href="<?php echo site_url('position-tracking-google'); ?>">Position Tracking Google</a></li>
                                    <li><a href="<?php echo site_url('edit-keyword-google'); ?>">Edit Keyword Google</a></li>
                                </ul>
                            </li> -->
                        </ul>
                    </div>
                    <?php if ($user_role[0]->name == "Admin") { ?>
                    <div id="groupes" class="tab-pane">
                        <ul class="sidebar-menu" id="nav-accordion">
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
                        </ul>
                    </div>
                    <div id="list-members" class="tab-pane">
                        <ul class="sidebar-menu" id="nav-accordion">
                            <li class="list-title-sidebar">
                                <span><?php echo lang('members'); ?></span>
                            </li>
                            <li>
                                <a href="<?php echo site_url('members'); ?>">
                                    <i class="fa fa-user"></i>
                                    <span><?php echo lang('members'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div id="admin" class="tab-pane">
                        <ul class="sidebar-menu" id="nav-accordion">
                            <li class="list-title-sidebar">
                                <span><?php echo lang('management'); ?></span>
                            </li>
                            <li>
                                <a href="<?php echo site_url('export'); ?>">
                                    <i class="fa fa-download"></i>
                                    <span><?php echo lang('export'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('import'); ?>">
                                    <i class="fa fa-upload"></i>
                                    <span><?php echo lang('import'); ?></span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('documentation'); ?>">
                                    <i class="fa fa-info-circle"></i>
                                    <span><?php echo lang('documentation'); ?></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <?php } ?>
                </div>
            </div>



                
        </div>        
    </div>
</aside>