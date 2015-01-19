<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Change_this extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
    }

    function index()
    {
        $data['main'] = 'Change_this';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
}