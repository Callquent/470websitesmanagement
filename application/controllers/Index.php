<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_settings'));
		$this->load->library(array('Aauth','form_validation','encryption','session','email'));
		$this->load->helper(array('functions','url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index()
	{
		if(!$this->aauth->is_loggedin()){

			$email = $this->input->post('email');
			$password = $this->input->post('password');
			// Mise en place du formulaire
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			// Si le formulaira n'est pas bon
			if($this->form_validation->run() == true && $this->aauth->login($email, $password)){
				redirect('dashboard');
			}else{
				$this->load->view('authentication/index');
			}
		}elseif(check_access() != true){
			$this->load->view('authentication/index');
		} else {
			redirect('dashboard');
		}
	}
	public function remind_password()
	{
		$config['mailtype'] = "html";
		$config['charset']  = "utf-8";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$email_reset = $this->input->post('email_reset');

		$this->aauth->remind_password($email_reset);
	}
	public function reset_password()
	{
		$config['mailtype'] = "html";
		$config['charset']  = "utf-8";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$code_reset = $this->input->post('code_reset');
		
		$this->aauth->reset_password($code_reset);
	}
	public function logout()
	{
		$this->session->unset_userdata('loggedin');
		$this->session->set_flashdata('disconnect', 'Vous êtes désormais déconnecté(e).');
		$this->session->sess_destroy();
		redirect(site_url('index'), 'refresh');
	}
}
