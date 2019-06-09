<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_whois extends CI_Model {

	function view_all_whois()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_whois')
				 ->join('470websitesmanagement_website', '470websitesmanagement_whois.id_whois = 470websitesmanagement_website.id_website')
				 ->order_by('470websitesmanagement_whois.expiration_date', 'ASC');

		$query = $this->db->get();
		return $query;
	}
	function get_website_by_whois($id_website = "")
	{
		$this->db->select('*')
					->from('470websitesmanagement_whois')
					->where('470websitesmanagement_whois.id_whois', $id_website);

		$query = $this->db->get()->row();
		return $query;
	}
	function get_all_whois_renew_tomonth($year,$month)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_whois')
				 ->join('470websitesmanagement_website', '470websitesmanagement_whois.id_whois = 470websitesmanagement_website.id_website')
				 ->where('YEAR(470websitesmanagement_whois.expiration_date)',$year)
				 ->where('MONTH(470websitesmanagement_whois.expiration_date)',$month)
				 ->order_by('470websitesmanagement_whois.expiration_date', 'ASC');

		$query = $this->db->get();
		return $query;
	}
	function check_whois($id_whois)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_whois')
				 ->join('470websitesmanagement_website', '470websitesmanagement_whois.id_whois = 470websitesmanagement_website.id_website')
				 ->where('id_whois', $id_whois);

		$query = $this->db->get();
		return $query->row();
	}
	function create_all_whois($id_whois, $whois, $creation_date, $expiration_date, $registrar)
	{
		$data = array(
			'id_whois'				=> $id_whois,
			'whois'					=> $whois,
			'expiration_date'		=> $expiration_date,
			'creation_date'			=> $creation_date,
			'registrar'				=> $registrar,
		);

		$this->db->insert('470websitesmanagement_whois', $data);
		return $this->db->insert_id();
	}
	function update_whois($id_whois, $whois, $creation_date, $expiration_date, $registrar)
	{
		$data = array(
			'whois'					=> $whois,
			'expiration_date'		=> $expiration_date,
			'creation_date'			=> $creation_date,
			'registrar'				=> $registrar,
		);

		$this->db->where('id_whois', $id_whois)
				 ->update('470websitesmanagement_whois', $data);
	}
}