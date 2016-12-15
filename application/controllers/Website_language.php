<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_language extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_settings');
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->library('email');
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->helper('language');
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index($l_title_url = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
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

			$this->load->view('website-language', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function ajaxDashboard($l_title_url = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$all_websites = $this->model_front->get_all_websites_per_language($l_title_url);
			$count_websites = $this->model_front->count_all_websites_per_page();
			$data = array();
			foreach ($all_websites->result() as $row)
			{
				$list = array();
				$list[] = $row->w_title;
				$list[] = '<a href="'.prep_url($row->w_url_rw).'" target="_blank">'.$row->w_url_rw.'</a>';
				$list[] = ($this->input->valid_ip(gethostbyname($row->w_url_rw))?gethostbyname($row->w_url_rw):"ADRESSE IP NON VALIDE");
				$list[] = $row->c_title;
				$list[] = $row->l_title;
				$list[] = '<a class="access-ftp" href="javascript:void(0);" data-toggle="modal" data-target="#view-ftp" data-id="'.$row->w_id.'">Access FTP</a>';
				$list[] = '<a class="access-sql" href="javascript:void(0);" data-toggle="modal" data-target="#view-database" data-id="'.$row->w_id.'">Access SQL</a>';
				$list[] = '<a class="access-backoffice" href="javascript:void(0);" data-toggle="modal" data-target="#view-backoffice" data-id="'.$row->w_id.'">Access Back office</a>';
				$list[] = '<a class="email" href="javascript:void(0);" data-toggle="modal" data-target="#email" data-id="'.$row->w_id.'">Email</a>';
				$list[] = '<a id="edit-dashboard" href="'.site_url('all-websites/edit-website/'.$row->w_id).'">Edit</a>';
				$list[] = '<a id="delete-dashboard" href="'.site_url('all-websites/delete-website/'.$row->w_id).'">Delete</a>';

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
	public function modal_ftp_website($l_title_url = '', $w_id_ftp = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$all_websites = $this->model_front->get_website_per_ftp($w_id_ftp);
			$row = $all_websites->row($w_id_ftp);


			$datatable = array(0 => $row->w_host_ftp,
								1 => $row->w_login_ftp,
								2 => $row->w_password_ftp,
								3 => '<a id="edit-dashboard" href="'.site_url('all-websites/edit-ftp-website/'.$row->w_id.'/'.$row->w_id_ftp).'">Edit</a>',
								4 => '<a id="delete-dashboard" href="javascript:void(0);">Cancel</a>');

			echo json_encode($datatable, JSON_FORCE_OBJECT);
		}else {
			$this->load->view('index');
		}
	}
	public function modal_database_website($l_title_url = '', $w_id_db = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$all_websites = $this->model_front->get_website_per_database($w_id_db);
			$row = $all_websites->row($w_id_db);


			$datatable = array(0 => $row->w_host_db,
								1 => $row->w_name_db,
								2 => $row->w_login_db,
								3 => $row->w_password_db,
								4 => '<a id="edit-dashboard" href="'.site_url('all-websites/edit-database-website/'.$row->w_id.'/'.$row->w_id_db).'">Edit</a>',
								5 => '<a id="delete-dashboard" href="javascript:void(0);">Cancel</a>');

			echo json_encode($datatable, JSON_FORCE_OBJECT);
		}else {
			$this->load->view('index');
		}
	}
	public function modal_backoffice_website($l_title_url = '', $w_id_bo = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$all_websites = $this->model_front->get_website_per_backoffice($w_id_bo);
			$row = $all_websites->row($w_id_bo);


			$datatable = array(0 => $row->w_login_bo,
								1 => $row->w_password_bo,
								2 => '<a id="edit-dashboard" href="'.site_url('all-websites/edit-backoffice-website/'.$row->w_id.'/'.$row->w_id_bo).'">Edit</a>',
								3 => '<a id="delete-dashboard" href="javascript:void(0);">Cancel</a>');

			echo json_encode($datatable, JSON_FORCE_OBJECT);
		}else {
			$this->load->view('index');
		}
	}
}
