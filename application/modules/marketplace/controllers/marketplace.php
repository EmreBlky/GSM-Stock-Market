<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketplace extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
        if ( ! $this->session->userdata('logged_in'))
        { 
            redirect('login');
        }
         $this->load->model('marketplace_model'); 
         
         $this->load->model('activity/activity_model', 'activity_model');
        
        $data_activity = array(
                                'activity' => 'Market Place',
                                'time' => date('H:i:s')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
    }

    function index()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function buy()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Purchase';        
        $data['page'] = 'buy';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sell()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Sell';        
        $data['page'] = 'sell';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function watching()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Watching';        
        $data['page'] = 'watching';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function all()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: All';        
        $data['page'] = 'all';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Invoice';        
        $data['page'] = 'invoice';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function create_listing()
    {   
        $member_id=$this->session->userdata('members_id');

        $this->output->enable_profiler(TRUE);
        $this->form_validation->set_rules('schedule_date_time', 'schedule date time', 'required');
        $this->form_validation->set_rules('listing_type', 'listing type', 'required');
        $this->form_validation->set_rules('product_mpn_isbn', 'product_mpn_isbn', 'required');
        $this->form_validation->set_rules('product_make', 'product make', 'required');
        $this->form_validation->set_rules('product_model', 'product_model', 'required');
        $this->form_validation->set_rules('product_type', 'product type', 'required');
        $this->form_validation->set_rules('product_color', 'product_color', 'required');
        $this->form_validation->set_rules('condition', 'condition', 'required');
        $this->form_validation->set_rules('spec', 'spec', 'required');
        $this->form_validation->set_rules('currency', 'currency', 'required');
        $this->form_validation->set_rules('unit_price', 'unit price', 'required');
        $this->form_validation->set_rules('min_price', 'min price', 'required');
        $this->form_validation->set_rules('allow_offer', 'allow offer', 'required');
        $this->form_validation->set_rules('total_qty', 'total quantity', 'required');
        $this->form_validation->set_rules('min_qty_order', 'min quantity order', 'required');
        $this->form_validation->set_rules('shipping_term', 'shipping term', 'required');
        $this->form_validation->set_rules('courier[]', 'courier', 'required');
        $this->form_validation->set_rules('product_desc', 'product description', 'required');
        $this->form_validation->set_rules('duration', 'duration', 'required');
        /*$this->form_validation->set_rules('termsandcondition', 'Terms and condition', 'required');*/

        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $data_insert=array(
            'schedule_date_time' =>  $this->input->post('schedule_date_time'),
            'listing_type' =>$this->input->post('listing_type'),
            'product_mpn_isbn' =>$this->input->post('product_mpn_isbn'),
            'product_make' =>  $this->input->post('product_make'),
            'product_model' =>  $this->input->post('product_model'),
            'product_type' =>  $this->input->post('product_type'),
            'product_color' =>  $this->input->post('product_color'),
            'condition' =>  $this->input->post('condition'),    
            'spec' =>  $this->input->post('spec'),
            'currency' =>  $this->input->post('currency'),
            'unit_price' =>  $this->input->post('unit_price'),
            'min_price' =>  $this->input->post('min_price'),
            'allow_offer' =>  $this->input->post('allow_offer'),
            'total_qty' =>  $this->input->post('total_qty'),
            'min_qty_order' =>  $this->input->post('min_qty_order'),
            'shipping_term' =>  $this->input->post('shipping_term'),
            'courier' =>  json_encode($this->input->post('courier')),
            'product_desc' =>  $this->input->post('product_desc'),
            'duration' =>  $this->input->post('duration'),            
            'member_id'   => $member_id, 
            'created' => date('Y-m-d h:i:s A'),
            'status'  => $this->input->post('status'), 
            );

           $this->marketplace_model->insert('listing',$data_insert);
           $this->session->set_flashdata('msg_success','Listing added successfully.');
           redirect('marketplace/create_listing');
        }
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Create Listing';        
        $data['page'] = 'create-listing';
        $data['listing_attributes'] =  $this->marketplace_model->get_result('listing_attributes');

        $data['product_colors'] =  $this->marketplace_model->get_result_by_group('product_color');
        $data['product_makes'] =  $this->marketplace_model->get_result_by_group('product_make');
        $data['product_types'] =  $this->marketplace_model->get_result_by_group('product_type');

        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function open_orders()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Open Orders';        
        $data['page'] = 'open-orders';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Listing';        
        $data['page'] = 'my-listings';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sell_listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Sell Listing';        
        $data['page'] = 'sell-listing';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function saved_listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Saved Listing';        
        $data['page'] = 'saved-listing';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function buy_listing()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Buy Listing';        
        $data['page'] = 'buy-listing';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function history()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: History';        
        $data['page'] = 'order-history';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice_print()
    {

        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Invoice Print';        
        $data['page'] = 'invoice-print';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }

  function get_attributes_info(){

    $check_status='false';
     $list=array('STATUS'=>$check_status);
     if($_POST){
        $attr_id=trim($_POST['product_mpn_isbn']);
        $information = $this->marketplace_model->get_row('listing_attributes',array('product_mpn_isbn'=>$attr_id));
        $check_status='true';
        $list=array('STATUS'=>$check_status,'product_make'=>$information->product_make,'product_model'=>$information->product_model,'product_type'=>$information->product_type,'product_color'=>$information->product_color);
      }   
    header('Content-Type: application/json');
    echo json_encode($list);
        
    }
    
}