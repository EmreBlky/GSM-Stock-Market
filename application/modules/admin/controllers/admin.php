<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Admin extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();   
        //$CI =& get_instance();
        $this->load->model('admin_model');     
       
    }
    function index()
    { 
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel';        
        $data['page'] = 'dashboard';
        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function login()
    {
        $data['main'] = 'admin';
        $data['title'] = 'Admin - Please Login';        
        $data['page'] = 'login';
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function view_dashboard()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $this->load->view('dashboard');
	
    }
    
    function add_company()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['page'] = 'add-company';
        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_add_company()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $this->load->view('add-company');
	
    }
    
    function bulk_import()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['page'] = 'bulk-import';
        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_bulk_import()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $this->load->view('bulk-import');
	
    }
    
    function export()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['page'] = 'export';
        $this->load->module('templates');
        $this->templates->admin($data);
	
    }
    
    function view_export()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $this->load->view('export');
	
    }
    
    function feed($id = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Feed';        
        $data['page'] = 'feed';
        
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        if(isset($id)){
            $data[$var] = $this->{$var_model}->get_where($id);
        }else{
            $count = $this->{$var_model}->count_where('approved', 'awaiting_approval');
            if($count > 0){
                $data[$var.'_count'] = $count;
                $data[$var] = $this->{$var_model}->get_where_multiples_order('datetime', 'DESC', 'approved', 'awaiting_approval');
            }
            else{
                $data[$var.'_count'] = 0;
            }
        }
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function edit_feed($id)
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Edit Feed';        
        $data['page'] = 'edit-feed';
        
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $data[$var] = $this->{$var_model}->get_where($id);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function feedApprove($id)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'approved'      => 'yes',
                    'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Feed Approved',
                                    'body'              => 'Your feed has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/feed/');
    }
    
    function feedUpdate($id)
    {
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'approved'      => 'yes',
                    'content'       => nl2br($this->input->post('content')),
                    'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Feed Approved',
                                    'body'              => 'Your feed has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/feed/');
    }
            
    function feedDecline($id)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $var = 'feed';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data = array(
                    'approved'      => 'no',
                    'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        redirect('admin/feed/');
    }
    
    function user_level()
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: User Level';        
        $data['page'] = 'user-level';
        
        
        
        $var = 'membership';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data[$var] = $this->{$var_model}->get_where_multiples_order('id', 'DESC', 'id >', 0);
           
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function updateUserLevel($mid, $var, $status)
    {
        $mid      = str_replace("'", "", $mid);
        $var      = str_replace("'", "", $var);
        $status   = str_replace("'", "", $status);
        
        $data = array(
                        $var     => $status
                      );
        $this->load->model('membership/membership_model', 'membership_model');
        $this->membership_model->_update_where($data, 'id', $mid);
    }

    function check_authentication(){
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
    }
/*add listing attributes*/
    function add_listing_attribute()
    {
        $this->check_authentication();//check login authentication
       
        $this->form_validation->set_rules('product_mpn_isbn', 'product_mpn_isbn', 'required');
        $this->form_validation->set_rules('product_make', 'product_make', 'required');
        $this->form_validation->set_rules('product_model', 'product_model', 'required');
        $this->form_validation->set_rules('product_type', 'product_type', 'required');
        $this->form_validation->set_rules('product_color', 'product_color', 'required');
       
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_insert=array(
            'product_mpn_isbn' =>  $this->input->post('product_mpn_isbn'),
            'product_make' =>  $this->input->post('product_make'),
            'product_model' =>  $this->input->post('product_model'),
            'product_type' =>  $this->input->post('product_type'),
            'product_color' =>  $this->input->post('product_color'),
            'created' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->insert('listing_attributes',$data_insert);
           $this->session->set_flashdata('msg_success','List Attribute added successfully.');
           redirect('admin/listing_attributes');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'add_listing_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function listing_attributes()
    {
        $this->check_authentication();//check login authentication


        $data['listing_attributes'] =  $this->admin_model->get_result('listing_attributes');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'listing_attributes';
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    function edit_listing_attribute($list_id='')
    {
        $this->check_authentication();//check login authentication
        

        $this->form_validation->set_rules('product_mpn_isbn', 'product_mpn_isbn', 'required');
        $this->form_validation->set_rules('product_make', 'product_make', 'required');
        $this->form_validation->set_rules('product_model', 'product_model', 'required');
        $this->form_validation->set_rules('product_type', 'product_type', 'required');
        $this->form_validation->set_rules('product_color', 'product_color', 'required');
       
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_update=array(
            'product_mpn_isbn' =>  $this->input->post('product_mpn_isbn'),
            'product_make' =>  $this->input->post('product_make'),
            'product_model' =>  $this->input->post('product_model'),
            'product_type' =>  $this->input->post('product_type'),
            'product_color' =>  $this->input->post('product_color'),
            'updated' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->update('listing_attributes',$data_update,array('id'=>$list_id));
           $this->session->set_flashdata('msg_success','Design updated successfully.');
           redirect('admin/listing_attributes');
        } 
       
        $data['listing_attributes'] =  $this->admin_model->get_row('listing_attributes',array('id'=>$list_id));
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'edit_listing_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

     function delete_listing_attribute($list_id='')
    {
        $this->check_authentication();//check login authentication
        if(empty($list_id)){ redirect('admin/listing_attributes'); } 

        if($this->admin_model->delete('listing_attributes',array('id'=>$list_id))){
            $this->session->set_flashdata('msg_success','Listing Attribute deleted successfully.');
           redirect('admin/listing_attributes'); 
        } 
       
      
    }
}