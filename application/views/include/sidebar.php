<v-navigation-drawer id="sidebar-left" class="bg-primary-700 text-auto" v-model="drawer" hide-overlay stateless>
	<v-list-item>
		<v-list-item-content>
			<v-list-item-title class="title">
				<img class="d-none logo-folded" src="<?php echo img_url('app/logo-470websitesmanagement-folded.png'); ?>" alt="">
				<img class="logo-expanded" src="<?php echo img_url('app/logo-470websitesmanagement-expanded.png'); ?>" alt="">
			</v-list-item-title>
		</v-list-item-content>
	</v-list-item>
			<aside id="aside" class="aside aside-left" data-fuse-bar="aside" data-fuse-bar-media-step="md" data-fuse-bar-position="left">
				<div class="aside-content-wrapper">
					<div class="aside-content bg-primary-700 text-auto">
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
												<li><span class="text-semibold text-size-large"><?php echo $user->username; ?></span></li>
												<li><span><small><?php echo $user_role[0]->name; ?></small></span></li>
											</ul>
											<div class="logout-icon"><a href="<?php echo site_url('index/logout'); ?>"><i class="fa fa-sign-out"></i></a></div>
										</div>
									</div>              
								</div>
								<ul class="nav nav-tabs">
									<li class="">
										<a data-toggle="tab" href="#general" :class="{ active: sidebar === 'general' || sidebar === undefined}"><i class="icon icon-home"></i></a>
									</li>
									<?php if($this->aauth->is_group_allowed('page_language',$user_role[0]->name) && $this->aauth->is_group_allowed('page_category',$user_role[0]->name)) { ?>
									<li class="">
										<a data-toggle="tab" href="#groupes" :class="{ active: sidebar === 'groups'}"><i class="icon icon-tag-multiple"></i></a>
									</li>
									<?php } ?>
									<li class="">
										<a data-toggle="tab" href="#projects" :class="{ active: sidebar === 'projects'}"><i class="icon icon-bulletin-board"></i></a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#list-members" :class="{ active: sidebar === 'members'}"><i class="icon icon-account-box"></i></a>
									</li>
									<li class="">
										<a data-toggle="tab" href="#administration" :class="{ active: sidebar === 'administration'}"><i class="icon icon-settings"></i></a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="general" :class="{ active: sidebar === 'general' || sidebar === undefined}" class="tab-pane">
										<ul class="sidebar-menu">
											<li class="list-title-sidebar subheader">
												<span class="subheading"><?php echo lang('general'); ?></span>
											</li>
											<li>
												<a href="<?php echo site_url('dashboard'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'dashboard' }">
													<i class="icon icon-tile-four"></i>
													<span class="subheading"><?php echo lang('dashboard'); ?></span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-websitesmanagement">
													<i class="icon icon-desktop-mac"></i>
													<span class="subheading"><?php echo lang('websites_management'); ?></span>
												</a>
												<ul id="collapse-websitesmanagement" class="collapse" role="tabpanel" data-children=".nav-item">
													<li>
														<a href="<?php echo site_url('all-websites'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'all-websites' }"><?php echo lang('all_websites'); ?>
															<v-chip color="green" text-color="white"><?php echo $all_count_websites->count_all_websites; ?></v-chip>
														</a>
													</li>
													<li>
														<a href="javascript:void(0);" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-websitelanguages"><i class="fa fa-plus"></i><?php echo lang('website_languages'); ?></a>
														<ul id="collapse-websitelanguages" class="collapse" role="tabpanel" data-children=".nav-item">
															<?php foreach ($all_count_websites_per_language->result() as $row) {  ?>
															<li>
																<a href="<?php echo site_url('all-websites/language/'.$row->name_url_language); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo $row->name_language; ?>
																<v-chip color="green" text-color="white">
																	<span><?php echo $row->count_websites_per_language; ?></span>
																</v-chip>
																</a>
															</li>
															<?php } ?>
														</ul>
													</li>
													<li>
														<a href="javascript:void(0);" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-websitecategories"><i class="fa fa-plus"></i><?php echo lang('website_categories'); ?></a>
														<ul id="collapse-websitecategories" class="collapse" role="tabpanel" data-children=".nav-item">
															<?php foreach ($all_count_websites_per_category->result() as $row) {  ?>
															<li>
																<a href="<?php echo site_url('all-websites/category/'.$row->name_url_category); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo $row->name_category; ?>
																	<v-chip color="green" text-color="white">
																		<span><?php echo $row->count_websites_per_category; ?></span>
																	</v-chip>
																</a>
															</li>
															<?php } ?>
														</ul>
													</li>
												</ul>
											</li>
											<li>
												<a href="<?php echo site_url('all-ftp-websites'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'all-ftp-websites' }">
													<i class="icon icon-swap-horizontal"></i>
													<span class="subheading"><?php echo lang('ftp_websites'); ?></span>
												</a>
											</li>
											<li>
												<a href="<?php echo site_url('whois-domain'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'whois-domain' }">
													<i class="icon icon-file-document-box"></i>
													<span class="subheading"><?php echo lang('whois_domain'); ?></span>
												</a>
											</li>
											<li>
												<a href="javascript:void(0);" class="nav-link ripple with-arrow collapsed" data-toggle="collapse" data-target="#collapse-scrapperseo">
													<i class="icon icon-search-web"></i>
													<span class="subheading"><?php echo lang('scrapper_seo'); ?></span>
												</a>
												<ul id="collapse-scrapperseo" class="collapse" role="tabpanel" data-children=".nav-item">
													<li><a href="<?php echo site_url('search-scrapper-google'); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo lang('search_scrapper_seo'); ?></a></li>
													<li><a href="<?php echo site_url('website-scrapper-google'); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo lang('website_scrapper_seo'); ?></a></li>
												</ul>
											</li>
										</ul>
									</div>
									<div id="groupes" :class="{ active: sidebar === 'groups'}" class="tab-pane">
										<ul class="sidebar-menu" id="nav-accordion">
											<li class="list-title-sidebar subheader">
												<span class="subheading"><?php echo lang('groups'); ?></span>
											</li>
											<?php if($this->aauth->is_group_allowed('page_language',$user_role[0]->name)) { ?>
											<li>
												<a href="<?php echo site_url('language'); ?>" :class="{ active: url === 'language' }" class="nav-link ripple fuse-ripple-ready" >
													<i class="icon icon-code-tags"></i>
													<span class="subheading"><?php echo lang('languages'); ?></span>
												</a>
											</li>
											<?php } ?>
											<?php if($this->aauth->is_group_allowed('page_category',$user_role[0]->name)) { ?>
											<li>
												<a href="<?php echo site_url('category'); ?>" :class="{ active: url === 'category' }" class="nav-link ripple fuse-ripple-ready">
													<i class="icon icon-table"></i>
													<span class="subheading"><?php echo lang('categories'); ?></span>
												</a>
											</li>
											<?php } ?>
										</ul>
									</div>
									<div id="projects" :class="{ active: sidebar === 'projects'}" class="tab-pane">
										<ul class="sidebar-menu" id="nav-accordion">
											<li class="list-title-sidebar subheader">
												<span class="subheading"><?php echo lang('projects'); ?></span>
											</li>
											<li>
												<a href="<?php echo site_url('all-projects'); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo lang('all_projects'); ?></a>
											</li>
											<li>
												<a href="<?php echo site_url('my-tasks'); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo lang('my_tasks'); ?>
													<v-chip color="green" text-color="white">
														<span><?php echo $all_count_tasks_per_user->count_tasks_per_user; ?></span>
													</v-chip>
												</a>
											</li>
											<li>
												<a href="<?php echo site_url('users-tasks'); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo lang('user_tasks'); ?></a>
											</li>
											<li>
												<a href="<?php echo site_url('time-spent-tasks'); ?>" class="nav-link ripple fuse-ripple-ready"><?php echo lang('time_spent_tasks'); ?></a>
											</li>
										</ul>
									</div>
									<div id="list-members" :class="{ active: sidebar === 'members'}" class="tab-pane">
										<ul class="sidebar-menu" id="nav-accordion">
											<li class="list-title-sidebar subheader">
												<span class="subheading"><?php echo lang('members'); ?></span>
											</li>
											<?php if($this->aauth->is_group_allowed('page_user',$user_role[0]->name)) { ?>
											<li>
												<a href="<?php echo site_url('members'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'members' }">
													<i class="icon icon-account-multiple"></i>
													<span class="subheading"><?php echo lang('members'); ?></span>
												</a>
											</li>
											<?php } ?>
											<?php if($this->aauth->is_group_allowed('page_group_members',$user_role[0]->name)) { ?>
											<li>
												<a href="<?php echo site_url('group-members'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'group-members' }">
													<i class="icon icon-account-multiple-plus"></i>
													<span class="subheading"><?php echo lang('group_members'); ?></span>
												</a>
											</li>
											<?php } ?>
											<li>
												<a href="<?php echo site_url('permission-group-members'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'permission-group-members' }">
													<i class="icon icon-account-settings-variant"></i>
													<span class="subheading"><?php echo lang('permission_group_members'); ?></span>
												</a>
											</li>
										</ul>
									</div>
									<div id="administration" :class="{ active: sidebar === 'administration'}" class="tab-pane">
										<ul class="sidebar-menu" id="nav-accordion">
											<li class="list-title-sidebar subheader">
												<span class="subheading"><?php echo lang('management'); ?></span>
											</li>
											<?php if($this->aauth->is_group_allowed('page_settings',$user_role[0]->name)) { ?>
											<li>
												<a href="<?php echo site_url('settings'); ?>" class="nav-link ripple fuse-ripple-ready">
													<i class="icon icon-tune-vertical"></i>
													<span class="subheading"><?php echo lang('settings'); ?></span>
												</a>
											</li>
											<?php } ?>
											<?php if($this->aauth->is_group_allowed('page_export',$user_role[0]->name)) { ?>
											<li>
												<a href="<?php echo site_url('export'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'export' }">
													<i class="icon icon-download"></i>
													<span class="subheading"><?php echo lang('export'); ?></span>
												</a>
											</li>
											<?php } ?>
											<?php if($this->aauth->is_group_allowed('page_import',$user_role[0]->name)) { ?>
											<li>
												<a href="<?php echo site_url('import'); ?>" class="nav-link ripple fuse-ripple-ready" :class="{ active: url === 'import' }">
													<i class="icon icon-upload"></i>
													<span class="subheading"><?php echo lang('import'); ?></span>
												</a>
											</li>
											<?php } ?>
											<li>
												<a href="<?php echo site_url('documentation'); ?>" class="nav-link ripple fuse-ripple-ready">
													<i class="icon icon-help-circle"></i>
													<span class="subheading"><?php echo lang('documentation'); ?></span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</ul>
					</div>
				</div>
			</aside>
	<template v-slot:append>
		<div class="pa-2">
			<div class="version">v <?php echo APP_470WEBSITESMANAGEMENT; ?></div>
		</div>
	</template>
</v-navigation-drawer>