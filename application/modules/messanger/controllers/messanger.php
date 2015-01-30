<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Messanger extends MX_Controller 
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
        $data['main'] = 'messanger';
        $data['page'] = 'index';
        $data['title'] = 'GSM - Messanger';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function chat()
    {
        $data['main'] = 'messanger';
        $data['page'] = 'chat';
        $data['title'] = 'GSM - Messanger Chat';
        $this->load->module('templates');
        $this->templates->page($data);
    }
}