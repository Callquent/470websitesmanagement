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
			$value->users_to_project = $this->get_users_to_project($value->id_project_tasks)->result();
		}
		return $query;
	}
	function get_all_list_tasks()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_card_tasks');

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks($id_project_tasks)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks')
				 ->join('470websitesmanagement_card_tasks', '470websitesmanagement_card_tasks.id_list_tasks = 470websitesmanagement_tasks.id_list_tasks')
				 ->join('470websitesmanagement_tasks_priority', '470websitesmanagement_tasks_priority.id_tasks_priority = 470websitesmanagement_tasks.id_tasks_priority')
				 ->join('470websitesmanagement_tasks_status', '470websitesmanagement_tasks_status.id_tasks_status = 470websitesmanagement_tasks.id_tasks_status')
				 ->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				 ->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks); 

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
		$this->db->select('*')
				 ->from('470websitesmanagement_project_tasks')
				 ->join('470websitesmanagement_tasks', '470websitesmanagement_tasks.id_project_tasks = 470websitesmanagement_project_tasks.id_project_tasks')
				 ->join('470websitesmanagement_website', '470websitesmanagement_project_tasks.id_website = 470websitesmanagement_website.w_id')
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->group_by(array('470websitesmanagement_project_tasks.id_project_tasks', '470websitesmanagement_project_tasks.name_project_tasks'));

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			$value->percentage_tasks = $this->get_percentage_user($value->id_project_tasks, $id_user)->row()->percentage;
			$value->priority_project_tasks = $this->get_all_tasks_priority_to_user($id_user, $value->id_project_tasks)->row();
		}
		return $query;
	}
	function get_all_tasks_priority_to_user($id_user,$id_project_tasks="")
	{
		$this->db->select('SUM(CASE WHEN id_priority_tasks = "1" THEN 1 ELSE 0 END) as all_tasks_low_user, SUM(IF(id_priority_tasks = "2", 1,0)) as all_tasks_medium_user, SUM(IF(id_priority_tasks = "3", 1,0)) as all_tasks_hight_user, SUM(IF(id_priority_tasks = "4", 1,0)) as all_tasks_critical_user')
				 ->from('470websitesmanagement_card_tasks')
				 ->from('470websitesmanagement_tasks')
				 ->where('470websitesmanagement_card_tasks.id_status_tasks', "1");
				 if (!empty($id_project_tasks)) {
				 	$this->db->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks);
				 }
				 $this->db->where('470websitesmanagement_tasks.id_user', $id_user);

		$query = $this->db->get();
		return $query;
	}
	function get_percentage_user($id_project_tasks,$id_user)
	{
		$this->db->select('ROUND(SUM(CASE WHEN id_status_tasks = "2" OR id_status_tasks = "3" THEN 1 ELSE 0 END)/count(*)*100,0) as percentage')
				->from('470websitesmanagement_tasks')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_user', $id_user);

		$query = $this->db->get();
		return $query;
	}
	function get_all_tasks_per_users()
	{
		$this->db->select('count(*) as all_tasks_user, 470websitesmanagement_tasks.id_user, 470websitesmanagement_users.username, 470websitesmanagement_users.email, SUM(IF(id_status_tasks = "1", 1,0)) as all_tasks_progress_user, SUM(IF(id_status_tasks = "2", 1,0)) as all_tasks_completed_user')
				 ->from('470websitesmanagement_card_tasks')
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
		$this->db->select('SUM(CASE WHEN id_priority_tasks = "1" THEN 1 ELSE 0 END) as all_tasks_low_user, SUM(IF(id_priority_tasks = "2", 1,0)) as all_tasks_medium_user, SUM(IF(id_priority_tasks = "3", 1,0)) as all_tasks_hight_user, SUM(IF(id_priority_tasks = "4", 1,0)) as all_tasks_critical_user')
				 ->from('470websitesmanagement_card_tasks')
				 ->from('470websitesmanagement_tasks')
				 ->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				 ->where('470websitesmanagement_tasks.id_user', $id_user);

		$query = $this->db->get();
		return $query;
	}
	function get_project($id_project_tasks)
	{
		$this->db->select('*')
				->from('470websitesmanagement_project_tasks')
				->join('470websitesmanagement_website', '470websitesmanagement_project_tasks.id_website = 470websitesmanagement_website.w_id')
				->where('id_project_tasks', $id_project_tasks)
				->limit(1);

		$query = $this->db->get();
		return $query->row();
	}
	function get_card_tasks($id_projects, $id_card_tasks)
	{
		$this->db->select('*')
			->from('470websitesmanagement_card_tasks')
			->join('470websitesmanagement_tasks', '470websitesmanagement_tasks.id_list_tasks = 470websitesmanagement_card_tasks.id_list_tasks')
			->where('470websitesmanagement_card_tasks.id_project_tasks', $id_projects)
			->where('470websitesmanagement_card_tasks.id_list_tasks', $id_card_tasks)
			->limit(1);

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			$value->count_tasks_completed = $this->get_percentage_per_tasks($id_projects,$id_card_tasks)->row()->count_tasks_completed;
			$value->tasks = $this->get_tasks_per_list_task($id_projects,$id_card_tasks)->result();
		}
		return $query->row();
	}
	function get_list_tasks_per_project($id_project_tasks, $id_status_tasks = "", $id_user = "")
	{
			$this->db->select('*')
					->from('470websitesmanagement_project_tasks')
					->join('470websitesmanagement_card_tasks', '470websitesmanagement_project_tasks.id_project_tasks = 470websitesmanagement_card_tasks.id_project_tasks')
					->where('470websitesmanagement_card_tasks.id_project_tasks', $id_project_tasks);
					if($id_status_tasks!="")
					{
						$this->db->where('470websitesmanagement_card_tasks.id_status_tasks', $id_status_tasks);
					}

			$query = $this->db->get();
			if (empty($id_user)) {
				foreach ($query->result() as $value) {
					$value->count_tasks_completed = $this->get_percentage_per_tasks($value->id_project_tasks,$value->id_list_tasks)->row()->count_tasks_completed;
					$value->tasks = $this->get_tasks_per_list_task($id_project_tasks,$value->id_list_tasks)->result();
				}
			} else {
				foreach ($query->result() as $value) {
					$value->tasks = $this->get_tasks_user_per_list_task($id_project_tasks,$value->id_list_tasks, $id_user)->result();
				}
			}

			return $query;
	}
	function get_percentage_per_tasks($id_project_tasks,$id_list_tasks)
	{
		$this->db->select('ROUND(SUM(CASE WHEN check_tasks = "1" THEN 1 ELSE 0 END),0) as count_tasks_completed')
				->from('470websitesmanagement_tasks')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_list_tasks', $id_list_tasks);

		$query = $this->db->get();
		return $query;
	}
	private function get_tasks_per_list_task($id_project_tasks,$id_list_task)
	{
		$this->db->select('*')
				->from('470websitesmanagement_tasks')
				->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
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
				->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				->where('470websitesmanagement_tasks.id_list_tasks', $id_list_task)
				->where('470websitesmanagement_tasks.id_user', $id_user)
				->order_by("470websitesmanagement_tasks.id_list_tasks", "asc");

		$query = $this->db->get();
		return $query;
	}
	/***Update****/
	function create_project($w_id_info, $name_project_tasks, $date_started, $date_deadline)
	{
		$query = $this->db->get('470websitesmanagement_project_tasks');
		$data = array(
			'id_website'				=> $w_id_info,
			'name_project_tasks'		=> $name_project_tasks,
			'started_project_tasks	'	=> $date_started,
			'deadline_project_tasks'	=> $date_deadline
		);

		$this->db->insert('470websitesmanagement_project_tasks', $data);
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
				 ->update('470websitesmanagement_project_tasks', $data);
	}
	function delete_project($id_project_tasks)
	{
		$this->db->where('id_project_tasks', $id_project_tasks)->delete('470websitesmanagement_project_tasks');
	}
	function create_list_tasks($id_project_tasks, $title_card_tasks)
	{
		$this->db->select_max('id_list_tasks');
		$this->db->where('id_project_tasks', $id_project_tasks); 
		$query = $this->db->get('470websitesmanagement_card_tasks');
		$data = array(
			'id_list_tasks'			=> $query->row()->id_list_tasks+1,
			'id_project_tasks'		=> $id_project_tasks,
			'title_card_tasks'		=> $title_card_tasks,
			'id_status_tasks'		=> "1"
		);

		$this->db->insert('470websitesmanagement_card_tasks', $data);
		return $this->db->insert_id();
	}
	function create_task($id_project_tasks, $idlisttasks, $nametask, $iduser)
	{
		$this->db->select_max('id_task');
		$this->db->where('id_project_tasks', $id_project_tasks); 
		$this->db->where('id_list_tasks', $idlisttasks);
		$query = $this->db->get('470websitesmanagement_tasks');
		$data = array(
			'id_task'				=> $query->row()->id_task+1,
			'id_project_tasks'		=> $id_project_tasks,
			'id_list_tasks'			=> $idlisttasks,
			'name_task'				=> $nametask,
			'check_tasks'			=> '0',
			'id_user'				=> $iduser
		);

		$this->db->insert('470websitesmanagement_tasks', $data);
		return $this->db->insert_id();
	}
	function update_tasks($id_project_tasks, $idlisttasks, $idtask, $name_task, $check_tasks, $iduser)
	{
		$data = array(
			'name_task'		=> $name_task,
			'check_tasks'	=> $check_tasks,
			'iduser'		=> $iduser
		);

		$this->db->where('id_project_tasks', $id_project_tasks)
				->where('idlisttasks', $idlisttasks)
				->where('idtask', $idtask)
				->update('470websitesmanagement_project_tasks', $data);
	}
}