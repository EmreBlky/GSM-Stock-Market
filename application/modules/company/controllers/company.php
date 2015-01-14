<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->company($data);
    }
    
    function who_viewed()
    {
        $data['page'] = 'whos-viewed';
        
        $this->load->module('templates');
        $this->templates->company($data);
    }
    
    function viewed_company()
    {
        $data['page'] = 'view-company';
        
        $this->load->module('templates');
        $this->templates->company($data);
    }
    
    function edit_company()
    {
        $data['page'] = 'edit-company';
        
        $this->load->module('templates');
        $this->templates->company($data);
    }	
	
}