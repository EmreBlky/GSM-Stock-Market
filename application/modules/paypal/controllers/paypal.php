<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('paypal/paypal_model', 'paypal_model');
    }
	
	
    function index()
    {
        $this->load->view('');
    }
    
    function purchase()
    {
        $base = $this->config->item('base_url');
        $config['business']             = 'info@gsmstockmarket.com';
        $config['cpp_header_image']     = ''; //Image header url [750 pixels wide by 90 pixels high]
        $config['return']               = $base .'paypal/notify_payment';
        $config['cancel_return']        = $base .'paypal/cancel_return';
        $config['notify_url']           = $base .'paypal/process'; //IPN Post
        $config['production']           = FALSE; //Its false by default and will use sandbox
        //$config['discount_rate_cart']   = 20; //This means 20% discount
        $config["invoice"]              = 'INV9'; //The invoice id

        $this->load->library('paypal_lib',$config);

        #$this->paypal->add(<name>,<price>,<quantity>[Default 1],<code>[Optional]);

        $this->paypal_lib->add('GSM Credit Top Up', 5, 1); //First item
        //$this->paypal_lib->add('Pants', 40, 3); 	  //Second item
        //$this->paypal_lib->add('Blowse',10,10,'B-199-26'); //Third item with code

        $this->paypal_lib->pay(); //Proccess the payment
    }
    
    function notify_payment()
    {
        $info = print_r($this->input->post(), TRUE);
        
        echo '<pre>';
        echo $info;
        echo '</pre>';
        
        $data = array(
                    'invoice' => $this->input->post('invoice'),
                    'payment_status' => $this->input->post('payment_status')
                    );
        $this->paypal_model->_insert($data);
    }
    
    function cancel_return()
    {
        //echo '<pre>';
        //print_r($this->input->post(), TRUE);
        $data = array(
                    'invoice' => $this->input->post('invoice'),
                    'payment_status' => $this->input->post('payment_status')
                    );
        $this->paypal_model->_insert($data);
    }
    
    function process()
    {
        $pid = $this->paypal_model->get_where_multiple('invoice', $this->input->post('invoice'))->id;
        
        $data = array(                    
                    'payment_status' => $this->input->post('payment_status')
                    );
        $this->paypal_model->_update($pid, $data);
    }
	
}
