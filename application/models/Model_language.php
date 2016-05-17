<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_language extends CI_Model {

	function create_language($l_title, $l_color)
	{
		$data = array(
			'l_title' => $l_title,
			'l_title_url' => str_replace( " ", "-", strtolower($l_title)),
			'l_color' => $l_color
		);

		$this->db->insert('language', $data);
	}
	function update_language($l_id, $l_title)
	{
		$data = array(
			'l_title' => $l_title,
		);

		$this->db->where('l_id', $l_id)
				 ->update('language', $data);
	}
	function delete_language($l_id)
	{
		$this->db->where('l_id', $l_id)->delete('language'); 
	}
}