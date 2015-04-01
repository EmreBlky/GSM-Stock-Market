<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        
        $this->load->model('company/company_model', 'company_model');
    }

    function index()
    {
        $this->load->model('activity/activity_model', 'activity_model');
        $data_activity = array(
                                'activity' => 'Company',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'company';
        $data['title'] = 'GSM - Company';        
        $data['page'] = 'index';
        
        $data['list_company'] = $this->company_model->get_all();
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function who_viewed()
    {
        $data['main'] = 'company';        
        $data['title'] = 'GSM - Who Has Viewed';        
        $data['page'] = 'whos-viewed';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function viewed_company()
    {
        $data['main'] = 'company';        
        $data['title'] = 'GSM - Viewed Companies';        
        $data['page'] = 'view-company';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function edit_company()
    {
        $data['main'] = 'company';        
        $data['title'] = 'GSM - Edit Company Details';        
        $data['page'] = 'edit-company';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }	
    
    function admin_companybio_count()
    {
        $count = $this->company_model->_custom_query_count('SELECT COUNT(*) AS count FROM company WHERE company_profile_approval != ""');
        
        if($count[0]->count > 0){
            echo '<span class="label label-warning pull-right">'.$count[0]->count.'</span>';            
        }
       
        
    }
	
}