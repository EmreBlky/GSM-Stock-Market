<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Country extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('country/country_model', 'country_model');
    }

    function index()
    {
        $data['main'] = 'country';
	$data['title'] = 'country';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function select_country($mid = NULL)
    {
        if(isset($mid)){
            
            
            $cid = $this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($mid)->company_id)->country)->id;
            
//            echo '<pre>';
//            print_r($cid);
//            exit();
            
            if($cid > 0){
                $data['cid'] = $cid;
                $data['country'] = $this->country_model->get_where($cid)->country;
            }
            else{
                $data['cid'] = 0; 
            }
        
        }
        $data['select_country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->view('select-country', $data);
    }
    
    function select_phone($mid = NULL)
    {
        if(isset($mid)){           
            
            $pid = $this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($mid)->company_id)->country)->id;
            
//            echo '<pre>';
//            print_r($pid);
//            exit;
            
            if($pid > 0){
                $data['pid'] = $pid;
                $data['dial_code'] = $this->country_model->get_where($pid)->dial_code;
            }
            else{
                $data['pid'] = 0; 
            }
        
        }
        $data['select_phone'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->view('select-phone', $data);
    } 
    
    function select_mobile($mid = NULL)
    {
        if(isset($mid)){           
            
            $mpid = $this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($mid)->company_id)->country)->id;
            
//            echo '<pre>';
//            print_r($pid);
//            exit;
            
            if($mpid > 0){
                $data['mpid'] = $mpid;
                $data['dialing_code'] = $this->country_model->get_where($mpid)->dial_code;
            }
            else{
                $data['mpid'] = 0; 
            }
        
        }
        $data['select_mobile'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->view('select-mobile', $data);
    }
    
}