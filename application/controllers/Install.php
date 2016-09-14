<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Install extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		// Chargement des ressources pour ce controller
		$this->load->database();
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->helper(array('functions','url'));
	}
	public function index()
	{

/*		$fichier = APPPATH."./config/database.php";
		$text=fopen($fichier,'r') or die("Fichier manquant"); 
		$contenu=file_get_contents($fichier); 
		$contenuMod=str_replace( array("celebrimbor","root"), array("copain", "copain"), $contenu);
		fclose($text); 
		$text2=fopen($fichier,'w+') or die("Fichier manquant"); 
		fwrite($text2,$contenuMod);
		fclose($text2);*/

/*		$fichier = APPPATH."./config/routes.php";
		$text=fopen($fichier,'r+') or die("Fichier manquant"); 
		$contenu=file_get_contents($fichier); 
		$contenuMod=str_replace( "install", "index", $contenu);
		fclose($text); 

		$text2=fopen($fichier,'w+') or die("Fichier manquant"); 
		fwrite($text2,$contenuMod);
		fclose($text2);*/
		$this->load->view('install');
	}
}
