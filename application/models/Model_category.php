<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_category extends CI_Model {

	function create_category($title_category)
	{
		$data = array(
			'title_category' => $title_category,
			'title_url_category' => str_replace( " ", "-", strtolower($title_category))
		);

		$this->db->insert('470websitesmanagement_category', $data);
	}
	function update_category($c_id, $title_category)
	{
		$data = array(
			'title_category' => $title_category,
		);

		$this->db->where('c_id', $c_id)
				 ->update('470websitesmanagement_category', $data);
	}
	function transfert_website_category($c_id_old, $c_id_new)
	{
		$data = array(
			'c_id' => $c_id_new,
		);

		$this->db->where('c_id', $c_id_old)
				 ->update('470websitesmanagement_website', $data);
	}
	function delete_category($c_id)
	{
		$this->db->where('c_id', $c_id)->delete('470websitesmanagement_category'); 
	}
}