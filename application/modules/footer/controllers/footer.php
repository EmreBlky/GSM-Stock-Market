<?php
class Footer extends MX_Controller 
{

	function __construct()
	{
		
		parent::__construct();
	
	}
	
	function index()
	{		
		
	}
        
	function main_footer()
	{		
		//$data['base_nav'] = $this->pages->get_where_multiples('bottom_navigation', 'yes');
                $data['base_nav'] = '';
                $this->load->model('login/login_model', 'login_model');
                $log_count  = $this->login_model->count_where('member_id', $this->session->userdata('members_id'), 'logged', 'yes');
                if($log_count > 0){
                    $data['log_count'] = $log_count;
                    $data['logged'] = $this->login_model->get_where_multiple('member_id', $this->session->userdata('members_id'), 'logged', 'yes');
                }
                else{
                   $data['log_count'] = 0;
                }
                
		
		$this->load->view('footer', $data);		
	}
        
	function post_footer()
	{		
		$this->load->view('post-footer');
	}
	
        function admin_main_footer()
	{		
		//$data['base_nav'] = $this->pages->get_where_multiples('bottom_navigation', 'yes');
                $data['base_nav'] = '';
		
		$this->load->view('admin-footer', $data);		
	}
	function admin_post_footer()
	{		
		$this->load->view('admin-post-footer');
	}
        
        function login_main_footer()
	{		
		//$data['base_nav'] = $this->pages->get_where_multiples('bottom_navigation', 'yes');
                $data['base_nav'] = '';
		
		$this->load->view('login-register-footer', $data);		
	}
        
	function login_post_footer()
	{		
		$this->load->view('login-register-post-footer');
	}
}