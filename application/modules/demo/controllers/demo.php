<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Demo extends MX_Controller 
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
        $data['main'] = 'demo';
		$data['title'] = 'Request a Demo';
        $data['page'] = 'index';
        
        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
		
        $this->load->module('templates');
        $this->templates->page($data);
    } 
}