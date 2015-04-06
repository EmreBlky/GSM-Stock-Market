<?php
class Analytics extends MX_Controller 
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {

    }

    function google_analytics($code, $url)
    {
        $data['ga_code'] = $code;
        $data['ga_url'] = $url;

        $this->load->view('google_analytics', $data);

    }
	
	
}