<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viewed extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $data_activity = array(
                                'activity' => 'Viewed',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
    }

    function index()
    {
        $data['main'] = 'viewed';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
}