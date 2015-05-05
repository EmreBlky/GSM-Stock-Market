<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('paypal/paypal_model', 'paypal_model');
        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->load->model('notification/notification_model', 'notification_model');
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
        $base = $this->config->item('base_url');
        
        if($product == 'platinum'){
           $description = "GSMStockmarket - Platinum Membership Fee";
           $amount = 5000;
           $quantity = 1;
        }
//        elseif($product == 'gold'){
//            $description = "GSMStockmarket - Gold Membership Fee";
//        }
        elseif($product == 'silver-12'){
            $description = "GSMStockmarket - Silver Membership Fee (1 Year)";
            $amount = 1795;
            $quantity = 1;
        }
        elseif($product == 'silver-6'){
            $description = "GSMStockmarket - Silver Membership Fee (6 Months)";
            $amount = 995;
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
                            'item_description' => '',
                            'payment_type' => 'PayPal'
                            );
        $this->transaction_model->_insert($data_trans);
        
        
        $base                           = $this->config->item('base_url');
        $config['business']             = 'info@gsmstockmarket.com';
        $config['cpp_header_image']     = $base .'public/main/template/gsm/images/paypal_gsm.png'; //Image header url [750 pixels wide by 90 pixels high]
        $config["cmd"] 			= '_cart'; //Do not modify
        $config['return']               = $base .'paypal/notify_payment';
        $config['cancel_return']        = $base .'paypal/cancel_return';
        $config['notify_url']           = $base .'paypal/process'; //IPN Post
        if($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == 'secure-dev.gsmstockmarket.com'){
           $config['production']           = FALSE; //Its false by default and will use sandbox 
        }else{
           $config['production']           = TRUE; //Its false by default and will use sandbox 
        }
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
            
            if($trans_type == 'GSMStockmarket - Silver Membership Fee (1 Year)' || $trans_type == 'GSMStockmarket - Silver Membership Fee (6 Months)'){
                
                if($trans_type == 'GSMStockmarket - Silver Membership Fee (1 Year)'){
                    
                    $data_member = array(
                                'membership' => 2,
                                'membership_expire_date' => date("Y-m-d H:i:s", strtotime("+1 year", strtotime(date("Y-m-d H:i:s"))))
                                );
            
                    $this->member_model->_update_where($data_member, 'id', $trans_id);
                    
                }
                
                if($trans_type == 'GSMStockmarket - Silver Membership Fee (6 Months)'){
                    
                    $data_member = array(
                                'membership' => 2,
                                'membership_expire_date' => date("Y-m-d H:i:s", strtotime("+6 months", strtotime(date("Y-m-d H:i:s"))))
                                );
            
                    $this->member_model->_update_where($data_member, 'id', $trans_id);
                    
                }
                
                
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
                
                $data_mail = array(
                                    'member_id'         => 5,
                                    'member_name'       => $this->member_model->get_where(5)->firstname.' '.$this->member_model->get_where(5)->lastname,
                                    'sent_member_id'    => $this->session->userdata('members_id'),
                                    'sent_member_name'  => $this->member_model->get_where($this->session->userdata('members_id'))->firstname.' '.$this->member_model->get_where($this->session->userdata('members_id'))->lastname,                        
                                    'subject'           => 'PayPal Transaction - '.$this->input->post('invoice').'',
                                    'body'              => '<p>Thank you for upgrading your membership on GSMStockMarket.com.</p>
                                                            <p>To view the full invoice you can go to <strong>Preferences > My Subscription</strong> and print off a copy direct from within your account.</p>
															<p>If you have any billing issues or queries please do not hesitate to email us at billing@gsmstockmarket.com, message us through the submit a ticket system or call us on +44 (0)1494 717321</p>
															<P>Kind Regards,<br>GSMStockMarket.com Team</p>',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->mailbox_model->_insert($data_mail);
        
        $email_support = $this->notification_model->get_where_multiple('member_id', $this->session->userdata('members_id'))->email_support;
                      
            if($email_support == 'yes'){

                  
                  $this->email->set_mailtype("html");
                  $email_body = '<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background-color: #f6f6f6;width: 100%;">
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
                                <td class="container" width="600" style="margin: 0 auto !important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block !important;max-width: 600px !important;clear: both !important;">
                                    <div class="content" style="margin: 0 auto;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 600px;display: block;">
                                        <table class="main" width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;">
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td class="content-wrap" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                    <table cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                <img class="img-responsive" src="'.$base.'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                                                            </td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                <h3 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">You have a message from the support team @ GSM Stockmarket.</h3>
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                                                                <a href="'.$base.'" class="btn-primary" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #FFF;text-decoration: none;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;">Log in to view account</a>
                                                            </td>
                                                        </tr>
                                                      </table>
                                                </td>
                                            </tr>
                                        </table></div>
                                </td>
                                <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
                            </tr>
                        </table>';


                  $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket Support');

                  //$list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
                  $this->email->to($this->member_model->get_where($this->session->userdata('members_id'))->email);
                  $this->email->subject('You have a message in your inbox');
                  $this->email->message($email_body);

                  $this->email->send();                          
            }
                
//                $this->load->module('emails');
//                $config = Array(
//                                'protocol' => 'smtp',
//                                'smtp_host' => 'ssl://server.gsmstockmarket.com',
//                                'smtp_port' => 465,
//                                'smtp_user' => 'noreply@gsmstockmarket.com',
//                                'smtp_pass' => 'ehT56.l}iW]I2ba3f0',
//                                'charset' => 'utf-8',
//                                'wordwrap' => TRUE,
//                                'newline' => "\r\n",
//                                'crlf'    => ""
//
//                            );
//                
//                $this->load->library('email', $config);
                //$this->load->library('email');
                //$this->email->newline = "\r\n";
                //$this->email->crlf = "\r\n";
                $this->email->set_mailtype("html");
                $email_body = '<table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background-color: #f6f6f6;width: 100%;">
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
                                <td class="container" width="600" style="margin: 0 auto !important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block !important;max-width: 600px !important;clear: both !important;">
                                    <div class="content" style="margin: 0 auto;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 600px;display: block;">
                                        <table class="main" width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;">
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td class="content-wrap" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                    <table cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                <img class="img-responsive" src="'.$base.'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                                                            </td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                <h3 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Silver Membership Activated!</h3>
                                                            </td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Thank you for upgrading to Silver Membership on GSM Stock Market.</p>
                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">The marketplace goes live on May 1st at 10am GMT.</p>
                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">You have access now so please update your profile description and logos ready for the big launch.</p>
                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">In the meantime if you have any questions or queries please do not hesitate to contact us using the platform ticket system within your account or by phone on +44 (0)1494 717321</p>
                                                            </td>
                                                        </tr>
                                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                                                                <a href="'.$base.'" class="btn-primary" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #FFF;text-decoration: none;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;">Log in to view account</a>
                                                            </td>
                                                        </tr>
                                                      </table>
                                                </td>
                                            </tr>
                                        </table></div>
                                </td>
                                <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
                            </tr>
                        </table>';
                
                
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
