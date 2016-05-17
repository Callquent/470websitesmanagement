<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_website extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_back');
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->helper(array('functions','url'));
	}
	public function index()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$data['all_websites'] = $this->model_front->get_all_websites();
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['name'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$this->load->view('add-website',$data);
		}else {
			$this->load->view('index');
		}
	}
	public function submit()
	{		
		$c_id				= $this->input->post('categories');
		$l_id				= $this->input->post('languages');
		$w_title			= $this->input->post('nom');
		$w_url_rw			= $this->input->post('url');

		$w_host_ftp			= $this->input->post('hostftp');
		$w_login_ftp		= $this->input->post('loginftp');
		$w_password_ftp		= $this->input->post('passwordftp');

		$w_host_db			= $this->input->post('hostsql');
		$w_name_db			= $this->input->post('namedatabase');
		$w_login_db			= $this->input->post('loginsql');
		$w_password_db		= $this->input->post('passwordsql');

		$w_login_bo			= $this->input->post('adminlogin');
		$w_password_bo		= $this->input->post('adminpassword');

		/*$this->form_validation->set_rules('nom', 'Nom', 'required');
		$this->form_validation->set_rules('url', 'Url', 'required');

		if ($this->form_validation->run() == TRUE){*/
			$website_id = $this->model_back->create_websites($c_id, $l_id, $w_title, $w_url_rw);
			$this->model_back->create_ftp_websites($website_id, $w_host_ftp, $w_login_ftp, $w_password_ftp);
			$this->model_back->create_database_websites($website_id, $w_host_db, $w_name_db, $w_login_db, $w_password_db);
			$this->model_back->create_backoffice_websites($website_id, $w_login_bo, $w_password_bo);
		/*}*/

	}
}
