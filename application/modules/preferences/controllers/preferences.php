<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preferences extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->preferences($data);
    }
    
    function password()
    {
        $data['page'] = 'password';
        
        $this->load->module('templates');
        $this->templates->preferences($data);
    }
    
    function newsletter()
    {
        $data['page'] = 'newsletter';
        
        $this->load->module('templates');
        $this->templates->preferences($data);
    }
    
    function subscription()
    {
        $data['page'] = 'subscription';
        
        $this->load->module('templates');
        $this->templates->preferences($data);
    }
	
}