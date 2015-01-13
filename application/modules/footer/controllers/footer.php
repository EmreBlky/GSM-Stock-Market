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