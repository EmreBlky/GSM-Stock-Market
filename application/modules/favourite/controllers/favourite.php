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
    }

    function index()
    {
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
        
        $this->session->set_flashdata('message', 'That user has been added to your favourites');
        redirect('member/profile/'.$mid);
    }
    
    function remove($mid)
    {
        $this->favourite_model->_delete_where('member_id', $this->session->userdata('members_id'), 'favourite_id', $mid);
        
        $this->session->set_flashdata('message', 'That user has been removed from your favourites');
        redirect('member/profile/'.$mid);
    }
}