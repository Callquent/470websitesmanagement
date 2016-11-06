<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_users');
		$this->load->model('model_settings');
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->helper('language');
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$data['list_users'] = $this->model_users->get_all_users();
			$data['list_groups'] = $this->model_users->get_all_groups();

			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['username'];
			$data['user_role'] = $this->aauth->get_user_groups();


			$this->load->view('members', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function edit($w_id = '',$w_groupid = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id'])) ){
			$w_groupid_new = $this->input->post('members');

			$this->aauth->remove_member($w_id, $w_groupid);
			$this->aauth->add_member($w_id, $w_groupid_new);
			echo $w_groupid_new;
		}else {
			$this->load->view('index');
		}
	}
	public function userGroup($user_id = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id'])) ){
			$this->output
				->set_content_type('application/json')
				->set_output($this->aauth->get_user_groups($user_id)[0]->group_id);
		}else {
			$this->load->view('index');
		}
	}
	public function delete($w_id = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id'])) ){
			$this->aauth->delete_user($w_id);
		}else {
			$this->load->view('index');
		}
	}
}
