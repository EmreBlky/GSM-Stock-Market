<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        //$this->load->helper('security');
        $this->load->model('member/member_model', 'member_model');
    }

    function index()
    {
        $data['main'] = 'member';        
        $data['title'] = 'GSM - Home';        
        $data['page'] = 'index';
        $data['list_member'] = $this->member_model->get_all();

        $this->load->module('templates');
        $this->templates->page($data);        
    }
	
}