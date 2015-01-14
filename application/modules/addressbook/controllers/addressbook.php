<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addressbook extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->addressbook($data);
    }
    
    function individual()
    {
        $data['page'] = 'individuals';
        
        $this->load->module('templates');
        $this->templates->addressbook($data);
    }
    
    function company()
    {
        $data['page'] = 'companies';
        
        $this->load->module('templates');
        $this->templates->addressbook($data);
    }
    
    function favourite()
    {
        $data['page'] = 'favourites';
        
        $this->load->module('templates');
        $this->templates->addressbook($data);
    }	
	
}