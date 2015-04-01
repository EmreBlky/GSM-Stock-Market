<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
    }

    function index()
    {
        $data['main'] = 'transaction';
	$data['title'] = 'Transaction';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function invoice()
    {
        $data['main'] = 'transaction';
	$data['title'] = 'Transaction: Invoice';
        $data['page'] = 'invoice';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice_print()
    {
        $this->load->view('invoice-print');
    }
}