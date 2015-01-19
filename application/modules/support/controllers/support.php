<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MX_Controller 
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
        $data['main'] = 'support';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function faq()
    {
        $data['main'] = 'support';        
        $data['page'] = 'faq';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function submit_ticket()
    {
        $data['main'] = 'support';        
        $data['page'] = 'submit-ticket';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }	
	
}