<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Block extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('block/block_model', 'block_model');
    }

    function index()
    {
        $data['main'] = 'block';
	$data['title'] = 'GSM - Member Block';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function customerBlock($mid, $bid)
    {
        $data = array(
                    'member_id' => $mid,
                    'block_member_id' => $bid
                );
        $this->block_model->_insert($data);
    }
    
    function customerUnblock($mid, $bid)
    {
        $this->block_model->_delete_where('member_id', $mid, 'block_member_id', $bid);
    }
}