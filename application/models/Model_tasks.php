<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tasks extends CI_Model {
	
	function get_all_projects()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_project_tasks')
				 ->join('470websitesmanagement_website', '470websitesmanagement_project_tasks.id_website = 470websitesmanagement_website.w_id');

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			$value->percentage_tasks = $this->get_percentage($value->id_project_tasks)->row()->percentage;
		}
		return $query;
	}
	function get_percentage($id_project_tasks)
	{
		$this->db->select('ROUND(SUM(CASE WHEN id_tasks_status = "2" OR id_tasks_status = "3" THEN 1 ELSE 0 END)/count(*)*100,0) as percentage')
				->from('470websitesmanagement_tasks')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks);

		$query = $this->db->get();
		return $query;
	}
	function get_all_projects_to_user($id_user)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_project_tasks')
				 ->join('470websitesmanagement_tasks', '470websitesmanagement_tasks.id_project_tasks = 470websitesmanagement_project_tasks.id_project_tasks')
				 ->join('470websitesmanagement_website', '470websitesmanagement_project_tasks.id_website = 470websitesmanagement_website.w_id')
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->group_by(array('470websitesmanagement_project_tasks.id_project_tasks', '470websitesmanagement_project_tasks.title_project_tasks'));

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			$value->percentage_tasks = $this->get_percentage_user($value->id_project_tasks, $id_user)->row()->percentage;
		}
		return $query;
	}
	function get_percentage_user($id_project_tasks,$id_user)
	{
		$this->db->select('ROUND(SUM(CASE WHEN id_tasks_status = "2" OR id_tasks_status = "3" THEN 1 ELSE 0 END)/count(*)*100,0) as percentage')
				->from('470websitesmanagement_tasks')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_user', $id_user);

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks_per_users()
	{
		$this->db->select('count(*) as all_tasks_user, aauth_users.username, aauth_users.email, SUM(IF(id_tasks_status = "1", 1,0)) as all_tasks_progress_user, SUM(IF(id_tasks_status = "2", 1,0)) as all_tasks_completed_user')
				 ->from('470websitesmanagement_tasks')
				 ->join('aauth_users', 'aauth_users.id = 470websitesmanagement_tasks.id_user')
				 ->group_by(array('470websitesmanagement_tasks.id_user','aauth_users.username'));

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks_priority_per_users($id_project_tasks,$id_user=1)
	{
		$this->db->select('SUM(IF(id_tasks_priority = "1", 1,0)) as all_tasks_progress_user, SUM(IF(id_tasks_priority = "2", 1,0)) as all_tasks_completed_user')
				 ->from('470websitesmanagement_tasks')
				 ->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				 ->where('470websitesmanagement_tasks.id_user', $id_user);

		$query = $this->db->get();
		var_dump($query->result());
		return $query;
	}
	private function get_tasks_inprogress_to_user($id_user)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_project_tasks')
				 ->join('470websitesmanagement_tasks', '470websitesmanagement_tasks.id_project_tasks = 470websitesmanagement_project_tasks.id_project_tasks')
				 ->join('470websitesmanagement_website', '470websitesmanagement_project_tasks.id_website = 470websitesmanagement_website.w_id')
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->group_by(array('470websitesmanagement_project_tasks.id_project_tasks', '470websitesmanagement_project_tasks.title_project_tasks'));

		$query = $this->db->get();
		return $query;
	}
	function get_project($id_project_tasks)
	{
		$this->db->select('*')
				->from('470websitesmanagement_project_tasks')
				->where('id_project_tasks', $id_project_tasks)
				->limit(1);

		$query = $this->db->get();
		return $query->row();
	}
	function get_all_list_tasks()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_list_tasks');

		$query = $this->db->get();
		return $query;
	}
	function get_list_tasks_per_project($id_project_tasks,$id_user = "")
	{
	    	$this->db->select('*')
					->from('470websitesmanagement_project_tasks')
					->join('470websitesmanagement_list_tasks', '470websitesmanagement_project_tasks.id_project_tasks = 470websitesmanagement_list_tasks.id_project_tasks')
					->where('470websitesmanagement_list_tasks.id_project_tasks', $id_project_tasks);
			$query = $this->db->get();
			if (empty($id_user)) {
				foreach ($query->result() as $value) {
					$value->tasks = $this->get_tasks_per_list_task($id_project_tasks,$value->id_list_tasks)->result();
				}
			} else {
				foreach ($query->result() as $value) {
					$value->tasks = $this->get_tasks_user_per_list_task($id_project_tasks,$value->id_list_tasks, $id_user)->result();
				}
			}

			return $query;
	}
	private function get_tasks_per_list_task($id_project_tasks,$id_list_task)
	{
		$this->db->select('*')
				->from('470websitesmanagement_tasks')
				->join('470websitesmanagement_tasks_priority', '470websitesmanagement_tasks_priority.id_tasks_priority = 470websitesmanagement_tasks.id_tasks_priority')
				->join('470websitesmanagement_tasks_status', '470websitesmanagement_tasks_status.id_tasks_status = 470websitesmanagement_tasks.id_tasks_status')
				->join('aauth_users', 'aauth_users.id = 470websitesmanagement_tasks.id_user')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_list_tasks', $id_list_task)
				->order_by("470websitesmanagement_tasks.id_list_tasks", "asc");

		$query = $this->db->get();
		return $query;
	}
	private function get_tasks_user_per_list_task($id_project_tasks,$id_list_task,$id_user)
	{
		$this->db->select('*')
				->from('470websitesmanagement_tasks')
				->join('470websitesmanagement_tasks_priority', '470websitesmanagement_tasks_priority.id_tasks_priority = 470websitesmanagement_tasks.id_tasks_priority')
				->join('470websitesmanagement_tasks_status', '470websitesmanagement_tasks_status.id_tasks_status = 470websitesmanagement_tasks.id_tasks_status')
				->join('aauth_users', 'aauth_users.id = 470websitesmanagement_tasks.id_user')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_list_tasks', $id_list_task)
				->where('470websitesmanagement_tasks.id_user', $id_user)
				->order_by("470websitesmanagement_tasks.id_list_tasks", "asc");

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
	function count_tasks_per_user($id_user)
	{
		$this->db->select('count(*) as count_tasks_per_user')
				 ->from('470websitesmanagement_tasks')
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->where_in('id_tasks_status', "1"); 

		$query = $this->db->get();
		return $query;
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