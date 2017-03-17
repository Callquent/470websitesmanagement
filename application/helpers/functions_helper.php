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
if ( ! function_exists('check_access'))
{
    function check_access()
    {
        $CI =& get_instance();
        $CI->load->library("Aauth");
        $CI->load->library('session');

        if($CI->aauth->is_loggedin() && ($CI->aauth->is_member("Admin",$CI->session->userdata['id']) ||
            $CI->aauth->is_member("Developper",$CI->session->userdata['id']) ||
            $CI->aauth->is_member("Marketing",$CI->session->userdata['id']) ||
            $CI->aauth->is_member("Public",$CI->session->userdata['id'])))
        {
            return true;
        } else {
            return false;
        }
    }
}