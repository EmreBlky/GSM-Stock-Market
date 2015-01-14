<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->search($data);
    }
    
    function user()
    {
        $data['page'] = 'user';
        
        $this->load->module('templates');
        $this->templates->search($data);
    }
    
    function company()
    {
        $data['page'] = 'company';
        
        $this->load->module('templates');
        $this->templates->search($data);
    }
    	
}