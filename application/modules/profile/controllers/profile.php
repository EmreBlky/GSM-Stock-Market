<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends MX_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('viewed/viewed_model', 'viewed_model');
        $this->load->model('country/country_model', 'country_model');
        $this->load->model('login/login_model', 'login_model');
        $this->load->model('activity/activity_model', 'activity_model');
        
        $data_activity = array(
                                'activity' => 'Profile',
                                'time' => date('H:i:s')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
    }

    function index() {
        $data['main'] = 'profile';
        $data['title'] = 'GSM - Profile';
        $data['page'] = 'index';

        $cid = $this->member_model->get_where_multiple('id', $this->session->userdata('members_id'))->company_id;
        $data['member_info'] = $this->member_model->get_where_multiple('id', $this->session->userdata('members_id'));
        $data['company_users'] = $this->member_model->get_where_multiples('company_id', $cid);
        $data['member_company'] = $this->company_model->get_where_multiple('id', $cid);
        $data['last_logged'] = $this->login_model->get_where_multiple('member_id', $this->session->userdata('members_id'), 'logged', 'yes');

        $this->load->module('templates');
        $this->templates->page($data);
    }

    function send_message($mid) {
        //echo $mid = $this->member_model->get_where_multiples('id', $mid)->company_id;
        //exit;
        $data['member_info'] = $this->member_model->get_where_multiple('company_id', $mid);
        $data['member_company'] = $this->company_model->get_where_multiple('id', $mid);

        $this->load->view('send-message', $data);
    }

    function who_viewed_count() {
        $viewed_count = $this->viewed_model->_custom_query_count("SELECT COUNT(DISTINCT viewer_id) AS 'viewed' FROM gsmstock_secure.viewed WHERE viewed_id = '" . $this->session->userdata('members_id') . "' AND notified = 'no'");

        foreach ($viewed_count as $viewed) {
            $viewed = $viewed->viewed;
        }

        if ($viewed > 0) {

            echo '<span class="label label-primary pull-right">' . $viewed . '</span>';
        }
    }

    function who_viewed($page = NULL, $off = NULL) {
        $this->load->library('pagination');
        $data['base'] = $this->config->item('base_url');
        $data['main'] = 'profile';
        $data['title'] = 'GSM - Whos Viewed Profile';
        $data['page'] = 'whos-viewed';

        if (isset($off) && $off > 1) {
            $new_mem = $off - 1;
            $offset = 21 * $new_mem;
        } else {
            $offset = 0;
        }

        $datas = array(
            'notified' => 'yes'
        );
        $this->viewed_model->_update_where($datas, 'viewed_id', $this->session->userdata('members_id'), 'notified', 'no');

        $viewed_count = $this->viewed_model->_custom_query_count("SELECT COUNT(DISTINCT viewer_id) AS 'viewed' FROM gsmstock_secure.viewed WHERE viewed_id = '" . $this->session->userdata('members_id') . "'");

        foreach ($viewed_count as $viewed) {
            $viewed = $viewed->viewed;
        }

        if ($viewed > 0) {

            $data['viewed_count'] = $viewed;
//echo $viewed;
//exit;

            $data['viewed'] = $this->viewed_model->_custom_query("SELECT DISTINCT viewer_id FROM gsmstock_secure.viewed WHERE viewed_id = '" . $this->session->userdata('members_id') . "' ORDER BY datetime DESC LIMIT " . $offset . ", 21");
            $config['base_url'] = $this->config->item('base_url') . 'profile/who_viewed/page';
            $config['total_rows'] = $viewed;
            $config['per_page'] = 21;
            $config["uri_segment"] = 4;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="btn-group pull-right">';
            $config['full_tag_close'] = '</div>';
            $config['next_tag_open'] = '<span class="btn gsm_pag btn-white">';
            $config['next_tag_close'] = '</span>';
            $config['prev_tag_open'] = ' <span class="btn gsm_pag btn-white">';
            $config['prev_tag_close'] = '</span>';
            $config['cur_tag_open'] = '<span class="btn gsm_pag_active btn-white active">';
            $config['cur_tag_close'] = '</span>';
            $config['num_tag_open'] = '<span class="btn gsm_pag btn-white">';
            $config['num_tag_close'] = '</span>';
            $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
            $config['next_link'] = '<i class="fa fa-chevron-right"></i>';

            $this->pagination->initialize($config);
            $data['pagination'] = $this->pagination->create_links();
        } else {
            $data['viewed_count'] = 0;
        }
//        
//$data['viewed'] = $this->viewed_model->get_where_multiples('viewed_id', $this->session->userdata('members_id'));

        $this->load->module('templates');
        $this->templates->page($data);
    }

    function viewed_profile() {
        $data['main'] = 'profile';
        $data['title'] = 'GSM - Viewed Profiles';
        $data['page'] = 'view-profile';

        $this->load->module('templates');
        $this->templates->page($data);
    }

    function edit_profile() {
        $this->load->model('member/member_model', 'member_model');


        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
        $data['company'] = $this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id);

