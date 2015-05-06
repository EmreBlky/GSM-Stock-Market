<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trial extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('trial/trial_model', 'trial_model');
        $this->load->model('member/member_model', 'member_model');
    }

    function index()
    {
        $data['main'] = 'trial';
	$data['title'] = 'GSM Stockmarket: Trial';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function activate($mid)
    {
        $tcount = $this->trial_model->_custom_query_count("SELECT COUNT(*) AS count FROM trial WHERE member_id = '".$mid."'");
        
        if($tcount[0]->count < 1){
            $data = array(
                        'member_id'     => $mid,
                        'date'          => date('Y-m-d H:i:s')
                        );
            $this->trial_model->_insert($data);
            
            $data_mem = array(
                            'membership' => 2
                            );
            $this->member_model->_update($mid, $data_mem);
            
            $this->session->set_userdata('membership', 2);
            
            $this->session->set_flashdata('confirm', '<div style="margin-top:15px">    
                                                                <div class="alert alert-success">
                                                                    Your account has been upgraded with a 30 day trial.
                                                                </div>
                                                            </div>');
            redirect('home/');
        }
        else{
            $this->session->set_flashdata('confirm', '<div style="margin-top:15px">    
                                                                <div class="alert alert-warning">
                                                                    Your account has already had a 30 day free trail. Please upgrade your account.
                                                                </div>
                                                            </div>');
            redirect('home/');
        }
    }
    
    function update()
    {
        $date = date('Y-m-d H:i:s', strtotime('-30 days'));
        
        $trials = $this->trial_model->get_all();      
        
        foreach ($trials as $trial){
            
            if($trial->date < $date){
                
                $data = array(
                            'status'     => 'expired'
                            );
                $this->trial_model->_update_where($data, 'member_id', $trial->member_id);

                $data_mem = array(
                                'membership' => 1
                                );
                $this->member_model->_update_where($data_mem, 'id', $trial->member_id);
                
                $this->session->set_userdata('membership', 1);
                
            }
        }        
        
    }
}