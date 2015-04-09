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
    
    function sell($offset=0)
    {
        $per_page=10;
        $data['listing_sell'] = $this->marketplace_model->listing_sell($offset,$per_page);
        $config=backend_pagination();
        $config['base_url'] = base_url().'marketplace/sell';
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
    
    function create_listing($list_id='')
    {   

        $member_id=$this->session->userdata('members_id');
        //$this->output->enable_profiler(TRUE);

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
        if(isset($_POST['allowoffer_checkbox'])){
           $this->form_validation->set_rules('allow_offer', 'allow offer', 'required');
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
        $data['sell_offer'] = $this->marketplace_model->listing_sell_offer();
        $data['buying_request'] = $this->marketplace_model->listing_buying_offer();
        $data['counter_offer'] = $this->marketplace_model->listing_counter_offer();
        
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Listing';        
        $data['page'] = 'my-listings';
        
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
        $this->form_validation->set_rules('product_mpn', 'product Mpn', 'required');
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
        if(isset($_POST['allowoffer_checkbox'])){
           $this->form_validation->set_rules('allow_offer', 'allow offer', 'required');
        }
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

           $min_price='';
           $allow_offer='';
           $min_qty_order='';

           if(isset($_POST['minimum_checkbox'])){
              $min_price=$this->input->post('min_price');
            }else{
                $min_price='';
            }
            if(isset($_POST['allowoffer_checkbox'])){
               $allow_offer=$this->input->post('allow_offer');
            }else{
                $allow_offer='';
            }
            
            if(isset($_POST['orderqunatity_checkbox'])){
               $min_qty_order=$this->input->post('min_qty_order');
            }else{
                $min_qty_order='';
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
            
             $shipping_fee = array();
            if(!empty($_POST['shipping_terms'])){
            $arr_count = count($_POST['shipping_terms']);


            for($i=0; $i < count($_POST['shipping_terms']); $i++){
                $shipping_fee[] = 
                array(
               'shipping_term'   =>  $_POST['shipping_terms'][$i],
               'coriars'         =>  $_POST['coriars'][$i],
               'shipping_types'  =>  $_POST['ship_types'][$i],
               'shipping_fees'   =>  $_POST['shipping_fees'][$i],
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
            $status = 0;
        }
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
        $data_insert['listing_end_datetime'] =  date('Y-m-d H:i:s', strtotime("+".$this->input->post('duration')." days"));            
        $data_insert['member_id']            = $member_id; 
        $data_insert['status']               = $status; 
        if(!empty($list_id))
            $data_insert['updated']              = date('Y-m-d h:i:s A');
        else
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
           redirect('marketplace/saved_listing');
            
        }
        }

        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Sell Listing';        
        $data['page'] = 'sell-listing';
        $data['page_redirect'] = $page_redirct;

        $data['listing_attributes'] =  $this->marketplace_model->get_result('listing_attributes');
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
          if($data['product_list']   =  $this->marketplace_model->get_row('listing',array('id'=>$list_id,'member_id'=>$member_id))){
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
        $this->form_validation->set_rules('product_mpn', 'product mpn', 'required');
       
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
        if(isset($_POST['allowoffer_checkbox'])){
           $this->form_validation->set_rules('allow_offer', 'allow offer', 'required');
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

           $min_price='';
           $allow_offer='';
           $min_qty_order='';
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
               $allow_offer='';
            }
            
            if(isset($_POST['orderqunatity_checkbox'])){
               $min_qty_order=$this->input->post('min_qty_order');
            }else{
               $min_qty_order='';
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
            }

        /*product mpn and isbn check*/
            $product_mpn    = $this->input->post('product_mpn');
            
            $check_product_mpn = $this->marketplace_model->get_row('listing_attributes', array('product_mpn_isbn'=>$product_mpn));
         
            $status = '';
            if(!empty($check_product_mpn) || ($this->input->post('status')==2)){
                $status = $this->input->post('status');
            }else{
                $status = 0;
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
            $data_insert['listing_end_datetime'] =  date('Y-m-d H:i:s', strtotime("+".$this->input->post('duration')." days"));            
            $data_insert['member_id']            = $member_id; 
            $data_insert['status']               = $status; 
        if(!empty($list_id))
            $data_insert['updated']              = date('Y-m-d h:i:s A');
        else
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
           redirect('marketplace/saved_listing');
            
        }
        }

        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place: Buy Listing';        
        $data['page'] = 'buy-listing';

        $data['listing_attributes'] =  $this->marketplace_model->get_result('listing_attributes');
        $data['shippings'] =  $this->marketplace_model->get_result('shippings','','',array('shipping_name','ASC'));
        if(!empty($list_id)){
        $data['couriers'] =  $this->marketplace_model->get_couriers_by_group('courier_name');
        }

        $data['product_colors'] =  $this->marketplace_model->get_result_by_group('product_color');
        $data['product_makes'] =  $this->marketplace_model->get_result_by_group('product_make');
        //$data['product_types'] =  $this->marketplace_model->get_result_by_group('product_type');

        $data['pro_type'] =  $this->marketplace_model->get_result('listing_attributes','',array('product_type'));
        $check_securty=0;
        if(!empty($list_id)){
         if(is_numeric($list_id)){
          if($data['product_list']   =  $this->marketplace_model->get_row('listing',array('id'=>$list_id,'member_id'=>$member_id))){
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
        
        $this->load->module('templates');
        $this->templates->page($data);
    }

    function listing_watch($seller_id='', $listing_id='')
    {
       $user_id =  $this->session->userdata('members_id');
        $check_list = $this->marketplace_model->get_row('listing_watch', array('listing_id'=>$listing_id,'user_id'=>$user_id));
        if(empty($check_list)){
         $data_insert=array(
                            'listing_id' =>  $listing_id,
                            'seller_id' =>   $seller_id,
                            'user_id'    =>  $user_id,
                            'created'    =>  date('Y-m-d')
                            );
         $this->marketplace_model->insert('listing_watch',$data_insert);
         redirect('marketplace/listing_detail/'.$listing_id);
        }else{
         $this->session->set_flashdata('msg_info','you have already watch.');  
         redirect('marketplace/listing_detail/'.$listing_id);
        }
    }


    function listing_unwatch($listing_id='')
    {
         $this->marketplace_model->delete('listing_watch',array('listing_id'=>$listing_id));
         $this->session->set_flashdata('msg_success','you have unwatch successfully.');  
         redirect('marketplace/watching');
     
    }

    function listing_question()
    {
        if(!empty($_POST['ask_question'])){
            $user_id =  $this->session->userdata('members_id');
            $listing_id = $this->input->post('listing_id');
            $data_insert=array(
                            'listing_id' =>  $listing_id,
                            'seller_id' => $this->input->post('seller_id'),
                            'buyer_id'  =>  $user_id,
                            'question'   =>  $this->input->post('ask_question'),
                            'created'    =>  date('Y-m-d')
                            );
            $question_id = $this->marketplace_model->insert('listing_question',$data_insert);
            if(!empty($question_id)){
                echo "<div class='alert alert-success'>Your question sent successfully. You will get response as soon as possible</div>";
            }else{
               echo "<div class='alert alert-warning'>Please Try again.</div>"; 
            }
            
        }
    }

    function get_listing_question($listing_id=0)
    {
        $user_id =  $this->session->userdata('members_id');

       $seller_question = $this->marketplace_model->get_result('listing_question', array('seller_id'=>$user_id,'listing_id'=>$listing_id)); 
       $buyer_question = $this->marketplace_model->get_result('listing_question', array('buyer_id'=>$user_id,'listing_id'=>$listing_id));
      

       ?>
       <h4><strong>Seller Question List</strong></h4>
       <div id="del_msg"></div>
        <table class="table table-striped table-bordered table-hover dataTables-example">
            <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="60%">Question</th>
                <!-- <th width="30%">Action</th> -->
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($seller_question)){
                    foreach ($seller_question as $value) {  ?>
                            <tr>
                                <td><?php echo '#'.$value->id; ?></td>
                                <td><?php echo $value->question; ?>
                                </td><!-- <td><button class="btn btn-danger" onclick="delete_data(<?php //echo $value->id; ?>)">delete</buttton> --></td>
                            </tr>
                    <?php }
                }else{
                    echo "No Question List Found.";
                } ?>
        </table>
        <h4><strong>Buyer Question List</strong></h4>
         <table class="table table-striped table-bordered table-hover dataTables-example">
            <thead>
            <tr>
                <th width="10%">ID</th>
                <th width="60%">Question</th>
                <!-- <th width="30%">Action</th> -->
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($buyer_question)){
                    foreach ($buyer_question as $value) {  ?>
                            <tr>
                                <td><?php echo '#'.$value->id; ?></td>
                                <td><?php echo character_limiter($value->question,10); ?>
                                </td><!-- <td><button class="btn btn-danger" onclick="delete_data(<?php //echo $value->id; ?>)">delete</buttton> --></td>
                            </tr>
                    <?php }
                }else{
                    echo "No Question List Found.";
                } ?>
        </table>
       <?php 
    }

    // function delete_listing_question()
    // {
    //     $delete_data = $this->marketplace_model->delete('listing_question', array('id'=>$this->input->post('row_id')));
    //     if(!empty($delete_data)){
    //         echo "<div class='alert alert-success'>question delete successfully.</div>";
    //     }else{
    //        echo "<div class='alert alert-warning'>Please Try again.</div>"; 

    //     }
    // }
    
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
            $param_thumb['width']  = '200';
            $param_thumb['height']  = '200';
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
            $param_thumb['width']  = '200';
            $param_thumb['height']  = '200';
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
            $param_thumb['width']  = '200';
            $param_thumb['height']  = '200';
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
            $param_thumb['width']  = '200';
            $param_thumb['height']  = '200';
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
            $param_thumb['width']  = '200';
            $param_thumb['height']  = '200';
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
        //$this->output->enable_profiler(TRUE);
        if(empty($id)) { redirect('marketplace/index'); }
        $member_id=$this->session->userdata('members_id');
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - Market Place';        
        $data['page'] = 'listing_detail';
        //$data['page'] = 'buy_html';
        $data['member_id'] =$member_id;
        $data['listing_detail'] =  $this->marketplace_model->get_row('listing',array('id'=>$id));
        if($data['listing_detail']==FALSE)   redirect('marketplace/index');

        $data['member'] = $this->marketplace_model->get_row('members',array('id'=> $data['listing_detail']->member_id));
        if($data['member']){
        $data['company'] = $this->marketplace_model->get_row('company',array('id'=>$data['member']->company_id));

        $data['memberships'] = $this->marketplace_model->get_row('membership',array('id'=>$data['member']->membership),array('membership'));


       } else
         $data['company'] = FALSE;
       // $data['memberships']= FALSE;

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

    function make_offer()
    {

        $this->form_validation->set_rules('product_qty', 'product Quantity', 'required');
        $this->form_validation->set_rules('unit_price', 'Unit Price', 'required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if($this->form_validation->run($this) == TRUE){
            $listing_id  = $this->input->post('listing_id');
            $data_insert = array(
                'buyer_currency'=> $this->input->post('buyer_currency'),
                'buyer_id'     => $this->session->userdata('members_id'),
                'seller_id'     => $this->input->post('seller_id'),
                'listing_id'    => $listing_id,
                'product_qty'   => $this->input->post('product_qty'),
                'unit_price'    => $this->input->post('unit_price'),
                'created'       => date('Y-m-d')
                );
            $insert_id = $this->marketplace_model->insert('make_offer', $data_insert);
            if(!empty($insert_id)){
               $this->session->set_flashdata('msg_success','you have offer send successfully. you will get response as soon as posible');  
               redirect('marketplace/listing_detail/'.$listing_id);
            }
        }
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
        $make_offer = $this->marketplace_model->view_offer($list);
        if(!empty($make_offer)){ ?>
            <table class="table table-bordered" >
                <thead>
                    <tr>
                        <th>Company</th>
                        <th>Rating</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Country</th>
                        
                    </tr>
                </thead>
                <tbody>
        
        <?php foreach ($make_offer as $value) { ?>

                    <tr>
                        <td><?php echo $value->company_name; ?></td>
                        <td><span class="fa fa-star" style="color:#FC3"></span> <span style="color:green">94</span></td>
                        <td><?php echo $value->product_qty; ?></td>
                        <td><?php echo $value->buyer_currency; ?> <?php echo $value->unit_price; ?></td>
                        <td><img src="public/main/template/gsm/img/flags/<?php echo str_replace(' ', '_', $value->product_country) ?>.png" alt="<?php echo $value->product_country ?>" alt="Currency" /></td>
                    </tr>
        <?php    } ?>
                    </tbody>
                    </table>
        <?php }
    }

    public function offer_status()
    {
       $list = $this->input->post('listing_id');
       $buyer_id = $this->input->post('buyer_id');


        $update_all = $this->marketplace_model->update('make_offer',array('offer_status'=>2), array('listing_id'=>$list));
    if(!empty($update_all)){
        
       $query = $this->marketplace_model->update('make_offer',array('offer_status'=>1), array('listing_id'=>$list, 'buyer_id'=>$buyer_id));

       if(!empty($query)){
        echo "<span class='alert alert-success'> offer status updated successfully. order will be display on open order. </span>";
       }else{
        echo "<span class='alert alert-danger'>updation failed.</span>";
       }
    }

    }
    
    function notice()
    {
        $data['main'] = 'marketplace';        
        $data['title'] = 'GSM - MMarketplace: Notice';        
        $data['page'] = 'notice';        
        
        $this->load->module('templates');
        $this->templates->page($data);
    }
}