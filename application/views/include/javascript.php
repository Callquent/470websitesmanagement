			</v-app>
		</div>
		<?php echo js_url('plugins/jquery.min.js'); ?>
		<?php echo js_url('plugins/popper.min.js'); ?>
		<?php echo js_url('plugins/bootstrap.min.js'); ?>
		<?php echo js_url('plugins/vue.js'); ?>
		<?php echo js_url('plugins/vuetify/vuetify.js'); ?>
		<?php echo js_url('plugins/axios.min.js'); ?>
		<script type="text/javascript">
			var mixin = {
				data : {
					sidebar: 'general',
					url: '<?php echo $this->uri->segment(1); ?>',
				}
			}
		</script>
		<?php echo js_url('plugins/mobile-detect.min.js'); ?>
		<?php echo js_url('plugins/perfect-scrollbar.jquery.min.js'); ?>
		<?php echo js_url('plugins/fuse-html.min.js'); ?>
		<?php if ($this->uri->segment(1)=='dashboard' || $this->uri->segment(1)=='position-tracking') { ?>
			<?php echo js_url('plugins/nvd3/d3.min.js'); ?>
			<?php echo js_url('plugins/nvd3/nv.d3.min.js'); ?>
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
		<?php echo js_url('plugins/main.js'); ?>