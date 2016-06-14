<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ftp_websites extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_users');
		$this->load->model('model_settings');
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->library('ftp');
		$this->load->helper('language');
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index($w_id = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['name'];
			$data['user_role'] = $this->aauth->get_user_groups();
			$row =  $this->model_front->get_website($w_id)->row();

			$config['hostname'] = $row->w_host_ftp;
			$config['username'] = $row->w_login_ftp;
			$config['password'] = $row->w_password_ftp;

			$this->ftp->connect($config);

			$data['list'] = $this->ftp->list_files('/public_html');
			
			foreach ($data['list'] as $row) {
				/*$this->abc($row)*/
				var_dump(is_dir($row));
				if (is_file($row)) {
					$tree_data[] = array('name' => ltrim($row,'/'), 'type' => 'file-o');
				} else {
					$tree_data[] = array('name' => ltrim($row,'/'), 'type' => 'folder');
				}
				
			}
			$data['tree_data'] = json_encode($tree_data);

			$this->load->view('ftp-websites', $data);
		}else {
			$this->load->view('index');
		}
	}
    private function abc()
    {
      
    }
}
