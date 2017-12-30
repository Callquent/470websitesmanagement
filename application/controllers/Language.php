<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_language');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','form_validation', 'encrypt', 'session','email'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index($title_url_language = '')
	{
		if(check_access()==true)
		{
			$data['all_websites'] = $this->model_front->get_all_websites_per_language($title_url_language);
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['username'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$this->load->view('language', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function edit_language($l_id = '')
	{
		if(check_access()==true)
		{
			$this->form_validation->set_rules('titlelanguage', 'TitleLanguage', 'trim|required');

			$title_language = $this->input->post('titlelanguage');

			if ($this->form_validation->run() !== FALSE){
				$this->model_language->update_language($l_id, $title_language);
			}
		}else {
			$this->load->view('index');
		}
	}
	public function loadLanguages(){
		if(check_access()==true)
		{
			$data['all_languages'] = $this->model_front->get_all_languages();

			$this->output
				->set_content_type('application/json')
				->set_output( json_encode($data['all_languages']->result()));
		}else {
			$this->load->view('index');
		}
	}
	public function delete_language($l_id_old = '')
	{
		if(check_access()==true)
		{
			$c_id_new = $this->input->post('language');

			if ($this->model_front->get_language($l_id_old)->num_rows() == 1){
				$this->model_language->transfert_website_language($l_id_old, $l_id_new);
				$this->model_language->delete_language($l_id_old);
			}
		}else {
			$this->load->view('index');
		}
	}
}
