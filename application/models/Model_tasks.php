<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tasks extends CI_Model {
	
	function get_all_projects()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks__project')
				 ->join('470websitesmanagement_website', '470websitesmanagement_tasks__project.id_website = 470websitesmanagement_website.id_website');

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			$value->percentage_tasks = $this->get_percentage($value->id_project_tasks)->row()->percentage;
			$value->users_to_project = $this->get_users_to_project($value->id_project_tasks)->result();
		}
		return $query;
	}
	function get_all_tasks_card($id_project_tasks, $id_tasks_status = "", $id_user = "")
	{
			$this->db->select('*')
					->from('470websitesmanagement_tasks__card')
					->join('470websitesmanagement_tasks__status', '470websitesmanagement_tasks__card.id_tasks_status = 470websitesmanagement_tasks__status.id_tasks_status')
					->join('470websitesmanagement_tasks__priority', '470websitesmanagement_tasks__card.id_tasks_priority = 470websitesmanagement_tasks__priority.id_tasks_priority')
					->where('470websitesmanagement_tasks__card.id_project_tasks', $id_project_tasks);
					
			if (!empty($id_tasks_status)) {
				$this->db->where('470websitesmanagement_tasks__card.id_tasks_status', $id_tasks_status);
				$this->db->where('id_card_tasks IN (SELECT id_card_tasks 
                   FROM 470websitesmanagement_tasks 
                   WHERE 470websitesmanagement_tasks.id_project_tasks = '.$id_project_tasks.'
                   AND 470websitesmanagement_tasks.id_user = '.$id_user.')');
			}

			$query = $this->db->get();			
			if (!empty($id_user)) {
				foreach ($query->result() as $value) {
					$value->count_tasks_check_per_card = $this->get_tasks_user_per_card_task($id_project_tasks,$value->id_card_tasks, $id_user,1)->num_rows();
					$value->count_tasks_per_card = $this->get_tasks_user_per_card_task($id_project_tasks,$value->id_card_tasks, $id_user)->num_rows();
				}
			}

			return $query;
	}
	private function get_tasks_user_per_card_task($id_project_tasks,$id_card_tasks,$id_user="",$check_tasks="")
	{
		$this->db->select('*')
				->from('470websitesmanagement_tasks')
				->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_card_tasks', $id_card_tasks)
				->order_by("470websitesmanagement_tasks.id_card_tasks", "asc");
		
		if (!empty($id_user)) {
			$this->db->where('470websitesmanagement_tasks.id_user', $id_user);
		}
		if (!empty($check_tasks)) {
			$this->db->where('470websitesmanagement_tasks.check_tasks', $check_tasks);
		}

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks($id_project_tasks)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks')
				 ->join('470websitesmanagement_tasks__card', '470websitesmanagement_tasks__card.id_card_tasks = 470websitesmanagement_tasks.id_card_tasks')
				 ->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				 ->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks); 

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks_hours_to_user($id_project_tasks,$id_card_tasks,$id_user)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks')
				 ->join('470websitesmanagement_tasks__hours', '470websitesmanagement_tasks.id_task = 470websitesmanagement_tasks__hours.id_task')
				 ->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				 ->where('470websitesmanagement_tasks.id_card_task', $id_card_tasks)
				 ->where('470websitesmanagement_tasks.id_user', $id_user); 

		$query = $this->db->get();
		return $query;
	}
	function count_tasks_per_user($id_user)
	{
		$this->db->select('count(*) as count_tasks_per_user')
				 ->from('470websitesmanagement_tasks')
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->where_in('check_tasks', "0"); 

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks_status()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks__status');

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks_priority()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks__priority');

		$query = $this->db->get();
		return $query;
	}
	function get_percentage($id_project_tasks)
	{
		$this->db->select('ROUND(SUM(CASE WHEN check_tasks = "1" THEN 1 ELSE 0 END)/count(*)*100,0) as percentage')
				->from('470websitesmanagement_tasks')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks);

		$query = $this->db->get();
		return $query;
	}
	function get_users_to_project($id_project_tasks)
	{
		$this->db->select('470websitesmanagement_users.username')
				->from('470websitesmanagement_tasks')
				->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->group_by('470websitesmanagement_tasks.id_user');

		$query = $this->db->get();
		return $query;
	}
	function get_all_projects_to_user($id_user)
	{
		$this->db->select('470websitesmanagement_tasks__project.id_project_tasks, 470websitesmanagement_tasks__project.name_project_tasks, name_website, started_project_tasks, deadline_project_tasks')
				 ->from('470websitesmanagement_tasks__project')
				 ->join('470websitesmanagement_tasks', '470websitesmanagement_tasks.id_project_tasks = 470websitesmanagement_tasks__project.id_project_tasks')
				 ->join('470websitesmanagement_website', '470websitesmanagement_tasks__project.id_website = 470websitesmanagement_website.id_website')
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->group_by(array('470websitesmanagement_tasks__project.id_project_tasks', '470websitesmanagement_tasks__project.name_project_tasks'));

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			/*		var_dump($value->id_project_tasks);*/
			$value->percentage_tasks = $this->get_percentage_user($value->id_project_tasks, $id_user)->row()->percentage;
			$value->priority_project_tasks = $this->get_all_tasks_priority_to_user($id_user, $value->id_project_tasks)->row();
		}
		return $query;
	}
	function get_all_tasks_priority_to_user($id_user,$id_project_tasks="")
	{
		$this->db->select('SUM(CASE WHEN id_tasks_priority = "1" THEN 1 ELSE 0 END) as all_tasks_low_user, SUM(IF(id_tasks_priority = "2", 1,0)) as all_tasks_medium_user, SUM(IF(id_tasks_priority = "3", 1,0)) as all_tasks_hight_user, SUM(IF(id_tasks_priority = "4", 1,0)) as all_tasks_critical_user')
				 ->from('470websitesmanagement_tasks__card')
				 ->where_in('470websitesmanagement_tasks__card.id_tasks_status', array('1', '2'))
				 ->where('id_card_tasks IN (SELECT id_card_tasks 
                   FROM 470websitesmanagement_tasks 
                   WHERE  470websitesmanagement_tasks.id_user = '.$id_user.')');
		if (!empty($id_project_tasks)) {
			$this->db->where('470websitesmanagement_tasks__card.id_project_tasks', $id_project_tasks);
		}

		$query = $this->db->get();
		return $query;
	}
	function get_percentage_user($id_project_tasks,$id_user)
	{
		$this->db->select('ROUND(SUM(CASE WHEN check_tasks = "1" THEN 1 ELSE 0 END)/count(*)*100,0) as percentage')
				->from('470websitesmanagement_tasks')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_user', $id_user);

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks_per_users()
	{
		$this->db->select('count(*) as all_tasks_user, 470websitesmanagement_tasks.id_user, 470websitesmanagement_users.username, 470websitesmanagement_users.email, SUM(IF(check_tasks = "0", 1,0)) as all_tasks_progress_user, SUM(IF(check_tasks = "1", 1,0)) as all_tasks_completed_user')
				 ->from('470websitesmanagement_tasks')
				 ->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				 ->group_by(array('470websitesmanagement_tasks.id_user','470websitesmanagement_users.username'));

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			$value->priority_project_tasks = $this->get_all_tasks_priority_to_user($value->id_user)->row();
		}
		return $query;
	}
	function get_all_tasks_priority_per_users($id_project_tasks,$id_user=1)
	{
		$this->db->select('SUM(CASE WHEN id_tasks_priority = "1" THEN 1 ELSE 0 END) as all_tasks_low_user, SUM(IF(id_tasks_priority = "2", 1,0)) as all_tasks_medium_user, SUM(IF(id_tasks_priority = "3", 1,0)) as all_tasks_hight_user, SUM(IF(id_tasks_priority = "4", 1,0)) as all_tasks_critical_user')
				 ->from('470websitesmanagement_tasks__card')
				 ->from('470websitesmanagement_tasks')
				 ->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				 ->where('470websitesmanagement_tasks.id_user', $id_user);

		$query = $this->db->get();
		return $query;
	}
	function get_project($id_project_tasks)
	{
		$this->db->select('*')
				->from('470websitesmanagement_tasks__project')
				->join('470websitesmanagement_website', '470websitesmanagement_tasks__project.id_website = 470websitesmanagement_website.id_website')
				->where('id_project_tasks', $id_project_tasks)
				->limit(1);

		$query = $this->db->get();
		return $query->row();
	}
	function get_card_tasks($id_project_tasks, $id_card_tasks)
	{
		$this->db->select('*')
			->from('470websitesmanagement_tasks__card')
			->join('470websitesmanagement_tasks__status', '470websitesmanagement_tasks__card.id_tasks_status = 470websitesmanagement_tasks__status.id_tasks_status')
			->join('470websitesmanagement_tasks__priority', '470websitesmanagement_tasks__card.id_tasks_priority = 470websitesmanagement_tasks__priority.id_tasks_priority')
			->where('470websitesmanagement_tasks__card.id_project_tasks', $id_project_tasks)
			->where('470websitesmanagement_tasks__card.id_card_tasks', $id_card_tasks)
			->limit(1);

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			$value->count_tasks_check_per_card = $this->get_tasks_user_per_card_task($id_project_tasks,$value->id_card_tasks,"",1)->num_rows();
			$value->count_tasks_per_card = $this->get_tasks_user_per_card_task($id_project_tasks,$value->id_card_tasks)->num_rows();
			if ($this->get_tasks_per_list_task($id_project_tasks,$id_card_tasks)->result()) {
				$value->tasks = $this->get_tasks_per_list_task($id_project_tasks,$id_card_tasks)->result();
			} else {
				$value->tasks = null;
			}
		}
		return $query->row();
	}
