<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_back extends CI_Model {
	
	function create_websites($c_id, $l_id, $w_title, $w_url_rw)
	{
		$data = array(
			'c_id'				=> $c_id,
			'l_id'				=> $l_id,
			'w_title'			=> $w_title,
			'w_url_rw'			=> $w_url_rw,
		);

		$this->db->insert('470websitesmanagement_website', $data);
		return $this->db->insert_id();
	}

	function create_database_websites($w_id_info, $w_host_db, $w_name_db, $w_login_db, $w_password_db)
	{
		$this->db->select_max('id_database');
		$this->db->where('id_website', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_database');
		$data = array(
			'id_database'			=> $query->row()->id_database+1,
			'id_website'			=> $w_id_info,
			'host_database'			=> $w_host_db,
			'name_database'			=> $w_name_db,
			'login_database'		=> $w_login_db,
			'password_database'		=> $w_password_db,
		);

		$this->db->insert('470websitesmanagement_database', $data);
		return $this->db->insert_id();
	}
	function create_ftp_websites($w_id_info, $w_host_ftp, $w_login_ftp, $w_password_ftp)
	{
		$this->db->select_max('id_ftp');
		$this->db->where('id_website', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_ftp');
		$data = array(
			'id_ftp'				=> $query->row()->id_ftp+1,
			'id_website'				=> $w_id_info,
			'host_ftp'			=> $w_host_ftp,
			'login_ftp'			=> $w_login_ftp,
			'password_ftp'		=> $w_password_ftp,
		);

		$this->db->insert('470websitesmanagement_ftp', $data);
		return $this->db->insert_id();
	}
	function create_backoffice_websites($w_id_info, $w_host_bo, $w_login_bo, $w_password_bo)
	{
		$this->db->select_max('id_backoffice');
		$this->db->where('id_website', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_backoffice');
		$data = array(
			'id_backoffice'			=> $query->row()->id_backoffice+1,
			'id_website'			=> $w_id_info,
			'host_backoffice'		=> $w_host_bo,
			'login_backoffice'		=> $w_login_bo,
			'password_backoffice'	=> $w_password_bo,
		);
		$this->db->insert('470websitesmanagement_backoffice', $data);
		return $this->db->insert_id();
	}
	function create_htaccess_websites($w_id_info, $w_login_htaccess, $w_password_htaccess)
	{
		$this->db->select_max('id_htaccess');
		$this->db->where('id_website', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_htaccess');
		$data = array(
			'id_htaccess'			=> $query->row()->id_htaccess+1,
			'id_website'			=> $w_id_info,
			'login_htaccess'		=> $w_login_htaccess,
			'password_htaccess'		=> $w_password_htaccess,
		);
		$this->db->insert('470websitesmanagement_htaccess', $data);
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
				 ->update('470websitesmanagement_website', $data);
	}
	function update_ftp_websites($w_id_ftp, $w_id_info, $w_host_ftp, $w_login_ftp, $w_password_ftp)
	{
		$data = array(
			'host_ftp'			=> $w_host_ftp,
			'login_ftp'			=> $w_login_ftp,
			'password_ftp'		=> $w_password_ftp
		);

		$this->db->where('id_website', $w_id_info)
				 ->where('id_ftp', $w_id_ftp)
				 ->update('470websitesmanagement_ftp', $data);
	}
	function update_database_websites($w_id_db, $w_id_info, $w_host_db, $w_name_db, $w_login_db, $w_password_db)
	{
		$data = array(
			'host_database'				=> $w_host_db,
			'name_database'				=> $w_name_db,
			'login_database'			=> $w_login_db,
			'password_database'			=> $w_password_db
		);

		$this->db->where('id_website', $w_id_info)
				 ->where('id_database', $w_id_db)
				 ->update('470websitesmanagement_database', $data);
	}
	function update_backoffice_websites($w_id_bo, $w_id_info, $w_host_bo, $w_login_bo, $w_password_bo)
	{
		$data = array(
			'host_backoffice'				=> $w_host_bo,
			'login_backoffice'				=> $w_login_bo,
			'password_backoffice'			=> $w_password_bo,
		);

		$this->db->where('id_website', $w_id_info)
				 ->where('id_backoffice', $w_id_bo)
				 ->update('470websitesmanagement_backoffice', $data);
	}
	function update_htaccess_websites($w_id_htaccess, $w_id_info, $w_login_htaccess, $w_password_htaccess)
	{
		$data = array(
			'login_htaccess'				=> $w_login_htaccess,
			'password_htaccess'				=> $w_password_htaccess,
		);

		$this->db->where('id_website', $w_id_info)
				 ->where('id_htaccess', $w_id_htaccess)
				 ->update('470websitesmanagement_htaccess', $data);
	}
	function delete_website($id)
	{
		/*$tables = array('470websitesmanagement_backoffice', '470websitesmanagement_database', '470websitesmanagement_ftp');
		$this->db->where('id_website', $id)->delete($tables);*/
		$this->db->where('id_website', $id)->delete('470websitesmanagement_backoffice');
		$this->db->where('id_website', $id)->delete('470websitesmanagement_database');
		$this->db->where('id_website', $id)->delete('470websitesmanagement_ftp');
		$this->db->where('id_website', $id)->delete('470websitesmanagement_htaccess');
		$this->db->where('w_id', $id)->delete('470websitesmanagement_website');
	}
	function export_website($websites = "")
	{
		$sql = "";

		$this->db->select('*')
					->from('470websitesmanagement_website')
					->join('470websitesmanagement_whois', '470websitesmanagement_whois.whois_id = 470websitesmanagement_website.w_id')
					->join('470websitesmanagement_ftp', '470websitesmanagement_ftp.id_website = 470websitesmanagement_website.w_id')
					->join('470websitesmanagement_database', '470websitesmanagement_database.id_website = 470websitesmanagement_website.w_id')
					->join('470websitesmanagement_backoffice', '470websitesmanagement_backoffice.id_website = 470websitesmanagement_website.w_id');
		if (!empty ($websites)) {
			$this->db->where_in('470websitesmanagement_website.w_id', $websites);
		}

		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$data = array(
				'w_id' => $row->w_id,
				'c_id'  => $row->c_id,
				'l_id'  => $row->l_id,
				'w_title' => $row->w_title,
				'w_url_rw'  => $row->w_url_rw
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_website').";";

			$data = array(
				'id_website'  => $row->w_id_info,
				'id_ftp'  => $row->w_id_ftp,
				'host_ftp'  => $row->w_host_ftp,
				'login_ftp'  => $row->w_login_ftp,
				'password_ftp' => $row->w_password_ftp
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_ftp').";";

			$data = array(
				'id_website'  => $row->w_id_info,
				'id_database'  => $row->w_id_db,
				'host_database'  => $row->w_host_db,
				'name_database' => $row->w_name_db,
				'login_database' => $row->w_login_db,
				'password_database'  => $row->w_password_db
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_database').";";

			$data = array(
				'id_website'  => $row->w_id_info,
				'id_backoffice'  => $row->w_id_bo,
				'host_backoffice'	=> $w_host_bo,
				'login_backoffice'  => $row->w_login_bo,
				'password_backoffice'	=> $row->w_password_bo
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_backoffice').";";

			$data = array(
				'whois_id'  => $row->w_id_info,
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
		$insert_sql = explode(";", $decrypt,-1);

		foreach ($insert_sql as $row) {
			$this->db->select_max('w_id');

			if (strpos($row,'470websitesmanagement_website') !== false) {
				$max_id_website = $this->db->get('470websitesmanagement_website')->row()->w_id+1;
			} else {
				$max_id_website = $this->db->get('470websitesmanagement_website')->row()->w_id;
			}
			$patterns = array('/VALUES \(\'(.*)\'/siU');
			$replacements = array('VALUES (\''.$max_id_website.'\'');
			$result = preg_replace($patterns,$replacements, $row);
			$this->db->query($result);
		}
	}
}