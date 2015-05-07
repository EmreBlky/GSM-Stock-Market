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
        
        if ($this->session->userdata('terms') == 'no')
        { 
            redirect('legal/terms_conditions');
        }
        // if($this->session->userdata('membership') < 2) {
        //     redirect('preferences/notice');
        // }
        
         $this->load->model('marketplace_model'); 
    }

    function index()
    {
        $this->load->model('activity/activity_model', 'activity_model');
        $data_activity = array(
                                'activity' => 'Market Place',
                                'time' => date('H:i:s'),
                                'date' => date('d-m-Y')
                                );
        $this->activity_model->_update_where($data_activity, 'member_id', $this->session->userdata('members_id'));
        
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place';        
        $data['page'] = 'index';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
      function buy()
    {
        
        $this->load->model('member/member_model', 'member_model');
        $data['member'] = $this->member_model->get_where($this->session->userdata('members_id'));


        $data['listing_buy'] =$this->marketplace_model->listing_buy();

        $member_id=$this->session->userdata('members_id');

        $data['advance_search'] = $this->marketplace_model->advance_search($member_id,2);

        $items =  $this->marketplace_model->get_result('listing_categories','','',array('category_name','ASC'));
        if( $items){
            $tree = $this->buildTree($items);
            $data['listing_categories']=$this->buildTree($items);
        }else{
           $data['listing_categories']=FALSE;
        }

        $data['member_id'] =$member_id;
        $data['main'] = 'marketplace';
        $data['title'] = 'GSM - Market Place: Purchase';
        $data['page'] = 'buy';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function sell()
    {

        $data['listing_sell'] = $this->marketplace_model->listing_sell();
        $member_id=$this->session->userdata('members_id');
        $data['advance_search'] = $this->marketplace_model->advance_search($member_id,1);

        $items =  $this->marketplace_model->get_result('listing_categories','','',array('category_name','ASC'));
        if( $items){
            $tree = $this->buildTree($items);
            $data['listing_categories']=$this->buildTree($items);
        }else{
           $data['listing_categories']=FALSE;
        }
        $data['member_id'] =$member_id;
        $data['main'] = 'marketplace';
        $data['title'] = 'GSM - Market Place: Sell';
        $data['page'] = 'sell';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function watching()
    {
        $member_id=$this->session->userdata('members_id');
        $data['seller_offer'] = $this->marketplace_model->get_watch_list($member_id,2);
        $data['buying_request'] = $this->marketplace_model->get_watch_list($member_id,1);
        $data['delete_unwatch'] = $this->marketplace_model->delete_unwatch($member_id);
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Watching';        
        $data['page'] = 'watching';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function offers()
    {
        $data['seller_offer'] = $this->marketplace_model->listing_offer_common(1);
        $data['buying_request'] = $this->marketplace_model->listing_offer_common(2);
        //$this->output->enable_profiler(TRUE);
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Offers';        
        $data['page'] = 'offers';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    

   function open_order_html()
    {
        
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Offers';        
        $data['page'] = 'open_order_html';
         
        $this->load->module('templates');
        $this->templates->page($data);
    } 
    
    function offers_html()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Offers';        
        $data['page'] = 'offers_html';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }

    function invoice($id='')
    {
        $data['invoice'] = $this->marketplace_model->invoice($id);

        if(empty($data['invoice'])){
            redirect('marketplace/history');
        }
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Invoice';        
        $data['page'] = 'invoice';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice_html()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Invoice';        
        $data['page'] = 'invoice_html';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }

    function create_listing($list_id='')
    {   

        $member_id=$this->session->userdata('members_id');
        //////////$this->output->enable_profiler(TRUE);

        $this->form_validation->set_rules('listing_categories', 'listing category', 'required');

        $this->form_validation->set_rules('schedule_date_time', '', '');
        $this->form_validation->set_rules('listing_type', 'listing type', 'required');
        $this->form_validation->set_rules('product_mpn', 'product mpn', '');
        $this->form_validation->set_rules('product_isbn', 'product isbn', '');
        $this->form_validation->set_rules('product_make', 'product make', 'required');
        $this->form_validation->set_rules('product_model', 'product model', 'required');
        $this->form_validation->set_rules('product_type', 'product type', 'required');
        $this->form_validation->set_rules('product_color', 'product color', 'required');
        $this->form_validation->set_rules('condition', 'condition', 'required');
        $this->form_validation->set_rules('spec', 'spec', 'required');
        $this->form_validation->set_rules('currency', 'currency', 'required');
        $this->form_validation->set_rules('unit_price', 'unit price', 'required|numeric');
        if(isset($_POST['minimum_checkbox'])){
          $this->form_validation->set_rules('min_price', 'min price', 'required|numeric');
        }
       
        $this->form_validation->set_rules('total_qty', 'total quantity', 'required|numeric');
        if(isset($_POST['orderqunatity_checkbox'])){
           $this->form_validation->set_rules('min_qty_order', 'min quantity order', 'required|numeric');
        }
        $this->form_validation->set_rules('shipping_term', 'shipping term', 'required');
        if(empty($list_id)){
        $this->form_validation->set_rules('courier[]', 'courier', 'required');
            
        }
        $this->form_validation->set_rules('product_desc', 'product description', 'required');
        $this->form_validation->set_rules('duration', 'duration', 'required');

        if(empty($list_id)){
            $this->form_validation->set_rules('termsandcondition', 'Terms and condition', 'required');
        }
         if(empty($list_id)){
        $this->form_validation->set_rules('image1','','callback_image1_check['.$list_id.']');
        }
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

             $shipping_term=$this->input->post('shipping_term');
            if(!empty($shipping_term)){
                $st=explode('@@',$shipping_term );
                $shipping_terms=$st[1];
            }else{
                $shipping_terms='';
            }
            $courier='';
            if($courier_array=$this->input->post('courier')){
               $courier = implode(',', $courier_array);
                /*foreach ($courier_array as $value) {
                    //$courierinfo=courier_class($value);
                    $courier=$courierinfo.','.$value;
                }*/
            }
            $schedule_date_time=date('Y-m-d h:i:s');
            if($this->input->post('schedule_date_time')){
                $schedule_date_time=$this->input->post('schedule_date_time');
            }

        /*product mpn and isbn check*/
            $product_mpn    = $this->input->post('product_mpn');
            $product_isbn   = $this->input->post('product_isbn');

            $check_product_mpn = $this->marketplace_model->get_row('listing_attributes', array('product_mpn'=>$product_mpn));
            $check_product_isbn = $this->marketplace_model->get_row('listing_attributes', array('product_isbn'=>$product_isbn));

            $status = '';
            if(!empty($check_product_mpn)){
                $status = $this->input->post('status');
            }else{
                $status = 0;
            }

            if(!empty($check_product_isbn)){
                 $status = $this->input->post('status');
            }else{
                $status = 0;
            }

            $data_insert=array(
            'schedule_date_time'    =>  $schedule_date_time,
            'listing_categories'    =>  $this->input->post('listing_categories'),
            'listing_type'          =>  $this->input->post('listing_type'),
            'product_mpn'           =>  $this->input->post('product_mpn'),
            'product_isbn'          =>  $this->input->post('product_isbn'),
            'product_make'          =>  $this->input->post('product_make'),
            'product_model'         =>  $this->input->post('product_model'),
            'product_type'          =>  $this->input->post('product_type'),
            'product_color'         =>  $this->input->post('product_color'),
            'condition'             =>  $this->input->post('condition'),    
            'spec'                  =>  $this->input->post('spec'), 
            'device_capacity'       =>  $this->input->post('device_capacity'), 
            'device_sim'            =>  $this->input->post('device_sim'),
            'currency'              =>  $this->input->post('currency'),
            'unit_price'            =>  $this->input->post('unit_price'),
            'min_price'             =>  $min_price,
            'allow_offer'           =>  $allow_offer,
            'total_qty'             =>  $this->input->post('total_qty'),
            'qty_available'         => $this->input->post('total_qty'),
            'min_qty_order'         =>  $min_qty_order,
            'shipping_term'         =>  $shipping_terms,
            'courier'               =>  $courier,
            'product_desc'          =>  $this->input->post('product_desc'),
            'duration'              =>  $this->input->post('duration'),
            'listing_end_datetime'  =>  date('Y-m-d H:i:s', strtotime("+".$this->input->post('duration')." days")),            
            'member_id'             => $member_id, 
            'status'                => $status, 
            'created'               => date('Y-m-d h:i:s A'),
            );
        $list_update = '';
        if(!empty($list_id)){
        $list_update =  $this->marketplace_model->get_row('listing', array('id'=>$list_id));
        }
            
            if($this->session->userdata('image1_check')!=''):
                if(!empty($list_update->image1)&&file_exists($list_update->image1)){
                    $img1 = explode('/', $list_update->image1);
                    @unlink($list_update->image1);
                    @unlink('public/upload/listing/small/'.$img1[3]);
                    @unlink('public/upload/listing/large/'.$img1[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img1[3]);
                }
                $image1_check=$this->session->userdata('image1_check');
                $data_insert['image1'] = 'public/upload/listing/'.$image1_check['image1'];
               $this->session->unset_userdata('image1_check');
            endif;

            if($this->session->userdata('image2_check2')!=''):
                if(!empty($list_update->image2)&&file_exists($list_update->image2)){
                   $img2 = explode('/', $list_update->image2);
                    @unlink($list_update->image2);
                    @unlink('public/upload/listing/small/'.$img2[3]);
                    @unlink('public/upload/listing/large/'.$img2[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img2[3]);
                }
                $image2_check2=$this->session->userdata('image2_check2');
                $data_insert['image2'] = 'public/upload/listing/'.$image2_check2['image2'];
                $this->session->unset_userdata('image2_check2');
            endif;

            if($this->session->userdata('check3_image3')!=''):
                if(!empty($list_update->image3)&&file_exists($list_update->image3)){
                   $img3 = explode('/', $list_update->image3);
                    @unlink($list_update->image3);
                    @unlink('public/upload/listing/small/'.$img3[3]);
                    @unlink('public/upload/listing/large/'.$img3[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img3[3]);
                }
                $check3_image3=$this->session->userdata('check3_image3');
                $data_insert['image3'] = 'public/upload/listing/'.$check3_image3['image3'];
                $this->session->unset_userdata('check3_image3');
            endif;

            if($this->session->userdata('check4_image4')!=''):
                if(!empty($list_update->image4)&&file_exists($list_update->image4)){
                   $img4 = explode('/', $list_update->image4);
                    @unlink($list_update->image4);
                    @unlink('public/upload/listing/small/'.$img4[3]);
                    @unlink('public/upload/listing/large/'.$img4[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img4[3]);
                }
                $check4_image4=$this->session->userdata('check4_image4');
                $data_insert['image4'] = 'public/upload/listing/'.$check4_image4['image4'];
                $this->session->unset_userdata('check4_image4');
            endif;

            if($this->session->userdata('check5_image5')!=''):
                if(!empty($list_update->image5)&&file_exists($list_update->image5)){
                   $img5 = explode('/', $list_update->image5);
                    @unlink($list_update->image5);
                    @unlink('public/upload/listing/small/'.$img5[3]);
                    @unlink('public/upload/listing/large/'.$img5[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img5[3]);
                }
                $check5_image5=$this->session->userdata('check5_image5');
                $data_insert['image5'] = 'public/upload/listing/'.$check5_image5['image5'];
                $this->session->unset_userdata('check5_image5');
            endif;

        if(!empty($list_id)){
            $this->marketplace_model->update('listing',$data_insert, array('id'=>$list_id));
            $this->session->set_flashdata('msg_success','Listing Update successfully.');
            redirect('marketplace/listing');
        }else{
           $this->marketplace_model->insert('listing',$data_insert);
        }
           $this->session->set_flashdata('msg_success','Listing added successfully.');
           redirect('marketplace/create_listing');
        }
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Create Listing';        
        $data['page'] = 'create-listing';
        $data['listing_attributes'] =  $this->marketplace_model->get_result('listing_attributes');
        $data['shippings'] =  $this->marketplace_model->get_result('shippings','','',array('shipping_name','ASC'));
       // $data['couriers'] =  $this->marketplace_model->get_result('couriers','','',array('courier_name','ASC'));

        $data['product_colors'] =  $this->marketplace_model->get_result_by_group('product_color');
        $data['product_makes'] =  $this->marketplace_model->get_result_by_group('product_make');
        $data['product_types'] =  $this->marketplace_model->get_result_by_group('product_type');

         $data['product_list']   =  $this->marketplace_model->get_row('listing',array('id'=>$list_id));

        $items =  $this->marketplace_model->get_result('listing_categories','','',array('category_name','ASC'));
        if( $items){
            $tree = $this->buildTree($items);
            $data['listing_categories']=$this->buildTree($items);
        }else{
           $data['listing_categories']=FALSE;
        }

        $this->load->module('templates');
        $this->templates->page($data);
    }

    function list_now_status($listing_id='')
    {
        $list_data = $this->marketplace_model->get_row('listing', array('id'=>$listing_id));
        if(!empty($list_data)){
            $this->marketplace_model->update('listing', array('status'=>1), array('id'=>$listing_id));
                $this->session->set_flashdata('msg_success', 'listing live successfully.');
                redirect('marketplace/listing');
            
        }
    }
   
    function open_orders()
    {
        ////$this->output->enable_profiler(TRUE);
        $data['sell_order'] = $this->marketplace_model->sell_order();
        $data['buy_order'] = $this->marketplace_model->buy_order();
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Open Orders';        
        $data['page'] = 'open-orders';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function listing()
    {
         $member_id=$this->session->userdata('members_id');
         $data['saved_listing'] = $this->marketplace_model->get_result('listing', array('member_id'=>$member_id,'status'=>2));
        $data['sell_offer'] = $this->marketplace_model->listing_sell_offer();
        $data['buying_request'] = $this->marketplace_model->listing_buying_offer();
        
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Listing';        
        $data['page'] = 'my-listings';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }

    function listing_html()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Listing';        
        $data['page'] = 'mylisting_html';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    function listing_detail_html()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Listing';        
        $data['page'] = 'listing_detail_html';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
     function listing_delete($listing_id='')
    {
        $member_id = $this->session->userdata('members_id');

        if(!empty($listing_id)){
        $list_update =  $this->marketplace_model->get_row('listing', array('id'=>$listing_id));
        }
        if(!empty($list_update->image1)&&file_exists($list_update->image1)){
            $img1 = explode('/', $list_update->image1);
            @unlink($list_update->image1);
            @unlink('public/upload/listing/small/'.$img1[3]);
            @unlink('public/upload/listing/large/'.$img1[3]);
            @unlink('public/upload/listing/thumbnail/'.$img1[3]);
        }

        if(!empty($list_update->image2)&&file_exists($list_update->image2)){
           $img2 = explode('/', $list_update->image2);
            @unlink($list_update->image2);
            @unlink('public/upload/listing/small/'.$img2[3]);
            @unlink('public/upload/listing/large/'.$img2[3]);
            @unlink('public/upload/listing/thumbnail/'.$img2[3]);
        }
        if(!empty($list_update->image3)&&file_exists($list_update->image3)){
           $img3 = explode('/', $list_update->image3);
            @unlink($list_update->image3);
            @unlink('public/upload/listing/small/'.$img3[3]);
            @unlink('public/upload/listing/large/'.$img3[3]);
            @unlink('public/upload/listing/thumbnail/'.$img3[3]);
        }
        if(!empty($list_update->image4)&&file_exists($list_update->image4)){
           $img4 = explode('/', $list_update->image4);
            @unlink($list_update->image4);
            @unlink('public/upload/listing/small/'.$img4[3]);
            @unlink('public/upload/listing/large/'.$img4[3]);
            @unlink('public/upload/listing/thumbnail/'.$img4[3]);
        }
        if(!empty($list_update->image5)&&file_exists($list_update->image5)){
           $img5 = explode('/', $list_update->image5);
            @unlink($list_update->image5);
            @unlink('public/upload/listing/small/'.$img5[3]);
            @unlink('public/upload/listing/large/'.$img5[3]);
            @unlink('public/upload/listing/thumbnail/'.$img5[3]);
        }
         $this->marketplace_model->delete('listing',array('id'=>$listing_id, 'member_id'=>$member_id));
         $this->session->set_flashdata('msg_success','you have listing delete successfully.');  
         redirect('marketplace/saved_listing');
     
    }
    
    function sell_listing($list_id='',$page_redirct='')
    {
     $member_id=$this->session->userdata('members_id');
    if($this->input->post('status')==1) {
        $this->form_validation->set_rules('schedule_date_time', '', '');
        $this->form_validation->set_rules('product_mpn', 'product MPN/ISBN', '');
        $this->form_validation->set_rules('product_make', 'product make', 'required');
        $this->form_validation->set_rules('product_model', 'product model', 'required');
        $this->form_validation->set_rules('product_type', 'product type', 'required');
        $this->form_validation->set_rules('product_color', 'product color', 'required');
        $this->form_validation->set_rules('condition', 'condition', 'required');
        $this->form_validation->set_rules('spec', 'spec', 'required');
        $this->form_validation->set_rules('currency', 'currency', 'required');
        $this->form_validation->set_rules('unit_price', 'unit price', 'required|numeric');
        $this->form_validation->set_rules('shipping_term', 'Shipping terms', 'required');

       
        $this->form_validation->set_rules('total_qty', 'total quantity', 'required|numeric');
        if(isset($_POST['orderqunatity_checkbox'])){
           $this->form_validation->set_rules('min_qty_order', 'min quantity order', 'required|numeric');
        }
        
        $this->form_validation->set_rules('product_desc', 'product description', 'required');
        $this->form_validation->set_rules('duration', 'duration', 'required');

        if(empty($list_id)){
            $this->form_validation->set_rules('termsandcondition', 'Terms and condition', 'required');
        }
    }else{
        $this->form_validation->set_rules('listing_type', 'listing type', '');
    }
       if(!empty($_FILES['image1']['name'])){
            $this->form_validation->set_rules('image1','','callback_image1_check');
        }
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

           $min_price='1';
           $allow_offer='';
           $min_qty_order='1';

           if(isset($_POST['minimum_checkbox'])){
              $min_price=$this->input->post('min_price');
            }else{
                $min_price='1';
            }
            if(isset($_POST['allowoffer_checkbox'])){
               $allow_offer=$this->input->post('allow_offer');
            }else{
                $allow_offer='3';
            }
            
            if(isset($_POST['orderqunatity_checkbox'])){
               $min_qty_order=$this->input->post('min_qty_order');
            }else{
                $min_qty_order='1';
            }

             $shipping_term=$this->input->post('shipping_term');
            if(!empty($shipping_term)){
                $st=explode('@@',$shipping_term );
                $shipping_terms=$st[1];
            }else{
                $shipping_terms='';
            }
            $courier='';
            if($courier_array=$this->input->post('courier')){
               $courier = implode(',', $courier_array);
                /*foreach ($courier_array as $value) {
                    //$courierinfo=courier_class($value);
                    $courier=$courierinfo.','.$value;
                }*/
            }

            if(isset($_POST['color_allow'])){
              $allow_color=1;
            }else{
               $allow_color='';
            }
            $schedule_date_time=date('Y-m-d h:i:s');
            if($this->input->post('schedule_date_time')){
                $schedule_date_time=$this->input->post('schedule_date_time');
                 $schedule_date_time=date('Y-m-d h:i:s',strtotime($schedule_date_time));
                  $data_insert['scheduled_status']   = 1;
            }else{
                 $data_insert['scheduled_status']   = 0;
            }
            
             $shipping_fee = array();
            if(!empty($_POST['shipping_terms'])){
            $arr_count = count($_POST['shipping_terms']);


            for($i=0; $i < count($_POST['shipping_terms']); $i++){
                $shiptype='';
                if($_POST['ship_types'][$i] == 'Price_per_unit'){
                    $shiptype='Price Per unit';
                }
                elseif($_POST['ship_types'][$i] == 'Free_Shipping'){
                    $shiptype='Free Shipping';
                }
                elseif($_POST['ship_types'][$i] == 'Flat_fee'){
                    $shiptype='Flat fee';
                }
                $shipping_fee[] = 
                array(
               'shipping_term'   =>  $_POST['shipping_terms'][$i],
               'coriars'         =>  $_POST['coriars'][$i],
               'shipping_types'  =>  $_POST['ship_types'][$i],
               'shipping_fees'   =>  $_POST['shipping_fees'][$i],
               'shipping_name_display'=>$shiptype
               );
              }
            }
           
        /*product mpn and isbn check*/
        $product_mpn    = $this->input->post('product_mpn');
        
        $check_product_mpn = $this->marketplace_model->get_row('listing_attributes', array('product_mpn_isbn'=>$product_mpn));
     
        $status = '';
        if(!empty($check_product_mpn) || ($this->input->post('status')==2)){
            $status = $this->input->post('status');
        }else{
            $status = 1;
        }
        $data_insert['allow_color']   =  $allow_color;
        $data_insert['schedule_date_time']   =  $schedule_date_time;
        $data_insert['listing_categories']   =  $this->input->post('listing_categories');
        $data_insert['listing_type']         =  2;
        $data_insert['product_mpn_isbn']     =  $this->input->post('product_mpn');
        $data_insert['product_make']         =  $this->input->post('product_make');
        $data_insert['product_model']        =  $this->input->post('product_model');
        $data_insert['product_type']         =  $this->input->post('product_type');
        $data_insert['product_color']        =  $this->input->post('product_color');
        $data_insert['condition']            =  $this->input->post('condition');    
        $data_insert['spec']                 =  $this->input->post('spec');
        $data_insert['device_capacity']      =  $this->input->post('device_capacity');   
        $data_insert['device_sim']           =  $this->input->post('device_sim');

        $data_insert['currency']             =  $this->input->post('currency');
        $data_insert['unit_price']           =  $this->input->post('unit_price');
        $data_insert['min_price']            =  $min_price;
        $data_insert['allow_offer']          =  $allow_offer;
        $data_insert['total_qty']            =  $this->input->post('total_qty');
        $data_insert['qty_available']        = $this->input->post('total_qty');
        $data_insert['min_qty_order']        =  $min_qty_order;
        $data_insert['shipping_term']        =  $shipping_terms;
        $data_insert['courier']              =  $courier;
        $data_insert['sell_shipping_fee']    =  json_encode($shipping_fee);
        $data_insert['product_desc']         =  $this->input->post('product_desc');
        $data_insert['duration']             =  $this->input->post('duration');
        //$sc_add_duration=strtotime($schedule_date_time);
        $data_insert['listing_end_datetime'] =  date('Y-m-d H:i:s', strtotime($schedule_date_time."+".$this->input->post('duration')." days"));            
        $data_insert['member_id']            = $member_id; 
        $data_insert['status']               = $status; 
        if(!empty($list_id))
            $data_insert['updated']              = date('Y-m-d h:i:s A');
        else
            $data_insert['updated']              = date('Y-m-d h:i:s A');
            $data_insert['created']              = date('Y-m-d h:i:s A');
           
        $list_update = '';
        if(!empty($list_id)){
        $list_update =  $this->marketplace_model->get_row('listing', array('id'=>$list_id));
        }
            
            if($this->session->userdata('image1_check')!=''):
                if(!empty($list_update->image1)&&file_exists($list_update->image1)){
                    $img1 = explode('/', $list_update->image1);
                    @unlink($list_update->image1);
                    @unlink('public/upload/listing/small/'.$img1[3]);
                    @unlink('public/upload/listing/large/'.$img1[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img1[3]);
                }
                $image1_check=$this->session->userdata('image1_check');
                $data_insert['image1'] = 'public/upload/listing/'.$image1_check['image1'];
               $this->session->unset_userdata('image1_check');
            endif;

            if($this->session->userdata('image2_check2')!=''):
                if(!empty($list_update->image2)&&file_exists($list_update->image2)){
                   $img2 = explode('/', $list_update->image2);
                    @unlink($list_update->image2);
                    @unlink('public/upload/listing/small/'.$img2[3]);
                    @unlink('public/upload/listing/large/'.$img2[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img2[3]);
                }
                $image2_check2=$this->session->userdata('image2_check2');
                $data_insert['image2'] = 'public/upload/listing/'.$image2_check2['image2'];
                $this->session->unset_userdata('image2_check2');
            endif;

            if($this->session->userdata('image3_check3')!=''):
                if(!empty($list_update->image3)&&file_exists($list_update->image3)){
                   $img3 = explode('/', $list_update->image3);
                    @unlink($list_update->image3);
                    @unlink('public/upload/listing/small/'.$img3[3]);
                    @unlink('public/upload/listing/large/'.$img3[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img3[3]);
                }
                $image3_check3=$this->session->userdata('image3_check3');
                $data_insert['image3'] = 'public/upload/listing/'.$image3_check3['image3'];
                $this->session->unset_userdata('image3_check3');
            endif;

            if($this->session->userdata('image4_check4')!=''):
                if(!empty($list_update->image4)&&file_exists($list_update->image4)){
                   $img4 = explode('/', $list_update->image4);
                    @unlink($list_update->image4);
                    @unlink('public/upload/listing/small/'.$img4[3]);
                    @unlink('public/upload/listing/large/'.$img4[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img4[3]);
                }
                $image4_check4=$this->session->userdata('image4_check4');
                $data_insert['image4'] = 'public/upload/listing/'.$image4_check4['image4'];
                $this->session->unset_userdata('image4_check4');
            endif;

            if($this->session->userdata('image5_check5')!=''):
                if(!empty($list_update->image5)&&file_exists($list_update->image5)){
                   $img5 = explode('/', $list_update->image5);
                    @unlink($list_update->image5);
                    @unlink('public/upload/listing/small/'.$img5[3]);
                    @unlink('public/upload/listing/large/'.$img5[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img5[3]);
                }
                $image5_check5=$this->session->userdata('image5_check5');
                $data_insert['image5'] = 'public/upload/listing/'.$image5_check5['image5'];
                $this->session->unset_userdata('image5_check5');
            endif;

        if(!empty($list_id)){

            $this->marketplace_model->update('listing',$data_insert, array('id'=>$list_id,'member_id'=>$member_id));
            $this->session->set_flashdata('msg_success','Listing Update successfully.');
            if(!empty($status) && $status==2)
                redirect('marketplace/saved_listing');
            else
            redirect('marketplace/listing');
        }else{
           $this->marketplace_model->insert('listing',$data_insert);
        }
        if($status == 1){
           $this->session->set_flashdata('msg_success','Listing added successfully.');
            redirect('marketplace/listing');
        }elseif($status == 2){
           $this->session->set_flashdata('msg_success','Listing save for later, it will be under considration.');
           redirect('marketplace/listing');
            
        }
        }

        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Sell Listing';        
        $data['page'] = 'sell-listing';
        $data['page_redirect'] = $page_redirct;

        $data['listing_attributes'] =  $this->marketplace_model->get_group_listing_attributes();
        $data['shippings'] =  $this->marketplace_model->get_result('shippings','','',array('shipping_name','ASC'));
        if(!empty($list_id)){
        $data['couriers'] =  $this->marketplace_model->get_couriers_by_group('courier_name');
        }

        $data['product_colors'] =  $this->marketplace_model->get_result_by_group('product_color');
        $data['product_makes'] =  $this->marketplace_model->get_result_by_group('product_make');
        //$data['pro_type'] =  $this->marketplace_model->get_result_by_group('product_type');

        $data['pro_type'] =  $this->marketplace_model->get_result_product_type();
        $check_securty=0;
        if(!empty($list_id)){
         if(is_numeric($list_id)){
          if($data['product_list']   =  $this->marketplace_model->get_row('listing',array('id'=>$list_id,'member_id'=>$member_id,'listing_type'=>2))){
            $check_securty=1;
          }
         }
        }
        else{
            $check_securty=1;
        }
        $data['check_securty'] =$check_securty;
        $items =  $this->marketplace_model->get_result('listing_categories','','',array('category_name','ASC'));
        if( $items){
            $tree = $this->buildTree($items);
            $data['product_types']=$this->buildTree($items);
        }else{
           $data['product_types']=FALSE;
        }


      //  $data['couriers'] = $this->marketplace_model->get_result('couriers');
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function saved_listing()
    {
        $member_id=$this->session->userdata('members_id');
        $data['listing_save_later_buy'] = $this->marketplace_model->get_result('listing', array('member_id'=>$member_id,'status'=>2,'listing_type'=>1));

        $data['listing_save_later_sell'] = $this->marketplace_model->get_result('listing', array('member_id'=>$member_id,'status'=>2,'listing_type'=>2));

        $data['schedule_listing_buy'] = $this->marketplace_model->get_result('listing', array('member_id'=>$member_id,'status'=>1,'listing_type'=>1));

        $data['schedule_listing_sell'] = $this->marketplace_model->get_result('listing', array('member_id'=>$member_id,'status'=>1,'listing_type'=>2));

        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Saved Listing';        
        $data['page'] = 'saved-listing';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function buy_listing($list_id='')
    {

     $member_id=$this->session->userdata('members_id');

     //$this->output->enable_profiler(TRUE);
     if($this->input->post('status')==1) {
        $this->form_validation->set_rules('schedule_date_time', '', '');
        $this->form_validation->set_rules('product_mpn', 'product MPN/ISBN', '');

        $this->form_validation->set_rules('product_make', 'product make', 'required');
        $this->form_validation->set_rules('product_model', 'product model', 'required');
        $this->form_validation->set_rules('product_type', 'product type', 'required');
        $this->form_validation->set_rules('product_color', 'product color', 'required');
        $this->form_validation->set_rules('condition', 'condition', 'required');
        $this->form_validation->set_rules('spec', 'spec', 'required');
        $this->form_validation->set_rules('currency', 'currency', 'required');
        $this->form_validation->set_rules('unit_price', 'unit price', 'required|numeric');
        /*if(isset($_POST['minimum_checkbox'])){
          $this->form_validation->set_rules('min_price', 'min price', 'required|numeric');
        }*/

        if(isset($_POST['maximum_checkbox'])){
          $this->form_validation->set_rules('max_price', 'Max price', 'required|numeric');
        }
       
        $this->form_validation->set_rules('total_qty', 'total quantity', 'required|numeric');
        if(isset($_POST['orderqunatity_checkbox'])){
           $this->form_validation->set_rules('min_qty_order', 'min quantity order', 'required|numeric');
        }
        if(empty($list_id)){
        $this->form_validation->set_rules('courier[]', 'courier', 'required');
            
        }
        $this->form_validation->set_rules('product_desc', 'product description', 'required');
        $this->form_validation->set_rules('duration', 'duration', 'required');

        if(empty($list_id)){
            $this->form_validation->set_rules('termsandcondition', 'Terms and condition', 'required');
        }

    }else{
        $this->form_validation->set_rules('listing_type','listing type','');
    } 
    if(!empty($_FILES['image1']['name'])){
            $this->form_validation->set_rules('image1','','callback_image1_check');
            }
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

           $min_price='1';
           $allow_offer='';
           $min_qty_order='1';
           $allow_color='';

           if(isset($_POST['color_allow'])){
              $allow_color=1;
            }else{
               $allow_color='';
            }

           /*if(isset($_POST['minimum_checkbox'])){
              $min_price=$this->input->post('min_price');
            }else{
               $min_price='';
            }*/

            if(isset($_POST['maximum_checkbox'])){
              $max_price=$this->input->post('max_price');
            }else{
               $max_price='';
            }
            if(isset($_POST['allowoffer_checkbox'])){
               $allow_offer=$this->input->post('allow_offer');
            }else{
               $allow_offer='3';
            }
            
            if(isset($_POST['orderqunatity_checkbox'])){
               $min_qty_order=$this->input->post('min_qty_order');
            }else{
               $min_qty_order='1';
            }

            if(isset($_POST['shipping_checkbox'])){
              $shipping_charges=$this->input->post('shipping_charges');
            }else{
               $shipping_charges='';
            }

             $shipping_term=$this->input->post('shipping_term');
            if(!empty($shipping_term)){
                $st=explode('@@',$shipping_term );
                $shipping_terms=$st[1];
            }else{
                $shipping_terms='';
            }
            $courier='';
            if($courier_array=$this->input->post('courier')){
               $courier = implode(',', $courier_array);
                /*foreach ($courier_array as $value) {
                    //$courierinfo=courier_class($value);
                    $courier=$courierinfo.','.$value;
                }*/
            }
            $schedule_date_time=date('Y-m-d h:i:s');
            if($this->input->post('schedule_date_time')){
                $schedule_date_time=$this->input->post('schedule_date_time');
                 $schedule_date_time=date('Y-m-d h:i:s',strtotime($schedule_date_time));
                  $data_insert['scheduled_status']   = 1;
            }else{
                 $data_insert['scheduled_status']   = 0;
            }

        /*product mpn and isbn check*/
            $product_mpn    = $this->input->post('product_mpn');
            
            $check_product_mpn = $this->marketplace_model->get_row('listing_attributes', array('product_mpn_isbn'=>$product_mpn));
         
            $status = '';
            if(!empty($check_product_mpn) || ($this->input->post('status')==2)){
                $status = $this->input->post('status');
            }else{
                $status = 1;
            }

           
            $data_insert['allow_color']   =  $allow_color;
            $data_insert['schedule_date_time']   =  $schedule_date_time;
            $data_insert['listing_categories']   =  $this->input->post('listing_categories');
            $data_insert['listing_type']         =  1;
            $data_insert['product_mpn_isbn']     =  $this->input->post('product_mpn');
            $data_insert['product_make']         =  $this->input->post('product_make');
            $data_insert['product_model']        =  $this->input->post('product_model');
            $data_insert['product_type']         =  $this->input->post('product_type');
            $data_insert['product_color']        =  $this->input->post('product_color');
            $data_insert['condition']            =  $this->input->post('condition');    
            $data_insert['spec']                 =  $this->input->post('spec');   
            $data_insert['device_capacity']      =  $this->input->post('device_capacity');   
            $data_insert['device_sim']           =  $this->input->post('device_sim');
            $data_insert['currency']             =  $this->input->post('currency');
            $data_insert['unit_price']           =  $this->input->post('unit_price');
            //$data_insert['min_price']            =  $min_price;
            $data_insert['max_price']            =  $max_price;
            $data_insert['allow_offer']          =  $allow_offer;
            $data_insert['total_qty']            =  $this->input->post('total_qty');
            $data_insert['qty_available']        = $this->input->post('total_qty');
            $data_insert['min_qty_order']        =  $min_qty_order;
           // $data_insert['shipping_term']        =  $shipping_terms;

            $data_insert['shipping_charges']     =  $shipping_charges;
            $data_insert['courier']              =  $courier;
            $data_insert['product_desc']         =  $this->input->post('product_desc');
            $data_insert['duration']             =  $this->input->post('duration');
            $enddatetoin=$schedule_date_time;
            $data_insert['listing_end_datetime'] =  date('Y-m-d H:i:s', strtotime($schedule_date_time."+".$this->input->post('duration')." days"));                
            $data_insert['member_id']            = $member_id; 
            $data_insert['status']               = $status; 
        if(!empty($list_id))
            $data_insert['updated']              = date('Y-m-d h:i:s A');
        else
            $data_insert['updated']              = date('Y-m-d h:i:s A');
            $data_insert['created']              = date('Y-m-d h:i:s A');
            
        $list_update = '';
        if(!empty($list_id)){
        $list_update =  $this->marketplace_model->get_row('listing', array('id'=>$list_id));
        }
            
            if($this->session->userdata('image1_check')!=''):
                if(!empty($list_update->image1)&&file_exists($list_update->image1)){
                    $img1 = explode('/', $list_update->image1);
                    @unlink($list_update->image1);
                    @unlink('public/upload/listing/small/'.$img1[3]);
                    @unlink('public/upload/listing/large/'.$img1[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img1[3]);
                }
                $image1_check=$this->session->userdata('image1_check');
                $data_insert['image1'] = 'public/upload/listing/'.$image1_check['image1'];
               $this->session->unset_userdata('image1_check');
            endif;

            if($this->session->userdata('image2_check2')!=''):
                if(!empty($list_update->image2)&&file_exists($list_update->image2)){
                   $img2 = explode('/', $list_update->image2);
                    @unlink($list_update->image2);
                    @unlink('public/upload/listing/small/'.$img2[3]);
                    @unlink('public/upload/listing/large/'.$img2[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img2[3]);
                }
                $image2_check2=$this->session->userdata('image2_check2');
                $data_insert['image2'] = 'public/upload/listing/'.$image2_check2['image2'];
                $this->session->unset_userdata('image2_check2');
            endif;

            if($this->session->userdata('image3_check3')!=''):
                if(!empty($list_update->image3)&&file_exists($list_update->image3)){
                   $img3 = explode('/', $list_update->image3);
                    @unlink($list_update->image3);
                    @unlink('public/upload/listing/small/'.$img3[3]);
                    @unlink('public/upload/listing/large/'.$img3[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img3[3]);
                }
                $image3_check3=$this->session->userdata('image3_check3');
                $data_insert['image3'] = 'public/upload/listing/'.$image3_check3['image3'];
                $this->session->unset_userdata('image3_check3');
            endif;

            if($this->session->userdata('image4_check4')!=''):
                if(!empty($list_update->image4)&&file_exists($list_update->image4)){
                   $img4 = explode('/', $list_update->image4);
                    @unlink($list_update->image4);
                    @unlink('public/upload/listing/small/'.$img4[3]);
                    @unlink('public/upload/listing/large/'.$img4[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img4[3]);
                }
                $image4_check4=$this->session->userdata('image4_check4');
                $data_insert['image4'] = 'public/upload/listing/'.$image4_check4['image4'];
                $this->session->unset_userdata('image4_check4');
            endif;

            if($this->session->userdata('image5_check5')!=''):
                if(!empty($list_update->image5)&&file_exists($list_update->image5)){
                   $img5 = explode('/', $list_update->image5);
                    @unlink($list_update->image5);
                    @unlink('public/upload/listing/small/'.$img5[3]);
                    @unlink('public/upload/listing/large/'.$img5[3]);
                    @unlink('public/upload/listing/thumbnail/'.$img5[3]);
                }
                $image5_check5=$this->session->userdata('image5_check5');
                $data_insert['image5'] = 'public/upload/listing/'.$image5_check5['image5'];
                $this->session->unset_userdata('image5_check5');
            endif;

        if(!empty($list_id)){

            $this->marketplace_model->update('listing',$data_insert, array('id'=>$list_id,'member_id'=>$member_id));
            $this->session->set_flashdata('msg_success','Listing Update successfully.');
            if(!empty($status) && $status == 2)
                redirect('marketplace/saved_listing');
            else
            redirect('marketplace/listing');
        }else{
           $this->marketplace_model->insert('listing',$data_insert);
        }
        if($status == 1){
           $this->session->set_flashdata('msg_success','Listing added successfully.');
            redirect('marketplace/listing');
        }elseif($status == 2){
           $this->session->set_flashdata('msg_success','Listing save for later, it will be under considration.');
           redirect('marketplace/listing');
            
        }
        }

        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Buy Listing';        
        $data['page'] = 'buy-listing';

        $data['listing_attributes'] =  $this->marketplace_model->get_group_listing_attributes();
        $data['shippings'] =  $this->marketplace_model->get_result('shippings','','',array('shipping_name','ASC'));
        if(!empty($list_id)){
        $data['couriers'] =  $this->marketplace_model->get_couriers_by_group('courier_name');
        }

        $data['product_colors'] =  $this->marketplace_model->get_result_by_group('product_color');
        $data['product_makes'] =  $this->marketplace_model->get_result_by_group('product_make');
        $data['product_models'] =  $this->marketplace_model->get_result_by_group('product_model');
        //$data['product_types'] =  $this->marketplace_model->get_result_by_group('product_type');

        $data['pro_type'] =  $this->marketplace_model->get_result('listing_attributes','',array('product_type'));
        $check_securty=0;
        if(!empty($list_id)){
         if(is_numeric($list_id)){
          if($data['product_list']   =  $this->marketplace_model->get_row('listing',array('id'=>$list_id,'member_id'=>$member_id,'listing_type'=>1))){
            $check_securty=1;
            $data['listing_product_make']=$this->marketplace_model->get_modal_by_make($data['product_list']->product_make);
          }
         }
        }
        else{
            $check_securty=1;
        }
        $data['check_securty'] =$check_securty;

        $items =  $this->marketplace_model->get_result('listing_categories','','',array('category_name','ASC'));
        if( $items){
            $tree = $this->buildTree($items);
            $data['product_types']=$this->buildTree($items);
        }else{
           $data['product_types']=FALSE;
        }
        
        $this->load->module('templates');
        $this->templates->page($data);
    }

    function listing_watch($seller_id='', $listing_id='',$listing_type='')
    {
        $user_id =  $this->session->userdata('members_id');
        $check_list = $this->marketplace_model->get_row('listing_watch', array('listing_id'=>$listing_id,'user_id'=>$user_id));
        if(empty($check_list)){
        if($listing_type==1){
            $listing_type=2;
        }elseif($listing_type==2){
            $listing_type=1;
        }
         $data_insert=array(
                            'listing_id' =>  $listing_id,
                            'seller_id' =>   $seller_id,
                            'user_id'    =>  $user_id,
                            'created'    =>  date('Y-m-d,H:i:s'),
                            'listing_type'=>$listing_type
                            );
         $this->marketplace_model->insert('listing_watch',$data_insert);
         $this->session->set_flashdata('msg_info','Listing have been save sucessfully in your watch list.'); 
         redirect('marketplace/listing_detail/'.$listing_id);
        }else{
         $this->session->set_flashdata('msg_info','This item is already exist in your watch list.');  
         redirect('marketplace/listing_detail/'.$listing_id);
        }
    }


    function listing_unwatch($listing_id='')
    {
        $user_id =  $this->session->userdata('members_id');
         if($this->marketplace_model->delete('listing_watch',array('listing_id'=>$listing_id, 'user_id'=>$user_id))){
           $this->session->set_flashdata('msg_success','Listing removed successfully from your watch list.');  
          }
          else{
          $this->session->set_flashdata('msg_info','Invalid...!');  
          }
         redirect($_SERVER['HTTP_REFERER']);
    }

    function listing_question()
    {
        if(!empty($_POST['ask_question'])){
            $user_id =  $this->session->userdata('members_id');
            $listing_id = $this->input->post('listing_id');
            $message_title=$this->input->post('message_title');
            $data_insert=array(
                            'listing_id' =>  $listing_id,
                            'seller_id' => $this->input->post('seller_id'),
                            'buyer_id'  =>  $user_id,
                            'question'   =>  $this->input->post('ask_question'),
                            'created'    =>  date('Y-m-d')
                            );
            $question_id = $this->marketplace_model->insert('listing_question',$data_insert);

            $data = array(
                'member_id'         => $user_id,
                'sent_member_id'    => $this->input->post('seller_id'),
                'subject'           => $message_title,
                'body'              => $this->input->post('ask_question'),
                'inbox'             => 'yes',
                'sent'              => 'yes',
                'date'              => date('d-m-Y'),
                'time'              => date('H:i:s'),
                'sent_from'         => 'market',
                'datetime'          => date('Y-m-d H:i:s')
              ); 
           $this->load->model('mailbox/mailbox_model', 'mailbox_model');
            $this->mailbox_model->_insert($data);

            if(!empty($question_id)){
                $this->session->set_flashdata('msg_info','Your question sent successfully. You will get response as soon as possible'); 
            }else{
                 $this->session->set_flashdata('msg_info','Please Try again.');  
            }
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    function get_listing_question($listing_id=0)
    {
        $user_id =  $this->session->userdata('members_id');
        $question_asked = $this->marketplace_model->question_asked($listing_id,$user_id); 
       if(!empty($question_asked)){?>
       <h4><strong>Recently ask questions</strong></h4>
       <div id="del_msg"></div>
        <table class="table table-striped table-bordered table-hover dataTables-example">
            <?php
            foreach ($question_asked as $value) {  ?>
            <tr>
                <td>
                <div class="row">
                <div class="col-lg-6">
                    <?php echo ucfirst($value->firstname).' '.$value->lastname; ?>
                </div>
                <div class="col-lg-6 pull-right">
                    <?php echo $value->created; ?>
                </div> 
                <div class="col-lg-12">
                <?php echo ucfirst($value->question); ?>
                </div></td>
            </tr>
            <?php } ?>
        </table>
       <?php 
    }}

    function history()
    {
        //$this->output->enable_profiler(TRUE);
        $data['sell_order'] = $this->marketplace_model->order_history_sell();
        $data['buy_order'] = $this->marketplace_model->order_history_buy();
        
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: History';        
        $data['page'] = 'order-history';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    
    function invoice_print($id)
    {
        $data['invoice'] = $this->marketplace_model->invoice($id);

        if(empty($data['invoice'])){
            redirect('marketplace/history');
        }
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Invoice Print';        
        $data['page'] = 'invoice-print';
        
        $this->load->module('templates');
        $this->templates->page($data);
    }

public function getAttributesInfo($type='MPNISBN',$IsbnMpn=''){

    $data=array('Status'=>FALSE,'numrows'=>0,'product_colors'=>'');

    if($_POST){
        if($type=='MPNISBN'){

            $mpnisbn=trim($_POST['mpnisbn']);

            $query=$this->db->query("SELECT product_make,product_color,product_type FROM `listing_attributes` WHERE product_mpn_isbn ='$mpnisbn';");
               
                $product_makes=array();
                $colors=array();
               
            if($query->num_rows()>0 && !empty($mpnisbn)){
              foreach ($query->result() as $value){
                    $product_makes[] =$value->product_make; 
                    if(!in_array($value->product_color, $colors)){   
                        $colors[]     =$value->product_color; 
                    }   
                    $product_types =$value->product_type;    
                    }             
                   $product_makes=array_unique($product_makes);
                   //$colors=array_unique($colors);
                  
                $data=array(
                    'Status' =>TRUE,
                    'numrows'=> $query->num_rows(),
                    'product_make'=>$product_makes,
                    'product_types'=>$product_types,
                    'product_colors'=>$colors,
                    );                
            }else{
                 $query=$this->db->query("SELECT product_make,product_color,product_type FROM `listing_attributes`;");
                  
                     if($query->num_rows()>0){
                       foreach ($query->result() as $value){
                        if(!in_array($value->product_make, $product_makes)){   
                            $product_makes[] =$value->product_make;  
                         }  
                         if(!in_array($value->product_color, $colors)){   
                             $colors[]     =$value->product_color; 
                         }      
                        $product_types =$value->product_type;    
                        }
                     }
                   $data=array(
                    'Status' =>FALSE,
                    'numrows'=> $query->num_rows(),
                    'product_make'=>$product_makes,
                    'product_types'=>$product_types,
                    'product_colors'=>$colors,
                    );                    
            }

            //MPNISBN
        }elseif($type=='MAKE'){
        $product_make=trim($_POST['make']);
        $product_mpn_isbn=trim($_POST['mpnisbn']);
        $query=$this->db->query("SELECT product_model FROM `listing_attributes` WHERE product_mpn_isbn ='$product_mpn_isbn' AND product_make like '%$product_make%';");
        if($query->num_rows()>0 && !empty($product_make)){
           $product_modal=array();
             if($query->num_rows()>0){
               foreach ($query->result() as $value){
                $product_modal[] =$value->product_model;    
                }             
               $product_modal=array_unique($product_modal);
             }
               $data=array(
                'Status' =>TRUE,
                'numrows'=> $query->num_rows(),
                'product_make'=>$product_modal,
                );       
        }else{
         $query=$this->db->query("SELECT product_model FROM `listing_attributes`  WHERE  product_make like '%$product_make%';");
           $product_modal=array();
             if($query->num_rows()>0){
               foreach ($query->result() as $value){
                $product_modal[] =$value->product_model;    
                }             
               $product_modal=array_unique($product_modal);
             }
               $data=array(
                'Status' =>FALSE,
                'numrows'=> $query->num_rows(),
                'product_make'=>$product_modal,
                ); 
            }
        }
        elseif($type=='MODAL'){
        $product_modal=trim($_POST['product_model']);
        $query=$this->db->query("SELECT product_color FROM `listing_attributes` WHERE  product_model like '%$product_modal%';");
        if($query->num_rows()>0){
           $product_color=array();
             if($query->num_rows()>0){
               foreach ($query->result() as $value){
                $product_color[] =$value->product_color;    
                }             
               $product_color=array_unique($product_color);
             }
               $data=array(
                'Status' =>TRUE,
                'numrows'=> $query->num_rows(),
                'product_color'=>$product_color,
                );       
        }else{
         $query=$this->db->query("SELECT product_color FROM `listing_attributes`;");
            if($query->num_rows()>0){
            $product_color=array();
             if($query->num_rows()>0){
               foreach ($query->result() as $value){
                $product_color[] =$value->product_color;    
                }             
               $product_color=array_unique($product_color);
             }
               $data=array(
                'Status' =>TRUE,
                'numrows'=> $query->num_rows(),
                'product_color'=>$product_color,
                );
            }}
        }
    }

    header('Content-Type: application/json');
    echo json_encode($data);

}

  function get_attributes_info($type='MPN'){
    $check_status='false';
     $list=array('STATUS'=>$check_status);

     if($_POST){
        $attr_id=trim($_POST['product_mpn_isbn']);

        
        $information = $this->marketplace_model->get_row('listing_attributes',array('product_mpn_isbn'=>$attr_id));
        if($information):
        $check_status='true';
        $list=array('STATUS'=>$check_status,'product_make'=>$information->product_make,'product_model'=>$information->product_model,'product_type'=>$information->product_type,'product_color'=>$information->product_color);
        endif;
      }
    header('Content-Type: application/json');
    echo json_encode($list);
        
    }


    function image1_check($str=''){

     if(empty($_FILES['image1']['name'])){
            $this->form_validation->set_message('image1_check', 'Choose Image 1');
           return FALSE;
        }
    $image = getimagesize($_FILES['image1']['tmp_name']);
       if ($image[0] >= 1200 || $image[1] >= 1200) {
           $this->form_validation->set_message('image1_check', 'Oops! Your item image needs to be less than 1200 x 1200 pixels.');
           return FALSE;
       }
       if ($image[0] < 400 || $image[1] < 400) {
       $this->form_validation->set_message('image1_check', 'Oops! Your item image needs to be at least grater than 400 x 400 pixels.');
       return FALSE;
   }
    if(!empty($_FILES['image1']['name'])):
        $config1['upload_path'] = './public/upload/listing/';
        $config1['allowed_types'] = 'gif|jpg|png|jpeg';
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
           
         //thumbimage
            $param_thumb=array();
            $param_thumb['source_path'] = './public/upload/listing/';
            $param_thumb['destination_path'] = './public/upload/listing/thumbnail/';
            $param_thumb['width']  = '400';
            $param_thumb['height']  = '400';
            $param_thumb['file_name'] =$data['file_name'];
            create_thumbnail($param_thumb);

            $this->session->unset_userdata('image1_check');
            $this->session->set_userdata('image1_check',array('image_url'=>$config1['upload_path'].$data['file_name'],'image1'=>$data['file_name']));
           return TRUE;
        }
    endif;
    }

    function image2_check2($str){
       
       if(empty($_FILES['image2']['name'])){
            $this->form_validation->set_message('image2_check2', 'Choose Image 1');
           return FALSE;
        }
    $image = getimagesize($_FILES['image2']['tmp_name']);
       if ($image[0] >= 1200 || $image[1] >= 1200) {
           $this->form_validation->set_message('image2_check2', 'Oops! Your item image needs to be less than 1200 x 1200 pixels.');
           return FALSE;
       }
       if ($image[0] < 400 || $image[1] < 400) {
       $this->form_validation->set_message('image4_check4', 'Oops! Your item image needs to be at least grater than 400 x 400 pixels.');
       return FALSE;
   }
    if(!empty($_FILES['image2']['name'])):
        $config2['upload_path'] = './public/upload/listing/';
        $config2['allowed_types'] = 'gif|jpg|png|jpeg';
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
            $upload_file = explode('.', $data['file_name']);
            
            if(in_array($upload_file[1], array('gif','jpeg','jpg','png','bmp','jpe'))){
            $param_thumb=array();
            $param_thumb['source_path'] = './public/upload/listing/';
            $param_thumb['destination_path'] = './public/upload/listing/thumbnail/';
            $param_thumb['width']  = '400';
            $param_thumb['height']  = '400';
            $param_thumb['file_name'] =$data['file_name'];
            create_thumbnail($param_thumb);

            $this->session->unset_userdata('image2_check2');
            $this->session->set_userdata('image2_check2',array('image_url'=>$config2['upload_path'].$data['file_name'],'image2'=>$data['file_name']));
            return TRUE;
        }
    }
    endif;
    }

    function image3_check3($str){
        if(empty($_FILES['image3']['name'])){
            $this->form_validation->set_message('image3_check3', 'Choose Image 1');
           return FALSE;
        }
        $image = getimagesize($_FILES['image3']['tmp_name']);
       if ($image[0] >= 1200 || $image[1] >= 1200) {
           $this->form_validation->set_message('image3_check3', 'Oops! Your item image needs to be less than 1200 x 1200 pixels.');
           return FALSE;
       }
       if ($image[0] < 400 || $image[1] < 400) {
       $this->form_validation->set_message('image4_check4', 'Oops! Your item image needs to be at least grater than 400 x 400 pixels.');
       return FALSE;
   }

    if(!empty($_FILES['image3']['name'])):
        $config3['upload_path'] = './public/upload/listing/';
        $config3['allowed_types'] = 'gif|jpg|png|jpeg';
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
            $upload_file = explode('.', $data['file_name']);
            
            if(in_array($upload_file[1], array('gif','jpeg','jpg','png','bmp','jpe'))){
                 $param_thumb=array();
            $param_thumb['source_path'] = './public/upload/listing/';
            $param_thumb['destination_path'] = './public/upload/listing/thumbnail/';
            $param_thumb['width']  = '400';
            $param_thumb['height']  = '400';
            $param_thumb['file_name'] =$data['file_name'];
            create_thumbnail($param_thumb);

            $this->session->unset_userdata('image3_check3');
            $this->session->set_userdata('image3_check3',array('image_url'=>$config3['upload_path'].$data['file_name'],'image3'=>$data['file_name']));
            return TRUE;
        }
    }
    endif;
    }

    function image4_check4($str=''){
        if(empty($_FILES['image4']['name'])){
            $this->form_validation->set_message('image4_check4', 'Choose Image 4');
           return FALSE;
        }
    $image = getimagesize($_FILES['image4']['tmp_name']);
       if ($image[0] >= 1200 || $image[1] >= 1200) {
           $this->form_validation->set_message('image4_check4', 'Oops! Your item image needs to be less than 1200 x 1200 pixels.');
           return FALSE;
       }
    if ($image[0] < 400 || $image[1] < 400) {
       $this->form_validation->set_message('image4_check4', 'Oops! Your item image needs to be at least grater than 400 x 400 pixels.');
       return FALSE;
   }
       
    if(!empty($_FILES['image4']['name'])):
        $config4['upload_path'] = './public/upload/listing/';
        $config4['allowed_types'] = 'gif|jpg|png|jpeg';
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
            $upload_file = explode('.', $data['file_name']);
            
            if(in_array($upload_file[1], array('gif','jpeg','jpg','png','bmp','jpe'))){
                  $param_thumb=array();
            $param_thumb['source_path'] = './public/upload/listing/';
            $param_thumb['destination_path'] = './public/upload/listing/thumbnail/';
            $param_thumb['width']  = '400';
            $param_thumb['height']  = '400';
            $param_thumb['file_name'] =$data['file_name'];
            create_thumbnail($param_thumb);

            $this->session->unset_userdata('image4_check4');
            $this->session->set_userdata('image4_check4',array('image_url'=>$config4['upload_path'].$data['file_name'],'image4'=>$data['file_name']));
            return TRUE;
        }
    }
    endif;
    }
    
  function image5_check5($str=''){
    if(empty($_FILES['image5']['name'])){
            $this->form_validation->set_message('image5_check5', 'Choose Image 1');
           return FALSE;
        }
    $image = getimagesize($_FILES['image5']['tmp_name']);
       if ($image[0] >= 1200 || $image[1] >= 1200) {
           $this->form_validation->set_message('image5_check5', 'Oops! Your item image needs to be less than 1200 x 1200 pixels.');
           return FALSE;
       }
        
        if ($image[0] < 400 || $image[1] < 400) {
           $this->form_validation->set_message('image5_check5', 'Oops! Your item image needs to be at least grater than 400 x 400 pixels.');
           return FALSE;
       }

    if(!empty($_FILES['image5']['name'])):
        $config5['upload_path'] = './public/upload/listing/';
        $config5['allowed_types'] = 'gif|jpg|png|jpeg';
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
            $upload_file = explode('.', $data['file_name']);
            
            if(in_array($upload_file[1], array('gif','jpeg','jpg','png','bmp','jpe'))){
                   $param_thumb=array();
            $param_thumb['source_path'] = './public/upload/listing/';
            $param_thumb['destination_path'] = './public/upload/listing/thumbnail/';
            $param_thumb['width']  = '400';
            $param_thumb['height']  = '400';
            $param_thumb['file_name'] =$data['file_name'];
            create_thumbnail($param_thumb);

            $this->session->unset_userdata('image5_check5');
            $this->session->set_userdata('image5_check5',array('image_url'=>$config5['upload_path'].$data['file_name'],'image5'=>$data['file_name']));
            return TRUE;
        }
      }
    endif;
    }

    function listing_detail($id=0)
    {
        ////////$this->output->enable_profiler(TRUE);
        if(empty($id) || !is_numeric($id)) {
         redirect('marketplace/index'); 
        }

        $member_id=$this->session->userdata('members_id');
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place';        
        $data['page'] = 'listing_detail';
        //$data['page'] = 'buy_html';
        $data['member_id'] =$member_id;
        if($data['listing_detail'] = $this->marketplace_model->get_row('listing',array('id'=>$id,'member_id'=>$member_id))){
            $a=1;
        }else{
        $data['listing_detail'] =  $this->marketplace_model->listingdetailv($id);
        }
        if($data['listing_detail']==FALSE)   
            redirect('marketplace/listing');

        $data['member'] = $this->marketplace_model->get_row('members',array('id'=> $data['listing_detail']->member_id));
        if($data['member']){
        $data['company'] = $this->marketplace_model->get_row('company',array('id'=>$data['member']->company_id));

        $data['memberships'] = $this->marketplace_model->get_row('membership',array('id'=>$data['member']->membership),array('membership'));
       } else
         $data['company'] = FALSE;
        $this->load->module('templates');
        $this->templates->page($data);
    }

    public function shippings_to_couriers_data($ship_id=0){
        $ship_id = intval($ship_id);
        $shippings =  $this->marketplace_model->get_row('shippings',array('id'=>$ship_id),array('couriers'));

        if( $shippings):

          $gstcd = $this->marketplace_model->get_shippings_to_couriers_data($shippings->couriers);

            if($gstcd):
              foreach ($gstcd as $row):?>
             <label class="checkbox-inline i-checks iCheck-helper"><input type="checkbox" value="<?php echo $row->courier_name; ?>" name="courier[]" <?php if(!empty($_POST['courier']) && in_array($row->courier_name, $_POST['courier'])){ echo'checked';}?>/> <?php echo $row->courier_name;?> </label>
            <?php
            endforeach;
            else:
                echo "NO courier found.";
            endif;
        endif;
       // $data['couriers'] =  $this->marketplace_model->get_result('couriers','','',array('courier_name','ASC'));
    }
    private function buildTree($items) {

        $childs = array();

        foreach($items as $item)
            $childs[$item->parent_id][] = $item;

        foreach($items as $item) if (isset($childs[$item->id]))
            $item->childs = $childs[$item->id];

        return $childs[0];
    }

      function offer_status($id='',$status='0',$buyer_id)
    {
      $seller_id =  $this->session->userdata('members_id');
      if($status==1){
          $this->marketplace_model->update('make_offer',array('offer_status'=>$status,'invoice_no'=>$seller_id.'-'.$buyer_id.'-'.$id),array('id'=>$id, 'offer_received_by'=>$seller_id));
             $data = array(
                'member_id'         => $seller_id,
                'sent_member_id'    => $buyer_id,
                'subject'           => 'Offer Dccepted',
                'body'              => 'Your offer has been accepted, proceed to open orders to view the status of your order.',
                'inbox'             => 'yes',
                'sent'              => 'yes',
                'date'              => date('d-m-Y'),
                'time'              => date('H:i:s'),
                'sent_from'         => 'market',
                'datetime'          => date('Y-m-d H:i')
              ); 
           $this->load->model('mailbox/mailbox_model', 'mailbox_model');
            $this->mailbox_model->_insert($data);

            $this->session->set_flashdata('msg_success','Offer Accepted. An order has been created in <strong>Open Orders</strong>. The user has been notified.');  
            redirect('marketplace/open_orders');
          }elseif($status==2){
           
            $message = "";
            if( $offer_info=$this->marketplace_model->get_row('make_offer', array('id'=>$id))){
                $message = "<br>Offer sent info - <br>Per unit price : ".$offer_info->unit_price."<br>Quantity : ".$offer_info->product_qty."<br>Shipping : ".$offer_info->shipping_price."<br>To resend a better offer<a href='marketplace/listing_detail"."/".$offer_info->listing_id."'> Click here</a>";
            }
            $this->marketplace_model->update('make_offer',array('offer_status'=>$status),array('id'=>$id, 'offer_received_by'=>$seller_id));
            $data = array(
                'member_id'         => $seller_id,
                'sent_member_id'    => $buyer_id,
                'subject'           => 'Offer Declined',
                'body'              => 'Your offer has been declined, try submitting a better offer.'. $message,
                'inbox'             => 'yes',
                'sent'              => 'yes',
                'date'              => date('d-m-Y'),
                'time'              => date('H:i'),
                'sent_from'         => 'market',
                'datetime'          => date('Y-m-d H:i')
              ); 
           $this->load->model('mailbox/mailbox_model', 'mailbox_model');
            $this->mailbox_model->_insert($data);

            $this->session->set_flashdata('msg_success','Offer Declined. The user has been notified.'); 
          }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
    }
  
  function pay_asking_status($id='',$negotiation_id='',$status='0',$buyer_id)
    {
       $seller_id =  $this->session->userdata('members_id');
       $this->marketplace_model->update('negotiation',array('status'=>$status),array('id'=>$negotiation_id));
       if($status==1){
       if($this->marketplace_model->update('make_offer',array('offer_status'=>$status,'invoice_no'=>$seller_id.'-'.$buyer_id.'-'.$id),array('id'=>$id))){
          
             $data = array(
                'member_id'         => $seller_id,
                'sent_member_id'    => $buyer_id,
                'subject'           => 'Offer accepted',
                'body'              => 'Your offer to pay the asking price has been accepted by the user, proceed to open orders to view the status of your order.',
                'inbox'             => 'yes',
                'sent'              => 'yes',
                'date'              => date('d-m-Y'),
                'time'              => date('H:i:s'),
                'sent_from'         => 'market',
                'datetime'          => date('Y-m-d H:i')
              ); 
           $this->load->model('mailbox/mailbox_model', 'mailbox_model');
            $this->mailbox_model->_insert($data);

            $this->session->set_flashdata('msg_success','Offer Accepted. An order has been created in <strong>Open Orders</strong>. The user has been notified.');
            redirect('marketplace/open_orders');
       
    }
     else{
        
       $this->marketplace_model->update('make_offer',array('offer_status'=>$status),array('id'=>$id, 'offer_received_by'=>$seller_id));
        $data = array(
                'member_id'         => $seller_id,
                'sent_member_id'    => $buyer_id,
                'subject'           => 'Offer Declined',
                'body'              => 'Your offer to pay the asking price has been decline, try contacting the user as they may not have the quantity available.',
                'inbox'             => 'yes',
                'sent'              => 'yes',
                'date'              => date('d-m-Y'),
                'time'              => date('H:i:s'),
                'sent_from'         => 'market',
                'datetime'          => date('Y-m-d H:i')
              ); 
           $this->load->model('mailbox/mailbox_model', 'mailbox_model');
            $this->mailbox_model->_insert($data);
            $this->session->set_flashdata('msg_success','Offer Declined sucessfully.'); 
        redirect($_SERVER['HTTP_REFERER']);
       }
     }else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
    }

  function counter_offer(){

    if($_POST){
        $mellerid =  $this->session->userdata('members_id');
        $offer_id=$_POST['offer_id'];
        $qty=$_POST['qty'];
        $per_unit_price=$_POST['per_unit_price'];
        if($offerdetail=$this->marketplace_model->get_row('make_offer',array('id'=>$offer_id))){
        $grand_total=$qty * $per_unit_price;

        $listing=$this->marketplace_model->get_row('listing', array('id'=>$offerdetail->listing_id));

        if($listing->listing_type==1){$offer_type=2;}
        else{$offer_type=1;}

        $data_insert_negotiation=array(
            'buyer_id'      => $offerdetail->buyer_id,
            'offer_id'      => $offerdetail->id,
            'seller_id'     => $offerdetail->seller_id,
            'listing_id'    => $offerdetail->listing_id,
            'product_qty'   => $qty,
            'unit_price'    => $per_unit_price,
            'grand_total'   => $grand_total,
            'total_price'   => $grand_total + $offerdetail->shipping_price,
            'shipping_price'=> $offerdetail->shipping_price,
            'shipping'      => $offerdetail->shipping,
            'buyer_currency'=> $offerdetail->buyer_currency,
            'status'        => 0,
            'access'        => $mellerid,
            'offer_type'    => $offer_type,
            'pay_asking_price'=>0,
            'created'       => date('Y-m-d, H:i:s')
            );

     $this->marketplace_model->update('make_offer',array('offer_status'=>3),array('id'=>$offer_id));

     $this->marketplace_model->insert('negotiation',$data_insert_negotiation);
        $this->session->set_flashdata('msg_success','Offer has been moved to <strong>Negotiations</strong> page until a deal has been met.'); 
        }
        else{
            $this->session->set_flashdata('msg_info','Invalid.');
            redirect($_SERVER['HTTP_REFERER']);
        }
           redirect('marketplace/negotiation'); 
        }else{
            $this->session->set_flashdata('msg_info','Invalid.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

  function make_offer()
  {
    $list=array('STATUS'=>FALSE);
    if($_POST){
       
    $product_qty=$_POST['product_qty'];
    $unit_price=$_POST['unit_price'];
    $listing_id=$_POST['listing_id'];
    $shippingterm_index='';
    if($shippingterm_value=$_POST['coriartoselect1']){
        $explodeshipping=explode('-',$shippingterm_value);
        $shippingterm_index=$explodeshipping[0];
    }

    $buyer_id=$this->session->userdata('members_id');
    $need_to_insert=0;
    if(!empty($product_qty) && is_numeric($product_qty) && !empty($unit_price) && is_numeric($unit_price) && !empty($listing_id) && is_numeric($listing_id)){
     
    if($listing=$this->marketplace_model->get_row('listing', array('id'=>$listing_id))){

    $offersdone_res=$this->marketplace_model->offerattempt($listing_id);
    $offersdone=$offersdone_res->totalrow;
    $total_allow_offer=3;
     if($listing->allow_offer){
        $total_allow_offer=$listing->allow_offer;
     }

  if($offersdone < $total_allow_offer){
    $shippingterm ='';
    $shippingamount =0;
    if(!empty($listing->courier)) {
      if($listing->listing_type==1){
        $core =  explode(',', $listing->courier);
        $shippingterm = $core[$shippingterm_index];
      }
      elseif($listing->listing_type==2){
        $value=json_decode($listing->sell_shipping_fee);
        $shippingterm = $value[$shippingterm_index]->shipping_term.' ('.$value[$shippingterm_index]->coriars.') '.$value[$shippingterm_index]->shipping_name_display;
        if($value[$shippingterm_index]->shipping_types=='Free_Shipping'){
            $shippingamount =0;
        }elseif($value[$shippingterm_index]->shipping_types=='Price_per_unit'){
            $shippingamount =$value[$shippingterm_index]->shipping_types * $product_qty;
        }elseif($value[$shippingterm_index]->shipping_types=='Flat_fee'){
            $shippingamount =$value[$shippingterm_index]->shipping_types;
        }
        } 
      }
    $offerleft=($total_allow_offer - $offersdone) - 1;
    if($listing->listing_type==2){
    $min_qty='';

    if($listing->min_qty_order){
         $min_qty=$listing->min_qty_order;
      }

     $min_price='0';
     if($listing->min_price != '0.00'){
         $min_price=$listing->min_price;
      }
      /*case III*/
      if(!empty($min_qty) && $min_price !='0.00'){
        if($product_qty >=$min_qty && $unit_price >=$min_price ){
            $need_to_insert++;
         }
       }
       elseif($min_price !='0.00' && $unit_price >=$min_price){
             $need_to_insert++;
        }
       elseif(!empty($min_qty) && $product_qty >=$min_qty){
             $need_to_insert++;
       } 
     }
     elseif($listing->listing_type==1){
        $max_price='';
         if($listing->max_price){
             $max_price=$listing->max_price;
          }
          if($listing->total_qty){
             $qty=$listing->total_qty;
          }
        if($offersdone < $total_allow_offer){
        if(!empty($max_price) && $max_price !='0.00' && !empty($qty)){
            if($product_qty <=$qty && $unit_price <=$max_price ){
                $need_to_insert++;
             }
        }
        elseif(!empty($max_price) && $max_price !='0.00'  && $unit_price <=$max_price){
            $need_to_insert++;
        }
        elseif(!empty($qty) && $product_qty <=$qty){
           $need_to_insert++;
        }
        if(empty($need_to_insert)){
            $list=array('STATUS'=>4,'Message'=>'Offer has been auto declined.');
        }
        }
        else{
        $list=array('STATUS'=>2,'Message'=>'Offer limit exceed.'); 
      } 
     }
       if( $need_to_insert){
        if($listing->listing_type==1){
            $buyer_id_to_fix=$listing->member_id;
            $seller_id_to_fix=$buyer_id;
        }
        elseif($listing->listing_type==2){
            $buyer_id_to_fix=$buyer_id;
            $seller_id_to_fix=$listing->member_id;
        }
        
        if($checkoffer=$this->marketplace_model->get_row('make_offer', array('buyer_id'=> $buyer_id,'seller_id' => $listing->member_id,'listing_id'=> $listing_id,'product_qty'   => $product_qty,'unit_price' => $unit_price))){

        $list=array('STATUS'=>7,'Message'=>'This Offer has been already made.'); 
        }
        else{
         $total_price=  ($product_qty *  $unit_price) +  $shippingamount;
       $data_insert=array(
                'buyer_id'      => $buyer_id_to_fix,
                'seller_id'     => $seller_id_to_fix,
                'offer_given_by'    => $buyer_id,
                'offer_received_by'   => $listing->member_id,
                'listing_id'    => $listing_id,
                'product_qty'   => $product_qty,
                'unit_price'    => $unit_price,
                'grand_total'   => $unit_price * $product_qty,
                'buyer_currency'=> $listing->currency,
                'total_price'   => $total_price,
                'shipping_price'=> $total_price - ($unit_price * $product_qty),
                'shipping'      => $shippingterm,
                'shipping_price'=> $shippingamount,
                'created'       => date('Y-m-d, H:i:s'),
                );
        $this->marketplace_model->insert('make_offer',$data_insert);
        $list=array('STATUS'=>1,'Message'=>'Offer added sucessfully.');
        }
       }
       else{
         $data_insert_offer_attempt=array(
                'buyer_id'      => $buyer_id,
                'listing_id'    => $listing_id,
                'created'       => date('Y-m-d, H:i:s')
                );
        $this->marketplace_model->insert('offer_attempt',$data_insert_offer_attempt);
        $list=array('STATUS'=>5,'chance_left'=>$offerleft); 
      }
    } 
    else{
        $list=array('STATUS'=>6,'Message'=>'Try it later'); 
      } 
      }
     }
    }
    header('Content-Type: application/json');
    echo json_encode($list);
   }

    function get_buyers_offer()
    {
        $list = $this->input->post('listing_id');
        $make_offer = $this->marketplace_model->get_buyers_offer($list);
        if(!empty($make_offer)){ ?>
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Rating</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Country</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
        
        <?php foreach ($make_offer as $value) { ?>

        <tr>
         <td><?php echo $value->company_name; ?></td>
                <td><span class="fa fa-star" style="color:#FC3"></span> <span style="color:green">94</span></td>
                <td><?php echo $value->product_qty; ?></td>
                <td><?php echo currency_class($value->buyer_currency); ?> <?php echo $value->unit_price; ?></td>
                <td><img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" alt="Currency" /></td>
                <td style="text-align:center">
                <button type="button" class="btn btn-outline btn-warning"><i class="fa fa-hand-o-down"></i> Counter Offer</button>
                <a onclick="offer_status(<?php echo $value->listing_id; ?>,<?php echo $value->buyer_id ?>)" class="btn btn-outline btn-primary" <?php if (!empty($value->offer_status) && $value->offer_status == 1 ): ?> id="offer_status_accept"<?php endif ?>><i class="fa fa-check"></i> Accept</a>
                <button type="button" class="btn btn-outline btn-danger"<?php if (!empty($value->offer_status) && $value->offer_status == 2 ): ?> id="offer_status_declined"<?php endif ?>><i class="fa fa-times"></i> Decline</button>
                </td>
            </tr>
        <?php    } ?>
            </tbody>
            </table>
        <?php }else{
            echo "<h3>No offers available yet.</h3>";
        }
    }

    function view_offer()
    {
        $list = $this->input->post('listing_id');
        $setstatus = $this->input->post('status');
        $member_id =  $this->session->userdata('members_id');
        if($this->marketplace_model->get_row('listing',array('id'=>$list,'member_id'=>$member_id))){
            $make_offer = $this->marketplace_model->view_offer($list, $setstatus);
        }else{
            $make_offer = $this->marketplace_model->view_offer($list, $setstatus,1);
        }
         $listingonfo=$this->marketplace_model->get_row('listing',array('id'=>$list));

        if(!empty($make_offer)){ 
            ?>
            <h3 style="  margin-top: -46px;"><center><?php echo $listingonfo->total_qty.' x '.$listingonfo->product_make.' '.$listingonfo->product_model.' '.$listingonfo->condition.' '.$listingonfo->product_color.' @ '.currency_class($listingonfo->currency).' '.$listingonfo->unit_price;?></center></h3>
          <table class="table table-bordered" style="margin-top: 46px;">
            <thead>
                <tr>
                    <th>Country</th>
                    <th>Quantity Request</th>
                    <th>Unit Price</th>
                    <th>Shipping</th>
                    <th>Grand Total</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($make_offer as $value) { 
           
            ?>
        <tr>
            <td><img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" alt="Currency" /></td>
            <td><?php echo $value->product_qty; ?></td>
            <td><?php echo $value->unit_price;?>
            <td><?php echo $value->shipping; ?></td>
            <td><?php echo currency_class($value->buyer_currency).' '.number_format($value->total_price,2);
             ?></td>
            <td class="text-center">
            <?php 
             //date('m-d-Y',strtotime($date1 . "+1 days"));
            $date1 = strtotime(date('d-m-y H:i:s', strtotime($value->created . '+1 days'))); 
            $date2 = strtotime(date('d-m-y H:i:s')); 

            if($date1 > $date2){           
            if($value->offer_received_by==$this->session->userdata('members_id')){
            ?>
            <a onclick="counter_offer(<?php echo $value->id.','.$value->product_qty.','.$value->unit_price;?>)" class="btn btn-warning"  data-toggle="modal" data-target="#form_counter_section" ><i class="fa fa-hand-o-down"></i> Counter Offer</a>
            <a href="<?php echo base_url().'marketplace/offer_status/'.$value->id.'/1/'.$value->buyer_id ?>" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Accept</a>
            <a href="<?php echo base_url().'marketplace/offer_status/'.$value->id.'/2/'.$value->buyer_id ?>" class="btn btn-outline btn-danger"><i class="fa fa-times"></i> Decline</a>
            <?php }else{ ?>
                <div class="btn btn-outline btn-warning"><i class="fa fa-hand-o-down"></i>Awaiting</div>
              <?php
                }} else{?>
            <a class="btn btn-outline btn-danger"><i class="fa fa-times"></i> Offer Expired</a>
            <?php } ?>
            </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>
        <?php }
    }
    
    function negotiation(){
        //////////$this->output->enable_profiler(TRUE);
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Negotiation';        
        $data['page'] = 'negotiation';        
        
        $data['sell_negotiation']=$this->marketplace_model->sell_buy_negotiation(1);

        $data['buy_negotiation']=$this->marketplace_model->sell_buy_negotiation(2);

        $this->load->module('templates');
        $this->templates->page($data);
    }
    function notice()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - MMarketplace: Notice';        
        $data['page'] = 'notice';        
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
    public function pay_asking_price()
    {   
        if($_POST){

        $listing_id=$_POST['listing_id'];
        $buyer_id=$this->session->userdata('members_id');
        $total_price= $_POST['total_calgross_price'];
        $shipping=$_POST['shippingselected'];   
        if($listing=$this->marketplace_model->get_row('listing', array('id'=>$listing_id))){
            
         $grand_total=0;
         if(!empty($listing->unit_price) && !empty($listing->qty_available)){ 
         $grand_total= $listing->unit_price * $listing->qty_available;
         }
         $unit_price='';
         if($listing->qty_available){
            $uprice=$grand_total/$listing->qty_available;
            $unit_price=number_format($uprice,2);
         }
         
          if($listing->listing_type==1){
            $buyer_id_to_fix=$listing->member_id;
            $seller_id_to_fix=$buyer_id;
        }
        elseif($listing->listing_type==2){
            $buyer_id_to_fix=$buyer_id;
            $seller_id_to_fix=$listing->member_id;
        }

        $data_insert=array(
                'buyer_id'      => $buyer_id_to_fix,
                'seller_id'     => $seller_id_to_fix,
                'offer_given_by'    => $buyer_id,
                'offer_received_by'   => $listing->member_id,
                'listing_id'    => $listing_id,
                'product_qty'   => $listing->qty_available,
                'unit_price'    => $unit_price,
                'grand_total'   => $grand_total,
                'total_price'   => $total_price,
                'shipping_price'=> $total_price - $grand_total,
                'shipping'      => $shipping,
                'buyer_currency'=> $listing->currency,
                'offer_status'  => 3,
                'created'       => date('Y-m-d, H:i:s')
                );
        $makeofferid=$this->marketplace_model->insert('make_offer',$data_insert);
        if($listing->listing_type==1){
            $offer_type=2;
            }else
            {$offer_type=1;
            }
        $data_insert_negotiation=array(
                'offer_id'      => $makeofferid,
                'buyer_id'      => $buyer_id_to_fix,
                'offer_given_by'    => $buyer_id,
                'offer_received_by'   => $listing->member_id,
                'seller_id'     => $seller_id_to_fix,
                'listing_id'    => $listing_id,
                'product_qty'   => $listing->qty_available,
                'unit_price'    => $unit_price,
                'grand_total'   => $grand_total,
                'total_price'   => $total_price,
                'shipping_price'=> $total_price - $grand_total,
                'shipping'      => $shipping,
                'buyer_currency'=> $listing->currency,
                'status'        => 0,
                'access'        => $buyer_id,
                'pay_asking_price'=> 1,
                'offer_type'    => $offer_type,
                'created'       => date('Y-m-d, H:i:s')
                );

         $this->marketplace_model->insert('negotiation',$data_insert_negotiation);

        $this->session->set_flashdata('msg_success','Request inserted sucessfully...! ');
      }
      else{
        $this->session->set_flashdata('msg_error','Failed, Please try again.');
      }
    }else{
        $this->session->set_flashdata('msg_error','Failed, Please try again.');
      }
      redirect($_SERVER['HTTP_REFERER']);
    }

    function order_status($id='',$status='0')
    {
      $user_id =  $this->session->userdata('members_id');
      if($this->marketplace_model->update('make_offer',array('order_status'=>$status),array('id'=>$id,'(seller_id = '.$user_id .' OR buyer_id ='.$user_id.')'=>null))){
            $this->session->set_flashdata('msg_success','Order status change sucessfully.');  
        }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
    }

   function deal_info($listing_id='',$order_id='')
    {
        if($deal_info =  $this->marketplace_model->get_row('listing',array('id'=>$listing_id))){
        ?>
        <div class="col-lg-6">
            <dl class="dl-horizontal">
                <h4 style="text-align:center">Product Details</h4>
                <dt>Make:</dt> <dd> <?php if(!empty($deal_info->product_make)){ echo $deal_info->product_make; } ?></dd>
                <dt>Model:</dt> <dd>  <?php if(!empty($deal_info->product_model)){ echo $deal_info->product_model; } ?></dd>
                <dt>Memory:</dt> <dd>  16GB</dd>
                <dt>Colour:</dt> <dd> <?php if(!empty($deal_info->product_color)){ echo $deal_info->product_color; } ?></dd>
                <dt>Product Type:</dt> <dd> <?php if(!empty($deal_info->product_type)){ echo $deal_info->product_type; } ?></dd>
                <dt>Condition:</dt> <dd><?php if(!empty($deal_info->condition)){ echo $deal_info->condition; } ?></dd>
                <dt>Spec</dt> <dd>  <?php if(!empty($deal_info->spec)){ echo $deal_info->spec; } ?></dd>
            </dl>
            <dl class="dl-horizontal">
                <h4 style="text-align:center">Price</h4>
                <dt>Buy Price:</dt> <dd>  <?php if(!empty($deal_info->currency)) { echo currency_class($deal_info->currency); } 
                if(!empty($deal_info->unit_price)){ echo $deal_info->unit_price; } ?></dd>
                <dt>Product Type:</dt> <dd>  <?php if(!empty($deal_info->product_type)){ echo $deal_info->product_type; } ?></dd>
                <dt>Condition:</dt> <dd> <?php if(!empty($deal_info->condition)){ echo $deal_info->condition; } ?></dd>
                <dt>Spec</dt> <dd><?php if(!empty($deal_info->spec)){ echo $deal_info->spec; } ?></dd>
            </dl>
        </div>
        <div class="col-lg-6">
            <?php if(!empty($deal_info->image1) || file_exists($deal_info->image1)){
                
        $img1 = '';
            if(!empty($deal_info->image1)){
                $img1 = explode('/', $deal_info->image1); 
            }
            ?>
            <p style="text-align:center">
            <img style="text-align:center" src="<?php echo base_url().'public/upload/listing/thumbnail/'.$img1[3]; ?>" alt="">
            <?php }else{ ?>
             <p style="text-align:center">
             <img style="text-align:center" src="public/main/template/gsm/images/marketplace/marketplace_photo.png" /></p>
            <?php } ?>
            <h4>Product Description</h4>
            <?php if(!empty($deal_info->product_desc)){ echo $deal_info->product_desc; } ?>
        </div>
        <?php if($get_order_info=$this->marketplace_model->get_row('make_offer',array('id'=>$order_id))){
        if($get_order_info->payment_detail){
        ?>
         <div class="col-lg-12">
         <table class="table">
                 <tr>
                     <th>Date & Time</th>
                     <th>Buyer Or Seller</th>
                     <th>Status</th>
                     <th>Detail</th>
                 </tr>
                 <tr><td>
                     <?php echo date('d-M-y, H:i', strtotime($get_order_info->payment_infoadd_datetime)); ?>
                    </td>
                    <td>Seller</td>
                    <td>Pay Info sent</td>
                    <td><?php echo $get_order_info->payment_detail;?></td>
                    </tr>
                <?php if($get_order_info->payment_done_datetime !='0000-00-00 00:00:00'){ ?>
                    <tr><td>
                      <?php echo date('d-M-y, H:i', strtotime($get_order_info->payment_done_datetime)); ?>
                    </td>
                    <td>Buyer</td>
                    <td>Pay sent</td>
                    <td>Payment Sent</td>
                    </tr>
                    <?php } ?>

                    <?php if($get_order_info->tracking_shipping){ ?>
                    <tr><td>
                      <?php echo date('d-M-y, H:i', strtotime($get_order_info->shipping_arrived_datetime)); ?>
                    </td>
                    <td>Seller</td>
                    <td>Shipped</td>
                    <td><?php echo $get_order_info->tracking_shipping;?></td>
                    </tr>
                    <?php } ?>

         </table>
         </div>
        <?php }}}
    }
   public function insert_payment_info(){
      $payment_detail = $this->input->post('payment_info');
      $user_id = $this->session->userdata('members_id');
      $id = $this->input->post('order_id');
      if($this->marketplace_model->update('make_offer',array('order_status'=>1,'payment_detail'=>$payment_detail,'payment_infoadd_datetime'=>date('Y-m-d h:i:s')),array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Payment information save sucessfully.');  
        }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
   }
   public function payment_done(){

    if(isset($_POST['payment_done'])){
      $user_id = $this->session->userdata('members_id');
      $id = $this->input->post('order_id');
      if($this->marketplace_model->update('make_offer',array('payment_done_datetime'=>date('Y-m-d h:i:s'),'payment_done'=>1),array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Payment Done sucessfully.');  
        }else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
        }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
   }

    public function payment_confirm(){
      if(isset($_POST['payment_confirm'])){
        $shipping_detail = $this->input->post('shipping_info');
      $user_id = $this->session->userdata('members_id');
      $id = $this->input->post('order_id');
      if($this->marketplace_model->update('make_offer',array('order_status'=>3,'payment_recevied_datetime'=>date('Y-m-d h:i:s'),'tracking_shipping'=>$shipping_detail,'shipping_arrived_datetime'=>date('Y-m-d h:i:s')),array('id'=>$id))){
            $this->session->set_flashdata('msg_success','PShipping Information save sucessfully.');  
        }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }}
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
   }
   public function add_tracking_shipping_info(){
      $shipping_detail = $this->input->post('shipping_info');
      $user_id = $this->session->userdata('members_id');
      $id = $this->input->post('order_id');
      if($this->marketplace_model->update('make_offer',array('order_status'=>3,'tracking_shipping'=>$shipping_detail,'shipping_arrived_datetime'=>date('Y-m-d h:i:s')),array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Shipping Information save sucessfully.');  
        }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
   }

     public function shipping_received(){
      if(isset($_POST['shipping_received'])){
      $user_id = $this->session->userdata('members_id');
      $id = $this->input->post('order_id');
      if($this->marketplace_model->update('make_offer',array('order_status'=>4,'shipping_recevied_datetime'=>date('Y-m-d h:i:s'),'shipping_received'=>1),array('id'=>$id))){
            $this->session->set_flashdata('msg_success','Order Statue changed sucessfully.');  
        }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }}
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
   }

   public function feedback_redirect(){
    $this->session->set_flashdata('msg_success','Feedback save is sucessfully.');
    redirect('marketplace/history');
   }

   public function buyer_feedback(){
    if($_POST['feedback']){
      $user_id = $this->session->userdata('members_id');
      $id = $this->input->post('order_id');
      if($this->marketplace_model->update('make_offer',array('buyer_feedback'=>$_POST['feedback'],'buyer_feedback_datetime'=>date('Y-m-d h:i:s'),'buyer_history'=>1),array('id'=>$id,'buyer_id'=>$user_id))){
            $this->session->set_flashdata('msg_success','Feedback save is sucessfully.');  
        }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
    }
    else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect('marketplace/history');
   }

   public function seller_feedback(){
    if($_POST['feedback']){
      $user_id = $this->session->userdata('members_id');
      $id = $this->input->post('order_id');
      if($this->marketplace_model->update('make_offer',array('seller_feedback'=>$_POST['feedback'],'seller_feedback_datetime'=>date('Y-m-d h:i:s'),'seller_history'=>1),array('id'=>$id,'seller_id'=>$user_id))){
            $this->session->set_flashdata('msg_success','Feedback save is sucessfully.');  
        }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
    }
    else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect('marketplace/history');
   }

  function view_negotiation_payasking()
  {
    $member_id=$this->session->userdata('members_id');
    $parent_id = $this->input->post('parent_id');
    $listing_id = $this->input->post('listing_id');
    $counter_offer_sec = $this->marketplace_model->view_negotiation_payasking($parent_id);

    $listingonfo=$this->marketplace_model->get_row('listing',array('id'=>$listing_id));

    if(!empty($counter_offer_sec)){ ?>
    <h3 style="  margin-top: -46px;"><center><?php echo $listingonfo->total_qty.' x '.$listingonfo->product_make.' '.$listingonfo->product_model.' '.$listingonfo->condition.' '.$listingonfo->product_color.' @ '.currency_class($listingonfo->currency).' '.$listingonfo->unit_price;?></center></h3>

      <table class="table table-bordered" style="margin-top: 46px;" >
        <thead>
            <tr >
                <th>Country</th>
                <th>Quantity Request</th>
                <th>Unit Price</th>
                <th>Shipping</th>
                <th>Grand Total</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($counter_offer_sec as $value) { 
        ?>
    <tr>
        <td><img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" alt="Currency" /></td>
            <td><?php echo $value->product_qty; ?></td>
            <td><?php echo $value->unit_price;?>
            <td><?php echo $value->shipping; ?></td>
            <td><?php echo currency_class($value->buyer_currency).' '.number_format($value->total_price,2);
             ?></td>
        <td class="text-center">
        <?php 
        $date1 = strtotime(date('d-m-y H:i:s', strtotime($value->created . '+1 days'))); 
        $date2 = strtotime(date('d-m-y H:i:s')); 

    if($value->access!=$member_id){
        ?>
        <a href="<?php echo base_url().'marketplace/pay_asking_status/'.$value->offer_id.'/'.$value->id.'/1/'.$value->buyer_id ?>" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Accept</a>
        <a href="<?php echo base_url().'marketplace/pay_asking_status/'.$value->offer_id.'/'.$value->id.'/2/'.$value->buyer_id ?>" class="btn btn-outline btn-danger"><i class="fa fa-times"></i> Decline</a>
        <?php }else{
           ?>
            <div class="btn btn-outline btn-warning"><i class="fa fa-hand-o-down"></i>Awaiting</div>
          <?php }?>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <?php }
   }

   function view_negotiation_offer()
  {
    $member_id=$this->session->userdata('members_id');
    $parent_id = $this->input->post('parent_id');
    $listing_id = $this->input->post('listing_id');
    $counter_offer_sec = $this->marketplace_model->view_negotiation_payasking($parent_id);
    $listingonfo=$this->marketplace_model->get_row('listing',array('id'=>$listing_id));
    $counter_offer_sec = $this->marketplace_model->view_negotiation($parent_id);
    if(!empty($counter_offer_sec)){ ?>
     <h3 style="  margin-top: -46px;"><center><?php echo $listingonfo->total_qty.' x '.$listingonfo->product_make.' '.$listingonfo->product_model.' '.$listingonfo->condition.' '.$listingonfo->product_color.' @ '.currency_class($listingonfo->currency).' '.$listingonfo->unit_price;?></center></h3>
      <table class="table table-bordered"  style="margin-top: 46px;" >
        <thead>
            <tr>
                 <th>Country</th>
                <th>Quantity Request</th>
                <th>Unit Price</th>
                <th>Shipping</th>
                <th>Grand Total</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($counter_offer_sec as $value) { ?>
    <tr>
        <td><img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" alt="Currency" /></td>
            <td><?php echo $value->product_qty; ?></td>
            <td><?php echo $value->unit_price;?>
            <td><?php echo $value->shipping; ?></td>
            <td><?php echo currency_class($value->buyer_currency).' '.number_format($value->total_price,2);
             ?></td>
        <td class="text-center">
        <?php 
         //date('m-d-Y',strtotime($date1 . "+1 days"));
        $date1 = strtotime(date('d-m-y H:i:s', strtotime($value->created . '+1 days'))); 
        $date2 = strtotime(date('d-m-y H:i:s')); 

    if($value->access!=$member_id){
        if(empty($value->pay_asking_price)){?>
        <a onclick="counter_offer(<?php echo $value->offer_id.','.$value->product_qty.','.$value->unit_price; ?>)" class="btn btn-warning"  data-toggle="modal" data-target="#form_counter_section" ><i class="fa fa-hand-o-down"></i> Counter Offer</a>
        <?php } ?>
        <a href="<?php echo base_url().'marketplace/offer_status_negotiation/'.$value->offer_id.'/'.$value->id.'/1/'.$value->buyer_id ?>" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Accept</a>
        <a href="<?php echo base_url().'marketplace/offer_status_negotiation/'.$value->offer_id.'/'.$value->id.'/2/'.$value->buyer_id ?>" class="btn btn-outline btn-danger"><i class="fa fa-times"></i> Decline</a>
        <?php }else{
           ?>
            <div class="btn btn-outline btn-warning"><i class="fa fa-hand-o-down"></i>Awaiting</div>
          <?php }?>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <?php }
   }

   function view_negotiation_offer_sell()
  {
    $parent_id = $this->input->post('parent_id');
    $counter_offer_sec = $this->marketplace_model->view_counter_offer_sell($parent_id);
    $member_id=$this->session->userdata('members_id');
    if(!empty($counter_offer_sec)){ ?>
      <table class="table table-bordered" >
        <thead>
            <tr>
                <th>Country</th>
                <th>Company</th>
                <th>Rating</th>
                <th>Quantity</th>
                <th>Shipping</th>
                <th>Grand Total</th>
                <th>Options</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($counter_offer_sec as $value) { ?>
    <tr>
        <td><img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" alt="Currency" /></td>
        <td><?php echo $value->company_name; ?></td>
        <td><span class="fa fa-star" style="color:#FC3"></span> <span style="color:green">94</span></td>
        <td><?php echo $value->product_qty; ?></td>
        <td><?php echo $value->shipping; ?></td>
        <td><?php echo currency_class($value->buyer_currency).' '.number_format($value->total_price,2);
         ?></td>
        <td class="text-center">
        <?php 
         //date('m-d-Y',strtotime($date1 . "+1 days"));
        $date1 = strtotime(date('d-m-y H:i:s', strtotime($value->created . '+1 days'))); 
        $date2 = strtotime(date('d-m-y H:i:s')); 

        if($value->access!=$member_id){
        if(empty($value->pay_asking_price)){?>
        <a onclick="counter_offer(<?php echo $value->id; ?>)" class="btn btn-warning"  data-toggle="modal" data-target="#form_counter_section" ><i class="fa fa-hand-o-down"></i> Counter Offer</a>
        <?php } ?>
        <a href="<?php echo base_url().'marketplace/offer_status/'.$value->id.'/1/'.$value->buyer_id ?>" class="btn btn-outline btn-primary"><i class="fa fa-check"></i> Accept</a>
        <a href="<?php echo base_url().'marketplace/offer_status/'.$value->id.'/2/'.$value->buyer_id ?>" class="btn btn-outline btn-danger"><i class="fa fa-times"></i> Decline</a>
        <?php }else{
           ?>
            <div class="btn btn-outline btn-warning"><i class="fa fa-hand-o-down"></i>Awaiting</div>
          <?php }?>
        </td>
    </tr>
    <?php } ?>
    </tbody>
    </table>
    <?php }
   }

   function counter_offer_negotiation(){

    if($_POST){
        $mellerid =  $this->session->userdata('members_id');
        $offer_id=$_POST['offer_id'];
        $qty=$_POST['qty'];
        $per_unit_price=$_POST['per_unit_price'];
        if($offerdetail=$this->marketplace_model->get_row('make_offer',array('id'=>$offer_id))){
        $grand_total=$qty * $per_unit_price;

        $listing=$this->marketplace_model->get_row('listing', array('id'=>$offerdetail->listing_id));

        if($listing->listing_type==1){$offer_type=2;}
        else{$offer_type=1;}

        $data_insert_negotiation=array(
            'buyer_id'      => $offerdetail->buyer_id,
            'offer_id'      => $offerdetail->id,
            'seller_id'     => $offerdetail->seller_id,
            'listing_id'    => $offerdetail->listing_id,
            'product_qty'   => $qty,
            'unit_price'    => $per_unit_price,
            'grand_total'   => $grand_total,
            'total_price'   => $grand_total + $offerdetail->shipping_price,
            'shipping_price'=> $offerdetail->shipping_price,
            'shipping'      => $offerdetail->shipping,
            'buyer_currency'=> $offerdetail->buyer_currency,
            'access'        => $mellerid,
            'offer_type'    => $offer_type,
            'pay_asking_price'=>0,
            'created'       => date('Y-m-d, H:i:s')
            );

     $this->marketplace_model->update('negotiation',array('status'=>3),array('offer_id'=>$offer_id));

     $this->marketplace_model->insert('negotiation',$data_insert_negotiation);
        $this->session->set_flashdata('msg_success','Offer move to negotiation.'); 
        }
        else{
            $this->session->set_flashdata('msg_info','Invalid.');
            redirect($_SERVER['HTTP_REFERER']);
        }
           redirect('marketplace/negotiation'); 
        }else{
            $this->session->set_flashdata('msg_info','Invalid.');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

  function offer_status_negotiation($id='',$negotiation_id='0',$status='0',$buyer_id)
    {
      $seller_id =  $this->session->userdata('members_id');


      $this->marketplace_model->update('negotiation',array('status'=>$status),array('id'=>$negotiation_id));

            
      $negotiation_o=$this->marketplace_model->get_row('negotiation',array('id'=>$negotiation_id));
        $user1=$seller_id;
        $user2=$buyer_id;
      if($user1 == $user2){
        if($user2 != $negotiation_o->buyer_id){
            $user1=$seller_id;
            $user2=$negotiation_o->buyer_id;
        }
        else{
            $user1=$negotiation_o->buyer_id;
            $user2=$seller_id;
        }
      }
      if($user1 == $user2){
        if($user2 != $negotiation_o->buyer_id){
            $user1=$negotiation_o->buyer_id;
            $user2=$seller_id;
        }
        else{
            $user1=$seller_id;
            $user2=$negotiation_o->buyer_id;
        }
      }

      $make_offer=$this->marketplace_model->get_row('make_offer',array('id'=>$id));

      $per_unit_price=$negotiation_o->unit_price;
      $qty=$negotiation_o->product_qty;
      $grand_price=$per_unit_price * $qty;
      $total_price=$grand_price + $make_offer->shipping_price;

      if($status==1){
        $this->marketplace_model->update('make_offer',array('offer_status'=>$status,'invoice_no'=>$seller_id.'-'.$buyer_id.'-'.$id,'unit_price'=>$per_unit_price,'product_qty'=>$qty,'grand_total'=>$grand_price,'total_price'=>$total_price),array('id'=>$id));

             $data = array(
                'member_id'         => $user1,
                'sent_member_id'    => $user2,
                'subject'           => 'Offer is accepted',
                'body'              => 'Offer is accepted',
                'inbox'             => 'yes',
                'sent'              => 'yes',
                'date'              => date('d-m-Y'),
                'time'              => date('H:i:s'),
                'sent_from'         => 'market',
                'datetime'          => date('Y-m-d H:i:s')
              ); 
           $this->load->model('mailbox/mailbox_model', 'mailbox_model');
            $this->mailbox_model->_insert($data);

            $this->session->set_flashdata('msg_success','Offer Accepted sucessfully and move in open order.');  
            redirect('marketplace/open_orders');
          }elseif($status==2){

            $message = "";
            if( $offer_info=$this->marketplace_model->get_row('make_offer', array('id'=>$id))){
                $message = "<br>Offer sent info - <br>Per unit price : ".$offer_info->unit_price."<br>Quantity : ".$offer_info->product_qty."<br>Shipping : ".$offer_info->shipping_price."<br>To resend a better offer<a href='marketplace/listing_detail"."/".$offer_info->listing_id."'> Click here</a>";
            }
            $this->marketplace_model->update('make_offer',array('offer_status'=>$status),array('id'=>$id));

            $data = array(
                'member_id'         => $user1,
                'sent_member_id'    => $user2,
                'subject'           => 'Offer is declined',
                'body'              => 'Offer is declined Do you want to resent it.'.$message,
                'inbox'             => 'yes',
                'sent'              => 'yes',
                'date'              => date('d-m-Y'),
                'time'              => date('H:i:s'),
                'sent_from'         => 'market',
                'datetime'          => date('Y-m-d H:i:s')
              ); 
           $this->load->model('mailbox/mailbox_model', 'mailbox_model');
            $this->mailbox_model->_insert($data);

            $this->session->set_flashdata('msg_success','Offer Declined sucessfully.'); 
          }
        else{
          $this->session->set_flashdata('msg_info','Invalid.');  
        }
       redirect($_SERVER['HTTP_REFERER']);
    }

    public function redirect_link()
    {
        $this->session->set_flashdata('msg_success','Offer accepted '); 
        redirect($_SERVER['HTTP_REFERER']);
    }

   function end_listing_status($listing_id='')
   {   
       if(!empty($listing_id)){
        $member_id =  $this->session->userdata('members_id');
           $this->marketplace_model->update('listing', array('status'=>3),array('id'=>$listing_id,'member_id'=>$member_id));
               $this->session->set_flashdata('msg_success', 'Listing ended successfully.');
       }
       else{
            $this->session->set_flashdata('msg_info','Invalid listing id.'); 
       }
       redirect($_SERVER['HTTP_REFERER']);
   }

   public function import($type='csv'){
        
        if($this->read_csv_xls_xlsx(array('file'=>'Workbook6.csv','path'=>'public/')))
        {
            echo "Data is inserted";
        }else{
            echo "Eroor";
        }
    }


    private function read_csv_xls_xlsx($param=array()){
        
    if(!isset($param['file']) && empty($param['file'])){
        $this->session->set_flashdata('msg_error','File Name can\'t be blank, Please try again.');
        return FALSE;
    }

    if(!isset($param['path']) && empty($param['path'])){
        $this->session->set_flashdata('msg_error','File Path can\'t be blank, Please try again.');
        return FALSE;
    }

    $filename = $param['path'].$param['file'];

    if(file_exists($filename)){
        require(APPPATH.'libraries/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(APPPATH.'libraries/spreadsheet-reader/SpreadsheetReader.php');

        $Reader = new SpreadsheetReader($filename);
        $l=0; $u=0;$i=0;
        $listing_data=array();
       

        foreach ($Reader as $row):
            
            if((!empty($row[1])) && $l>0){
                $listing_data['product_mpn_isbn'] = $row[0];
                 if($row[1]){
                    $listing_data['product_mpn_isbn'] = $row[1];
                 }
                $listing_data['product_make'] = $row[2];
                $listing_data['product_model'] = $row[3];
                $listing_data['product_type'] = $row[5];
                if($row[4]){
                    $color=explode(',',$row[4]);
                    $listing_data['product_color'] = json_encode($color);
                }
                if($row[6]){
                    $capacity=explode(',',$row[6]);
                    $listing_data['product_capacity'] = json_encode($capacity);
                }
                $listing_data['created']    = date('Y-m-d h:i:s A');
                $this->marketplace_model->insert('listing_attributes', $listing_data);                    
               }
            $l++;
        endforeach;
       
        return TRUE;
        }else{
            $this->session->set_flashdata('msg_error','Product does not exist, Please try again.');
            return FALSE;
        }
    }
}