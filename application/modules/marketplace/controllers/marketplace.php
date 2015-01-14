<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketplace extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->marketplace($data);
    }
    
    function buy()
    {
        $data['page'] = 'buy';
        
        $this->load->module('templates');
        $this->templates->marketplace($data);
    }
    
    function sell()
    {
        $data['page'] = 'sell';
        
        $this->load->module('templates');
        $this->templates->marketplace($data);
    }
    
    function watching()
    {
        $data['page'] = 'watching';
        
        $this->load->module('templates');
        $this->templates->marketplace($data);
    }
    
    function listing()
    {
        $data['page'] = 'my-listings';
        
        $this->load->module('templates');
        $this->templates->marketplace($data);
    }
    
    function history()
    {
        $data['page'] = 'order-history';
        
        $this->load->module('templates');
        $this->templates->marketplace($data);
    }
	
}