<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tradereference extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('tradereference/tradereference_model', 'tradereference_model');
        $this->load->model('country/country_model', 'country_model');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
    }

    function index()
    {
        $count = $this->tradereference_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($count < 1){
            $data = array(
                          'member_id' => $this->session->userdata('members_id')
            );
            $this->tradereference_model->_insert($data);
        }
        
        $data['main'] = 'tradereference';
	$data['title'] = 'GSM - Trade Reference';
        $data['page'] = 'index';
        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
        $cid = $this->member_model->get_where($this->session->userdata('members_id'))->company_id;
        $data['company'] = $this->company_model->get_where($cid);
        $data['trade_ref'] = $this->tradereference_model->get_where_multiple('member_id', $this->session->userdata('members_id'));
        
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function submit_refs($trader = NULL)
    {
        
        $data['main'] = 'tradereference';
	$data['title'] = 'GSM - Trade Reference';
        $data['page'] = 'submit-refs';
        
        
        $data['trade_ref'] = $this->tradereference_model->get_where_multiple('member_id', $this->session->userdata('members_id'));
        
        if($trader){
            $data['trader'] = $trader;
        }
        else{
            $data['trader'] = '';
        }
        $data['country_one'] = $this->country_model->get_all();
        $data['country_two'] = $this->country_model->get_all();
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    
    function updateRef()
    {
//        echo '<pre>';
//        print_r($_POST);
//        exit;        
        $this->load->module('salesforces');
        
        $this->load->helper('string');
        $this->load->library('form_validation');		            
            
        $this->form_validation->set_rules('trade_1_company', 'Company Name 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_company', 'Company Name 2', 'xss_clean');
        $this->form_validation->set_rules('trade_1_name', 'Contact Name 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_name', 'Contact Name 2', 'xss_clean');
        $this->form_validation->set_rules('trade_1_email', 'Email 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_email', 'Email 2', 'xss_clean');
        $this->form_validation->set_rules('trade_1_phone', 'Phone 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_phone', 'Phone 2', 'xss_clean');
        $this->form_validation->set_rules('trade_1_country', 'Country 1', 'xss_clean');
        $this->form_validation->set_rules('trade_2_country', 'Country 2', 'xss_clean');
        
        $email1 = $this->input->post('trade_1_email');
        $email2 = $this->input->post('trade_2_email');
        $trader = $this->input->post('trader');

            if($this->form_validation->run()){
                
                $code1 = $this->session->userdata('members_id').'-'.random_string('alnum', 4).'-'.random_string('alnum', 4).'-trade_1';
                $code2 = $this->session->userdata('members_id').'-'.random_string('alnum', 4).'-'.random_string('alnum', 4).'-trade_2';
                
                if($trader == 'trade_1'){
                    
                    $data = array(
                                'trade_1_company'       => $this->input->post('trade_1_company'),
                                'trade_1_name'          => $this->input->post('trade_1_name'),
                                'trade_1_email'         => $email1,
                                'trade_1_phone'         => $this->input->post('trade_1_phone'),
                                'trade_1_country'       => $this->input->post('trade_1_country'),
                                'trade_1_code'          => $code1,
                                'trade_1_confirm'       => 'no',
                                'trade_1_admin_approve' => 'no'
                    );
                    $this->tradereference_model->_update_where($data, 'member_id', $this->session->userdata('members_id'));
                }
                elseif($trader == 'trade_2'){
                    
                    $data = array(                                
                                'trade_2_company'       => $this->input->post('trade_2_company'),
                                'trade_2_name'          => $this->input->post('trade_2_name'),
                                'trade_2_email'         => $email2,
                                'trade_2_phone'         => $this->input->post('trade_2_phone'),
                                'trade_2_country'       => $this->input->post('trade_2_country'),
                                'trade_2_code'          => $code2,
                                'trade_2_confirm'       => 'no',
                                'trade_2_admin_approve' => 'no'
                    );
                    $this->tradereference_model->_update_where($data, 'member_id', $this->session->userdata('members_id'));
                    
                }
                else{
                    
                    $trader = $this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->company_name;
                
                    $data = array(
                                'trade_1_company'   => $this->input->post('trade_1_company'),
                                'trade_1_name'      => $this->input->post('trade_1_name'),
                                'trade_1_email'     => $email1,
                                'trade_1_phone'     => $this->input->post('trade_1_phone'),
                                'trade_1_country'   => $this->input->post('trade_1_country'),
                                'trade_1_code'      => $code1,
                                'trade_2_company'   => $this->input->post('trade_2_company'),
                                'trade_2_name'      => $this->input->post('trade_2_name'),
                                'trade_2_email'     => $email2,
                                'trade_2_phone'     => $this->input->post('trade_2_phone'),
                                'trade_2_country'   => $this->input->post('trade_2_country'),
                                'trade_2_code'      => $code2,
                    );
                    $this->tradereference_model->_update_where($data, 'member_id', $this->session->userdata('members_id'));
                    $this->salesforces->insertSalesforce($this->input->post('trade_1_name'), $email1, $this->input->post('trade_1_phone'), $this->input->post('trade_1_company'), $this->country_model->get_where($this->input->post('trade_1_country'))->country, $this->input->post('trade_2_name'), $email2, $this->input->post('trade_2_phone'), $this->input->post('trade_2_company'), $this->country_model->get_where($this->input->post('trade_2_country'))->country, $trader);
                }

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

                if($email1 != ''){

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
                                    <img class="img-responsive" src="'.$this->config->item('base_url').'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.$this->input->post('trade_1_name').',</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Our client '.$this->member_model->get_where($this->session->userdata('members_id'))->firstname.' '.$this->member_model->get_where($this->session->userdata('members_id'))->lastname.' of '.$this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->company_name.', '.$this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->country)->country.' has kindly requested that you provide a trade reference on their behalf.</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">We ensure our platform is a trusted and safe trading environment for all registered members so require these references as extra checks before we allow them full access to our platform.</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Please could you click on the link below to confirm that you know the company, you have had business dealings with them and that they are trustworthy.</p>
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">'.$this->config->item('base_url').'tradereference/confirm/'.$code1.'</p>
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If you need any assistance please call us on +44 (0)207 048 0120 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
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

                    $this->email->to($email1);
                    $this->email->subject('GSM Stockmarket Trade Reference');
                    $this->email->message($email_body);

                    $this->email->send();

                }

                if($email2 != ''){

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
                                    <img class="img-responsive" src="'.$this->config->item('base_url').'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.$this->input->post('trade_2_name').',</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Our client '.$this->member_model->get_where($this->session->userdata('members_id'))->firstname.' '.$this->member_model->get_where($this->session->userdata('members_id'))->lastname.' of '.$this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->company_name.', '.$this->country_model->get_where($this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->country)->country.' has kindly requested that you provide a trade reference on their behalf.</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">We ensure our platform is a trusted and safe trading environment for all registered members so require these references as extra checks before we allow them full access to our platform.</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Please could you click on the link below to confirm that you know the company, you have had business dealings with them and that they are trustworthy.</p>
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">'.$this->config->item('base_url').'tradereference/confirm/'.$code2.'</p>
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If you need any assistance please call us on +44 (0)207 048 0120 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
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

                    $this->email->to($email2);
                    $this->email->subject('GSM Stockmarket Trade Reference');
                    $this->email->message($email_body);

                    $this->email->send();                   
                       
                }
                
                $this->session->set_flashdata('trade-confirmation', '<div style="margin:15px">    
                                                                            <div class="alert alert-success">
                                                                                Your Trade Reference(s) have been updated. We have sent an verification message to the email(s) supplied.
                                                                            </div>
                                                                        </div>');
                redirect('tradereference/');
            }
        
             
    }
    
    function confirm($code = NULL)
    {
        $data['base'] = $this->config->item('base_url');
        $data['title'] = 'GSM - Trade Reference';
        
        if($code){
            
            $tcount = $this->tradereference_model->_custom_query_count("SELECT COUNT(*) AS count FROM tradereference WHERE trade_1_code = '".$code."' OR trade_2_code = '".$code."'");
            
            if($tcount[0]->count > 0){
                
                $confirm_code = substr($code, -7);
                $members = $this->tradereference_model->_custom_query("SELECT member_id, ".$confirm_code."_company, ".$confirm_code."_name, ".$confirm_code."_email, ".$confirm_code."_phone, ".$confirm_code."_confirm FROM tradereference WHERE (trade_1_code = '".$code."') OR (trade_2_code = '".$code."') ");
                $data['message'] = 'no';
                //$member = $members[0]->member_id;
                //echo '<pre>';
                //print_r($member);
                //echo $confirm_code;
                //$data['main'] = 'tradereference';

                $data['cc'] = $confirm_code;
                $data['member'] = $members[0]->member_id;

                if($confirm_code == 'trade_1'){            

                    $data['company'] = $members[0]->trade_1_company;
                    $data['name'] = $members[0]->trade_1_name;
                    $data['confirm'] = 'trade_1_confirm';

                }
                else{

                    $data['company'] = $members[0]->trade_2_company;
                    $data['name'] = $members[0]->trade_2_name;
                    $data['confirm'] = 'trade_2_confirm';

                }
                
            }
            else{
                
                $data['message'] = 'expired';
            }
            
        }
        else{
            $data['message'] = 'yes';
        }
        
        $this->load->view('confirm', $data);
        //$this->load->module('templates');
        //$this->templates->page($data);
//        $newstring = substr($dynamicstring, -7);
        
    }
    
    function tradeRef($code)
    {
        //echo '<pre>';
        //print_r($_POST);
        $mid = $this->input->post('member_id');
        
        if($code == 'trade_1'){
            
            $data = array(
                'trade_1_comments' => $this->input->post('comment'),
                'trade_1_confirm' => 'yes'
            );
            $this->tradereference_model->_update_where($data, 'member_id', $mid); 
            
        }
        else{
            
            $data = array(
                'trade_2_comments' => $this->input->post('comment'),
                'trade_2_confirm' => 'yes'
            );
            $this->tradereference_model->_update_where($data, 'member_id', $mid); 
            
        }        
        
        $this->session->set_flashdata('confirm-reference', '<div style="margin:15px">    
                                                                <div class="alert alert-warning">
                                                                    Thank you. Your comments have been submitted.
                                                                </div>
                                                            </div>');
        
        $trade1 = $this->tradereference_model->get_where_multiple('member_id', $mid)->trade_1_confirm;
        $trade2 = $this->tradereference_model->get_where_multiple('member_id', $mid)->trade_2_confirm;
        
        if($trade1 == 'yes' && $trade2 == 'yes'){
            
            $data = array(
                'trade_completed' => 'yes'
            );
            $this->tradereference_model->_update_where($data, 'member_id', $mid); 
            
        }
        redirect('tradereference/confirm');
    }
    
    function resend($mid, $name, $email, $code)
    {
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
                                    <img class="img-responsive" src="'.$this->config->item('base_url').'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.str_replace('%20', ' ', $name).',</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">You have been assigned as a reference for GSMStockMarket.com Limited.</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Please could you click on the link below:</p>
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">'.$this->config->item('base_url').'tradereference/confirm/'.$code.'</p>
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If you need any assistance please call us on +44 (0)207 048 0120 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
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

            $this->email->to($email);
            $this->email->subject('GSM Stockmarket Trade Reference');
            $this->email->message($email_body);

            $this->email->send();

            $this->session->set_flashdata('confirm-resend', '<div style="margin:15px">    
                                                                <div class="alert alert-success">
                                                                    We have resent an email from <strong>noreply@gsmstockmarket.com</strong> to your trade reference.
                                                                </div>
                                                            </div>');

            redirect('tradereference/');
    }
    
    function unconfirmed($reminder = NULL)
    {
        $trades_1 = $this->tradereference_model->get_where_multiples('trade_1_confirm', 'no');
        
        //echo '<h1>Trade 1</h1>';
        //print_r($trade_1);
        foreach($trades_1 as $trade_1){
            
            if($trade_1->trade_1_email){
//                echo '<hr>';
//                echo $trade_1->trade_1_name.'<br/>';
//                echo $trade_1->trade_1_email.'<br/>';
//                echo $trade_1->trade_1_code.'<br/>';
//                echo '<hr>';
                $this->chase_up($trade_1->trade_1_name, $trade_1->trade_1_email, $trade_1->trade_1_code, $reminder);
            }
        }
        
        //echo '<h1>Trade 2</h1>';        
        $trades_2 = $this->tradereference_model->get_where_multiples('trade_2_confirm', 'no');
        
        //echo '<pre>';
        //print_r($trade_1);
        foreach($trades_2 as $trade_2){
            
            if($trade_2->trade_2_email){
//                echo '<hr>';
//                echo $trade_2->trade_2_name.'<br/>';
//                echo $trade_2->trade_2_email.'<br/>';
//                echo $trade_2->trade_2_code.'<br/>';
//                echo '<hr>';
                $this->chase_up($trade_2->trade_2_name, $trade_2->trade_2_email, $trade_2->trade_2_code, $reminder);
            }
        }
    }
            
    function chase_up($name, $email, $code, $reminder = NULL){
        
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
                                    <img class="img-responsive" src="'.$this->config->item('base_url').'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.$name.',</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">You have been assigned as a reference for GSMStockMarket.com Limited.</p>
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Please could you click on the link below:</p>
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">'.$this->config->item('base_url').'tradereference/confirm/'.$code.'</p>
                                    </td>
                                    </tr>
                                    <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If you need any assistance please call us on +44 (0)207 048 0120 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
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

            $this->email->to($email);
            $this->email->subject('GSM Stockmarket Trade Reference');
            $this->email->message($email_body);

            $this->email->send();
        
    }
}