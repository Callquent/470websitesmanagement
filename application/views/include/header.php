<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="robots" content="noindex, nofollow"  />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<?php echo css_url('css/bootstrap.min.css'); ?>
		<?php echo css_url('plugins/bootstrap-colorpicker/css/colorpicker.css'); ?>
		<?php echo css_url('plugins/jquery-multi-select/css/multi-select.css'); ?>
		<?php echo css_url('css/perfect-scrollbar.min.css'); ?>
		<?php echo css_url('plugins/nvd3/nv.d3.min.css'); ?>
		<?php echo css_url('plugins/jquery-ui/jquery-ui.min.css'); ?>
		<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/vuetify/1.5.6/vuetify.css" rel="stylesheet">
		<?php if ($this->uri->segment(1)=='ftp-websites') { ?>
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.42.0/codemirror.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.42.0/theme/monokai.css">
		<?php } ?>
		<?php echo css_url('css/theme.css'); ?>
		<?php echo css_url('css/style.css'); ?>
		<link rel="shortcut icon" href="<?php echo img_url('app/favicon-470websitesmanagement-32x32.png'); ?>" />
	</head>
	<body id="<?php echo $this->uri->segment(1); ?>" class="layout layout-vertical layout-left-navigation layout-below-toolbar media-step-xl">
		<main>
			<div id="app">
				<v-app>
					<div id="wrapper">
		<?php $this->load->view('include/sidebar.php'); ?>
		<?php $this->load->view('include/navbar.php'); ?>
		