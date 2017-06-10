<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Website_scrapper_google extends CI_Controller {

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
	public function index($w_id = '')
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

			if($this->uri->total_segments() == 1){
				foreach ($data['all_websites']->result() as $row)
				{
					$googlescraper = new Googlescraper();
					$data['result_websites'] = $googlescraper->getUrlList($row->w_url_rw,1);
				}

				$this->load->view('website-scrapper-google', $data);
			} elseif($this->uri->total_segments() == 2) {
				$website = $this->model_front->get_website($w_id)->row();

				$googlescraper = new Googlescraper();
				$data['result_websites'] = $googlescraper->getUrlList('site:'.$website->w_url_rw,100);

				$this->load->view('website-scrapper-google', $data);
			}
		} else {
			$this->load->view('index');
		}
	}
	public function ajaxWebsiteScrapperGoogle()
	{
		if(check_access()==true)
		{
				$all_websites = $this->model_front->get_all_websites();
				$count_websites =  $this->model_front->count_all_websites_per_page();

				/*foreach ($all_websites->result() as $row)
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
				$output = array("draw" => $_POST['draw'],
								"recordsTotal" => $all_websites->num_rows(),
								"recordsFiltered" => $count_websites->num_rows(),
								"data" => $data);
				echo json_encode($output);*/


				/*foreach ($all_websites->result() as $row)
				{
					$googlescraper = new Googlescraper();
					$website = $googlescraper->getUrlList('info:'.$row->w_url_rw,1);

					var_dump($website[0]['w_title']);
					$list = array();
					$list[] = $website[0]['w_title'];
					$list[] = '<a href="https://www.google.com/search?q=info:'.strip_tags($website[0][]url).'" target="_blank">'.strip_tags($website[0]['url']).'</a>';
					$list[] = strip_tags($website[0]['title']);
					$list[] = strip_tags($website[0]['description']);
					$list[] = "";

					$data[] = $list;
				}
				$output = array("draw" => $_POST['draw'],
								"recordsTotal" => $all_websites->num_rows(),
								"recordsFiltered" => $count_websites->num_rows(),
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
}
