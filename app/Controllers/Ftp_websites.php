<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ftp_websites extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_users','model_settings'));
		$this->load->library(array('user_agent','Aauth','form_validation','encryption','session','ftp'));
		$this->load->helper(array('functions', 'text', 'number', 'url','language','file'));
		$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
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
	public function index($id_website = '')
	{
		$data['user'] = $this->aauth->get_user();
		$data['user_role'] = $this->aauth->get_user_groups();

		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$data['id_ftp'] = $this->input->post('id_ftp');

		if (!empty($id_website) && !empty($data['id_ftp']) ) {
			$row = $this->model_front->get_website_by_ftp($id_website, $data['id_ftp']);

			if (!empty($row->host_ftp) && !empty($row->login_ftp) && !empty($row->password_ftp)) {
				$config['hostname'] = $row->host_ftp;
				$config['username'] = $row->login_ftp;
				$config['password'] = $row->password_ftp;

				$this->ftp->connect($config);
				$data['path_server'] = '/';

				$data['all_storage_server'] = $this->ftp->list_files_details($data['path_server']);
				$data['id_website'] = $id_website;
				$this->load->view('general/view-ftp-websites', $data);
			}
		}
	}
	public function refreshftp($id_website = '')
	{
		$path = $this->input->post('path');
		$id_ftp = $this->input->post('id_ftp');

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$data['folder'] = $this->ftp->list_files_details($path);
		echo json_encode($data);
	}
	public function openfolderftp($id_website = '')
	{
		$path = $this->input->post('path');
		$file = $this->input->post('file');
		$id_ftp = $this->input->post('id_ftp');

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);
		
		$path = path_jointure_file($path,$file);
		if (strrpos($path, '/..')==true) {
			$path = (strrpos($path, '/',-4) == 0 ?'/':substr($path,0,strrpos($path, '/',-4)));
			/*$path_delete_two_point = str_replace("/..","",$path);
			$path = (dirname($path_delete_two_point)=="\\"?"/":dirname($path_delete_two_point));*/
		} elseif($path == '/..') {
			$path = "/";
		}

		$data['path'] = $path;
		$data['folder'] = $this->ftp->list_files_details($path);
		echo json_encode($data);
	}
	public function mkdirftp($id_website = '')
	{
		$path = $this->input->post('path');
		$createfolder = $this->input->post('createfolder');
		$item_download = path_jointure_file($path,$createfolder);
		$id_ftp = $this->input->post('id_ftp');

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$this->ftp->mkdir($item_download, 0755);
		$data = $this->ftp->file_details($path,$createfolder);

		$this->ftp->close();

		echo json_encode($data);
	}
	public function uploadftp($id_website = '')
	{
		ini_set('upload_max_filesize', '0');
		ini_set('post_max_size', '0');
		ini_set('max_input_time', 0);
		ini_set('max_execution_time', 0);

		$path = $this->input->post('path');
		$file = $this->input->post('file');
		$id_ftp = $this->input->post('id_ftp');

		$source_to_local = $_FILES["uploadfile"]["tmp_name"];

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$this->ftp->upload($source_to_local, path_jointure_file($path,$file), 'auto', 0775);
		$data = $this->ftp->file_details($path,$file);

		$this->ftp->close();

		echo json_encode($data);
	}
	public function downloadftp($id_website = '')
	{
		$path = $this->input->post('path');
		$file = $this->input->post('file');
		$id_ftp = $this->input->post('id_ftp');
		$chmod_permissions = $this->input->post('chmod_permissions');
		$item_download = path_jointure_file($path,$file);

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);
		if ($chmod_permissions != "d") {
			$this->ftp->download($item_download, 'php://output', 'auto');
		} else {
			$this->ftp->download_folder($item_download, 'php://output', 'auto');
		}
		
		$this->ftp->close();
	}
	public function moveftp($id_website = '')
	{
		$old_path = $this->input->post('old_path');
		$new_path = $this->input->post('new_path');
		$file = $this->input->post('file');
		$id_ftp = $this->input->post('id_ftp');

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);
		$this->ftp->move(path_jointure_file($old_path,$file), path_jointure_file($new_path,$file));
		$data = $this->ftp->file_details($new_path,$file);

		$this->ftp->close();

		echo json_encode($data);
	}
	public function renameftp($id_website = '')
	{
		$path = $this->input->post('path');
		$oldrename = $this->input->post('oldrenamefile');
		$newrename = $this->input->post('renamefile');
		$id_ftp = $this->input->post('id_ftp');

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);
		$this->ftp->rename(path_jointure_file($path,$oldrename), path_jointure_file($path,$newrename));

		$this->ftp->close();
	}
	public function chmodftp($id_website = '')
	{
		$path = $this->input->post('path');
		$file = $this->input->post('file');
		$chmod = $this->input->post('chmod');
		$id_ftp = $this->input->post('id_ftp');

		$item_download = path_jointure_file($path,$file);

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);
		$data = $this->ftp->chmod($item_download, $chmod);
		
		$this->ftp->close();
		echo json_encode($data);
	}
	public function test($id_website = '')
	{
		//$file = "/civuejs.zip";

		/*$file = $this->input->post('file');
		$path = $this->input->post('path');
		$item_delete = path_jointure_file($path,$file);*/

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		//$this->ftp->extract_zip($file);

		$this->ftp->close();
	}
	public function deleteftp($id_website = '')
	{
		$file = $this->input->post('file');
		$path = $this->input->post('path');
		$chmod_permissions = $this->input->post('chmod_permissions');
		$item_delete = path_jointure_file($path,$file);
		$id_ftp = $this->input->post('id_ftp');

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		if ($chmod_permissions != "d") {
			$this->ftp->delete_file($item_delete);
		} else {
			$this->ftp->delete_dir($item_delete);
		}
	}
	public function readfileftp($id_website = '')
	{
		$path = $this->input->post('path');
		$file = $this->input->post('file');
		$id_ftp = $this->input->post('id_ftp');

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);
		$data = $this->ftp->read_file(path_jointure_file($path,$file));
		echo json_encode($data);
	}
	public function writefileftp($id_website = '')
	{
		$path = $this->input->post('path');
		$file = $this->input->post('file');
		$content = $this->input->post('content');
		$id_ftp = $this->input->post('id_ftp');

		$row =  $this->model_front->get_website_by_ftp($id_website, $id_ftp);

		$config['hostname'] = $row->host_ftp;
		$config['username'] = $row->login_ftp;
		$config['password'] = $row->password_ftp;

		$this->ftp->connect($config);

		$data = $this->ftp->write_file(path_jointure_file($path,$file),$content);
	}
}