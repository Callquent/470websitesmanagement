<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_websites extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_tasks');
		$this->load->model('model_back');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','form_validation', 'encrypt', 'session','email'));
		$this->load->helper(array('functions', 'text', 'url','date','language'));
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
	public function ajaxDashboard($website_group = '', $website_group_name = '')
	{
		if ($website_group == "category") {
			$all_websites = $this->model_front->get_all_websites_per_category($website_group_name);
		} elseif ($website_group == "language") {
			$all_websites = $this->model_front->get_all_websites_per_language($website_group_name);
		} else {
			$all_websites = $this->model_front->get_all_websites();
		}
		
		$count_websites = $this->model_front->count_all_websites_per_page();
		$data = array();
		foreach ($all_websites->result() as $row)
		{
			$list = array();
			$list[] = $row->name_website;
			$list[] = '<a href="'.prep_url($row->url_website).'" target="_blank">'.$row->url_website.'</a>';
			$list[] = ($this->input->valid_ip(gethostbyname($row->url_website))?gethostbyname($row->url_website):"ADRESSE IP NON VALIDE");
			$list[] = $row->title_category;
			$list[] = $row->title_language;
			$list[] = '<a class="access-ftp" href="javascript:void(0);" data-toggle="modal" data-target="#view-ftp" data-id="'.$row->w_id.'">Access FTP</a>';
			$list[] = '<a class="access-sql" href="javascript:void(0);" data-toggle="modal" data-target="#view-database" data-id="'.$row->w_id.'">Access SQL</a>';
			$list[] = '<a class="access-backoffice" href="javascript:void(0);" data-toggle="modal" data-target="#view-backoffice" data-id="'.$row->w_id.'">Access Back office</a>';
			$list[] = '<a class="access-htaccess" href="javascript:void(0);" data-toggle="modal" data-target="#view-htaccess" data-id="'.$row->w_id.'">Access Htaccess</a>';
			$list[] = '<div class="dropdown show actions">
						  <a class="btn btn-secondary dropdown-toggle" href="javascript:void(0);" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						  	<i class="fa fa-bars"></i>
						  </a>
						  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
						    <a class="dropdown-item email" href="javascript:void(0);" data-toggle="modal" data-target="#email" data-id="'.$row->w_id.'"><i class="fa fa-envelope"></i> Email</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item" id="edit-dashboard" href="'.site_url('all-websites/edit-website/'.$row->w_id).'"><i class="fa fa-pencil"></i> Edit</a>
						    <a class="dropdown-item" id="delete-dashboard" href="'.site_url('all-websites/delete-website/'.$row->w_id).'"><i class="fa fa-trash"></i> Delete</a>
						  </div>
						</div>';

			$data[] = $list;
		}

		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $all_websites->num_rows(),
						"recordsFiltered" => $count_websites->num_rows(),
						"data" => $data);
		echo json_encode($output);
	}
	public function modal_ftp_website($w_id_ftp = '')
	{
		$all_websites = $this->model_front->get_website_per_ftp($w_id_ftp);
		$row = $all_websites->row($w_id_ftp);


		$datatable = array(0 => $row->host_ftp,
							1 => $row->login_ftp,
							2 => $row->password_ftp,
							3 => '<a id="edit-dashboard" href="'.site_url('all-websites/edit-ftp-website/'.$row->id_website.'/'.$row->id_ftp).'">Edit</a>',
							4 => '<a id="delete-dashboard" href="javascript:void(0);">Cancel</a>');

		echo json_encode($datatable, JSON_FORCE_OBJECT);
	}
	public function modal_database_website($w_id_db = '')
	{
		$all_websites = $this->model_front->get_website_per_database($w_id_db);
		$row = $all_websites->row($w_id_db);


		$datatable = array(0 => $row->host_database,
							1 => $row->name_database,
							2 => $row->login_database,
							3 => $row->password_database,
							4 => '<a id="edit-dashboard" href="'.site_url('all-websites/edit-database-website/'.$row->id_website.'/'.$row->id_database).'">Edit</a>',
							5 => '<a id="delete-dashboard" href="javascript:void(0);">Cancel</a>');

		echo json_encode($datatable, JSON_FORCE_OBJECT);
	}
	public function modal_backoffice_website($w_id_bo = '')
	{
		$all_websites = $this->model_front->get_website_per_backoffice($w_id_bo);
		$row = $all_websites->row($w_id_bo);


		$datatable = array(0 => $row->host_backoffice,
							1 => $row->login_backoffice,
							2 => $row->password_backoffice,
							3 => '<a id="edit-dashboard" href="'.site_url('all-websites/edit-backoffice-website/'.$row->id_website.'/'.$row->id_backoffice).'">Edit</a>',
							4 => '<a id="delete-dashboard" href="javascript:void(0);">Cancel</a>');

		echo json_encode($datatable, JSON_FORCE_OBJECT);
	}
	public function modal_htaccess_website($w_id_ht = '')
	{
		$all_websites = $this->model_front->get_website_per_htaccess($w_id_ht);
		$row = $all_websites->row($w_id_ht);


		$datatable = array(0 => $row->login_htaccess,
							1 => $row->password_htaccess,
							2 => '<a id="edit-dashboard" href="'.site_url('all-websites/edit-backoffice-website/'.$row->id_website.'/'.$row->id_htaccess).'">Edit</a>',
							3 => '<a id="delete-dashboard" href="javascript:void(0);">Cancel</a>');

		echo json_encode($datatable, JSON_FORCE_OBJECT);
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

			$this->email->from('noreply@user.com', "noreply");
			$this->email->to($email); 
			$this->email->subject('Information Site Web - '.$row->name_website);
			$data['email'] = $email;

			$filename = img_url('company/logo-company.png');
			$this->email->attach($filename);
			$data['cid'] = $this->email->attachment_cid($filename);
			$data['name_website'] = $row->name_website;
			$data['url_website'] = $row->url_website;
			$data['title_language'] = $row->title_language;
			
			$data['w_host_ftp'] = $row->w_host_ftp;
			$data['w_login_ftp'] = $row->w_login_ftp;
			$data['w_password_ftp'] = $row->w_password_ftp;

			$data['w_host_db'] = $row->w_host_db;
			$data['w_name_db'] = $row->w_name_db;
			$data['w_login_db'] = $row->w_login_db;
			$data['w_password_db'] = $row->w_password_db;

			$data['w_admin_login'] = $row->w_login_bo;
			$data['w_admin_password'] = $row->w_password_bo;

			$data['w_email'] = $this->session->userdata['email'];

			$this->email->message($this->load->view('mail/template', $data, true));
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

		$name_website			= $this->input->post('titlewebsite');
		$url_website			= $this->input->post('website');
		$l_id				= $this->input->post('language');
		$c_id				= $this->input->post('category');

		if ($this->form_validation->run() !== FALSE){
			$this->model_back->update_website($w_id, $c_id, $l_id, $name_website, $url_website);
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
		$w_host_bo		= $this->input->post('hotebackoffice');
		$w_login_bo		= $this->input->post('loginbackoffice');
		$w_password_bo	= $this->input->post('passwordbackoffice');

		$this->model_back->update_backoffice_websites($w_id_bo, $w_id, $w_host_bo, $w_login_bo, $w_password_bo);
	}
	public function edit_htaccess_website($w_id = '',$w_id_htaccess = '')
	{
		$w_login_htaccess		= $this->input->post('loginhtaccess');
		$w_password_htaccess	= $this->input->post('passwordhtaccess');

		$this->model_back->update_htaccess_websites($w_id_htaccess, $w_id, $w_login_htaccess, $w_password_htaccess);
	}
	public function delete_website($w_id = '')
	{
		// Si le site existe, on peut le supprimer
		if ($this->model_front->get_website($w_id)->num_rows() == 1){
			$this->model_back->delete_website($w_id);
		}
	}
}
