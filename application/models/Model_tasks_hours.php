<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_tasks_hours extends CI_Model {

	function get_all_hours_to_project($id_project_tasks,$id_user)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks__hours')
				 ->join('470websitesmanagement_tasks', '470websitesmanagement_tasks.id_task = 470websitesmanagement_tasks__hours.id_task')
				 ->where('470websitesmanagement_tasks.id_project_tasks', $id_project_tasks)
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->order_by("470websitesmanagement_tasks__hours.date_hours_tasks", "asc");

		$query = $this->db->get();
		return $query;
	}

	function get_all_hours_to_card($id_card_tasks,$id_user)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks__hours')
				 ->join('470websitesmanagement_tasks', '470websitesmanagement_tasks.id_task = 470websitesmanagement_tasks__hours.id_task')
				 ->where('470websitesmanagement_tasks.id_card_tasks', $id_card_tasks)
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->order_by("470websitesmanagement_tasks__hours.date_hours_tasks", "asc");

		$query = $this->db->get();
		return $query;
	}

	function get_all_hours_to_task($id_task,$id_user)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_tasks__hours')
				 ->join('470websitesmanagement_tasks', '470websitesmanagement_tasks.id_task = 470websitesmanagement_tasks__hours.id_task')
				 ->where('470websitesmanagement_tasks.id_task', $id_task)
				 ->where('470websitesmanagement_tasks.id_user', $id_user)
				 ->order_by("470websitesmanagement_tasks__hours.date_hours_tasks", "asc");

		$query = $this->db->get();
		return $query;
	}

	function create_tasks_hours($id_task, $nb_hours_tasks, $date_hours_tasks)
	{
		$data = array(
			'id_task'				=> $id_task,
			'nb_hours_tasks'		=> $nb_hours_tasks,
			'date_hours_tasks'		=> $date_hours_tasks
		);

		$this->db->insert('470websitesmanagement_tasks__hours', $data);
		return $this->db->insert_id();
	}
	function update_tasks_hours($id_hours_tasks, $id_task, $nb_hours_tasks, $date_hours_tasks)
	{
		$data = array(
			'id_task'				=> $id_task,
			'nb_hours_tasks'		=> $nb_hours_tasks,
			'date_hours_tasks'		=> $date_hours_tasks
		);

		$this->db->where('id_hours_tasks', $id_hours_tasks)
				->update('470websitesmanagement_tasks__hours', $data);
	}
	function delete_tasks_hours($id_hours_tasks)
	{
		$this->db->where('id_hours_tasks', $id_hours_tasks);
		$this->db->delete('470websitesmanagement_tasks__hours');
	}
}