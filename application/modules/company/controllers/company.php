<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends MX_Controller 
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
        $data['main'] = 'company';
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function who_viewed()
    {
        $data['main'] = 'company';        
        $data['page'] = 'whos-viewed';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function viewed_company()
    {
        $data['main'] = 'company';        
        $data['page'] = 'view-company';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function edit_company()
    {
        $data['main'] = 'company';        
        $data['page'] = 'edit-company';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }	
	
}