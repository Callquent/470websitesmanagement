<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('css_url'))
{
    function css_url($nom)
    {
        return '<link href="' . base_url() . 'assets/' . $nom . '" type="text/css" rel="stylesheet"/>';
    }
}

if ( ! function_exists('js_url'))
{
    function js_url($nom)
    {
        return '<script type="text/javascript" src="' . base_url() . 'assets/' . $nom . '"></script>';
    }
}

if ( ! function_exists('html_url'))
{
    function html_url($nom)
    {
        return base_url() . 'assets/' . $nom;
    }
}

if ( ! function_exists('img_url'))
{
    function img_url($nom)
    {
        return base_url() . 'assets/img/' . $nom;
    }
}
if ( ! function_exists('path_slash'))
{
    function path_jointure_file($path,$file)
    {
        return (rtrim($path,'/').'/').$file;
    }
}
if ( ! function_exists('check_access'))
{
    function check_access()
    {
        $CI =& get_instance();
        $CI->load->library("Aauth");
        $CI->load->library('session');

        if($CI->aauth->is_loggedin() && !$CI->aauth->is_member("Unknown",$CI->session->userdata['id']))
        {
            return true;
        } else {
            return false;
        }
    }
}
if ( ! function_exists('past_time_project'))
{
    function past_time_project($id_project_tasks)
    {
        $CI =& get_instance();
        $CI->load->model('model_tasks');

        $now = time();
        $your_date = strtotime($CI->model_tasks->get_project($id_project_tasks)->started_project_tasks);
        $datediff = floor(($now - $your_date) / (60 * 60 * 24));

        return $datediff;
    }
}
if ( ! function_exists('remaining_time_project'))
{
    function remaining_time_project($id_project_tasks)
    {
        $CI =& get_instance();
        $CI->load->model('model_tasks');

        $now = time();
        $your_date = strtotime($CI->model_tasks->get_project($id_project_tasks)->deadline_project_tasks);
        $datediff = floor(($your_date - $now) / (60 * 60 * 24));

        if ($datediff > 0) {
            $result = $datediff;
        } else {
            $result = "temps dépassé";
        }

        return $result;
    }
}
if ( ! function_exists('removeurl_createdomain'))
{
    function removeurl_createdomain($url)
    {
        $url_domain_page = preg_replace('/((https?|ftp|file):\/\/|www\.)/i', '', $url);
        $domain = preg_replace('/(\/\S*)?/i', '', $url_domain_page);
        return $domain;
    }
}