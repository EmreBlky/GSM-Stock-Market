<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addressbook extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
        $this->load->model('addressbook/addressbook_model', 'addressbook_model');
        $this->load->model('activity/activity_model', 'activity_model');
        $this->load->model('block/block_model', 'block_model');
        $this->load->model('country/country_model', 'country_model');
        $this->load->model('login/login_model', 'login_model');
        $this->load->model('favourite/favourite_model', 'favourite_model');
        $this->load->model('member/member_model', 'member_model');
        $this->load->model('company/company_model', 'company_model');
        
        $data_activity = array(
                                'activity' => 'Address Book',
                                'time' => date('H:i:s')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
    }

    function index($page = NULL, $off = NULL)
    {
        
        
        $this->load->library('pagination');
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        $data['address_all'] = $this->addressbook_model->get_where_multiples('member_id',$this->session->userdata('members_id'));
        $data['blocked'] = $this->block_model->get_where_multiples('block_member_id', $this->session->userdata('members_id'));

        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            $data['address_book'] = $this->addressbook_model->get_where_multiples_order('company', 'ASC', 'member_id', $this->session->userdata('members_id'), NULL, NULL,  NULL, NULL,  NULL, NULL, 21, $offset);
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 3;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
        }
        else{
            $data['addressbook_count'] = 0;
        }
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function page($off = NULL)
    {
        $this->load->library('pagination');
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            $data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'), NULL, NULL, 21, $offset);
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 3;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
        }
        else{
            $data['addressbook_count'] = 0;
        }
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function business($one, $two, $page, $off = NULL)
    {
        $this->load->library('pagination');
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            //$data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'), NULL, NULL, 21, $offset);
            
            $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE business_activities = '".$this->characterReplace($one)."' AND member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($two)." LIMIT ".$offset.", 21");
            
            
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/business/'.$this->characterReplace($one).'/'.$this->characterReplace($two).'/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 6;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
        }
        else{
            $data['addressbook_count'] = 0;
        }
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function country($one, $two, $page, $off = NULL)
    {
        $this->load->library('pagination');
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            //$data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'), NULL, NULL, 21, $offset);
            
            $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE country = '".$this->characterReplace($one)."' AND member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($two)." LIMIT ".$offset.", 21");
            
            
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/country/'.$this->characterReplace($one).'/'.$this->characterReplace($two).'/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 6;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
        }
        else{
            $data['addressbook_count'] = 0;
        }
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function all_info($one, $two, $three,$page, $off = NULL)
    {
        $this->load->library('pagination');
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            //$data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'), NULL, NULL, 21, $offset);
            
            $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE business_activities = '".$this->characterReplace($one)."' AND country = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($three)." LIMIT ".$offset.", 21");
            
            
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/all_info/'.$this->characterReplace($one).'/'.$this->characterReplace($two).'/'.$this->characterReplace($three).'/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 7;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
        }
        else{
            $data['addressbook_count'] = 0;
        }
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function order($one, $page, $off = NULL)
    {
        $this->load->library('pagination');
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Addressbook';        
        $data['page'] = 'index';
        
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        
        if($add_count > 0){
            $data['addressbook_count'] = $add_count;
            //$data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'), NULL, NULL, 21, $offset);
            
            $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($one)." LIMIT ".$offset.", 21");
            
            
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/order/'.$this->characterReplace($one).'/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 5;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
        }
        else{
            $data['addressbook_count'] = 0;
        }
        
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function individual()
    {
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Individuals';        
        $data['page'] = 'individuals';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function company()
    {
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Company';        
        $data['page'] = 'companies';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function favourite()
    {
        $data['main'] = 'addressbook';
        $data['title'] = 'GSM - Favourites';        
        $data['page'] = 'favourites';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function characterReplace($var)
    {
        $var = str_replace('%20', ' ', $var);        
        $var = str_replace('BREAK1', '<br/>', $var);
        $var = str_replace('%22', '"', $var);
        $var = str_replace('%3C', '<', $var);
        $var = str_replace('%3E', '>', $var);
        $var = str_replace('%C2%B1', '±', $var);
        $var = str_replace('%7C', '|', $var);
        $var = str_replace('%7B', '{', $var);
        $var = str_replace('%7D', '}', $var);
        $var = str_replace('%5E', '^', $var);
        $var = str_replace('%C2%A3', '£', $var);
        $var = str_replace('%60', '`', $var);
        $var = str_replace('%C2%A7', '§', $var);
        $var = str_replace('QUEST1', '?', $var);
        $var = str_replace('SLASH1', '/', $var);
        $var = str_replace('PERCENT1', '%', $var);
        $var = str_replace('&#40;', '(', $var);
        $var = str_replace('&#41;', ')', $var);
        
        return $var;
    }
    
    function add($mid, $individual, $company, $business1, $business2, $business3, $country)
    {
        $data = array(
                        'member_id'                     => $this->session->userdata('members_id'),
                        'address_member_id'             => $mid,
                        'individual'                    => $this->characterReplace($individual),
                        'company'                       => $this->characterReplace($company),
                        'favourite'                     => 'no',
                        'business_activities'           => $this->characterReplace($business1),
                        'second_business_activities'    => $this->characterReplace($business2),
                        'third_business_activities'     => $this->characterReplace($business3),
                        'country'                       => $country,
                        'date'                          => date('Y-m-d H:i:s')
                    );
        $this->addressbook_model->_insert($data);
        
        //$this->session->set_flashdata('message', 'That user has been added to your Address Book');
        redirect('member/profile/'.$mid);
    }
    
    function remove($mid)
    {
        $this->addressbook_model->_delete_where('member_id', $this->session->userdata('members_id'), 'address_member_id', $mid);
        
        //$this->session->set_flashdata('message', 'That user has been removed from your Address Book');
        redirect('member/profile/'.$mid);
    }
    
    function searchQuery($one, $two, $three, $fave = NULL)
    {
        $this->load->library('pagination');
        $data['blocked'] = $this->block_model->get_where_multiples('block_member_id', $this->session->userdata('members_id'));
        $data['base'] = $this->config->item('base_url');
        if(isset($off) && $off > 1){
            $new_mem = $off-1;
            $offset = 21*$new_mem;
        }
        else{
            $offset = 0;
        }
        
        $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
        //exit;
        
        $data['addressbook_count'] = $add_count;
        //$data['address_book'] = $this->addressbook_model->get_where_multiples('member_id', $this->session->userdata('members_id'), NULL, NULL, 21, $offset);
        if($two == 'ALL' && $three == 'ALL'){
            
            if($fave == 'yes'){
                $add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'), 'favourite', 'yes');
                
                if($add_count > 0){
                    $data['addressbook_count'] = $add_count;
                    $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE favourite = 'yes' AND member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($one)."");            
                }
                else{
                     $data['addressbook_count'] = 0;
                }
            }
            else{
                $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($one)."");
            }
            //$add_count = $this->addressbook_model->count_where('member_id', $this->session->userdata('members_id'));
            //$data['addressbook_count'] = $add_count;
            
            $config['base_url'] = $this->config->item('base_url').'addressbook/order/'.$this->characterReplace($one).'/page';
            $config['total_rows'] = $add_count;
            $config['per_page'] = 21;
            $config["uri_segment"] = 3;
            $config['use_page_numbers'] = TRUE;

            $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
            
        }
        elseif($two != 'ALL' && $three == 'ALL'){
            
            $add_count = $this->addressbook_model->_custom_query("SELECT COUNT(*) AS addressCount FROM addressbook WHERE (business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') OR (second_business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') OR (third_business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."')");
            
            if($add_count[0]->addressCount > 0){
                $data['addressbook_count'] = $add_count[0]->addressCount;
                
                if($fave == 'yes'){
                    
                        $add_count = $this->addressbook_model->_custom_query("SELECT COUNT(*) AS addressCount FROM addressbook WHERE (favourite = 'yes' AND business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') OR (favourite = 'yes' AND second_business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') OR (favourite = 'yes' AND third_business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."')");
                        if($add_count[0]->addressCount > 0){
                            $data['addressbook_count'] =
                            $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE ( favourite = 'yes' AND business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') OR (favourite = 'yes' AND second_business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') OR (favourite = 'yes' AND third_business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."')  ".$this->characterReplace($one)."");                
                        }
                        else{
                             $data['addressbook_count'] = 0;
                        }
                }
                else{
                        $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE (business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') OR (second_business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') OR (third_business_activities = '".$this->characterReplace($two)."' AND member_id = '".$this->session->userdata('members_id')."') ".$this->characterReplace($one)."");
                }
                
                $config['base_url'] = $this->config->item('base_url').'addressbook/business/'.$this->characterReplace($two).'/'.$this->characterReplace($one).'/page';
                $config['total_rows'] = $add_count[0]->addressCount;
                $config['per_page'] = 21;
                $config["uri_segment"] = 6;
                $config['use_page_numbers'] = TRUE;

                $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
            }
            else{
                $data['addressbook_count'] = 0;
            }
            
            
        }
        elseif($two == 'ALL' && $three != 'ALL'){
            
            $add_count = $this->addressbook_model->_custom_query("SELECT COUNT(*) AS addressCount FROM addressbook WHERE country = '".$three."' AND member_id = '".$this->session->userdata('members_id')."'");
            
            if($add_count[0]->addressCount > 0){
                $data['addressbook_count'] = $add_count[0]->addressCount;
                
                if($fave == 'yes'){
                    
                    $add_count = $this->addressbook_model->_custom_query("SELECT COUNT(*) AS addressCount FROM addressbook WHERE favourite = 'yes' AND country = '".$three."' AND member_id = '".$this->session->userdata('members_id')."'");
            
                    if($add_count[0]->addressCount > 0){
                        $data['addressbook_count'] = $add_count[0]->addressCount;
                        $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE favourite = 'yes' AND country = '".$three."' AND member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($one)."");                 
                    }
                    else{
                        $data['addressbook_count'] = 0;
                    }
                }
                else{
                        $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE country = '".$three."' AND member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($one).""); 
                }
                $config['base_url'] = $this->config->item('base_url').'addressbook/country/'.$this->characterReplace($three).'/'.$this->characterReplace($one).'/page';
                $config['total_rows'] = $add_count[0]->addressCount;
                $config['per_page'] = 21;
                $config["uri_segment"] = 6;
                $config['use_page_numbers'] = TRUE;

                $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
            }
            else{
                $data['addressbook_count'] = 0;
            }
        }
        elseif($two != 'ALL' && $three != 'ALL'){
            
            $add_count = $this->addressbook_model->_custom_query("SELECT COUNT(*) AS addressCount FROM addressbook WHERE business_activities = '".$this->characterReplace($two)."' AND country = '".$three."' AND member_id = '".$this->session->userdata('members_id')."'");
            
            if($add_count[0]->addressCount > 0){
                $data['addressbook_count'] = $add_count[0]->addressCount;
                
                if($fave == 'yes'){
                    
                    $add_count = $this->addressbook_model->_custom_query("SELECT COUNT(*) AS addressCount FROM addressbook WHERE favourite = 'yes' AND business_activities = '".$this->characterReplace($two)."' AND country = '".$three."' AND member_id = '".$this->session->userdata('members_id')."'");
                    
                    if($add_count[0]->addressCount > 0){
                        $data['addressbook_count'] = $add_count[0]->addressCount;
                        $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE favourite = 'yes' AND business_activities = '".$this->characterReplace($two)."' AND country = '".$three."' AND member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($one)."");                
                    }
                    else{
                        $data['addressbook_count'] = 0;
                    }
                }
                else{
                        $data['address_book'] = $this->addressbook_model->_custom_query("SELECT * FROM addressbook WHERE business_activities = '".$this->characterReplace($two)."' AND country = '".$three."' AND member_id = '".$this->session->userdata('members_id')."' ".$this->characterReplace($one)."");
                }
                $config['base_url'] = $this->config->item('base_url').'addressbook/all_info/'.$this->characterReplace($two).'/'.$this->characterReplace($three).'/'.$this->characterReplace($one).'/page';
                $config['total_rows'] = $add_count[0]->addressCount;
                $config['per_page'] = 21;
                $config["uri_segment"] = 7;
                $config['use_page_numbers'] = TRUE;

                $config['full_tag_open'] = '<div class="btn-group pull-right original">';
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
            }
            else{
                $data['addressbook_count'] = 0;
            }
        }
        
        $this->load->view('ajax-result', $data);
    }
    
    function results($result)
    {
//        foreach($result as $result){
//            echo $result[0]->id;
//        }
//        exit;
        $data['base'] = $this->config->item('base_url');
        $data['results'] = $result;
        $data['main'] = 'addressbook';        
        $data['title'] = 'GSM - Addressbook Search Results';        
        $data['page'] = 'results';
        $data['country'] = $this->country_model->_custom_query("SELECT * FROM country ORDER BY country ASC");
        $this->load->module('templates');
        $this->templates->page($data);
    }
	
}