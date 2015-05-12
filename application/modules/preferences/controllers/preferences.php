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
        
        if ($this->session->userdata('terms') == 'no')
        { 
            redirect('legal/terms_conditions');
        }
        
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('membership/membership_model', 'membership_model');
        $this->load->model('transaction/transaction_model', 'transaction_model');
        $this->load->model('activity/activity_model', 'activity_model');
        $this->load->model('notification/notification_model', 'notification_model');
        
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
        $data_activity = array(
                                'activity' => 'Preference: Password',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
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
    
    function subscription($message = NULL)
    {
        $data_activity = array(
                                'activity' => 'Preference: Subscription',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
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
        
        if($message == 'confirm'){
            $data['trade_confirm'] = '<div style="margin:0 15px">    
                                                                <div class="alert alert-warning">
                                                                    <i class="fa fa-warning"></i> Please upgrade to <strong>Silver Membership</strong> before you can submit any references.
                                                                </div>
                                                            </div>';
        }
        else{
             $data['trade_confirm'] = '';
        }
        
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
    
    function notification()
    {
        $count = $this->notification_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($count < 1){
            $data = array(
                          'member_id' => $this->session->userdata('members_id')
            );
            $this->notification_model->_insert($data);
        }
        
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Notifications Page';        
        $data['page'] = 'notification'; 
        $data['notification'] = $this->notification_model->get_where_multiple('member_id', $this->session->userdata('members_id'));
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function trade_reference()
    {
        $this->load->module('reference');
        $this->reference->view();
        
    }
    
    function invitation()
    {
        $data['main'] = 'preferences';        
        $data['title'] = 'GSM - Invitations Page';        
        $data['page'] = 'invitation'; 
        //$data['notification'] = $this->notification_model->get_where_multiple('member_id', $this->session->userdata('members_id'));
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sendInvites()
    {
        //echo '<pre>';
        //print_r($_POST);
        $base = $this->config->item('base_url');
        $this->load->module('emails');
                
        $config = Array(
                  'protocol' => 'smtp',
                  'smtp_host' => 'ssl://server.gsmstockmarket.com',
                  'smtp_port' => 465,
                  'smtp_user' => 'noreply@gsmstockmarket.com',
                  'smtp_pass' => 'ehT56.l}iW]I2ba3f0',
                  'charset' => 'utf-8',
                  'wordwrap' => TRUE,
                  'newline' => "\r\n",
                  'crlf'    => ""

              );

        $this->load->library('email', $config);        
        $this->email->set_mailtype("html");
                  
        $invitor = $this->member_model->get_where($this->session->userdata('members_id'));
        
        //print_r($invitor);
        //exit;
        
        $invite_code = $this->company_model->get_where_multiple('admin_member_id', $this->session->userdata('members_id'))->invitation_code;
        
        $email_address = $this->input->post('email_address');
        $email_message = $this->input->post('email_message');
        
        $email = str_replace(' ', '', $email_address);
        $email = explode(',', $email);
        
        //print_r($email);
        $count = 0;
        
        while($count < count($email)){
            
            $email_body = ' 
                          Dear sir/ madam,
                          <br/>
                          <br/>
                          You have been invited to join '.$invitor->firstname.' '.$invitor->lastname.' ('.$this->company_model->get_where($invitor->company_id)->company_name.') at GSMStockmarket.com.'
                    . '   <br/>
                          <br/>
                          Message from Invitee: '.$this->input->post('email_message').'
                          <br/>
                          <br/>    
                          Please <a href="'.$base.'join/invites/'.$invite_code.'">CLICK HERE</a> to register your account with GSMStockmarket.com
                          <br/>
                          <br/>
                          ';
            $this->email->from($invitor->email, $invitor->firstname.' '.$invitor->lastname);
            //$list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
            $this->email->to($email[$count]);
            $this->email->subject('You have been invited to join GSM Stockmarket.com');
            $this->email->message($email_body);

            $this->email->send();
            
            //echo $email[$count].'<br/>';
            
        $count++;    
        }
        
    }
	
}
