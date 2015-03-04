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
    }

    function index()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function buy($offset=0)
    {
        $per_page=10;
        $data['listing_buy'] = $this->marketplace_model->listing_buy($offset,$per_page);
        $config=backend_pagination();
        $config['base_url'] = base_url().'marketplace/buy';
        $config['total_rows'] = $this->marketplace_model->listing_buy(0,0);
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        if(!empty($_SERVER['QUERY_STRING'])){
        $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
        }
        else{
        $config['suffix'] ='';
        }
        $config['first_url'] = $config['base_url'].$config['suffix'];
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        $data['offset'] = $offset;
        
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Purchase';        
        $data['page'] = 'buy';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sell($offset=0)
    {
        $per_page=10;
        $data['listing_sell'] = $this->marketplace_model->listing_sell($offset,$per_page);
        $config=backend_pagination();
        $config['base_url'] = base_url().'marketplace/buy';
        $config['total_rows'] = $this->marketplace_model->listing_sell(0,0);
        $config['per_page'] = $per_page;
        $config['uri_segment'] = 4;
        if(!empty($_SERVER['QUERY_STRING'])){
        $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
        }
        else{
        $config['suffix'] ='';
        }
        $config['first_url'] = $config['base_url'].$config['suffix'];
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();
        $data['offset'] = $offset;

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
        //$this->output->enable_profiler(TRUE);
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
        $this->form_validation->set_rules('unit_price', 'unit price', 'required|numeric');
        if(isset($_POST['minimum_checkbox'])){
          $this->form_validation->set_rules('min_price', 'min price', 'required|numeric');
        }
        if(isset($_POST['allowoffer_checkbox'])){
           $this->form_validation->set_rules('allow_offer', 'allow offer', 'required');
        }
        $this->form_validation->set_rules('total_qty', 'total quantity', 'required|numeric');
        if(isset($_POST['orderqunatity_checkbox'])){
           $this->form_validation->set_rules('min_qty_order', 'min quantity order', 'required|numeric');
        }
        $this->form_validation->set_rules('shipping_term', 'shipping term', 'required');
        $this->form_validation->set_rules('courier[]', 'courier', 'required');
        $this->form_validation->set_rules('product_desc', 'product description', 'required');
        $this->form_validation->set_rules('duration', 'duration', 'required');
        $this->form_validation->set_rules('termsandcondition', 'Terms and condition', 'required');
        $this->form_validation->set_rules('image1','','callback_image1_check');

        if(!empty($_FILES['image2']['name'])){
            $this->form_validation->set_rules('image2', '', 'callback_image2_check2');
            }

        if(!empty($_FILES['image3']['name'])){
            $this->form_validation->set_rules('image3', '', 'callback_image3_check3');
            }

         if(!empty($_FILES['image4']['name'])){
            $this->form_validation->set_rules('image4', '', 'callback_image4_check4');
            }

        if(!empty($_FILES['image5']['name'])){
        $this->form_validation->set_rules('image5', '', 'callback_image5_check5');
        }
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run($this) == TRUE){
           die('testing');
           $min_price='';
           $allow_offer='';
           $min_qty_order='';

           if(isset($_POST['minimum_checkbox'])){
              $min_price=$this->input->post('min_price');
            }
            if(isset($_POST['allowoffer_checkbox'])){
               $allow_offer=$this->input->post('allow_offer');
            }
            
            if(isset($_POST['orderqunatity_checkbox'])){
               $min_qty_order=$this->input->post('min_qty_order');
            }

            $courier='';
            if($courier_array=$this->input->post('courier')){
                foreach ($courier_array as $value) {
                    $courierinfo=courier_class($value);
                    $courier=$courierinfo.','.$courier;
                }
            }

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
            'min_price' =>  $min_price,
            'allow_offer' =>  $allow_offer,
            'total_qty' =>  $this->input->post('total_qty'),
            'qty_available'=> $this->input->post('total_qty'),
            'min_qty_order' =>  $min_qty_order,
            'shipping_term' =>  $this->input->post('shipping_term'),
            'courier' =>  $courier,
            'product_desc' =>  $this->input->post('product_desc'),
            'duration' =>  $this->input->post('duration'),
            'listing_end_datetime'  => date('Y-m-d H:i:s', strtotime("+".$this->input->post('duration')." days")),            
            'member_id'   => $member_id, 
            'status'  => $this->input->post('status'), 
            'created' => date('Y-m-d h:i:s A'),
            );
            
            if($this->session->userdata('image1_check')!=''):
                $image1_check=$this->session->userdata('image1_check');
                $data_insert['image1'] = 'public/upload/listing/'.$image1_check['image1'];
               $this->session->unset_userdata('image1_check');
            endif;

            if($this->session->userdata('image2_check2')!=''):
                $image2_check2=$this->session->userdata('image2_check2');
                $data_insert['image2'] = 'public/upload/listing/'.$image2_check2['image2'];
                $this->session->unset_userdata('image2_check2');
            endif;

            if($this->session->userdata('check3_image3')!=''):
                $check3_image3=$this->session->userdata('check3_image3');
                $data_insert['image3'] = 'public/upload/listing/'.$check3_image3['image3'];
                $this->session->unset_userdata('check3_image3');
            endif;

            if($this->session->userdata('check4_image4')!=''):
                $check4_image4=$this->session->userdata('check4_image4');
                $data_insert['image4'] = 'public/upload/listing/'.$check4_image4['image4'];
                $this->session->unset_userdata('check4_image4');
            endif;

            /*if($this->session->userdata('check5_image5')!=''):
                $check5_image5=$this->session->userdata('check5_image5');
                $data_insert['image5'] = 'public/upload/listing/'.$check5_image5['image5'];
                $this->session->unset_userdata('check5_image5');
            endif;*/

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


    function image1_check($str){
    if(empty($_FILES['image1']['name'])){
            $this->form_validation->set_message('image1_check','Choose Color Image');
           return FALSE;
        }  
    if(!empty($_FILES['image1']['name'])):
        $config1['upload_path'] = './public/upload/listing/';
        $config1['allowed_types'] = 'gif|jpg|png';
        $config1['max_size']  = '5024';
        $config1['max_width']  = '5024';
        $config1['max_height']  = '5024';
        $this->load->library('upload');
        $this->upload->initialize($config1);
        
        if ( ! $this->upload->do_upload('image1')){
            $this->form_validation->set_message('image1_check', $this->upload->display_errors());
            return FALSE;
        }else{
            $data = $this->upload->data(); // upload image 
            $this->session->unset_userdata('image1_check');
            $this->session->set_userdata('image1_check',array('image_url'=>$config1['upload_path'].$data['file_name'],'image1'=>$data['file_name']));
            return TRUE;
        }
    else:
        $this->form_validation->set_message('image1_check', 'The %s field required.');
        return FALSE;
    endif;
    }

    function image2_check2($str){
       
    if(empty($_FILES['image2']['name'])){
            $this->form_validation->set_message('image2_check2','Choose Color Image');
           return FALSE;
        }  
    if(!empty($_FILES['image2']['name'])):
        $config2['upload_path'] = './public/upload/listing/';
        $config2['allowed_types'] = 'gif|jpg|png';
        $config2['max_size']  = '5024';
        $config2['max_width']  = '5024';
        $config2['max_height']  = '5024';
        $this->load->library('upload');
        $this->upload->initialize($config2);
        
        if ( ! $this->upload->do_upload('image2')){
            $this->form_validation->set_message('image2_check2', $this->upload->display_errors());
            return FALSE;
        }else{
            $data = $this->upload->data(); // upload image 
            $this->session->unset_userdata('image2_check2');
            $this->session->set_userdata('image2_check2',array('image_url'=>$config2['upload_path'].$data['file_name'],'image2'=>$data['file_name']));
            return TRUE;
        }
    else:
        $this->form_validation->set_message('image1_check2', 'The %s field required.');
        return FALSE;
    endif;
    }

    function image3_check3($str){
    if(empty($_FILES['image3']['name'])){
            $this->form_validation->set_message('image3_check3','Choose Color Image');
           return FALSE;
        }  
    if(!empty($_FILES['image3']['name'])):
        $config3['upload_path'] = './public/upload/listing/';
        $config3['allowed_types'] = 'gif|jpg|png';
        $config3['max_size']  = '5024';
        $config3['max_width']  = '5024';
        $config3['max_height']  = '5024';
        $this->load->library('upload');
        $this->upload->initialize($config3);
        
        if ( ! $this->upload->do_upload('image3')){
            $this->form_validation->set_message('image3_check3', $this->upload->display_errors());
            return FALSE;
        }else{
            $data = $this->upload->data(); // upload image 
            $this->session->unset_userdata('image3_check3');
            $this->session->set_userdata('image3_check3',array('image_url'=>$config3['upload_path'].$data['file_name'],'image3'=>$data['file_name']));
            return TRUE;
        }
    else:
        $this->form_validation->set_message('image3_check3', 'The %s field required.');
        return FALSE;
    endif;
    }

    function image4_check4($str){
    if(empty($_FILES['image4']['name'])){
            $this->form_validation->set_message('image4_check4','Choose Color Image');
           return FALSE;
        }  
    if(!empty($_FILES['image4']['name'])):
        $config4['upload_path'] = './public/upload/listing/';
        $config4['allowed_types'] = 'gif|jpg|png';
        $config4['max_size']  = '5024';
        $config4['max_width']  = '5024';
        $config4['max_height']  = '5024';
        $this->load->library('upload');
        $this->upload->initialize($config4);
        
        if ( ! $this->upload->do_upload('image4')){
            $this->form_validation->set_message('image4_check4', $this->upload->display_errors());
            return FALSE;
        }else{
            $data = $this->upload->data(); // upload image 
            $this->session->unset_userdata('image4_check4');
            $this->session->set_userdata('image4_check4',array('image_url'=>$config4['upload_path'].$data['file_name'],'image4'=>$data['file_name']));
            return TRUE;
        }
    else:
        $this->form_validation->set_message('image4_check4', 'The %s field required.');
        return FALSE;
    endif;
    }
    
  function image5_check5($str){
    if(empty($_FILES['image5']['name'])){
            $this->form_validation->set_message('image5_check5','Choose Color Image');
           return FALSE;
        }  
    if(!empty($_FILES['image5']['name'])):
        $config5['upload_path'] = './public/upload/listing/';
        $config5['allowed_types'] = 'gif|jpg|png';
        $config5['max_size']  = '5024';
        $config5['max_width']  = '5024';
        $config5['max_height']  = '5024';
        $this->load->library('upload');
        $this->upload->initialize($config5);
        
        if ( ! $this->upload->do_upload('image5')){
            $this->form_validation->set_message('image5_check5', $this->upload->display_errors());
            return FALSE;
        }else{
            $data = $this->upload->data(); // upload image 
            $this->session->unset_userdata('image5_check5');
            $this->session->set_userdata('image5_check5',array('image_url'=>$config5['upload_path'].$data['file_name'],'image5'=>$data['file_name']));
            return TRUE;
        }
    else:
        $this->form_validation->set_message('image5_check5', 'The %s field required.');
        return FALSE;
    endif;
    }

    function listing_detail($id)
    {   
        if(empty($id)) { redirect('marketplace/index'); }
        $member_id=$this->session->userdata('members_id');
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place';        
        $data['page'] = 'listing_detail';
        $data['listing_detail'] =  $this->marketplace_model->get_row('listing',array('id'=>$id,'member_id'=>$member_id));
        $this->load->module('templates');
        $this->templates->page($data);
    }
}