<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messenger extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        $this->load->model('activity/activity_model', 'activity_model');
        
        $data_activity = array(
                                'activity' => 'Messenger',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
    }

    function index()
    {
        $data['main'] = 'messenger';
        $data['page'] = 'index';
        $data['title'] = 'GSM - Messenger';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function chat()
    {
        $data['main'] = 'messenger';
        $data['page'] = 'chat';
        $data['title'] = 'GSM - Messenger Chat';
        $this->load->module('templates');
        $this->templates->page($data);
    }
}