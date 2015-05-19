<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MX_Controller{

    function __construct()
    {

            parent::__construct();
            $this->load->library('session');
            $this->load->model('activity/activity_model', 'activity_model');
            $this->load->model('mailbox/mailbox_model', 'mailbox_model');
            $this->load->model('member/member_model', 'member_model');
            $this->load->model('company/company_model', 'company_model');
            $this->load->model('country/country_model', 'country_model');

    }

    function index()
    {
        $data['base'] = $this->config->item('base_url');
        $data['query'] = '';
        $data['main'] = 'register';        
        $data['title'] = 'Please Register';        
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);

    }

    function validate(){

        $this->load->helper('string');

        $email_add = $this->input->post('email');
        $password = $this->input->post('password');
        $cpassword = $this->input->post('c_password');            


        $result = $this->member_model->get_where_multiple('email', $email_add);

        if($result){

            if ($result->id > 0)
            {
                $data['base'] = $this->config->item('base_url');
                $data['error'] = '<h2>That email is already in use. Please <a href="login">CLICK HERE</a> to login.</h2>';
                $data['main'] = 'register';        
                $data['title'] = 'Register - Email in Use';        
                $data['page'] = 'index';
                $this->load->module('templates');
                $this->templates->page($data);
                return FALSE;
            }
            else
            {                
                return TRUE;
            }
        }

        if($password == $cpassword){

            $this->load->library('form_validation');		            

            $this->form_validation->set_rules('firstname', 'First Name', 'xss_clean');
            $this->form_validation->set_rules('lastname', 'Last Name', 'xss_clean');
//                $this->form_validation->set_rules('username', 'Username', 'xss_clean');
//                $this->form_validation->set_rules('add_1', 'Address 1', 'xss_clean');
//                $this->form_validation->set_rules('add_2', 'Address 2', 'xss_clean');
//                $this->form_validation->set_rules('city', 'City', 'xss_clean');
//                $this->form_validation->set_rules('county', 'County', 'xss_clean');
//                $this->form_validation->set_rules('postcode', 'Postcode', 'xss_clean');
//                $this->form_validation->set_rules('country', 'Country', 'xss_clean');
//                $this->form_validation->set_rules('phone', 'Phone', 'xss_clean');
//                $this->form_validation->set_rules('mobile', 'Mobile', 'xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'xss_clean');
            $this->form_validation->set_rules('c_password', 'Confirm Password', 'xss_clean');

                if($this->form_validation->run()){

                    $validation_code = random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4);

                    $data = array(
                                    'firstname' => $this->input->post('firstname'),
                                    'lastname'  => $this->input->post('lastname'),
//                                        'username'  => $this->input->post('username'),
//                                        'add_1'     => $this->input->post('add_1'),
//                                        'add_2'     => $this->input->post('add_2'),
//                                        'city'      => $this->input->post('city'),
//                                        'county'    => $this->input->post('county'),
//                                        'postcode'  => $this->input->post('postcode'),
//                                        'country'   => $this->input->post('country'),
//                                        'phone'     => $this->input->post('phone'),
//                                        'mobile'    => $this->input->post('mobile'),
                                    'email'     => $this->input->post('email'),
                                    'validation_code' => $validation_code,
                                    'date'      => date('d-m-Y'),
                                    'date_activated'      => date('Y-m-d'),
                                    'password' => md5($this->input->post('password'))
                                  );


                    $mid = $this->member_model->_insert($data);

                    $this->activity_model->_insert($data);
                    $data_activity = array(
                                'member_id' => $mid
                                );
                    $this->activity_model->_insert($data_activity);

                    $config = array (
                        'mailtype' => 'html',
                        'charset'  => 'utf-8',
                        'priority' => '1'
                     );

                    $this->load->library('email', $config);

                    $this->email->from('noreply@gsmstockmarket.com');			
                    $to = $this->input->post('email');
                    $this->email->to($to);
                    $this->email->subject('Registration Complete');		

                    $body = '
                                    Dear '.$this->input->post('firstname').',
                                    <br/>                                        
                                    <br/>
                                    <br/>
                                    Email: '.$this->input->post('email').'
                                    <br/>
                                    <br/>                                        
                                    Please <a href="'.$this->config->item('base_url').'register/confirm/'.$validation_code.'">CLICK HERE</a> to validate your email.
                                    <br/>
                                    <br/>
                                    Many Thanks,<br/><br/>
                                    GSMStockMarket.com Team
                                    ';

                    $this->email->message($body);

                    $this->email->send();

                    //echo $this->email->print_debugger();
                    //exit;

                    $this->session->set_flashdata('message', '<h2>Thank you. You will receive an email shortly</h2>');

                    redirect('register');

            }

        }
        else{

            $data['base'] = $this->config->item('base_url');
            $data['error'] =  '<h2>Passwords do not match. Please try again.</h2>';
            $data['main'] = 'register';        
            $data['title'] = 'Register - Password Missmatch';        
            $data['page'] = 'index';
            $this->load->module('templates');
            $this->templates->page($data);
        }

    }

    function country($name)
    {
        $name = str_replace('United States of America', 'United States', $name);

        return $name;
    }

    function confirm($vcode)
    {
        $base = $this->config->item('base_url');            
        $mid = $this->member_model->get_where_multiple('validation_code', $vcode);

        $data = array(
                        'validated' => 'yes',
                        'online_status' => 'online'
                      );            
        $this->member_model->_update($mid->id, $data);

        $data_activity = array(
                            'member_id' => $mid->id
                        );
        $this->activity_model->_insert($data_activity);

        $data_mail = array(
                                'member_id'         => 5,
                                'sent_member_id'    => $mid->id,
                                'subject'           => 'Welcome to GSMStockMarket.com',
                                'body'              => 'Thank you for signing up to GSMStockMarket.com<br /><br/>Your account is now fully active and you have your bronze membership. To get started head over to <strong>My Profile > Edit Profile</strong> and complete your profile so other users will be able to search and find your company.<br /><br/>With bronze access you will receive the following:<br />- View and edit your own profile<br />- Check out who has viewed your profile<br />- Reply to members who contact you via the mailbox system<br />- Add users to your address book/favourites<br /><br />We currently have a new feature called <strong>IMEI services</strong> which all bronze members will have access to. This feature will let you use our unlocking services and IMEI blacklist check, ensuring all mobile phones bought and sold are not reported missing or stolen. This feature will be available shortly.<br /><br />If you have any issues using our website feel free to contact us through the submit a ticket system under the support tab. <br /><br />if you also experience any issues browsing/using the website or would like to have any features added then let us know! We would love to hear from you, just submit a feedback ticket and we will do our best to help you out.<br /><br />Kind Regards,<br />GSMStockMarket.com Team',
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
                        <h3 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Your account is now activated!</h3>
                        </td>
                        </tr>
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                        <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Welcome '.$mid->firstname.',</p>
                        <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Login now to access your account and start using the platform.<p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;"></p>
                        </p><p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Remember to complete your personal and company profile contact details information, upload your logos and images and ensure all your business trading sectors are completed, this will help other members get a better understanding about your business and start generating more enquiries from new suppliers and customers.</p>
                        </td>
                        </tr>
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                        <h3 style="margin-top: 0;margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Your Password is</h3>
                        <p class="btn-success" style="cursor: none !importnat;margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: bold;text-decoration: none;color: #FFF;background-color: #1c84c6;border: solid #1c84c6;border-width: 5px 10px;line-height: 2;text-align: center;display: inline-block;">'.$mid->unhash_password.'</p>
                        </td>
                        </tr>
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                        <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">To access your account visit <a href="'.$base.'login" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #1ab394;text-decoration: underline;">'.$base.'login</a> and sign in with your email on signup and the password given to you above.</p>
                        </td>
                        </tr>
                        <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                        <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                        <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If you need any assistance please call us on +44 (0)1494 717321 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
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

        $this->email->from('noreply@gsmstockmarket.com', 'GSMStockMarket.com');

        $list = array('tim@gsmstockmarket.com', 'signup@gsmstockmarket.com');
        $this->email->to($mid->email);
        $this->email->bcc($list);
        $this->email->subject('Your account has been verified');
        $this->email->message($email_body);

        $this->email->send();

        $data_cust = array(
                            'validation_code' => '',
                            'unhash_password' => ''
                        );

        $this->member_model->_update($mid->id, $data_cust);

        $user_data = array(
                            'members_id'  	=> $mid->id,
                            //'username'  	=> $member->username,
                            'firstname'     => $mid->firstname,
                            'lastname'      => $mid->lastname,
                            'logged_in' 	=> TRUE
                            );

        $this->session->set_userdata($user_data);
        $this->session->set_flashdata('confirm-login', '<div style="margin:15px 15px -30px;">    
                                                            <div class="alert alert-success">
                                                                Your registration has been completed! We have emailed you your password. We advise changing it for added security.
                                                            </div>
                                                        </div>');

        redirect('home/');

    }

    function reset($vcode)
    {
       $base = $this->config->item('base_url'); 
       $v_count = $this->member_model->count_where('validation_code', $vcode);
       
        if($v_count > 0){
            
                        
            $mid = $this->member_model->get_where_multiple('validation_code', $vcode);

            $new_password = $this->member_model->get_where_multiple('validation_code', $vcode)->reset_password;
            $new_unhas_password = $this->member_model->get_where_multiple('validation_code', $vcode)->reset_unhash_password;
            /*
            $data = array(
                            'validated' => 'yes',
                            'online_status' => 'online'
                          );            
            $this->member_model->_update($mid->id, $data);

            $data_activity = array(
                                'member_id' => $mid->id
                            );
            $this->activity_model->_insert($data_activity);

            $data_mail = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mid->id,
                                    'subject'           => 'Password Reset Request',
                                    'body'              => 'Thank you for signing up to GSMStockMarket.com<br /><br/>Your account is now fully active and you have your bronze membership. To get started head over to <strong>My Profile > Edit Profile</strong> and complete your profile so other users will be able to search and find your company.<br /><br/>With bronze access you will receive the following:<br />- View and edit your own profile<br />- Check out who has viewed your profile<br />- Reply to members who contact you via the mailbox system<br />- Add users to your address book/favourites<br /><br />We currently have a new feature called <strong>IMEI services</strong> which all bronze members will have access to. This feature will let you use our unlocking services and IMEI blacklist check, ensuring all mobile phones bought and sold are not reported missing or stolen. This feature will be available shortly.<br /><br />If you have any issues using our website feel free to contact us through the submit a ticket system under the support tab. <br /><br />if you also experience any issues browsing/using the website or would like to have any features added then let us know! We would love to hear from you, just submit a feedback ticket and we will do our best to help you out.<br /><br />Kind Regards,<br />GSMStockMarket.com Team',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
                        $this->mailbox_model->_insert($data_mail);
            */

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
                            <img class="img-responsive" src="'.$base.'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <h3 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Your password has been reset!</h3>
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.$mid->firstname.',</p>
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Please use the below password to log into your account.<p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;"></p>
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;text-align: center;">
                            <h3 style="margin-top: 0;margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Your Password is</h3>
                            <p class="btn-success" style="cursor: none !importnat;margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: bold;text-decoration: none;color: #FFF;background-color: #1c84c6;border: solid #1c84c6;border-width: 5px 10px;line-height: 2;text-align: center;display: inline-block;">'.$new_unhas_password.'</p>
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">To access your account visit <a href="'.$base.'login" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #1ab394;text-decoration: underline;">'.$base.'login</a> and sign in with your email on signup and the password given to you above.</p>
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If you need any assistance please call us on +44 (0)1494 717321 or use the online ticketing customer support within your account and we’ll be happy to help you.</p>
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

            $this->email->from('noreply@gsmstockmarket.com', 'GSMStockMarket.com');

            $list = array('tim@gsmstockmarket.com', 'signup@gsmstockmarket.com');
            $this->email->to($mid->email);
            $this->email->bcc($list);
            $this->email->subject('Your account has been verified');
            $this->email->message($email_body);

            $this->email->send();

            $data_cust = array(
                                'validation_code' => '',
                                'password' => $new_password,
                                'reset_password' => '',
                                'reset_unhash_password' => ''
                            );

            $this->member_model->_update($mid->id, $data_cust);

            $user_data = array(
                                'members_id'  	=> $mid->id,
                                //'username'  	=> $member->username,
                                'firstname'     => $mid->firstname,
                                'lastname'      => $mid->lastname,
                                'logged_in' 	=> TRUE
                                );

            $this->session->set_userdata($user_data);
            $this->session->set_flashdata('confirm-login', '<div style="margin-top: 15px; margin-left: 10px;">    
                                                                <div class="alert alert-success">
                                                                    We have emailed you your new password.
                                                                </div>
                                                            </div>');

            redirect('home/');            
        }
        else{
            echo 'That validation code is not recognised/ Has already been confirmed. <a href="'.$base.'home/">BACK</a>';
        }
    }
        
    function csv_import()
    {
        $base = $this->config->item('base_url');
        $handle = fopen('public/main/template/gsm/files/gsm_customers.csv', "r");

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {  
            
            $phone_number      = $data[19];
            $mobile_number     = $data[18];
            $language          = $data[16];
            $facebook          = $data[12];
            $twitter           = $data[26];
            $gplus             = $data[13];
            $linkedin          = $data[17];
            $skype             = $data[24];
            $role              = $data[22];
            $email             = $data[1];
            $address_line_1    = $data[3];
            $address_line_2    = $data[4];
            $town_city         = $data[25];
            $county            = $data[11];
            $post_code         = $data[21];
            $country           = $this->country($data[10]);
            $company_name      = $data[8];
            $phone_number      = $data[19];
            $mobile_number     = $data[18];
            $other_business    = $data[20];
            $vat_tax           = $data[27];
            $company_number    = $data[9];
            $website           = $data[28];
            
            if($country != ''){
                $country = $this->country_model->get_where_multiple('country', $country)->id;
            }
            else{
                $country = 225;
            }
            
            if($language != ''){
                $language = $this->language_model->get_where_multiple('language', $language)->id;
            }
            else{
                $language = 276459;
            }
           
            $duplicate = $this->member_model->get_where_multiple('email', $data[1])->id;
            
            if($data[0] != '' && $duplicate < 1){
                
                $name = explode(' ', $data[0]);
                
                $validation_code = random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4);
                $password = random_string('alnum', 8);
                        $data = array(
                                        'firstname'         => $name[0],
                                        'lastname'          => $name[1].' '.$name[2].' '.$name[3],
                                        'username'          => '',
                                        'email'             => $email,
                                        'date'              => date('d-m-Y'),
                                        'date_activated'    => date('Y-m-d'),
                                        'password'          => md5($password),
                                        'unhash_password'   => $password,
                                        'validation_code'   => $validation_code,
                                        'title'             => '',
                                        'phone_number'      => $phone_number,
                                        'mobile_number'     => $mobile_number,
                                        'language'          => $language,
                                        'facebook'          => $facebook,
                                        'twitter'           => $twitter,
                                        'gplus'             => $gplus,
                                        'linkedin'          => $linkedin,
                                        'skype'             => $skype,
                                        'role'              => $role,
                                        'membership'        => 1
                                      );
                        
                        $mid = $this->member_model->_insert($data);
                        
                        $business = explode('||', $data[5]);
                        
                        $data = array(
                                        'admin_member_id'       => $mid,
                                        'address_line_1'        => $address_line_1,
                                        'address_line_2'        => $address_line_2,
                                        'town_city'             => $town_city,
                                        'county'                => $county,
                                        'post_code'             => $post_code,
                                        'country'               => $country,
                                        'company_name'          => $company_name,
                                        'phone_number'          => $phone_number,
                                        'mobile_number'         => $mobile_number,
                                        'business_sector_1'     => $business[0],
                                        'business_sector_2'     => $business[1],
                                        'business_sector_3'     => $business[2],
                                        'other_business'        => $other_business,
                                        'vat_tax'               => $vat_tax,
                                        'company_number'        => $company_number,
                                        'website'               => $website,
                                        'company_profile'       => ''
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
                                                                        <h3 style="margin: 40px 0 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, Helvetica, Arial, &quot;Lucida Grande&quot;, sans-serif;box-sizing: border-box;font-size: 18px;color: #000;line-height: 1.2;font-weight: 400;">Thank you for signing up to GSMStockMarket.com</h3>
                                                                    </td>
                                                                </tr>
                                                                <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                                                                    <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                                                                        <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.$name[0].',</p>
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
                                                                        <a href="'.$base.'register/confirm/'.$validation_code.'" class="btn-primary" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;color: #FFF;text-decoration: none;background-color: #1ab394;border: solid #1ab394;border-width: 5px 10px;line-height: 2;font-weight: bold;text-align: center;cursor: pointer;display: inline-block;border-radius: 5px;text-transform: capitalize;">Activate my account</a>
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

                        $list = array('tim@gsmstockmarket.com', 'signup@gsmstockmarket.com');
                        $this->email->to($email);
                        $this->email->bcc($list);
                        $this->email->subject('Please verify your account.');
                        $this->email->message($email_body);

                        $this->email->send();
            }
            unset($phone_number);
            unset($mobile_number);
            unset($language);
            unset($facebook);
            unset($twitter);
            unset($gplus);
            unset($linkedin);
            unset($skype);
            unset($role);
            unset($email);
            unset($address_line_1);
            unset($address_line_2);
            unset($town_city);
            unset($county);
            unset($post_code);
            unset($country);
            unset($company_name);
            unset($phone_number);
            unset($mobile_number);
            unset($other_business);
            unset($vat_tax);
            unset($company_number);
            unset($website);
        }
        
        fclose($handle);
    }
	
	
	

}
