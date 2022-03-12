<?php 

namespace App\Controllers;

use App\Models\Model_settings;
use App\Libraries\Aauth;
use App\Libraries\Form_validation;
use App\Libraries\Encryption;
use App\Libraries\Session;
use App\Libraries\Email;

class Index extends BaseController {
	public function __construct()
	{
		helper(['functions','url']);
		/*$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);*/

	}
	public function index()
	{
		$validation =  \Config\Services::validation();
		$this->session = \Config\Services::session();
		$session = session();
		
		/*if(!$this->aauth->is_loggedin()){*/
		if ($this->request->getMethod() === 'post' && $this->validate([
				'email' => 'required|min_length[3]|max_length[255]',
				'password'  => 'required|min_length[3]|max_length[255]',
			]))
		{
			$session->setFlashdata('success');
		}
			// Mise en place du formulaire
			$validation->setRules([
				'email' => 'required|valid_email|is_unique[users.email,id,4]'
			]);
			/*$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			// Si le formulaira n'est pas bon
			if($this->form_validation->run() == true && $this->aauth->login($email, $password)){
				redirect('dashboard');
			}else{*/
				return view('authentication/index');
		/*	}
		}elseif(check_access() != true){
			$this->load->view('authentication/index');
		} else {
			redirect('dashboard');
		}*/
	}
	public function remind_password()
	{
		$config['mailtype'] = "html";
		$config['charset']  = "utf-8";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$email_reset = $this->input->post('email_reset');

		$this->aauth->remind_password($email_reset);
	}
	public function reset_password()
	{
		$config['mailtype'] = "html";
		$config['charset']  = "utf-8";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$code_reset = $this->input->post('code_reset');
		
		$this->aauth->reset_password($code_reset);
	}
	public function logout()
	{
		$this->session->unset_userdata('loggedin');
		$this->session->set_flashdata('disconnect', 'Vous êtes désormais déconnecté(e).');
		$this->session->sess_destroy();
		redirect(site_url('index'), 'refresh');
	}
}
