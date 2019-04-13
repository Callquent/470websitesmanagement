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

	function create_ftp_website($w_id_info, $w_host_ftp, $w_login_ftp, $w_password_ftp)
	{
		$this->db->where('id_website', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_website__ftp');
		$data = array(
			'id_website'		=> $w_id_info,
			'host_ftp'			=> $w_host_ftp,
			'login_ftp'			=> $w_login_ftp,
			'password_ftp'		=> $w_password_ftp,
		);

		$this->db->insert('470websitesmanagement_website__ftp', $data);
		return $this->db->insert_id();
	}
	function create_database_website($w_id_info, $w_host_db, $w_name_db, $w_login_db, $w_password_db)
	{
		$this->db->where('id_website', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_website__database');
		$data = array(
			'id_website'			=> $w_id_info,
			'host_database'			=> $w_host_db,
			'name_database'			=> $w_name_db,
			'login_database'		=> $w_login_db,
			'password_database'		=> $w_password_db,
		);

		$this->db->insert('470websitesmanagement_website__database', $data);
		return $this->db->insert_id();
	}
	function create_backoffice_website($w_id_info, $w_host_bo, $w_login_bo, $w_password_bo)
	{
		$this->db->where('id_website', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_website__backoffice');
		$data = array(
			'id_website'			=> $w_id_info,
			'host_backoffice'		=> $w_host_bo,
			'login_backoffice'		=> $w_login_bo,
			'password_backoffice'	=> $w_password_bo,
		);
		$this->db->insert('470websitesmanagement_website__backoffice', $data);
		return $this->db->insert_id();
	}
	function create_htaccess_website($w_id_info, $w_login_htaccess, $w_password_htaccess)
	{
		$this->db->where('id_website', $w_id_info); 
		$query = $this->db->get('470websitesmanagement_website__htaccess');
		$data = array(
			'id_website'			=> $w_id_info,
			'login_htaccess'		=> $w_login_htaccess,
			'password_htaccess'		=> $w_password_htaccess,
		);
		$this->db->insert('470websitesmanagement_website__htaccess', $data);
		return $this->db->insert_id();
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
				 ->update('470websitesmanagement_website__ftp', $data);
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
				 ->update('470websitesmanagement_website__database', $data);
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
				 ->update('470websitesmanagement_website__backoffice', $data);
	}
	function update_htaccess_websites($w_id_htaccess, $w_id_info, $w_login_htaccess, $w_password_htaccess)
	{
		$data = array(
			'login_htaccess'				=> $w_login_htaccess,
			'password_htaccess'				=> $w_password_htaccess,
		);

		$this->db->where('id_website', $w_id_info)
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

	function export_website($websites = "")
	{
		$sql = "";

		$this->db->select('*')
					->from('470websitesmanagement_website')
					->join('470websitesmanagement_category', '470websitesmanagement_category.id_category = 470websitesmanagement_website.id_category')
					->join('470websitesmanagement_whois', '470websitesmanagement_whois.id_whois = 470websitesmanagement_website.id_website')
					->join('470websitesmanagement_website__ftp', '470websitesmanagement_website__ftp.id_website = 470websitesmanagement_website.id_website')
					->join('470websitesmanagement_website__database', '470websitesmanagement_website__database.id_website = 470websitesmanagement_website.id_website')
					->join('470websitesmanagement_website__backoffice', '470websitesmanagement_website__backoffice.id_website = 470websitesmanagement_website.id_website')
					->join('470websitesmanagement_website__htaccess', '470websitesmanagement_website__htaccess.id_website = 470websitesmanagement_website.id_website');
		if (!empty ($websites)) {
			$this->db->where_in('470websitesmanagement_website.id_website', $websites);
		}

		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$data = array(
				'id_website' => $row->id_website,
				'id_category'  => $row->id_category,
				'id_language'  => $row->id_language,
				'name_website' => $row->name_website,
				'url_website'  => $row->url_website
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_website').";";

			$data = array(
				'id_website'  => $row->id_website,
				'id_ftp'  => $row->id_ftp,
				'host_ftp'  => $this->encryption->decrypt($row->host_ftp),
				'login_ftp'  => $this->encryption->decrypt($row->login_ftp),
				'password_ftp' => $this->encryption->decrypt($row->password_ftp)
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_website__ftp').";";

			$data = array(
				'id_website'  => $row->id_website,
				'id_database'  => $row->id_database,
				'host_database'  => $this->encryption->decrypt($row->host_database),
				'name_database' => $this->encryption->decrypt($row->name_database),
				'login_database' => $this->encryption->decrypt($row->login_database),
				'password_database'  => $this->encryption->decrypt($row->password_database)
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_website__database').";";

			$data = array(
				'id_website'  => $row->id_website,
				'id_backoffice'  =>  $row->id_backoffice,
				'host_backoffice'	=>  $this->encryption->decrypt($row->host_backoffice),
				'login_backoffice'  =>  $this->encryption->decrypt($row->login_backoffice),
				'password_backoffice'	=>  $this->encryption->decrypt($row->password_backoffice)
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_website__backoffice').";";

			$data = array(
				'id_website'  => $row->id_website,
				'id_backoffice'  => $row->id_backoffice,
				'login_htaccess'  =>  $this->encryption->decrypt($row->login_htaccess),
				'password_htaccess'	=>  $this->encryption->decrypt($row->password_htaccess)
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_website__htaccess').";";

			$data = array(
				'id_whois'  => $row->id_whois,
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
			$this->db->select_max('id_website');

			if (strpos($row,'470websitesmanagement_website') !== false) {
				$max_id_website = $this->db->get('470websitesmanagement_website')->row()->id_website+1;
			} else {
				$max_id_website = $this->db->get('470websitesmanagement_website')->row()->id_website;
			}
			$patterns = array('/VALUES \(\'(.*)\'/siU');
			$replacements = array('VALUES (\''.$max_id_website.'\'');
			$result = preg_replace($patterns,$replacements, $row);
			$this->db->query($result);
		}
	}
}