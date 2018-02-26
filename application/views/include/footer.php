
	<?php echo js_url('js/jquery-2.2.4.min.js'); ?>
	<?php echo js_url('js/popper.min.js'); ?>
	<?php echo js_url('js/bootstrap.min.js'); ?>
	<?php echo js_url('js/jquery.dcjqaccordion.2.7.js'); ?>
	<?php echo js_url('js/jquery.nicescroll.js'); ?>
	<?php if ($this->uri->segment(1)=='all-projects') { ?>
		<?php echo js_url('js/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
		<?php echo js_url('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
		<?php echo js_url('js/advanced-form.js'); ?>
		<?php echo js_url('js/jquery.autocomplete.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='all-') { ?>
		<?php echo js_url('js/jquery-ui/jquery-ui-1.10.1.custom.min.js'); ?>
		<?php echo js_url('js/draggable-portlet.js'); ?>
		<?php echo js_url('js/skycons.js'); ?>
		<?php echo js_url('js/dashboard.js'); ?>
		<?php echo js_url('js/jquery.customSelect.min.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='dashboard' ||
	$this->uri->segment(1)=='all-websites' ||
	$this->uri->segment(1)=='category' ||
	$this->uri->segment(1)=='language' ||
	$this->uri->segment(1)=='ftp-websites' ||
	$this->uri->segment(1)=='whois-domain' ||
	$this->uri->segment(1)=='users-tasks') { ?>
		<?php echo js_url('js/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
		<?php echo js_url('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
		<?php echo js_url('js/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>
		<?php echo js_url('js/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>
		<?php echo js_url('js/jquery-multi-select/js/jquery.multi-select.js'); ?>
		<?php echo js_url('js/jquery-multi-select/js/jquery.quicksearch.js'); ?>
		<?php echo js_url('js/bootstrap-wysihtml5/wysihtml5-0.3.0.js'); ?>
		<?php echo js_url('js/bootstrap-wysihtml5/bootstrap-wysihtml5.js'); ?>
		<?php echo js_url('js/jquery-tags-input/jquery.tagsinput.min.js'); ?>

		<?php echo js_url('js/advanced-form.js'); ?>

		<?php echo js_url('js/data-tables/datatables.min.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/dataTables.buttons.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.flash.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.html5.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.print.js'); ?>
		<?php echo js_url('js/data-tables/datatables.bootstrap.min.js'); ?>
		<?php echo js_url('js/data-tables/datatables.responsive.min.js'); ?>
		<?php echo js_url('js/data-tables/responsive.bootstrap4.min.js'); ?>
		<?php echo js_url('js/data-tables/dataTables.tableTools.js'); ?>
		<?php echo js_url('js/table-editable.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='whois-domain') { ?>
		<?php echo js_url('js/fullcalendar/fullcalendar.min.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='dashboard' || $this->uri->segment(1)=='position-tracking') { ?>
		<?php echo js_url('js/chart-js/Chart.min.js'); ?>
		<?php echo js_url('js/chartjs.init.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='ftp-websites') { ?>
		<?php echo js_url('js/ui-tree.js'); ?>
		<?php echo js_url('js/bootstrap-contentmenu.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='export') { ?>
		<?php echo js_url('js/jquery-ui/jquery-ui-1.9.2.custom.min.js'); ?>
		<?php echo js_url('js/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
		<?php echo js_url('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
		<?php echo js_url('js/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>
		<?php echo js_url('js/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>
		<?php echo js_url('js/jquery-multi-select/js/jquery.multi-select.js'); ?>
		<?php echo js_url('js/jquery-multi-select/js/jquery.quicksearch.js'); ?>
		<?php echo js_url('js/bootstrap-wysihtml5/wysihtml5-0.3.0.js'); ?>
		<?php echo js_url('js/bootstrap-wysihtml5/bootstrap-wysihtml5.js'); ?>
		<?php echo js_url('js/jquery-tags-input/jquery.tagsinput.min.js'); ?>
		<?php echo js_url('js/advanced-form.js'); ?>

		<?php echo js_url('js/jquery.validate.min.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='add-website'
	|| $this->uri->segment(1)=='add-category'
	|| $this->uri->segment(1)=='add-language') { ?>
		<?php echo js_url('js/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
		<?php echo js_url('js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
		<?php echo js_url('js/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>
		<?php echo js_url('js/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>
		<?php echo js_url('js/jquery-multi-select/js/jquery.multi-select.js'); ?>
		<?php echo js_url('js/jquery-multi-select/js/jquery.quicksearch.js'); ?>
		<?php echo js_url('js/bootstrap-wysihtml5/wysihtml5-0.3.0.js'); ?>
		<?php echo js_url('js/bootstrap-wysihtml5/bootstrap-wysihtml5.js'); ?>
		<?php echo js_url('js/jquery-tags-input/jquery.tagsinput.min.js'); ?>
		<?php echo js_url('js/advanced-form.js'); ?>

		<?php echo js_url('js/jquery.validate.min.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='website-scrapper-google' || $this->uri->segment(1)=='search-scrapper-google') { ?>
		<?php echo js_url('js/data-tables/datatables.min.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/dataTables.buttons.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.flash.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.html5.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.print.js'); ?>
		<?php echo js_url('js/data-tables/datatables.bootstrap.min.js'); ?>
		<?php echo js_url('js/data-tables/datatables.responsive.min.js'); ?>
		<?php echo js_url('js/data-tables/responsive.bootstrap4.min.js'); ?>
		<?php echo js_url('js/data-tables/dataTables.tableTools.js'); ?>
		<?php echo js_url('js/app-seo.js'); ?>
		<?php echo js_url('js/jquery.autocomplete.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='settings') { ?>
		<?php echo js_url('js/data-tables/datatables.min.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/dataTables.buttons.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.flash.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.html5.js'); ?>
		<?php echo js_url('js/data-tables/Buttons/js/buttons.print.js'); ?>
		<?php echo js_url('js/data-tables/datatables.bootstrap.min.js'); ?>
		<?php echo js_url('js/data-tables/datatables.responsive.min.js'); ?>
		<?php echo js_url('js/data-tables/responsive.bootstrap4.min.js'); ?>
		<?php echo js_url('js/data-tables/dataTables.tableTools.js'); ?>
		<?php echo js_url('js/bootstrap-fileupload/bootstrap-fileupload.js'); ?>
	<?php } ?>
	<?php if ($this->uri->segment(1)=='documentation') { ?>
		<?php echo js_url('js/jquery-ui/jquery-ui-1.9.2.custom.min.js'); ?>
		<?php echo js_url('js/tocify/javascripts/jquery.tocify.js'); ?>
	<?php } ?>
	<?php echo js_url('js/scripts.js'); ?>
	<?php echo js_url('js/main.js'); ?>
	</body>
</html>