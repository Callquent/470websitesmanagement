<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_tasks extends CI_Controller {

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

		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
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
			$data['all_card_tasks_to_do'] = $this->model_tasks->get_all_tasks_card($id_project_tasks,"1","8");
			$data['all_card_tasks_in_progress'] = $this->model_tasks->get_all_tasks_card($id_project_tasks,"2","8");
			$data['all_card_tasks_completed'] = $this->model_tasks->get_all_tasks_card($id_project_tasks,"3","8");

			$data['id_project_tasks'] = $id_project_tasks;

			$this->load->view('view-my-project', $data);
		}
	}
	public function view_card_tasks()
	{
		$id_project_tasks	= $this->input->post('id_project_tasks');
		$id_card_tasks		= $this->input->post('id_card_tasks');

		$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project_tasks, $id_card_tasks);

		$this->output->set_content_type('application/json')->set_output( json_encode($data)); 
	}
	public function create_tasks_status()
	{
		$id_website				= $this->input->post('id_website');

		$this->model_tasks->create_project($id_website, $nameproject, date("Y-m-d", strtotime($date_started)), date("Y-m-d", strtotime($date_deadline)));
	}
}
