<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
	public function __construct()
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
		$this->load->view('registration');
	}
	public function create()
	{
		$name = $this->input->post('name');
		$password = $this->input->post('password');
		$email = $this->input->post('email');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('registration');
		}
		else
		{
			$this->aauth->create_user($email, $password, $name);
			$this->session->set_flashdata('success', 'Votre profil a bien été creée.');
			$this->load->view('index');
		}
	}
}
