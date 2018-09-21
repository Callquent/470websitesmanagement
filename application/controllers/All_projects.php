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
				$list['value'] = strip_tags($row->id);
				$list['label'] = strip_tags($row->name_user);

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
		$id_project_tasks			= $this->input->post('idproject');
		$id_card_tasks		= $this->input->post('idcard');

		$data['card_tasks'] = $this->model_tasks->get_card_tasks($id_project_tasks, $id_card_tasks);

		$data['title_card_tasks'] = $data['card_tasks']->title_card_tasks;

		if (isset($data['card_tasks']->tasks)) {
			foreach ($data['card_tasks']->tasks as $key => $row)
			{
				$list = array();
				if ($row->check_tasks==0) {
					$list[] = '<label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input checkbox-task" name="idtask" value="'.$row->id_task.'">
                                    <span class="custom-control-indicator fuse-ripple-ready"></span>
                                </label>';
				} else{
					$list[] = '<label class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input checkbox-task" name="idtask" value="'.$row->id_task.'" checked>
                                    <span class="custom-control-indicator fuse-ripple-ready"></span>
                                </label>';
				}
				$list[] = $row->name_task;
				$list[] = $row->username;
				$list[] = '<div class="dropdown show actions">
							<a class="btn btn-icon fuse-ripple-ready" href="javascript:void(0);" role="button" data-toggle="dropdown" >
								<i class="icon icon-dots-vertical"></i>
							</a>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
								<a class="dropdown-item" id="edit-dashboard" href="'.site_url('all-projects/edit-projects/'.$row->id_task).'"><i class="fa fa-pencil"></i> '.lang('edit').'</a>
								<a class="dropdown-item" id="delete-dashboard" href="'.site_url('all-projects/delete-projects/'.$row->id_task).'"><i class="fa fa-trash"></i> '.lang('delete').'</a>
							</div>
						</div>';
				$list_tasks_preview[] = $list;
			}
			$data['list_tasks_preview'] = $list_tasks_preview;
		}
		$this->output->set_content_type('application/json')->set_output( json_encode($data)); 

	}
	public function delete_card_tasks()
	{
		$id_project_tasks		= $this->input->post('idproject');
		$id_card_tasks		= $this->input->post('idcard');

		$this->model_tasks->delete_card_tasks($id_project_tasks,$id_card_tasks);
	}
	public function create_card_tasks($id_project_tasks = '')
	{
		$id_card_tasks			= $this->input->post('idlisttasks');
		$title_list_task			= $this->input->post('titlelisttasks');

		$this->model_tasks->create_list_tasks($id_project_tasks, $id_card_tasks, $title_list_task);
	}
	public function create_task()
	{
		$id_project_tasks		= $this->input->post('id_project');
		$id_card_tasks			= $this->input->post('id_card_tasks');
		$nametask				= $this->input->post('nametask');
		$user					= $this->input->post('user');
		
		$iduser = $this->model_users->get_user_id($user)->id;

		$this->model_tasks->create_task($id_project_tasks, $id_card_tasks, $nametask, $iduser);
	}
	public function check_tasks()
	{
		$id_project_tasks		= $this->input->post('id_project');
		$id_card_tasks			= $this->input->post('id_card_tasks');
		$id_task				= $this->input->post('id_task');
		$check_tasks			= $this->input->post('check_tasks');

		$this->model_tasks->update_check_task($id_project_tasks, $id_card_tasks, $id_task, $check_tasks);

		$this->model_tasks->update_check_card_completed($id_project_tasks, $id_card_tasks);
	}
	public function edit_tasks($id_project_tasks = '')
	{
		$id_card_tasks			= $this->input->post('id_card_tasks');
		$idtask					= $this->input->post('idtask');
		$nametask				= $this->input->post('titletask');
		$check_tasks			= $this->input->post('check_tasks');
		$iduser					= $this->input->post('user');

		if ($this->form_validation->run() !== FALSE){
			$this->model_tasks->update_task($id_project_tasks, $id_card_tasks, $idtask, $name_task, $check_tasks, $iduser);
		}
	}
}
