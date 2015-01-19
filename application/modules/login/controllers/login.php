<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller{

    function __construct()
    {

            parent::__construct();

    }
        
    function index()
    {                      
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
        
    function login_validation(){
        
        $this->load->library('form_validation');
        $this->load->model('member/member_model', 'member_model');
        
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

    function validate_user(){

            $this->load->model('member/member_model', 'member_model');
            
            if($this->member_model->canLogIn($this->input->post('username'), $this->input->post('password')) > 0){
                
                    $mid = $this->member_model->canLogIn();
                
                    $member = $this->member_model->get_where($mid);

                    $user_data = array(
                                                    'members_id'  	=> $mid,
                                                    //'username'  	=> $member->username,
                                                    'firstname'         => $member->firstname,
                                                    'lastname'         => $member->lastname,
                                                    'logged_in' 	=> TRUE
                                                    );

                    $this->session->set_userdata($user_data);

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
    
    function logout()
    {
        $this->session->unset_userdata('members_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');
        redirect('login');
    }
       
	
	

}
