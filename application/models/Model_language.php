<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_language extends CI_Model {

	function create_language($title_language)
	{
		$data = array(
			'title_language' => $title_language,
			'title_url_language' => str_replace( " ", "-", strtolower($title_language)),
		);

		$this->db->insert('470websitesmanagement_language', $data);
	}
	function update_language($id_language, $title_language)
	{
		$data = array(
			'title_language' => $title_language,
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