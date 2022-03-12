<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_migration extends CI_Model {
	function import_website($decrypt)
	{

			




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