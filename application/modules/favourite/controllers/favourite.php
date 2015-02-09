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
    }
}