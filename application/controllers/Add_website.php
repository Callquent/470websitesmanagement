<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_website extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_back','model_whois','model_settings'));
		$this->load->library(array('Aauth','Whois','encryption','form_validation', 'session','email'));
		$this->load->helper(array('functions','url','language'));
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
		
		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('add-website',$data);
	}
	public function submit()
	{
		$name_website		= $this->input->post('name_website');
		$url_website		= $this->input->post('url_website');
		$id_category		= $this->input->post('id_category');
		$id_language		= $this->input->post('id_language');

		$this->encryption->initialize(
			array(
			        'cipher' => 'aes-256',
			        'mode' => 'ctr',
			        'key' => $this->config->item('encryption_key')
			)
		);
		
		$host_ftp				= $this->encryption->encrypt($this->input->post('host_ftp'));
		$login_ftp				= $this->encryption->encrypt($this->input->post('login_ftp'));
		$password_ftp			= $this->encryption->encrypt($this->input->post('password_ftp'));

		$host_db				= $this->encryption->encrypt($this->input->post('host_db'));
		$name_db				= $this->encryption->encrypt($this->input->post('name_db'));
		$login_db				= $this->encryption->encrypt($this->input->post('login_db'));
		$password_db			= $this->encryption->encrypt($this->input->post('password_db'));

		$host_bo				= $this->encryption->encrypt($this->input->post('host_bo'));
		$login_bo				= $this->encryption->encrypt($this->input->post('login_bo'));
		$password_bo			= $this->encryption->encrypt($this->input->post('password_bo'));

		$login_htaccess		= $this->encryption->encrypt($this->input->post('login_htaccess'));
		$password_htaccess	= $this->encryption->encrypt($this->input->post('password_htaccess'));

		/*$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() == TRUE){*/
			$domain = new Whois($url_website);
			$whois = $domain->whoisdomain();

			$website_id = $this->model_back->create_websites($id_category, $id_language, $name_website, $url_website);
			$date_create = str_replace(array('/', '.'), '-', $whois[1]);
			$date_expire = str_replace(array('/', '.'), '-', $whois[2]);
			
			$this->model_whois->create_all_whois($website_id,utf8_encode($whois[0]),($whois[1] ? date("Y-m-d", strtotime($date_create)): null),($whois[2] ? date("Y-m-d", strtotime($date_expire)): null), ($whois[3] ? trim($whois[3]): null));
			$pos = strrpos($url_website, ".fr");
			if (!$pos === false) {
				sleep(10);
			}
			$this->model_back->create_ftp_website($website_id, $host_ftp, $login_ftp, $password_ftp);
			$this->model_back->create_database_website($website_id, $host_db, $name_db, $login_db,$password_db);
			$this->model_back->create_backoffice_website($website_id, $host_bo, $login_bo, $password_bo);
			$this->model_back->create_htaccess_website($website_id, $login_htaccess, $password_htaccess);
		/*}*/
	}
}
