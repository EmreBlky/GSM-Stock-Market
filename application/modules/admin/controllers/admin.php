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
        else{
            redirect('admin/dashboard');
        }
        
    
    }
    
    function dashboard()
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
    
    function company_bio($id = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Company Bio';        
        $data['page'] = 'company-bio';
        
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        if(isset($id)){
            $data[$var] = $this->{$var_model}->get_where($id);
        }else{
            $count = $this->{$var_model}->_custom_query_count('SELECT COUNT(*) AS count FROM company WHERE company_profile_approval != ""');
            if($count[0]->count > 0){
                $data[$var.'_count'] = $count[0]->count;
                $data[$var] = $this->{$var_model}->_custom_query('SELECT * FROM company WHERE company_profile_approval != "" ORDER BY id DESC');
            }
            else{
                $data[$var.'_count'] = 0;
            }
        }
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function edit_bio($id)
    {
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Edit Feed';        
        $data['page'] = 'edit-bio';
        
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $data[$var] = $this->{$var_model}->get_where($id);
        
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function bioUpdate($id)
    {
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->admin_member_id;
        //echo $mem;
        //exit;
        $data = array(
                    'company_profile_approval'      => '',
                    'company_profile'               => nl2br($this->input->post('content'))
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Company Bio Approved',
                                    'body'              => 'Your company bio has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/company_bio/');
    }

    function bioApprove($id)
    {
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->admin_member_id;
        $profile = $this->{$var_model}->get_where($id)->company_profile_approval;
        
        $data = array(
                    'company_profile_approval'      => '',
                    'company_profile'               => nl2br($profile)
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Company Bio Approved',
                                    'body'              => 'Your company bio has been approved',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        $this->load->model('notification/notification_model', 'notification_model');
        $this->load->model('member/member_model', 'member_model');
        $email_support = $this->notification_model->get_where_multiple('member_id', $mem)->email_support;
                      
        if($email_support == 'yes'){

              $this->load->module('emails');
              $config = Array(
                              'protocol' => 'smtp',
                              'smtp_host' => 'ssl://server.gsmstockmarket.com',
                              'smtp_port' => 465,
                              'smtp_user' => 'noreply@gsmstockmarket.com',
                              'smtp_pass' => 'ehT56.l}iW]I2ba3f0',
                              'charset' => 'utf-8',
                              'wordwrap' => TRUE,
                              'newline' => "\r\n",
                              'crlf'    => ""

                          );

              $this->load->library('email', $config);
              $this->email->set_mailtype("html");
              $email_body = 'You have a message from the support team';


              $this->email->from('noreply@gsmstockmarket.com', 'GSM Stockmarket Support');

              //$list = array('tim@gsmstockmarket.com', 'info@gsmstockmarket.com');
              $this->email->to($this->member_model->get_where($mem)->email);
              $this->email->subject('You have a message in your inbox');
              $this->email->message($email_body);

              $this->email->send();                          
        }
        
        redirect('admin/company_bio/');
        
    }

    function bioDecline($id)
    {
        $var = 'company';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->admin_member_id;
        
        $data = array(
                    'company_profile_approval'      => '',
                    'company_profile'               => ''
                  );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'mailbox';
        $var1_model = $var1.'_model';
        
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Company Bio Declined',
                                    'body'              => 'Your company bio has been declined. Please update your information.',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var1_model}->_insert($data);
        
        redirect('admin/company_bio/');
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
        //$this->form_validation->set_rules('product_isbn', 'product isbn', '');
        $this->form_validation->set_rules('product_make', 'product make', 'required');
        $this->form_validation->set_rules('product_model', 'product model', 'required');
        $this->form_validation->set_rules('product_type', 'product type', 'required');
        $this->form_validation->set_rules('product_color', 'product color', 'required');

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_insert=array(
            'product_mpn_isbn' =>  $this->input->post('product_mpn'),
            //'product_isbn' =>  $this->input->post('product_isbn'),
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
         $items =  $this->admin_model->get_result('listing_categories','','',array('category_name','ASC'));

        if( $items){
            $tree = $this->buildTree($items);
            $data['product_types']=$this->buildTree($items);
        }else{
           $data['product_types']=FALSE;
        }
        $data['makers']  =  $this->admin_model->get_result('product_make');
        $data['models']  =  $this->admin_model->get_result('product_model');
        $data['colors']  =  $this->admin_model->get_result('product_color');

        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Listing Attribute Level';  
        $data['page'] = 'add_listing_attribute';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    private function buildTree($items) {

        $childs = array();

        foreach($items as $item)
            $childs[$item->parent_id][] = $item;

        foreach($items as $item) if (isset($childs[$item->id]))
            $item->childs = $childs[$item->id];

        return $childs[0];
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
        $listing  = $this->admin_model->get_row('listing', array('id'=>$id));
        if(empty($listing->member_id)) redirect('admin/listing');
            
        $member = $this->admin_model->get_row('members', array('id'=>$listing->member_id));
        $member_email = $member->email; //fatch member email for decline information

        if($status=='1'){

            $this->admin_model->update('listing',array('status'=>1),array('id'=>$id));
            $user_status = "Approve";
            $msg_success = "Listing Status Approve successfully.";

        }else if($status=='3'){
            $this->admin_model->delete('listing',array('id'=>$id));
            $user_status = "Decline";
            $msg_success = "Listing Status Decline successfully.";

        }

        //send email for decline listing request.

        $this->load->library('email');

        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

        $this->email->from('info@gsmstock.com', 'Admin');
        $this->email->to($member_email);
        $this->email->subject('Decline listing request');
        $html = "hello user,";
        $html .= "your listing request has been declined.";
        $this->email->message($html);

        $this->email->send();

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
       // $this->form_validation->set_rules('product_isbn', 'product isbn', '');
        $this->form_validation->set_rules('product_make', 'product_make', 'required');
        $this->form_validation->set_rules('product_model', 'product_model', 'required');
        //$this->form_validation->set_rules('product_type', 'product_type', 'required');
        $this->form_validation->set_rules('product_color', 'product_color', 'required');
       
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_update=array(
            'product_mpn' =>  $this->input->post('product_mpn'),
           // 'product_isbn' =>  $this->input->post('product_isbn'),
            'product_make' =>  $this->input->post('product_make'),
            'product_model' =>  $this->input->post('product_model'),
            //'product_type' =>  $this->input->post('product_type'),
            'product_color' =>  $this->input->post('product_color'),
            'updated' => date('Y-m-d h:i:s A'), 
            );
           $this->admin_model->update('listing_attributes',$data_update,array('id'=>$list_id));
           $this->session->set_flashdata('msg_success','Design updated successfully.');
           redirect('admin/listing_attributes');
        } 
       
        $data['listing_attributes'] =  $this->admin_model->get_row('listing_attributes',array('id'=>$list_id));
        $items =  $this->admin_model->get_result('listing_categories','','',array('category_name','ASC'));
        if( $items){
            $tree = $this->buildTree($items);
            $data['product_types']=$this->buildTree($items);
        }else{
           $data['product_types']=FALSE;
        }
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
     public function product_types($offset=0){
        $this->check_authentication();//check login authentication

        $per_page=20;
        $data['product_types'] = $this->admin_model->product_types($offset,$per_page);
        $config=backend_pagination();
        $config['base_url'] = base_url().'admin/product_types/';
        $config['total_rows'] = $this->admin_model->product_types(0,0);
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
        $data['title'] = 'GSM - Admin Panel: product types';
        $data['page'] = 'product_types';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function product_type_add(){
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
            redirect('admin/product_types');
           }
        }

        $data['product_parent_categories'] = $this->admin_model->get_result('listing_categories',array('parent_id'=>0));

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: Product Type Add New';

        $data['page'] = 'product_type_add';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function product_type_edit($id=0){
         if(empty($id)){ redirect('admin/product_types'); }

        $data['product_types']= $this->admin_model->get_row('listing_categories',array('id'=>$id));
        if( $data['product_types']==FALSE)  redirect('admin/product_types');

        $this->form_validation->set_rules('category_name', 'Category name', 'required');
        $this->form_validation->set_rules('parent_id', 'Parent Category name', 'required');

        if ($this->form_validation->run() == TRUE) {
             $post_data=array(
                'parent_id'     => $this->input->post('parent_id'),
                'category_name' => $this->input->post('category_name')
                );
           if($this->admin_model->update('listing_categories',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product type updated successfully.');
            redirect('admin/product_types');
           }
        }

        $data['product_parent_categories'] = $this->admin_model->get_result('listing_categories',array('parent_id'=>0));

        $data['main'] = 'admin';
        $data['title'] = 'GSM - Admin Panel: listing category Edit';
        $data['page'] = 'product_type_edit';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    public function product_type_delete($id=0){
          $this->check_authentication();//check login authentication
        if(empty($id)){ redirect('admin/product_types'); }

        if($this->admin_model->delete('listing_categories',array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product Type deleted successfully.');
           redirect('admin/product_types');
        }
    }

     function product_make($maker_id=0)
    {
        $this->check_authentication();//check login authentication
        if($this->input->post('product')==1){
            $this->form_validation->set_rules('product_make', 'Product maker name', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $post_data=array(
                        'product_make' => $this->input->post('product_make'),
                        'created' => date('Y-m-d')
                        );
               
                   if($this->admin_model->insert('product_make',$post_data)){
                    $this->session->set_flashdata('msg_success','Product Maker name added successfully.');
                    redirect('admin/product_make');
                   }
                } 
        }else{
    //update
            $id='';
            if(!empty($_POST['make_submit'])){
                $id = $_POST['make_submit'];
           
             
            $post_data=array(
                    'product_make' => $_POST['product_make_'.$id],
                    'created' => date('Y-m-d')
                    );
            if($this->admin_model->update('product_make',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product Maker updated successfully.');
            redirect('admin/product_make');
            }
           }
            
        }
    //delete
        if(!empty($maker_id)){
           if($this->admin_model->delete('product_make',array('id'=>$maker_id))){
                $this->session->set_flashdata('msg_success','Product Maker delete successfully.');
                redirect('admin/product_make');
                }  
        }

        $data['product_makers'] =  $this->admin_model->get_result('product_make');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Product Make';  
        $data['page'] = 'product_make';
        $this->load->module('templates');
        $this->templates->admin($data);
    }


     function product_model($model_id=0)
    {
        $this->check_authentication();//check login authentication
        if($this->input->post('product')==1){
            $this->form_validation->set_rules('product_model', 'Product model name', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $post_data=array(
                        'product_model' => $this->input->post('product_model'),
                        'created' => date('Y-m-d')
                        );
               
                   if($this->admin_model->insert('product_model',$post_data)){
                    $this->session->set_flashdata('msg_success','Product model name added successfully.');
                    redirect('admin/product_model');
                   }
                } 
        }else{
    //update
            $id='';
            if(!empty($_POST['model_submit'])){
                $id = $_POST['model_submit'];
           
             
            $post_data=array(
                    'product_model' => $_POST['product_model_'.$id],
                    'created' => date('Y-m-d')
                    );
            if($this->admin_model->update('product_model',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product model updated successfully.');
            redirect('admin/product_model');
            }
           }
            
        }
    //delete
        if(!empty($model_id)){
           if($this->admin_model->delete('product_model',array('id'=>$model_id))){
                $this->session->set_flashdata('msg_success','Product model delete successfully.');
                redirect('admin/product_model');
                }  
        }

        $data['product_model'] =  $this->admin_model->get_result('product_model');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Product model';  
        $data['page'] = 'product_model';
        $this->load->module('templates');
        $this->templates->admin($data);
    }

    function product_color($color_id=0)
    {
        $this->check_authentication();//check login authentication
        if($this->input->post('product')==1){
            $this->form_validation->set_rules('product_color', 'Product color name', 'required');
                if ($this->form_validation->run() == TRUE) {
                    $post_data=array(
                        'product_color' => $this->input->post('product_color'),
                        'created' => date('Y-m-d')
                        );
               
                   if($this->admin_model->insert('product_color',$post_data)){
                    $this->session->set_flashdata('msg_success','Product color name added successfully.');
                    redirect('admin/product_color');
                   }
                } 
        }else{
    //update
            $id='';
            if(!empty($_POST['color_submit'])){
                $id = $_POST['color_submit'];
           
             
            $post_data=array(
                    'product_color' => $_POST['product_color_'.$id],
                    'created' => date('Y-m-d')
                    );
            if($this->admin_model->update('product_color',$post_data,array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Product color updated successfully.');
            redirect('admin/product_color');
            }
           }
            
        }
    //delete
        if(!empty($color_id)){
           if($this->admin_model->delete('product_color',array('id'=>$color_id))){
                $this->session->set_flashdata('msg_success','Product color delete successfully.');
                redirect('admin/product_color');
                }  
        }

        $data['product_color'] =  $this->admin_model->get_result('product_color');
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Product color';  
        $data['page'] = 'product_color';
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function upgrades($id = NULL)
    {
        if ( ! $this->session->userdata('admin_logged_in'))
        { 
            redirect('admin/login');
        }
        $data['main'] = 'admin';        
        $data['title'] = 'GSM - Admin Panel: Account Upgrades';        
        $data['page'] = 'upgrades';
        
        $var = 'transaction';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        if(isset($id)){
            $data[$var] = $this->{$var_model}->get_where($id);
        }else{
            $count = $this->{$var_model}->count_where('status', 'not_completed');
            if($count > 0){
                $data[$var.'_count'] = $count;
                $data[$var] = $this->{$var_model}->get_where_multiples_order('date', 'DESC', 'status', 'not_completed');
            }
            else{
                $data[$var.'_count'] = 0;
            }
        }
        $this->load->module('templates');
        $this->templates->admin($data);
    }
    
    function upgradeApprove($id)
    {
        $var = 'transaction';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        $mem = $this->{$var_model}->get_where($id)->buyer_id;
        $item = $this->{$var_model}->get_where($id)->item;
        
        $data = array(                   
                        'status'               => 'completed'
                      );
        $this->{$var_model}->_update($id, $data);
        
        $var1 = 'member';
        $var1_model = $var1.'_model';
                
        $this->load->model(''.$var1.'/'.$var1.'_model', ''.$var1.'_model');
        
        if($item == 'GSMStockmarket - Silver Membership Fee (1 Year)'){
            
            $data = array(             
                        'membership'          => 2,
                        'membership_expire_date' => date("Y-m-d H:i:s", strtotime("+1 year", strtotime(date("Y-m-d H:i:s"))))
                      ); 
            $this->{$var1_model}->_update($mem, $data);
            
        }
        
        if($item == 'GSMStockmarket - Silver Membership Fee (6 Months)'){
            
            $data = array(             
                        'membership'          => 2,
                        'membership_expire_date' => date("Y-m-d H:i:s", strtotime("+6 months", strtotime(date("Y-m-d H:i:s"))))
                      ); 
            $this->{$var1_model}->_update($mem, $data);
            
        }
        
        $var2 = 'mailbox';
        $var2_model = $var2.'_model';
        
        $this->load->model(''.$var2.'/'.$var2.'_model', ''.$var2.'_model');
        
         $data = array(
                                    'member_id'         => 5,
                                    'sent_member_id'    => $mem,
                                    'subject'           => 'Member Profile Upgraded',
                                    'body'              => 'Your Profile has been upgraded. Please logout and log back in to activate your membership.',
                                    'inbox'             => 'yes',
                                    'sent'              => 'yes',
                                    'date'              => date('d-m-Y'),
                                    'time'              => date('H:i'),
                                    'sent_from'         => 'support',
                                    'datetime'          => date('Y-m-d H:i:s')
                                  ); 
        $this->{$var2_model}->_insert($data);
        
        redirect('admin/upgrades/');
    }
    
    function upgradeDecline($id)
    {
        $var = 'transaction';
        $var_model = $var.'_model';
        
        $this->load->model(''.$var.'/'.$var.'_model', ''.$var.'_model');
        //$mem = $this->{$var_model}->get_where($id)->buyer_id;
        //$profile = $this->{$var_model}->get_where($id)->company_profile_approval;
        
        $data = array(                   
                        'status'               => 'declined'
                      );
        $this->{$var_model}->_update($id, $data);
        
        redirect('admin/upgrades/');
    }
}
