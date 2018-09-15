            <div class="content-wrapper">
                <nav id="toolbar" class="bg-white">
                    <div class="row no-gutters align-items-center flex-nowrap">
                        <div class="col">
                            <div class="row no-gutters align-items-center flex-nowrap">
                                <button type="button" class="toggle-aside-button btn btn-icon d-block d-lg-none fuse-ripple-ready" data-fuse-bar-toggle="aside">
                                    <i class="icon icon-menu"></i>
                                </button>
                                <div class="toolbar-separator d-block d-lg-none"></div>
                                <div class="shortcuts-wrapper row no-gutters align-items-center px-0 px-sm-2">
                                    <div class="add-shortcut-menu-button dropdown px-1 px-sm-3">
                                        <div class="dropdown-toggle btn btn-icon fuse-ripple-ready" role="button" id="dropdownShortcutMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="icon icon-plus-circle"></i>
                                        </div>
                                        <div class="dropdown-menu" aria-labelledby="dropdownShortcutMenu">
                                            <a class="dropdown-item fuse-ripple-ready" href="<?php echo site_url('add-website'); ?>">
                                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                                    <div class="row no-gutters align-items-center flex-nowrap">
                                                        <i class="icon icon-plus"></i>
                                                        <span class="px-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo lang('create_website'); ?></font></font></span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item fuse-ripple-ready" href="<?php echo site_url('add-category'); ?>">
                                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                                    <div class="row no-gutters align-items-center flex-nowrap">
                                                        <i class="icon icon-plus"></i>
                                                        <span class="px-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo lang('create_category'); ?></font></font></span>
                                                    </div>
                                                </div>
                                            </a>
                                            <a class="dropdown-item fuse-ripple-ready" href="<?php echo site_url('add-language'); ?>">
                                                <div class="row no-gutters align-items-center justify-content-between flex-nowrap">
                                                    <div class="row no-gutters align-items-center flex-nowrap">
                                                        <i class="icon icon-plus"></i>
                                                        <span class="px-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo lang('create_language'); ?></font></font></span>
                                                    </div>
                                                </div>
                                            </a>

                                        </div>
                                    </div>
                                </div>
                                <div class="toolbar-separator"></div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="row no-gutters align-items-center justify-content-end">
                                <div class="user-menu-button dropdown">
                                    <div class="dropdown-toggle ripple row align-items-center no-gutters px-2 px-sm-4 fuse-ripple-ready" role="button" id="dropdownUserMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="avatar-wrapper">
                                            <img class="avatar" alt="" src="<?php echo img_url('users/profile.jpg'); ?>">
                                        </div>
                                        <span class="username mx-3 d-none d-md-block"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo $login; ?></font></font></span>
                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="dropdownUserMenu">
                                        <a class="dropdown-item fuse-ripple-ready" href="<?php echo site_url('profile'); ?>">
                                            <div class="row no-gutters align-items-center flex-nowrap">
                                                <i class="fa fa-2x fa-user"></i>
                                                <span class="px-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo lang('profile'); ?></font></font></span>
                                            </div>
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item fuse-ripple-ready" href="<?php echo site_url('index/logout'); ?>">
                                            <div class="row no-gutters align-items-center flex-nowrap">
                                                <i class="fa fa-2x fa-sign-out"></i>
                                                <span class="px-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;"><?php echo lang('log_out'); ?></font></font></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="toolbar-separator"></div>
                                <div class="language-button dropdown">
                                    <div class="dropdown-toggle ripple row align-items-center justify-content-center no-gutters px-0 px-sm-4 fuse-ripple-ready" role="button" id="dropdownLanguageMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="row no-gutters align-items-center">
                                            <img class="flag mr-2" src="<?php echo img_url('flags/us.png') ?>">
                                            <span class="d-none d-md-block"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">EN</font></font></span>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu" aria-labelledby="dropdownLanguageMenu">
                                        <a class="dropdown-item fuse-ripple-ready" href="http://fuse-bootstrap4-material.withinpixels.com/vertical-layout-below-toolbar-left-navigation/index.html#">
                                            <div class="row no-gutters align-items-center flex-nowrap">
                                                <img class="flag" src="<?php echo img_url('flags/us.png') ?>">
                                                <span class="px-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Anglais</font></font></span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item fuse-ripple-ready" href="http://fuse-bootstrap4-material.withinpixels.com/vertical-layout-below-toolbar-left-navigation/index.html#">
                                            <div class="row no-gutters align-items-center flex-nowrap">
                                                <img class="flag" src="<?php echo img_url('flags/es.png') ?>">
                                                <span class="px-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Espanol</font></font></span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item fuse-ripple-ready" href="http://fuse-bootstrap4-material.withinpixels.com/vertical-layout-below-toolbar-left-navigation/index.html#">
                                            <div class="row no-gutters align-items-center flex-nowrap">
                                                <img class="flag" src="<?php echo img_url('flags/fr.png') ?>">
                                                <span class="px-3"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Francais</font></font></span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>