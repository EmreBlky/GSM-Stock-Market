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
    
    function feedback($id = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Feedback';        
        $data['page'] = 'feedback';
        
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        if(isset($id)){
            $data[$var] = $this->{$var_model}->get_where($id);
        }else{
            $count = $this->{$var_model}->count_where('authorised', 'no');
            if($count > 0){
                $data[$var.'_count'] = $count;
                $data[$var] = $this->{$var_model}->get_where_multiples_order('datetime', 'DESC', 'authorised', 'no');
            }
            else{
                $data[$var.'_count'] = 0;
            }
        }
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function edit_feedback($id)
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Feedback';        
        $data['page'] = 'edit-feedback';
        
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $data[$var] = $this->{$var_model}->get_where($id);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function feedbackApprove($id)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'authorised'      => 'yes',
                    //'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Feedback Approved',
                                    'body'              => 'Your feedback has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/feedback/');
    }
    
    function feedbackUpdate($id)
    {
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'authorised'      => 'yes',
                    'comments'       => nl2br($this->input->post('content')),
                    //'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Feedback Approved',
                                    'body'              => 'Your feedback has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/feedback/');
    }
            
    function feedbackDecline($id)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $var = 'feedback';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        
        $data = array(
                    'authorised'      => 'declined',
                    //'approved_date' => date('Y-m-d H:i:s')
                  );
        $this->{$var_model}->_update($id, $data);
        
        redirect('admin/feedback/');
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

        $this->form_validation->set_rules('product_mpn', 'product mpn', '');
        $this->form_validation->set_rules('product_isbn', 'product isbn', '');
        $this->form_validation->set_rules('product_make', 'product make', 'required');
        $this->form_validation->set_rules('product_model', 'product model', 'required');
        $this->form_validation->set_rules('product_type', 'product type', 'required');
        $this->form_validation->set_rules('product_color', 'product color', 'required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_insert=array(
            'product_mpn' =>  $this->input->post('product_mpn'),
            'product_isbn' =>  $this->input->post('product_isbn'),
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

    function listing()
    {
        $this->check_authentication();//check login authentication

        $data['listing'] =  $this->admin_model->get_result('listing', array('status'=>0));
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing';  
        $data['page'] = 'listing';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

   function listing_status($id='',$status='',$offset=''){
        $user_status = '';
        $msg_success = '';
       
        if($status=='1'){

            $this->admin_model->update('listing',array('status'=>1),array('id'=>$id));
            $user_status = "Approve";
            $msg_success = "Listing Status Approve successfully.";

        }else if($status=='3'){
            $this->admin_model->delete('listing',array('id'=>$id));
            $user_status = "Decline";
            $msg_success = "Listing Status Decline successfully.";

        }
        // $email_template=$this->developer_email->get_email_template(3);

        // $param=array(
        //    'template'  =>  array(
        //         'temp'  =>  $email_template->template_body,
        //         'var_name'  =>  array(
        //                 'user_name'  => $member_info->firstname.' '. $member_info->lastname,
        //                 'status'=> $user_status,
        //                 'message'=> $msg_success,
        //                 'site_name'=>SITE_NAME,

        //               ),
        //           ),
        //     'email' =>  array(
        //     'to'    =>  $member_info->email,
        //     'from'  =>   NO_REPLY_EMAIL,
        //     'from_name' =>   SITE_NAME,
        //     'subject' =>   $email_template->template_subject,
        //   )
        // );

        // $this->developer_email->send_mail($param);
        $this->session->set_flashdata('msg_success',$msg_success);
        redirect('admin/listing');
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
        

        $this->form_validation->set_rules('product_mpn', 'product mpn', '');
        $this->form_validation->set_rules('product_isbn', 'product isbn', '');
        $this->form_validation->set_rules('product_make', 'product_make', 'required');
        $this->form_validation->set_rules('product_model', 'product_model', 'required');
        $this->form_validation->set_rules('product_type', 'product_type', 'required');
        $this->form_validation->set_rules('product_color', 'product_color', 'required');
       
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_update=array(
            'product_mpn' =>  $this->input->post('product_mpn'),
            'product_isbn' =>  $this->input->post('product_isbn'),
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

    public function couriers(){
        $this->check_authentication();//check login authentication

        $data['couriers'] =  $this->admin_model->get_result('couriers');
        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: couriers';
        $data['page'] = 'couriers';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function courier_add(){
        $this->check_authentication();//check login authentication

       $this->form_validation->set_rules('courier_name', 'courier name', 'required');
        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'courier_name'=>$this->input->post('courier_name'),
                //'description'=>$this->input->post('description'),
                );
           if($this->admin_model->insert('couriers',$post_data)){
            $this->session->set_flashdata('msg_success','courier added successfully.');
            redirect('admin/couriers');
           }
        }

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: courier Add New';
        $data['page'] = 'courier_add';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function courier_edit($id=0){
         if(empty($id)){ redirect('admin/couriers'); }

        $data['couriers']= $this->admin_model->get_row('couriers',array('id'=>$id));
        if( $data['couriers']==FALSE)  redirect('admin/couriers');

        $this->form_validation->set_rules('courier_name', 'courier name', 'required');
        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'courier_name'=>$this->input->post('courier_name'),
                //'description'=>$this->input->post('description'),
                );
           if($this->admin_model->update('couriers',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','courier updated successfully.');
            redirect('admin/couriers');
           }
        }

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: courier Edit';
        $data['page'] = 'courier_edit';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function courier_delete($id=0){
          $this->check_authentication();//check login authentication
        if(empty($id)){ redirect('admin/couriers'); }

        if($this->admin_model->delete('couriers',array('id'=>$id))){
            $this->session->set_flashdata('msg_success','courier deleted successfully.');
           redirect('admin/couriers');
        }
    }

    // shipping
    public function shippings(){
        $this->check_authentication();//check login authentication

        $data['shippings'] =  $this->admin_model->get_result('shippings');
        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: shippings';
        $data['page'] = 'shippings';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function shipping_add(){
        $this->check_authentication();//check login authentication

       $this->form_validation->set_rules('shipping_name', 'shipping name', 'required');
       $this->form_validation->set_rules('couriers[]', 'Couriers', 'required');

        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'shipping_name' =>$this->input->post('shipping_name'),
                'description'   =>$this->input->post('description'),
                'couriers'      =>json_encode($this->input->post('couriers')),
                );
           if($this->admin_model->insert('shippings',$post_data)){
            $this->session->set_flashdata('msg_success','shipping added successfully.');
            redirect('admin/shippings');
           }
        }

        $data['couriers'] = $this->admin_model->get_result('couriers');

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: shipping Add New';
        $data['page'] = 'shipping_add';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function shipping_edit($id=0){
         if(empty($id)){ redirect('admin/shippings'); }

        $data['shippings']= $this->admin_model->get_row('shippings',array('id'=>$id));
        if( $data['shippings']==FALSE)  redirect('admin/shippings');

        $this->form_validation->set_rules('shipping_name', 'shipping name', 'required');
        $this->form_validation->set_rules('couriers[]', 'Couriers', 'required');
        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'shipping_name'=>$this->input->post('shipping_name'),
                'description'=>$this->input->post('description'),
                'couriers'      =>json_encode($this->input->post('couriers')),
                );
           if($this->admin_model->update('shippings',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','shipping updated successfully.');
            redirect('admin/shippings');
           }
        }

        $data['couriers'] = $this->admin_model->get_result('couriers');

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: shipping Edit';
        $data['page'] = 'shipping_edit';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function shipping_delete($id=0){
          $this->check_authentication();//check login authentication
        if(empty($id)){ redirect('admin/shippings'); }

        if($this->admin_model->delete('shippings',array('id'=>$id))){
            $this->session->set_flashdata('msg_success','shipping deleted successfully.');
           redirect('admin/shippings');
        }
    }

    // listing categories
     public function listing_categories($offset=0){
        $this->check_authentication();//check login authentication

        $per_page=20;
        $data['listing_categories'] = $this->admin_model->listing_categories($offset,$per_page);
        $config=backend_pagination();
        $config['base_url'] = base_url().'admin/listing_categories/';
        $config['total_rows'] = $this->admin_model->listing_categories(0,0);
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 3;
        if(!empty($_SERVER['QUERY_STRING'])){
        $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
        }else{
        $config['suffix'] ='';
        }
        $config['first_url'] = $config['base_url'].$config['suffix'];
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        $data['offset'] = $offset;


        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: shippings';
        $data['page'] = 'listing_categories';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function listing_category_add(){
       $this->check_authentication();//check login authentication

       $this->form_validation->set_rules('category_name', 'Category name', 'required');
       $this->form_validation->set_rules('parent_id', 'Parent Category name', 'required');

        if ($this->form_validation->run() == TRUE) {
            $post_data=array(
                'parent_id'     => $this->input->post('parent_id'),
                'category_name' => $this->input->post('category_name')
                );
           if($this->admin_model->insert('listing_categories',$post_data)){
            $this->session->set_flashdata('msg_success','Category name added successfully.');
            redirect('admin/listing_categories');
           }
        }

        $data['listing_parent_categories'] = $this->admin_model->get_result('listing_categories',array('parent_id'=>0));

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: listing category Add New';

        $data['page'] = 'listing_category_add';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function listing_category_edit($id=0){
         if(empty($id)){ redirect('admin/listing_categories'); }

        $data['listing_categories']= $this->admin_model->get_row('listing_categories',array('id'=>$id));
        if( $data['listing_categories']==FALSE)  redirect('admin/listing_categories');

        $this->form_validation->set_rules('category_name', 'Category name', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent Category name', 'required');

        if ($this->form_validation->run() == TRUE) {
             $post_data=array(
                'parent_id'     => $this->input->post('parent_id'),
                'category_name' => $this->input->post('category_name')
                );
           if($this->admin_model->update('listing_categories',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','listing category updated successfully.');
            redirect('admin/listing_categories');
           }
        }

        $data['listing_parent_categories'] = $this->admin_model->get_result('listing_categories',array('parent_id'=>0));

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: listing category Edit';
        $data['page'] = 'listing_category_edit';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function listing_category_delete($id=0){
          $this->check_authentication();//check login authentication
        if(empty($id)){ redirect('admin/listing_categories'); }

        if($this->admin_model->delete('listing_categories',array('id'=>$id))){
            $this->session->set_flashdata('msg_success','listing category deleted successfully.');
           redirect('admin/listing_categories');
        }
    }
}