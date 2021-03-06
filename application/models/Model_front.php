<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_front extends CI_Model {

	function get_all_domains()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_website')
				 ->order_by('470websitesmanagement_website.c_id', 'ASC');

		$query = $this->db->get();
		$count_domain=0;
		foreach ($query->result() as $row)
		{
			$host = explode('.',parse_url('http://'.$row->url_website, PHP_URL_HOST));
			$host_without_www=($host[0] == 'www' ? array_splice($host,1) : $host );
			if (count($host_without_www)==2) {
				$count_domain++;
			}
		}

		return $count_domain;
	}
	function get_all_subdomains()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_website')
				 ->order_by('470websitesmanagement_website.c_id', 'ASC');

		$query = $this->db->get();
		$count_subdomain=0;
		foreach ($query->result() as $row)
		{
			$host = explode('.',parse_url('http://'.$row->url_website, PHP_URL_HOST));
			$host_without_www=($host[0] == 'www' ? array_splice($host,1) : $host );
			if (count($host_without_www)==3) {
				$count_subdomain++;
			}
		}

		return $count_subdomain;
	}
	var $column = array('w_id', 'c_title', 'l_title', 'name_website', 'url_website');
	var $order = array('name_website' => 'desc');

	private function _get_datatables_query()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_website')
				 ->join('470websitesmanagement_language', '470websitesmanagement_website.l_id = 470websitesmanagement_language.l_id')
				 ->join('470websitesmanagement_category', '470websitesmanagement_website.c_id = 470websitesmanagement_category.c_id');
		$i = 0;
		if(isset($_POST['search']['value'])){
			foreach ($this->column as $item) {
				if($i===0)
				{
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				$column[$i] = $item;
				$i++;
			}
		}
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->db->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_all_websites()
	{
		$this->_get_datatables_query();
		/*$this->db->select('*')
				 ->from('470websitesmanagement_website')
				 ->join('470websitesmanagement_language', '470websitesmanagement_website.l_id = language.l_id')
				 ->join('470websitesmanagement_category', '470websitesmanagement_website.c_id = category.c_id')
				 ->order_by('470websitesmanagement_website.w_id', 'ASC');*/
		if (isset($_POST['length']) && isset($_POST['start'])) {
			if($_POST['length'] != -1){
				$this->db->limit($_POST['length'], $_POST['start']);
			}				 	
		}

		$query = $this->db->get();
		return $query;
	}
	function count_all_websites_per_page()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query;
	}
	function get_all_websites_per_category($url)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_website')
				 ->join('470websitesmanagement_category', '470websitesmanagement_website.c_id = 470websitesmanagement_category.c_id')
				 ->where('c_title_url', $url)
				 ->order_by('470websitesmanagement_website.c_id', 'ASC');

		$query = $this->db->get();
		return $query;
	}
	function get_all_websites_per_language($url)
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_website')
				 ->join('470websitesmanagement_language', '470websitesmanagement_website.l_id = 470websitesmanagement_language.l_id')
				 ->where('l_title_url', $url)
				 ->order_by('470websitesmanagement_website.l_id', 'ASC');

		$query = $this->db->get();
		return $query;
	}
	function get_all_languages()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_language');

		$query = $this->db->get();
		return $query;
	}
	function get_all_categories()
	{
		$this->db->select('*')
				 ->from('470websitesmanagement_category');

		$query = $this->db->get();
		return $query;
	}
	function get_website($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_website')
				->join('470websitesmanagement_ftp', '470websitesmanagement_ftp.id_website = 470websitesmanagement_website.w_id')
				->join('470websitesmanagement_database', '470websitesmanagement_database.id_website = 470websitesmanagement_website.w_id')
				->join('470websitesmanagement_backoffice', '470websitesmanagement_backoffice.id_website = 470websitesmanagement_website.w_id')
				->join('470websitesmanagement_language', '470websitesmanagement_website.l_id = 470websitesmanagement_language.l_id')
				->join('470websitesmanagement_category', '470websitesmanagement_website.c_id = 470websitesmanagement_category.c_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_category($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_category')
				->where('c_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_language($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_language')
				->where('l_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_website_per_ftp($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_website')
				->join('470websitesmanagement_ftp', '470websitesmanagement_ftp.id_website = 470websitesmanagement_website.w_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_website_per_database($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_website')
				->join('470websitesmanagement_database', '470websitesmanagement_database.id_website = 470websitesmanagement_website.w_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_website_per_backoffice($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_website')
				->join('470websitesmanagement_backoffice', '470websitesmanagement_backoffice.id_website = 470websitesmanagement_website.w_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_website_per_htaccess($id)
	{
		$this->db->select('*')
				->from('470websitesmanagement_website')
				->join('470websitesmanagement_htaccess', '470websitesmanagement_htaccess.id_website = 470websitesmanagement_website.w_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function count_all_websites()
	{
		$this->db->select('count(*) as count_all_websites')
				 ->from('470websitesmanagement_website');
		$query = $this->db->get();
		return $query;
	}
	function count_websites_per_category()
	{
		$this->db->select('*, (SELECT count(*) from 470websitesmanagement_website WHERE 470websitesmanagement_website.c_id = 470websitesmanagement_category.c_id) as count_websites_per_category')
				 ->from('470websitesmanagement_category')
				 ->group_by('470websitesmanagement_category.c_id');

		$query = $this->db->get();
		return $query;
	}
	function count_websites_per_language()
	{
		$this->db->select('*, (SELECT count(*) from 470websitesmanagement_website WHERE 470websitesmanagement_website.l_id = 470websitesmanagement_language.l_id) as count_websites_per_language')
				 ->from('470websitesmanagement_language')
				 ->group_by('470websitesmanagement_language.l_id');

		$query = $this->db->get();
		return $query;
	}
}