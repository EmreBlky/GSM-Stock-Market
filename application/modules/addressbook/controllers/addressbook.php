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

    function index()
    {
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            $data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'));
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
        
        $this->session->set_flashdata('message', 'That user has been added to your Address Book');
        redirect('member/profile/'.$mid);
    }
    
    function remove($mid)
    {
        $this->favourite_model->_delete_where('member_id', $this->session->userdata('members_id'), 'address_member_id', $mid);
        
        $this->session->set_flashdata('message', 'That user has been removed from your favourites');
        redirect('member/profile/'.$mid);
    }
	
}