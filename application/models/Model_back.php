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

		$this->db->insert('website_info', $data);
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

		$this->db->insert('website_database', $data);
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

		$this->db->insert('website_ftp', $data);
		return $this->db->insert_id();
	}
	function create_backoffice_websites($w_id_info, $w_login_bo, $w_password_bo)
	{
		$data = array(
			'w_id_info'			=> $w_id_info,
			'w_login_bo'		=> $w_login_bo,
			'w_password_bo'		=> $w_password_bo,
		);
		$this->db->insert('website_backoffice', $data);
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
				 ->update('website_info', $data);
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
				 ->update('website_ftp', $data);
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
				 ->update('website_database', $data);
	}
	function update_backoffice_websites($w_id_bo, $w_id_info, $w_login_bo, $w_password_bo)
	{
		$data = array(
			'w_login_bo'			=> $w_login_bo,
			'w_password_bo'			=> $w_password_bo,
		);

		$this->db->where('w_id_info', $w_id_info)
				 ->where('w_id_bo', $w_id_bo)
				 ->update('website_backoffice', $data);
	}
	function delete_website($id)
	{
		$this->db->where('w_id_info', $id)->delete('website_backoffice');
		$this->db->where('w_id_info', $id)->delete('website_database');
		$this->db->where('w_id_info', $id)->delete('website_ftp');
		$this->db->where('w_id', $id)->delete('website_info');
	}
}