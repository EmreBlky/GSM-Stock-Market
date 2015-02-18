<?php
class Home extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in') )
        { 
            redirect('login');
        }
    }

    function index()
    {

        $data['main'] = 'home';        
        $data['title'] = 'GSM - Home';        
        $data['page'] = 'index';

        $this->load->module('templates');
        $this->templates->page($data);

    }



    function confirmation($var = NULL)
    {

        $data['main'] = 'home';        
        $data['title'] = 'GSM - Confirmation';        
        $data['page'] = 'cofirm';

        $this->load->module('templates');
        $this->templates->page($data);

    }        

}