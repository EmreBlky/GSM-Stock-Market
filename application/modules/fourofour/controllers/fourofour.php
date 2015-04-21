<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fourofour extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
    }

    function index()
    {
        //$data['main'] = 'fourofour';
        $data['title'] = 'GSM - 404 Page Not Found';
        //$data['page'] = 'index';
        //$this->load->module('templates');
        //$this->templates->page($data);
        $this->load->view('index', $data);
    } 
}