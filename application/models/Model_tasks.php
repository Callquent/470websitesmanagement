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
		$this->db->select_max('id_list_task');
		$this->db->where('id_project_tasks', $id_project_tasks); 
		$query = $this->db->get('470websitesmanagement_list_tasks');
		$data = array(
			'id_list_task'			=> $query->row()->id_list_task+1,
			'id_project_tasks'		=> $id_project_tasks,
			'title_list_task'		=> $title_list_task
		);

		$this->db->insert('470websitesmanagement_list_tasks', $data);
		return $this->db->insert_id();
	}
	function update_whois($whois_id, $whois, $creation_date, $expiration_date, $registrar)
	{
		$data = array(
			'whois'					=> $whois,
			'expiration_date'		=> $expiration_date,
			'creation_date'			=> $creation_date,
			'registrar'				=> $registrar,
		);

		$this->db->where('whois_id', $whois_id)
				 ->update('470websitesmanagement_whois', $data);
	}
}