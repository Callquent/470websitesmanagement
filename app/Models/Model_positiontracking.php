<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_positiontracking extends CI_Model {

	function view_all_whois()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_positiontracking')
				 ->join('470websitesmanagement_website', '470websitesmanagement_whois.w_id_info = 470websitesmanagement_website.w_id')
				 ->order_by('470websitesmanagement_whois.expiration_date', 'ASC');

		$query = $this->db->get();
		return $query;
	}
}