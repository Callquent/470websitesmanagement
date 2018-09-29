<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow"  />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php echo css_url('css/bootstrap.min.css'); ?>
		<?php echo css_url('plugins/fullcalendar/bootstrap-fullcalendar.css'); ?>
		<?php echo css_url('plugins/bootstrap-fileupload/bootstrap-fileupload.css'); ?>
		<?php echo css_url('plugins/bootstrap-colorpicker/css/colorpicker.css'); ?>
		<?php echo css_url('plugins/jquery-multi-select/css/multi-select.css'); ?>
		<?php echo css_url('plugins/data-tables/datatables.bootstrap.min.css'); ?>
		<?php echo css_url('plugins/data-tables/Buttons/css/buttons.dataTables.css'); ?>
		<?php echo css_url('plugins/tocify/stylesheets/jquery.tocify.css'); ?>
		<?php echo css_url('css/perfect-scrollbar.min.css'); ?>
		<?php echo css_url('plugins/nvd3/nv.d3.min.css'); ?>
		<?php echo css_url('plugins/jquery-ui/jquery-ui.min.css'); ?>
		<?php echo css_url('plugins/pnotify/animate.min.css'); ?>
		<?php echo css_url('plugins/pnotify/pnotify.custom.min.css'); ?>
		<?php if ($this->uri->segment(1)=='ftp-websites') { ?>
			<?php echo css_url('plugins/codemirror/codemirror.min.css'); ?>
			<?php echo css_url('plugins/codemirror/theme/monokai.min.css'); ?>
			<?php echo css_url('plugins/codemirror/addon/scroll/simplescrollbars.min.css'); ?>
		<?php } ?>
		<?php echo css_url('css/theme.css'); ?>
		<?php echo css_url('css/style.css'); ?>
		<link rel="shortcut icon" href="<?php echo img_url('app/favicon-470websitesmanagement-32x32.png'); ?>" />
	</head>
	<body id="<?php echo $this->uri->segment('1'); ?>" class="layout layout-vertical layout-left-navigation layout-below-toolbar media-step-xl">
		<main>
        <div id="wrapper">