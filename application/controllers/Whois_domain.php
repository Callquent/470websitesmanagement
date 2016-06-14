<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whois_domain extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('model_front');
		$this->load->model('model_back');
		$this->load->model('model_whois');
		$this->load->model('model_settings');
		$this->load->library("Aauth");
		$this->load->library("Whois");
		$this->load->library(array('form_validation', 'session'));
		$this->load->library(array('encrypt','session'));
		$this->load->library('email');
		$this->load->helper(array('functions', 'text', 'url'));
		$this->load->helper('date');
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

			$this->load->view('whois-domain', $data);
		} else {
			$this->load->view('index');
		}
	}
	public function ajaxWhois()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$all_whois = $this->model_whois->view_all_whois();
			$count_websites =  $this->model_front->count_all_websites();
			$data = array();
			foreach ($all_whois->result() as $row)
			{
				$list = array();
				$list[] = $row->w_title;;
				$list[] = '<a href="'.prep_url($row->w_url_rw).'" target="_blank">'.$row->w_url_rw.'</a>';
				$list[] = $row->register;
				$list[] = (isset($row->creation_date)?date('d/m/Y', strtotime($row->creation_date)):"");
				$list[] = (isset($row->expiration_date)?date('d/m/Y', strtotime($row->expiration_date)):"");

				$data[] = $list;
			}
			$output = array("draw" => $_POST['draw'],
							"recordsTotal" => $all_whois->num_rows(),
							"recordsFiltered" => $count_websites->num_rows(),
							"data" => $data);
			echo json_encode($output);
		} else {
			$this->load->view('index');
		}
	}
	public function downloadWhois()
	{
		if($this->aauth->is_loggedin() && ($this->aauth->is_member("Developper",$this->session->userdata['id']) || 
			$this->aauth->is_member("Marketing",$this->session->userdata['id']) ||
			$this->aauth->is_member("Visitor",$this->session->userdata['id'])))
		{
			$all_websites = $this->model_front->get_all_websites();
			/*$all_count_websites = $this->model_front->count_all_websites()->row()->count_all_websites;
			$i*100/$all_count_websites;*/
			set_time_limit(0);
			foreach ($all_websites->result() as $row) {
				if ($this->model_whois->check_whois($row->w_id)->w_id_info != $row->w_id) {
					$domain = new Whois($row->w_url_rw);
					$whois = $domain->lookup();
					$date_create = str_replace(array('/', '.'), '-', $whois[1]);
					$date_expire = str_replace(array('/', '.'), '-', $whois[2]);
					$this->model_whois->create_all_whois($row->w_id,utf8_encode($whois[0]),($whois[1] ? date("Y-m-d", strtotime($date_create)): null),($whois[2] ? date("Y-m-d", strtotime($date_expire)): null),trim($whois[3]));
					$pos = strrpos($row->w_url_rw, ".fr");
					if (!$pos === false) {
						sleep(10);
					}
				} else if (strtotime($this->model_whois->check_whois($row->w_id)->expiration_date) <= strtotime(date('Y-m-d')) && strtotime($this->model_whois->check_whois($row->w_id)->expiration_date) != 0 ) {
					$domain = new Whois($row->w_url_rw);
					$whois = $domain->lookup();
					$date_create = str_replace(array('/', '.'), '-', $whois[1]);
					$date_expire = str_replace(array('/', '.'), '-', $whois[2]);
					$this->model_whois->update_whois($row->w_id,utf8_encode($whois[0]),($whois[1] ? date("Y-m-d", strtotime($date_create)): null),($whois[2] ? date("Y-m-d", strtotime($date_expire)): null),trim($whois[3]));
					$pos = strrpos($row->w_url_rw, ".fr");
					if (!$pos === false) {
						sleep(10);
					}
				}
			}
		}else {
			$this->load->view('index');
		}
	}
}
