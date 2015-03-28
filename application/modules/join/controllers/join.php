<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Join extends MX_Controller 
{
    function __construct()
    {
        ob_start();
        parent::__construct();       

    }
    
    function validateAccount()
    {
        $this->session->set_userdata('logged_in', 1);
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('country/country_model', 'country_model'); 
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        
        $data['main'] = 'join';
        $data['title'] = 'GSM - Edit Profile';
        $data['page'] = 'edit-profile';
        $this->load->view('validate-account', $data);
        
        $this->session->unset_userdata('logged_in');
    }

    function index()
    {
        $this->session->set_userdata('logged_in', 1);
        
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('country/country_model', 'country_model'); 
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");

        $data['main'] = 'join';
        $data['title'] = 'GSM - Edit Profile';
        $data['page'] = 'edit-profile';
        $this->load->view('index', $data);
        $this->session->unset_userdata('logged_in');
    }
    
    function profileCreate()
    {
        $this->session->set_userdata('logged_in', 1);
        
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->helper('string');
        //echo '<pre>';
        //print_r($_POST);
        
        
            $bsectors4 = '';
            $bsectors5 = '';

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
            $this->form_validation->set_rules('primary_sector', 'Business Sector 1', 'xss_clean');
            $this->form_validation->set_rules('secondary_sector', 'Business Sector 2', 'xss_clean');
            $this->form_validation->set_rules('tertiary_sector', 'Business Sector 2', 'xss_clean');
            $this->form_validation->set_rules('vat_tax', 'VAT Number', 'xss_clean');
            $this->form_validation->set_rules('company_profile', 'Company Profile', 'xss_clean');
            $this->form_validation->set_rules('company_number', 'Company Number', 'xss_clean');
            $this->form_validation->set_rules('language', 'Language', 'xss_clean');
            $this->form_validation->set_rules('facebook', 'Facebook', 'xss_clean');
            $this->form_validation->set_rules('twitter', 'Twitter', 'xss_clean');
            $this->form_validation->set_rules('gplus', 'Google Plus', 'xss_clean');
            $this->form_validation->set_rules('linkedin', 'LinkedIn', 'xss_clean');
            $this->form_validation->set_rules('skype', 'Skype', 'xss_clean');
            $this->form_validation->set_rules('role', 'Position', 'xss_clean');
            
            $email_activatedNo = $this->member_model->_custom_query_count("SELECT COUNT(*) AS count FROM members WHERE email = '".$this->input->post('email')."' AND validated = 'no'");
            $email_activatedYes = $this->member_model->_custom_query_count("SELECT COUNT(*) AS count FROM members WHERE email = '".$this->input->post('email')."' AND validated = 'yes'");
        
            if($email_activatedNo[0]->count > 0 && $email_activatedYes[0]->count < 1){
                $this->session->set_flashdata('register_title', 'registered_not_activated');
                $this->session->set_flashdata('message', 'That email address has been registered but not activated. Please activate your account via the confirmation email. <a href="'.$this->config->item('base_url').'login/resend/'.$this->input->post('email').'">Resend Email</a> or Please check your spam folder if you have not received one.');
                redirect('join/validateAccount');

            }
            elseif($email_activatedNo[0]->count < 1 && $email_activatedYes[0]->count > 0){
                $this->session->set_flashdata('register_title', 'registered_activated');
                $this->session->set_flashdata('message', 'That email address has been registered and activated. Please log in with your username and passowrd <a href="'.$this->config->item('base_url').'login/">HERE</a>');

                redirect('join/validateAccount');
            }
            else{

                if ($this->form_validation->run()) {

                    $password = random_string('alnum', 8);            
                    $validation_code = random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4).'-'. random_string('alnum', 4);

                    $data = array(
                        'email' => $this->input->post('email'),
                        'title' => $this->input->post('title'),
                        'phone_number' => $this->input->post('phone_number'),
                        'mobile_number' => $this->input->post('mobile_number'),
                        'firstname' => $this->input->post('firstname'),
                        'lastname' => $this->input->post('lastname'),
                        'date' => date('d-m-Y'),
                        'password' => md5($password),
                        'unhash_password' => $password,
                        'validation_code' => $validation_code,
                        'validated' => 'no',
                        'language' => $this->input->post('language'),
                        'facebook' => $this->input->post('facebook'),
                        'twitter' => $this->input->post('twitter'),
                        'gplus' => $this->input->post('gplus'),
                        'linkedin' => $this->input->post('linkedin'),
                        'skype' => $this->input->post('skype'),
                        'role' => $this->input->post('role')
                    );


                    $mid = $this->member_model->_insert($data);

                    $data = array(
                        'admin_member_id' => $mid,
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
                        'business_sector_1' => $this->input->post('bprimary'),
                        'business_sector_2' => $this->input->post('bsecondary'),
                        'business_sector_3' => $this->input->post('btertiary'),
                        'other_business' => $bsectors4 . $bsectors5,
                        'company_profile' => $this->input->post('company_profile'),
                        'vat_tax' => $this->input->post('vat_tax'),
                        'company_number' => $this->input->post('company_number'),
                    );

                    $cid = $this->company_model->_insert($data);

                    $data = array(
                                    'company_id' => $cid
                                 );
                    $this->member_model->_update($mid, $data);
                    
                    redirect('http://www.gsmstockmarket.com/success');

                }
            }
        
        
        $this->session->unset_userdata('logged_in');
        
    }
}