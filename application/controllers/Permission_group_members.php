<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_group_members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_tasks');
		$this->load->model('model_category');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','form_validation', 'encrypt', 'session','email'));
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
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();
		
		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['list_groups_users'] = $this->aauth->list_groups(); 
		$data['all_permissions'] = $this->aauth->list_perms();
		$data['test'] = $this->aauth->list_group_perms(1);
		var_dump($data['test']);

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('members/permission-group-members',$data);
	}
	public function submit()
	{
		$this->form_validation->set_rules('category', 'Category', 'trim|required');

		$name_category = $this->input->post('category');

		if ($this->form_validation->run() !== FALSE){
			$this->model_category->create_category($name_category);
		}
	}
}