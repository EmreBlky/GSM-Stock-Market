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
        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
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
    
    function accept_count()
    {
         $request = $this->creditdata_model->_custom_query_count("SELECT COUNT(*) AS count FROM creditdata WHERE requester_id = '".$this->session->userdata('members_id')."' AND request_action = 'accept'");
        
         if($request[0]->count > 0){
             
             echo '<li><a href="creditdata/my_reports"><i class="fa fa-list"></i> My Reports<span class="label label-warning pull-right">'.$request[0]->count.'</span></a></li>';
         }
         else{
             echo '<li><a href="creditdata/my_reports"><i class="fa fa-list"></i> My Reports</a></li>';
         }
         
    }

    function my_reports()
    {
        $data['main'] = 'creditdata';
	$data['title'] = 'My Reports';
        $data['page'] = 'my-reports';
        
        $request = $this->creditdata_model->_custom_query_count("SELECT COUNT(*) AS count FROM creditdata WHERE requester_id = '".$this->session->userdata('members_id')."' AND request_action = 'accept'");
        
        if($request[0]->count > 0){
            
            $data['request_count'] = $request[0]->count;
            $data['requests'] = $this->creditdata_model->get_where_multiples_order('date', 'DESC', 'requester_id', $this->session->userdata('members_id'), 'request_action', 'accept');            
        }
        else{
            $data['request_count'] = 0;
        }
         
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function request_creditcheck($mid)
    {
        $data['member'] = $this->member_model->get_where($mid);
        $this->load->view('request-creditcheck', $data);
    }
    
    function processRequest($mid, $sid, $type, $credit_report)
    {
        $data = array(
                       'request_id' => $mid,
                       'requester_id' => $sid,
                       'request_type' => $type,
                       'credit_report' => $credit_report,
                       'date' => date('j F Y'),
                    );
        $this->creditdata_model->_insert($data);
        
        if($type == 'both'){
            
            $sid_credit = $this->company_model->get_where($this->member_model->get_where($sid)->company_id)->credit_report;
            
            $data_sid = array(
                       'request_id' => $sid,
                       'requester_id' => $mid,
                       'request_action' => 'accept',
                       'credit_report' => $sid_credit,
                       'date' => date('j F Y'),
                    );
        $this->creditdata_model->_insert($data_sid);
            
        }
    }
    
    function acceptRequest($id, $mid, $sid)
    {
        $data = array(
                      'request_action' => 'accept'  
        );
        $this->creditdata_model->_update($id, $data);
        
        $data_mail = array(
                                    'member_id'         => 5,
                                    'member_name'       => 'GSM Support',
                                    'sent_member_id'    => $sid,
                                    'sent_member_name'  => $this->member_model->get_where($sid)->firstname.' '.$this->member_model->get_where($sid)->lastname,
                                    'subject'           => 'Credit Check Accepted',
                                    'body'              => 'You request for a credit check of company '.$this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_name.' was approved.',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'sent_belong'       => 5,
                                    'draft'             => 'no',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'parent_id'         => $this->input->post('parent_id'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );
        $this->mailbox_model->_insert($data_mail);
        
        $this->session->set_flashdata('confirm', '<div style="margin:15px 15px">    
                                                                <div class="alert alert-success">
                                                                    That request has been accepted.
                                                                </div>
                                                            </div>');
        
        redirect('creditdata/requests');
    }
    
    function declineRequest($id, $mid, $sid)
    {
        $data = array(
                      'request_action' => 'decline'  
        );
        $this->creditdata_model->_update($id, $data);
        
        $data_mail = array(
                                    'member_id'         => 5,
                                    'member_name'       => 'GSM Support',
                                    'sent_member_id'    => $sid,
                                    'sent_member_name'  => $this->member_model->get_where($sid)->firstname.' '.$this->member_model->get_where($sid)->lastname,
                                    'subject'           => 'Credit Check Declined',
                                    'body'              => 'You request for a credit check of company '.$this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_name.' was denied.',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'sent_belong'       => 5,
                                    'draft'             => 'no',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'parent_id'         => $this->input->post('parent_id'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );
        $this->mailbox_model->_insert($data_mail);
        
        $this->session->set_flashdata('confirm', '<div style="margin:15px 15px">    
                                                                <div class="alert alert-success">
                                                                    That request has been declined.
                                                                </div>
                                                            </div>');
        
        redirect('creditdata/requests');
    }
}