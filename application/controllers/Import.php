<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Import extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_back','model_migration','model_tasks','model_whois','model_settings'));
		$this->load->library(array('Aauth','encryption','form_validation','session','email'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index()
	{
		$data['user'] = $this->aauth->get_user();
		$data['user_role'] = $this->aauth->get_user_groups();

		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('settings/import', $data);
	}
	public function import_470websitesmanagement()
	{
		$key_secrete = $this->input->post('keysecrete');
		$this->encryption->initialize(
			array(
			        'cipher' => 'aes-256',
			        'mode' => 'ctr',
			        'key' => $key_secrete
			)
		);

		if ($_FILES['uploadfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['uploadfile']['tmp_name']))
		{
			$file = file_get_contents($_FILES['uploadfile']['tmp_name']);
		}
		
		$decrypt = $this->encryption->decrypt($file);
		$file_unserialize = unserialize($decrypt);

		
		foreach ($file_unserialize['470websitesmanagement_category'] as $row) {

			$query = $this->model_category->check_name_category($row->name_category);
			if(empty($query)){
				$new_id_category = $this->model_category->create_category($row->name_category);
			}
			foreach ($file_unserialize['470websitesmanagement_website'] as $value) {
				if ($row->id_category == $value->id_category) {
					if(empty($query)){
						$value->id_category = $new_id_category;
						//$this->model_migration->import_website($file_unserialize);
						//array_replace($decrypt['470websitesmanagement_website'], 'id_category' => $this->db->insert_id());
					} else {
						//$test = array_replace($file_unserialize['470websitesmanagement_website'], array('id_category' => $query->id_category));
						$value->id_category = $query->id_category;
					}
				}
			}
		}
		foreach ($file_unserialize['470websitesmanagement_language'] as $row) {

			$query = $this->model_language->check_name_language($row->name_language);
			if(empty($query)){
				$new_id_language = $this->model_language->create_language($row->name_language);
			}
			foreach ($file_unserialize['470websitesmanagement_website'] as $value) {
				if ($row->id_language == $value->id_language) {
					if(empty($query)){
						$value->id_language = $new_id_language;
						//$this->model_migration->import_website($file_unserialize);
						//array_replace($decrypt['470websitesmanagement_website'], 'id_language' => $this->db->insert_id());
					} else {
						//$test = array_replace($file_unserialize['470websitesmanagement_website'], array('id_language' => $query->id_language));
						$value->id_language = $query->id_language;
					}
				}
			}
		}
		
	}
}
