<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_websites extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_back');
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->library('email');
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->helper('date');
	}
	public function index()
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
			$data['login'] = $this->session->userdata['name'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$this->load->view('all-websites', $data);
		}else {
			$this->load->view('index');
		}
	}
	public function ajaxDashboard()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$all_websites = $this->model_front->get_all_websites();
			$count_websites = $this->model_front->count_all_websites_per_page();
			$data = array();
			foreach ($all_websites->result() as $row)
			{
				$list = array();
				$list[] = $row->w_id;
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
	public function modal_ftp_website($w_id_ftp = '')
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
	public function modal_database_website($w_id_db = '')
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
	public function modal_backoffice_website($w_id_bo = '')
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
	public function contact()
	{
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		$data['check_ftp'] = $this->input->post('check_ftp');
		$data['check_db'] = $this->input->post('check_db');
		$data['check_bo'] = $this->input->post('check_bo');

		$row = $this->model_front->get_website($id)->row();

		$this->form_validation->set_rules('email', 'email', 'required|valid_email');

		if ($this->form_validation->run() == false)
		{
			$errors = validation_errors();
			echo $errors;
		} else {
			$config['mailtype'] = "html";
			$config['charset']  = "utf-8";
			$config['newline'] = "\r\n";
			$this->email->initialize($config);

			$this->email->from('noreply@user.com');
			$this->email->to($email); 
			$this->email->subject('Information Site Web - '.$row->w_title);
			$data['email'] = $email;

			$filename = img_url('company/logo-company.png');
			$this->email->attach($filename);
			$data['cid'] = $this->email->attachment_cid($filename);
			$data['w_title'] = $row->w_title;
			$data['w_url_rw'] = $row->w_url_rw;
			$data['l_title'] = $row->l_title;
			
			$data['w_host_ftp'] = $row->w_host_ftp;
			$data['w_login_ftp'] = $row->w_login_ftp;
			$data['w_password_ftp'] = $row->w_password_ftp;

			$data['w_host_db'] = $row->w_host_db;
			$data['w_name_db'] = $row->w_name_db;
			$data['w_login_db'] = $row->w_login_db;
			$data['w_password_db'] = $row->w_password_db;

			$data['w_admin_login'] = $row->w_login_bo;
			$data['w_admin_password'] = $row->w_password_bo;

			$this->email->message($this->load->view('template-mail', $data, true));
			$this->email->send();
			
			echo ("Merci ! Votre message a bien été envoyé");
		}
	}
	public function loadCategories(){
		$data['all_categories'] = $this->model_front->get_all_categories();

		$this->output
			->set_content_type('application/json')
			->set_output( json_encode($data['all_categories']->result()));
	}
	public function loadLanguages(){
		$data['all_languages'] = $this->model_front->get_all_languages();

		$this->output
			->set_content_type('application/json')
			->set_output( json_encode($data['all_languages']->result()));
	}
	public function edit_website($w_id = '')
	{
		$this->form_validation->set_rules('titlewebsite', 'TitleWebsite', 'trim|required');
		$this->form_validation->set_rules('website', 'Website', 'trim|required');

		$w_title			= $this->input->post('titlewebsite');
		$w_url_rw			= $this->input->post('website');
		$l_id				= $this->input->post('language');
		$c_id				= $this->input->post('category');

		if ($this->form_validation->run() !== FALSE){
			$this->model_back->update_website($w_id, $c_id, $l_id, $w_title, $w_url_rw);
		}
	}
	public function edit_ftp_website($w_id = '',$w_id_ftp = '')
	{
		$w_host_ftp		= $this->input->post('hoteftp');
		$w_login_ftp	= $this->input->post('loginftp');
		$w_password_ftp	= $this->input->post('passwordftp');

		$this->model_back->update_ftp_websites($w_id_ftp, $w_id, $w_host_ftp, $w_login_ftp, $w_password_ftp);
	}
	public function edit_database_website($w_id = '',$w_id_db = '')
	{
		$w_host_db		= $this->input->post('hotedatabase');
		$w_name_db		= $this->input->post('namedatabase');
		$w_login_db		= $this->input->post('logindatabase');
		$w_password_db	= $this->input->post('passworddatabase');

		$this->model_back->update_database_websites($w_id_db, $w_id, $w_host_db, $w_name_db, $w_login_db, $w_password_db);
	}
	public function edit_backoffice_website($w_id = '',$w_id_bo = '')
	{
		$w_login_bo		= $this->input->post('loginbackoffice');
		$w_password_bo	= $this->input->post('passwordbackoffice');

		$this->model_back->update_backoffice_websites($w_id_bo, $w_id, $w_login_bo, $w_password_bo);
	}
	public function delete_website($w_id = '')
	{
		// Si le site existe, on peut le supprimer
		if ($this->model_front->get_website($w_id)->num_rows() == 1){
			$this->model_back->delete_website($w_id);
		}
	}
}
