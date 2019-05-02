<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_migration extends CI_Model {
	
	function export_website($websites = "")
	{
		$this->db->select('*')
					->from('470websitesmanagement_category');
		$query = $this->db->get();
		$allqueries['470websitesmanagement_category'] = $query->result();

		$this->db->select('*')
					->from('470websitesmanagement_language');
		$query = $this->db->get();
		$allqueries['470websitesmanagement_language'] = $query->result();

		$this->db->select('*')
					->from('470websitesmanagement_website');
		if (!empty ($websites)) {
			$this->db->where_in('470websitesmanagement_website.id_website', $websites);
		}
		$query = $this->db->get();
		foreach ($query->result() as $value) {
			$value->ftp = $this->export_ftp($value->id_website)->result();
			$value->database = $this->export_database($value->id_website)->result();
			$value->backoffice = $this->export_backoffice($value->id_website)->result();
			$value->htaccess = $this->export_htaccess($value->id_website)->result();
			$value->whois = $this->export_whois($value->id_website)->row();
		}
		$allqueries['470websitesmanagement_website'] = $query->result();
		return $allqueries;
	}
	function export_ftp($id_website = "")
	{
		$this->db->select('*')
					->from('470websitesmanagement_website__ftp')
					->where('470websitesmanagement_website__ftp.id_website', $id_website);

		$query = $this->db->get();
		return $query;
	}
	function export_database($id_website = "")
	{
		$this->db->select('*')
					->from('470websitesmanagement_website__database')
					->where('470websitesmanagement_website__database.id_website', $id_website);

		$query = $this->db->get();
		return $query;
	}
	function export_backoffice($id_website = "")
	{
		$this->db->select('*')
					->from('470websitesmanagement_website__backoffice')
					->where('470websitesmanagement_website__backoffice.id_website', $id_website);

		$query = $this->db->get();
		return $query;
	}
	function export_htaccess($id_website = "")
	{
		$this->db->select('*')
					->from('470websitesmanagement_website__htaccess')
					->where('470websitesmanagement_website__htaccess.id_website', $id_website);

		$query = $this->db->get();
		return $query;
	}
	function export_whois($id_website = "")
	{
		$this->db->select('*')
					->from('470websitesmanagement_whois')
					->where('470websitesmanagement_whois.id_whois', $id_website);

		$query = $this->db->get();
		return $query;
	}

		/*$sql = "";
		$this->db->select('*')
					->from('470websitesmanagement_category');
		$query = $this->db->get();
		foreach ($query->result() as $row) {
			$data = array(
				'id_category'  => $row->id_category,
				'name_category'  => $row->name_category,
				'name_url_category' => $row->name_url_category
			);
			$sql .= $this->db->set($data)->get_compiled_insert('470websitesmanagement_category').";";
		}*/
		
		/*$this->db->select('*')
					->from('470websitesmanagement_website')
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
		
		return $sql;*/
	function import_website($decrypt)
	{
		foreach ($decrypt['470websitesmanagement_category'] as $row) {
			$data = array(
				'name_category' => $name_category,
				'name_url_category' => str_replace(" ", "-", strtolower($name_category))
			);

			$this->db->insert('470websitesmanagement_category', $data);
			return $this->db->insert_id();

			if ($query->num_rows() > 0) {
				$
			}

			array_search($row->id_category, array_column($decrypt['470websitesmanagement_website'], 'id_category'));
			
		}
		/**********************************/
		$insert_sql = explode(";", $decrypt,-1);

		$this->db->select('*')
				->from('470websitesmanagement_category')
				->where('id_category', $id_category)
				->limit(1);

		$query = $this->db->get();
		$query->row();

		foreach ($insert_sql as $row) {
			if ($query->num_rows() > 0) {
				$this->db->select_max('id_category');
				$max_id_category = $this->db->get('470websitesmanagement_category')->row()->id_category;
				preg_match('/INSERT INTO 470websitesmanagement_category.*VALUES \(\'(.*)\'/siU', $row, $id_category_export);
				$pattern_category = array('/INSERT INTO 470websitesmanagement_category.*VALUES \(\'(.*)\'/siU');
				$replacements = array('INSERT INTO 470websitesmanagement_category.*VALUES (\''.$id_category_export+$max_id_category.'\'');
				$result .= preg_replace($pattern_category,$replacements, $row);
			}

			$this->db->select_max('id_website');

			if (strpos($row,'470websitesmanagement_website') !== false) {
				$max_id_website = $this->db->get('470websitesmanagement_website')->row()->id_website+1;
			} else {
				$max_id_website = $this->db->get('470websitesmanagement_website')->row()->id_website;
			}
			$patterns = array('/INSERT INTO 470websitesmanagement_category.*VALUES \(\'(.*)\',\'(.*)\',\'(.*)\',\'(.*)\',\'(.*)\'\)/siU');
			$replacements = array('INSERT INTO 470websitesmanagement_website.*VALUES (\''.$max_id_website.'\'');
			$result .= preg_replace($patterns,$replacements, $row);

			$this->db->query($result);
		}
	}
}