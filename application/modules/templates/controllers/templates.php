<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Templates extends MX_Controller{    

    function forgot_password($data)
    {
        $this->load->view('pages/forgot_password', $data);
    }
    
    function password_reset($data)
    {
        $this->load->view('pages/password_reset', $data);
    }
    
    function admin($data)
    {
        $this->load->view('admin/dashboard', $data);
    }
    
    function home($data)
    {
        $this->load->view('pages/home', $data);
    }
    
    function profile($data)
    {
        $this->load->view('pages/profile', $data);
    }
    
    function login($data)
    {
        $this->load->view('pages/login', $data);
    }
    
    function register($data)
    {
        $this->load->view('pages/register', $data);
    }

    function contact($data)
    {   
        $this->load->view('pages/contact', $data);
    }
    
    function testimonial($data)
    {
        $this->load->view('pages/testimonial', $data);
    }
    
    function search($data)
    {
        $this->load->view('pages/search', $data);
    }	
}
