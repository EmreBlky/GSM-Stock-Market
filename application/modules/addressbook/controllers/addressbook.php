<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addressbook extends MX_Controller 
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
        $data['main'] = 'addressbook';
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function individual()
    {
        $data['main'] = 'addressbook';
        $data['page'] = 'individuals';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function company()
    {
        $data['main'] = 'addressbook';
        $data['page'] = 'companies';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function favourite()
    {
        $data['main'] = 'addressbook';
        $data['page'] = 'favourites';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }	
	
}