<?php
class Admin extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel';        
        $data['page'] = 'dashboard';
        
//        $var = 'member';
//        $var_model = $var.'_model';
//        
//        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
//        $data['test'] = $this->{$var_model}->get_all();

        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_dashboard()
    {
        $this->load->view('dashboard');
	
    }
    
    function add_company()
    {
        $data['page'] = 'add-company';

        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_add_company()
    {
        $this->load->view('add-company');
	
    }
    
    function bulk_import()
    {
        $data['page'] = 'bulk-import';

        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_bulk_import()
    {
        $this->load->view('bulk-import');
	
    }
    
    function export()
    {
        $data['page'] = 'export';

        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_export()
    {
        $this->load->view('export');
	
    }
	
}