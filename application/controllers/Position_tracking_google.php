<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Position_tracking_google extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_users');
		$this->load->model('model_settings');
		$this->load->library(array('Aauth','form_validation', 'encrypt', 'session'));
		$this->load->helper(array('functions', 'text', 'url','language'));
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
			$data['all_languages'] = $this->model_front->get_all_languages();
			$data['all_categories'] = $this->model_front->get_all_categories();

			$data['all_domains'] = $this->model_front->get_all_domains();
			$data['all_subdomains'] = $this->model_front->get_all_subdomains();
			$data['all_count_websites'] = $this->model_front->count_all_websites()->row();
			$data['all_count_websites_per_category'] = $this->model_front->count_websites_per_category();
			$data['all_count_websites_per_language'] = $this->model_front->count_websites_per_language();
			$data['login'] = $this->session->userdata['username'];
			$data['user_role'] = $this->aauth->get_user_groups();

			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			foreach ($data['all_count_websites_per_language']->result() as $row) {
				$chart_l_title[] = $row->l_title;
				$chart_l_percent[] = number_format((float)($row->count_websites_per_language*100)/$data['all_count_websites']->count_all_websites,0);
				$chart_l_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			}

			$chart_language = array('labels' => $chart_l_title, 'datasets' => [array('data' => $chart_l_percent, 'backgroundColor' => $chart_l_color )]);
			$data['chart_language'] = json_encode($chart_language);

			
			foreach ($data['all_count_websites_per_category']->result() as $row) {
				$chart_c_title[] = $row->c_title;
				$chart_c_percent[] = number_format((float)($row->count_websites_per_category*100)/$data['all_count_websites']->count_all_websites,0);
				$chart_c_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			}

			$chart_category = array('labels' => $chart_c_title, 'datasets' => [array('data' => $chart_c_percent, 'backgroundColor' => $chart_c_color )]);
			$data['chart_category'] = json_encode($chart_category);
/*
			$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
			foreach ($data['all_count_websites_per_language']->result() as $row) {
				$chart_l_title[] = $row->l_title;
				$chart_l_percent[] = number_format((float)($row->count_websites_per_language*100)/$data['all_count_websites']->count_all_websites,0);
				$chart_l_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			}

			$chart_language = array('labels' => $chart_l_title, 'datasets' => [array('data' => $chart_l_percent, 'backgroundColor' => $chart_l_color )]);
			$data['chart_language'] = json_encode($chart_language);

			
			foreach ($data['all_count_websites_per_category']->result() as $row) {
				$chart_c_title[] = $row->c_title;
				$chart_c_percent[] = number_format((float)($row->count_websites_per_category*100)/$data['all_count_websites']->count_all_websites,0);
				$chart_c_color[] = '#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
			}

			$chart_category = array('labels' => $chart_c_title, 'datasets' => [array('data' => $chart_c_percent, 'backgroundColor' => $chart_c_color )]);
			$data['chart_category'] = json_encode($chart_category);*/
			
			$data['language'] = unserialize($this->model_settings->view_settings_lang()->value_s)['language'];
			
			$this->load->view('position-tracking-google', $data);
		}else {
			$this->load->view('index');
		}
	}
}
