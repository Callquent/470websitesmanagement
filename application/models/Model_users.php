<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_users extends CI_Model {

	function get_all_users()
	{
		$this->db->select('aauth_users.id, aauth_users.name as name_user, aauth_users.email, aauth_users.last_login, aauth_groups.name as name_group')
				 ->from('aauth_users')
				 ->join('aauth_user_to_group', 'aauth_users.id = aauth_user_to_group.user_id')
				 ->join('aauth_groups', 'aauth_groups.id = aauth_user_to_group.group_id');

		$query = $this->db->get();
		return $query;
	}
	function get_all_groups()
	{
		$this->db->select('*')
				 ->from('aauth_groups');

		$query = $this->db->get();
		return $query;
	}
}