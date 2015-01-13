<?php
class Header extends MX_Controller 
{

    function __construct()
    {
        parent::__construct();
        //$this->load->module('pages');
        //$this->load->module('meta_settings');
    }

    function index()
    {

    }

    function pre_header()
    {
        $data['base'] = $this->config->item('base_url');

        $this->load->view('pre-header', $data);
    }

    function main_header()
    {
        $data['base'] = $this->config->item('base_url');

        $this->load->view('header', $data);		
    }
    
    function admin_pre_header()
    {
        $data['base'] = $this->config->item('base_url');
        $this->load->view('admin-pre-header', $data);
    }
    
    function admin_sidebar()
    {
        $data['active'] = $this->uri->segment(2);
        $this->load->view('admin-sidebar', $data);
    }

    function admin_main_header()
    {
        $this->load->view('admin-header');		
    }
    
    function login_pre_header()
    {
        $data['base'] = $this->config->item('base_url');

        $this->load->view('login-register-pre-header', $data);
    }

    function login_main_header()
    {
        $data['base'] = $this->config->item('base_url');

        $this->load->view('login-register-header', $data);		
    }
}