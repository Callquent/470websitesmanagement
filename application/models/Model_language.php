<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_language extends CI_Model {

	function create_language($l_title)
	{
		$data = array(
			'l_title' => $l_title,
			'l_title_url' => str_replace( " ", "-", strtolower($l_title)),
		);

		$this->db->insert('470websitesmanagement_language', $data);
	}
	function update_language($l_id, $l_title)
	{
		$data = array(
			'l_title' => $l_title,
		);

		$this->db->where('l_id', $l_id)
				 ->update('470websitesmanagement_language', $data);
	}
	function transfert_website_language($l_id_old, $l_id_new)
	{
		$data = array(
			'l_id' => $l_id_new,
		);

		$this->db->where('l_id', $l_id_old)
				 ->update('470websitesmanagement_info', $data);
	}
	function delete_language($l_id)
	{
		$this->db->where('l_id', $l_id)->delete('470websitesmanagement_language'); 
	}
}