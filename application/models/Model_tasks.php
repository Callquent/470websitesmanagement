<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tasks extends CI_Model {
	
	function get_all_projects()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_project_tasks')
				 ->join('470websitesmanagement_website', '470websitesmanagement_project_tasks.id_website = 470websitesmanagement_website.w_id');

		$query = $this->db->get();
		return $query;
	}
	function get_project($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_project_tasks')
				->where('id_project_tasks', $id)
				->limit(1);

		$query = $this->db->get();
		return $query->row();
	}
	function get_percentage($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_tasks')
				->where('id_project_tasks', $id)
				->where_in('id_tasks_status', array(2,3));

		$query = $this->db->get();
		return $query;
	}
	function get_all_list_tasks()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_list_tasks');

		$query = $this->db->get();
		return $query;
	}
	function get_list_tasks_per_project($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_list_tasks')
				->where('id_project_tasks', $id);

		$query = $this->db->get();
		return $query;
	}
	function create_projects_websites($w_id_info, $title_project_tasks, $date_started, $date_deadline)
	{
		$query = $this->db->get('470websitesmanagement_project_tasks');
		$data = array(
			'id_website'				=> $w_id_info,
			'title_project_tasks'		=> $title_project_tasks,
			'started_project_tasks	'	=> $date_started,
			'deadline_project_tasks'	=> $date_deadline
		);

		$this->db->insert('470websitesmanagement_project_tasks', $data);
		return $this->db->insert_id();
	}
	function create_list_tasks($id_project_tasks, $title_list_task)
	{
		$this->db->select_max('id_list_tasks');
		$this->db->where('id_project_tasks', $id_project_tasks); 
		$query = $this->db->get('470websitesmanagement_list_tasks');
		$data = array(
			'id_list_tasks'			=> $query->row()->id_list_tasks+1,
			'id_project_tasks'		=> $id_project_tasks,
			'title_list_task'		=> $title_list_task
		);

		$this->db->insert('470websitesmanagement_list_tasks', $data);
		return $this->db->insert_id();
	}
	function create_task($id_project_tasks, $idlisttasks, $titletask, $descriptiontask, $idtaskpriority, $idtaskstatus, $iduser)
	{
		$this->db->select_max('id_task');
		$this->db->where('id_project_tasks', $id_project_tasks); 
		$this->db->where('id_list_tasks', $idlisttasks);
		$query = $this->db->get('470websitesmanagement_tasks');
		$data = array(
			'id_task'				=> $query->row()->id_task+1,
			'id_project_tasks'		=> $id_project_tasks,
			'id_list_tasks'			=> $idlisttasks,
			'name_task'				=> $titletask,
			'description_task'		=> $descriptiontask,
			'id_tasks_priority'		=> $idtaskpriority,
			'id_tasks_status'		=> $idtaskstatus,
			'id_user'				=> $iduser
		);

		$this->db->insert('470websitesmanagement_tasks', $data);
		return $this->db->insert_id();
	}
	function get_all_tasks($id_project_tasks)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks')
				 ->join('470websitesmanagement_list_tasks', '470websitesmanagement_list_tasks.id_list_tasks = 470websitesmanagement_tasks.id_list_tasks')
				 ->join('470websitesmanagement_tasks_priority', '470websitesmanagement_tasks_priority.id_tasks_priority = 470websitesmanagement_tasks.id_tasks_priority')
				 ->join('470websitesmanagement_tasks_status', '470websitesmanagement_tasks_status.id_tasks_status = 470websitesmanagement_tasks.id_tasks_status')
				 ->join('aauth_users', 'aauth_users.id = 470websitesmanagement_tasks.id_user')
				 ->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks); 

		$query = $this->db->get();
		return $query;

/*				$results = array();
		var_dump($query->result());
		foreach($query->result() as $row) {

			$object_id_list_tasks = new stdClass();
			$object_id_list_tasks->id_list_tasks = $row->id_list_tasks;
			$object_id_list_tasks->title_list_task = $row->title_list_task;


			$object = new stdClass();
			$object->id_task = $row->id_task;
			$object->id_project_tasks = $row->id_project_tasks;
			$object->id_list_tasks = $row->id_list_tasks;
			$object->name_task = $row->name_task;
			$object->description_task = $row->description_task;
			$object->id_tasks_priority =$row->id_tasks_priority;
			$object->id_tasks_status = $row->id_tasks_status;
			$object->id_user = $row->id_user;


			
			$toto[$row->id_list_tasks]['id'] = $object_id_list_tasks;
			$toto[$row->id_list_tasks][] = $object;

		


			$results = $toto;
		}*/
	}
	function get_all_tasks_status()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks_status');

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks_priority()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks_priority');

		$query = $this->db->get();
		return $query;
	}
}