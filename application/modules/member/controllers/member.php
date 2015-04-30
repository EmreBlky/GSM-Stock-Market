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
        $this->load->model('viewed/viewed_model', 'viewed_model');
        
        
    }

    function index()
    {
        if($this->session->userdata('members_id') != 5){
            redirect('home/');
        }
        $data['main'] = 'member';        
        $data['title'] = 'GSM - Home';        
        $data['page'] = 'index';
        $data['list_member'] = $this->member_model->get_all();

        $this->load->module('templates');
        $this->templates->page($data);        
    }
    function profile($pid)
    {
//        if ($this->session->userdata('membership') < 2)
//        { 
//            redirect('home');
//        }
        
        $viewing_profile = $this->session->userdata('members_id');
        if($viewing_profile != 5){
            //$this->viewed_model->_delete_where('viewed_id' ,$pid, 'viewer_id', $this->session->userdata('members_id'));

            $data = array(
                        'viewed_id' => $pid,
                        'viewer_id' => $this->session->userdata('members_id'),
                        'time' => date('H:i:s'),
                        'date' => date('d-m-Y'),
                        'datetime' => date('d-m-Y H:i:s'),
                        'record_date' => date('Y-m-d H:i:s')
                        );

            $this->viewed_model->_insert($data);
            }
            $data['base'] = $this->config->item('base_url');
            $data['main'] = 'member';        
            $data['title'] = 'GSM - Members Page';        
            $data['page'] = 'profile';
            $data['member_info'] = $this->member_model->get_where($pid);
            $data['member_company'] = $this->company_model->get_where($this->member_model->get_where($pid)->company_id);
            $this->load->model('block/block_model', 'block_model');
            $data['blocked'] = $this->block_model->get_where_multiples('member_id', $this->session->userdata('members_id'), 'block_member_id', $pid);

                    /* Daniel Added Start */
            $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));

                    /* Daniel Added End */

            $this->load->module('templates');
            $this->templates->page($data); 
        
    }
    
    function email_activation()
    {
        $lists = $this->member_model->get_where_multiples('validated', 'no');
        
        foreach ($lists as $list){
            echo $list->id.'<br/>';
        }
    }
    
    function email_profile()
    {
        $lists = $this->member_model->_custom_query("SELECT * FROM members WHERE profile_completion < 100");
        
        foreach ($lists as $list){
            echo $list->id.'<br/>';
        }
    }
    
}
