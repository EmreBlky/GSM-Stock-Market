<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favourite extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        
        $this->load->model('favourite/favourite_model', 'favourite_model');
        $this->load->model('addressbook/addressbook_model', 'addressbook_model');
    }

    function index()
    {
        $this->load->model('activity/activity_model', 'activity_model');
        $data_activity = array(
                                'activity' => 'Favourite',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'favourite';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function add($mid)
    {
        $data = array(
                        'member_id'     => $this->session->userdata('members_id'),
                        'favourite_id'  => $mid
                    );
        $this->favourite_model->_insert($data);
        
        $fid = $this->addressbook_model->get_where_multiple('address_member_id', $mid, 'member_id', $this->session->userdata('members_id'))->id;
        
        
        if(is_numeric($fid)){
            
            $data_fav = array(                        
                        'favourite'  => 'yes'
                    );
            $this->addressbook_model->_update_where($data_fav, 'id', $fid);
            
        }
        
        $this->session->set_flashdata('message', 'That user has been added to your favourites');
        redirect('member/profile/'.$mid);
    }
    
    function remove($mid)
    {
        $this->favourite_model->_delete_where('member_id', $this->session->userdata('members_id'), 'favourite_id', $mid);
        
        $fid = $this->addressbook_model->get_where_multiple('address_member_id', $mid, 'member_id', $this->session->userdata('members_id'))->id;
        
        if(is_numeric($fid)){
            
            $data_fav = array(                        
                        'favourite'  => 'no'
                    );
            $this->addressbook_model->_update_where($data_fav, 'id', $fid);
            
        }
        
        $this->session->set_flashdata('message', 'That user has been removed from your favourites');
        redirect('member/profile/'.$mid);
    }
}