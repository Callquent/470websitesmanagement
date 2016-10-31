<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_whois extends CI_Model {

	function view_all_whois()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_whois')
				 ->join('470websitesmanagement_info', '470websitesmanagement_whois.whois_id = 470websitesmanagement_info.w_id')
				 ->order_by('470websitesmanagement_whois.expiration_date', 'ASC');

		$query = $this->db->get();
		return $query;
	}
	function check_whois($whois_id)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_whois')
				 ->where('whois_id', $whois_id);

		$query = $this->db->get();
		return $query->row();
	}
	function create_all_whois($whois_id, $whois, $creation_date, $expiration_date, $registrar)
	{
		$data = array(
			'whois_id'				=> $whois_id,
			'whois'					=> $whois,
			'expiration_date'		=> $expiration_date,
			'creation_date'			=> $creation_date,
			'registrar'				=> $registrar,
		);

		$this->db->insert('470websitesmanagement_whois', $data);
		return $this->db->insert_id();
	}
	function update_whois($whois, $creation_date, $expiration_date, $registrar)
	{
		$data = array(
			'whois'					=> $whois,
			'expiration_date'		=> $expiration_date,
			'creation_date'			=> $creation_date,
			'registrar'				=> $registrar,
		);

		$this->db->where('w_id_info', $w_id)
				 ->update('470websitesmanagement_whois', $data);
	}
}