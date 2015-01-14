<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->profile($data);
    }
    
    function who_viewed()
    {
        $data['page'] = 'whos-viewed';
        
        $this->load->module('templates');
        $this->templates->profile($data);
    }
    
    function viewed_profile()
    {
        $data['page'] = 'view-profile';
        
        $this->load->module('templates');
        $this->templates->profile($data);
    }
    
    function edit_profile()
    {
        $data['page'] = 'edit-profile';
        
        $this->load->module('templates');
        $this->templates->profile($data);
    }
	
}