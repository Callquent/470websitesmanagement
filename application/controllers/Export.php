<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_back');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','encryption','form_validation','encrypt','session','email'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index()
	{
		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();
		$data['key_secrete'] = bin2hex($this->encryption->create_key(6));

		$this->load->view('export', $data);
	}
	public function export_470websitesmanagement()
	{
		header("Cache-Control: ");
		header("Content-type: text/plain");
		header('Content-Disposition: attachment; filename="websitesmanagement.470"');

		$key_secrete = $_POST['keysecrete'];
		$this->encryption->initialize(
			array(
			        'cipher' => 'aes-256',
			        'mode' => 'ctr',
			        'key' => $key_secrete
			)
		);
		$websites = $this->input->post('websites');
		
		$content = $this->model_back->export_website($websites);
		$crypt = $this->encryption->encrypt($content);

		echo $crypt;
	}
	public function generate_key()
	{
		echo bin2hex($this->encryption->create_key(6));
	}
}
