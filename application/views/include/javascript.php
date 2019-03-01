					</div>
				</div>
			</v-app>
		</div>
		<?php echo js_url('plugins/jquery.min.js'); ?>
		<?php echo js_url('plugins/popper.min.js'); ?>
		<?php echo js_url('plugins/bootstrap.min.js'); ?>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.18/vue.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/vuetify/1.5.3/vuetify.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
		<script type="text/javascript">
			var user_current = <?php echo json_encode($user_role[0]); ?>;
			var login = <?php echo json_encode($login); ?>;
		</script>
		<?php echo js_url('plugins/mobile-detect.min.js'); ?>
		<?php echo js_url('plugins/perfect-scrollbar.jquery.min.js'); ?>
		<?php echo js_url('plugins/fuse-html.min.js'); ?>
		<?php if ($this->uri->segment(1)=='dashboard' ||
		$this->uri->segment(1)=='all-websites' ||
		$this->uri->segment(1)=='ftp-websites' ||
		$this->uri->segment(1)=='whois-domain' ||
		$this->uri->segment(1)=='users-tasks' ||
		$this->uri->segment(1)=='members' ||
		$this->uri->segment(1)=='my-tasks') { ?>
			<?php echo js_url('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>
			<?php echo js_url('plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js'); ?>
			<?php echo js_url('plugins/bootstrap-timepicker/js/bootstrap-timepicker.js'); ?>
			<?php echo js_url('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js'); ?>
			<?php echo js_url('plugins/jquery-multi-select/js/jquery.multi-select.js'); ?>
			<?php echo js_url('plugins/jquery-multi-select/js/jquery.quicksearch.js'); ?>
			<?php echo js_url('plugins/jquery-tags-input/jquery.tagsinput.min.js'); ?>

			<?php echo js_url('plugins/advanced-form.js'); ?>
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
		<?php if ($this->uri->segment(1)=='add-website') { ?>
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
		<?php if ($this->uri->segment(1)=='documentation') { ?>
			<?php echo js_url('plugins/jquery-ui/jquery-ui-1.9.2.custom.min.js'); ?>
			<?php echo js_url('plugins/tocify/javascripts/jquery.tocify.js'); ?>
		<?php } ?>
		<?php if ($this->uri->segment(1)=='ftp-websites') { ?>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.42.0/codemirror.js"></script>
			<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue-codemirror@4.0.6/dist/vue-codemirror.min.js"></script>
			<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.42.0/mode/javascript/javascript.js"></script>
			<script type="text/javascript">
				Vue.use(window.VueCodemirror)
			</script>
			<?php echo js_url('plugins/jquery.ui.widget.js'); ?>
		<?php } ?>
		<?php echo js_url('plugins/scripts.js'); ?>