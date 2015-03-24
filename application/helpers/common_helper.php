<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*    clear cache
*/
if ( ! function_exists('clear_cache')) {
	function clear_cache(){
		$CI =& get_instance();
		$CI->output->set_header('Expires: Wed, 11 Jan 1984 05:00:00 GMT' );
		$CI->output->set_header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . 'GMT');
		$CI->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");
		$CI->output->set_header("Pragma: no-cache");			
	}
}

if ( ! function_exists('backend_pagination')) {
	function backend_pagination(){
		$data = array();		
		$data['full_tag_open'] = '<ul class="pagination">';		
		$data['full_tag_close'] = '</ul>';
		$data['first_tag_open'] = '<li>';
		$data['first_tag_close'] = '</li>';
		$data['num_tag_open'] = '<li>';
		$data['num_tag_close'] = '</li>';
		$data['last_tag_open'] = '<li>';
		$data['last_tag_close'] = '</li>';
		$data['next_tag_open'] = '<li>';
		$data['next_tag_close'] = '</li>';
		$data['prev_tag_open'] = '<li>';
		$data['prev_tag_close'] = '</li>';
		$data['cur_tag_open'] = '<li class="active"><a href="#">';
		$data['cur_tag_close'] = '</a></li>';
		return $data;
	}					
}

