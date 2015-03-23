<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MX_Controller{

    function __construct()
    {
        parent::__construct();
        
        if ($this->session->userdata('logged_in'))
        { 
            redirect('home');
        }
        
        $this->load->model('login/login_model', 'login_model');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('admin/admin_model', 'admin_model');
    }
        
    function index()
    { 
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
                                                    //'username'  	=> $member->username,
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
                                                    'members_id'  	=> $aid,
                                                    //'username'  	=> $member->username,
                                                    'firstname'         => $admin->firstname,
                                                    'lastname'          => $admin->lastname,
                                                    'admin_logged_in' 	=> TRUE
                                                    );

                    $this->session->set_userdata($admin_data);
                    
                    redirect('admin/');
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
                
        $data = array(
                        'online_status' => 'offline'
                      );
        $this->member_model->_update($mid, $data);
        
        $this->session->unset_userdata('members_id');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('logged_in');
        $this->session->unset_userdata('online_status');
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
        redirect('admin/login');
    }
    
    
}
