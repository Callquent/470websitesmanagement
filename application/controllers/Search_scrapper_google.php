<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_scrapper_google extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','form_validation','encrypt','session','websiteparser','googlescraper'));
		$this->load->helper(array('functions','text','url','language'));
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
			$data['all_websites'] = $this->model_front->get_all_websites();
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['username'];
			$data['user_role'] = $this->aauth->get_user_groups();

			foreach ($data['all_websites']->result() as $row)
			{
				$list = array();
				$list['value'] = strip_tags($row->w_url_rw);
				$list['data'] = strip_tags($row->w_id);

				$data['website'][] = $list;
			}
			$this->load->view('search-scrapper-google', $data);
		} else {
			$this->load->view('index');
		}
	}
	public function ajaxSearchScrapperGoogle()
	{
		if(check_access()==true)
		{
			$keyword_google = $this->input->post('keyword-google');
			$website = ( empty($this->input->post('website')) ? " " :$this->input->post('website'));

			$googlescraper = new Googlescraper();
			$all_websites = $googlescraper->getUrlList(urlencode($keyword_google),100);

			foreach ($all_websites as $key => $row)
			{
				$list = array();
				$list[] = ++$key;
				$list[] = '<a href="https://www.google.com/search?q=info:'.strip_tags($row['url']).'" target="_blank">'.strip_tags($row['url']).'</a>';
				$list[] = strip_tags($row['title']);
				$list[] = strip_tags($row['description']);
				if ($website == removeurl_createdomain($row['url']) ) {
					$list['DT_RowClass'] = 'dt-position-website-true';
				}	
				$data[] = $list;
			}
			echo json_encode($data);
		}else {
			$this->load->view('index');
		}
	}
}
