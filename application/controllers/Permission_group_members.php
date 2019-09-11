<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission_group_members extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model(array('model_front','model_tasks','model_users','model_category','model_settings'));
		$this->load->library(array('Aauth','form_validation', 'encryption', 'session','email'));
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
		
		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['list_groups'] = $this->model_users->get_all_groups()->result();
		$data['all_permissions'] = $this->aauth->list_perms();

		$list = new stdClass();
		$list->text = "Permisssion";
		$list->value = "permisssion";
		$list_permissions[] = $list;
		foreach ($data['list_groups'] as $key => $row)
		{
			$list = new stdClass();
  			$list->text = $row->name;
			$list->value = $row->name;
			$list_permissions[] = $list;
		}
		$data['header_groups'] = $list_permissions;

		$list = array();
		foreach ($data['all_permissions'] as $key => $perm)
		{
			$name_permission = array("name" => $perm->name);
			$data['list_group_perms'][] = array_merge(array($name_permission),$this->model_users->get_group_all_perms($perm->id)->result());
		}

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('members/permission-group-members',$data);
	}
	public function allow_permissions()
	{
		$group_id = $this->input->post('group_id');
		$perm_id = $this->input->post('perm_id');

		$this->aauth->allow_group($group_id,$perm_id);
	}
	public function deny_permissions()
	{
		$group_id = $this->input->post('group_id');
		$perm_id = $this->input->post('perm_id');

		$this->aauth->deny_group($group_id,$perm_id);
	}
}
