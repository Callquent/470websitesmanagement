<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Time_spent_tasks extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_users','model_settings'));
		$this->load->library(array('Aauth','form_validation', 'encryption', 'session'));
		$this->load->helper(array('functions', 'text', 'url','language','date'));
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
		
		$data['all_websites'] = $this->model_front->get_all_websites();
		
		$data['list_groups'] = $this->model_users->get_all_groups();

		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$data['all_projects'] = $this->model_tasks->get_all_projects();
		$data['user'] = $this->aauth->get_user();
		var_dump($this->aauth->get_user());

		$this->load->view('projects/time-spent-tasks', $data);
	}
	public function view_card_tasks()
	{
		$id_project_tasks	= $this->input->post('id_project_tasks');

		$data['all_card_tasks'] = $this->model_tasks->get_all_tasks_card($id_project_tasks)->result_array();

		$this->output->set_content_type('application/json')->set_output( json_encode($data)); 
	}
	public function view_tasks()
	{
		$id_project_tasks	= $this->input->post('id_project_tasks');
		$id_card_tasks		= $this->input->post('id_card_tasks');

		$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project_tasks, $id_card_tasks);

		$data['name_card_tasks'] = $data['card_tasks']->name_card_tasks;

		$this->output->set_content_type('application/json')->set_output( json_encode($data)); 
	}
}
