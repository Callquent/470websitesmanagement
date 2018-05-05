<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ftp_websites extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_tasks');
		$this->load->model('model_users');
		$this->load->model('model_settings');
		$this->load->library(array('user_agent','Aauth','form_validation','encrypt','session','ftp'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index($id_ftp_websites = '')
	{
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();

		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		if (!empty($id_ftp_websites)) {
			$row = $this->model_front->get_website($id_ftp_websites)->row();
			if (!empty($row->host_ftp) && !empty($row->login_ftp) && !empty($row->password_ftp)) {
				$config['hostname'] = $row->host_ftp;
				$config['username'] = $row->login_ftp;
				$config['password'] = $row->password_ftp;

				$this->ftp->connect($config);
				$data['path_server'] = '/';

				$data['list'] = $this->ftp->list_files($data['path_server']);
				foreach ($data['list'] as $row) {
					if ($row["type"]=="file") {
						$data['all_storage_server'][] = array('title' => ltrim($row["file"],'/'), 'icon' => 'file', 'size' => $row["size"], 'last_modified' => $row["last_modified"]);
					} else {
						$data['all_storage_server'][] = array('title' => ltrim($row["file"],'/'), 'icon' => 'folder', 'size' => $row["size"], 'last_modified' => $row["last_modified"]);
					}
				}
				$data['id_ftp_websites'] = $id_ftp_websites;
				$this->load->view('view-ftp-websites', $data);
			}
		} else {
			$this->load->view('all-ftp-websites', $data);
		}

	}
	public function refreshfolderserver($id_ftp_websites = '')
	{
		$pathfolder = $this->input->post('path');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$data['list'] = $this->ftp->list_files($pathfolder);
		foreach ($data['list'] as $row) {
			if ($row["type"]=="file") {
				$tree_data[] = array('title' => pathinfo($row["file"])["basename"], 'icon' => 'file', 'size' => $row["size"], 'last_modified' => $row["last_modified"]);
			} else {
				$tree_data[] = array('title' => pathinfo($row["file"])["basename"], 'icon' => 'folder', 'size' => $row["size"], 'last_modified' => $row["last_modified"]);
			}
		}

		echo json_encode($tree_data);
	}
	public function readfileftp($id_ftp_websites = '')
	{
		/*$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;*/

		$filename = "ftp://serrurier-lyon69:YxyEcwYJbQQVKwevGrHdyeqD@176.31.21.136/public_html/index.php";
		$handle = fopen($filename, "r");
		$contents = fread($handle, filesize($filename));
		echo json_encode($contents);
	}
	public function mkdirftp($id_ftp_websites = '')
	{
		$createfolder = $this->input->post('createfolder');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$this->ftp->mkdir($createfolder, 0755);

		$this->ftp->close();
	}
	public function uploadftp($id_ftp_websites = '')
	{
		$elementupload = $this->input->post('elementupload');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$this->ftp->upload('file:///C:/DelFix.txt', $elementupload, 'ascii', 0775);

		$this->ftp->close();
	}
	public function downloadftp($id_ftp_websites = '')
	{
		/*$elementdownload = $this->input->post('elementdownload');*/

		header("Cache-Control: ");
		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename='".$elementdownload."'");


		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);
		/*$this->ftp->download("/add_vhost.php", 'C:/', 'ascii');*/
		var_dump($this->ftp->download("/add_vhost.php", 'C:/add_vhost.php', 'ascii'));
	}
	public function moveftp()
	{
		$oldmove = $this->input->post('oldmove');
		$newmove = $this->input->post('newmove');

		$this->ftp->move('/public_html/joe/blog.html', '/public_html/fred/blog.html');
	}
	public function renameftp()
	{
		$oldrename = $this->input->post('oldrename');
		$newrename = $this->input->post('newrename');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$this->ftp->rename($oldrename, $newrename);

		$this->ftp->close();
	}
	public function deleteftp($id_ftp_websites = '')
	{
		$folderdelete = $this->input->post('folderdelete');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$item = pathinfo($folderdelete);
		if (isset($item["extension"])) {
			$this->ftp->delete_file($folderdelete);
		} else {
			$this->ftp->delete_dir($folderdelete);
		}
	}

}
