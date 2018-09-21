            <aside id="aside" class="aside aside-left" data-fuse-bar="aside" data-fuse-bar-media-step="md" data-fuse-bar-position="left">
                <div class="aside-content-wrapper">
                    <div class="aside-content bg-primary-700 text-auto">
                        <div class="aside-toolbar">
                            <div class="logo">
                                <a href="<?php echo site_url('dashboard'); ?>" class="logo">
                                    <img class="d-none logo-folded" src="<?php echo img_url('app/logo-470websitesmanagement-folded.png'); ?>" alt="">
                                    <img class="logo-expanded" src="<?php echo img_url('app/logo-470websitesmanagement-expanded.png'); ?>" alt="">
                                </a>
                            </div>
                            <button id="toggle-fold-aside-button" type="button" class="btn btn-icon d-none d-lg-block fuse-ripple-ready" data-fuse-aside-toggle-fold="">
                                <i class="icon icon-menu"></i>
                            </button>
                        </div>
                        <ul class="nav flex-column custom-scrollbar ps ps--theme_default" id="sidenav" data-children=".nav-item" data-ps-id="e22c9d1b-78a1-dbad-8fc7-5aaeace92bb4">
                            <!-- sidebar menu start-->
                            <div class="leftside-navigation">
                                <div class="user-profile-container">
                                    <div class="user-profile clearfix">
                                        <div class="admin-user-thumb">
                                            <img alt="" src="<?php echo img_url('users/profile.jpg'); ?>" class="img-circle">
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
                                        <a data-toggle="tab" href="#home"><i class="icon icon-home"></i></a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#groupes"><i class="icon icon-tag-multiple"></i></a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#list-members"><i class="icon icon-account-box"></i></a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#admin"><i class="icon icon-settings"></i></a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane active">
                                        <ul class="sidebar-menu">
                                            <li class="list-title-sidebar subheader">
                                                <span><?php echo lang('general'); ?></span>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('dashboard'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-tile-four"></i>
                                                    <span><?php echo lang('dashboard'); ?></span>
                                                </a>
                                            </li>
                                            <li class="nav-item" role="tab">
                                                <a href="javascript:;" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-websitesmanagement">
                                                    <i class="icon icon-desktop-mac"></i>
                                                    <span><?php echo lang('websites_management'); ?></span>
                                                </a>
                                                <ul id="collapse-websitesmanagement" class="collapse" role="tabpanel" data-children=".nav-item">
                                                    <li>
                                                        <a href="<?php echo site_url('all-websites'); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo lang('all_websites'); ?> <span class="badge badge-all-websites"><?php echo $all_count_websites->count_all_websites; ?></span></a></li>
                                                    <li>
                                                        <a href="javascript:;" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-websitelanguages"><i class="fa fa-plus"></i><?php echo lang('website_languages'); ?></a>
                                                        <ul id="collapse-websitelanguages" class="collapse" role="tabpanel" data-children=".nav-item">
                                                            <?php foreach ($all_count_websites_per_language->result() as $row) {  ?>
                                                            <li><a href="<?php echo site_url('all-websites/language/'.$row->title_url_language); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo $row->title_language; ?> <span class="badge badge-language-<?php echo $row->title_language; ?>"><?php echo $row->count_websites_per_language; ?></span></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:;" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-websitecategories"><i class="fa fa-plus"></i><?php echo lang('website_categories'); ?></a>
                                                        <ul id="collapse-websitecategories" class="collapse" role="tabpanel" data-children=".nav-item">
                                                            <?php foreach ($all_count_websites_per_category->result() as $row) {  ?>
                                                            <li><a href="<?php echo site_url('all-websites/category/'.$row->title_url_category); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo $row->title_category; ?> <span class="badge badge-category-<?php echo $row->title_category; ?>"><?php echo $row->count_websites_per_category; ?></span></a></li>
                                                            <?php } ?>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('ftp-websites'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-swap-horizontal"></i>
                                                    <span>FTP Websites</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('whois-domain'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="fa fa-file icon-lan-connect"></i>
                                                    <span>Whois Domain</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-projects">
                                                    <i class="icon icon-bulletin-board"></i>
                                                    <span>Projects</span>
                                                </a>
                                                <ul id="collapse-projects" class="collapse" role="tabpanel" data-children=".nav-item">
                                                    <li><a href="<?php echo site_url('all-projects'); ?>" class="nav-link ripple fuse-ripple-ready">All Projects</a></li>
                                                    <li><a href="<?php echo site_url('my-tasks'); ?>" class="nav-link ripple fuse-ripple-ready">My Tasks <span class="badge badge-my-tasks"><?php echo $all_count_tasks_per_user->count_tasks_per_user; ?></span></a></li>
                                                    <li><a href="<?php echo site_url('users-tasks'); ?>" class="nav-link ripple fuse-ripple-ready">Users Tasks</a></li>
                                                </ul>
                                            </li>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-scrapperseo">
                                                    <i class="icon icon-search-web"></i>
                                                    <span>Scrapper SEO</span>
                                                </a>
                                                <ul id="collapse-scrapperseo" class="collapse" role="tabpanel" data-children=".nav-item">
                                                    <li><a href="<?php echo site_url('search-scrapper-google'); ?>" class="nav-link ripple fuse-ripple-ready">Search Scrapper Google</a></li>
                                                    <li><a href="<?php echo site_url('website-scrapper-google'); ?>" class="nav-link ripple fuse-ripple-ready">Website Scrapper Google</a></li>
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
                                                <a href="<?php echo site_url('language'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-code-tags"></i>
                                                    <span><?php echo lang('languages'); ?></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('category'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-table"></i>
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
                                                <a href="<?php echo site_url('members'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-account-multiple"></i>
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
                                                <a href="<?php echo site_url('settings'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-tune-vertical"></i>
                                                    <span><?php echo lang('settings'); ?></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('export'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-download"></i>
                                                    <span><?php echo lang('export'); ?></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('import'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-upload"></i>
                                                    <span><?php echo lang('import'); ?></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="<?php echo site_url('documentation'); ?>" class="nav-link ripple fuse-ripple-ready">
                                                    <i class="icon icon-help-circle"></i>
                                                    <span><?php echo lang('documentation'); ?></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>

                        </ul>
                    </div>
                </div>
            </aside>