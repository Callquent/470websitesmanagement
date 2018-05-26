<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_tasks');
		$this->load->model('model_users');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','form_validation', 'encrypt', 'session'));
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

		$data['list_users'] = $this->model_users->get_all_users();
		$data['list_groups'] = $this->model_users->get_all_groups();

		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('members', $data);
	}
	public function edit($id_members = '')
	{
			$emailmember = $this->input->post('emailmember');
			$idgroup_member_old = $this->input->post('idgroup_member_old');
			$idgroup_member_new = $this->input->post('idgroup_member_new');

			$this->aauth->remove_member($id_members, $idgroup_member_old);
			$this->aauth->add_member($id_members, $idgroup_member_new);
			$this->aauth->update_user($id_members, $emailmember);
	}
	public function loadGroup()
	{
		$data['list_groups'] = $this->model_users->get_all_groups();

		$this->output->set_content_type('application/json')->set_output( json_encode($data['list_groups']->result()));
	}
	public function delete($w_id = '')
	{
		$this->model_users->delete_user($w_id);
		$this->aauth->delete_user($w_id);
	}
}
