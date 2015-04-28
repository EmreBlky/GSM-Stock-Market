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
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('country/country_model', 'country_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('events/events_model', 'events_model');
        $this->load->model('attending/attending_model', 'attending_model');
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
    
    function attendees($eid)
    {
        $data['main'] = 'events';
	$data['title'] = 'GSM Stockmarket : Events';
        $data['page'] = 'attendees';
        
        $data['event'] = $this->events_model->get_where($eid);
        $data['attendees'] = $this->attending_model->get_where_multiples('event_id', $eid);
             
        $this->load->module('templates');
        $this->templates->page($data);
    }
}