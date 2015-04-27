<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MX_Controller 
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
        $data['main'] = 'events';
	$data['title'] = 'GSM Stockmarket : Events';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function attendees()
    {
        $data['main'] = 'events';
	$data['title'] = 'GSM Stockmarket : Events';
        $data['page'] = 'attendees';
        $this->load->module('templates');
        $this->templates->page($data);
    }
}