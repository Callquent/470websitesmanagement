<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_import_export extends CI_Model {
	function check_url_website($url_website)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_website')
				 ->where('470websitesmanagement_website.url_website', $url_website)
				 ->limit(1);


		$query = $this->db->get();
		return $query->row();
	}
	function get_selected_websites($id_websites = "")
	{
		$this->db->select('*')
					->from('470websitesmanagement_website')
					->join('470websitesmanagement_language', '470websitesmanagement_website.id_language = 470websitesmanagement_language.id_language')
					->join('470websitesmanagement_category', '470websitesmanagement_website.id_category = 470websitesmanagement_category.id_category');
		if (!empty ($id_websites)) {
			$this->db->where_in('470websitesmanagement_website.id_website', $id_websites);
		}
		$query = $this->db->get();

		return $query;
	}
}