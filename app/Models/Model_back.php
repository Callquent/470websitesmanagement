<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_back extends CI_Model {
	
	function create_websites($id_category, $id_language, $name_website, $url_website)
	{
		$data = array(
			'id_category'			=> $id_category,
			'id_language'			=> $id_language,
			'name_website'			=> $name_website,
			'url_website'			=> $url_website,
		);

		$this->db->insert('470websitesmanagement_website', $data);
		return $this->db->insert_id();
	}
	function update_website($id_website, $id_category, $id_language, $name_website, $url_website)
	{
		$data = array(
			'id_category'			=> $id_category,
			'id_language'			=> $id_language,
			'name_website'			=> $name_website,
			'url_website'			=> $url_website,
		);

		$this->db->where('id_website', $id_website)
				 ->update('470websitesmanagement_website', $data);
	}
	function delete_website($id)
	{
		$tables = array('470websitesmanagement_website', '470websitesmanagement_website__ftp', '470websitesmanagement_website__database', '470websitesmanagement_website__backoffice', '470websitesmanagement_website__htaccess');
		$this->db->where('id_website', $id)->delete($tables);
	}

	function create_ftp_website($id_website, $w_host_ftp, $w_login_ftp, $w_password_ftp)
	{
		$this->db->where('id_website', $id_website); 
		$query = $this->db->get('470websitesmanagement_website__ftp');
		$data = array(
			'id_website'		=> $id_website,
			'host_ftp'			=> $w_host_ftp,
			'login_ftp'			=> $w_login_ftp,
			'password_ftp'		=> $w_password_ftp,
		);

		$this->db->insert('470websitesmanagement_website__ftp', $data);
		return $this->db->insert_id();
	}
	function create_database_website($id_website, $w_host_db, $w_name_db, $w_login_db, $w_password_db)
	{
		$this->db->where('id_website', $id_website); 
		$query = $this->db->get('470websitesmanagement_website__database');
		$data = array(
			'id_website'			=> $id_website,
			'host_database'			=> $w_host_db,
			'name_database'			=> $w_name_db,
			'login_database'		=> $w_login_db,
			'password_database'		=> $w_password_db,
		);

		$this->db->insert('470websitesmanagement_website__database', $data);
		return $this->db->insert_id();
	}
	function create_backoffice_website($id_website, $w_host_bo, $w_login_bo, $w_password_bo)
	{
		$this->db->where('id_website', $id_website); 
		$query = $this->db->get('470websitesmanagement_website__backoffice');
		$data = array(
			'id_website'			=> $id_website,
			'host_backoffice'		=> $w_host_bo,
			'login_backoffice'		=> $w_login_bo,
			'password_backoffice'	=> $w_password_bo,
		);
		$this->db->insert('470websitesmanagement_website__backoffice', $data);
		return $this->db->insert_id();
	}
	function create_htaccess_website($id_website, $w_login_htaccess, $w_password_htaccess)
	{
		$this->db->where('id_website', $id_website); 
		$query = $this->db->get('470websitesmanagement_website__htaccess');
		$data = array(
			'id_website'			=> $id_website,
			'login_htaccess'		=> $w_login_htaccess,
			'password_htaccess'		=> $w_password_htaccess,
		);
		$this->db->insert('470websitesmanagement_website__htaccess', $data);
		return $this->db->insert_id();
	}
	function update_ftp_websites($w_id_ftp, $id_website, $w_host_ftp, $w_login_ftp, $w_password_ftp)
	{
		$data = array(
			'host_ftp'			=> $w_host_ftp,
			'login_ftp'			=> $w_login_ftp,
			'password_ftp'		=> $w_password_ftp
		);

		$this->db->where('id_website', $id_website)
				 ->where('id_ftp', $w_id_ftp)
				 ->update('470websitesmanagement_website__ftp', $data);
	}
	function update_database_websites($w_id_db, $id_website, $w_host_db, $w_name_db, $w_login_db, $w_password_db)
	{
		$data = array(
			'host_database'				=> $w_host_db,
			'name_database'				=> $w_name_db,
			'login_database'			=> $w_login_db,
			'password_database'			=> $w_password_db
		);

		$this->db->where('id_website', $id_website)
				 ->where('id_database', $w_id_db)
				 ->update('470websitesmanagement_website__database', $data);
	}
	function update_backoffice_websites($w_id_bo, $id_website, $w_host_bo, $w_login_bo, $w_password_bo)
	{
		$data = array(
			'host_backoffice'				=> $w_host_bo,
			'login_backoffice'				=> $w_login_bo,
			'password_backoffice'			=> $w_password_bo,
		);

		$this->db->where('id_website', $id_website)
				 ->where('id_backoffice', $w_id_bo)
				 ->update('470websitesmanagement_website__backoffice', $data);
	}
	function update_htaccess_websites($w_id_htaccess, $id_website, $w_login_htaccess, $w_password_htaccess)
	{
		$data = array(
			'login_htaccess'				=> $w_login_htaccess,
			'password_htaccess'				=> $w_password_htaccess,
		);

		$this->db->where('id_website', $id_website)
				 ->where('id_htaccess', $w_id_htaccess)
				 ->update('470websitesmanagement_website__htaccess', $data);
	}
	function delete_ftp_website($id_ftp, $id_website)
	{
		$this->db->where('id_website', $id_website);
		$this->db->where('id_ftp', $id_ftp);
		$this->db->delete('470websitesmanagement_website__ftp');
	}
	function delete_database_website($id_database, $id_website)
	{
		$this->db->where('id_website', $id_website);
		$this->db->where('id_database', $id_database);
		$this->db->delete('470websitesmanagement_website__database');
	}
	function delete_backoffice_website($id_backoffice, $id_website)
	{
		$this->db->where('id_website', $id_website);
		$this->db->where('id_backoffice', $id_backoffice);
		$this->db->delete('470websitesmanagement_website__backoffice');
	}
	function delete_htaccess_website($id_htaccess, $id_website)
	{
		$this->db->where('id_website', $id_website);
		$this->db->where('id_htaccess', $id_htaccess);
		$this->db->delete('470websitesmanagement_website__htaccess');
	}
}