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

		$this->db->insert('470websitesmanagement_info', $data);
		return $this->db->insert_id();
	}

	function create_database_websites($w_id_info, $w_host_db, $w_name_db, $w_login_db, $w_password_db)
	{
		$data = array(
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
		$data = array(
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
		$data = array(
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

		$query_language = $this->db->get('470websitesmanagement_language');
		foreach ($query_language->result() as $row) {
			$data = array(
				'l_id' => $row->l_id,
				'l_title' => $row->l_title,
				'l_title_url' => $row->l_title_url,
				'l_color' => $row->l_color
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_language').";";
		}
		$query_category = $this->db->get('470websitesmanagement_category');
		foreach ($query_category->result() as $row) {
			$data = array(
				'c_id' => $row->c_id,
				'c_title'  => $row->c_title,
				'c_title_url'  => $row->c_title_url
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_category').";";
		}

		$query_info = $this->db->get('470websitesmanagement_info');
		foreach ($query_info->result() as $row) {
			$data = array(
				'w_id' => $row->w_id,
				'c_id'  => $row->c_id,
				'l_id'  => $row->l_id,
				'w_title' => $row->w_title,
				'w_url_rw'  => $row->w_url_rw
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_info').";";
		}
		$query_ftp = $this->db->get('470websitesmanagement_ftp');
		foreach ($query_ftp->result() as $row) {
			$data = array(
				'w_id_ftp' => $row->w_id_ftp,
				'w_id_info'  => $row->w_id_info,
				'w_host_ftp'  => $row->w_host_ftp,
				'w_login_ftp'  => $row->w_login_ftp,
				'w_password_ftp' => $row->w_password_ftp
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_ftp').";";
		}
		$query_database = $this->db->get('470websitesmanagement_database');
		foreach ($query_database->result() as $row) {
			$data = array(
				'w_id_db' => $row->w_id_db,
				'w_id_info'  => $row->w_id_info,
				'w_host_db'  => $row->w_host_db,
				'w_name_db' => $row->w_name_db,
				'w_login_db' => $row->w_login_db,
				'w_password_db'  => $row->w_password_db
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_database').";";
		}
		$query_backoffice = $this->db->get('470websitesmanagement_backoffice');
		foreach ($query_backoffice->result() as $row) {
			$data = array(
				'w_id_bo' => $row->w_id_bo,
				'w_id_info'  => $row->w_id_info,
				'w_login_bo'  => $row->w_login_bo,
				'w_password_bo' => $row->w_password_bo
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_backoffice').";";
		}

		$query_whois = $this->db->get('470websitesmanagement_whois');
		foreach ($query_whois->result() as $row) {
			$data = array(
				'w_id_info' => $row->w_id_info,
				'w_id_whois'  => $row->w_id_whois,
				'whois'  => $row->whois,
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
		$this->db->query($decrypt);
	}
}