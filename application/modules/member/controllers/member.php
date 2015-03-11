<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        //$this->load->helper('security');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('country/country_model', 'country_model');
        
        $this->load->model('activity/activity_model', 'activity_model');
        
        $data_activity = array(
                                'activity' => 'Member',
                                'time' => date('H:i:s')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
    }

    function index()
    {
        $data['main'] = 'member';        
        $data['title'] = 'GSM - Home';        
        $data['page'] = 'index';
        $data['list_member'] = $this->member_model->get_all();

        $this->load->module('templates');
        $this->templates->page($data);        
    }
    function profile($pid)
    {
        $this->load->model('viewed/viewed_model', 'viewed_model');
        
        $this->viewed_model->_delete_where('viewed_id' ,$pid, 'viewer_id', $this->session->userdata('members_id'));
        
        $data = array(
                    'viewed_id' => $pid,
                    'viewer_id' => $this->session->userdata('members_id'),
                    'time' => date('H:i:s'),
                    'date' => date('d-m-Y'),
                    'datetime' => date('d-m-Y H:i:s'),
                    );
        
        $this->viewed_model->_insert($data);
        
        $data['base'] = $this->config->item('base_url');
        $data['main'] = 'member';        
        $data['title'] = 'GSM - Members Page';        
        $data['page'] = 'profile';
        $data['member_info'] = $this->member_model->get_where($pid);
        $data['member_company'] = $this->company_model->get_where($this->member_model->get_where($pid)->company_id);

        $this->load->module('templates');
        $this->templates->page($data); 
    }
    
}
