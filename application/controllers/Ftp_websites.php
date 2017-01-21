<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ftp_websites extends CI_Controller {

	public function __construct()
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
			$data['all_websites'] = $this->model_front->get_all_websites();
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['username'];
			$data['user_role'] = $this->aauth->get_user_groups();
			if (!empty($w_id)) {
				$row = $this->model_front->get_website($w_id)->row();
				if (!empty($row->w_host_ftp) && !empty($row->w_login_ftp) && !empty($row->w_password_ftp)) {
					$config['hostname'] = $row->w_host_ftp;
					$config['username'] = $row->w_login_ftp;
					$config['password'] = $row->w_password_ftp;

					$this->ftp->connect($config);

					$data['path'] = '/';

					$data['list'] = $this->ftp->list_files('/');
					foreach ($data['list'] as $row) {
						$item = pathinfo($row);
						if (isset($item["extension"])) {
							$data['all_folder_first_level'][] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'fa fa-file');
						} else {
							$data['all_folder_first_level'][] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'fa fa-folder');
						}
					}
				}
			}

			$this->load->view('ftp-websites', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function refreshfolder($w_id = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$pathfolder = $this->input->post('path');

			$row =  $this->model_front->get_website($w_id)->row();

			$config['hostname'] = $row->w_host_ftp;
			$config['username'] = $row->w_login_ftp;
			$config['password'] = $row->w_password_ftp;

			$this->ftp->connect($config);

			$data['list'] = $this->ftp->list_files($pathfolder);
			foreach ($data['list'] as $row) {
				$item = pathinfo($row);
				if (isset($item["extension"])) {
					$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'fa fa-file');
				} else {
					$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'fa fa-folder');
				}
			}

			echo json_encode($tree_data);
		}else {
			$this->load->view('index');
		}
	}
	public function createftp()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{

		}else {
			$this->load->view('index');
		}
	}
	public function deleteftp($w_id = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$pathftp = $this->input->post('pathftp');

			$row =  $this->model_front->get_website($w_id)->row();

			$config['hostname'] = $row->w_host_ftp;
			$config['username'] = $row->w_login_ftp;
			$config['password'] = $row->w_password_ftp;

			$this->ftp->connect($config);

			$data['list'] = $this->ftp->list_files($pathftp);
			foreach ($data['list'] as $row) {
				$item = pathinfo($row);
				if (isset($item["extension"])) {
					$this->ftp->delete_file('/public_html/joe/blog.html');
				} else {
					$this->ftp->delete_dir('/public_html/path/to/folder/');
				}
				
			}
		}else {
			$this->load->view('index');
		}
	}
	public function renameftp()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{

		}else {
			$this->load->view('index');
		}
	}
}
