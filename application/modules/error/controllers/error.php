<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Error extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
    }

    function index()
    {
        $data['title'] = '404 Page Not Found';
        $this->load->view('index', $data);
    } 
}