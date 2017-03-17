<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->library(array('form_validation','encrypt','session'));
		$this->load->helper(array('functions','url'));
	}
	public function index()
	{
		$this->load->view('install');
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
		$text=fopen($fichier,'r') or die("Fichier manquant"); 
		$contenu=file_get_contents($fichier); 
		$patterns = array('/\'username\' => \'(.*)\'/','/\'password\' => \'(.*)\'/','/\'database\' => \'(.*)\'/');
		$replacements = array('\'username\' => \''.$username.'\'', '\'password\' => \''.$password.'\'', '\'database\' => \''.$databasename.'\'');
		$contenuMod=preg_replace($patterns,$replacements, $contenu);
		fclose($text); 
		$text2=fopen($fichier,'w+') or die("Fichier manquant"); 
		fwrite($text2,$contenuMod);
		fclose($text2);

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
		$text=fopen($fichier,'r+') or die("Fichier manquant");
		$contenu=file_get_contents($fichier); 
		$contenuMod=str_replace( "install", "index", $contenu);
		fclose($text); 

		$text2=fopen($fichier,'w+') or die("Fichier manquant");
		fwrite($text2,$contenuMod);
		fclose($text2);
	}
}
