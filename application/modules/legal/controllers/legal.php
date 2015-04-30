<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Legal extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('legal/legal_model', 'legal_model');
    }

    function index()
    {
        $data['main'] = 'legal';
	$data['title'] = 'GSM Stockmarket: Legal';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function terms_conditions()
    {        
        $data['main'] = 'legal';
	$data['title'] = 'GSM Stockmarket: Legal - Terms &amp; Conditions';
        $data['page'] = 'terms-conditions';
        
        $data['terms'] = $this->legal_model->get_where(1);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function privacy_policy()
    {        
        $data['main'] = 'legal';
	$data['title'] = 'GSM Stockmarket: Legal - Privacy Policy';
        $data['page'] = 'privacy-policy';
        
        $data['privacy'] = $this->legal_model->get_where(2);        
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function acceptTerms($id)
    {
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        
        $accept = $this->input->post('user_terms');
        
        if($accept == 'yes'){
        $data = array(
                      'terms_conditions' => 'yes'
                    );
        $this->member_model->update($id, $data);
        
        $user_data = array(
                            'terms'             => 'yes'
                           );
        $this->session->set_userdata($user_data);
        
        redirect('home/');
        
        }
        else{
            
            $data = array(
                            'online_status' => 'offline'
                          );
            $this->member_model->_update($id, $data);

            $this->session->unset_userdata('members_id');
            $this->session->unset_userdata('terms'); 
            $this->session->unset_userdata('membership');
            $this->session->unset_userdata('username');
            $this->session->unset_userdata('logged_in');
            $this->session->unset_userdata('online_status');
            redirect('login');
            
        }
        
        
    }
    
}