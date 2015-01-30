<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailbox extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
    }

    function index()
    {
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Mailbox';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function inbox($from = NULL, $mid = NULL)
    {
        
        $data['main'] = 'mailbox';
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'inbox';        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        $data['from'] = $from;
        
        
        if($from == 'member'){

            $data['header'] = 'From Member';
            
            $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', 'mail_read', 'no');
                        
            if($count > 0){            
                $data['inbox_count'] = $count;
                $data['inbox_member'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes');      
            }
            else{            
                $data['inbox_count'] = 0;
            }
            
        }
        elseif($from == 'market'){

            $data['header'] = 'From Marketplace';
            
            $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', 'mail_read', 'no');
            
            if($count > 0){            
                $data['inbox_count'] = $count;
                $data['inbox_market'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes');        
            }
            else{            
                $data['inbox_count'] = 0;
            }
            
        }
        elseif($from == 'support'){

            $data['header'] = 'From Support Team';
            
            $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes', 'mail_read', 'no');
            
            if($count > 0){            
                $data['inbox_count'] = $count;
                $data['inbox_support'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id',$this->session->userdata('members_id'), 'sent_from', $from, 'inbox', 'yes');
            }
            else{            
                $data['inbox_count'] = 0;
            }

        }else{

            $data['header'] = 'Inbox';
            
            $count = $this->mailbox_model->count_where('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes', 'mail_read', 'no');
            
            if($count > 0){            
                $data['inbox_count'] = $count;
                $data['inbox_all'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes');
            }
            else{            
                $data['inbox_count'] = 0;
            }

        }
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function reply($mid)
    {        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Reply Mail';        
        $data['page'] = 'reply';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sent($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'sent';
        
        $count = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'sent', 'yes');
        
        if($count > 0){            
            $data['inbox_count'] = $count;
            $data['inbox_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'member_id',$this->session->userdata('members_id'), 'sent', 'yes');
        }
        else{            
            $data['inbox_count'] = 0;
        }
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function mark_read($from, $mid)
    {
        $data = array(
                        'mail_read'     => 'yes'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->mailbox_model->_update($mid, $data);
        
        if($from == 'archive'){
            redirect('mailbox/'.$from);
        }else{        
            redirect('mailbox/inbox/'.$from);
        }
    }
    
    function mark_unread($from, $mid)
    {
        $data = array(
                        'mail_read'     => 'no'
                      );
        
        $this->mailbox_model->_update($mid, $data);
        
        if($from == 'archive'){
            redirect('mailbox/'.$from);
        }else{        
            redirect('mailbox/inbox/'.$from);
        }
    }
    
    function important($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'important';
        
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'important', 'yes');
        
        if($count > 0){            
            $data['inbox_count'] = $count;
             $data['inbox_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id',$this->session->userdata('members_id'), 'important', 'yes');
        }
        else{            
            $data['inbox_count'] = 0;
        }
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function important_move($mid)
    {
        $data = array(
                        'trash'     => 'no',
                        'important' => 'yes',
                        'draft'     => 'no'
                      );
        
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/important');
    }
    
    function draft($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'draft';
        
        $count = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes', 'sent', 'no');
        
        if($count > 0){            
            $data['inbox_count'] = $count;
            $data['inbox_draft'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'member_id',$this->session->userdata('members_id'), 'draft', 'yes', 'sent', 'no');
        }
        else{            
            $data['inbox_count'] = 0;
        }
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function daft_move($mid)
    {
        $data = array(
                        'trash'     => 'no',
                        'sent'      => 'no',
                        'important' => 'no',
                        'draft'     => 'yes'
                      );
        
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/draft');
    }
    
    function trash($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Inbox';        
        $data['page'] = 'trash';
        
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'trash', 'yes');
        
        if($count > 0){            
            $data['inbox_count'] = $count;
            $data['inbox_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id',$this->session->userdata('members_id'), 'trash', 'yes');        }
        else{            
            $data['inbox_count'] = 0;
        }
        
        
        
        $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function trash_move($mid)
    {
        $data = array(
                        'trash'     => 'yes',
                        'sent'      => 'no',
                        'important' => 'no',
                        'draft'     => 'no'
                      );

        
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/trash');
    }
    
    function delete($mid)
    {
        $data = array(
                        'deleted'     => 'yes'
                      );

        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->mailbox_model->_update($mid, $data);
        
        $this->mailbox_model->_delete_where('deleted', 'yes');
        
        redirect('mailbox/trash');
    }
    
    function side_mail()
    { 
        $data['inbox'] = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'mail_read', 'no', 'inbox', 'yes');
        $data['member'] = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', 'member', 'mail_read', 'no', 'inbox', 'yes');
        $data['market'] = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', 'market', 'mail_read', 'no', 'inbox', 'yes');
        $data['support'] = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'sent_from', 'support', 'mail_read', 'no', 'inbox', 'yes');        
        $data['draft'] = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes', 'inbox', 'yes');
        $this->load->view('side-mail', $data);
    }
            
    function compose($mid = NULL)
    {
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Compose Mail';        
        $data['page'] = 'compose';
        
        if($mid != NULL){
            $data['draft'] = $mid;
        }
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function composeMail()
    {
        //echo '<pre>';
        //print_r($_POST);
        //exit;
        
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('email_address', 'Email Address', 'xss_clean');
        $this->form_validation->set_rules('subject', 'Subject', 'xss_clean');
        $this->form_validation->set_rules('body', 'Message Body', 'xss_clean');
        
        $submit = $this->input->post('submit');
        $mail_type = $this->input->post('mail_type');
//        
        if($submit == 'Send'){
            
            if($this->form_validation->run()){
                
                $this->load->model('member/member_model', 'member_model');
                $sid = $this->member_model->get_where_multiple('email', $this->input->post('email_address'))->id;
                
                if($mail_type == 'draft'){

                    $data = array(
                                    'member_id'         => $this->session->userdata('members_id'),
                                    'sent_member_id'    => $sid,
                                    'subject'           => $this->input->post('subject'),
                                    'body'              => nl2br($this->input->post('body')),
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'draft'             => 'no',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'member',
                                    'parent_id'         => $this->input->post('parent_id'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );                    
                    $this->mailbox_model->_update($this->input->post('mail_id'), $data);
                }
                else{

                    $data = array(
                                    'member_id'         => $this->session->userdata('members_id'),
                                    'sent_member_id'    => $sid,
                                    'subject'           => $this->input->post('subject'),
                                    'body'              => nl2br($this->input->post('body')),
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'member',
                                    'parent_id'         => $this->input->post('parent_id'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );                    
                    $this->mailbox_model->_insert($data);
                }
            }            
            
            redirect('mailbox/inbox/all', 'refresh');
            
        }
        elseif($submit == 'Draft'){
            
            if($this->form_validation->run()){
                
                $this->load->model('member/member_model', 'member_model');
                $sid = $this->member_model->get_where_multiple('email', $this->input->post('email_address'))->id;

                $data = array(
                                'member_id'         => $this->session->userdata('members_id'),
                                'sent_member_id'    => $sid,
                                'subject'           => $this->input->post('subject'),
                                'body'              => nl2br($this->input->post('body')),
                                'draft'              => 'yes',
                                'date'              => date('d-m-Y'),
                                'time'              => date('H:i'),
                                'sent_from'         => 'member',
                                'parent_id'         => $this->input->post('parent_id'),
                                'datetime'          => date('Y-m-d H:i:s')
                              );

                $this->load->model('mailbox/mailbox_model', 'mailbox_model');
                $this->mailbox_model->_insert($data);
            }
            
            redirect('mailbox/inbox/all', 'refresh');
        }
        elseif($submit == 'Discard'){
            
            redirect('mailbox/inbox/all', 'refresh');
        }
//       
            
        
    }
            
    function archive($mid = NULL)
    {
        
        $data['main'] = 'mailbox';        
        $data['title'] = 'GSM - Archive Mail';        
        $data['page'] = 'archive';
        
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'archive', 'yes');
        
        if($count > 0){            
            $data['inbox_count'] = $count;
            $data['inbox_message'] = $this->mailbox_model->get_where_multiples_order('datetime', 'DESC', 'sent_member_id', $this->session->userdata('members_id'), 'archive', 'yes');
        }
        else{            
            $data['inbox_count'] = 0;
        }        
        
       $data['message'] = $this->mailbox_model->get_where_multiple('id', $mid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function archive_move($mid)
    {
        $data = array(
                        'archive'     => 'yes'
                      );
        
        $this->mailbox_model->_update($mid, $data);
        
        redirect('mailbox/archive');
    }
    
    function mass_process()
    {
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        $submit = $this->input->post('button');
        
        if($submit == 'read'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'mail_read'     => 'yes'
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
            }
        }
        elseif($submit == 'unread'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'mail_read'     => 'no'
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
            }
            
        }
        
        elseif($submit == 'important'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'important'     => 'yes',
                        'sent_from'     => 'moved',                        
                        'inbox'         => 'no'
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
            }
            
        }
        elseif($submit == 'archive'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'archive'     => 'yes',
                        'sent_from'     => 'moved',                        
                        'inbox'         => 'no'
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
            }
            
        }
        elseif($submit == 'trash'){
            
            foreach($_POST as $post_vale => $post_key){
                
                $data = array(
                        'trash'     => 'yes',
                        'sent_from' => 'moved',
                        'inbox'     => 'no'
                      );
        
                $this->mailbox_model->_update($post_vale, $data);
            }
        }
        
        redirect('mailbox/inbox');
    }
    
    function mail_dropdown($mail_count){
        
        $data['base'] = $this->config->item('base_url');
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes', 'mail_read', 'no');
        
        if($count > 0){            
            //$data['inbox_count'] = $count;
            $data['inbox_message'] = $this->mailbox_model->_custom_query("SELECT * FROM mailbox WHERE mail_read = 'no' AND sent_member_id = '".$this->session->userdata('members_id')."' AND inbox = 'yes' ORDER BY datetime ASC LIMIT ".$mail_count."");
        }
        else{
            $data['inbox_message'] = '';
        }
        $this->load->view('dropdown', $data);
    }
    
    function mail_recent($mail_count){
        
        $data['base'] = $this->config->item('base_url');
        
        $draft_count = $this->mailbox_model->count_where_multiple('member_id',$this->session->userdata('members_id'), 'draft', 'yes');
        
        if($draft_count > 0){
            
            $data['d_count'] = $draft_count;
            
        }
        else{
            $data['d_count'] = 0;
        }
        
        $new_count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes', 'mail_read', 'no');
        
        if($new_count > 0){
            
            $data['n_count'] = $new_count;
            
        }
        else{
            $data['n_count'] = 0;
        }
        
        $count = $this->mailbox_model->count_where_multiple('sent_member_id',$this->session->userdata('members_id'), 'inbox', 'yes');
        
        if($count > 0){            
            $data['inbox_count'] = $count;
            $data['inbox_recent'] = $this->mailbox_model->_custom_query("SELECT * FROM mailbox WHERE sent_member_id = '".$this->session->userdata('members_id')."' AND inbox = 'yes' ORDER BY datetime DESC LIMIT ".$mail_count."");
        }
        $this->load->view('recent', $data);
    }
    
    function refresh()
    {
         redirect($_SERVER['HTTP_REFERER'], 'refresh');  
    }
	
}