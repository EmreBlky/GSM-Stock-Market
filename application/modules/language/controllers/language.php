<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Language extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
         $this->load->model('language/language_model', 'language_model');
    }

    function index()
    {
        $data['main'] = 'language';
	$data['title'] = 'language';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function select($mid = NULL)
    {
        if(isset($mid)){
            $this->load->model('member/member_model', 'member_model');
            
            $lid = $this->member_model->get_where($mid)->language;
            if($lid > 0){
                $data['lid'] = $this->member_model->get_where($mid)->language;
                $data['language'] = $this->language_model->get_where($this->member_model->get_where($mid)->language)->language;
            }
            else{
                $data['lid'] = 0;                
            }
        
        }
        $data['select'] = $this->language_model->_custom_query("SELECT * FROM language ORDER BY language ASC");
        $this->load->view('select', $data);
    }
}