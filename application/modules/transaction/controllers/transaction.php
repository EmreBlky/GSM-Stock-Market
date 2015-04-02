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
                                    'subject'           => 'Bank Transfer Transaction - '.$invoice.'',
                                    'body'              => '<p>Thank you for upgrading your membership on GSMStockMarket.com. We have emailed you an order summary with our bank details to make payment.</p>
															<p>Once payment has been made using the details below we will upgrade your account within 24 hours after payment has been completed. You will be sent a message confirming your upgrade.</p>
									<h4>Payment Instructions</h4>
                                                            <p>Please make sure your invoice number <strong>'.$invoice.'</strong> is the reference on your transaction and that the total amount payable in <strong>£ (GBP)</strong> to:</p><br />
                                                            <p style="text-align:left;margin:0 15px"><strong>Account Name:</strong> GSM Stock Market.com Ltd<br />
                                                            <strong>IBAN:</strong> GB73 BARC 2040 7153 1834 24<br />
                                                            <strong>SWIFTBIC:</strong> BARCGB22<br />
                                                            <strong>Account no:</strong> 53183424<br />
                                                            <strong>Sort Code:</strong> 20-40-71<br />
                                                            Barclays Bank. 12 Station Approach, Gerrards Cross, Bucks. SL9 8PP. UK.</p><br />
                                                            <p>To view the full invoice you can go to <strong>Preferences > My Subscription</strong> and print off a copy direct from within your account.</p>
															<p>If you have any billing issues or queries please do not hesitate to email us at billing@gsmstockmarket.com, message us through the submit a ticket system or call us on +44 (0)1494 717236</p>
															<P>Kind Regards,<br>GSMStockMarket.com Team</p>',
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
                $email_body = '                    <table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background-color: #f6f6f6;width: 100%;">
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
                            <td class="container" width="600" style="margin: 0 auto !important;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;display: block !important;max-width: 600px !important;clear: both !important;">
                                <div class="content" style="margin: 0 auto;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 600px;display: block;">
                                    <table class="main" width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background: #fff;border: 1px solid #e9e9e9;border-radius: 3px;">
                                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                            <td class="content-wrap aligncenter" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                                                <table width="100%" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                        <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                            <img class="img-responsive" src="'.$base.'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                                                        </td>
                                                    </tr>
                                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                        <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                            <table class="invoice" style="margin: 40px auto;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;text-align: left;width: 80%;">
                                                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                    <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                    Company name: '.$this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->company_name.'<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                    Invoice no. '.$invoice.'<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                    '.date('F j, Y', strtotime(date('Y-m-d H:i:s'))).'
                                                                    </td>
                                                                </tr>
                                                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                    <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                        <table class="invoice-items" cellpadding="0" cellspacing="0" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;">
                                                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                <td style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;border-top: #eee 1px solid;">Silver Membership Upgrade</td>
                                                                                <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: #eee 1px solid;">&pound; 1295.00</td>
                                                                            </tr>
                                                                            <tr class="total" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                <td class="alignright" width="80%" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: 2px solid #333;border-bottom: 2px solid #333;font-weight: 700;">Total</td>
                                                                                <td class="alignright" style="margin: 0;padding: 5px 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: right;border-top: 2px solid #333;border-bottom: 2px solid #333;font-weight: 700;">&pound; 1295.00</td>
                                                                            </tr>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">This is a summary of your order and not an official invoice.</p>
                                                        </td>
                                                    </tr>
                                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                        <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                            <h4 style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;font-weight: 600;">Payment Instructions</h4>
                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Please make sure your invoice number is the reference on your transaction and that the total amount payable in <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">£ (GBP)</strong> to:</p>
                                                            <p style="text-align: left;margin: 0 15px;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;"><strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">Account Name:</strong> GSM Stock Market.com Ltd<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">IBAN:</strong> GB73 BARC 2040 7153 1834 24<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">SWIFTBIC:</strong> BARCGB22<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">Account no:</strong> 53183424<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">Sort Code:</strong> 20-40-71<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            Barclays Bank. 12 Station Approach, Gerrards Cross, Bucks. SL9 8PP. UK.</p><br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">To view the full invoice you can login to your account and go to<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;"><strong style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">Preferences > My Subscription</strong> and print off a copy direct from our website</p>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="footer" style="margin: 0;padding: 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;width: 100%;clear: both;color: #999;">
                                        <table width="100%" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                <td class="aligncenter content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;vertical-align: top;text-align: center;">Billing questions? Email <a href="mailto:billing@gsmstockmarket.com" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 12px;color: #999;text-decoration: underline;">billing@gsmstockmarket.com</a></td>
                                            </tr>
                                        </table>
                                    </div></div>
                            </td>
                            <td style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;"></td>
                        </tr>
                    </table>';
                
                $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket');

                $list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
                $this->email->to($this->member_model->get_where($this->session->userdata('members_id'))->email);
                $this->email->bcc($list);
                $this->email->subject('GSM Bank Transfer Payment');
                $this->email->message($email_body);

                $this->email->send();
                //echo $this->email->print_debugger();
                $this->session->set_flashdata('confirm-transaction', '<div style="margin:0 15px">    
                                                                <div class="alert alert-success">
                                                                    Order has been placed. Your invoice has been generated below.
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
