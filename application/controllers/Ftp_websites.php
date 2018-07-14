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
		$this->load->library(array('user_agent','Aauth','form_validation','encryption','session','ftp'));
		$this->load->helper(array('functions', 'text', 'url','language','file'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		$this->encryption->initialize(
			array(
			        'cipher' => 'aes-256',
			        'mode' => 'ctr',
			        'key' => $this->config->item('encryption_key')
			)
		);

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
				$config['password'] = $this->encryption->decrypt($row->password_ftp);

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
		$config['password'] = $this->encryption->decrypt($row->password_ftp);

		$this->ftp->connect($config);
		$path_back_folder = str_replace("/..","",$pathfolder);
		$path[] = array('path_server' => (strrpos($pathfolder, '/..')==true?rtrim($path_back_folder,pathinfo($path_back_folder)["basename"]):$pathfolder) );
		
		$data['list'] = $this->ftp->list_files($pathfolder);
		foreach ($data['list'] as $row) {
			if ($row["type"]=="file") {
				$tree_data[] = array('title' => pathinfo($row["file"])["basename"], 'icon' => 'file', 'size' => $row["size"], 'last_modified' => $row["last_modified"]);
			} else {
				$tree_data[] = array('title' => pathinfo($row["file"])["basename"], 'icon' => 'folder', 'size' => $row["size"], 'last_modified' => $row["last_modified"]);
			}
		}
		$data[] = $path;
		$data[] = $tree_data;
		echo json_encode($data);
	}
	public function mkdirftp($id_ftp_websites = '')
	{
		$createfolder = $this->input->post('createfolder');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $this->encryption->decrypt($row->password_ftp);

		$this->ftp->connect($config);

		$this->ftp->mkdir($createfolder, 0755);

		$this->ftp->close();
	}
	public function uploadftp($id_ftp_websites = '')
	{
		ini_set('upload_max_filesize', '0');
		ini_set('post_max_size', '0');
		ini_set('max_input_time', 0);
		ini_set('max_execution_time', 0);

		$destination_to_server = $this->input->post('path');
		$source_to_local = $_FILES["uploadfile"]["tmp_name"];
		var_dump($_FILES);

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $this->encryption->decrypt($row->password_ftp);

		$this->ftp->connect($config);

		$this->ftp->upload($source_to_local, $destination_to_server, 'auto', 0775);

		$this->ftp->close();
	}
	public function downloadftp($id_ftp_websites = '')
	{
		/*$source_to_server = $this->input->post('path');
		$file = $this->input->post('file');*/

		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename=\"sans-titre-1.psd\"");
		/*header("Content-Disposition: attachment; filename=".$file);*/

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $this->encryption->decrypt($row->password_ftp);

		$this->ftp->connect($config);

				
		/*$this->ftp->download($source_to_server, 'php://output', 'auto');*/

		
		$this->ftp->download('/sans-titre-1.psd', 'php://output', 'auto');
	}
	/*public function moveftp()
	{
		$oldmove = $this->input->post('oldmove');
		$newmove = $this->input->post('newmove');

		$this->ftp->move('/public_html/joe/blog.html', '/public_html/fred/blog.html');
	}*/
	public function renameftp()
	{
		$oldrename = $this->input->post('oldrename');
		$newrename = $this->input->post('newrename');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $this->encryption->decrypt($row->password_ftp);

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
		$config['password'] = $this->encryption->decrypt($row->password_ftp);

		$this->ftp->connect($config);

		$item = pathinfo($folderdelete);
		if (isset($item["extension"])) {
			$this->ftp->delete_file($folderdelete);
		} else {
			$this->ftp->delete_dir($folderdelete);
		}
	}
	public function readfileftp($id_ftp_websites = '')
	{
		$filepath = $this->input->post('file');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $this->encryption->decrypt($row->password_ftp);

		$this->ftp->connect($config);
		$data = $this->ftp->read_file($filepath);
		echo json_encode($data);
	}
	public function writefileftp($id_ftp_websites = '')
	{
		$filepath = $this->input->post('file');
		$content = $this->input->post('content');

		$row =  $this->model_front->get_website($id_ftp_websites)->row();

		/*$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $this->encryption->decrypt($row->password_ftp);

		$this->ftp->connect($config);*/
		/*$data = $this->ftp->write_file($filepath,$content);*/
		$fp = fopen('php://temp', 'r+');
		fwrite($fp, $content);
		rewind($fp);

		$conn_id = ftp_connect($row->host_ftp);
		$login_result = ftp_login($conn_id, $row->login_ftp, $this->encryption->decrypt($row->password_ftp));
		ftp_fput($conn_id, $filepath, $fp, FTP_ASCII);
	}
}
