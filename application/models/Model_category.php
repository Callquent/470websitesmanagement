<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_category extends CI_Model {

	function create_category($c_title)
	{
		$data = array(
			'c_title' => $c_title,
			'c_title_url' => str_replace( " ", "-", strtolower($c_title))
		);

		$this->db->insert('470websitesmanagement_category', $data);
	}
	function update_category($c_id, $c_title)
	{
		$data = array(
			'c_title' => $c_title,
		);

		$this->db->where('c_id', $c_id)
				 ->update('470websitesmanagement_category', $data);
	}
	function transfert_website_language($c_id_old, $c_id_new)
	{
		$data = array(
			'c_id' => $c_id_old,
		);

		$this->db->where('c_id', $c_id_new)
				 ->update('470websitesmanagement_info', $data);
	}
	function delete_category($c_id)
	{
		$this->db->where('c_id', $c_id)->delete('470websitesmanagement_category'); 
	}
}