<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_projects extends CI_Controller {

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


		if($this->uri->total_segments() == 1){
			$data['all_projects'] = $this->model_tasks->get_all_projects();

			$this->load->view('projects/all-projects', $data);
		} elseif($this->uri->total_segments() == 2) {
			$data['project'] = $this->model_tasks->get_project($id_project_tasks);

			$data['datetimestart'] = past_time_project($id_project_tasks);
			$data['datetimedeadline'] = remaining_time_project($id_project_tasks);
			$data['percentage_project'] = $this->model_tasks->get_percentage($id_project_tasks)->row();

			$data['all_tasks_status'] = $this->model_tasks->get_all_tasks_status();
			$data['all_tasks_priority'] = $this->model_tasks->get_all_tasks_priority();

			$data['all_card_tasks'] = $this->model_tasks->get_all_card_tasks_by_project($id_project_tasks);

			$data['card_tasks'] = $this->model_tasks->get_all_tasks_by_card($data['all_card_tasks']->row()->id_card_tasks);
			$data['order_card_tasks'] = $this->model_tasks->get_card_tasks_order_max($id_project_tasks);
			var_dump($data['order_card_tasks']);
			//$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project_tasks, $data['all_card_tasks']->row()->id_card_tasks);

			$this->load->view('projects/view-project', $data);
		}
	}
	public function create_project()
	{
		$id_website				= $this->input->post('id_website');
		$nameproject			= $this->input->post('name_project');
		$date_started			= $this->input->post('date_started');
		$date_deadline			= $this->input->post('date_deadline');

		$this->model_tasks->create_project($id_website, $nameproject, date("Y-m-d", strtotime($date_started)), date("Y-m-d", strtotime($date_deadline)));
	}
	public function edit_project()
	{
		$id_project				= $this->input->post('id_project');
		$name_project			= $this->input->post('name_project');
		$started_project			= $this->input->post('date_started');
		$deadline_project				= $this->input->post('date_deadline');

		/*if ($this->form_validation->run() !== FALSE){*/
			$this->model_tasks->update_project($id_project, $name_project, date("Y-m-d", strtotime($started_project)), date("Y-m-d", strtotime($deadline_project)));
		/*}*/
	}
	public function delete_project()
	{
		$id_project			= $this->input->post('id_project');

		$this->model_tasks->delete_project($id_project);
	}
	public function view_card_tasks()
	{
		$id_project_tasks	= $this->input->post('id_project_tasks');
		$id_card_tasks		= $this->input->post('id_card_tasks');

		$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project_tasks, $id_card_tasks);

		$data['name_card_tasks'] = $data['card_tasks']->name_card_tasks;

		$this->output->set_content_type('application/json')->set_output( json_encode($data)); 
	}
	public function create_card_tasks()
	{
		$id_project_tasks		= $this->input->post('id_project_tasks');
		$id_card_tasks			= $this->input->post('id_card_task');
		$name_card_tasks		= $this->input->post('name_card_tasks');
		$id_tasks_priority		= $this->input->post('id_tasks_priority');

		$this->model_tasks->create_card_tasks($id_project_tasks, $id_card_tasks, $name_card_tasks, $id_tasks_priority);
	}
	public function delete_card_tasks()
	{
		$id_project_tasks		= $this->input->post('id_project_tasks');
		$id_card_tasks		= $this->input->post('id_card_task');

		$this->model_tasks->delete_card_tasks($id_project_tasks,$id_card_tasks);
	}
	public function create_task()
	{
		$id_project_tasks		= $this->input->post('id_project_tasks');
		$id_card_tasks			= $this->input->post('id_card_tasks');
		$nametask				= $this->input->post('nametask');
		$id_user				= $this->input->post('id_user');
		
		$this->model_tasks->create_task($id_project_tasks, $id_card_tasks, $nametask, $id_user);
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
	public function edit_task($id_project_tasks = '')
	{
		$id_project_tasks	= $this->input->post('idproject');
		$id_card_tasks		= $this->input->post('idcard');
		$id_task			= $this->input->post('idtask');
		$nametask			= $this->input->post('titletask');
		$iduser				= $this->input->post('user');

		if ($this->form_validation->run() !== FALSE){
			$this->model_tasks->update_task($id_project_tasks, $id_card_tasks, $id_task, $name_task, $check_tasks, $iduser);
		}
	}
	public function delete_task()
	{
		$id_project_tasks	= $this->input->post('id_project_tasks');
		$id_card_tasks		= $this->input->post('id_card_tasks');
		$id_task			= $this->input->post('id_task');

		$this->model_tasks->delete_tasks($id_project_tasks,$id_card_tasks,$id_task);
	}
}
