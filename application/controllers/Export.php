<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Export extends CI_Controller {
	function __construct()
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
		$key = bin2hex($this->encryption->create_key(6));
		var_dump($key);
		$this->encryption->initialize(
			array(
			        'cipher' => 'aes-256',
			        'mode' => 'ctr',
			        'key' => $key
			)
		);
		$ciphertext = $this->encryption->encrypt('Nom,"Site Web","Hebergeur","Date de mise en ligne","Date d ,expiration","Whois"');
		var_dump($ciphertext);
		$reponse=$this->encryption->decrypt($ciphertext);
		var_dump($reponse);

		$this->load->helper('file');
		if ( ! write_file('c:/websitesmanagement.470', $ciphertext))
		{
		    echo 'Unable to write the file';
		}
		else
		{
		    echo 'File written!';
		}

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

			$this->load->view('import', $data);
		}else {
			$this->load->view('index');
		}
	}
}
