<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->support($data);
    }
    
    function faq()
    {
        $data['page'] = 'faq';
        
        $this->load->module('templates');
        $this->templates->support($data);
    }
    
    function submit_ticket()
    {
        $data['page'] = 'submit-ticket';
        
        $this->load->module('templates');
        $this->templates->support($data);
    }	
	
}