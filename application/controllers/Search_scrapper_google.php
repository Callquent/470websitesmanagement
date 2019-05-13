<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search_scrapper_google extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_settings'));
		$this->load->library(array('Aauth','form_validation','encryption','session','googlescraper'));
		$this->load->helper(array('functions','text','url','language'));
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

		$data['all_websites'] = $this->model_front->get_all_websites();
		$data['all_languages'] = $this->model_language->get_all_languages();
		$data['all_categories'] = $this->model_category->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('search-scrapper-google', $data);
	}
	public function ajaxSearchScrapperGoogle()
	{
		$keyword_google = $this->input->post('keyword_google');
		$website = ( empty($this->input->post('website')) ? " " :$this->input->post('website'));

		$googlescraper = new Googlescraper();
		$all_websites = $googlescraper->getUrlList(urlencode($keyword_google),100);

		foreach ($all_websites as $key => $row)
		{
			$list = new stdClass();
			$list->position = $key+1;
			$list->website = '<a href="https://www.google.com/search?q=info:'.strip_tags($row['url']).'" target="_blank">'.strip_tags($row['url']).'</a>';
			$list->meta_title = strip_tags($row['title']);
			$list->meta_description = strip_tags($row['description']);
			if (removeurl_createdomain($website) == removeurl_createdomain($row['url'])) {
				$list->class = 'dt-position-website-true';
				$show_position[] = $key+1;
			}
			
			$website_search_preview[] = $list;
		}
		$data['result_websites'] = $website_search_preview;
		if (isset($show_position)) {
			$data['result_position_website'] = $show_position;
		}
		$this->output->set_content_type('application/json')->set_output( json_encode($data));
	}
}
