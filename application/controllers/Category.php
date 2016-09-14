<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_category');
		$this->load->model('model_settings');
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->library('email');
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->helper('language');
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index($c_title_url = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$data['all_websites'] = $this->model_front->get_all_websites_per_category($c_title_url);
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['username'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$this->load->view('category', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function edit_category($c_id = '')
	{
		$this->form_validation->set_rules('titlecategory', 'TitleCategory', 'trim|required');

		$c_title = $this->input->post('titlecategory');

		if ($this->form_validation->run() !== FALSE){
			$this->model_category->update_category($c_id, $c_title);
		}
	}
	public function loadCategories(){
		$data['all_categories'] = $this->model_front->get_all_categories();

		$this->output
			->set_content_type('application/json')
			->set_output( json_encode($data['all_categories']->result()));
	}
	public function delete_category($c_id_old = '')
	{
		$c_id_new = $this->input->post('category');

		if ($this->model_front->get_category($c_id_old)->num_rows() == 1){
			$this->model_category->transfert_website_category($c_id_old, $c_id_new);
			$this->model_category->delete_category($c_id_old);
		}
	}
}
