<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('viewed/viewed_model', 'viewed_model');
    }

    function index()
    {
        $data['main'] = 'profile';        
        $data['title'] = 'GSM - Profile';        
        $data['page'] = 'index';
        
        $cid = $this->member_model->get_where_multiple('id', $this->session->userdata('members_id'))->company_id;
        $data['member_info'] = $this->member_model->get_where_multiple('id', $this->session->userdata('members_id'));
        $data['company_users'] = $this->member_model->get_where_multiples('company_id', $cid);
        $data['member_company'] = $this->company_model->get_where_multiple('id', $cid);
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function send_message($mid)
    {
        
        $data['member_info'] = $this->member_model->get_where_multiple('id', $mid);
        $data['member_company'] = $this->company_model->get_where_multiple('id', $this->member_model->get_where_multiple('id', $mid)->company_id);
        
        $this->load->view('send-message', $data);
    }
    
    function who_viewed_count()
    {
        $viewed_count = $this->viewed_model->_custom_query_count("SELECT COUNT(DISTINCT viewer_id) AS 'viewed' FROM gsmstock_secure.viewed WHERE viewed_id = '".$this->session->userdata('members_id')."' AND notified = 'no'");

        foreach ($viewed_count as $viewed){
            $viewed = $viewed->viewed;
        }
        
        if($viewed > 0){
            
            echo '<span class="label label-primary pull-right">'.$viewed.'</span>';
        }
    }
            
    function who_viewed()
    {
        $data['main'] = 'profile';        
        $data['title'] = 'GSM - Whos Viewed Profile';        
        $data['page'] = 'whos-viewed';
        
        $datas = array(
                        'notified' => 'yes'
                      );
        $this->viewed_model->_update_where($datas, 'viewed_id', $this->session->userdata('members_id'), 'notified', 'no');
//        
        //$data['viewed'] = $this->viewed_model->get_where_multiples('viewed_id', $this->session->userdata('members_id'));
        $data['viewed'] = $this->viewed_model->_custom_query("SELECT DISTINCT viewer_id FROM gsmstock_secure.viewed WHERE viewed_id = '".$this->session->userdata('members_id')."' ORDER BY datetime DESC");
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function viewed_profile()
    {
        $data['main'] = 'profile';        
        $data['title'] = 'GSM - Viewed Profiles';        
        $data['page'] = 'view-profile';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function edit_profile()
    {
        $this->load->model('member/member_model', 'member_model');
        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
        $data['company'] = $this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id);
        
        $data['main'] = 'profile';        
        $data['title'] = 'GSM - Edit Profile';        
        $data['page'] = 'edit-profile';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function profileEdit(){
        
        $this->load->library('form_validation');		            
            
                $this->form_validation->set_rules('email', 'Email', 'xss_clean');
                $this->form_validation->set_rules('title', 'Title', 'xss_clean');
                $this->form_validation->set_rules('firstname', 'First Name', 'xss_clean');
                $this->form_validation->set_rules('lastname', 'Surname', 'xss_clean');
                $this->form_validation->set_rules('company_name', 'Company Name', 'xss_clean');
                $this->form_validation->set_rules('phone_number', 'Phone Number', 'xss_clean');
                $this->form_validation->set_rules('mobile_number', 'Mobile Number', 'xss_clean');
                $this->form_validation->set_rules('address_line_1', 'Address Line 1', 'xss_clean');
                $this->form_validation->set_rules('address_line_2', 'Address Line 2', 'xss_clean');
                $this->form_validation->set_rules('town_city', 'City', 'xss_clean');
                $this->form_validation->set_rules('county', 'County', 'xss_clean');
                $this->form_validation->set_rules('country', 'Country', 'xss_clean');
                $this->form_validation->set_rules('post_code', 'Postcode', 'xss_clean');
                $this->form_validation->set_rules('website', 'Website', 'xss_clean');
                $this->form_validation->set_rules('business_sector_1', 'Business Sector 1', 'xss_clean');
                $this->form_validation->set_rules('business_sector_2', 'Business Sector 2', 'xss_clean');
                $this->form_validation->set_rules('vat_tax', 'VAT Number', 'xss_clean');
                $this->form_validation->set_rules('company_number', 'Company Number', 'xss_clean');
                $this->form_validation->set_rules('language', 'Language', 'xss_clean');
                $this->form_validation->set_rules('facebook', 'Facebook', 'xss_clean');
                $this->form_validation->set_rules('twitter', 'Twitter', 'xss_clean');
                $this->form_validation->set_rules('gplus', 'Google Plus', 'xss_clean');
                $this->form_validation->set_rules('linkedin', 'LinkedIn', 'xss_clean');
                $this->form_validation->set_rules('skype', 'Skype', 'xss_clean');
                $this->form_validation->set_rules('role', 'Position', 'xss_clean');			

                    if($this->form_validation->run()){

                        $data = array(
                                        'email' => $this->input->post('email'),
                                        'title' => $this->input->post('title'),
                                        'firstname' => $this->input->post('firstname'),
                                        'lastname' => $this->input->post('lastname'),                                        
                                        'language' => $this->input->post('language'),
                                        'facebook' => $this->input->post('facebook'),
                                        'twitter' => $this->input->post('twitter'),
                                        'gplus' => $this->input->post('gplus'),
                                        'linkedin' => $this->input->post('linkedin'),
                                        'skype' => $this->input->post('skype'),
                                        'role' => $this->input->post('role')
                                      );

                        $this->load->model('member/member_model', 'member_model');
                        $this->member_model->_update($this->session->userdata('members_id'), $data);
                        
                         $data = array(
                                        'company_name' => $this->input->post('company_name'),
                                        'phone_number' => $this->input->post('phone_number'),
                                        'mobile_number' => $this->input->post('mobile_number'),
                                        'address_line_1' => $this->input->post('address_line_1'),
                                        'address_line_2' => $this->input->post('address_line_2'),
                                        'town_city' => $this->input->post('town_city'),
                                        'county' => $this->input->post('county'),
                                        'country' => $this->input->post('country'),
                                        'post_code' => $this->input->post('post_code'),
                                        'website' => $this->input->post('website'),
                                        'business_sector_1' => $this->input->post('business_sector_1'),
                                        'business_sector_2' => $this->input->post('business_sector_2'),
                                        'vat_tax' => $this->input->post('vat_tax'),
                                        'company_number' => $this->input->post('company_number'),
                                     );
                         $this->company_model->_update($this->member_model->get_where($this->session->userdata('members_id'))->company_id, $data);
                    }
                    
                    redirect('profile/');
    }
	
}