//        echo "<pre>";
//        print_r($data['company']);
//        echo "</pre>";
        //$data['country'] = $this->country_model->get_all();
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");


        $data['main'] = 'profile';
        $data['title'] = 'GSM - Edit Profile';
        $data['page'] = 'edit-profile';

        $this->load->module('templates');
        $this->templates->page($data);
    }

    function profileEdit() {
        
//        echo '<pre>';
//        print_r($_POST);
//        exit;

        $bsectors4 = '';
        $bsectors5 = '';

        /* Faisal Code Start Here 2-25-2015
         * 
         */




        $valueOne = isset($_POST['bprimary']) && !empty($_POST['bprimary']) ? $_POST['bprimary'] : '';
        $valueTwo = isset($_POST['bsecondary']) && !empty($_POST['bsecondary']) ? $_POST['bsecondary'] : '';
        $valueThree = isset($_POST['btertiary']) && !empty($_POST['btertiary']) ? $_POST['btertiary'] : '';
        $bsectorsArray = isset($_POST['bsectors']) && !empty($_POST['bsectors']) ? $_POST['bsectors'] : '';


        $key = array_search($valueOne, $bsectorsArray);
        unset($bsectorsArray[$key]);
        $key = array_search($valueTwo, $bsectorsArray);
        unset($bsectorsArray[$key]);
        $key = array_search($valueThree, $bsectorsArray);
        unset($bsectorsArray[$key]);

        $bsectorsArray = array_values($bsectorsArray);



        if (isset($bsectorsArray[0])) {
            $bsectors4 = $bsectorsArray[0];
        }

        if (isset($bsectorsArray[1])) {
            $bsectors5 = ', ' . $bsectorsArray[1];
        }
        /* Faisal Code End Here 2-25-2015
         * 
         */

//        if (isset($_POST['bsectors'][3])) {
//            $bsectors4 = $_POST['bsectors'][3];
//        }
//        if (isset($_POST['bsectors'][4])) {
//            $bsectors5 = ', ' . $_POST['bsectors'][4];
//        }


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

        if ($this->form_validation->run()) {

            $data = array(
                'email' => $this->input->post('email'),
                'title' => $this->input->post('title'),
                'phone_number' => $this->input->post('phone_number'),
                'mobile_number' => $this->input->post('mobile_number'),
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
                'business_sector_1' => $this->input->post('bprimary'),
                'business_sector_2' => $this->input->post('bsecondary'),
                'business_sector_3' => $this->input->post('btertiary'),
                'other_business' => $bsectors4 . $bsectors5,
                'company_profile' => $this->input->post('company_profile'),
                'vat_tax' => $this->input->post('vat_tax'),
                'company_number' => $this->input->post('company_number'),
            );

            $this->company_model->_update($this->member_model->get_where($this->session->userdata('members_id'))->company_id, $data);
//
//            echo '<pre>';
//            print_r($_FILES);
//            exit;            
//            
            
            
            $files = $_FILES;
            
            $count = 0;
            foreach ($files['userfile']['size'] as $file){
                
                if($file > 0){
                  
                    
                    if($files['userfile']['name'][0] != ''){
                        $this->load->library('upload');
                        $base = $this->config->item('base_url');
                        
                        $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/company/';
                        $config['upload_url'] = $base . 'public/main/template/gsm/images/company/';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['file_name'] = $this->session->userdata('members_id').'_main';
                        $config['max_size'] = 4000;
                        $config['overwrite'] = TRUE;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;

                        $_FILES['userfile']['name']= $files['userfile']['name'][0];
                        $_FILES['userfile']['type']= $files['userfile']['type'][0];
                        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][0];
                        $_FILES['userfile']['error']= $files['userfile']['error'][0];
                        $_FILES['userfile']['size']= $files['userfile']['size'][0]; 

                         $this->upload->initialize($config);
                         $this->upload->do_upload();
                         
                        $config['image_library']    = 'gd2';
                        $config['source_image']	= 'public/main/template/gsm/images/company/'.$this->session->userdata('members_id').'_main.jpg';
                        $config['new_image']	= 'public/main/template/gsm/images/company/'.$this->session->userdata('members_id').'.jpg';
                        $config['create_thumb']     = TRUE;
                        $config['maintain_ratio']   = TRUE;
                        $config['width']            = 400;
                        $config['height']           = 200;

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        //$this->image_lib->resize();

    //                    $this->upload->initialize($config);
    //
                        if (!$this->image_lib->resize()) {
                                $error = array('error' => $this->image_lib->display_errors());
                                $this->session->set_flashdata('msg_personal', $error['error']);
                                redirect('profile/edit_profile');
                        }

                        $this->image_lib->clear();
                        
                        rename('public/main/template/gsm/images/company/'.$this->session->userdata('members_id').'_thumb.jpg', 'public/main/template/gsm/images/company/'.$this->session->userdata('members_id').'.jpg');
                        unlink('public/main/template/gsm/images/company/'.$this->session->userdata('members_id').'_main.jpg');
                        
                        
                    }
                    if($files['userfile']['name'][1] != ''){
                        $this->load->library('upload');
                        $base = $this->config->item('base_url');
                        
                        $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/members/';
                        $config['upload_url'] = $base . 'public/main/template/gsm/images/members/';
                        $config['allowed_types'] = 'gif|jpg|png';
                        $config['file_name'] = $this->session->userdata('members_id').'_main';
                        $config['max_size'] = 4000;
                        $config['overwrite'] = TRUE;
                        $config['max_width'] = 1500;
                        $config['max_height'] = 1500;

                        $_FILES['userfile']['name']= $files['userfile']['name'][1];
                        $_FILES['userfile']['type']= $files['userfile']['type'][1];
                        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][1];
                        $_FILES['userfile']['error']= $files['userfile']['error'][1];
                        $_FILES['userfile']['size']= $files['userfile']['size'][1]; 

                        $this->upload->initialize($config);
                        $this->upload->do_upload();

                        $config['image_library']    = 'gd2';
                        $config['source_image']	= 'public/main/template/gsm/images/members/'.$this->session->userdata('members_id').'_main.jpg';
                        $config['new_image']	= 'public/main/template/gsm/images/members/'.$this->session->userdata('members_id').'.jpg';
                        $config['create_thumb']     = TRUE;
                        $config['maintain_ratio']   = TRUE;
                        $config['width']            = 200;
                        $config['height']           = 200;

                        $this->load->library('image_lib');
                        $this->image_lib->initialize($config);
                        //$this->image_lib->resize();

    //                    $this->upload->initialize($config);
    //
                        if (!$this->image_lib->resize()) {
                                $error = array('error' => $this->image_lib->display_errors());
                                $this->session->set_flashdata('msg_personal', $error['error']);
                                redirect('profile/edit_profile');
                        }
                        
                        $this->image_lib->clear();
                        
                        rename('public/main/template/gsm/images/members/'.$this->session->userdata('members_id').'_thumb.jpg', 'public/main/template/gsm/images/members/'.$this->session->userdata('members_id').'.jpg');
                        unlink('public/main/template/gsm/images/members/'.$this->session->userdata('members_id').'_main.jpg');
                        
                    }
                    
                }
                //echo $file[$count].'<br/>';
                $count++;
            }
            

        }
       
        redirect('profile/', 'refresh');
    }

}

