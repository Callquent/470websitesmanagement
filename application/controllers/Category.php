<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_settings'));
		$this->load->library(array('Aauth','form_validation', 'encryption', 'session','email'));
		$this->load->helper(array('functions', 'text', 'url', 'language'));
		$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index($name_url_category = '')
	{
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();

		$data['all_websites'] = $this->model_front->get_all_websites_per_category($name_url_category);
		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('category', $data);
	}
	public function add_category()
	{
		$this->form_validation->set_rules('category', 'Category', 'trim|required');

		$name_category = $this->input->post('category');

		if ($this->form_validation->run() !== FALSE){
			$id_category = $this->model_category->create_category($name_category);
			$data = $this->model_category->get_category($id_category);
		}

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function edit_category()
	{
		$id_category = $this->input->post('id_category');
		$name_category = $this->input->post('name_category');

		$this->form_validation->set_rules('name_category', 'NameCategory', 'trim|required');

		if ($this->form_validation->run() !== FALSE){
			$this->model_category->update_category($id_category, $name_category);
		}
	}
	public function delete_category()
	{
		$id_category_new = $this->input->post('id_move_category');
		$id_category_old = $this->input->post('id_delete_category');

		if ($this->model_category->get_category($id_category_old)->num_rows() == 1){
			$this->model_category->transfert_website_category($id_category_old, $id_category_new);
			$this->model_category->delete_category($id_category_old);
		}
	}
}
