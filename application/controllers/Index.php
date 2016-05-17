<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->helper(array('functions','url'));
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
			if($this->form_validation->run() == FALSE){
				$this->load->view('index');
			}else{
				if ($this->aauth->login($email, $password)) {
					redirect(site_url('dashboard'));
				}else{
					$this->load->view('index');
				}
			}
		}elseif($this->aauth->is_loggedin()){
			redirect(site_url('dashboard'));
		}
	}
	public function registration()
	{
		$name = $this->input->post('name');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('index');
		}
		else
		{
			$new_user = $this->aauth->create_user($email, $password, $name);
			$this->session->set_flashdata('success', 'Votre profil a bien été creée.');
			redirect(site_url('dashboard'));
		}
	}
	public function remind_password()
	{
		$config['mailtype'] = "html";
		$config['charset']  = "utf-8";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$emailreset = $this->input->post('emailreset');

		$this->aauth->remind_password($emailreset);
	}
	public function reset_password($u_mail)
	{
		$this->aauth->reset_password($u_mail);
	}
	public function logout()
	{
		$this->session->unset_userdata('loggedin');
		$this->session->set_flashdata('disconnect', 'Vous êtes désormais déconnecté(e).');
		$this->session->sess_destroy();
		redirect(site_url('index'), 'refresh');
	}
}
