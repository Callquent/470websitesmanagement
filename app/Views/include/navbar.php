<template>
  <v-card
    color="grey lighten-4"
    flat
    tile
  >
    <v-toolbar>
        <v-app-bar-nav-icon  @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <?php if($this->aauth->is_group_allowed('create_website',$user_role[0]->name)) { ?>
            <v-menu offset-y>
                <template v-slot:activator="{ on }">
                    <v-btn
                    icon
                    v-on="on"
                    color="grey darken-1"
                    >
                        <v-icon>mdi-plus-circle</v-icon>
                    </v-btn>
                </template>
                <v-divider></v-divider>
                <v-list>
                    <v-list-item href="<?php echo site_url('add-website'); ?>">
                        <v-list-item-title><?php echo lang('create_website'); ?></v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        <?php } ?>
        
        <v-spacer></v-spacer>
        <v-menu offset-y>
            <template v-slot:activator="{ on }">
                <v-btn
                text
                x-large
                v-on="on"
                color="grey darken-1"
                class="pl-3 pr-3"
                >
                <v-avatar class="mr-3">
                    <img src="<?php echo img_url('users/profile.jpg'); ?>">
                </v-avatar>
                    <?php echo $user->username; ?>
                </v-btn>
            </template>
            <v-divider></v-divider>
            <v-list>
                <v-list-item href="<?php echo site_url('profile'); ?>">
                    <v-list-item-title><?php echo lang('profile'); ?></v-list-item-title>
                </v-list-item>
                <v-list-item href="<?php echo site_url('index/logout'); ?>">
                    <v-list-item-title><?php echo lang('log_out'); ?></v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </v-toolbar>
 </v-card>
</template>