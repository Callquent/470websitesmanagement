<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_crud_tasks extends CI_Model {
	function create_project($id_website, $name_project_tasks, $date_started, $date_deadline)
	{
		$query = $this->db->get('470websitesmanagement_tasks__project');
		$data = array(
			'id_website'				=> $id_website,
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
	function create_card_tasks($id_project_tasks, $name_card_tasks, $description_card_tasks, $id_tasks_priority, $order_card_tasks)
	{
		if ($this->model_tasks->get_card_tasks_order_max($id_project_tasks) > $order_card_tasks) {

			$this->db->where('id_project_tasks', $id_project_tasks);
			$this->db->where('order_card_tasks  >=', $order_card_tasks);
			$query = $this->db->get('470websitesmanagement_tasks__card');
			
			foreach ($query->result() as $value) {
				$data['order_card_tasks'] = ++$value->order_card_tasks;
				$this->db->where('id_project_tasks', $id_project_tasks)
						 ->where('id_card_tasks', $value->id_card_tasks)
						 ->update('470websitesmanagement_tasks__card', $data);
			}
		}
		$this->db->where('id_project_tasks', $id_project_tasks);
		$query = $this->db->get('470websitesmanagement_tasks__card');
		$data = array(
			'id_project_tasks'			=> $id_project_tasks,
			'name_card_tasks'			=> $name_card_tasks,
			'description_card_tasks'	=> $description_card_tasks,
			'order_card_tasks'			=> $order_card_tasks,
			'id_tasks_priority'			=> $id_tasks_priority,
			'id_tasks_status'			=> "1"
		);

		$this->db->insert('470websitesmanagement_tasks__card', $data);
		return $this->db->insert_id();
	}
	function update_card_tasks($id_project_tasks, $id_card_tasks, $name_card_tasks, $description_card_tasks, $id_tasks_status, $id_tasks_priority, $order_card_tasks_old, $order_card_tasks_new)
	{

			if ($order_card_tasks_new > $order_card_tasks_old) {
				$min = $order_card_tasks_old;
				$max = $order_card_tasks_new;
			} else {
				$min = $order_card_tasks_new;
				$max = $order_card_tasks_old;
			}

			$this->db->where('id_project_tasks', $id_project_tasks)
					->where('order_card_tasks >=', $min)
					->where('order_card_tasks <=', $max)
					->order_by('order_card_tasks', 'ASC');
			$query = $this->db->get('470websitesmanagement_tasks__card');
			
			foreach ($query->result() as $value) {
				$data = array();
				if($value->id_card_tasks == $id_card_tasks) {
					$data = array(
						'name_card_tasks'			=> $name_card_tasks,
						'description_card_tasks'	=> $description_card_tasks,
						'id_tasks_status'			=> $id_tasks_status,
						'id_tasks_priority'			=> $id_tasks_priority,
						'order_card_tasks'			=> $order_card_tasks_new
					);
				} else {
					if($order_card_tasks_old > $value->order_card_tasks) {
						$data['order_card_tasks'] = ++$value->order_card_tasks;
					} else {
						$data['order_card_tasks'] = --$value->order_card_tasks;
					}
				}
				$this->db->where('id_project_tasks', $id_project_tasks)
						 ->where('id_card_tasks', $value->id_card_tasks)
						 ->update('470websitesmanagement_tasks__card', $data);

			}	
	}
	function update_check_card_completed($id_card_tasks)
	{
		$this->db->select('SUM(CASE WHEN check_tasks = 1 THEN 1 ELSE 0 END) as check_card_completed, count(*) as count_tasks_per_card')
				->from('470websitesmanagement_tasks')
				->join('470websitesmanagement_users', '470websitesmanagement_users.id = 470websitesmanagement_tasks.id_user')
				->where('470websitesmanagement_tasks.id_card_tasks', $id_card_tasks);

		$query = $this->db->get()->row();

		if ($query->check_card_completed==$query->count_tasks_per_card) {
			$data = array(
				'id_tasks_status' => 3
			);

			$this->db->where('id_card_tasks', $id_card_tasks)
					->update('470websitesmanagement_tasks__card', $data);
		} else {
			$data = array(
				'id_tasks_status' => 1
			);

			$this->db->where('id_card_tasks', $id_card_tasks)
					->update('470websitesmanagement_tasks__card', $data);
		}
	}
	function delete_card_tasks($id_project_tasks, $id_card_tasks)
	{
		$this->db->where('id_card_tasks', $id_card_tasks);
		$this->db->delete('470websitesmanagement_tasks__card');

		$this->db->where('id_project_tasks', $id_project_tasks);
		$this->db->where('id_card_tasks  >=', $id_card_tasks);
		$query = $this->db->get('470websitesmanagement_tasks__card');

		foreach ($query->result() as $value) {
			$data['order_card_tasks'] = --$value->order_card_tasks;
			$this->db->where('id_project_tasks', $id_project_tasks)
					 ->where('id_card_tasks', $value->id_card_tasks)
					 ->update('470websitesmanagement_tasks__card', $data);		}
	}
	function create_task($id_card_tasks, $nametask, $iduser)
	{
		$this->db->where('id_card_tasks', $id_card_tasks);
		$query = $this->db->get('470websitesmanagement_tasks');
		$data = array(
			'id_card_tasks'			=> $id_card_tasks,
			'name_task'				=> $nametask,
			'check_tasks'			=> '0',
			'id_user'				=> $iduser
		);

		$this->db->insert('470websitesmanagement_tasks', $data);
		return $this->db->insert_id();
	}
	function update_task($id_task, $name_task, $id_user)
	{
		$data = array(
			'name_task'				=> $name_task,
			'id_user'				=> $id_user
		);

		$this->db->where('id_task', $id_task)
				->update('470websitesmanagement_tasks', $data);
	}
	function update_check_task($id_task, $check_tasks)
	{
		$data = array(
			'check_tasks'	=> $check_tasks,
		);

		$this->db->where('id_task', $id_task)
				->update('470websitesmanagement_tasks', $data);
	}
	function delete_tasks($id_task)
	{
		$this->db->where('id_task', $id_task);
		$this->db->delete('470websitesmanagement_tasks');
	}
}