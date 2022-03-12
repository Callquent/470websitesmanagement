<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {

	function get_all_users()
	{
		$this->db->select('470websitesmanagement_users.id, 470websitesmanagement_users.username as name_user, 470websitesmanagement_users.email, 470websitesmanagement_users.last_login, 470websitesmanagement_groups.name as name_group')
				 ->from('470websitesmanagement_users')
				 ->join('470websitesmanagement_user_to_group', '470websitesmanagement_users.id = 470websitesmanagement_user_to_group.user_id')
				 ->join('470websitesmanagement_groups', '470websitesmanagement_groups.id = 470websitesmanagement_user_to_group.group_id');

		$query = $this->db->get();
		return $query;
	}
	function get_all_groups()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_groups')
				 ->where('470websitesmanagement_groups.name !=', "Unknown");

		$query = $this->db->get();
		return $query;
	}
	function get_group_all_perms($perm_id)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_groups')
				 ->where('470websitesmanagement_groups.name !=', "Unknown");

		$query = $this->db->get();
		foreach ($query->result() as $value) {
			if ($this->get_group_perm($value->id, $perm_id)->num_rows() > 0 || $value->name == "Admin") {
				$value->check_group_perm = true;
			} else {
				$value->check_group_perm = false;
			}
			$value->perm_id = $perm_id;
		}
		return $query;
	}
	function get_group_perm($group_id, $perm_id)
	{
		$this->db->select('*')
		->from('470websitesmanagement_perm_to_group')
		->where('470websitesmanagement_perm_to_group.group_id', $group_id)
		->where('470websitesmanagement_perm_to_group.perm_id', $perm_id);

		$query = $this->db->get();
		return $query;
	}
	function get_user_id($username)
	{
		$this->db->select('470websitesmanagement_users.id')
				 ->from('470websitesmanagement_users')
				 ->where('username', $username);

		$query = $this->db->get();
		return $query->row();
	}
	function delete_user($id_user)
	{
		$this->db->where('id_user', $id_user)->delete('470websitesmanagement_tasks');
	}
}