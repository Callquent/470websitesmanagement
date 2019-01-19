<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_language extends CI_Model {

	function create_language($name_language)
	{
		$data = array(
			'name_language' => $name_language,
			'name_url_language' => str_replace( " ", "-", strtolower($name_language)),
		);

		$this->db->insert('470websitesmanagement_language', $data);
	}
	function update_language($id_language, $name_language)
	{
		$data = array(
			'name_language' => $name_language,
		);

		$this->db->where('id_language', $id_language)
				 ->update('470websitesmanagement_language', $data);
	}
	function transfert_website_language($id_language_old, $id_language_new)
	{
		$data = array(
			'id_language' => $id_language_new,
		);

		$this->db->where('id_language', $id_language_old)
				 ->update('470websitesmanagement_website', $data);
	}
	function delete_language($id_language)
	{
		$this->db->where('id_language', $id_language)->delete('470websitesmanagement_language'); 
	}
}