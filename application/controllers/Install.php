<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->library(array('form_validation','encryption','session'));
		$this->load->helper(array('functions','url','file'));
	}
	public function index()
	{
		$fichier = APPPATH."./config/database.php";
		$text=fopen($fichier,'r+') or die("Fichier manquant");
		$contenu=file_get_contents($fichier);
		$patterns = array('/\'username\' => \'(.*)\'/','/\'password\' => \'(.*)\'/','/\'database\' => \'(.*)\'/');
		preg_match('/\'username\' => \'(.*)\'.*\'password\' => \'(.*)\'.*\'database\' => \'(.*)\'.*\'dbdriver/s', $contenu, $matches);
		if (empty($matches[1]) || empty($matches[3])) {
			$data['install_database'] = false;
			$this->load->view('install', $data);
		} else {
			$this->load->library('Aauth');
			$this->aauth->list_users();
			if (empty($this->aauth->list_users())) {
				$data['install_database'] = true;
				$this->load->view('install', $data);
			} else {
				$this->load->view('authentication/index');
			}
		}
	}
	public function step1()
	{
		$databasename = $this->input->post('databasename');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$databasehost = $this->input->post('databasehost');

		$this->form_validation->set_rules('databasename', 'Databasename', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('databasehost', 'Databasehost', 'trim|required|min_length[4]');

		$fichier = APPPATH."./config/database.php";
		$text=fopen($fichier,'r+') or die("Fichier manquant"); 
		$contenu=file_get_contents($fichier); 
		$patterns = array('/\'username\' => \'(.*)\'/','/\'password\' => \'(.*)\'/','/\'database\' => \'(.*)\'/');
		$replacements = array('\'username\' => \''.$username.'\'', '\'password\' => \''.$password.'\'', '\'database\' => \''.$databasename.'\'');
		$contenuMod=preg_replace($patterns,$replacements, $contenu);
		fwrite($text,$contenuMod);
		fclose($text);

		$key=bin2hex($this->encryption->create_key(5));
		$fichier = APPPATH."./config/config.php";
		$contenu = read_file($fichier);
		$patterns = array('/\$config\[\'encryption_key\'\] = \'(.*)\'/');
		$replacements = array('$config[\'encryption_key\'] = \''.password_hash($key, PASSWORD_DEFAULT).'\'');
		$contenuMod=preg_replace($patterns,$replacements, $contenu);
		write_file($fichier, $contenuMod, 'r+');

		$this->load->database();
		if ( $this->load->database() === FALSE )
		{
			$contenu=file_get_contents(FCPATH."470websitesmanagement.sql");
			mysqli_multi_query($this->db->conn_id, $contenu);
		}
	}
	public function step2()
	{
		$this->load->database();
		
		
		$username = $this->input->post('username');
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[32]');

		if ($this->form_validation->run() == TRUE) {
			$this->load->library("Aauth");
		}
		$this->aauth->create_user($email, $password, $username);
		$this->aauth->remove_member($this->aauth->get_user_id($email),"Unknown");
		$this->aauth->add_member($this->aauth->get_user_id($email),"Admin");
	}
	public function step3()
	{
		$fichier = APPPATH."./config/routes.php";
		$contenu = read_file($fichier);
		$contenuMod=str_replace( "install", "index", $contenu);
		write_file($fichier, $contenuMod, 'r+');
	}
}
