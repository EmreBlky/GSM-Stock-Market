<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addressbook extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('addressbook/addressbook_model', 'addressbook_model');
    }

    function index($page = NULL, $off = NULL)
    {
        $this->load->library('pagination');
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            $data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'), NULL, NULL, 21, $offset);
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 3;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="row" style="margin:0 0 25px 0"><div class="btn-group pull-right">';
            $config['full_tag_close'] = '</div></div>';
            $config['next_tag_open'] = '<div class="btn btn-white">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = ' <div class="btn btn-white">';
            $config['prev_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<div class="btn btn-white  active">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<div class="btn btn-white">';                
            $config['num_tag_close'] = '</div>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        }
        else{
            $data['addressbook_count'] = 0;
        }
        
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function page($off = NULL)
    {
        $this->load->library('pagination');
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            $data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'), NULL, NULL, 21, $offset);
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 3;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="row" style="margin:0 0 25px 0"><div class="btn-group pull-right">';
            $config['full_tag_close'] = '</div></div>';
            $config['next_tag_open'] = '<div class="btn btn-white">';
            $config['next_tag_close'] = '</div>';
            $config['prev_tag_open'] = ' <div class="btn btn-white">';
            $config['prev_tag_close'] = '</div>';
            $config['cur_tag_open'] = '<div class="btn btn-white  active">';
            $config['cur_tag_close'] = '</div>';
            $config['num_tag_open'] = '<div class="btn btn-white">';                
            $config['num_tag_close'] = '</div>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        }
        else{
            $data['addressbook_count'] = 0;
        }
        
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function individual()
    {
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Individuals';        
        $data['page'] = 'individuals';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function company()
    {
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Company';        
        $data['page'] = 'companies';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function favourite()
    {
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Favourites';        
        $data['page'] = 'favourites';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function add($mid, $type)
    {
        $data = array(
                        'member_id'             => $this->session->userdata('members_id'),
                        'address_member_id'     => $mid,
                        'type'                  => $type,
                        'favourite'             => '',
                        'business_activities'   => '',
                        'country'               => ''
                    );
        $this->addressbook_model->_insert($data);
        
        //$this->session->set_flashdata('message', 'That user has been added to your Address Book');
        redirect('member/profile/'.$mid);
    }
    
    function remove($mid)
    {
        $this->addressbook_model->_delete_where('member_id', $this->session->userdata('members_id'), 'address_member_id', $mid);
        
        //$this->session->set_flashdata('message', 'That user has been removed from your Address Book');
        redirect('member/profile/'.$mid);
    }
	
}