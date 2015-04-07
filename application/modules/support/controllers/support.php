<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Support extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        $this->load->model('activity/activity_model', 'activity_model');
        $this->load->model('member/member_model', 'member_model');        
        
    }

    function index()
    {
        $data['main'] = 'support';        
        $data['title'] = 'GSM - Support';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function faq()
    {
        $data_activity = array(
                                'activity' => 'Support: FAQ',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'support';        
        $data['title'] = 'GSM - FAQ';        
        $data['page'] = 'faq';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function submit_ticket()
    {
        $data_activity = array(
                                'activity' => 'Support: Submit Ticket',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'support';        
        $data['title'] = 'GSM - Submit A Ticket';        
        $data['page'] = 'submit-ticket';
        
        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
        
        $this->load->module('templates');
        $this->templates->page($data);
    }	
	
}