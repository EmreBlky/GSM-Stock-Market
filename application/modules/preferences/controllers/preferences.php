<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Preferences extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        $this->load->model('activity/activity_model', 'activity_model');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('membership/membership_model', 'membership_model');
        $this->load->model('transaction/transaction_model', 'transaction_model');
        $data_activity = array(
                                'activity' => 'Preferences',
                                'time' => date('H:i:s')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
    }

    function index()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Preferences';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function password()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Change Password';        
        $data['page'] = 'password';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function passwordUpdate()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Change Password';        
        $data['page'] = 'password';
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('old_password', 'Old Password', 'xss_clean');
        $this->form_validation->set_rules('new_password', 'New Password', 'xss_clean');
        $this->form_validation->set_rules('confirm', 'Confirm', 'xss_clean');      
        
        $current = $this->member_model->get_where($this->session->userdata('members_id'))->password;
        $old = $this->input->post('old_password');
        $new = $this->input->post('new_password');
        $confirm = $this->input->post('confirm');
        
        if(md5($old) == $current){            
            
            if($new == $confirm){
                
                if($this->form_validation->run()){
                    
                    $data = array(
                        'password' => md5($confirm)
                    );
                    $this->member_model->_update($this->session->userdata('members_id'), $data);
                    
                    $this->session->set_flashdata('title', 'Password Success');
                    $this->session->set_flashdata('message', 'Your password has been successfully updated.');
                    redirect('preferences/password');
                }
            }
            else{
                $this->session->set_flashdata('title', 'Password Error');
                $this->session->set_flashdata('message', 'Password does not match. Please try again.');
                redirect('preferences/password');                
            }
            
        }
        else{
            $this->session->set_flashdata('title', 'Password Error');
            $this->session->set_flashdata('message', 'Current Password does not match. Please try again.');
            redirect('preferences/password');
        }
        
    }
    
    function newsletter()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Newsletter';        
        $data['page'] = 'newsletter';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function subscription()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Manage Subscription';        
        $data['page'] = 'subscription';
        
        $count = $this->transaction_model->_custom_query_count("SELECT COUNT(*) AS count FROM transaction WHERE buyer_id = '".$this->session->userdata('members_id')."'");
        
        if($count[0]->count > 0){
            $data['trans_count'] = $count[0]->count;
            $data['transaction'] = $this->transaction_model->get_where_multiples('buyer_id', $this->session->userdata('members_id'));
        }
        else{
            $data['trans_count'] = 0;
        }
        
        
        $data['base'] = $this->config->item('base_url');
        $inv = $this->member_model->get_where($this->session->userdata('members_id'))->invoice_number;
        $data['invoice'] = 'GSM-'.$this->session->userdata('members_id').'-'.$inv;
        $this->member_model->_custom_query_action("UPDATE members SET invoice_number = (invoice_number+1) WHERE id = '".$this->session->userdata('members_id')."'");
        
        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
        
        $this->load->module('templates');
        $this->templates->page($data);
    }    
    
    function notice()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Manage Subscription: Notice';        
        $data['page'] = 'notice';        
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
	
}