<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model(array('model_front','model_tasks','model_users','model_settings'));
		$this->load->library(array('Aauth','form_validation','form_validation_470websitesmanagement', 'encryption', 'session'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
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

		$data['list_users'] = $this->model_users->get_all_users();
		$data['list_groups'] = $this->model_users->get_all_groups();

		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('members/members', $data);
	}
	public function create_user()
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');
		
		$this->form_validation_470websitesmanagement->set_rules('name', 'Name', 'trim|required|min_length[5]');
		$this->form_validation_470websitesmanagement->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation_470websitesmanagement->set_rules('password', 'Password', 'trim|required|min_length[10]|valid_password');
		$this->form_validation_470websitesmanagement->set_rules('password_confirm', 'Confirm Password', 'trim|required|matches[password]');

		if ($this->form_validation_470websitesmanagement->run() == true) {
				$this->aauth->create_user($email, $password, $name);
				$this->session->set_flashdata('success', 'Votre profil a bien été creée.');
		}
		// All errors
		$errors = array_merge($this->form_validation_470websitesmanagement->error_array(),$this->aauth->errors);
		$this->output->set_content_type('application/json')->set_output(json_encode($errors));
	}
	public function edit_user()
	{
		$id_user = $this->input->post('id_user');
		$email_user = $this->input->post('email_user');
		$old_idgroup_user = $this->input->post('old_idgroup_user');
		$new_idgroup_user = $this->input->post('new_idgroup_user');

		$this->aauth->remove_member($id_user, $old_idgroup_user);
		$this->aauth->add_member($id_user, $new_idgroup_user);
		$this->aauth->update_user($id_user, $email_user);
	}
	public function delete_user()
	{
		$id_user = $this->input->post('id_user');

		$this->model_users->delete_user($id_user);
		$this->aauth->delete_user($id_user);
	}
}
