<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_scrapper_google extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_settings');
		$this->load->library("Aauth");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->library('websiteparser');
		$this->load->library('googlescraper');
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->helper('language');
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$data['all_websites'] = $this->model_front->get_all_websites();
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['name'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$this->load->view('search-scrapper-google', $data);
		} else {
			$this->load->view('index');
		}
	}
	public function ajaxSearchScrapperGoogle()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$keyword_google = $this->input->post('keyword-google');

			$googlescraper = new Googlescraper();
			$all_websites = $googlescraper->getUrlList($keyword_google);

			foreach ($all_websites as $row)
			{
				$parser = new WebsiteParser($row);
				$meta_tags = $parser->getMetaTags(true);
				$meta_title = $parser->getTitle(true);
				$meta_description = "";
				$meta_robots = "";

				foreach ($meta_tags as $meta_tag){
					if ($meta_tag[0] == 'description') {
						$meta_description = $meta_tag[1];
					}
					if ($meta_tag[0] == 'robots') {
						$meta_robots = $meta_tag[1];
					}
				}

				$list = array();
				$list[] = '<a href="https://www.google.com/search?q=info:'.$row.'" target="_blank">'.$row.'</a>';
				$list[] = utf8_encode((isset($meta_title)?$meta_title:""));
				$list[] = utf8_encode((isset($meta_description)?$meta_description:""));
				$list[] = utf8_encode((isset($meta_robots)?$meta_robots:""));

				$data[] = $list;
			}
			echo json_encode($data);
		}else {
			$this->load->view('index');
		}
	}
}
