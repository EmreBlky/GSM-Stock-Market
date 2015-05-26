<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MX_Controller
{

    function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $this->load->model('member/member_model', 'member_model');        
        $this->load->model('block/block_model', 'block_model');
        $this->load->model('company/company_model', 'company_model');
        $this->load->model('viewed/viewed_model', 'viewed_model');
        $this->load->model('country/country_model', 'country_model');
        $this->load->model('login/login_model', 'login_model');
        $this->load->model('activity/activity_model', 'activity_model');
        
        
    }

    function index()
    {
        if ($this->session->userdata('terms') == 'no')
        { 
            redirect('legal/terms_conditions');
        }
        
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

    function send_message($mid)
    {
        //echo $mid = $this->member_model->get_where_multiples('id', $mid)->company_id;
        //exit;
        $data['member_info'] = $this->member_model->get_where_multiple('company_id', $mid);
        $data['member_company'] = $this->company_model->get_where_multiple('id', $mid);

        $this->load->view('send-message', $data);
    }

    function who_viewed_count()
    {
        $viewed_count = $this->viewed_model->_custom_query_count("SELECT COUNT(DISTINCT viewer_id) AS 'viewed' FROM viewed WHERE viewed_id = '" . $this->session->userdata('members_id') . "' AND notified = 'no'");

        foreach ($viewed_count as $viewed) {
            $viewed = $viewed->viewed;
        }

        if ($viewed > 0) {

            echo '<span class="label label-primary pull-right">' . $viewed . '</span>';
        }
    }

    function who_viewed($page = NULL, $off = NULL)
    {

//        $blocked = $this->block_model->get_where_multiples('block_member_id', $this->session->userdata('members_id'));
//        
//        echo '<pre>';
//        prin
//        t_r($blocked);
//        exit;
        
         if ($this->session->userdata('terms') == 'no')
        { 
            redirect('legal/terms_conditions');
        }
        $data_activity = array(
            'activity' => 'Whos Viewed',
            'time' => date('H:i:s'),
            'date' => date('d-m-Y')
        );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));

        $this->load->library('pagination');
        $data['base'] = $this->config->item('base_url');
        $data['main'] = 'profile';
        $data['title'] = 'GSM - Whos Viewed Profile';
        $data['page'] = 'whos-viewed';
        $data['blocked'] = $this->block_model->get_where_multiples('block_member_id', $this->session->userdata('members_id'));
		
		/* Daniel Added Start */
        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
		/* Daniel Added End */

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

        $viewed_count = $this->viewed_model->_custom_query_count("SELECT COUNT(DISTINCT viewer_id) AS 'viewed' FROM viewed WHERE viewed_id = '" . $this->session->userdata('members_id') . "'");

        foreach ($viewed_count as $viewed) {
            $viewed = $viewed->viewed;
        }

        if ($viewed > 0) {

            $data['viewed_count'] = $viewed;
//echo $viewed;
//exit;

            $data['viewed'] = $this->viewed_model->_custom_query("SELECT DISTINCT viewer_id FROM viewed WHERE viewed_id = '" . $this->session->userdata('members_id') . "' ORDER BY datetime DESC LIMIT " . $offset . ", 21");
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

    function viewed_profile()
    {
        
        $data_activity = array(
            'activity' => 'View Profile',
            'time' => date('H:i:s'),
            'date' => date('d-m-Y')
        );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'profile';
        $data['title'] = 'GSM - Viewed Profiles';
        $data['page'] = 'view-profile';

        $this->load->module('templates');
        $this->templates->page($data);
    }

    /**
     * Syed Hamamd Sibtain
     */
    function companyImage()
    {
        $mid = $this->input->post('support_pic_edit');
        
        if($mid > 0){
            
                if (isset($_POST) && isset($_POST['udpate'])) {
                if ($_FILES['avatar_file']['name'] != '') {

                    $path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/company';
                    $args = array($_POST['avatar_src'], $_POST['avatar_data'], $_FILES['avatar_file'], $path . "/original", $path, $this->member_model->get_where($mid)->company_id);
                    $size = filesize($_FILES['avatar_file']['tmp_name']);
                    if($size <= 2097152) {
                    $crop = $this->load->library('CropAvatar', $args);
                    $response = array(
                        'state' => 200,
                        'message' => $this->cropavatar->getMsg(),
                        //'result' => $this->cropavatar->getResult()
                        'result' => $this->config->item('base_url') . "public/main/template/gsm/images/company/" . $this->member_model->get_where($mid)->company_id . ".png"
                    );
                    }else{
                        $response = array(
                            'state' => 400,
                            'message' => "Image must be less than 2MB",
                            'result' => ""
                        );
                    }

                    echo json_encode($response);
                    /* }*/
                    
                    $data_image = array(
                                'photo' => 'yes'
                                );
                    $this->company_model->_update($this->member_model->get_where($mid)->company_id, $data_image);

                }
            } else if (isset($_POST) && isset($_POST['reset'])) {
                $path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/company/';
                unlink($path . $this->member_model->get_where($mid)->company_id . '.png');
                if (file_exists($path . "original/" . $this->member_model->get_where($mid)->company_id . '.jpg'))
                    unlink($path . "original/" . $this->member_model->get_where($mid)->company_id . '.jpg');
                else if (file_exists($path . "original/" . $this->member_model->get_where($mid)->company_id . '.jpeg'))
                    unlink($path . "original/" . $this->member_model->get_where($mid)->company_id . '.jpeg');
                else if (file_exists($path . "original/" . $this->member_model->get_where($mid)->company_id . '.gif'))
                    unlink($path . "original/" . $this->member_model->get_where($mid)->company_id . '.gif');
                else if (file_exists($path . "original/" . $this->member_model->get_where($mid)->company_id . '.png'))
                    unlink($path . "original/" . $this->member_model->get_where($mid)->company_id . '.png');
                
                $data_image = array(
                                'photo' => 'no'
                                );
                $this->company_model->_update($this->member_model->get_where($mid)->company_id, $data_image);
            }            
            
            
            
        }
        else{
            
                if (isset($_POST) && isset($_POST['udpate'])) {
                if ($_FILES['avatar_file']['name'] != '') {

                    $path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/company';
                    $args = array($_POST['avatar_src'], $_POST['avatar_data'], $_FILES['avatar_file'], $path . "/original", $path, $this->member_model->get_where($this->session->userdata('members_id'))->company_id);
                    $size = filesize($_FILES['avatar_file']['tmp_name']);
                    if($size <= 2097152) {
                    $crop = $this->load->library('CropAvatar', $args);
                    $response = array(
                        'state' => 200,
                        'message' => $this->cropavatar->getMsg(),
                        //'result' => $this->cropavatar->getResult()
                        'result' => $this->config->item('base_url') . "public/main/template/gsm/images/company/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . ".png"
                    );
                    }else{
                        $response = array(
                            'state' => 400,
                            'message' => "Image must be less than 2MB",
                            'result' => ""
                        );
                    }

                    echo json_encode($response);
                    /* }*/
                    
                    $data_image = array(
                                'photo' => 'yes'
                                );
                    $this->company_model->_update($this->member_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->company_id, $data_image);
            

                }
            } else if (isset($_POST) && isset($_POST['reset'])) {
                $path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/company/';
                unlink($path . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.png');
                if (file_exists($path . "original/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.jpg'))
                    unlink($path . "original/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.jpg');
                else if (file_exists($path . "original/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.jpeg'))
                    unlink($path . "original/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.jpeg');
                else if (file_exists($path . "original/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.gif'))
                    unlink($path . "original/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.gif');
                else if (file_exists($path . "original/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.png'))
                    unlink($path . "original/" . $this->member_model->get_where($this->session->userdata('members_id'))->company_id . '.png');
                
                $data_image = array(
                                'photo' => 'no'
                                );
                $this->company_model->_update($this->member_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->company_id, $data_image);
            
            }
            
        }
    }

    function profileImage()
    {
        $mid = $this->input->post('support_pic_edit');
        
        if($mid > 0){
            
                if (isset($_POST) && isset($_POST['udpate'])) {
                if ($_FILES['avatar_file']['name'] != '') {
    //268435456
                    $path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/members';
                    $args = array($_POST['avatar_src'], $_POST['avatar_data'], $_FILES['avatar_file'], $path . "/original", $path, $mid);
                    $size = filesize($_FILES['avatar_file']['tmp_name']);
                    if($size <= 2097152) {
                        $crop = $this->load->library('CropAvatar', $args);
                        $response = array(
                            'state' => 200,
                            'message' => $this->cropavatar->getMsg(),
                            //'result' => $this->cropavatar->getResult()
                            'result' => $this->config->item('base_url') . "public/main/template/gsm/images/members/" . $mid . ".png"
                        );
                    }else{
                        $response = array(
                            'state' => 400,
                            'message' => "Image must be less than 2M",
                            'result' => ""
                        );
                    }
                    echo json_encode($response);
                    /* }*/
                    
                    $data_image = array(
                                'photo' => 'yes'
                                );
                    $this->member_model->_update($mid, $data_image);

                }
            } else if (isset($_POST) && isset($_POST['reset'])) {
                $path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/members/';

                unlink($path . $mid . '.png');

                if (file_exists($path . "original/" . $mid . '.jpg'))
                    unlink($path . "original/" . $mid . '.jpg');
                else if (file_exists($path . "original/" . $mid . '.jpeg'))
                    unlink($path . "original/" . $mid . '.jpeg');
                else if (file_exists($path . "original/" . $mid . '.gif'))
                    unlink($path . "original/" . $mid . '.gif');
                else if (file_exists($path . "original/" . $mid . '.png'))
                    unlink($path . "original/" . $mid . '.png');
                
                $data_image = array(
                                'photo' => 'no'
                                );
                $this->member_model->_update($mid, $data_image);
            }
            
        }
        else{

                if (isset($_POST) && isset($_POST['udpate'])) {
                if ($_FILES['avatar_file']['name'] != '') {
    //268435456
                    $path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/members';
                    $args = array($_POST['avatar_src'], $_POST['avatar_data'], $_FILES['avatar_file'], $path . "/original", $path, $this->session->userdata('members_id'));
                    $size = filesize($_FILES['avatar_file']['tmp_name']);
                    if($size <= 2097152) {
                        $crop = $this->load->library('CropAvatar', $args);
                        $response = array(
                            'state' => 200,
                            'message' => $this->cropavatar->getMsg(),
                            //'result' => $this->cropavatar->getResult()
                            'result' => $this->config->item('base_url') . "public/main/template/gsm/images/members/" . $this->session->userdata('members_id') . ".png"
                        );
                    }else{
                        $response = array(
                            'state' => 400,
                            'message' => "Image must be less than 2M",
                            'result' => ""
                        );
                    }
                    echo json_encode($response);
                    /* }*/
                    
                    $data_image = array(
                                'photo' => 'yes'
                                );
                    $this->member_model->_update($this->session->userdata('members_id'), $data_image);

                }
            } else if (isset($_POST) && isset($_POST['reset'])) {
                $path = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/members/';

                unlink($path . $this->session->userdata('members_id') . '.png');

                if (file_exists($path . "original/" . $this->session->userdata('members_id') . '.jpg'))
                    unlink($path . "original/" . $this->session->userdata('members_id') . '.jpg');
                else if (file_exists($path . "original/" . $this->session->userdata('members_id') . '.jpeg'))
                    unlink($path . "original/" . $this->session->userdata('members_id') . '.jpeg');
                else if (file_exists($path . "original/" . $this->session->userdata('members_id') . '.gif'))
                    unlink($path . "original/" . $this->session->userdata('members_id') . '.gif');
                else if (file_exists($path . "original/" . $this->session->userdata('members_id') . '.png'))
                    unlink($path . "original/" . $this->session->userdata('members_id') . '.png');
                
                $data_image = array(
                                'photo' => 'no'
                                );
                $this->member_model->_update($this->session->userdata('members_id'), $data_image);
            }
            
        }        
    }

    function edit_profile($mid = NULL)
    {
        if ($this->session->userdata('terms') == 'no')
        { 
            redirect('legal/terms_conditions');
        }
        
        $this->load->model('events/events_model', 'events_model');
        $this->load->model('attending/attending_model', 'attending_model');
        
        $e_count = $this->events_model->count_where('status', 'active');
        if($e_count > 0){
            $data['events'] = $this->events_model->get_where_multiples_order('sort_order', 'ASC', 'status', 'active');
            $data['events_count'] = $e_count;
        }
        else{
            $data['events_count'] = 0;
        }
        
       if(isset($mid)){
           
           if($this->session->userdata('members_id') == 5){
               
                $data['member'] = $this->member_model->get_where($mid);
                $data['company'] = $this->company_model->get_where($this->member_model->get_where($mid)->company_id);

                $count = $this->company_model->_custom_query_count('SELECT COUNT(*) AS count FROM company WHERE admin_member_id = "'.$mid.'" AND company_profile_approval != ""');

                if($count[0]->count > 0){
                    $data['bio_count'] = $count[0]->count;
                }
                else{
                    $data['bio_count'] = 0;
                }

                $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
                $data['support_edit'] = 'yes';
                $data['mid'] = $mid;

                $data['main'] = 'profile';
                $data['title'] = 'GSM - Edit Profile';
                $data['page'] = 'edit-profile';

                $this->load->module('templates');
                $this->templates->page($data);
               
           }
           else{
               redirect('home/');
           }
           
       }
       else{           
           
           $data_activity = array(
            'activity' => 'Edit Profile',
            'time' => date('H:i:s'),
            'date' => date('d-m-Y')
            );
            $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));

            $this->load->model('member/member_model', 'member_model');


            $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));
            $data['company'] = $this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id);

            $count = $this->company_model->_custom_query_count('SELECT COUNT(*) AS count FROM company WHERE admin_member_id = "'.$this->session->userdata('members_id').'" AND company_profile_approval != ""');

            if($count[0]->count > 0){
                $data['bio_count'] = $count[0]->count;
            }
            else{
                $data['bio_count'] = 0;
            }

    //        echo "<pre>";
    //        print_r($data['company']);
    //        echo "</pre>";
            //$data['country'] = $this->country_model->get_all();
            $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
            $data['admin_id'] = $this->company_model->get_where($this->member_model->get_where_multiple('id', $this->session->userdata('members_id'))->company_id)->admin_member_id;
        

            $data['main'] = 'profile';
            $data['title'] = 'GSM - Edit Profile';
            $data['page'] = 'edit-profile';

            $this->load->module('templates');
            $this->templates->page($data);
       }
    }

    function profileEdit()
    {
        
//        echo '<pre>';
//        print_r($_POST);
//        exit;
        
        $mid = $this->input->post('support_edit');

        $bsectors4 = '';
        $bsectors5 = '';

        /* Faisal Code Start Here 2-25-2015
         * 
         */


        $valueOne = isset($_POST['bprimary']) && !empty($_POST['bprimary']) ? $_POST['bprimary'] : '';
        $valueTwo = isset($_POST['bsecondary']) && !empty($_POST['bsecondary']) ? $_POST['bsecondary'] : '';
        $valueThree = isset($_POST['btertiary']) && !empty($_POST['btertiary']) ? $_POST['btertiary'] : '';
        $bsectorsArray = isset($_POST['bsectors']) && !empty($_POST['bsectors']) ? $_POST['bsectors'] : '';
        
        $admin_id = $this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->admin_member_id;

        if($this->session->userdata('members_id') == 5 || $this->session->userdata('members_id') == $admin_id) {

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
     
        }

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
            
            if($mid > 0){
                
                $company_bio = strip_tags($this->company_model->get_where_multiple('admin_member_id', $mid)->company_profile);
                $company_bio_new = $this->input->post('company_profile');
                
                $data = array(
                'email' => $this->input->post('email'),
                'title' => $this->input->post('title'),
                'dial_phone' => $this->input->post('phone_number'),
                'phone_number' => $this->input->post('telephone_number'),
                'dial_mobile' => $this->input->post('phone_number'),
                'mobile_number' => $this->input->post('mobile_number'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'language' => $this->input->post('language'),
                'facebook' => $this->input->post('facebook'),
                'twitter' => $this->input->post('twitter'),
                'gplus' => $this->input->post('gplus'),
                'linkedin' => $this->input->post('linkedin'),
                'skype' => $this->input->post('skype'),
                'role' => $this->input->post('role'),    
            );

            $this->load->model('member/member_model', 'member_model');
            $this->member_model->_update($mid, $data);
            
            //$admin_id = $this->company_model->get_where($this->member_model->get_where($this->session->userdata('members_id'))->company_id)->admin_member_id;

            if($this->session->userdata('members_id') == 5 || $this->session->userdata('members_id') == $admin_id) {

                if($company_bio == $company_bio_new){

                    $data = array(
                        'company_name' => $this->input->post('company_name'),
                        'dial_phone' => $this->input->post('phone_number'),
                        'phone_number' => $this->input->post('telephone_number'),
                        'dial_mobile' => $this->input->post('phone_number'),
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
                        'company_profile' => $company_bio_new,
                        'vat_tax' => $this->input->post('vat_tax'),
                        'currency' => $this->input->post('currency')
                    );
                }
                else{
                    $data = array(
                        'company_name' => $this->input->post('company_name'),
                        'dial_phone' => $this->input->post('phone_number'),
                        'phone_number' => $this->input->post('telephone_number'),
                        'dial_mobile' => $this->input->post('phone_number'),
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
                        'company_profile' => '',
                        'company_profile_approval' => $company_bio_new,
                        'vat_tax' => $this->input->post('vat_tax'),
                        'company_number' => $this->input->post('company_number'),
                        'currency' => $this->input->post('currency')
                    );
                }

                $this->company_model->_update($this->member_model->get_where($mid)->company_id, $data);
            
            }
            
            $this->profile_completion($mid);
//
//            echo '<pre>';
//            print_r($_FILES);
//            exit;
//


            $files = $_FILES;

            $count = 0;
            if (isset($files['userfile']['size'])) {
                foreach ($files['userfile']['size'] as $file) {

                    if ($file > 0) {


                        if ($files['userfile']['name'][0] != '') {
                            $this->load->library('upload');
                            $base = $this->config->item('base_url');

                            $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/company/';
                            $config['upload_url'] = $base . 'public/main/template/gsm/images/company/';
                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['file_name'] = $mid . '_main';
                            $config['max_size'] = 4000;
                            $config['overwrite'] = TRUE;
                            $config['max_width'] = 1500;
                            $config['max_height'] = 1500;

                            $this->upload->initialize($config);
                            $this->upload->do_upload();

                            $config['image_library'] = 'gd2';
                            $config['source_image'] = 'public/main/template/gsm/images/company/' . $mid . '_main.jpg';
                            $config['new_image'] = 'public/main/template/gsm/images/company/' . $mid . '.jpg';
                            $config['create_thumb'] = TRUE;
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 400;
                            $config['height'] = 200;

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

                            rename('public/main/template/gsm/images/company/' . $mid . '_thumb.jpg', 'public/main/template/gsm/images/company/' . $mid . '.jpg');
                            unlink('public/main/template/gsm/images/company/' . $mid . '_main.jpg');


                        }
                        if ($files['userfile']['name'][1] != '') {
                            $this->load->library('upload');
                            $base = $this->config->item('base_url');

                            $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/members/';
                            $config['upload_url'] = $base . 'public/main/template/gsm/images/members/';
                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['file_name'] = $mid . '_main';
                            $config['max_size'] = 4000;
                            $config['overwrite'] = TRUE;
                            $config['max_width'] = 1500;
                            $config['max_height'] = 1500;

                            $_FILES['userfile']['name'] = $files['userfile']['name'][1];
                            $_FILES['userfile']['type'] = $files['userfile']['type'][1];
                            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][1];
                            $_FILES['userfile']['error'] = $files['userfile']['error'][1];
                            $_FILES['userfile']['size'] = $files['userfile']['size'][1];

                            $this->upload->initialize($config);
                            $this->upload->do_upload();

                            $config['image_library'] = 'gd2';
                            $config['source_image'] = 'public/main/template/gsm/images/members/' . $mid . '_main.jpg';
                            $config['new_image'] = 'public/main/template/gsm/images/members/' . $mid . '.jpg';
                            $config['create_thumb'] = TRUE;
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 200;
                            $config['height'] = 200;

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

                            rename('public/main/template/gsm/images/members/' . $mid . '_thumb.jpg', 'public/main/template/gsm/images/members/' . $mid . '.jpg');
                            unlink('public/main/template/gsm/images/members/' . $mid . '_main.jpg');

                        }

                    }
                    //echo $file[$count].'<br/>';
                    $count++;
                }
            }
                
            }
            else{              
            

            $data = array(
                'email' => $this->input->post('email'),
                'title' => $this->input->post('title'),
                'dial_phone' => $this->input->post('phone_number'),
                'phone_number' => $this->input->post('telephone_number'),
                'dial_mobile' => $this->input->post('phone_number'),
                'mobile_number' => $this->input->post('mobile_number'),
                'firstname' => $this->input->post('firstname'),
                'lastname' => $this->input->post('lastname'),
                'language' => $this->input->post('language'),
                'facebook' => $this->input->post('facebook'),
                'twitter' => $this->input->post('twitter'),
                'gplus' => $this->input->post('gplus'),
                'linkedin' => $this->input->post('linkedin'),
                'skype' => $this->input->post('skype'),
                'role' => $this->input->post('role'), 
            );

            $this->load->model('member/member_model', 'member_model');
            $this->member_model->_update($this->session->userdata('members_id'), $data);
            
            if($this->session->userdata('members_id') == 5 || $this->session->userdata('members_id') == $admin_id) {    
                
                $company_bio = strip_tags($this->company_model->get_where_multiple('admin_member_id', $this->session->userdata('members_id'))->company_profile);
                $company_bio_new = $this->input->post('company_profile');

            if($company_bio == $company_bio_new){
                
                $data = array(
                    'company_name' => $this->input->post('company_name'),
                    'dial_phone' => $this->input->post('phone_number'),
                    'phone_number' => $this->input->post('telephone_number'),
                    'dial_mobile' => $this->input->post('phone_number'),
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
                    'company_profile' => $company_bio_new,
                    'vat_tax' => $this->input->post('vat_tax'),
                    'company_number' => $this->input->post('company_number'),
                    'currency' => $this->input->post('currency')
                );
            }
            else{
                $data = array(
                    'company_name' => $this->input->post('company_name'),
                    'dial_phone' => $this->input->post('phone_number'),
                    'phone_number' => $this->input->post('telephone_number'),
                    'dial_mobile' => $this->input->post('phone_number'),
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
                    'company_profile' => '',
                    'company_profile_approval' => $company_bio_new,
                    'vat_tax' => $this->input->post('vat_tax'),
                    'company_number' => $this->input->post('company_number'),
                    'currency' => $this->input->post('currency')
                );
            }
            
            $this->company_model->_update($this->member_model->get_where($this->session->userdata('members_id'))->company_id, $data);
            
            }
            
            $this->profile_completion($this->session->userdata('members_id'));
//
//            echo '<pre>';
//            print_r($_FILES);
//            exit;
//


            $files = $_FILES;

            $count = 0;
            if (isset($files['userfile']['size'])) {
                foreach ($files['userfile']['size'] as $file) {

                    if ($file > 0) {


                        if ($files['userfile']['name'][0] != '') {
                            $this->load->library('upload');
                            $base = $this->config->item('base_url');

                            $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/company/';
                            $config['upload_url'] = $base . 'public/main/template/gsm/images/company/';
                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['file_name'] = $this->session->userdata('members_id') . '_main';
                            $config['max_size'] = 4000;
                            $config['overwrite'] = TRUE;
                            $config['max_width'] = 1500;
                            $config['max_height'] = 1500;

                            $this->upload->initialize($config);
                            $this->upload->do_upload();

                            $config['image_library'] = 'gd2';
                            $config['source_image'] = 'public/main/template/gsm/images/company/' . $this->session->userdata('members_id') . '_main.jpg';
                            $config['new_image'] = 'public/main/template/gsm/images/company/' . $this->session->userdata('members_id') . '.jpg';
                            $config['create_thumb'] = TRUE;
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 400;
                            $config['height'] = 200;

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

                            rename('public/main/template/gsm/images/company/' . $this->session->userdata('members_id') . '_thumb.jpg', 'public/main/template/gsm/images/company/' . $this->session->userdata('members_id') . '.jpg');
                            unlink('public/main/template/gsm/images/company/' . $this->session->userdata('members_id') . '_main.jpg');


                        }
                        if ($files['userfile']['name'][1] != '') {
                            $this->load->library('upload');
                            $base = $this->config->item('base_url');

                            $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"]) . '/public/main/template/gsm/images/members/';
                            $config['upload_url'] = $base . 'public/main/template/gsm/images/members/';
                            $config['allowed_types'] = 'gif|jpg|png';
                            $config['file_name'] = $this->session->userdata('members_id') . '_main';
                            $config['max_size'] = 4000;
                            $config['overwrite'] = TRUE;
                            $config['max_width'] = 1500;
                            $config['max_height'] = 1500;

                            $_FILES['userfile']['name'] = $files['userfile']['name'][1];
                            $_FILES['userfile']['type'] = $files['userfile']['type'][1];
                            $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][1];
                            $_FILES['userfile']['error'] = $files['userfile']['error'][1];
                            $_FILES['userfile']['size'] = $files['userfile']['size'][1];

                            $this->upload->initialize($config);
                            $this->upload->do_upload();

                            $config['image_library'] = 'gd2';
                            $config['source_image'] = 'public/main/template/gsm/images/members/' . $this->session->userdata('members_id') . '_main.jpg';
                            $config['new_image'] = 'public/main/template/gsm/images/members/' . $this->session->userdata('members_id') . '.jpg';
                            $config['create_thumb'] = TRUE;
                            $config['maintain_ratio'] = TRUE;
                            $config['width'] = 200;
                            $config['height'] = 200;

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

                            rename('public/main/template/gsm/images/members/' . $this->session->userdata('members_id') . '_thumb.jpg', 'public/main/template/gsm/images/members/' . $this->session->userdata('members_id') . '.jpg');
                            unlink('public/main/template/gsm/images/members/' . $this->session->userdata('members_id') . '_main.jpg');

                        }

                    }
                    //echo $file[$count].'<br/>';
                    $count++;
                }
            }


        }
        }
        
        $this->load->model('attending/attending_model', 'attending_model');
        
        foreach($_POST as $key => $value){
            
            if(is_numeric($key) && $value == 'attending'){
                
                $count = $this->attending_model->_custom_query_count("SELECT COUNT(*) AS count FROM attending WHERE member_id = '".$this->session->userdata('members_id')."' AND event_id = '".$key."'");
                
                if($count[0]->count < 1){
                //echo $key.' - '.$value.'<br/>';
                    $data_attending = array(
                                            'event_id' => $key,
                                            'member_id' => $this->session->userdata('members_id')
                                            );
                    $this->attending_model->_insert($data_attending);
                
                }
            }
            
            if(is_numeric($key) && $value == 'not_attending'){
                //echo $key.' - '.$value.'<br/>';
                $this->attending_model->_custom_query_action("DELETE FROM attending WHERE event_id = '".$key."' AND member_id = '".$this->session->userdata('members_id')."'");
            }
            
        }
        
        redirect('profile/', 'refresh');
    }
    
    function profile_completion($mid)
    {        
        $company_name = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_name;
        $address = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->address_line_1;
        $town = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->town_city;
        $county = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->county;
        $postcode = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->post_code;
        $country = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->country;
        $phone_number = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->phone_number;
        $business_sector_1 = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->business_sector_1;
        $company_profile = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_profile;
        $company_profile_approval = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->company_profile_approval;
        $company_photo = $this->company_model->get_where($this->member_model->get_where($mid)->company_id)->photo;
             
        $title = $this->member_model->get_where($mid)->title;
        $firstname = $this->member_model->get_where($mid)->firstname;
        $lastname = $this->member_model->get_where($mid)->lastname;
        $role = $this->member_model->get_where($mid)->role;
        $email = $this->member_model->get_where($mid)->email;
        $language = $this->member_model->get_where($mid)->language;
        $profile_photo = $this->member_model->get_where($mid)->photo;
        
        if($company_name != ''){ 
            $profile_1 = 5;                    
        }
        
        if($address != ''){ 
            $profile_2 = 5;                    
        }
        
        if($town != ''){ 
            $profile_3 = 5;                    
        }
        
        if($county != ''){ 
            $profile_4 = 5;                    
        }
        
        if($postcode != ''){ 
            $profile_5 = 5;                    
        }
        
        if($country != ''){ 
            $profile_6 = 5;                    
        }
        
        if($phone_number != ''){ 
            $profile_7 = 5;                    
        }
        
        if($business_sector_1 != ''){ 
            $profile_8 = 5;                    
        }
        
        if(!is_numeric($company_profile) && $company_profile_approval == ''){ 
            $profile_9 = 10;                    
        }
        else{
            $profile_9 = 0;
        }
        
        if($company_photo == 'yes'){ 
            $profile_10 = 10;                    
        }
        else{
            $profile_10 = 0;
        }
        
        if($title != ''){ 
            $profile_11 = 5;                    
        }
        
        if($firstname != ''){ 
            $profile_12 = 5;                    
        }
        
        if($lastname != ''){ 
            $profile_13 = 5;                    
        }
        
        if($role != ''){ 
            $profile_14 = 5;                    
        }
        
        if($email != ''){ 
            $profile_15 = 5;                    
        }
        
        if($language != ''){ 
            $profile_16 = 5;                    
        }
        
        if($profile_photo == 'yes'){ 
            $profile_17 = 10;                    
        }
        else{
            $profile_17 = 0;
        }
        
        $profile_score = $profile_1+$profile_2+$profile_3+$profile_4+$profile_5+$profile_6+$profile_7+$profile_8+$profile_9+$profile_10+$profile_11+$profile_12+$profile_13+$profile_14+$profile_15+$profile_16+$profile_17;
        
        $data = array(
                      'profile_completion' =>  $profile_score 
                      );
        $this->member_model->_update($mid, $data);
    }
    
    function delete_profile($mid)
    {
        $this->load->model('addressbook/addressbook_model', 'addressbook_model');
        $this->load->model('attending/attending_model', 'attending_model');
        $this->load->model('buying/buying_model', 'buying_model');
        $this->load->model('creditdata/creditdata_model', 'creditdata_model');
        $this->load->model('favourite/favourite_model', 'favourite_model'); 
        $this->load->model('feed/feed_model', 'feed_model'); 
        $this->load->model('feedback/feedback_model', 'feedback_model');  
        $this->load->model('mailbox/mailbox_model', 'mailbox_model');
        $this->load->model('make_offer/make_offer_model', 'make_offer_model');
        $this->load->model('negotiation/negotiation_model', 'negotiation_model');
        $this->load->model('notification/notification_model', 'notification_model');
        $this->load->model('offer_attempt/offer_attempt_model', 'offer_attempt_model');
        $this->load->model('report/report_model', 'report_model');
        $this->load->model('selling/selling_model', 'selling_model');
        $this->load->model('tradereference/tradereference_model', 'tradereference_model');
        $this->load->model('transaction/transaction_model', 'transaction_model');
        $this->load->model('viewed/viewed_model', 'viewed_model');
        
        $this->member_model->_delete($mid);
        $this->company_model->_delete_where('admin_member_id', $mid);
        
        $this->addressbook_model->_delete_where('member_id', $mid);
        $this->addressbook_model->_delete_where('address_member_id', $mid);
        $this->activity_model->_delete_where('member_id', $mid);
        $this->attending_model->_delete_where('member_id', $mid);
        $this->block_model->_delete_where('member_id', $mid);
        $this->block_model->_delete_where('block_member_id', $mid);
        $this->buying_model->_delete_where('buying_member_id', $mid);
        $this->creditdata_model->_delete_where('request_id', $mid);
        $this->creditdata_model->_delete_where('requester_id', $mid);
        $this->favourite_model->_delete_where('member_id', $mid);
        $this->favourite_model->_delete_where('favourite_id', $mid);
        $this->feed_model->_delete_where('member_id', $mid);
        $this->feedback_model->_delete_where('member_id', $mid);
        $this->feedback_model->_delete_where('feedback_member_id', $mid);
        $this->mailbox_model->_delete_where('member_id', $mid);
        $this->mailbox_model->_delete_where('sent_member_id', $mid);
        $this->make_offer_model->_delete_where('seller_id', $mid);
        $this->make_offer_model->_delete_where('buyer_id', $mid);
        $this->negotiation_model->_delete_where('buyer_id', $mid);
        $this->negotiation_model->_delete_where('seller_id', $mid);
        $this->notification_model->_delete_where('member_id', $mid);
        $this->offer_attempt_model->_delete_where('buyer_id', $mid);
        $this->report_model->_delete_where('report_id', $mid);
        $this->report_model->_delete_where('abuse_id', $mid);
        $this->selling_model->_delete_where('selling_member_id', $mid);
        $this->tradereference_model->_delete_where('member_id', $mid);
        //$this->transaction_model->_delete_where('buyer_id', $mid);
        //$this->transaction_model->_delete_where('seller_id', $mid);
        $this->viewed_model->_delete_where('viewed_id', $mid);
        $this->viewed_model->_delete_where('viewer_id', $mid);
        
        $this->session->set_flashdata('confirm-delete', '<div style="margin:15px 15px">    
                                                                <div class="alert alert-warning">
                                                                    That account has been deleted.
                                                                </div>
                                                            </div>');
        redirect('home/');
    }

}

