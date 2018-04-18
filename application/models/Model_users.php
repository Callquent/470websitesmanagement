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
				 ->from('470websitesmanagement_groups');

		$query = $this->db->get();
		return $query;
	}
}