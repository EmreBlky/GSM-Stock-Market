<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
    }

    function index()
    {
        $data['main'] = 'legal';
	$data['title'] = 'GSM Stockmarket: Legal';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function terms_conditions()
    {        
        $data['main'] = 'legal';
	$data['title'] = 'GSM Stockmarket: Legal - Terms &amp; Conditions';
        $data['page'] = 'terms-conditions';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function privacy_policy()
    {        
        $data['main'] = 'legal';
	$data['title'] = 'GSM Stockmarket: Legal - Privacy Policy';
        $data['page'] = 'privacy-policy';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
}