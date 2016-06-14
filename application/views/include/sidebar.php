<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a href="<?php echo site_url('dashboard'); ?>">
                        <i class="fa fa-dashboard"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-laptop"></i>
                        <span>Website Management</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo site_url('all-websites'); ?>">All Websites <span class="badge"><?php echo $all_count_websites->count_all_websites; ?></span></a></li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-plus"></i>Website Languages</a>
                            <ul class="sub">
                                <?php foreach ($all_count_websites_per_language->result() as $row) {  ?>
                                <li><a href="<?php echo site_url('website-language/'.$row->l_title_url); ?>"><?php echo $row->l_title; ?> <span class="badge"><?php echo $row->count_websites_per_language; ?></span></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;"><i class="fa fa-plus"></i>Website Catgories</a>
                            <ul class="sub">
                                <?php foreach ($all_count_websites_per_category->result() as $row) {  ?>
                                <li><a href="<?php echo site_url('website-category/'.$row->c_title_url); ?>"><?php echo $row->c_title; ?> <span class="badge"><?php echo $row->count_websites_per_category; ?></span></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                    <a href="<?php echo site_url('ftp-websites'); ?>">
                        <i class="fa fa-exchange"></i>
                        <span>FTP Websites</span>
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo site_url('whois-domain'); ?>">
                        <i class="fa fa-file"></i>
                        <span>Whois Domain</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url('tasks'); ?>">
                        <i class="fa fa-tasks"></i>
                        <span>Tasks</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="fa fa-bar-chart"></i>
                        <span>SEO</span>
                    </a>
                    <ul class="sub">
                        <li><a href="<?php echo site_url('seo-websites'); ?>">Search Scapper Google</a></li>
                        <li><a href="<?php echo site_url('seo-websites'); ?>">Website Scapper Google</a></li>
                    </ul>
                </li>
                <?php if ($user_role[0]->name == "Developper") { ?>
                <li>
                    <span>Administrator : </span>
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