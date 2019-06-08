<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_websites extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_back','model_settings'));
		$this->load->library(array('Aauth','form_validation', 'encryption', 'session','email'));
		$this->load->helper(array('functions', 'text', 'url','date','language'));
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
	public function index($id_website = "")
	{
		$data['login'] = $this->session->userdata['username'];
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


		if($this->uri->total_segments() == 1){
			
			$list = array();
			foreach ($data['all_websites']->result() as $key => $row)
			{
				$row->id_website = $row->id_website;
				$row->name_website = $row->name_website;
				$row->url_website = $row->url_website;
				$row->address_ip = ($this->input->valid_ip(gethostbyname($row->url_website))?gethostbyname($row->url_website):"ADRESSE IP NON VALIDE");
				$row->name_category = $row->name_category;
				$row->id_category = $row->id_category;
				$row->name_language = $row->name_language;
				$row->id_language = $row->id_language;

				//$data['websites'][] = $list;
			}

			$this->load->view('all-websites', $data);

		} elseif($this->uri->total_segments() == 2) {
			$data['website'] = $this->model_front->get_website($id_website);

			$website_ftp = $this->model_front->get_website_all_ftp($id_website);
			$data['ftp'] = $website_ftp;

			$website_database = $this->model_front->get_website_all_database($id_website);
			$data['database'] = $website_database;

			$website_backoffice = $this->model_front->get_website_all_backoffice($id_website);
			$data['backoffice'] = $website_backoffice;

			$website_htaccess = $this->model_front->get_website_all_htaccess($id_website);
			$data['htaccess'] = $website_htaccess;

			$this->load->view('view-details-website', $data);
		}
	}
	public function delete_website()
	{
		$id_website		= $this->input->post('id_website');
		
		// Si le site existe, on peut le supprimer
		if ($this->model_front->get_website($id_website)->num_rows() == 1){
			$this->model_back->delete_website($id_website);
		}
	}
	public function edit_website()
	{
		$this->form_validation->set_rules('id_website', 'IdWebsite', 'trim|required');
		$this->form_validation->set_rules('name_website', 'NameWebsite', 'trim|required');

		$id_website				= $this->input->post('id_website');
		$name_website			= $this->input->post('name_website');
		$url_website			= $this->input->post('url_website');
		$id_language			= $this->input->post('id_language');
		$id_category			= $this->input->post('id_category');

		if ($this->form_validation->run() !== FALSE){
			$this->model_back->update_website($id_website, $id_category, $id_language, $name_website, $url_website);
		}
		echo "string";
	}
	public function contact()
	{
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		$data['check_ftp'] = $this->input->post('check_ftp');
		$data['check_db'] = $this->input->post('check_db');
		$data['check_bo'] = $this->input->post('check_bo');

		$row = $this->model_front->get_website($id)->row();

		$this->form_validation->set_rules('email', 'email', 'required|valid_email');

		if ($this->form_validation->run() == false)
		{
			$errors = validation_errors();
			echo $errors;
		} else {
			$config['mailtype'] = "html";
			$config['charset']  = "utf-8";
			$config['newline'] = "\r\n";
			$this->email->initialize($config);

			$this->email->from('noreply@user.com', "noreply");
			$this->email->to($email); 
			$this->email->subject('Information Site Web - '.$row->name_website);
			$data['email'] = $email;

			$filename = img_url('company/logo-company.png');
			$this->email->attach($filename);
			$data['cid'] = $this->email->attachment_cid($filename);
			$data['name_website'] = $row->name_website;
			$data['url_website'] = $row->url_website;
			$data['title_language'] = $row->title_language;
			
			$data['w_host_ftp'] = $row->w_host_ftp;
			$data['w_login_ftp'] = $row->w_login_ftp;
			$data['w_password_ftp'] = $row->w_password_ftp;

			$data['w_host_db'] = $row->w_host_db;
			$data['w_name_db'] = $row->w_name_db;
			$data['w_login_db'] = $row->w_login_db;
			$data['w_password_db'] = $row->w_password_db;

			$data['w_admin_login'] = $row->w_login_bo;
			$data['w_admin_password'] = $row->w_password_bo;

			$data['w_email'] = $this->session->userdata['email'];

			$this->email->message($this->load->view('mail/template', $data, true));
			$this->email->send();
			
			echo ("Merci ! Votre message a bien été envoyé");
		}
	}
	public function create_ftp_website()
	{
		$id_website	= $this->input->post('id_website');
		$w_host_ftp	= $this->input->post('hote_ftp');
		$w_login_ftp	= $this->input->post('login_ftp');
		$w_password_ftp	= $this->input->post('password_ftp');

		$this->model_back->create_ftp_website($id_website, $this->encryption->encrypt($w_host_ftp), $this->encryption->encrypt($w_login_ftp), $this->encryption->encrypt($w_password_ftp));
	}
	public function edit_ftp_website()
	{
		$id_website		= $this->input->post('id_website');
		$id_ftp			= $this->input->post('id_ftp');
		$w_host_ftp		= $this->input->post('hote_ftp');
		$w_login_ftp	= $this->input->post('login_ftp');
		$w_password_ftp	= $this->input->post('password_ftp');

		$this->model_back->update_ftp_websites($id_ftp, $id_website, $this->encryption->encrypt($w_host_ftp), $this->encryption->encrypt($w_login_ftp), $this->encryption->encrypt($w_password_ftp));
	}
	public function delete_ftp_website()
	{
		$id_website		= $this->input->post('id_website');
		$id_ftp		= $this->input->post('id_ftp');
		
		$this->model_back->delete_ftp_website($id_ftp, $id_website);
	}
	public function create_database_website()
	{
		$id_website		= $this->input->post('id_website');
		$w_host_db		= $this->input->post('hote_database');
		$w_name_db		= $this->input->post('name_database');
		$w_login_db		= $this->input->post('login_database');
		$w_password_db	= $this->input->post('password_database');

		$this->model_back->create_database_website($id_website, $this->encryption->encrypt($w_host_db), $this->encryption->encrypt($w_name_db), $this->encryption->encrypt($w_login_db), $this->encryption->encrypt($w_password_db));
	}
	public function edit_database_website()
	{
		$id_website		= $this->input->post('id_website');
		$id_database	= $this->input->post('id_database');
		$w_host_db		= $this->input->post('hote_database');
		$w_name_db		= $this->input->post('name_database');
		$w_login_db		= $this->input->post('login_database');
		$w_password_db	= $this->input->post('password_database');

		$this->model_back->update_database_websites($id_database, $id_website, $this->encryption->encrypt($w_host_db), $this->encryption->encrypt($w_name_db), $this->encryption->encrypt($w_login_db), $this->encryption->encrypt($w_password_db));
	}
	public function delete_database_website()
	{
		$id_website		= $this->input->post('id_website');
		$id_database		= $this->input->post('id_database');
		
		$this->model_back->delete_database_website($id_database, $id_website);
	}
	public function create_backoffice_website()
	{
		$id_website	= $this->input->post('id_website');
		$w_host_bo		= $this->input->post('hote_backoffice');
		$w_login_bo		= $this->input->post('login_backoffice');
		$w_password_bo	= $this->input->post('password_backoffice');

		$this->model_back->create_backoffice_website($id_website, $this->encryption->encrypt($w_host_bo), $this->encryption->encrypt($w_login_bo), $this->encryption->encrypt($w_password_bo));
	}
	public function edit_backoffice_website()
	{
		$id_website		= $this->input->post('id_website');
		$id_backoffice	= $this->input->post('id_backoffice');
		$w_host_bo		= $this->input->post('hote_backoffice');
		$w_login_bo		= $this->input->post('login_backoffice');
		$w_password_bo	= $this->input->post('password_backoffice');

		$this->model_back->update_backoffice_websites($id_backoffice, $id_website, $this->encryption->encrypt($w_host_bo), $this->encryption->encrypt($w_login_bo), $this->encryption->encrypt($w_password_bo));
	}
	public function delete_backoffice_website()
	{
		$id_website		= $this->input->post('id_website');
		$id_backoffice		= $this->input->post('id_backoffice');
		
		$this->model_back->delete_backoffice_website($id_backoffice, $id_website);
	}
	public function create_htaccess_website()
	{
		$id_website	= $this->input->post('id_website');
		$w_login_htaccess		= $this->input->post('login_htaccess');
		$w_password_htaccess	= $this->input->post('password_htaccess');

		$this->model_back->create_htaccess_website($id_website, $this->encryption->encrypt($w_login_htaccess), $this->encryption->encrypt($w_password_htaccess));
	}
	public function edit_htaccess_website()
	{
		$id_website		= $this->input->post('id_website');
		$id_htaccess	= $this->input->post('id_htaccess');
		$w_login_htaccess		= $this->input->post('login_htaccess');
		$w_password_htaccess	= $this->input->post('password_htaccess');

		$this->model_back->update_htaccess_websites($id_htaccess, $id_website, $this->encryption->encrypt($w_login_htaccess), $this->encryption->encrypt($w_password_htaccess));
	}
	public function delete_htaccess_website()
	{
		$id_website		= $this->input->post('id_website');
		$id_htaccess		= $this->input->post('id_htaccess');
		
		$this->model_back->delete_htaccess_website($id_htaccess, $id_website);
	}
}
