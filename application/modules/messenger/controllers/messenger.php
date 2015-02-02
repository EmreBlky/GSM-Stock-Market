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