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

    }
    
    function viewed_profile()
    {

    }
    
    function edit_profile()
    {

    }
	
}