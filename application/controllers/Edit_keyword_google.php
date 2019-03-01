<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_keyword_google extends CI_Controller {

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

		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('all-websites', $data);
	}
	public function ajaxKeyword()
	{
		$all_websites = $this->model_front->get_all_websites();
		$count_websites = $this->model_front->count_all_websites_per_page();
		$data = array();
		$list = array();
		foreach ($all_websites->result() as $row)
		{
			$list[] = $row->id_website;
			$list[] = $row->name_website;
			$list[] = '<a href="'.prep_url($row->url_website).'" target="_blank">'.$row->url_website.'</a>';
			$list[] = ($this->input->valid_ip(gethostbyname($row->url_website))?gethostbyname($row->url_website):"ADRESSE IP NON VALIDE");
			$list[] = $row->name_category;
			$list[] = $row->name_language;
			$list[] = '<a class="access-ftp" href="javascript:void(0);" data-toggle="modal" data-target="#view-ftp" data-id="'.$row->id_website.'">Access FTP</a>';
			$list[] = '<a class="access-sql" href="javascript:void(0);" data-toggle="modal" data-target="#view-database" data-id="'.$row->id_website.'">Access SQL</a>';
			$list[] = '<a class="access-backoffice" href="javascript:void(0);" data-toggle="modal" data-target="#view-backoffice" data-id="'.$row->id_website.'">Access Back office</a>';
			$list[] = '<a class="email" href="javascript:void(0);" data-toggle="modal" data-target="#email" data-id="'.$row->id_website.'">Email</a>';
			$list[] = '<a id="edit-dashboard" href="'.site_url('all-websites/edit-website/'.$row->id_website).'">Edit</a>';
			$list[] = '<a id="delete-dashboard" href="'.site_url('all-websites/delete-website/'.$row->id_website).'">Delete</a>';
			$list[] = '<a href="'.site_url('ftp-websites/'.$row->id_website).'">Connect FTP</a>';

			$data[] = $list;
		}

		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $all_websites->num_rows(),
						"recordsFiltered" => $count_websites->num_rows(),
						"data" => $data);
		echo json_encode($output);
	}
}
