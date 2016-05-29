<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_front extends CI_Model {

	function get_all_domains()
	{
		$this->db->select('*')
				 ->from('website_info')
				 ->order_by('website_info.c_id', 'ASC');

		$query = $this->db->get();
		$count_domain=0;
		foreach ($query->result() as $row)
		{
			$host = explode('.',parse_url('http://'.$row->w_url_rw, PHP_URL_HOST));
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
				 ->from('website_info')
				 ->order_by('website_info.c_id', 'ASC');

		$query = $this->db->get();
		$count_subdomain=0;
		foreach ($query->result() as $row)
		{
			$host = explode('.',parse_url('http://'.$row->w_url_rw, PHP_URL_HOST));
			$host_without_www=($host[0] == 'www' ? array_splice($host,1) : $host );
			if (count($host_without_www)==3) {
				$count_subdomain++;
			}
		}

		return $count_subdomain;
	}
	var $column = array('w_id', 'c_title', 'l_title', 'w_title', 'w_url_rw');
	var $order = array('w_title' => 'desc');

	private function _get_datatables_query()
	{
		$this->db->select('*')
				 ->from('website_info')
				 ->join('language', 'website_info.l_id = language.l_id')
				 ->join('category', 'website_info.c_id = category.c_id');
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
				 ->from('website_info')
				 ->join('language', 'website_info.l_id = language.l_id')
				 ->join('category', 'website_info.c_id = category.c_id')
				 ->order_by('website_info.w_id', 'ASC');*/
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
				 ->from('website_info')
				 ->join('language', 'website_info.l_id = language.l_id')
				 ->join('category', 'website_info.c_id = category.c_id')
				 ->where('c_title_url', $url)
				 ->order_by('website_info.c_id', 'ASC');

		$query = $this->db->get();
		return $query;
	}
	function get_all_websites_per_language($url)
	{
		$this->db->select('*')
				 ->from('website_info')
				 ->join('language', 'website_info.l_id = language.l_id')
				 ->join('category', 'website_info.c_id = category.c_id')
				 ->where('l_title_url', $url)
				 ->order_by('website_info.l_id', 'ASC');

		$query = $this->db->get();
		return $query;
	}
	function get_all_languages()
	{
		$this->db->select('*')
				 ->from('language');

		$query = $this->db->get();
		return $query;
	}
	function get_all_categories()
	{
		$this->db->select('*')
				 ->from('category');

		$query = $this->db->get();
		return $query;
	}
	function get_website($id)
	{
		$this->db->select('*')
				->from('website_info')
				->join('website_ftp', 'website_ftp.w_id_info = website_info.w_id')
				->join('website_database', 'website_database.w_id_info = website_info.w_id')
				->join('website_backoffice', 'website_backoffice.w_id_info = website_info.w_id')
				->join('language', 'website_info.l_id = language.l_id')
				->join('category', 'website_info.c_id = category.c_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_category($id)
	{
		$this->db->select('*')
				->from('category')
				->where('c_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_language($id)
	{
		$this->db->select('*')
				->from('language')
				->where('l_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_website_per_ftp($id)
	{
		$this->db->select('*')
				->from('website_info')
				->join('website_ftp', 'website_ftp.w_id_info = website_info.w_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_website_per_database($id)
	{
		$this->db->select('*')
				->from('website_info')
				->join('website_database', 'website_database.w_id_info = website_info.w_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function get_website_per_backoffice($id)
	{
		$this->db->select('*')
				->from('website_info')
				->join('website_backoffice', 'website_backoffice.w_id_info = website_info.w_id')
				->where('w_id', $id)
				->limit(1);

		$query = $this->db->get();
		return $query;
	}
	function count_all_websites()
	{
		$this->db->select('count(*) as count_all_websites')
				 ->from('website_info');
		$query = $this->db->get();
		return $query;
	}
	function count_websites_per_category()
	{
		$this->db->select('*, (SELECT count(*) from website_info WHERE website_info.c_id = category.c_id) as count_websites_per_category')
				 ->from('category')
				 ->group_by('category.c_id');

		$query = $this->db->get();
		return $query;
	}
	function count_websites_per_language()
	{
		$this->db->select('*, (SELECT count(*) from website_info WHERE website_info.l_id = language.l_id) as count_websites_per_language')
				 ->from('language')
				 ->group_by('language.l_id');

		$query = $this->db->get();
		return $query;
	}
}