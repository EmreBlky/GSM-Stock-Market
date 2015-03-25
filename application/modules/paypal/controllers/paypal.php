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
    
    function completed()
    {
        $this->load->view('completed');
    }
    
    function pending()
    {
        $this->load->view('pending');
    }
        
    function purchase($invoice = NULL, $product = NULL, $amount = NULL)
    {
        $base                           = $this->config->item('base_url');
        $config['business']             = 'info@gsmstockmarket.com';
        $config['cpp_header_image']     = $base .'public/main/template/gsm/images/paypal_gsm.png'; //Image header url [750 pixels wide by 90 pixels high]
        $config["cmd"] 			= '_cart'; //Do not modify
        $config['return']               = $base .'paypal/notify_payment';
        $config['cancel_return']        = $base .'paypal/cancel_return';
        $config['notify_url']           = $base .'paypal/process'; //IPN Post
        $config['production']           = FALSE; //Its false by default and will use sandbox
        //$config['discount_rate_cart']   = 20; //This means 20% discount
        $config["invoice"]              = $invoice; //The invoice id

        $this->load->library('paypal_lib',$config);

        #$this->paypal->add(<name>,<price>,<quantity>[Default 1],<code>[Optional]);

        $this->paypal_lib->add('GSM Credit Top Up', 5, 1); //First item
        //$this->paypal_lib->add('Pants', 40, 3); 	  //Second item
        //$this->paypal_lib->add('Blowse',10,10,'B-199-26'); //Third item with code

        $this->paypal_lib->pay(); //Proccess the payment
    }
    
    function subscribe()
    {
        $this->load->library('paypal_subscribe');
        $base = $this->config->item('base_url');
        
        $paymentAmount = 10;
        $currencyCodeType = "USD";
        $paymentType = "Sale";
        #$paymentType = "Authorization";
        #$paymentType = "Order";
        $returnURL = $base .'paypal/notify_payment';
        $cancelURL = $base .'paypal/cancel_return';
        $resArray = $this->paypal_subscribe->CallShortcutExpressCheckout($paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);

        $ack = strtoupper($resArray["ACK"]);
        
        if($ack=="SUCCESS" || $ack=="SUCCESSWITHWARNING")
        {
                $this->paypal_subscribe->RedirectToPayPal ( $resArray["TOKEN"] );
        } 
        else  
        {
                //Display a user friendly Error on the page using any of the following error information returned by PayPal
                $ErrorCode = urldecode($resArray["L_ERRORCODE0"]);
                $ErrorShortMsg = urldecode($resArray["L_SHORTMESSAGE0"]);
                $ErrorLongMsg = urldecode($resArray["L_LONGMESSAGE0"]);
                $ErrorSeverityCode = urldecode($resArray["L_SEVERITYCODE0"]);

                echo "SetExpressCheckout API call failed. ";
                echo "Detailed Error Message: " . $ErrorLongMsg;
                echo "Short Error Message: " . $ErrorShortMsg;
                echo "Error Code: " . $ErrorCode;
                echo "Error Severity Code: " . $ErrorSeverityCode;
        }
    }
    
    function notify_payment()
    {
//        $info = print_r($this->input->post(), TRUE);
//        
//        echo '<pre>';
//        echo $info;
//        echo '</pre>';
        $data = array(
                    'mc_gross' => $this->input->post('mc_gross'),
                    'invoice' => $this->input->post('invoice'),
                    'protection_eligibility' => $this->input->post('protection_eligibility'),
                    'address_status' => $this->input->post('address_status'),
                    'item_name1' => $this->input->post('item_name1'),
                    'mc_gross_1' => $this->input->post('mc_gross_1'),
                    'payer_id' => $this->input->post('payer_id'),
                    'tax' => $this->input->post('tax'),
                    'address_name' => $this->input->post('address_name'),
                    'address_street' => $this->input->post('address_street'),
                    'address_city' => $this->input->post('address_city'),
                    'address_state' => $this->input->post('address_state'),
                    'address_country' => $this->input->post('address_country'),
                    'address_zip' => $this->input->post('address_zip'),
                    'address_country_code' => $this->input->post('address_country_code'),
                    'payment_date' => $this->input->post('payment_date'),
                    'payer_status' => $this->input->post('payer_status'),
                    'verify_sign' => $this->input->post('verify_sign'),
                    'payment_status' => $this->input->post('payment_status')
                    );
        $this->paypal_model->_insert($data);
        
        $status = $this->input->post('payment_status');
        
        if($status == 'Completed'){
            
            redirect('paypal/completed');
            
        }
        elseif($status == 'Pending'){
            
            redirect('paypal/pending');
            
        }
        
        
    }
    
    function cancel_return()
    {
        $this->load->view('cancel-return');
    }
    
    function process()
    {
        $pid = $this->paypal_model->get_where_multiple('invoice', $this->input->post('invoice'))->id;
        
        $data = array(                    
                    'payment_status' => $this->input->post('payment_status')
                    );
        $this->paypal_model->_update($pid, $data);
        
        $status = $this->input->post('payment_status');
        
        if($status == 'Completed'){
            
        }
        elseif($status == 'Refunded'){
            
        }
    }
	
}
