<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_projects extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_tasks_hours','model_crud_tasks','model_users','model_settings'));
		$this->load->library(array('Aauth','form_validation', 'encryption', 'session'));
		$this->load->helper(array('functions', 'text', 'url','language','date'));
		$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index($id_project_tasks = '')
	{
		$data['user'] = $this->aauth->get_user();
		$data['user_role'] = $this->aauth->get_user_groups();
		
		$data['all_websites'] = $this->model_front->get_all_websites();
		
		$data['list_users'] = $this->model_users->get_all_users();
		$data['list_groups'] = $this->model_users->get_all_groups();

		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();


		$data['all_projects'] = $this->model_tasks->get_all_projects();

		$this->load->view('projects/all-projects', $data);
	}
	public function create_project()
	{
		$id_website				= $this->input->post('id_website');
		$nameproject			= $this->input->post('name_project');
		$date_started			= $this->input->post('date_started');
		$date_deadline			= $this->input->post('date_deadline');

		$this->model_crud_tasks->create_project($id_website, $nameproject, date("Y-m-d", strtotime($date_started)), date("Y-m-d", strtotime($date_deadline)));
	}
	public function edit_project()
	{
		$id_project				= $this->input->post('id_project');
		$name_project			= $this->input->post('name_project');
		$started_project		= $this->input->post('date_started');
		$deadline_project		= $this->input->post('date_deadline');

		/*if ($this->form_validation->run() !== FALSE){*/
			$this->model_crud_tasks->update_project($id_project, $name_project, date("Y-m-d", strtotime($started_project)), date("Y-m-d", strtotime($deadline_project)));
		/*}*/
	}
	public function delete_project()
	{
		$id_project			= $this->input->post('id_project');

		$this->model_crud_tasks->delete_project($id_project);
	}
}
