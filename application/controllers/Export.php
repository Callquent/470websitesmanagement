<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_back','model_migration','model_whois','model_tasks','model_settings'));
		$this->load->library(array('Aauth','encryption','form_validation','session','email'));
		$this->load->helper(array('functions', 'text', 'url','language','file'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		$this->encryption->initialize(
			array(
				'cipher' => 'aes-256',
				'mode' => 'ctr',
				'key' => $this->config->item('encryption_key')
			)
		);

		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index()
	{
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();
		
		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$data['key_secrete'] = bin2hex($this->encryption->create_key(6));

		$this->load->view('settings/export', $data);
	}
	public function export_470websitesmanagement()
	{
		$file_name = "websitesmanagement.470";
		header("Content-type: application/octet-stream");
		header("Content-Disposition: attachment; filename=".$file_name);
		header('Expires: 0');
		header('Cache-Control: must-revalidate');
		header('Pragma: public');

		$key_secrete = $this->input->post('keysecrete');
		$websites = json_decode($this->input->post('websites'));
		
		$allqueries['470websitesmanagement_language'] = $this->model_language->get_all_languages()->result();
		$allqueries['470websitesmanagement_category'] = $this->model_category->get_all_categories()->result();
		$allqueries['470websitesmanagement_website'] = $this->model_front->get_selected_websites($websites)->result();

		foreach ($allqueries['470websitesmanagement_website'] as $value) {
			$value->ftp = $this->model_front->get_website_per_ftp($value->id_website)->result();
			$value->database = $this->model_front->get_website_per_database($value->id_website)->result();
			$value->backoffice = $this->model_front->get_website_per_backoffice($value->id_website)->result();
			$value->htaccess = $this->model_front->get_website_per_htaccess($value->id_website)->result();
			$value->whois = $this->model_whois->get_website_per_whois($value->id_website)->result();
		}
		$this->encryption->initialize(
			array(
				'cipher' => 'aes-256',
				'mode' => 'ctr',
				'key' => $key_secrete
			)
		);
		$crypt = $this->encryption->encrypt(serialize($allqueries));

		echo $crypt;
	}
	public function generate_key()
	{
		echo bin2hex($this->encryption->create_key(6));
	}
}
