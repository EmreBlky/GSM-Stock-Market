<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Join extends MX_Controller 
{
    function __construct()
    {
        ob_start();
        parent::__construct();       

    }
    
    function validateAccount()
    {
        $this->session->set_userdata('logged_in', 1);
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('country/country_model', 'country_model'); 
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        
        $data['main'] = 'join';
        $data['title'] = 'GSM - Edit Profile';
        $data['page'] = 'edit-profile';
        $this->load->view('validate-account', $data);
        
        $this->session->unset_userdata('logged_in');
    }

    function index()
    {
        $this->session->set_userdata('logged_in', 1);
        
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('country/country_model', 'country_model'); 
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");

        $data['main'] = 'join';
        $data['title'] = 'GSM - Edit Profile';
        $data['page'] = 'edit-profile';
        $this->load->view('index', $data);
        $this->session->unset_userdata('logged_in');
    }
    
    function profileCreate()
    {
        //echo '<pre>';
        //print_r($_POST);
        //exit;
        
        $this->session->set_userdata('logged_in', 1);
        
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->helper('string');        
        
        $base = $this->config->item('base_url');
        
            $bsectors4 = '';
            $bsectors5 = '';
            
            $bsectors = $this->input->post('bsectors');
            
            if(isset($bsectors[3])){
                
                $bsectors4 = $bsectors[3];
            }
            if(isset($bsectors[4])){
                
                $bsectors5 = $bsectors[4];
            }

            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 'xss_clean');
            $this->form_validation->set_rules('title', 'Title', 'xss_clean');
            $this->form_validation->set_rules('firstname', 'First Name', 'xss_clean');
            $this->form_validation->set_rules('lastname', 'Surname', 'xss_clean');
            $this->form_validation->set_rules('company_name', 'Company Name', 'xss_clean');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'xss_clean');
            $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'xss_clean');
            $this->form_validation->set_rules('address_line_1', 'Address Line 1', 'xss_clean');
            $this->form_validation->set_rules('address_line_2', 'Address Line 2', 'xss_clean');
            $this->form_validation->set_rules('town_city', 'City', 'xss_clean');
            $this->form_validation->set_rules('county', 'County', 'xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'xss_clean');
            $this->form_validation->set_rules('post_code', 'Postcode', 'xss_clean');
            $this->form_validation->set_rules('website', 'Website', 'xss_clean');
            $this->form_validation->set_rules('primary_sector', 'Business Sector 1', 'xss_clean');
            $this->form_validation->set_rules('secondary_sector', 'Business Sector 2', 'xss_clean');
            $this->form_validation->set_rules('tertiary_sector', 'Business Sector 2', 'xss_clean');
            $this->form_validation->set_rules('vat_tax', 'VAT Number', 'xss_clean');
            $this->form_validation->set_rules('company_profile', 'Company Profile', 'xss_clean');
            $this->form_validation->set_rules('company_number', 'Company Number', 'xss_clean');
            $this->form_validation->set_rules('language', 'Language', 'xss_clean');
            $this->form_validation->set_rules('facebook', 'Facebook', 'xss_clean');
            $this->form_validation->set_rules('twitter', 'Twitter', 'xss_clean');
            $this->form_validation->set_rules('gplus', 'Google Plus', 'xss_clean');
            $this->form_validation->set_rules('linkedin', 'LinkedIn', 'xss_clean');
            $this->form_validation->set_rules('skype', 'Skype', 'xss_clean');
            $this->form_validation->set_rules('role', 'Position', 'xss_clean');
            
            $email_activatedNo = $this->member_model->_custom_query_count("SELECT COUNT(*) AS count FROM members WHERE email = '".$this->input->post('email')."' AND validated = 'no'");
            $email_activatedYes = $this->member_model->_custom_query_count("SELECT COUNT(*) AS count FROM members WHERE email = '".$this->input->post('email')."' AND validated = 'yes'");
        
            if($email_activatedNo[0]->count > 0 && $email_activatedYes[0]->count < 1){
                $this->session->set_flashdata('register_title', 'registered_not_activated');
                $this->session->set_flashdata('message', 'That email address has been registered but not activated. Please activate your account via the confirmation email. <a href="'.$this->config->item('base_url').'login/resend/'.$this->input->post('email').'">Resend Email</a> or Please check your spam folder if you have not received one.');
                redirect('join/validateAccount');

            }
            elseif($email_activatedNo[0]->count < 1 && $email_activatedYes[0]->count > 0){
                $this->session->set_flashdata('register_title', 'registered_activated');
                $this->session->set_flashdata('message', 'That email address has been registered and activated. Please log in with your username and passowrd <a href="'.$this->config->item('base_url').'login/">HERE</a>');

                redirect('join/validateAccount');
            }
            else{

                if ($this->form_validation->run()) {

                    $password = random_string('alnum', 8);            
                    $validation_code = random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4);

                    $data = array(
                        'email' => $this->input->post('email'),
                        'title' => $this->input->post('title'),
                        'phone_number' => $this->input->post('phone_number'),
                        'mobile_number' => $this->input->post('mobile_number'),
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'date' => date('d-m-Y'),
                        'password' => md5($password),
                        'unhash_password' => $password,
                        'validation_code' => $validation_code,
                        'validated' => 'no',
                        'language' => $this->input->post('language'),
                        'facebook' => $this->input->post('facebook'),
                        'twitter' => $this->input->post('twitter'),
                        'gplus' => $this->input->post('gplus'),
                        'linkedin' => $this->input->post('linkedin'),
                        'skype' => $this->input->post('skype'),
                        'role' => $this->input->post('company_role')
                    );


                    $mid = $this->member_model->_insert($data);

                    $data = array(
                        'admin_member_id' => $mid,
                        'company_name' => $this->input->post('company_name'),
                        'phone_number' => $this->input->post('phone_number'),
                        'mobile_number' => $this->input->post('mobile_number'),
                        'address_line_1' => $this->input->post('address_line_1'),
                        'address_line_2' => $this->input->post('address_line_2'),
                        'town_city' => $this->input->post('town_city'),
                        'county' => $this->input->post('county'),
                        'country' => $this->input->post('country'),
                        'post_code' => $this->input->post('post_code'),
                        'website' => $this->input->post('website'),
                        'business_sector_1' => $this->input->post('bprimary'),
                        'business_sector_2' => $this->input->post('bsecondary'),
                        'business_sector_3' => $this->input->post('btertiary'),
                        'other_business' => $bsectors4 . $bsectors5,
                        'company_profile' => $this->input->post('company_profile'),
                        'vat_tax' => $this->input->post('vat_tax'),
                        'company_number' => $this->input->post('company_number'),
                    );
                    
                    $cid = $this->company_model->_insert($data);

                    $data = array(
                                    'company_id' => $cid
                                 );
                    $this->member_model->_update($mid, $data);
                    
                    $this->load->module('emails');
                    $config = Array(
                                'protocol' => 'smtp',
                                'smtp_host' => 'ssl://secure.gsmstockmarket.com',
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
                                        <h3>Thank you for signing up to GSMStockMarket.com</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                        <p>Dear '.$this->input->post('firstname').',</p>
                                        <p>Before we can create your account we will need you to confirm your email address by clicking the activation link below. 
                                        We may need to send you critical information about our service and it is important that we have an accurate email address.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="content-block">
                                    	You will be notified by email once you have activated your account and sent a pre-generated password.
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="content-block aligncenter">
                                        <a href="'.$base.'register/confirm/'.$validation_code.'" class="btn-primary">Activate my account</a>
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
                
                $cust_email = $this->input->post('email');
                $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket');

                $list = array($cust_email, 'tim@gsmstockmarket.com');
                $this->email->to($list);
                $this->email->subject('Please verify your account.');
                $this->email->message($email_body);

                $this->email->send();
                //echo $this->email->print_debugger();
                //exit;
                    
                redirect('http://www.gsmstockmarket.com/success');

                }
            }
        
        
        $this->session->unset_userdata('logged_in');
        
    }    
    
}