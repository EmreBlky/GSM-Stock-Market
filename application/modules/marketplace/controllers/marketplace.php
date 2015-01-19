<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketplace extends MX_Controller 
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
        $data['main'] = 'marketplace';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function buy()
    {
        $data['main'] = 'marketplace';        
        $data['page'] = 'buy';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sell()
    {
        $data['main'] = 'marketplace';        
        $data['page'] = 'sell';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function watching()
    {
        $data['main'] = 'marketplace';        
        $data['page'] = 'watching';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function listing()
    {
        $data['main'] = 'marketplace';        
        $data['page'] = 'my-listings';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function history()
    {
        $data['main'] = 'marketplace';        
        $data['page'] = 'order-history';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
	
}