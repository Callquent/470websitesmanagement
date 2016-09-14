<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_scrapper_google extends CI_Controller {

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
	public function index($w_id = '')
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			if($this->uri->total_segments() == 1){
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

				$this->load->view('website-scrapper-google', $data);
			} elseif($this->uri->total_segments() == 2) {
			}
		} else {
			$this->load->view('index');
		}
	}
	public function ajaxWebsiteScrapperGoogle()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
				$all_websites = $this->model_front->get_all_websites();
				$count_websites =  $this->model_front->count_all_websites_per_page();

				foreach ($all_websites->result() as $row)
				{
					$parser = new WebsiteParser($row->w_url_rw);
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
					$list[] = $row->w_title;
					$list[] = '<a href="https://www.google.com/search?q=info:'.$row->w_url_rw.'" target="_blank">'.$row->w_url_rw.'</a>';
					$list[] = html_entity_decode((isset($meta_title)?$meta_title:""),ENT_QUOTES);
					$list[] = html_entity_decode((isset($meta_description)?$meta_description:""),ENT_QUOTES);
					$list[] = html_entity_decode((isset($meta_robots)?$meta_robots:""),ENT_QUOTES);
					$list[] = '<a href="'.site_url('seo-websites/'.$row->w_id).'" class="viewdata btn btn-success btn-xs" data-toggle="modal"><span class="fa fa-eye"></a>';

					$data[] = $list;
				}
				var_dump($data);
				$output = array("draw" => $_POST['draw'],
								"recordsTotal" => $all_websites->num_rows(),
								"recordsFiltered" => $count_websites->num_rows(),
								"data" => $data);
				echo json_encode($output);






/*			$googlescraper = new Googlescraper();

			$results_google = $this->model_front->get_website($w_id)->row();
			$all_websites = $googlescraper->getUrlList('site:'.$results_google->w_url_rw);

			foreach ($all_websites->result_array() as $row)
			{
				$parser = new WebsiteParser($row->w_url_rw);
				$meta_tags = $parser->getMetaTags(true);
				$meta_title = $parser->getTitle(true);
				$meta_description = "";

				foreach ($meta_tags as $meta_tag){
					if ($meta_tag[0] == 'description') {
						$meta_description = $meta_tag[1];
					}
					if ($meta_tag[0] == 'robots') {
						$meta_robots = $meta_tag[1];
					}
				}

				$list = array();
				$list[] = $row->w_title;
				$list[] = '<a href="https://www.google.com/search?q=info:'.$row->w_url_rw.'" target="_blank">'.$row->w_url_rw.'</a>';
				$list[] = html_entity_decode((isset($meta_title)?$meta_title:""),ENT_QUOTES);
				$list[] = html_entity_decode((isset($meta_description)?$meta_description:""),ENT_QUOTES);
				$list[] = html_entity_decode((isset($meta_robots)?$meta_robots:""),ENT_QUOTES);
				$list[] = '<a href="'.site_url('seo-websites/'.$row->w_id).'" class="viewdata btn btn-success btn-xs" data-toggle="modal"><span class="fa fa-eye"></a>';

				$data[] = $list;
			}
			$output = array("draw" => $_POST['draw'],
							"recordsTotal" => $all_websites->num_rows(),
							"recordsFiltered" => $all_websites->num_rows(),
							"data" => $data);
			echo json_encode($output);*/






			/*$obj = new Googlescraper();

			$all_websites = $this->model_front->get_all_websites();
			$count_websites =  $this->model_front->count_all_websites();
			$data = array();
			foreach ($all_websites->result() as $row)
			{
				$list = array();
				$list[] = $obj->getUrlList('site:'.$row->w_url_rw);

				$data[] = $list;
			}*/
			/*$output = array("draw" => $_POST['draw'],
							"recordsTotal" => $all_whois->num_rows(),
							"recordsFiltered" => $count_websites->num_rows(),
							"data" => $data);
			echo json_encode($output);*/
			/*var_dump($data);*/
		}else {
			$this->load->view('index');
		}
	}
	public function ajaxSeoPagePerwebsite()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$googlescraper = new Googlescraper();

			$results_google = $this->model_front->get_website($w_id)->row();
			$all_websites = $googlescraper->getUrlList('site:'.$results_google->w_url_rw);

			foreach ($all_websites->result_array() as $row)
			{
				$parser = new WebsiteParser($row->w_url_rw);
				$meta_tags = $parser->getMetaTags(true);
				$meta_title = $parser->getTitle(true);
				$meta_description = "";

				foreach ($meta_tags as $meta_tag){
					if ($meta_tag[0] == 'description') {
						$meta_description = $meta_tag[1];
					}
					if ($meta_tag[0] == 'robots') {
						$meta_robots = $meta_tag[1];
					}
				}

				$list = array();
				$list[] = $row->w_title;
				$list[] = '<a href="https://www.google.com/search?q=info:'.$row->w_url_rw.'" target="_blank">'.$row->w_url_rw.'</a>';
				$list[] = html_entity_decode((isset($meta_title)?$meta_title:""),ENT_QUOTES);
				$list[] = html_entity_decode((isset($meta_description)?$meta_description:""),ENT_QUOTES);
				$list[] = html_entity_decode((isset($meta_robots)?$meta_robots:""),ENT_QUOTES);
				$list[] = '<a href="'.site_url('seo-websites/'.$row->w_id).'" class="viewdata btn btn-success btn-xs" data-toggle="modal"><span class="fa fa-eye"></a>';

				$data[] = $list;
			}
			$output = array("draw" => $_POST['draw'],
							"recordsTotal" => $all_websites->num_rows(),
							"recordsFiltered" => $all_websites->num_rows(),
							"data" => $data);
			echo json_encode($output);
		} else {
			$this->load->view('index');
		}
	}
}
