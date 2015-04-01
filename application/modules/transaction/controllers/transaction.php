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
        $this->load->model('activity/activity_model', 'activity_model');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('membership/membership_model', 'membership_model');
        $this->load->model('transaction/transaction_model', 'transaction_model');
        
    }

    function index()
    {
        $data_activity = array(
                                'activity' => 'Transactions',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'transaction';
	$data['title'] = 'Transaction';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function banktransfer_gbp($invoice, $product)
    {
        if($product == 'platinum'){
           $description = "GSMStockmarket - Platinum Membership Fee";
           $amount = 5000;
           $quantity = 1;
        }
//        elseif($product == 'gold'){
//            $description = "GSMStockmarket - Gold Membership Fee";
//        }
        elseif($product == 'silver'){
            $description = "GSMStockmarket - Silver Membership Fee";
            $amount = 1295;
            $quantity = 1;
        }
        
        $data_trans = array(
                            'invoice' => $invoice,
                            'item' => $description,
                            'date' => date('Y-m-d H:i:s'),
                            'buyer_id' => $this->session->userdata('members_id'),
                            'seller_id' => '',
                            'amount' => $amount,
                            'tax_vat' => '',
                            'currency' => 'GBP',
                            'quantity' => $quantity,
                            'item_description' => ''
                            );
        $this->transaction_model->_insert($data_trans);
    }
    
    function invoice()
    {
        $data_activity = array(
                                'activity' => 'Transactions: Invoice',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'transaction';
	$data['title'] = 'Transaction: Invoice';
        $data['page'] = 'invoice';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice_print()
    {
        $data_activity = array(
                                'activity' => 'Transactions: Invoice Print',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $this->load->view('invoice-print');
    }
}