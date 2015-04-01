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
        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->load->model('country/country_model', 'country_model');
        $this->load->model('company/company_model', 'company_model');
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
        $base = $this->config->item('base_url');
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
        
        $data_mail = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $this->session->userdata('members_id'),
                                    'subject'           => 'You have made a Transaction',
                                    'body'              => 'Hello.<br/><br/>You have just made a transaction. Invoice: '.$invoice.'.<br/><br/>Many Thanks,<br/><br/>GSM Stockmarket Support Team',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->mailbox_model->_insert($data_mail);
        
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
                $this->email->set_mailtype("html");
                $email_body = '<html>
                                <head>
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

                                  .btn-success {
                                        text-decoration: none;
                                        color: #FFF;
                                        background-color: #1c84c6;
                                        border: solid #1c84c6;
                                        border-width: 5px 10px;
                                        line-height: 2;
                                        font-weight: bold;
                                        text-align: center;
                                        cursor: pointer;
                                        display: inline-block;
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
                            </head>
                    <body>
                    <table class="body-wrap">
                        <tr>
                            <td></td>
                            <td class="container" width="600">
                                <div class="content">
                                    <table class="main" width="100%" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td class="content-wrap aligncenter">
                                                <table width="100%" cellpadding="0" cellspacing="0">
                                                    <tr>
                                                        <td>
                                                            <img class="img-responsive" src="'.$base.'public/main/template/gsm/images/email/header.png"/>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content-block">
                                                            <table class="invoice">
                                                                <tr>
                                                                    <td>
                                                                    Company name: '.$this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->company_name.'<br>
                                                                    Invoice no. '.$invoice.'<br>
                                                                    '.date('F j, Y', strtotime(date('Y-m-d H:i:s'))).'
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <table class="invoice-items" cellpadding="0" cellspacing="0">
                                                                            <tr>
                                                                                <td>Silver Membership Upgrade</td>
                                                                                <td class="alignright">&pound; 1295.00</td>
                                                                            </tr>
                                                                            <tr class="total">
                                                                                <td class="alignright" width="80%">Total</td>
                                                                                <td class="alignright">&pound; 1295.00</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <p>This is a summary of your order and not an official invoice.</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="content-block">
                                                            <h4>Payment Instructions</h4>
                                                            <p>Please make sure your invoice number is the reference on your transaction and that the total amount payable in <strong>£ (GBP)</strong> to:</p>
                                                            <p style="text-align:left;margin:0 15px"><strong>Account Name:</strong> GSM Stock Market.com Ltd<br />
                                                            <strong>IBAN:</strong> GB73 BARC 2040 7153 1834 24<br />
                                                            <strong>SWIFTBIC:</strong> BARCGB22<br />
                                                            <strong>Account no:</strong> 53183424<br />
                                                            <strong>Sort Code:</strong> 20-40-71<br />
                                                            Barclays Bank. 12 Station Approach, Gerrards Cross, Bucks. SL9 8PP. UK.</p><br />
                                                            <p>To view the full invoice you can login to your account and go to<br  /><strong>Preferences > My Subscription</strong> and print off a copy direct from our website</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="footer">
                                        <table width="100%">
                                            <tr>
                                                <td class="aligncenter content-block">Billing questions? Email <a href="mailto:billing@gsmstockmarket.com">billing@gsmstockmarket.com</a></td>
                                            </tr>
                                        </table>
                                    </div></div>
                            </td>
                            <td></td>
                        </tr>
                    </table>
                    </body>
                    </html>';
                
                $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket');

                $list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
                $this->email->to($this->member_model->get_where($this->session->userdata('members_id'))->email);
                $this->email->bcc($list);
                $this->email->subject('GSM Bank Transfer Payment');
                $this->email->message($email_body);

                $this->email->send();
                //echo $this->email->print_debugger();
                $this->session->set_flashdata('confirm-transaction', '<div style="margin-top: 15px; margin-left: 10px;">    
                                                                <div class="alert alert-success">
                                                                    Thank you. Your transaction is being processed.
                                                                </div>
                                                            </div>');
                redirect('preferences/subscription');
    }
    
    function invoice($inv_id)
    {
        $data_activity = array(
                                'activity' => 'Transactions: Invoice',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['transaction'] = $this->transaction_model->get_where($inv_id);
        
        $data['main'] = 'transaction';
	$data['title'] = 'Transaction: Invoice';
        $data['page'] = 'invoice';
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice_print($inv_id)
    {
        $data_activity = array(
                                'activity' => 'Transactions: Invoice Print',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['transaction'] = $this->transaction_model->get_where($inv_id);
        $data['base'] = $this->config->item('base_url');
        
	$data['title'] = 'Transaction: Invoice';
        
        $this->load->view('invoice-print', $data);
    }
}