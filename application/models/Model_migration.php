<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_migration extends CI_Model {
	function import_website($decrypt)
	{
		foreach ($decrypt as $row) {
			$data = array(
				'id_website' => $row->id_website,
				'id_category'  => $row->id_category,
				'id_language'  => $row->id_language,
				'name_website' => $row->name_website,
				'url_website'  => $row->url_website
			);
			$this->db->insert('470websitesmanagement_website', $data);
				foreach ($row->ftp as $value) {
					$data = array(
						'id_website'  => $value->id_website,
						'id_ftp'  => $value->id_ftp,
						'host_ftp'  => $this->encryption->encrypt($value->host_ftp),
						'login_ftp'  => $this->encryption->encrypt($value->login_ftp),
						'password_ftp' => $this->encryption->encrypt($value->password_ftp)
					);
					$this->db->insert('470websitesmanagement_website__ftp', $data);
				}
				foreach ($row->database as $value) {
					$data = array(
						'id_website'  => $value->id_website,
						'id_database'  => $value->id_database,
						'host_database'  => $this->encryption->encrypt($value->host_database),
						'name_database' => $this->encryption->encrypt($value->name_database),
						'login_database' => $this->encryption->encrypt($value->login_database),
						'password_database'  => $this->encryption->encrypt($value->password_database)
					);
					$this->db->insert('470websitesmanagement_website__database', $data);
				}
				foreach ($row->backoffice as $value) {
					$data = array(
						'id_website'  => $value->id_website,
						'id_backoffice'  =>  $value->id_backoffice,
						'host_backoffice'	=>  $this->encryption->encrypt($value->host_backoffice),
						'login_backoffice'  =>  $this->encryption->encrypt($value->login_backoffice),
						'password_backoffice'	=>  $this->encryption->encrypt($value->password_backoffice)
					);
					$this->db->insert('470websitesmanagement_website__backoffice', $data);
				}
				foreach ($row->htaccess as $value) {
					$data = array(
						'id_website'  => $value->id_website,
						'id_backoffice'  => $value->id_backoffice,
						'login_htaccess'  =>  $this->encryption->encrypt($value->login_htaccess),
						'password_htaccess'	=>  $this->encryption->encrypt($value->password_htaccess)
					);
					$this->db->insert('470websitesmanagement_website__htaccess', $data);
				}
				foreach ($row->whois as $value) {
					$data = array(
						'id_whois'  => $value->id_whois,
						'creation_date' => $value->creation_date,
						'expiration_date'  => $value->expiration_date,
						'registrar'  => $value->registrar,
						'release_date_whois'  => $value->release_date_whois
					);
					$this->db->insert('470websitesmanagement_whois', $data);
				}
		}
			




		/**********************************/
		/*$insert_sql = explode(";", $decrypt,-1);

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
		}*/
	}
}