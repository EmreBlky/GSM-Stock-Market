<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trial extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('trial/trial_model', 'trial_model');
        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->load->model('member/member_model', 'member_model');
    }

    function index()
    {
        $data['main'] = 'trial';
	$data['title'] = 'GSM Stockmarket: Trial';
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function activate($mid)
    {
        $tcount = $this->trial_model->_custom_query_count("SELECT COUNT(*) AS count FROM trial WHERE member_id = '".$mid."'");
        
        if($tcount[0]->count < 1){
            $data = array(
                        'member_id'     => $mid,
                        'date'          => date('Y-m-d H:i:s')
                        );
            $this->trial_model->_insert($data);
            
            $data_mem = array(
                            'membership' => 2
                            );
            $this->member_model->_update($mid, $data_mem);
            
            $this->session->set_userdata('membership', 2);
            
            $data = array(
                                    'member_id'         => 5,
                                    'member_name'       => 'GSM Support',
                                    'sent_member_id'    => $mid,
                                    'sent_member_name'  => $this->member_model->get_where($mid)->firstname.' '.$this->member_model->get_where($mid)->lastname,
                                    'subject'           => '30 Day Trial Activated',
                                    'body'              => '<strong>Congratulations. Your free 30 day trial has been activated.</strong><br/ ><br/ >If you haven\'t already you will need to submit two (2) trade references for your account before we can give you complete access. This is to ensure our platform remains as safe as possible and to only allow trustworthy businesses.',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'sent_belong'       => 5,
                                    'draft'             => 'no',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'parent_id'         => $this->input->post('parent_id'),
                                    'datetime'          => date('Y-m-d H:i:s')
                                  );
            $this->mailbox_model->_insert($data);
            
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
                            <img class="img-responsive" src="https://secure.gsmstockmarket.com/public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align:center">
                            <h3 style="margin: 10px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">You have now activated your <strong style="color:#b51a00">free 30 day trial</strong></h3>
                            <p style="margin: 10px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Login now and gain full access to our platform and enjoy many great innovative features and functions we have designed for you.<br /><br />Start buying and selling mobile phones, accessories and spare parts.<br /><br />You can also search for other members in similar business activities, message them and start building up your network of new contacts.</p>
                            </td>
                            
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block aligncenter" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                            <p><a href="https://secure.gsmstockmarket.com/" style="display:inline-block;padding:6px 12px;margin-bottom:0;font-size:20px;font-weight:400;line-height:1.42857143;text-align:center;white-space:nowrap;vertical-align:middle;-ms-touch-action:manipulation;touch-action:manipulation;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-image:none;border:1px solid transparent;border-radius:4px;text-decoration:none;background-color: #1ab394;border-color: #1ab394;color: #FFFFFF;">Login Now</a></p>
                            </td>                            
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If you need any assistance please call us on +44 (0)1494 717 321 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Many Thanks,<br style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            GSMStockMarket Team</p>
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
            $this->email->to($this->member_model->get_where($mid)->email);
            $this->email->subject('30 Day Free Trial');
            $this->email->message($email_body);

            $this->email->send();
            
            $this->session->set_flashdata('confirm', '<div style="margin:15px 15px -30px">    
                                                                <div class="alert alert-success">
                                                                    Your account has been upgraded with a 30 day trial.
                                                                </div>
                                                            </div>');
            redirect('home/');
        }
        else{
            $this->session->set_flashdata('confirm', '<div style="margin:15px 15px -30px">    
                                                                <div class="alert alert-warning">
                                                                    Your account has already had a 30 day free trial. Please upgrade your account.
                                                                </div>
                                                            </div>');
            redirect('home/');
        }
    }
    
    function update()
    {
        $date = date('Y-m-d H:i:s', strtotime('-30 days'));
        
        $trials = $this->trial_model->get_all();      
        
        foreach ($trials as $trial){
            
            if($trial->date < $date){
                
                $data = array(
                            'status'     => 'expired'
                            );
                $this->trial_model->_update_where($data, 'member_id', $trial->member_id);

                $data_mem = array(
                                'membership' => 1
                                );
                $this->member_model->_update_where($data_mem, 'id', $trial->member_id);
                
                $this->session->set_userdata('membership', 1);
                
            }
        }        
        
    }
}