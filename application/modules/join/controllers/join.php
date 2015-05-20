<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Join extends MX_Controller 
{
    function __construct()
    {
        ob_start();
        parent::__construct();  
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('country/country_model', 'country_model');

    }
    
    function validateAccount()
    {
        $this->session->set_userdata('logged_in', 1);
        
        
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
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");

        $data['main'] = 'join';
        $data['title'] = 'GSM - Edit Profile';
        $data['page'] = 'edit-profile';
        $this->load->view('index', $data);
        $this->session->unset_userdata('logged_in');
    }
    
    function profileCreate()
    {
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        
        $this->session->set_userdata('logged_in', 1);
        
        
        $this->load->helper('string');        
        
        $base = $this->config->item('base_url');
        
            $bsectors4 = '';
            $bsectors5 = '';
            
            $bsectors = $this->input->post('bsectors');
            
            if(isset($bsectors[3])){
                
                $bsectors4 = $bsectors[3];
            }
            if(isset($bsectors[4])){
                
                $bsectors5 = ', '.$bsectors[4];
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
            $this->form_validation->set_rules('tertiary_sector', 'Business Sector 3', 'xss_clean');
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
                    $invitation_code = random_string('alnum', 3).'-'. random_string('alnum', 3).'-'. random_string('alnum', 3);

                    $data = array(
                        'email' => $this->input->post('email'),
                        'title' => $this->input->post('title'),
                        'dial_phone' => $this->input->post('phone_number'),
                        'phone_number' => $this->input->post('telephone_number'),
                        'dial_mobile' => $this->input->post('phone_number'),
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
                        'role' => $this->input->post('company_role'),
                        'terms_conditions' => 'yes'
                    );


                    $mid = $this->member_model->_insert($data);

                    $data = array(
                        'admin_member_id' => $mid,
                        'company_name' => $this->input->post('company_name'),
                        'dial_phone' => $this->input->post('phone_number'),
                        'phone_number' => $this->input->post('telephone_number'),
                        'dial_mobile' => $this->input->post('phone_number'),
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
                        'company_profile' => '',
                        'company_profile_approval' => $this->input->post('company_profile'),
                        'vat_tax' => $this->input->post('vat_tax'),                        
                        'currency' => $this->input->post('currency'),
                        'company_number' => $this->input->post('company_number'),
                        'invitation_code' => $invitation_code
                    );
                    
                    $cid = $this->company_model->_insert($data);

                    $data = array(
                                    'company_id' => $cid
                                 );
                    $this->member_model->_update($mid, $data);
                    
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
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <h3 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Thank you for signing up to GSMStockMarket.com</h3>
                                    </td>
                                </tr>
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                        <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.$this->input->post('firstname').',</p>
                                        <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Before we can create your account we will need you to confirm your email address by clicking the activation link below. 
                                        We may need to send you critical information about our service and it is important that we have an accurate email address.</p>
                                    </td>
                                </tr>
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                    	You will be notified by email once you have activated your account and sent a pre-generated password.
                                    </td>
                                </tr>
                                
                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                    <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                                        <a href="'.$base.'register/confirm/'.$validation_code.'" class="btn-primary" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #FFF;text-decoration: none;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;">Activate my account</a>
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
                
                $cust_email = $this->input->post('email');
                $this->email->from('noreply@gsmstockmarket.com', 'GSMStockMarket.com');

                $list = array('tim@gsmstockmarket.com', 'signup@gsmstockmarket.com');
                $this->email->to($cust_email);
                $this->email->bcc($list);
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
    
    function invites($invite_code = NULL)
    {
       $this->session->set_userdata('logged_in', 1);
        
            $data['company_id'] = $this->company_model->get_where_multiple('invitation_code', $invite_code)->id;
            $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");

            $data['title'] = 'GSM - Edit Profile';
            $this->load->view('invites', $data);
        
        $this->session->unset_userdata('logged_in');
    }
    
    function inviteCreate($cid)
    {
        $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 'xss_clean');
            $this->form_validation->set_rules('title', 'Title', 'xss_clean');
            $this->form_validation->set_rules('firstname', 'First Name', 'xss_clean');
            $this->form_validation->set_rules('lastname', 'Surname', 'xss_clean');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'xss_clean');
            $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'xss_clean');
            $this->form_validation->set_rules('address_line_1', 'Address Line 1', 'xss_clean');
            $this->form_validation->set_rules('language', 'Language', 'xss_clean');
            $this->form_validation->set_rules('facebook', 'Facebook', 'xss_clean');
            $this->form_validation->set_rules('twitter', 'Twitter', 'xss_clean');
            $this->form_validation->set_rules('gplus', 'Google Plus', 'xss_clean');
            $this->form_validation->set_rules('linkedin', 'LinkedIn', 'xss_clean');
            $this->form_validation->set_rules('skype', 'Skype', 'xss_clean');
            $this->form_validation->set_rules('role', 'Position', 'xss_clean');
            
            if ($this->form_validation->run()) {
                
                $password = random_string('alnum', 8);            
                    
                $data = array(
                    'email' => $this->input->post('email'),
                    'title' => $this->input->post('title'),                    
                    'dial_mobile' => $this->input->post('phone_number'),
                    'mobile_number' => $this->input->post('mobile_number'),
                    'firstname' => $this->input->post('firstname'),
                    'lastname' => $this->input->post('lastname'),
                    'date' => date('d-m-Y'),
                    'password' => md5($password),
                    'unhash_password' => $password,
                    'validated' => 'yes',
                    'language' => $this->input->post('language'),
                    'facebook' => $this->input->post('facebook'),
                    'twitter' => $this->input->post('twitter'),
                    'gplus' => $this->input->post('gplus'),
                    'linkedin' => $this->input->post('linkedin'),
                    'skype' => $this->input->post('skype'),
                    'role' => $this->input->post('company_role'),
                    'profile_completion' => 90,
                    'company_id' => $cid,
                    'date_activated' => date('Y-m-d'),
                    'terms_conditions' => 'yes'
                );
                
                $this->member_model->_insert($data);
                
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
                                <table class="body-wrap" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;background-color: #f6f6f6;width: 100%;">
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
                                                                                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                                                            <h3 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Thank you for signing up to GSMStockMarket.com</h3>
                                                                                                    </td>
                                                                                            </tr>
                                                                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.$this->input->post('firstname').',</p>
                                                                                                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Thank you for registering with GSMStockmarket.com.</p>
                                                                                                    </td>
                                                                                            </tr>
                                                                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                                                            Plase find your pre-generated password: '.$password.'. Please log into your account and changed this as soon as possible.
                                                                                                    </td>
                                                                                            </tr>

                                                                                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                                                    <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                                                                                                            <a href="'.$base.'login" class="btn-primary" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #FFF;text-decoration: none;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;">Log into your account.</a>
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
                
                $cust_email = $this->input->post('email');
                $this->email->from('noreply@gsmstockmarket.com', 'GSMStockMarket.com');

                $list = array('tim@gsmstockmarket.com', 'signup@gsmstockmarket.com');
                $this->email->to($cust_email);
                $this->email->bcc($list);
                $this->email->subject('Thank you for registering.');
                $this->email->message($email_body);

                $this->email->send();
                //echo $this->email->print_debugger();
                //exit;
                    
                redirect('http://www.gsmstockmarket.com/success');
                
            }
    }
    
}