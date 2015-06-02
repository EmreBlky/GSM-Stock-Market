<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Attending extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('attending/attending_model', 'attending_model');
        $this->load->model('events/events_model', 'events_model');
    }

    function index()
    {
        $data['main'] = 'attending';
	$data['title'] = 'GSM Stockmarket: Attending';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function attending_list($pid)
    {
        $data['main'] = 'attending';
	$data['title'] = 'GSM Stockmarket: Attending';
        $data['page'] = 'index';
        
        $evecount = $this->attending_model->_custom_query_count("SELECT COUNT(*) AS count FROM attending WHERE member_id = '".$pid."'");
        
        if($evecount[0]->count > 0){
            
            $data['list_count'] = $evecount[0]->count;       
            $data['lists'] = $this->attending_model->get_where_multiples('member_id', $pid);
        }
        else{
           $data['list_count'] =  0;
        }
        
        
        $this->load->view('attending-list', $data);
    }
    
    function addCompany($eid, $mid)
    {
        $data = array(
                    'event_id'  => $eid,
                    'member_id' => $mid
                    );
        $this->attending_model->_insert($data);
    }
    
    function removeCompany($eid, $mid)
    {
        $this->attending_model->_delete_where('event_id', $eid, 'member_id', $mid);
    }
}