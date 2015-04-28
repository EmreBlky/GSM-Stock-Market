<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Events extends MX_Controller 
{
    function __construct()
    {
//        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('events/events_model', 'events_model');
    }

    function index()
    {
        $data['main'] = 'events';
	$data['title'] = 'GSM Stockmarket : Events';
        $data['page'] = 'index';
        
        $data['events_count'] = $this->events_model->count_all();
        $data['events_active'] = $this->events_model->count_where('status', 'active');
        $data['events'] = $this->events_model->get_where_multiples_order('sort_order', 'ASC', 'status', 'active');
        
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