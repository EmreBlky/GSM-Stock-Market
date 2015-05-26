<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller{

    function __construct()
    {
        parent::__construct();
        
        $this->load->model('login/login_model', 'login_model');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('admin/admin_model', 'admin_model');
    }
        
    function index()
    { 
        
        if ($this->session->userdata('members_id') > 0)
        { 
            redirect('home');
        }
//        if ( $this->session->userdata('admin_logged_in'))
//        { 
//            redirect('admin');
//        }
        $data['base'] = $this->config->item('base_url');
        $data['message'] = '';
        $data['main'] = 'login';
        $data['title'] = 'Please Login';        
        $data['page'] = 'index';
        $this->load->module('templates');
        $this->templates->page($data);

    }
    
    
    
    function forgotten_password()
    {                      
        $data['base'] = $this->config->item('base_url');
        $data['message'] = '';
        $data['main'] = 'login';
        $data['title'] = 'Forgotten Password';        
        $data['page'] = 'forgotten-password';
        $this->load->module('templates');
        $this->templates->page($data);

    }
    
    function passwordResend()
    {
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        
        $base = $this->config->item('base_url');
        $email = $this->member_model->_custom_query_count("SELECT COUNT(*) AS count FROM members WHERE email = '".$this->input->post('email')."'");
        
        if($email[0]->count > 0){
            
            $password = random_string('alnum', 8);
            $validation_code = random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4);

            
            $mid = $this->member_model->get_where_multiple('email', $this->input->post('email'))->id;            
            
            $data = array( 
                        'validation_code' => $validation_code,
                        'reset_password' => md5($password),
                        'reset_unhash_password' => $password
                    );
            
            $this->member_model->_update($mid, $data);
            
            $this->session->set_flashdata('title', 'success');
            $this->session->set_flashdata('message', 'Your password reset request has been sent. You should receive an email shortly.');
            
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
                            <img class="img-responsive" src="'.$base.'public/main/template/gsm/images/email/header.png" style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;max-width: 100%;">
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">Dear '.$this->member_model->get_where($mid)->firstname.',</p>
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">You have requested a password reset for Email: '.$this->input->post('email').'.</p>
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;"></p>
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If this is correct, please <a href="'.$this->config->item('base_url').'register/reset/'.$validation_code.'">CLICK HERE</a> to reset your password.</p>
                            </td>
                            </tr>
                            <tr style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;">
                            <td class="content-block aligncenter" style="margin: 0;padding: 0 0 20px;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;vertical-align: top;">
                            <p style="margin: 0;padding: 0;font-family: &quot;Helvetica Neue&quot;, &quot;Helvetica&quot;, Helvetica, Arial, sans-serif;box-sizing: border-box;font-size: 14px;margin-bottom: 10px;font-weight: normal;">If this is not correct, please ignore this email. You account has not been modified.</p>
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


            $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket Support Team');

            //$list = array('info@imarveldesign.co.uk');
            $this->email->to($this->input->post('email'));
            $this->email->subject('GSM Forgotten Password');
            $this->email->message($email_body);

            $this->email->send();
            
            //echo $this->email->print_debugger();

            redirect('login/forgotten_password');
           
        }
        else{
            
            $this->session->set_flashdata('title', 'error');
            $this->session->set_flashdata('message', 'That email address has not been recognised. Please try again.');

            redirect('login/forgotten_password');
        }
            
    }
            
    function login_validation(){
        
        $this->load->library('form_validation');
        
        
        $this->form_validation->set_rules('username', 'Username', 'xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'xss_clean');
        
        if($this->member_model->canLogIn($this->input->post('username'), $this->input->post('password')) > 0){
                
            $mid = $this->member_model->canLogIn();

            $member = $this->member_model->get_where($mid);
        
            if($member->validated == 'no'){
                
                $data['base'] = $this->config->item('base_url');
                $data['main'] = 'login';
                $data['title'] = 'Login - Please Validate Email';        
                $data['page'] = 'index';
                $data['error'] = '<h2>Please validate your email by clicking on the validate link you recieved in your email. If you would like a new one sent, please click here.<h2>';
                $this->load->module('templates');
                $this->templates->page($data);
                return FALSE;

            }
            else{
                

                if($this->form_validation->run()){                

                    $this->validate_user();

                }else{
                        $data['base'] = $this->config->item('base_url');
                        $data['main'] = 'login';
                        $data['title'] = 'Login Error';        
                        $data['page'] = 'index';
                        $data['error'] = '<h2>THERE HAS BEEN AN ERROR! Please try again.</h2>';
                        $this->load->module('templates');
                        $this->templates->page($data);
                } 
            }
        }
        else{
                $data['base'] = $this->config->item('base_url');
                $data['main'] = 'login';
                $data['title'] = 'Login Error';        
                $data['page'] = 'index';
                $data['error'] = '<h2>Username and (or) Password invalid. Please try again.</h2>';
                $this->load->module('templates');
                $this->templates->page($data);
        }
    }
    
    function admin_login_validation()
    {
        $this->load->library('form_validation');        
        
        $this->form_validation->set_rules('username', 'Username', 'xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'xss_clean');
        
        if($this->admin_model->canLogIn($this->input->post('username'), $this->input->post('password')) > 0){

                $aid = $this->admin_model->canLogIn();

                if($this->form_validation->run()){                

                        $this->validate_admin();

                    }else{
                            $data['base'] = $this->config->item('base_url');                            
                            $data['error'] = '<h2>THERE HAS BEEN AN ERROR! Please try again.</h2>';
                            $data['main'] = 'admin';
                            $data['title'] = 'Admin - Please Login';        
                            $data['page'] = 'login';
                            $this->load->module('templates');
                            $this->templates->admin($data);
                    } 
                //}
            }
            else{
                    $data['base'] = $this->config->item('base_url');
                    $data['error'] = '<h2>Admin Username and (or) Password invalid. Please try again.</h2>';
                    $data['main'] = 'admin';
                    $data['title'] = 'Admin - Please Login';        
                    $data['page'] = 'login';
                    $this->load->module('templates');
                    $this->templates->admin($data);
            }
    }
    
    
    function validate_user(){
            
            if($this->member_model->canLogIn($this->input->post('username'), $this->input->post('password')) > 0){
                
                    $mid = $this->member_model->canLogIn();
                
                    $member = $this->member_model->get_where($mid);
                    
                    $data = array(
                                    'online_status' => 'online'
                                  );
                    $this->member_model->_update($mid, $data);

                    $user_data = array(
                                                    'members_id'  	=> $mid,
                                                    'membership'  	=> $member->membership,
                                                    'terms'             => $member->terms_conditions,
                                                    'firstname'         => $member->firstname,
                                                    'lastname'          => $member->lastname,
                                                    'logged_in' 	=> TRUE
                                                    );
                    
                    $this->session->set_userdata($user_data);
                    
                    $this->login_model->_delete_where('member_id', $mid, 'logged', 'yes');
                    
                    $data = array(
                                      'logged' => 'yes'
                                     );
                    $this->login_model->_update_where($data, 'logged', 'no', 'member_id', $mid);
                    
                    $data = array(
                                        'member_id' => $mid,
                                        'time' => date('H:i:s'),
                                        'date' => date('d-m-Y'),
                                        'ip_address' => $_SERVER['REMOTE_ADDR'],
                                        'logged' => 'no'
                                     );
                    $this->login_model->_insert($data);

                    redirect('home/');
            }
            else {

                    $data['base'] = $this->config->item('base_url');
                    $data['main'] = 'login';
                    $data['title'] = 'Login Error';        
                    $data['page'] = 'index';
                    $data['error'] = '<h2>That username has not been recognised. Please register HERE.</h2>';
                    $this->load->module('templates');
                    $this->templates->page($data);

            }

    }
        
    function validate_admin(){
        
//        echo '<pre>';
//        print_r($_POST);
//        exit;
            
            if($this->admin_model->canLogIn($this->input->post('username'), $this->input->post('password')) > 0){
                
                    $aid = $this->admin_model->canLogIn();
                
                    $admin = $this->admin_model->get_where($aid);
                    
                    $admin_data = array(
                                                    'admin_members_id'  	=> $aid,
                                                    'members_id'                => 4,
                                                    //'membership'                => 2,
                                                    'authority'                 => $admin->authority,
                                                    'admin_firstname'           => $admin->firstname,
                                                    'admin_lastname'            => $admin->lastname,
                                                    'logged_in'                 => TRUE,
                                                    'admin_logged_in'           => TRUE
                                                    );

                    $this->session->set_userdata($admin_data);
                    
                    redirect('admin/dashboard');
            }
            else {

                    $data['base'] = $this->config->item('base_url');
                    $data['error'] = '<h2>Username and (or) Password invalid. Please try again.</h2>';
                    $data['main'] = 'admin';
                    $data['title'] = 'Admin - Please Login';        
                    $data['page'] = 'login';
                    $this->load->module('templates');
                    $this->templates->admin($data);

            }

    }
    
    function logout()
    {
        $mid = $this->session->userdata('members_id');
        
        if($mid > 4){
            $data = array(
                            'online_status' => 'offline'
                          );
            $this->member_model->_update($mid, $data);
        }
        $this->session->unset_userdata('members_id');
        $this->session->unset_userdata('terms'); 
        $this->session->unset_userdata('membership');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('online_status');
        
        $this->session->unset_userdata('admin_logged_in');
        $this->session->unset_userdata('admin_firstname');
        $this->session->unset_userdata('admin_lastname');
        redirect('login');
    }
    
    function auto_logout()
    {
        $this->load->model('activity/activity_model', 'activity_model');
        
        $log_out = $this->activity_model->_custom_query("SELECT member_id FROM activity WHERE time < '".date('H:i:s', strtotime('-1 hour'))."'");        
        
        foreach ($log_out as $log){
            
            $data = array(
                        'online_status' => 'offline'
                      );
            $this->member_model->_update($log->member_id, $data);
        }        
        
    }
    
    function admin_logout()
    {
        $this->session->unset_userdata('admin_logged_in');
        $data = array(
                        'online_status' => 'offline'
                      );
        $this->member_model->_update(5, $data);
        
        $this->session->unset_userdata('members_id');
        $this->session->unset_userdata('membership');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('online_status');
        redirect('admin/login');
    }
    
    function resend($email)
    {
        $code = $this->member_model->get_where_multiple('email', $email)->validation_code;
        
        echo $code;
    }
    
    
}
