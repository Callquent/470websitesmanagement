<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_tasks extends CI_Controller {

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
	public function index($id_project_tasks = '')
	{
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();
		
		$data['all_websites'] = $this->model_front->get_all_websites();

		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		if($this->uri->total_segments() == 1){
			$data['all_projects_per_users'] = $this->model_tasks->get_all_projects_to_user($this->session->userdata['id']);
			$data['all_tasks_priority_to_user'] =$this->model_tasks->get_all_tasks_priority_to_user($this->session->userdata['id'])->row();
			
			$this->load->view('my-projects', $data);
		} elseif($this->uri->total_segments() == 2) {
			$data['project'] = $this->model_tasks->get_project($id_project_tasks);

			$data['datetimestart'] = past_time_project($id_project_tasks);
			$data['datetimedeadline'] = remaining_time_project($id_project_tasks);
			$data['percentage_project'] = $this->model_tasks->get_percentage_user($id_project_tasks,$this->session->userdata['id'])->row();

			$data['all_tasks_status'] = $this->model_tasks->get_all_tasks_status();
			$data['all_tasks_priority'] = $this->model_tasks->get_all_tasks_priority();

			$data['all_tasks'] = $this->model_tasks->get_all_tasks($id_project_tasks);

			$data['all_card_tasks'] = $this->model_tasks->get_all_tasks_card($id_project_tasks);
			$data['all_card_tasks_to_do'] = $this->model_tasks->get_all_tasks_card($id_project_tasks,"1",$this->session->userdata['id']);
			$data['all_card_tasks_in_progress'] = $this->model_tasks->get_all_tasks_card($id_project_tasks,"2",$this->session->userdata['id']);
			$data['all_card_tasks_completed'] = $this->model_tasks->get_all_tasks_card($id_project_tasks,"3",$this->session->userdata['id']);

			$data['id_project_tasks'] = $id_project_tasks;

			$this->load->view('view-my-project', $data);
		}
	}
	public function view_card_tasks()
	{
		$id_project_tasks	= $this->input->post('id_project_tasks');
		$id_card_tasks		= $this->input->post('id_card_tasks');

		$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project_tasks, $id_card_tasks);

		$this->output->set_content_type('application/json')->set_output(json_encode($data)); 
	}
	public function create_card_tasks()
	{
		$id_project_tasks		= $this->input->post('id_project_tasks');
		$id_card_tasks			= $this->input->post('id_card_task');
		$name_card_tasks		= $this->input->post('name_card_tasks');
		$id_tasks_priority		= $this->input->post('id_tasks_priority');

		$this->model_tasks->create_card_tasks($id_project_tasks, $id_card_tasks, $name_card_tasks, $id_tasks_priority);

		$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project_tasks, $id_card_tasks);

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function create_task()
	{
		$id_project_tasks		= $this->input->post('id_project_tasks');
		$id_card_tasks			= $this->input->post('id_card_tasks');
		$nametask				= $this->input->post('nametask');
		$id_user				= $this->input->post('id_user');
		
		$this->model_tasks->create_task($id_project_tasks, $id_card_tasks, $nametask, $id_user);
	}
	public function create_tasks_status()
	{
		$id_website				= $this->input->post('id_website');

		$this->model_tasks->create_project($id_website, $nameproject, date("Y-m-d", strtotime($date_started)), date("Y-m-d", strtotime($date_deadline)));
	}
	public function check_tasks()
	{
		$id_project_tasks		= $this->input->post('id_project_tasks');
		$id_card_tasks			= $this->input->post('id_card_tasks');
		$id_task				= $this->input->post('id_task');
		$check_tasks			= $this->input->post('check_tasks');

		$this->model_tasks->update_check_task($id_project_tasks, $id_card_tasks, $id_task, $check_tasks);

		$this->model_tasks->update_check_card_completed($id_project_tasks, $id_card_tasks);

		$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project_tasks, $id_card_tasks);

		$this->output->set_content_type('application/json')->set_output( json_encode($data)); 
	}
}
