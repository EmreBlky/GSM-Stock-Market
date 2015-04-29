<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditdata extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
    }


    function requests()
    {
        $data['main'] = 'creditdata';
		$data['title'] = 'Requests';
        $data['page'] = 'requests';
        $this->load->module('templates');
        $this->templates->page($data);
    } 

    function my_reports()
    {
        $data['main'] = 'creditdata';
		$data['title'] = 'My Reports';
        $data['page'] = 'my_reports';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
}