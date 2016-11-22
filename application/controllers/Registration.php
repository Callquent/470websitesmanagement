<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_settings');
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->helper(array('functions','url'));
		$this->load->helper('language');
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index()
	{
		$this->load->view('registration');
	}
	public function create()
	{
		$name = $this->input->post('name');
		$password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');
		$email = $this->input->post('email');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[8]|max_length[32]');

		if($password == $password_confirm) {
			if ($this->form_validation->run() == FALSE) {
				$this->load->view('registration');
			}
			else
			{
				$this->aauth->create_user($email, $password, $name);
				$this->session->set_flashdata('success', 'Votre profil a bien été creée.');
				$this->load->view('index');
			}
		} else {
			$this->session->set_flashdata('danger', 'Mots de passe non identiques');
			$this->load->view('registration');
		}
	}
}
