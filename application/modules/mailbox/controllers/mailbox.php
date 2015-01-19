<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends MX_Controller 
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
        $data['main'] = 'mailbox';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function inbox()
    {
        $data['main'] = 'mailbox';        
        $data['page'] = 'inbox';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function compose()
    {
        $data['main'] = 'mailbox';        
        $data['page'] = 'compose';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function archive()
    {
        $data['main'] = 'mailbox';        
        $data['page'] = 'archive';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }	
	
}