<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_front','model_tasks','model_settings'));
		$this->load->library(array('Aauth','form_validation', 'encryption', 'session','email'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index', 'refresh',301); }
	}
	public function index()
	{
		$data['login'] = $this->session->userdata['username'];
		$data['user_role'] = $this->aauth->get_user_groups();

		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['user'] = $this->aauth->get_user();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('settings/profile', $data);
	}
	public function change_password()
	{
		$data['user'] = $this->aauth->get_user();

		$this->form_validation->set_rules('newpassword', 'NewPassword', 'trim|required');

		/*$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');*/

		$u_newpassword = $this->input->post('newpassword');

		$this->aauth->reset_password($data['user']->id, $u_newpassword);
		$this->aauth->update_user($data['user']->id, FALSE, $u_newpassword, FALSE);
		echo json_encode("Le mot de passe de votre profil est à jour");
	}
}
