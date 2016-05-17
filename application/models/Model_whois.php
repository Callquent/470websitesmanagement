<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_whois extends CI_Model {

	function view_all_whois()
	{
		$this->db->select('*')
				 ->from('whois')
				 ->join('website_info', 'whois.w_id_info = website_info.w_id')
				 ->order_by('whois.expiration_date', 'ASC');

		$query = $this->db->get();
		return $query;
	}
	function check_whois($w_id)
	{
		$this->db->select('*')
				 ->from('whois')
				 ->where('w_id_info', $w_id);

		$query = $this->db->get();
		return $query->row();
	}
	function create_all_whois($w_id, $whois, $creation_date, $expiration_date, $register)
	{
		$data = array(
			'w_id_info'				=> $w_id,
			'whois'					=> $whois,
			'expiration_date'		=> $expiration_date,
			'creation_date'			=> $creation_date,
			'register'				=> $register,
		);

		$this->db->insert('whois', $data);
		return $this->db->insert_id();
	}
	function update_whois($w_id, $whois, $creation_date, $expiration_date, $register)
	{
		$data = array(
			'w_id_info'				=> $w_id,
			'whois'					=> $whois,
			'expiration_date'		=> $expiration_date,
			'creation_date'			=> $creation_date,
			'register'				=> $register,
		);

		$this->db->where('w_id_info', $w_id)
				 ->update('whois', $data);
	}
}