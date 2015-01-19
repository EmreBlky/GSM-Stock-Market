<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends MX_Controller 
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
        $data['main'] = 'search';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function user()
    {
        $data['main'] = 'search';        
        $data['page'] = 'user';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function company()
    {
        $data['main'] = 'search';        
        $data['page'] = 'company';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    	
}