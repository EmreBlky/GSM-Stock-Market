<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Emails extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['main'] = 'email';
	$data['title'] = 'email';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function activation($lang = NULL, $info = NULL)
    {
        $data['base'] = $this->config->item('base_url');
        
        $data['name'] = '';
        $data['password'] = '';
        
        $this->load->view('en_activation', $data);
    }
    
    function billing($lang = NULL, $info = NULL)
    {
        $data['base'] = $this->config->item('base_url');
        
        $data['company_name'] = '';
        $data['invoice'] = '';
        $data['date'] = '';
        $data['$transactions'] = '';
        $data['$transaction_id'] = '';
        
        $this->load->view('en_billing', $data);
    }
    
    function forgotten_password($lang = NULL, $info = NULL)
    {
        $data['base'] = $this->config->item('base_url');
        
        $data['name'] = '';
        $data['password'] = '';
        
        $this->load->view('en_forgotten_password', $data);
    }
    
    function signup($lang = NULL, $info = NULL)
    {
        $data['base'] = $this->config->item('base_url');
        
        $data['name'] = '';
        $data['activation_code'] = '';
        
        $this->load->view('en_signup', $data);
    }
    
    function upgrade($lang = NULL, $info = NULL)
    {
        $data['base'] = $this->config->item('base_url');
        
        $data['profile_id'] = '';
        
        $this->load->view('en_upgrade', $data);
    }
}