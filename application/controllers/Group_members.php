<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_members extends CI_Controller {

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
		$data['list_groups_users'] = $this->aauth->list_groups();

		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('members/group-members', $data);
	}
	public function add_group_members()
	{
			$group_name = $this->input->post('group_name');
			$definition = $this->input->post('definition');

			$this->aauth->create_group($group_name, $definition);
	}
	public function edit_group_members()
	{
		$id = $this->input->post('id_group_members');
		$group_name = $this->input->post('group_name');
		$definition = $this->input->post('definition');

		$this->aauth->update_group($id, $group_name, $definition);
	}
	public function delete_group_members()
	{
		$id = $this->input->post('id_group_members');

		$this->aauth->delete_group($id);
	}
}
