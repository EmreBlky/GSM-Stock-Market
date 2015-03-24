<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedback extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
    }

    function index()
    {
        $data['main'] = 'feedback';
	$data['title'] = 'feedback';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function leave_feedback($mid)
    {
        $data['main'] = 'feedback';
        $data['base'] = $this->config->item('base_url');
        //$data['member'] = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_name;
        $this->load->view('leave-feedback', $data);
    }
    
    function processFeedback()
    {
        
    }
}