if ( ! function_exists('msg_alert')) {
	function msg_alert(){
	$CI =& get_instance(); ?>
<?php if($CI->session->flashdata('msg_success')): ?>	
	<div class="alert alert-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <strong>Success :</strong> <br>  <?php echo $CI->session->flashdata('msg_success'); ?>
	</div>
 <?php endif; ?>
<?php if($CI->session->flashdata('msg_info')): ?>	
	<div class="alert alert-info">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <strong>Info :</strong> <br> <?php echo $CI->session->flashdata('msg_info'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_warning')): ?>	
	<div class="alert alert-warning">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	     <strong>Warning :</strong> <br> <?php echo $CI->session->flashdata('msg_warning'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_error')): ?>	
	<div class="alert alert-danger">
		 <button type="button" class="close" data-dismiss="alert">&times;</button> 
	     <strong>Error :</strong> <br>  <?php echo $CI->session->flashdata('msg_error'); ?>
	</div>
<?php endif; ?>
	<?php }					
}
/**
*	thisis  back end helper 
*/
if ( ! function_exists('msg_alert_front')) {
	function msg_alert_front(){
	$CI =& get_instance(); ?>
<?php if($CI->session->flashdata('msg_success')): ?>	
	<div class="alert alert-success">
		 <button type="button" class="close" data-dismiss="alert">&times;</button>
	     <!-- <strong>Success :</strong> <br> --> <?php echo $CI->session->flashdata('msg_success'); ?>
	</div>
 <?php endif; ?>
<?php if($CI->session->flashdata('msg_info')): ?>	
	<div class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <!-- <strong>Info :</strong> <br> --> <?php echo $CI->session->flashdata('msg_info'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_warning')): ?>	
	<div class="alert alert-warning">
		<!-- <button type="button" class="close" data-dismiss="alert">&times;</button> -->
	   <!--  <strong>Warning :</strong> <br> --> <?php echo $CI->session->flashdata('msg_warning'); ?>
	</div>
<?php endif; ?>
<?php if($CI->session->flashdata('msg_error')): ?>	
	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button> 
	    <!-- <strong>Error :</strong> <br> --> <?php echo $CI->session->flashdata('msg_error'); ?>
	</div>
<?php endif; ?>
	<?php }					
}
/**
*	Menu Information
*/
if ( ! function_exists('upload_file')) {
	function upload_file($param = null){
		$CI =& get_instance();		
		
		$config['upload_path'] = './assets/uploads/';
		$config['allowed_types'] = 'gif|jpg|png|xls|xlsx|csv|jpeg|pdf|doc|docx';
		$config['max_size']	= 1024*90;
		$config['image_resize']= FALSE;
		$config['resize_width']= 126;
		$config['resize_height']= 126;
		
		if ($param){
            $config = $param + $config;
        }
		$CI->load->library('upload', $config);
		if(!empty( $config['file_name']))
			$file_Status = $CI->upload->do_upload($config['file_name']);
		else
			$file_Status = $CI->upload->do_upload();
		if (!$file_Status){
			return array('STATUS'=>FALSE,'FILE_ERROR' => $CI->upload->display_errors());			
		}else{
			$uplaod_data=$CI->upload->data();
	
			$upload_file = explode('.', $uplaod_data['file_name']);
			
			if($config['image_resize'] && in_array($upload_file[1], array('gif','jpeg','jpg','png','bmp','jpe'))){
				$param2=array(
					'source_image' 	=>	$config['source_image'].$uplaod_data['file_name'],
					'new_image' 	=>	$config['new_image'].$uplaod_data['file_name'],
					'create_thumb' 	=>	FALSE,
					'maintain_ratio'=>	FALSE,
					'width' 		=>	$config['resize_width'],
					'height' 		=>	$config['resize_height'],
					);
			
				image_resize($param2);
			}	
			return array('STATUS'=>TRUE,'UPLOAD_DATA' =>$uplaod_data );
		}
	}
}
/**
*	image resize
*/
if ( ! function_exists('image_resize')) {
	function image_resize($param = null){
		$CI =& get_instance();
		$config['image_library'] = 'gd2';
		$config['source_image']	= './assets/uploads/';
		$config['new_image']	= './assets/uploads/';		
		$config['create_thumb'] = FALSE;
		$config['maintain_ratio'] = FALSE;
		$config['width']	 = 150;
		$config['height']	= 150;
		
		 if ($param) {
            $config = $param + $config;
        }
		$CI->load->library('image_lib', $config); 
		if ( ! $CI->image_lib->resize())
		{
		   //return array('STATUS'=>TRUE,'MESSAGE'=>$CI->image_lib->display_errors()); 
			die($CI->image_lib->display_errors());
		}else{
			 return array('STATUS'=>TRUE,'MESSAGE'=>'Image resized.'); 
		}
	}
}
/**
*	image delete
*/
if ( ! function_exists('file_delete')) {
	function file_delete($param = null){
		$config['file_path']	= './assets/uploads/';
		$config['file_thumb_path']	= './assets/uploads/';		
		
		if ($param){
            $config = $param + $config;
        }
        //print_r($config); die;
        if(file_exists($config['file_path'])){
				unlink($config['file_path']);
		}
		if(file_exists($config['file_thumb_path'])){
				unlink($config['file_thumb_path']);
		}		
	}
}

//for option

if ( ! function_exists('file_download')) {
	function file_download($title=FALSE,$data=FALSE){
		$data=str_replace('./', '', $data);		
		$CI =& get_instance();		
		$CI->load->helper('download');
		if(!empty($title) && !empty($data)):
			$title=url_title($title, '-', TRUE);
			if($file = file_get_contents($data)){ 		
			$extend=end(explode('.',$data));			 
			$file_name = $title.'.'.$extend;			
			force_download($file_name, $file);
		}else{
			return FALSE;
		}
		endif;	
	}
}


if ( ! function_exists('shipping_term')) {	
	function shipping_term($status='') {
		$status_array = array(
                            '1' => 'CIF',
                            '2' => 'CIP',
                            '3' => 'CPT',
                            '4' => 'DAP',
                            '5' => 'DAT',
                            '6' => 'EXW',
                            '7' => 'FCA',
                            '8' => 'NDS',
                             ); 
		return $status_array;
	}
}

if ( ! function_exists('shipping_term_class')) {	
	function shipping_term_class($status='') {
		$status_array = array(
                            '1' => 'CIF',
                            '2' => 'CIP',
                            '3' => 'CPT',
                            '4' => 'DAP',
                            '5' => 'DAT',
                            '6' => 'EXW',
                            '7' => 'FCA',
                            '8' => 'NDS',
                             ); 
		return element($status, $status_array);
	}
}

if ( ! function_exists('courier')) {	
	function courier($status='') {
		$status_array = array(
                            'option1' => 'DHL',
                            'option2' => 'FEDEX',
                            'option3' => 'UPS',
                            'option4' => 'OTHER',
                             ); 
		return $status_array;
	}
}

if ( ! function_exists('courier_class')) {	
	function courier_class($status='') {
		$status_array = array(
                            'option1' => 'DHL',
                            'option2' => 'FEDEX',
                            'option3' => 'UPS',
                            'option4' => 'OTHER',
                             ); 
		return element($status, $status_array);
	}
}

if ( ! function_exists('list_duration')) {	
	function list_duration($status='') {
		$status_array = array(
                            '1' => '1',
                            '2' => '3',
                            '3' => '5',
                            '4' => '7',
                            '5' => '10',
                            '6' => '14',
                             ); 
		return $status_array;
	}
}

if ( ! function_exists('list_duration_class')) {	
	function list_duration_class($status='') {
		$status_array = array(
                                '1' => '1',
	                            '2' => '3',
	                            '3' => '5',
	                            '4' => '7',
	                            '5' => '10',
	                            '6' => '14',
                             ); 
		return element($status, $status_array);
	}
}

if ( ! function_exists('condition')) {	
	function condition($status='') {
		$status_array = array(
                            '1' => 'New',
                            '2' => 'Used',
                            '3' => 'Refurbished',
                            ); 
		return $status_array;
	}
}

if ( ! function_exists('condition_class')) {	
	function condition_class($status='') {
		$status_array = array(
                                '1' => 'New',
	                            '2' => 'Used',
	                            '3' => 'Refurbished',
	                            ); 
		return element($status, $status_array);
	}
}

if ( ! function_exists('spec')) {	
	function spec($status='') {
		$status_array = array(
                            '1' => 'EU',
                            '2' => 'UK',
                            '3' => 'US',
                            '4'	=> 'ASIA'
                            ); 
		return $status_array;
	}
}

if ( ! function_exists('spec_class')) {	
	function spec_class($status='') {
		$status_array = array(
                                '1' => 'EU',
	                            '2' => 'UK',
	                            '3' => 'US',
	                            '4'	=> 'ASIA'
	                            ); 
		return element($status, $status_array);
	}
}

if ( ! function_exists('currency')) {	
	function currency($status='') {
		$status_array = array(
                            '1' => '&pound; GBP',
                            '2' => '&euro; EUR',
                            '3' => '$ USD',
                            ); 
		return $status_array;
	}
}

if ( ! function_exists('currency_class')) {	
	function currency_class($status='') {
		$status_array = array(
                            '1' => 'GBP',
                            '2' => 'EUR',
                            '3' => 'USD',
                            ); 
		return element($status, $status_array);
	}
}


if(! function_exists('get_currency')){
    function get_currency($from_Currency, $to_Currency, $amount) {
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, "http://jsonrates.com/convert/?from=".$from_Currency."&to=".$to_Currency."&amount=".$amount."&apiKey=jr-199aebc4591596e450c50d07d0917a87");
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);			
			$content = curl_exec($curl);			
			curl_close($curl); 
			$json = json_decode($content);
			if(!empty($json->amount)){
			 $cur_amount = (float) $json->amount;
			 return round($cur_amount,2);
			}else{
			 return 0;	
			}
		}
}

if(!function_exists('offer_count')){
    function offer_count($list_id=0)
	{
		$CI =& get_instance();
		$CI->load->model('marketplace_model');
		return $CI->marketplace_model->count_offer($list_id);
	}
}