<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_projects extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_tasks');
		$this->load->model('model_users');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','form_validation', 'encrypt', 'session'));
		$this->load->helper(array('functions', 'text', 'url','language','date'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
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
		
		$data['list_users'] = $this->model_users->get_all_users();
		$data['list_groups'] = $this->model_users->get_all_groups();

		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		/*$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();*/


		if($this->uri->total_segments() == 1){
			$data['all_projects'] = $this->model_tasks->get_all_projects();

			$this->load->view('all-projects', $data);
		} elseif($this->uri->total_segments() == 2) {
			foreach ($data['list_users']->result() as $row)
			{
				$list = array();
				$list['value'] = strip_tags($row->name_user);
				$list['data'] = strip_tags($row->id);

				$data['users'][] = $list;
			}
			$data['project'] = $this->model_tasks->get_project($id_project_tasks);

			$data['datetimestart'] = past_time_project($id_project_tasks);
			$data['datetimedeadline'] = remaining_time_project($id_project_tasks);
			$data['percentage_project'] = $this->model_tasks->get_percentage($id_project_tasks)->row();

			$data['all_tasks_status'] = $this->model_tasks->get_all_tasks_status();
			$data['all_tasks_priority'] = $this->model_tasks->get_all_tasks_priority();

			$data['all_card_tasks'] = $this->model_tasks->get_list_tasks_per_project($id_project_tasks);
			$data['all_card_tasks_to_do'] = $this->model_tasks->get_list_tasks_per_project($id_project_tasks,"1");
			$data['all_card_tasks_in_progress'] = $this->model_tasks->get_list_tasks_per_project($id_project_tasks,"2");
			$data['all_card_tasks_completed'] = $this->model_tasks->get_list_tasks_per_project($id_project_tasks,"3");
			
			$data['all_users_to_project'] = $this->model_tasks->get_users_to_project($id_project_tasks);

			$this->load->view('view-project', $data);
		}
	}
	public function create_projects()
	{
		$website_id				= $this->input->post('websites');
		$nameproject			= $this->input->post('nameproject');
		$date_started			= $this->input->post('datestarted');
		$date_deadline			= $this->input->post('datedeadline');

		$this->model_tasks->create_project($website_id, $nameproject, date("Y-m-d", strtotime($date_started)), date("Y-m-d", strtotime($date_deadline)));
	}
	public function edit_projects($id_project = '')
	{
		$name_project			= $this->input->post('nameproject');
		$started_project			= $this->input->post('startedproject');
		$deadline_project				= $this->input->post('deadlineproject');

		/*if ($this->form_validation->run() !== FALSE){*/
			$this->model_tasks->update_project($id_project, $name_project, date("Y-m-d", strtotime($started_project)), date("Y-m-d", strtotime($deadline_project)));
		/*}*/
	}
	public function delete_project($id_project = '')
	{
		$this->model_tasks->delete_project($id_project);
	}
	public function view_card_tasks()
	{
		$id_project			= $this->input->post('idproject');
		$id_card_tasks		= $this->input->post('idcard');

		$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project, $id_card_tasks);

		foreach ($data['card_tasks']->tasks as $key => $row)
		{
			$list = array();
			$list[] = $row->check_tasks;
			$list[] = $row->name_task;
			$list[] = $row->username;
			$list_tasks_preview[] = $list;
		}

		echo json_encode($list_tasks_preview);
	}
	public function create_list_tasks($id_project_tasks = '')
	{
		$title_list_task			= $this->input->post('titlelisttasks');

		$this->model_tasks->create_list_tasks($id_project_tasks, $title_list_task);
	}
	public function create_task($id_project_tasks = '')
	{
		$idlisttasks			= $this->input->post('idlisttasks');
		$nametask				= $this->input->post('titletask');
		$iduser					= $this->input->post('user');

		$this->model_tasks->create_task($id_project_tasks, $idlisttasks, $nametask, $iduser);
	}
	public function edit_tasks($id_project_tasks = '')
	{
		$idlisttasks			= $this->input->post('idlisttasks');
		$idtask					= $this->input->post('idtask');
		$nametask				= $this->input->post('titletask');
		$check_tasks			= $this->input->post('check_tasks');
		$iduser					= $this->input->post('user');

		if ($this->form_validation->run() !== FALSE){
			$this->model_back->update_tasks($id_project_tasks, $idlisttasks, $idtask, $name_task, $check_tasks, $iduser);
		}
	}
}
