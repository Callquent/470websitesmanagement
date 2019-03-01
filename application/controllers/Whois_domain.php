<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whois_domain extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_tasks');
		$this->load->model('model_back');
		$this->load->model('model_whois');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','Whois','form_validation','encrypt','session','email'));
		$this->load->helper(array('functions', 'text', 'url','date','language'));
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
		$data['all_languages'] = $this->model_front->get_all_languages();
		$data['all_categories'] = $this->model_front->get_all_categories();

		$data['all_domains'] = $this->model_front->get_all_domains();
		$data['all_subdomains'] = $this->model_front->get_all_subdomains();
		$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
		$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
		$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
		$data['all_count_tasks_per_user'] = $this->model_tasks->count_tasks_per_user($this->session->userdata['id'])->row();

		$this->load->view('whois-domain', $data);
	}
	public function ajaxWhois()
	{
		$all_whois = $this->model_whois->view_all_whois();
		$count_websites =  $this->model_front->count_all_websites();
		$data = array();
		$list = array();
		foreach ($all_whois->result() as $row)
		{
			if (strtotime($this->model_whois->check_whois($row->whois_id)->expiration_date) <= strtotime(date('Y-m-d')) && strtotime($this->model_whois->check_whois($row->whois_id)->expiration_date) != 0 ) {
				$domain = new Whois($row->url_website);
				$whois = $domain->whoisdomain();
				$date_create = str_replace(array('/', '.'), '-', $whois[1]);
				$date_expire = str_replace(array('/', '.'), '-', $whois[2]);
				$this->model_whois->update_whois($row->whois_id,utf8_encode($whois[0]),($whois[1] ? date("Y-m-d", strtotime($date_create)): null),($whois[2] ? date("Y-m-d", strtotime($date_expire)): null), ($whois[3] ? trim($whois[3]): null));
				$pos = strrpos($row->url_website, ".fr");
				if (!$pos === false) {
					sleep(10);
				}
			}

			$list['name_whois'] = $row->name_website;
			$list['website'] = '<a href="'.prep_url($row->url_website).'" target="_blank">'.$row->url_website.'</a>';
			$list['hosting'] = $row->registrar;
			$list['date_delivery'] = (isset($row->creation_date)?date('d/m/Y', strtotime($row->creation_date)):"");
			$list['date_expiration'] = (isset($row->expiration_date)?date('d/m/Y', strtotime($row->expiration_date)):"");
			$list['whois'] = $row->whois;

			$data[] = $list;
		}

		$this->output->set_content_type('application/json')->set_output( json_encode($data));
	}
	public function ajaxCalendarWhois()
	{
		$all_whois = $this->model_whois->view_all_whois();
		$count_websites =  $this->model_front->count_all_websites();
		foreach ($all_whois->result() as $row)
		{
			$calendar_whois[] = array('title' => $row->url_website, 'details' => 'Eat chocolate until you pass out', 'date' => $row->expiration_date, 'open' => false );
		}			
		$this->output->set_content_type('application/json')->set_output(json_encode($calendar_whois));
	}
	public function ajaxRefresh()
	{
		$all_whois = $this->model_whois->view_all_whois();
		$count_websites =  $this->model_front->count_all_websites();
		$data = array();
		foreach ($all_whois->result() as $row)
		{
			if (strtotime($this->model_whois->check_whois($row->whois_id)->expiration_date) == false ) {
				$domain = new Whois($row->url_website);
				$whois = $domain->whoisdomain();
				$date_create = str_replace(array('/', '.'), '-', $whois[1]);
				$date_expire = str_replace(array('/', '.'), '-', $whois[2]);
				$this->model_whois->update_whois($row->whois_id,utf8_encode($whois[0]),($whois[1] ? date("Y-m-d", strtotime($date_create)): null),($whois[2] ? date("Y-m-d", strtotime($date_expire)): null), ($whois[3] ? trim($whois[3]): null));
				$pos = strrpos($row->url_website, ".fr");
				if (!$pos === false) {
					sleep(10);
				}
			}

			$list = array();
			$list['name_whois'] = $row->name_website;
			$list['website'] = '<a href="'.prep_url($row->url_website).'" target="_blank">'.$row->url_website.'</a>';
			$list['hosting'] = $row->registrar;
			$list['date_delivery'] = (isset($row->creation_date)?date('d/m/Y', strtotime($row->creation_date)):"");
			$list['date_expiration'] = (isset($row->expiration_date)?date('d/m/Y', strtotime($row->expiration_date)):"");
			$list['whois'] = $row->whois;


			$data[] = $list;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function modal_whois($whois_id = '')
	{
		$whois = $this->model_whois->check_whois($whois_id)->whois;

		$datatable = array(0 => $whois);

		echo $whois;
	}
}
