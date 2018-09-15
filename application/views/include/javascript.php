			</div>
		</div>
		<?php echo js_url('plugins/jquery.min.js'); ?>
		<?php echo js_url('plugins/popper.min.js'); ?>
		<?php echo js_url('plugins/bootstrap.min.js'); ?>
		<?php echo js_url('plugins/mobile-detect.min.js'); ?>
		<?php echo js_url('plugins/perfect-scrollbar.jquery.min.js'); ?>
		<?php echo js_url('plugins/fuse-html.min.js'); ?>
		<script type="text/javascript">
		/*$(document).ready(function(){
			var url = window.location.pathname;  
			var activePage = url.substring(url.lastIndexOf('/')+1);
		    $('ul.sidebar-menu li a').each(function(){  
		        var currentPage = this.href.substring(this.href.lastIndexOf('/')+1);

		        if (activePage == currentPage) {
		            $('ul.nav-tabs a[href="#' + $(this).parents().eq(2).attr("id") + '"]').tab('show');
		            $(this).parent().addClass('active');
		        } 
		    });
		});*/
		</script>
		<?php if ($this->uri->segment(1)=='all-projects') { ?>
			<?php echo js_url('plugins/jquery-ui/jquery-ui.min.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='dashboard' ||
		$this->uri->segment(1)=='all-websites' ||
		$this->uri->segment(1)=='category' ||
		$this->uri->segment(1)=='language' ||
		$this->uri->segment(1)=='ftp-websites' ||
		$this->uri->segment(1)=='whois-domain' ||
		$this->uri->segment(1)=='users-tasks' ||
		$this->uri->segment(1)=='all-projects' ||
		$this->uri->segment(1)=='members' ||
		$this->uri->segment(1)=='my-tasks') { ?>
			<?php echo js_url('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
			<?php echo js_url('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
			<?php echo js_url('plugins/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>
			<?php echo js_url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>
			<?php echo js_url('plugins/jquery-multi-select/js/jquery.multi-select.js'); ?>
			<?php echo js_url('plugins/jquery-multi-select/js/jquery.quicksearch.js'); ?>
			<?php echo js_url('plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js'); ?>
			<?php echo js_url('plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js'); ?>
			<?php echo js_url('plugins/jquery-tags-input/jquery.tagsinput.min.js'); ?>

			<?php echo js_url('plugins/advanced-form.js'); ?>

			<?php echo js_url('plugins/data-tables/datatables.min.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/dataTables.buttons.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.flash.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.html5.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.print.js'); ?>
			<?php echo js_url('plugins/data-tables/datatables.bootstrap.min.js'); ?>
			<?php echo js_url('plugins/data-tables/datatables.responsive.min.js'); ?>
			<?php echo js_url('plugins/data-tables/dataTables.tableTools.js'); ?>
			<?php echo js_url('plugins/table-editable.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='whois-domain') { ?>
			<?php echo js_url('plugins/fullcalendar/fullcalendar.min.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='dashboard' || $this->uri->segment(1)=='position-tracking') { ?>
			<?php echo js_url('plugins/nvd3/d3.min.js'); ?>
			<?php echo js_url('plugins/nvd3/nv.d3.min.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='export') { ?>
			<?php echo js_url('plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js'); ?>
			<?php echo js_url('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
			<?php echo js_url('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
			<?php echo js_url('plugins/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>
			<?php echo js_url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>
			<?php echo js_url('plugins/jquery-multi-select/js/jquery.multi-select.js'); ?>
			<?php echo js_url('plugins/jquery-multi-select/js/jquery.quicksearch.js'); ?>
			<?php echo js_url('plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js'); ?>
			<?php echo js_url('plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js'); ?>
			<?php echo js_url('plugins/jquery-tags-input/jquery.tagsinput.min.js'); ?>
			<?php echo js_url('plugins/advanced-form.js'); ?>

			<?php echo js_url('plugins/jquery.validate.min.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='add-website'
		|| $this->uri->segment(1)=='add-category'
		|| $this->uri->segment(1)=='add-language') { ?>
			<?php echo js_url('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
			<?php echo js_url('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
			<?php echo js_url('plugins/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>
			<?php echo js_url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>
			<?php echo js_url('plugins/jquery-multi-select/js/jquery.multi-select.js'); ?>
			<?php echo js_url('plugins/jquery-multi-select/js/jquery.quicksearch.js'); ?>
			<?php echo js_url('plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js'); ?>
			<?php echo js_url('plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js'); ?>
			<?php echo js_url('plugins/jquery-tags-input/jquery.tagsinput.min.js'); ?>
			<?php echo js_url('plugins/advanced-form.js'); ?>

			<?php echo js_url('plugins/jquery.validate.min.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='website-scrapper-google' || $this->uri->segment(1)=='search-scrapper-google') { ?>
			<?php echo js_url('plugins/data-tables/datatables.min.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/dataTables.buttons.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.flash.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.html5.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.print.js'); ?>
			<?php echo js_url('plugins/data-tables/datatables.bootstrap.min.js'); ?>
			<?php echo js_url('plugins/data-tables/datatables.responsive.min.js'); ?>
			<?php echo js_url('plugins/data-tables/dataTables.tableTools.js'); ?>
			<?php echo js_url('plugins/app-seo.js'); ?>
			<?php echo js_url('plugins/jquery.autocomplete.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='settings') { ?>
			<?php echo js_url('plugins/data-tables/datatables.min.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/dataTables.buttons.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.flash.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.html5.js'); ?>
			<?php echo js_url('plugins/data-tables/Buttons/js/buttons.print.js'); ?>
			<?php echo js_url('plugins/data-tables/datatables.bootstrap.min.js'); ?>
			<?php echo js_url('plugins/data-tables/datatables.responsive.min.js'); ?>
			<?php echo js_url('plugins/data-tables/dataTables.tableTools.js'); ?>
			<?php echo js_url('plugins/bootstrap-fileupload/bootstrap-fileupload.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='documentation') { ?>
			<?php echo js_url('plugins/jquery-ui/jquery-ui-1.9.2.custom.min.js'); ?>
			<?php echo js_url('plugins/tocify/javascripts/jquery.tocify.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='ftp-websites') { ?>
			<?php echo js_url('plugins/jquery.knob.js'); ?>
			<?php echo js_url('plugins/jquery.ui.widget.js'); ?>
			<?php echo js_url('plugins/jquery.iframe-transport.js'); ?>
			<?php echo js_url('plugins/jquery.fileupload.js'); ?>
			<?php echo js_url('plugins/codemirror/codemirror.min.js'); ?>
			<?php echo js_url('plugins/codemirror/javascript.js'); ?>
			<?php echo js_url('plugins/codemirror/addon/edit/matchbrackets.min.js'); ?>
			<?php echo js_url('plugins/codemirror/addon/scroll/simplescrollbars.min.js'); ?>
		<?php } ?>
		<?php echo js_url('plugins/scripts.js'); ?>