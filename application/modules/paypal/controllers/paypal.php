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
        $config["invoice"]              = 'INV2001'; //The invoice id

        $this->load->library('paypal_lib',$config);

        #$this->paypal->add(<name>,<price>,<quantity>[Default 1],<code>[Optional]);

        $this->paypal_lib->add('T-shirt', 2.99, 6); //First item
        $this->paypal_lib->add('Pants', 40, 3); 	  //Second item
        //$this->paypal_lib->add('Blowse',10,10,'B-199-26'); //Third item with code

        $this->paypal_lib->pay(); //Proccess the payment
    }
    
    function notify_payment()
    {
        $data = print_r($this->input->post(), TRUE);
        
        echo '<pre>';
        echo $data;
        echo '</pre>';
    }
    
    function cancel_return()
    {
        echo '<pre>';
        print_r($this->input->post(), TRUE);
    }
    
    function process()
    {
        $data = array(
                    'test' => $this->input->post()
                );
        $this->paypal_model->_insert($data);
    }
	
}
