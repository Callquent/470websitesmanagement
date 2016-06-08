<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_settings extends CI_Model {

	function view_settings_lang()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_settings');

		$query = $this->db->get();
		return $query->row();
	}
	function update_settings_lang($value_s)
	{
		$data = array(
			'value_s'	=> serialize(array('file'=> substr($value_s, 0, 2),'language'=>$value_s))
		);

		$this->db->where('id_s', 1)
				 ->update('470websitesmanagement_settings', $data);
	}
}