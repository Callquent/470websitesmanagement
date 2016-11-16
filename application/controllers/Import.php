<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_back');
		$this->load->model('model_settings');
		$this->load->library("Aauth");
		$this->load->library('encryption');
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->library('email');
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->helper('language');
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index()
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
			$data['login'] = $this->session->userdata['username'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$this->load->view('import', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function import_470websitesmanagement()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
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

		}else {
			$this->load->view('index');
		}
	}
}
