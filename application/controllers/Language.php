<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Language extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_settings'));
		$this->load->library(array('Aauth','form_validation', 'encryption', 'session','email'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index($name_url_language = '')
	{
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();

		$data['all_websites'] = $this->model_front->get_all_websites_per_language($name_url_language);
		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('groups/language', $data);
	}
	public function add_language()
	{
		$this->form_validation->set_rules('language', 'Language', 'trim|required');

		$name_language = $this->input->post('language');

		if ($this->form_validation->run() !== FALSE){
			$id_language = $this->model_language->create_language($name_language);
			$data = $this->model_language->get_language($id_language);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function edit_language()
	{
	
		$id_language = $this->input->post('id_language');
		$name_language = $this->input->post('name_language');
		
		$this->form_validation->set_rules('name_language', 'TitleLanguage', 'trim|required');
		if ($this->form_validation->run() !== FALSE){
			$this->model_language->update_language($id_language, $name_language);
		}
	}
	public function delete_language()
	{
		$id_language_new = $this->input->post('id_move_language');
		$id_language_old = $this->input->post('id_delete_language');

		if ($this->model_language->get_language($id_language_old)->num_rows() == 1){
			$this->model_language->transfert_website_language($id_language_old, $id_language_new);
			$this->model_language->delete_language($id_language_old);
		}
	}
}
