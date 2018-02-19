<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_tasks');
		$this->load->model('model_back');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','encryption','form_validation', 'encrypt', 'session','email'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index()
	{
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();

		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('import', $data);
	}
	public function import_470websitesmanagement()
	{
		$key_secrete = $_POST['keysecrete'];
		$this->encryption->initialize(
			array(
			        'cipher' => 'aes-256',
			        'mode' => 'ctr',
			        'key' => $key_secrete
			)
		);
		if ($_FILES['importfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['importfile']['tmp_name']))
		{
			$file = file_get_contents($_FILES['importfile']['tmp_name']);
		}
		
		$decrypt = $this->encryption->decrypt($file);
		$this->model_back->import_website($decrypt);
		if (empty($decrypt)) {
			echo json_encode(array( 'type'=>'error' ));
		} else {
			echo json_encode(array( 'type'=>'success' ));
		}
	}
}
