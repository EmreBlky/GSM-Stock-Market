<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->mailbox($data);
    }
    
    function inbox()
    {
        $data['page'] = 'inbox';
        
        $this->load->module('templates');
        $this->templates->mailbox($data);
    }
    
    function compose()
    {
        $data['page'] = 'compose';
        
        $this->load->module('templates');
        $this->templates->mailbox($data);
    }
    
    function archive()
    {
        $data['page'] = 'archive';
        
        $this->load->module('templates');
        $this->templates->mailbox($data);
    }	
	
}