<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller 
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
        $data['main'] = 'profile';        
        $data['title'] = 'GSM - Profile';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function who_viewed()
    {
        $data['main'] = 'profile';        
        $data['title'] = 'GSM - Whos Viewed Profile';        
        $data['page'] = 'whos-viewed';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function viewed_profile()
    {
        $data['main'] = 'profile';        
        $data['title'] = 'GSM - Viewed Profiles';        
        $data['page'] = 'view-profile';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function edit_profile()
    {
        $data['main'] = 'profile';        
        $data['title'] = 'GSM - Edit Profile';        
        $data['page'] = 'edit-profile';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
	
}