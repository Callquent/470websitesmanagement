<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_keyword_google extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_users');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','form_validation', 'encrypt', 'session'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index()
	{
		if(check_access()==true)
		{
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['username'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$this->load->view('all-websites', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function ajaxKeyword()
	{
		if(check_access()==true)
		{
			$all_websites = $this->model_front->get_all_websites();
			$count_websites = $this->model_front->count_all_websites_per_page();
			$data = array();
			foreach ($all_websites->result() as $row)
			{
				$list = array();
				$list[] = $row->w_id;
				$list[] = $row->name_website;
				$list[] = '<a href="'.prep_url($row->url_website).'" target="_blank">'.$row->url_website.'</a>';
				$list[] = ($this->input->valid_ip(gethostbyname($row->url_website))?gethostbyname($row->url_website):"ADRESSE IP NON VALIDE");
				$list[] = $row->title_category;
				$list[] = $row->title_language;
				$list[] = '<a class="access-ftp" href="javascript:void(0);" data-toggle="modal" data-target="#view-ftp" data-id="'.$row->w_id.'">Access FTP</a>';
				$list[] = '<a class="access-sql" href="javascript:void(0);" data-toggle="modal" data-target="#view-database" data-id="'.$row->w_id.'">Access SQL</a>';
				$list[] = '<a class="access-backoffice" href="javascript:void(0);" data-toggle="modal" data-target="#view-backoffice" data-id="'.$row->w_id.'">Access Back office</a>';
				$list[] = '<a class="email" href="javascript:void(0);" data-toggle="modal" data-target="#email" data-id="'.$row->w_id.'">Email</a>';
				$list[] = '<a id="edit-dashboard" href="'.site_url('all-websites/edit-website/'.$row->w_id).'">Edit</a>';
				$list[] = '<a id="delete-dashboard" href="'.site_url('all-websites/delete-website/'.$row->w_id).'">Delete</a>';
				$list[] = '<a href="'.site_url('ftp-websites/'.$row->w_id).'">Connect FTP</a>';

				$data[] = $list;
			}

			$output = array("draw" => $_POST['draw'],
							"recordsTotal" => $all_websites->num_rows(),
							"recordsFiltered" => $count_websites->num_rows(),
							"data" => $data);
			echo json_encode($output);
		}else {
			$this->load->view('index');
		}
	}
}
