<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MX_Controller{

	function __construct()
	{
		
		parent::__construct();
                $this->load->library('session');
		$this->load->model('activity/activity_model', 'activity_model');
                $this->load->model('member/member_model', 'member_model');
                $this->load->model('company/company_model', 'company_model');
                $this->load->model('country/country_model', 'country_model');
                
                $data = array(
                                'member_id' => ''
                            );
                
		
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
                                        'date'      => date('d-m-y'),
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
                                        ------ Team
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
                        
            $mid = $this->member_model->get_where_multiple('validation_code', $vcode);
            
            $data = array(
                            'validated' => 'yes',
                            'online_status' => 'online'
                          );            
            $this->member_model->_update($mid->id, $data);
            
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
                                                                    Thankyou. Your email has been validated and you account has been verified.
                                                                </div>
                                                            </div>');
            
            redirect('home/');
            
        }
        
    function csv_import()
    {
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
                                        'date'              => date('d-m-y'),
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
