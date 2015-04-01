<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('paypal/paypal_model', 'paypal_model');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('transaction/transaction_model', 'transaction_model');
        $this->load->library('paypal_subscribe');
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
        
    function purchase($invoice = NULL, $product = NULL)
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
        
        $base                           = $this->config->item('base_url');
        $config['business']             = 'info@gsmstockmarket.com';
        $config['cpp_header_image']     = $base .'public/main/template/gsm/images/paypal_gsm.png'; //Image header url [750 pixels wide by 90 pixels high]
        $config["cmd"] 			= '_cart'; //Do not modify
        $config['return']               = $base .'paypal/notify_payment';
        $config['cancel_return']        = $base .'paypal/cancel_return';
        $config['notify_url']           = $base .'paypal/process'; //IPN Post
        $config['production']           = TRUE; //Its false by default and will use sandbox
        //$config['discount_rate_cart']   = 20; //This means 20% discount
        $config["invoice"]              = $invoice; //The invoice id
        
        #$this->paypal->add(<name>,<price>,<quantity>[Default 1],<code>[Optional]);
        $this->load->library('paypal_lib',$config);
        $this->paypal_lib->add($description, $amount, $quantity); //First item
        //$this->paypal_lib->add('Pants', 40, 3); 	  //Second item
        //$this->paypal_lib->add('Blowse',10,10,'B-199-26'); //Third item with code

        $this->paypal_lib->pay(); //Proccess the payment
    }
    
    function subscribe($type, $amount)
    {        
        $base = $this->config->item('base_url');
        
        $paymentAmount = $amount;
        $currencyCodeType = "GBP";
        $paymentType = "Sale";
        #$paymentType = "Authorization";
        #$paymentType = "Order";
        $returnURL = $base .'paypal/review_payment';
        $cancelURL = $base .'paypal/cancel_return';
        $resArray = $this->paypal_subscribe->CallShortcutExpressCheckout($type, $paymentAmount, $currencyCodeType, $paymentType, $returnURL, $cancelURL);

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
        $base                           = $this->config->item('base_url');
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
            
            $data_trans = array(
                                'status' => 'completed'
                                );
            
            $this->transaction_model->_update_where($data_trans, 'invoice', $this->input->post('invoice'));
            
            $trans_type = $this->transaction_model->get_where_multiple('invoice', $this->input->post('invoice'))->item;
            $trans_id = $this->transaction_model->get_where_multiple('invoice', $this->input->post('invoice'))->buyer_id;
            
            if($trans_type == 'GSMStockmarket - Silver Membership Fee'){
                
                $data_member = array(
                                'membership' => 2
                                );
            
                $this->member_model->_update_where($data_member, 'id', $trans_id);
                
                $this->session->set_userdata('membership', 2);
                
                $this->load->module('emails');
                $config = Array(
                                'protocol' => 'smtp',
                                'smtp_host' => 'ssl://server.gsmstockmarket.com',
                                'smtp_port' => 465,
                                'smtp_user' => 'noreply@gsmstockmarket.com',
                                'smtp_pass' => 'ehT56.l}iW]I2ba3f0',
                                'charset' => 'utf-8',
                                'wordwrap' => TRUE,
                                'newline' => "\r\n",
                                'crlf'    => ""

                            );
                
                $this->load->library('email', $config);
                //$this->load->library('email');
                //$this->email->newline = "\r\n";
                //$this->email->crlf = "\r\n";
                $this->email->set_mailtype("html");
                $email_body = '
                                <style>
                                        /* -------------------------------------
                                        GLOBAL
                                        A very basic CSS reset
                                  ------------------------------------- */
                                  * {
                                        margin: 0;
                                        padding: 0;
                                        font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
                                        box-sizing: border-box;
                                        font-size: 14px;
                                  }

                                  img {
                                        max-width: 100%;
                                  }

                                  body {
                                        -webkit-font-smoothing: antialiased;
                                        -webkit-text-size-adjust: none;
                                        width: 100% !important;
                                        height: 100%;
                                        line-height: 1.6;
                                  }

                                  table td {
                                        vertical-align: top;
                                  }

                                  /* -------------------------------------
                                        BODY & CONTAINER
                                  ------------------------------------- */
                                  body {
                                        background-color: #f6f6f6;
                                  }

                                  .body-wrap {
                                        background-color: #f6f6f6;
                                        width: 100%;
                                  }

                                  .container {
                                        display: block !important;
                                        max-width: 600px !important;
                                        margin: 0 auto !important;
                                        /* makes it centered */
                                        clear: both !important;
                                  }

                                  .content {
                                        max-width: 600px;
                                        margin: 0 auto;
                                        display: block;
                                        padding: 20px;
                                  }

                                  /* -------------------------------------
                                        HEADER, FOOTER, MAIN
                                  ------------------------------------- */
                                  .main {
                                        background: #fff;
                                        border: 1px solid #e9e9e9;
                                        border-radius: 3px;
                                  }

                                  .content-wrap {
                                        padding: 20px;
                                  }

                                  .content-block {
                                        padding: 0 0 20px;
                                  }

                                  .header {
                                        width: 100%;
                                        margin-bottom: 20px;
                                  }

                                  .footer {
                                        width: 100%;
                                        clear: both;
                                        color: #999;
                                        padding: 20px;
                                  }
                                  .footer a {
                                        color: #999;
                                  }
                                  .footer p, .footer a, .footer unsubscribe, .footer td {
                                        font-size: 12px;
                                  }

                                  /* -------------------------------------
                                        TYPOGRAPHY
                                  ------------------------------------- */
                                  h1, h2, h3 {
                                        font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
                                        color: #000;
                                        margin: 40px 0 0;
                                        line-height: 1.2;
                                        font-weight: 400;
                                  }

                                  h1 {
                                        font-size: 32px;
                                        font-weight: 500;
                                  }

                                  h2 {
                                        font-size: 24px;
                                  }

                                  h3 {
                                        font-size: 18px;
                                  }

                                  h4 {
                                        font-size: 14px;
                                        font-weight: 600;
                                  }

                                  p, ul, ol {
                                        margin-bottom: 10px;
                                        font-weight: normal;
                                  }
                                  p li, ul li, ol li {
                                        margin-left: 5px;
                                        list-style-position: inside;
                                  }

                                  /* -------------------------------------
                                        LINKS & BUTTONS
                                  ------------------------------------- */
                                  a {
                                        color: #1ab394;
                                        text-decoration: underline;
                                  }

                                  .btn-primary {
                                        text-decoration: none;
                                        color: #FFF;
                                        background-color: #1ab394;
                                        border: solid #1ab394;
                                        border-width: 5px 10px;
                                        line-height: 2;
                                        font-weight: bold;
                                        text-align: center;
                                        cursor: pointer;
                                        display: inline-block;
                                        border-radius: 5px;
                                        text-transform: capitalize;
                                  }

                                  /* -------------------------------------
                                        OTHER STYLES THAT MIGHT BE USEFUL
                                  ------------------------------------- */
                                  .last {
                                        margin-bottom: 0;
                                  }

                                  .first {
                                        margin-top: 0;
                                  }

                                  .aligncenter {
                                        text-align: center;
                                  }

                                  .alignright {
                                        text-align: right;
                                  }

                                  .alignleft {
                                        text-align: left;
                                  }

                                  .clear {
                                        clear: both;
                                  }

                                  /* -------------------------------------
                                        ALERTS
                                        Change the class depending on warning email, good email or bad email
                                  ------------------------------------- */
                                  .alert {
                                        font-size: 16px;
                                        color: #fff;
                                        font-weight: 500;
                                        padding: 20px;
                                        text-align: center;
                                        border-radius: 3px 3px 0 0;
                                  }
                                  .alert a {
                                        color: #fff;
                                        text-decoration: none;
                                        font-weight: 500;
                                        font-size: 16px;
                                  }
                                  .alert.alert-warning {
                                        background: #f8ac59;
                                  }
                                  .alert.alert-bad {
                                        background: #ed5565;
                                  }
                                  .alert.alert-good {
                                        background: #1ab394;
                                  }

                                  /* -------------------------------------
                                        INVOICE
                                        Styles for the billing table
                                  ------------------------------------- */
                                  .invoice {
                                        margin: 40px auto;
                                        text-align: left;
                                        width: 80%;
                                  }
                                  .invoice td {
                                        padding: 5px 0;
                                  }
                                  .invoice .invoice-items {
                                        width: 100%;
                                  }
                                  .invoice .invoice-items td {
                                        border-top: #eee 1px solid;
                                  }
                                  .invoice .invoice-items .total td {
                                        border-top: 2px solid #333;
                                        border-bottom: 2px solid #333;
                                        font-weight: 700;
                                  }

                                  /* -------------------------------------
                                        RESPONSIVE AND MOBILE FRIENDLY STYLES
                                  ------------------------------------- */
                                  @media only screen and (max-width: 640px) {
                                        h1, h2, h3, h4 {
                                                font-weight: 600 !important;
                                                margin: 20px 0 5px !important;
                                        }

                                        h1 {
                                                font-size: 22px !important;
                                        }

                                        h2 {
                                                font-size: 18px !important;
                                        }

                                        h3 {
                                                font-size: 16px !important;
                                        }

                                        .container {
                                                width: 100% !important;
                                        }

                                        .content, .content-wrap {
                                                padding: 10px !important;
                                        }

                                        .invoice {
                                                width: 100% !important;
                                        }
                                  }
                            </style>
                        <table class="body-wrap">
                            <tr>
                                <td></td>
                                <td class="container" width="600">
                                    <div class="content">
                                        <table class="main" width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td class="content-wrap">
                                                    <table  cellpadding="0" cellspacing="0">
                                                        <tr>
                                                            <td>
                                                                <img class="img-responsive" src="'.$base.'public/main/template/gsm/images/email/header.png"/>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="content-block">
                                                                <h3>Silver Membership Activated!</h3>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="content-block">
                                                            <p>Thank you for upgrading to Silver Membership on GSM Stock Market.</p>
                                                            <p>The marketplace goes live on May 1st at 10am GMT.</p>
                                                            <p>You have access now so please update your profile description and logos ready for the big launch.</p>
                                                            <p>In the meantime if you have any questions or queries please do not hesitate to contact us using the platform ticket system within your account or by phone on +44 (0)1494 717236</p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="content-block aligncenter">
                                                                <a href="'.$base.'" class="btn-primary">Log in to view account</a>
                                                            </td>
                                                        </tr>
                                                      </table>
                                                </td>
                                            </tr>
                                        </table></div>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                                ';
                
                
                $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket');

                $list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
                $this->email->to($this->member_model->get_where($trans_id)->email);
                $this->email->bcc($list);
                $this->email->subject('Your Account has been upgraded');
                $this->email->message($email_body);

                $this->email->send();
                //echo $this->email->print_debugger();
                redirect('paypal/completed');
            }
            
            
            
        }
        elseif($status == 'Pending'){
            
            redirect('paypal/pending');
            
        }
        
        
    }
    
    function cancel_return()
    {
        $this->load->view('cancel-return');
    }
    
    
    function review_payment()
    {
        $token = '';        
        $data['results'] = $this->paypal_subscribe->GetShippingDetails($token);
        
        $this->load->view('review-payment', $data);
        
        //echo '<pre>';
        //print_r($results);
    }
    
    function order_confirm(
                            $token, 
                            $email, 
                            $shipToName, 
                            $shipToStreet, 
                            $shipToCity, 
                            $shipToState, 
                            $shipToZip , 
                            $shipToCountry,
                            $amount
                            )
    {
        //$finalPaymentAmount = $amount;
        
        $results = $this->paypal_subscribe->CreateRecurringPaymentsProfile(
                                                                            $token, 
                                                                            $email, 
                                                                            $shipToName, 
                                                                            $shipToStreet, 
                                                                            $shipToCity, 
                                                                            $shipToState, 
                                                                            $shipToZip , 
                                                                            $shipToCountry,
                                                                            $amount
                                                                        );
        
        echo '<pre>';
        print_r($results);
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
            
            $data_trans = array(
                                'status' => 'completed'
                                );
            
            $this->transaction_model->_update_where($data_trans, 'invoice', $this->input->post('invoice'));
            
            $trans_type = $this->transaction_model->get_where_multiple('invoice', $this->input->post('invoice'))->item;
            $trans_id = $this->transaction_model->get_where_multiple('invoice', $this->input->post('invoice'))->buyer_id;
            
            if($trans_type == 'GSMStockmarket - Silver Membership Fee'){
                
                $data_member = array(
                                'membership' => 2
                                );
            
                $this->member_model->_update_where($data_member, 'id', $trans_id);
                
            }
            
           redirect('paypal/completed'); 
        }
        elseif($status == 'Refunded'){
            
        }
    }
    
    //ssQh6lZtzMtwKt5jXibpGXgLDb3m0_TJu-ITSsUtyiIJT_mXxGkMCiHIOH4
	
}
