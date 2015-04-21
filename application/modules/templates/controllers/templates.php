<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MX_Controller{    

    function page($data)
    {
        $this->load->view('pages/index', $data);
    }
    
    function admin($data)
    {
        $this->load->view('admin/index', $data);
    }	
}
