<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Documentation extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_back','model_whois','model_settings'));
		$this->load->library(array('Aauth','Whois','form_validation', 'encryption', 'session','email'));
		$this->load->helper(array('functions','url','language'));
		$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index()
	{
		$data['user'] = $this->aauth->get_user();
		$data['user_role'] = $this->aauth->get_user_groups();

		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('settings/documentation',$data);
	}
}
