<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seo_websites extends CI_Controller {

	public $arr = [];
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
		$this->load->library('session');
		if ($this->session->userdata('arr')) {
			$this->arr = $this->session->userdata('arr');
		}
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->helper('language');
		$this->lang->load(unserialize($this->model_settings->view_settings_lang()->value_s)['file'], unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
	}
	public function index($w_id = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			if($this->uri->total_segments() == 1){
				$data['all_websites'] =  $this->model_front->get_all_websites()->num_rows();
				$data['all_languages'] = $this->model_front->get_all_languages();
				$data['all_categories'] = $this->model_front->get_all_categories();

				$data['all_domains'] = $this->model_front->get_all_domains();
				$data['all_subdomains'] = $this->model_front->get_all_subdomains();
				$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
				$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
				$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			}elseif($this->uri->total_segments() == 2){
				$obj = new Googlescraper();
				$row =  $this->model_front->get_website($w_id)->row();

				$this->arr = $obj->getUrlList('site:'.$row->w_url_rw);
				$this->session->set_userdata('arr', $this->arr);

				$data['all_websites'] =  count($this->arr);
				$data['all_languages'] = $this->model_front->get_all_languages();
				$data['all_categories'] = $this->model_front->get_all_categories();

				$data['all_domains'] = $this->model_front->get_all_domains();
				$data['all_subdomains'] = $this->model_front->get_all_subdomains();
				$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
				$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
				$data['ajax_url'] = site_url('serp-tools/metawebsite/'.$row->w_id);
			}
			$data['login'] = $this->session->userdata['name'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$this->load->view('seo-websites', $data);
		} else {
			$this->load->view('index');
		}
	}
	public function metawebsite($w_id = '',$wp_id = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			if($this->uri->total_segments() == 3){
				$all_websites = $this->model_front->get_all_websites();
				$row = $all_websites->row($w_id);

				$parser = new WebsiteParser($row->w_url_rw);
				$meta_tags = $parser->getMetaTags(true);
				$meta_title = $parser->getTitle(true);
				$meta_description = "";

				foreach ($meta_tags as $meta_tag){
					if ($meta_tag[0] == 'description') {
						$meta_description = $meta_tag[1];
					}
				}
				$datatable = array(0 => $row->w_title,
									1 => '<a href="https://www.google.com/search?q=info:'.$row->w_url_rw.'" target="_blank">'.$row->w_url_rw.'</a>',
									2 => html_entity_decode($meta_title,ENT_QUOTES),
									3 => html_entity_decode($meta_description,ENT_QUOTES),
									4 => '<a href="'.site_url('seo-websites/'.$row->w_id).'" class="viewdata btn btn-success btn-xs" data-toggle="modal"><span class="fa fa-eye"></a>');
				echo json_encode($datatable, JSON_FORCE_OBJECT);
			}elseif($this->uri->total_segments() == 4){
				$row =  $this->model_front->get_website($w_id)->row();

				$parser = new WebsiteParser($this->arr[$wp_id]);
				$meta_tags = $parser->getMetaTags(true);
				$meta_title = $parser->getTitle(true);
				$meta_description = "";

				foreach ($meta_tags as $meta_tag){
					if ($meta_tag[0] == 'description') {
						$meta_description = $meta_tag[1];
					}
				}
				$datatable = array(0 => $row->w_title,
									1 => '<a href="https://www.google.com/search?q=info:'.$this->arr[$wp_id].'" target="_blank">'.$this->arr[$wp_id].'</a>',
									2 => html_entity_decode($meta_title,ENT_QUOTES),
									3 => html_entity_decode($meta_description,ENT_QUOTES));
				echo json_encode($datatable, JSON_FORCE_OBJECT);
			}
		} else {
			$this->load->view('index');
		}
	}
}
