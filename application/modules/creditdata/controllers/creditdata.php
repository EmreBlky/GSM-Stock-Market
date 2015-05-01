<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Creditdata extends MX_Controller 
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
        $this->load->model('creditdata/creditdata_model', 'creditdata_model');
    }


    function requests()
    {
        $data['main'] = 'creditdata';
	$data['title'] = 'Requests';
        $data['page'] = 'requests';
        
        $request = $this->creditdata_model->_custom_query_count("SELECT COUNT(*) AS count FROM creditdata WHERE request_id = '".$this->session->userdata('members_id')."' AND request_action = 'review'");
        
        if($request[0]->count > 0){
            
            $data['request_count'] = $request[0]->count;
            $data['requests'] = $this->creditdata_model->get_where_multiples_order('date', 'DESC', 'request_id', $this->session->userdata('members_id'), 'request_action', 'review');
        }
        else{
            $data['request_count'] = 0;
        }
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function request_count()
    {
         $request = $this->creditdata_model->_custom_query_count("SELECT COUNT(*) AS count FROM creditdata WHERE request_id = '".$this->session->userdata('members_id')."' AND request_action = 'review'");
        
         if($request[0]->count > 0){
             
             echo '<li><a href="creditdata/requests"><i class="fa fa-thumbs-up"></i> <span class="nav-label">Requests</span><span class="label label-warning pull-right">'.$request[0]->count.'</span></a></li>';
         }
         else{
             echo '<li><a href="creditdata/requests"><i class="fa fa-thumbs-up"></i> <span class="nav-label">Requests</span></a></li>';
         }
         
    }

    function my_reports()
    {
        $data['main'] = 'creditdata';
	$data['title'] = 'My Reports';
        $data['page'] = 'my_reports';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function request_creditcheck($mid)
    {
        $data['member'] = $this->member_model->get_where($mid);
        $this->load->view('request-creditcheck', $data);
    }
    
    function processRequest($mid, $sid, $type)
    {
        $data = array(
                       'request_id' => $mid,
                       'requester_id' => $sid,
                       'request_type' => $type,
                       'date' => date('j F Y'),
                    );
        $this->creditdata_model->_insert($data);
    }
    
    function declineRequest($id)
    {
        $data = array(
                      'request_action' => 'dcline'  
        );
        $this->creditdata_model->_update($id, $data);
        
        $this->session->set_flashdata('confirm', '<div style="margin:15px 15px">    
                                                                <div class="alert alert-success">
                                                                    That request has been declined.
                                                                </div>
                                                            </div>');
        
        redirect('creditdata/requests');
    }
}