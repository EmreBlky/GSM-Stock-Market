<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        //$this->load->helper('security');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('country/country_model', 'country_model');
        $this->load->model('viewed/viewed_model', 'viewed_model');
        $this->load->model('block/block_model', 'block_model');
    }

    function index()
    {
        if($this->session->userdata('members_id') != 5){
            redirect('home/');
        }
        $data['main'] = 'member';        
        $data['title'] = 'GSM - Home';        
        $data['page'] = 'index';
        $data['list_member'] = $this->member_model->get_all();

        $this->load->module('templates');
        $this->templates->page($data);        
    }
    function profile($pid)
    {
//        if ($this->session->userdata('membership') < 2)
//        {
//            redirect('home');
//        }
        
        $viewing_profile = $this->session->userdata('members_id');
        if($viewing_profile != 5){
            //$this->viewed_model->_delete_where('viewed_id' ,$pid, 'viewer_id', $this->session->userdata('members_id'));

            $data = array(
                        'viewed_id' => $pid,
                        'viewer_id' => $this->session->userdata('members_id'),
                        'time' => date('H:i:s'),
                        'date' => date('d-m-Y'),
                        'datetime' => date('d-m-Y H:i:s'),
                        'record_date' => date('Y-m-d H:i:s')
                        );

            $this->viewed_model->_insert($data);
        }

        $cid = $this->member_model->get_where_multiple('id', $pid)->company_id;
        $data['company_users'] = $this->member_model->get_where_multiples('company_id', $cid);
        $data['base'] = $this->config->item('base_url');
        $data['main'] = 'member';
        $data['title'] = 'GSM - Members Page';
        $data['page'] = 'profile';
        $data['member_info'] = $this->member_model->get_where($pid);
        $data['member_company'] = $this->company_model->get_where($this->member_model->get_where($pid)->company_id);
        $data['pid'] = $pid;
        $data['blocked'] = $this->block_model->get_where_multiples('member_id', $this->session->userdata('members_id'), 'block_member_id', $pid);

                /* Daniel Added Start */
        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
                /* Daniel Added End */
        // naveed
        $this->load->model('marketplace/marketplace_model');
        $data['sellingOffers'] = $this->marketplace_model->listing_sell($pid);
        $data['buyingRequests'] = $this->marketplace_model->listing_buy($pid);

        $this->load->module('templates');
        $this->templates->page($data);
        
    }
    
    function email_activation()
    {
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
        
        $lists = $this->member_model->get_where_multiples('validated', 'no');
        
        foreach ($lists as $list){
            
            $fname = $list->firstname;//Customer's First Name
            $lname = $list->lastname;//Customer's Surname
            $company = $this->company_model->get_where($this->member_model->get_where($list->id)->company_id)->company_name;// Customer's Company
            
            
            $email_body = 'Dear '.$fname.' '.$lname.' ('.$company.')';

            $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket Support');

            //$list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
            $this->email->to($list->email);
            $this->email->subject('You have a message in your inbox');
            $this->email->message($email_body);

            $this->email->send();
        }
    }
    
    function email_profile()
    {
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
        
        $lists = $this->member_model->_custom_query("SELECT * FROM members WHERE profile_completion < 100");
        
        foreach ($lists as $list){
            
            $fname = $list->firstname;//Customer's First Name
            $lname = $list->lastname;//Customer's Surname
            $company = $this->company_model->get_where($this->member_model->get_where($list->id)->company_id)->company_name;// Customer's Company
            
            
            $email_body = 'Dear '.$fname.' '.$lname.' ('.$company.')';

            $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket Support');

            //$list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
            $this->email->to($list->email);
            $this->email->subject('You have a message in your inbox');
            $this->email->message($email_body);

            $this->email->send();
            
        }
    }
    
}
