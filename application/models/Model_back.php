<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_back extends CI_Model {
	
	function create_websites($c_id, $l_id, $whois_id, $w_title, $w_url_rw)
	{
		$data = array(
			'c_id'				=> $c_id,
			'l_id'				=> $l_id,
			'whois_id'			=> $whois_id,
			'w_title'			=> $w_title,
			'w_url_rw'			=> $w_url_rw,
		);

		$this->db->insert('470websitesmanagement_info', $data);
		return $this->db->insert_id();
	}

	function create_database_websites($w_id_info, $w_host_db, $w_name_db, $w_login_db, $w_password_db)
	{
		$this->db->select_max('w_id_db');
		$this->db->where('w_id_info', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_database');
		$data = array(
			'w_id_db'			=> $query->row()->w_id_db+1,
			'w_id_info'			=> $w_id_info,
			'w_host_db'			=> $w_host_db,
			'w_name_db'			=> $w_name_db,
			'w_login_db'		=> $w_login_db,
			'w_password_db'		=> $w_password_db,
		);

		$this->db->insert('470websitesmanagement_database', $data);
		return $this->db->insert_id();
	}
	function create_ftp_websites($w_id_info, $w_host_ftp, $w_login_ftp, $w_password_ftp)
	{
		$this->db->select_max('w_id_ftp');
		$this->db->where('w_id_info', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_ftp');
		$data = array(
			'w_id_ftp'				=> $query->row()->w_id_ftp+1,
			'w_id_info'				=> $w_id_info,
			'w_host_ftp'			=> $w_host_ftp,
			'w_login_ftp'			=> $w_login_ftp,
			'w_password_ftp'		=> $w_password_ftp,
		);

		$this->db->insert('470websitesmanagement_ftp', $data);
		return $this->db->insert_id();
	}
	function create_backoffice_websites($w_id_info, $w_login_bo, $w_password_bo)
	{
		$this->db->select_max('w_id_bo');
		$this->db->where('w_id_info', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_backoffice');
		$data = array(
			'w_id_bo'			=> $query->row()->w_id_bo+1,
			'w_id_info'			=> $w_id_info,
			'w_login_bo'		=> $w_login_bo,
			'w_password_bo'		=> $w_password_bo,
		);
		$this->db->insert('470websitesmanagement_backoffice', $data);
		return $this->db->insert_id();
	}

	function update_website($w_id, $c_id, $l_id, $w_title, $w_url_rw)
	{
		$data = array(
			'c_id'				=> $c_id,
			'l_id'				=> $l_id,
			'w_title'			=> $w_title,
			'w_url_rw'			=> $w_url_rw,
		);

		$this->db->where('w_id', $w_id)
				 ->update('470websitesmanagement_info', $data);
	}
	function update_ftp_websites($w_id_ftp, $w_id_info, $w_host_ftp, $w_login_ftp, $w_password_ftp)
	{
		$data = array(
			'w_host_ftp'			=> $w_host_ftp,
			'w_login_ftp'			=> $w_login_ftp,
			'w_password_ftp'		=> $w_password_ftp
		);

		$this->db->where('w_id_info', $w_id_info)
				 ->where('w_id_ftp', $w_id_ftp)
				 ->update('470websitesmanagement_ftp', $data);
	}
	function update_database_websites($w_id_db, $w_id_info, $w_host_db, $w_name_db, $w_login_db, $w_password_db)
	{
		$data = array(
			'w_host_db'				=> $w_host_db,
			'w_name_db'				=> $w_name_db,
			'w_login_db'			=> $w_login_db,
			'w_password_db'			=> $w_password_db
		);

		$this->db->where('w_id_info', $w_id_info)
				 ->where('w_id_db', $w_id_db)
				 ->update('470websitesmanagement_database', $data);
	}
	function update_backoffice_websites($w_id_bo, $w_id_info, $w_login_bo, $w_password_bo)
	{
		$data = array(
			'w_login_bo'			=> $w_login_bo,
			'w_password_bo'			=> $w_password_bo,
		);

		$this->db->where('w_id_info', $w_id_info)
				 ->where('w_id_bo', $w_id_bo)
				 ->update('470websitesmanagement_backoffice', $data);
	}
	function delete_website($id)
	{
		$this->db->where('w_id_info', $id)->delete('470websitesmanagement_backoffice');
		$this->db->where('w_id_info', $id)->delete('470websitesmanagement_database');
		$this->db->where('w_id_info', $id)->delete('470websitesmanagement_ftp');
		$this->db->where('w_id_info', $id)->delete('470websitesmanagement_whois');
		$this->db->where('w_id', $id)->delete('470websitesmanagement_info');
	}
	function export_website()
	{
		$sql = "";

		$this->db->select('*')
					->from('470websitesmanagement_info')
					->join('470websitesmanagement_ftp', '470websitesmanagement_ftp.w_id_info = 470websitesmanagement_info.w_id')
					->join('470websitesmanagement_database', '470websitesmanagement_database.w_id_info = 470websitesmanagement_info.w_id')
					->join('470websitesmanagement_backoffice', '470websitesmanagement_backoffice.w_id_info = 470websitesmanagement_info.w_id');

		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$data = array(
				'w_id' => $row->w_id,
				'c_id'  => $row->c_id,
				'l_id'  => $row->l_id,
				'w_title' => $row->w_title,
				'w_url_rw'  => $row->w_url_rw
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_info').";";

			$data = array(
				'w_id_info'  => $row->w_id_info,
				'w_id_ftp'  => $row->w_id_ftp,
				'w_host_ftp'  => $row->w_host_ftp,
				'w_login_ftp'  => $row->w_login_ftp,
				'w_password_ftp' => $row->w_password_ftp
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_ftp').";";

			$data = array(
				'w_id_info'  => $row->w_id_info,
				'w_id_db'  => $row->w_id_db,
				'w_host_db'  => $row->w_host_db,
				'w_name_db' => $row->w_name_db,
				'w_login_db' => $row->w_login_db,
				'w_password_db'  => $row->w_password_db
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_database').";";

			$data = array(
				'w_id_info'  => $row->w_id_info,
				'w_id_bo'  => $row->w_id_bo,
				'w_login_bo'  => $row->w_login_bo,
				'w_password_bo' => $row->w_password_bo
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_backoffice').";";
		}

		$query_whois = $this->db->get('470websitesmanagement_whois');
		foreach ($query_whois->result() as $row) {
			$data = array(
				'creation_date' => $row->creation_date,
				'expiration_date'  => $row->expiration_date,
				'registrar'  => $row->registrar,
				'release_date_whois'  => $row->release_date_whois
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_whois').";";
		}

		return $sql;
	}
	function import_website($decrypt)
	{
		$insert_sql = explode(";", $decrypt);
		
		foreach ($insert_sql as $row) {
			$this->db->select_max('w_id');

			if ((strpos($row,'470websitesmanagement_ftp' !== false))) {
				$pos = strpos($row,'470websitesmanagement_info');
				if ($pos !== false) {
					$max_id_website = $this->db->get('470websitesmanagement_info')->row()->w_id+1;
				} else {
					$max_id_website = $this->db->get('470websitesmanagement_info')->row()->w_id;
				}
				$patterns = array('/VALUES \(\'(.*)\'/siU');
				$replacements = array('VALUES (\''.$max_id_website.'\'');
				$result = preg_replace($patterns,$replacements, $row);
			}


			var_dump($result);
			/*$this->db->query($result);*/
		}
	}
}