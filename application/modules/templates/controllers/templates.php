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
    
    function mailbox($data)
    {
        $this->load->view('pages/mailbox', $data);
    }
    
    function addressbook($data)
    {
        $this->load->view('pages/addressbook', $data);
    }
    
    function marketplace($data)
    {
        $this->load->view('pages/marketplace', $data);
    }
    
    function support($data)
    {
        $this->load->view('pages/support', $data);
    }
    
    function company($data)
    {
        $this->load->view('pages/company', $data);
    }
    
    function preferences($data)
    {
        $this->load->view('pages/preferences', $data);
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
