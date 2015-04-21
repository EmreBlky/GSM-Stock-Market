<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notification extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('notification/notification_model', 'notification_model');
    }

    function index()
    {
        $data['main'] = 'notification';
	$data['title'] = 'notification';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function updateProfile()
    {
        //echo '<pre>';
        //print_r($_POST);
        $data = array(
                        'email_members'     => $this->input->post('email_members'),
                        'email_market'      => $this->input->post('email_market'),
                        'email_support'     => $this->input->post('email_support'),
                        'report_views'      => $this->input->post('report_views'),
        );
        $this->notification_model->_update_where($data, 'member_id', $this->session->userdata('members_id'));
        
        $this->session->set_flashdata('confirmation', '<div style="margin:0 15px">    
                                                                <div class="alert alert-success">
                                                                    Your notifications have been updated.
                                                                </div>
                                                            </div>');
        redirect('preferences/notification');
    }
    
    function profile_views()
    {}
    
    function mailbox_messages()
    {}
    
    function mailbox_market()
    {}
    function mailbox_support()
    {}
}