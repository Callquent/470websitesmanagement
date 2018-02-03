<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_website extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_back');
		$this->load->model('model_whois');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','Whois','form_validation', 'encrypt', 'session','email'));
		$this->load->helper(array('functions','url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index()
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

		$this->load->view('add-website',$data);
	}
	public function submit()
	{
		$c_id				= $this->input->post('categories');
		$l_id				= $this->input->post('languages');
		$name_website			= $this->input->post('nom');
		$url_website			= $this->input->post('url');

		$w_host_ftp			= $this->input->post('hostftp');
		$w_login_ftp		= $this->input->post('loginftp');
		$w_password_ftp		= $this->input->post('passwordftp');

		$w_host_db			= $this->input->post('hostsql');
		$w_name_db			= $this->input->post('namedatabase');
		$w_login_db			= $this->input->post('loginsql');
		$w_password_db		= $this->input->post('passwordsql');

		$w_host_bo			= $this->input->post('adminhost');
		$w_login_bo			= $this->input->post('adminlogin');
		$w_password_bo		= $this->input->post('adminpassword');

		$w_login_htaccess			= $this->input->post('loginhtaccess');
		$w_password_htaccess		= $this->input->post('passwordhtaccess');

		/*$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() == TRUE){*/
			$domain = new Whois($url_website);
			$whois = $domain->whoisdomain();

			$website_id = $this->model_back->create_websites($c_id, $l_id, $name_website, $url_website);
			$date_create = str_replace(array('/', '.'), '-', $whois[1]);
			$date_expire = str_replace(array('/', '.'), '-', $whois[2]);
			
			$this->model_whois->create_all_whois($website_id,utf8_encode($whois[0]),($whois[1] ? date("Y-m-d", strtotime($date_create)): null),($whois[2] ? date("Y-m-d", strtotime($date_expire)): null), ($whois[3] ? trim($whois[3]): null));
			$pos = strrpos($url_website, ".fr");
			if (!$pos === false) {
				sleep(10);
			}
			$this->model_back->create_ftp_websites($website_id, $w_host_ftp, $w_login_ftp, $w_password_ftp);
			$this->model_back->create_database_websites($website_id, $w_host_db, $w_name_db, $w_login_db, $w_password_db);
			$this->model_back->create_backoffice_websites($website_id, $w_host_bo, $w_login_bo, $w_password_bo);
			$this->model_back->create_htaccess_websites($website_id, $w_login_htaccess, $w_password_htaccess);
		/*}*/
	}
}
