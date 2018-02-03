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
		$data['all_websites'] = $this->model_front->get_all_websites();
		
		$data['list_users'] = $this->model_users->get_all_users();
		$data['list_groups'] = $this->model_users->get_all_groups();

		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();

		if($this->uri->total_segments() == 1){
			$data['all_projects'] = $this->model_tasks->get_all_projects();
			$this->load->view('all-projects', $data);
		} elseif($this->uri->total_segments() == 2) {
			$data['project'] = $this->model_tasks->get_project($id_project_tasks);

			$data['datetimestart'] = past_time_project($id_project_tasks);
			$data['datetimedeadline'] = remaining_time_project($id_project_tasks);
			$data['percentage'] = $this->model_tasks->get_percentage($id_project_tasks);

			$data['all_tasks_status'] = $this->model_tasks->get_all_tasks_status();
			$data['all_tasks_priority'] = $this->model_tasks->get_all_tasks_priority();

			$data['all_tasks'] = $this->model_tasks->get_all_tasks($id_project_tasks);
			$data['all_list_tasks'] = $this->model_tasks->get_list_tasks_per_project($id_project_tasks);
			$data['id_project_tasks'] = $id_project_tasks;

			if ( $data['percentage']->num_rows() == 0) {
				$data['percentage_all_tasks'] = 0;
			} else {
				$data['percentage_all_tasks'] = (($data['percentage']->num_rows()*100)/$data['all_tasks']->num_rows());
			}

			/*$data['percentage'] = $this->model_tasks->get_percentage($id_project_tasks, $id_project_tasks);
			$data['all_tasks'] = $this->model_tasks->get_all_tasks($id_project_tasks, $id_project_tasks);*/
			/*$data['percentage_all_tasks_per_list'] = (($data['percentage']->num_rows()*100)/$data['all_tasks']->num_rows());*/

			$this->load->view('all-tasks-project', $data);
		}
	}
	public function create_projects()
	{
		$website_id				= $this->input->post('websites');
		$titleproject			= $this->input->post('titleproject');
		$date_started			= $this->input->post('datestarted');
		$date_deadline			= $this->input->post('datedeadline');

		/*$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() == TRUE){*/
			$this->model_tasks->create_projects_websites($website_id, $titleproject, date("Y-m-d", strtotime($date_started)), date("Y-m-d", strtotime($date_deadline)));
		/*}*/
	}
	public function create_list_tasks($id_project_tasks = '')
	{
		$title_list_task			= $this->input->post('titlelisttasks');

		/*$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() == TRUE){*/
			$this->model_tasks->create_list_tasks($id_project_tasks, $title_list_task);
		/*}*/
	}
	public function create_task($id_project_tasks = '')
	{
		$idlisttasks			= $this->input->post('idlisttasks');
		$titletask				= $this->input->post('titletask');
		$descriptiontask		= $this->input->post('descriptiontask');
		$idtaskpriority			= $this->input->post('taskspriority');
		$idtaskstatus			= $this->input->post('tasksstatus');
		$iduser					= $this->input->post('user');

		/*$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() == TRUE){*/
			$this->model_tasks->create_task($id_project_tasks, $idlisttasks, $titletask, $descriptiontask, $idtaskpriority, $idtaskstatus, $iduser);
		/*}*/
	}
}
