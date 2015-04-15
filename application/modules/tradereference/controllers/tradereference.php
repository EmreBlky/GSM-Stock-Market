<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tradereference extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('tradereference/tradereference_model', 'tradereference_model');
        $this->load->model('country/country_model', 'country_model');
    }

    function index()
    {
        $count = $this->tradereference_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($count < 1){
            $data = array(
                          'member_id' => $this->session->userdata('members_id')
            );
            $this->tradereference_model->_insert($data);
        }
        
        $data['main'] = 'tradereference';
	$data['title'] = 'GSM - Trade Reference';
        $data['page'] = 'index';
        
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function submit_refs()
    {
        
        $data['main'] = 'tradereference';
	$data['title'] = 'GSM - Trade Reference';
        $data['page'] = 'submit-refs';
        
        
        $data['trade_ref'] = $this->tradereference_model->get_where_multiple('member_id', $this->session->userdata('members_id'));
        
        $data['country_one'] = $this->country_model->get_all();
        $data['country_two'] = $this->country_model->get_all();
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    
    function updateRef()
    {
        $this->load->helper('string');
        $this->load->library('form_validation');		            
            
        $this->form_validation->set_rules('trade_1_company', 'Company Name 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_company', 'Company Name 2', 'xss_clean');
        $this->form_validation->set_rules('trade_1_name', 'Contact Name 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_name', 'Contact Name 2', 'xss_clean');
        $this->form_validation->set_rules('trade_1_email', 'Email 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_email', 'Email 2', 'xss_clean');
        $this->form_validation->set_rules('trade_1_phone', 'Phone 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_phone', 'Phone 2', 'xss_clean');
        $this->form_validation->set_rules('trade_1_country', 'Country 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_country', 'Country 2', 'xss_clean');

            if($this->form_validation->run()){
                
                $code1 = $this->session->userdata('members_id').'-'.random_string('alnum', 4).'-'.random_string('alnum', 4);
                $code2 = $this->session->userdata('members_id').'-'.random_string('alnum', 4).'-'.random_string('alnum', 4);
                
                $data = array(
                            'trade_1_company'   => $this->input->post('trade_1_company'),
                            'trade_1_name'      => $this->input->post('trade_1_name'),
                            'trade_1_email'     => $this->input->post('trade_1_email'),
                            'trade_1_phone'     => $this->input->post('trade_1_phone'),
                            'trade_1_country'   => $this->input->post('trade_1_country'),
                            'trade_1_code'      => $code1,
                            'trade_2_company'   => $this->input->post('trade_2_company'),
                            'trade_2_name'      => $this->input->post('trade_2_name'),
                            'trade_2_email'     => $this->input->post('trade_2_email'),
                            'trade_2_phone'     => $this->input->post('trade_2_phone'),
                            'trade_2_country'   => $this->input->post('trade_2_country'),
                            'trade_2_code'      => $code2,
                );
                $this->tradereference_model->_update_where($data, 'member_id', $this->session->userdata('members_id'));

            }
        $this->session->set_flashdata('trade-confirmation', '<div style="margin:0 15px">    
                                                                <div class="alert alert-success">
                                                                    Your Trade References have been updated.
                                                                </div>
                                                            </div>');
        redirect('tradereference/');    
    }
    
    function confirm($code)
    {
        
    }
}