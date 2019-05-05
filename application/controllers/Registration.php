<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_settings'));
		$this->load->library(array('Aauth', 'form_validation', 'form_validation_470websitesmanagement', 'encryption', 'session'));
		$this->load->helper(array('functions','url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$this->session->userdata('imagecaptcha');
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index()
	{
		$this->load->view('authentication/registration');
	}
	public function create()
	{
		$name = $this->input->post('name');
		$password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');
		$email = $this->input->post('email');
		$captcha = $this->input->post('captcha');
		$terms = $this->input->post('accept_terms');

		$this->form_validation_470websitesmanagement->set_rules('name', 'Name', 'trim|required|min_length[5]');
		$this->form_validation_470websitesmanagement->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation_470websitesmanagement->set_rules('password', 'Password', 'trim|required|min_length[10]|valid_password');
		$this->form_validation_470websitesmanagement->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]');
		$this->form_validation_470websitesmanagement->set_rules('captcha', 'Captcha', 'trim|required');
		$this->form_validation_470websitesmanagement->set_rules('accept_terms','Terms','trim|required');

		if ($this->session->userdata('imagecaptcha') != $captcha) {
			$this->session->set_flashdata('danger', 'Votre captcha n\'est pas valide');
			$this->load->view('authentication/registration');
		} else {
			if ($this->form_validation_470websitesmanagement->run() == false) {
				$this->load->view('authentication/registration');
			}
			else
			{
				if ($this->aauth->create_user($email, $password, $name) == false) {
					foreach ($this->aauth->errors as $value) {
						$this->session->set_flashdata('danger', $value);
					}
					$this->load->view('authentication/registration');
				} else {
					$this->aauth->create_user($email, $password, $name);
					$this->session->set_flashdata('success', 'Votre profil a bien été creée.');
					$this->load->view('authentication/index');
				}
			}
		}
	}
	public function captcha()
	{
		$ranStr = sha1(microtime().rand(5, 15));
		$ranStr = substr($ranStr, 0, 10);
		$this->session->set_userdata('imagecaptcha', $ranStr);
		$newImage = imagecreatefromjpeg(base_url("assets\img\captcha\captcha.jpg"));
		$txtColor = imagecolorallocate($newImage, 0, 0, 0);
		imagestring($newImage, 5, 5, 5, $ranStr, $txtColor);
		header("Content-type: image/jpeg");
		imagejpeg($newImage);
	}
}
