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
}