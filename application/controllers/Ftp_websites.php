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
		$this->load->library(array('user_agent','Aauth','form_validation','encrypt','session','ftp'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index($w_id = '')
	{
		if(check_access()==true)
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
				if($this->agent->is_mobile()) {
							$data['all_storage_local'] = null;
							$data['path_local'] = null;
				} else {
					if(strpos($this->agent->platform(), "Windows") !== FALSE) {
					    foreach (range('A', 'Z') as $char) {
					        if (is_dir("file:///".$char.":")) { 
								$data['all_storage_local'][] = array('title' => $char, 'icon' => 'fa fa-2x fa-hdd-o');
								$data['path_local'] = "C:\\";
					        }
					    }
					}
					else if(strpos($this->agent->platform(), "Mac") !== FALSE) { 
						foreach (@scandir("file:///") as $value) { 
							$item = pathinfo($value);
							if (isset($item["extension"])) {
								$data['all_storage_local'][] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon file');
							} else {
								$data['all_storage_local'][] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon folder');
							}
						}
					}
					elseif(strpos($this->agent->platform(), "Linux") !== FALSE) {
						foreach (@scandir("file:///") as $value) { 
							$item = pathinfo($value);
							if (isset($item["extension"])) {
								$data['all_storage_local'][] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon file');
							} else {
								$data['all_storage_local'][] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon folder');
							}
						}
					}
				}

				$row = $this->model_front->get_website($w_id)->row();
				if (!empty($row->w_host_ftp) && !empty($row->w_login_ftp) && !empty($row->w_password_ftp)) {
					$config['hostname'] = $row->w_host_ftp;
					$config['username'] = $row->w_login_ftp;
					$config['password'] = $row->w_password_ftp;

					$this->ftp->connect($config);

					$data['path_server'] = '/';

					$data['list'] = $this->ftp->list_files('/');
					foreach ($data['list'] as $row) {
						$item = pathinfo($row);
						if (isset($item["extension"])) {
							$data['all_storage_server'][] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon file');
						} else {
							$data['all_storage_server'][] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon folder');
						}
					}
				}
			}

			$this->load->view('ftp-websites', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function refreshfolderserver($w_id = '')
	{
		if(check_access()==true)
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
					$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon file');
				} else {
					$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon folder');
				}
			}

			echo json_encode($tree_data);
		}else {
			$this->load->view('index');
		}
	}
	public function refreshfolderlocal($w_id = '')
	{
		if(check_access()==true)
		{
			$pathfolder = $this->input->post('path');

			if(strpos($this->agent->platform(), "Windows") !== FALSE) {
			    foreach (@scandir("file:///".$pathfolder) as $row) {
					$item = pathinfo($row);
					if (isset($item["extension"])) {
						$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon file');
					} else {
						$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon folder');
					}
			    }
			}
			else if(strpos($this->agent->platform(), "Mac") !== FALSE) { 
				foreach (@scandir("file:///") as $value) { 
					$item = pathinfo($value);
					if (isset($item["extension"])) {
						$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon file');
					} else {
						$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon folder');
					}
				}
			}
			elseif(strpos($this->agent->platform(), "Linux") !== FALSE) {
				foreach (@scandir("file:///") as $value) { 
					$item = pathinfo($value);
					if (isset($item["extension"])) {
						$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon file');
					} else {
						$tree_data[] = array('title' => ltrim($item["basename"],'/'), 'icon' => 'icon folder');
					}
				}
			}

			echo json_encode($tree_data);
		}else {
			$this->load->view('index');
		}
	}
	public function mkdirftp($w_id = '')
	{
		if(check_access()==true)
		{

			$row =  $this->model_front->get_website($w_id)->row();

			$config['hostname'] = $row->w_host_ftp;
			$config['username'] = $row->w_login_ftp;
			$config['password'] = $row->w_password_ftp;

			$this->ftp->connect($config);

			$this->ftp->mkdir('file:///C:/DelFix.txt', '/public_html/DelFix.txt', 'ascii', 0775);

			$this->ftp->close();

		}else {
			$this->load->view('index');
		}
	}
	public function uploadftp($w_id = '')
	{
		if(check_access()==true)
		{
			$elementupload = $this->input->post('elementupload');

			$row =  $this->model_front->get_website($w_id)->row();

			$config['hostname'] = $row->w_host_ftp;
			$config['username'] = $row->w_login_ftp;
			$config['password'] = $row->w_password_ftp;

			$this->ftp->connect($config);

			$this->ftp->upload('file:///C:/DelFix.txt', $elementupload, 'ascii', 0775);

			$this->ftp->close();

		}else {
			$this->load->view('index');
		}
	}
	public function downloadftp($w_id = '')
	{
		if(check_access()==true)
		{
			header("Cache-Control: ");
			header("Content-type: text/plain");
			header('Content-Disposition: attachment;');

			/*$elementdownload = $this->input->post('elementdownload');

			$row =  $this->model_front->get_website($w_id)->row();

			$config['hostname'] = $row->w_host_ftp;
			$config['username'] = $row->w_login_ftp;
			$config['password'] = $row->w_password_ftp;

			$this->ftp->connect($config);

			$this->ftp->download($elementdownload, 'file:///C:/DelFix.txt', 'ascii', 0775);

			$this->ftp->close();*/
		}else {
			$this->load->view('index');
		}
	}
	public function moveftp()
	{
		if(check_access()==true)
		{
			$oldmove = $this->input->post('oldmove');
			$newmove = $this->input->post('newmove');

			$this->ftp->move('/public_html/joe/blog.html', '/public_html/fred/blog.html');
		}else {
			$this->load->view('index');
		}
	}
	public function renameftp()
	{
		if(check_access()==true)
		{
			$oldrename = $this->input->post('oldrename');
			$newrename = $this->input->post('newrename');

			$row =  $this->model_front->get_website($w_id)->row();

			$config['hostname'] = $row->w_host_ftp;
			$config['username'] = $row->w_login_ftp;
			$config['password'] = $row->w_password_ftp;

			$this->ftp->connect($config);

			$this->ftp->rename('/public_html/foo/green.html', '/public_html/foo/blue.html');

			$this->ftp->close();
		}else {
			$this->load->view('index');
		}
	}
	public function deleteftp($w_id = '')
	{
		if(check_access()==true)
		{
			$elementdelete = $this->input->post('elementdelete');

			$row =  $this->model_front->get_website($w_id)->row();

			$config['hostname'] = $row->w_host_ftp;
			$config['username'] = $row->w_login_ftp;
			$config['password'] = $row->w_password_ftp;

			$this->ftp->connect($config);

			$data['list'] = $this->ftp->list_files($elementdelete);
			foreach ($data['list'] as $row) {
				$item = pathinfo($row);
				if (isset($item["extension"])) {
					$this->ftp->delete_file($row);
				} else {
					$this->ftp->delete_dir($row);
				}
				
			}
		}else {
			$this->load->view('index');
		}
	}

}
