<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_category extends CI_Model {

	function create_category($name_category)
	{
		$data = array(
			'name_category' => $name_category,
			'name_url_category' => str_replace( " ", "-", strtolower($name_category))
		);

		$this->db->insert('470websitesmanagement_category', $data);
	}
	function update_category($id_category, $name_category)
	{
		$data = array(
			'name_category' => $name_category,
		);

		$this->db->where('id_category', $id_category)
				 ->update('470websitesmanagement_category', $data);
	}
	function transfert_website_category($id_category_old, $id_category_new)
	{
		$data = array(
			'id_category' => $id_category_new,
		);

		$this->db->where('id_category', $id_category_old)
				 ->update('470websitesmanagement_website', $data);
	}
	function delete_category($id_category)
	{
		$this->db->where('id_category', $id_category)->delete('470websitesmanagement_category'); 
	}
}