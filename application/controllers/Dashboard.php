<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model(array('model_front','model_language','model_category','model_tasks','model_users','model_whois','model_settings'));
		$this->load->library(array('Aauth','form_validation', 'encryption', 'session'));
		$this->load->helper(array('functions', 'text', 'url','language'));
		$this->lang->load(array('general','sidebar','navbar'), unserialize($this->model_settings->view_settings_lang()->value_s)['language']);
		$sesslanguage = array(
		        'language'  => unserialize($this->model_settings->view_settings_lang()->value_s)['language']
		);
		$this->session->set_userdata($sesslanguage);
		if(check_access() != true) { redirect('index','refresh',301); }
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
		
		$data['language'] = unserialize($this->model_settings->view_settings_lang()->value_s)['language'];
		$data['all_whois_renew_tomonth'] = $this->model_whois->get_all_whois_renew_tomonth(date('Y'),date('m'));


			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		if (!empty($data['all_count_websites_per_language']->result())) {
			foreach ($data['all_count_websites_per_language']->result() as $row) {
				$chart_name_language = $row->name_language;
				$chart_l_percent = ($row->count_websites_per_language!='0'?number_format((float)($row->count_websites_per_language*100)/$data['all_count_websites']->count_all_websites,0):'0');
				$chart_l_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
				$chart_language[] = array('key' => $chart_name_language, 'y' => $chart_l_percent);
			}

			$data['chart_language'] = json_encode($chart_language);
		} else {
			$data['chart_language'] = json_encode(0);
		}

		if (!empty($data['all_count_websites_per_category']->result())) {
			foreach ($data['all_count_websites_per_category']->result() as $row) {
				$chart_name_category = $row->name_category;
				$chart_c_percent = ($row->count_websites_per_category!='0'?number_format((float)($row->count_websites_per_category*100)/$data['all_count_websites']->count_all_websites,0):'0');
				$chart_c_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
				$chart_category[] = array('key' => $chart_name_category, 'y' => $chart_c_percent);
			}

			$data['chart_category'] = json_encode($chart_category);
		} else {
			$data['chart_category'] = json_encode(0);
		}
/*
		$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
		foreach ($data['all_count_websites_per_language']->result() as $row) {
			$chart_name_language[] = $row->name_language;
			$chart_l_percent[] = number_format((float)($row->count_websites_per_language*100)/$data['all_count_websites']->count_all_websites,0);
			$chart_l_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
		}

		$chart_language = array('labels' => $chart_name_language, 'datasets' => [array('data' => $chart_l_percent, 'backgroundColor' => $chart_l_color )]);
		$data['chart_language'] = json_encode($chart_language);

		
		foreach ($data['all_count_websites_per_category']->result() as $row) {
			$chart_name_category[] = $row->name_category;
			$chart_c_percent[] = number_format((float)($row->count_websites_per_category*100)/$data['all_count_websites']->count_all_websites,0);
			$chart_c_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
		}

		$chart_category = array('labels' => $chart_name_category, 'datasets' => [array('data' => $chart_c_percent, 'backgroundColor' => $chart_c_color )]);
		$data['chart_category'] = json_encode($chart_category);*/

		$this->load->view('general/dashboard', $data);
	}
	public function modal_whois($id_whois = '')
	{
		$whois = $this->model_whois->check_whois($id_whois)->whois;
		$datatable = array(0 => $whois);

		echo $whois;
	}
}
