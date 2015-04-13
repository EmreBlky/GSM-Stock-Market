<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Imei extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        $this->load->model('activity/activity_model', 'activity_model');
        
    }

    function index()
    {
        $this->load->model('activity/activity_model', 'activity_model');
        $data_activity = array(
                                'activity' => 'IMEI: Index',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';
		$data['title'] = 'IMEI Services';
        $data['page'] = 'index';
		
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function imei_lookup()
    {
        $data_activity = array(
                                'activity' => 'IMEI: TAC Code Lookup',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';        
        $data['title'] = 'IMEI TAC Code Lookup';        
        $data['page'] = 'imei-lookup';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function unlocking()
    {
        $data_activity = array(
                                'activity' => 'IMEI: Unlocking',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';        
        $data['title'] = 'IMEI Unlocking';        
        $data['page'] = 'unlocking';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function archive()
    {
        $data_activity = array(
                                'activity' => 'IMEI: Archive',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';        
        $data['title'] = 'IMEI Archive';        
        $data['page'] = 'archive';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function top_up()
    {
        $data_activity = array(
                                'activity' => 'IMEI: Top Up',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'imei';        
        $data['title'] = 'IMEI Top up';        
        $data['page'] = 'top-up';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
	
}