<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends MX_Controller{

	function __construct()
	{
		
		parent::__construct();
                $this->load->library('session');
		
		
	}
        
        function index()
	{
            $data['base'] = $this->config->item('base_url');
            $data['query'] = '';
            $data['page'] = 'index';
            $this->load->module('templates');
            $this->templates->register($data);
            
	}
        
	function validate(){
            
            $this->load->helper('string');
            
            $email_add = $this->input->post('email');
            $password = $this->input->post('password');
            $cpassword = $this->input->post('c_password');            
            
            $this->load->model('member/member_model', 'member_model');
            $result = $this->member_model->get_where_multiple('email', $email_add);
            
            if($result){

                if ($result->id > 0)
                {
                    $data['base'] = $this->config->item('base_url');
                    $data['error'] = '<h2>That email is already in use. Please <a href="login">CLICK HERE</a> to login.</h2>';
                    $data['page'] = 'index';
                    $this->load->module('templates');
                    $this->templates->register($data);
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

                        $this->load->model('member/member_model', 'member_model');
                        $this->member_model->_insert($data);
                        
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
                                        Email: '.$this->input->post('email').'<br/>
                                        Username: '.$this->input->post('username').'<br/><br/>
                                        Please <a href="'.$this->config->item('base_url').'register/confirm/'.$validation_code.'">CLICK HERE</a> to validate your email.
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
                $data['page'] = 'index';
                $this->load->module('templates');
                $this->templates->register($data);
            }
            
        }
        
        function confirm($vcode){
            
        }
	
	
	

}
