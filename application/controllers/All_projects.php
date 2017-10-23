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
	}
	public function index($id_project_tasks = '')
	{
		if(check_access()==true)
		{
			$data['all_websites'] = $this->model_front->get_all_websites();
			
			$data['list_users'] = $this->model_users->get_all_users();
			$data['list_groups'] = $this->model_users->get_all_groups();

			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
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

				$data['all_list_tasks'] = $this->model_tasks->get_list_tasks_per_project($id_project_tasks);
				$data['id_project_tasks'] = $id_project_tasks;
				$this->load->view('all-tasks-project', $data);
			}



		} else {
			$this->load->view('index');
		}
	}
	public function create_projects()
	{
		if(check_access()==true)
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

		}else {
			$this->load->view('index');
		}
	}
	public function create_list_tasks($id_project_tasks = '')
	{
		if(check_access()==true)
		{
			$title_list_task			= $this->input->post('titlelisttasks');

			/*$this->form_validation->set_rules('nom', 'Nom', 'required');
			$this->form_validation->set_rules('url', 'Url', 'required');

			if ($this->form_validation->run() == TRUE){*/
				$this->model_tasks->create_list_tasks($id_project_tasks, $title_list_task);
			/*}*/

		}else {
			$this->load->view('index');
		}
	}
	public function create_task($id_project_tasks = '')
	{
		if(check_access()==true)
		{
			$idlisttasks			= $this->input->post('idlisttasks');
			$titletask				= $this->input->post('titletask');
			$prioritytask			= $this->input->post('prioritytask');

			/*$this->form_validation->set_rules('nom', 'Nom', 'required');
			$this->form_validation->set_rules('url', 'Url', 'required');

			if ($this->form_validation->run() == TRUE){*/
				$this->model_tasks->create_task($website_id, $titleproject, date("Y-m-d", strtotime($date_started)), date("Y-m-d", strtotime($date_deadline)));
			/*}*/

		}else {
			$this->load->view('index');
		}
	}
}