/*	function get_percentage_per_tasks($id_project_tasks,$id_card_tasks)
	{
		$this->db->select('IFNULL(SUM(CASE WHEN check_tasks = "1" THEN 1 ELSE 0 END),0) as count_tasks_completed')
				->from('470websitesmanagement_tasks')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_card_tasks', $id_card_tasks);

		$query = $this->db->get();
		return $query;
	}*/
	private function get_tasks_per_list_task($id_project_tasks,$id_list_task)
	{
		$this->db->select('*')
				->from('470websitesmanagement_tasks')
				->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_card_tasks', $id_list_task)
				->order_by("470websitesmanagement_tasks.id_card_tasks", "asc");

		$query = $this->db->get();
		return $query;
	}
/*************/
/***Update****/
/*************/
	function create_project($w_id_info, $name_project_tasks, $date_started, $date_deadline)
	{
		$query = $this->db->get('470websitesmanagement_tasks__project');
		$data = array(
			'id_website'				=> $w_id_info,
			'name_project_tasks'		=> $name_project_tasks,
			'started_project_tasks	'	=> $date_started,
			'deadline_project_tasks'	=> $date_deadline
		);

		$this->db->insert('470websitesmanagement_tasks__project', $data);
		return $this->db->insert_id();
	}
	function update_project($id_project_tasks, $name_project_tasks, $date_started, $date_deadline)
	{
		$data = array(
			'id_project_tasks'			=> $id_project_tasks,
			'name_project_tasks'		=> $name_project_tasks,
			'started_project_tasks'		=> $date_started,
			'deadline_project_tasks'	=> $date_deadline
		);

		$this->db->where('id_project_tasks', $id_project_tasks)
				 ->update('470websitesmanagement_tasks__project', $data);
	}
	function delete_project($id_project_tasks)
	{
		$this->db->where('id_project_tasks', $id_project_tasks)->delete('470websitesmanagement_tasks__project');
	}
	function create_card_tasks($id_project_tasks, $id_card_tasks, $name_card_tasks, $id_tasks_priority)
	{
		if ($id_card_tasks=="") {
			$this->db->select_max('id_card_tasks');
			$this->db->where('id_project_tasks', $id_project_tasks); 
			$query = $this->db->get('470websitesmanagement_tasks__card');
			$data = array(
				'id_card_tasks'			=> $query->row()->id_card_tasks+1,
				'id_project_tasks'		=> $id_project_tasks,
				'name_card_tasks'		=> $name_card_tasks,
				'id_tasks_priority'		=> $id_tasks_priority,
				'id_tasks_status'		=> "1"
			);
		} else {
			$this->db->where('id_project_tasks', $id_project_tasks);
			$this->db->where('id_card_tasks  >=', $id_card_tasks); 
			$query = $this->db->get('470websitesmanagement_tasks__card');

			foreach (array_reverse($query->result()) as $value) {
				$this->update_card_tasks($value->id_project_tasks, $value->id_card_tasks, $value->name_card_tasks, $value->description_card_tasks, $value->id_tasks_priority, $value->id_tasks_status, +1);
			}

			$data = array(
				'id_card_tasks'			=> $id_card_tasks,
				'id_project_tasks'		=> $id_project_tasks,
				'name_card_tasks'		=> $name_card_tasks,
				'id_tasks_priority'		=> $id_tasks_priority,
				'id_tasks_status'		=> "1"
			);
		}
		$this->db->insert('470websitesmanagement_tasks__card', $data);
		return $this->db->insert_id();
	}
	function update_card_tasks($id_project_tasks, $id_card_tasks, $name_card_tasks, $description_card_tasks, $id_tasks_priority, $id_tasks_status, $check_change_order=null)
	{
		$data = array(
			'id_card_tasks'				=> $id_card_tasks+$check_change_order,
			'name_card_tasks'			=> $name_card_tasks,
			'description_card_tasks'	=> $description_card_tasks,
			'id_tasks_priority'			=> $id_tasks_priority,
			'id_tasks_status'			=> $id_tasks_status
		);

		$this->db->where('id_project_tasks', $id_project_tasks)
				->where('id_card_tasks', $id_card_tasks)
				->update('470websitesmanagement_tasks__card', $data);
	}
	function update_check_card_completed($id_project_tasks, $id_card_tasks)
	{
		$this->db->select('SUM(CASE WHEN check_tasks = 1 THEN 1 ELSE 0 END) as check_card_completed, count(*) as count_tasks_per_card')
				->from('470websitesmanagement_tasks')
				->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_card_tasks', $id_card_tasks);

		$query = $this->db->get()->row();

		if ($query->check_card_completed==$query->count_tasks_per_card) {
			$data = array(
				'id_tasks_status' => 3
			);

			$this->db->where('id_project_tasks', $id_project_tasks)
					->where('id_card_tasks', $id_card_tasks)
					->update('470websitesmanagement_tasks__card', $data);
		} else {
			$data = array(
				'id_tasks_status' => 1
			);

			$this->db->where('id_project_tasks', $id_project_tasks)
					->where('id_card_tasks', $id_card_tasks)
					->update('470websitesmanagement_tasks__card', $data);
		}
	}
	function delete_card_tasks($id_project_tasks, $id_card_tasks)
	{
		$this->db->where('id_project_tasks', $id_project_tasks);
		$this->db->where('id_card_tasks', $id_card_tasks);
		$this->db->delete('470websitesmanagement_tasks__card');

		$this->db->where('id_project_tasks', $id_project_tasks);
		$this->db->where('id_card_tasks  >=', $id_card_tasks); 
		$query = $this->db->get('470websitesmanagement_tasks__card');

		foreach ($query->result() as $value) {
			$this->update_card_tasks($value->id_project_tasks, $value->id_card_tasks, $value->name_card_tasks, $value->description_card_tasks, $value->id_tasks_priority, $value->id_tasks_status, -1);
		}
	}
	function create_task($id_project_tasks, $id_card_tasks, $nametask, $iduser)
	{
		$this->db->select_max('id_task');
		$this->db->where('id_project_tasks', $id_project_tasks);
		$this->db->where('id_card_tasks', $id_card_tasks);
		$query = $this->db->get('470websitesmanagement_tasks');
		$data = array(
			'id_task'				=> $query->row()->id_task+1,
			'id_project_tasks'		=> $id_project_tasks,
			'id_card_tasks'			=> $id_card_tasks,
			'name_task'				=> $nametask,
			'check_tasks'			=> '0',
			'id_user'				=> $iduser
		);

		$this->db->insert('470websitesmanagement_tasks', $data);
		return $this->db->insert_id();
	}
	function update_task($id_project_tasks, $id_card_tasks, $id_task, $name_task, $check_tasks, $iduser)
	{
		$data = array(
			'name_task'		=> $name_task,
			'check_tasks'	=> $check_tasks,
			'iduser'		=> $iduser
		);

		$this->db->where('id_project_tasks', $id_project_tasks)
				->where('id_card_tasks', $id_card_tasks)
				->where('id_task', $id_task)
				->update('470websitesmanagement_tasks', $data);
	}
	function update_check_task($id_project_tasks, $id_card_tasks, $id_task, $check_tasks)
	{
		$data = array(
			'check_tasks'	=> $check_tasks,
		);

		$this->db->where('id_project_tasks', $id_project_tasks)
				->where('id_card_tasks', $id_card_tasks)
				->where('id_task', $id_task)
				->update('470websitesmanagement_tasks', $data);
	}
	function delete_tasks($id_project_tasks, $id_card_tasks, $id_task)
	{
		$this->db->where('id_project_tasks', $id_project_tasks);
		$this->db->where('id_card_tasks', $id_card_tasks);
		$this->db->where('id_task', $id_task);
		$this->db->delete('470websitesmanagement_tasks');
	}
}