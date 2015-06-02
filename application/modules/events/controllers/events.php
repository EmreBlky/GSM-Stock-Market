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
        
        if ($this->session->userdata('terms') == 'no')
        { 
            redirect('legal/terms_conditions');
        }
        
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
        
        $attend_count = $this->attending_model->_custom_query_count("SELECT COUNT(*) AS count FROM attending WHERE event_id = '".$eid."'");
        
        if($attend_count[0]->count){
            $data['attendees_count'] = $attend_count[0]->count;
            $data['event'] = $this->events_model->get_where($eid);
            $data['attendees'] = $this->attending_model->get_where_multiples('event_id', $eid);
        }
        else{
            $data['event'] = $this->events_model->get_where($eid);
            $data['attendees_count'] = 0;
        }
        
        $att_count = $this->attending_model->_custom_query_count("SELECT COUNT(*) AS count FROM attending WHERE member_id = '".$this->session->userdata('members_id')."' AND event_id = '".$eid."'");
          
        if($att_count[0]->count){
            $data['att_count'] = $att_count[0]->count;
        }
        else{
            $data['att_count'] = 0;
        }
             
        $this->load->module('templates');
        $this->templates->page($data);
    }
}