<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Marketplace_model extends MY_Model {

    function __construct()
    {        
        parent::__construct();
        $this->table = 'marketplace';
    }

    public function insert($table_name='',  $data=''){
        $query=$this->db->insert($table_name, $data);
        if($query)
			return $this->db->insert_id();
		else
			return FALSE;		
	}

	public function get_result($table_name='', $id_array='',$columns=array(),$order_by=array(),$limit=''){
		if(!empty($columns)):
			$all_columns = implode(",", $columns);
			$this->db->select($all_columns);
		endif;
		if(!empty($order_by)):			
			$this->db->order_by($order_by[0], $order_by[1]);
		endif; 
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;	
		if(!empty($limit)):	
			$this->db->limit($limit);
		endif;	
		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_result_by_group( $columns=''){
		$this->db->group_by($columns); 
		$this->db->order_by($columns, "asc"); 

		$query=$this->db->get('listing_attributes');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_result_product_type()
	{
		$this->db->select('product_type');
		$this->db->group_by('product_type'); 
		$this->db->order_by('product_type', "asc"); 
		$query=$this->db->get('listing_attributes');
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_couriers_by_group($columns='')
	{
		$this->db->group_by($columns); 
		$this->db->order_by($columns, "asc"); 

		$query=$this->db->get('couriers');
		if($query->num_rows()>0){
		
			return $query->result();
		}else{
			return FALSE;
		}
	}

	public function get_row($table_name='', $id_array='',$columns=array(),$order_by=array()){
		
		if(!empty($columns)):
			$all_columns = implode(",", $columns);
			$this->db->select($all_columns);
		endif; 
		if(!empty($id_array)):		
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;
		if(!empty($order_by)):			
			$this->db->order_by($order_by[0], $order_by[1]);
		endif; 
		$query=$this->db->get($table_name);
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}
	
	public function update($table_name='', $data='', $id_array=''){
		if(!empty($id_array)):
			foreach ($id_array as $key => $value){
				$this->db->where($key, $value);
			}
		endif;
		return $this->db->update($table_name, $data);		
	}

	public function delete($table_name='', $id_array=''){		
	 return $this->db->delete($table_name, $id_array);
	}

    public function listing_buy($offset='', $per_page=''){
    	$member_id=$this->session->userdata('members_id');

		
		$this->db->select('listing.*');
		

		if(!empty($_GET['rating'])){
			//$this->db->or_where("product_mpn",trim($_GET['date']));
		}
		if(!empty($_GET['mpn'])){
			$this->db->where("listing.product_mpn_isbn",trim($_GET['mpn']));
		}
		
		if(!empty($_GET['model'])){
			$this->db->where("listing.product_model",trim($_GET['model']));
		}
		
		if(!empty($_GET['product_type'])){
			$this->db->where("listing.product_type",trim($_GET['product_type']));
		}
		
		if(!empty($_GET['price_range_start']) && !empty($_GET['price_range_end'])){
			$price_range_start = trim($_GET['price_range_start']);
			$price_range_end = trim($_GET['price_range_end']);
			$this->db->where("(listing.unit_price >= $price_range_start AND listing.unit_price <= $price_range_end)");
		}
		

		if(!empty($_GET['start_rating']) && !empty($_GET['end_rating'])){
			$this->db->select('feedback_score as rating');
		  $this->db->join('feedback', 'feedback.member_id=listing.member_id');
			$start_rating = trim($_GET['start_rating']);
			$end_rating = trim($_GET['end_rating']);
			$this->db->where("(feedback.feedback_score >= $start_rating AND feedback.feedback_score <= $end_rating)");
		}
		
		$this->db->select('country.country AS product_country');
		$this->db->join("company", "listing.member_id=company.admin_member_id");
		$this->db->join("country", "country.id=company.country");
			
		if(!empty($_GET['continent'])){
			$this->db->where("country.continent = '".trim($_GET['continent'])."'");
		}
		if(!empty($_GET['region'])){
			$this->db->where("country.region = '".trim($_GET['region'])."'");
		}

		
		if(!empty($_GET['countries'])){
			$this->db->where('company.country = '.trim($_GET['countries']));
		}
		
		
		if(!empty($_GET['date'])){
			$this->db->like("listing.listing_end_datetime",trim($_GET['date']),'after');
		}

		if(!empty($_GET['lc'])){
			$this->db->like('`listing`.product_type', $_GET['lc']);
		}
		
		if(!empty($_GET['currency'])){
			$this->db->like('`listing`.currency', $_GET['currency']);
		}
		
		if(!empty($_GET['condition'])){
			$this->db->like('`listing`.condition', $_GET['condition']);
		}
		if(!empty($_GET['product_color'])){
			$this->db->like('`listing`.product_color', $_GET['product_color']);
		}
		if(!empty($_GET['listing_type_status'])){
			$this->db->like('`listing`.listing_type_status', $_GET['listing_type_status']);
		}

		if( !empty($_GET['query']) ){
			foreach($_GET['query'] as $prod_make ){
				$this->db->where("(`listing`.product_make LIKE '%$prod_make%' OR `listing`.product_model LIKE '%$prod_make%')");
			}
		}

		$this->db->where("listing.schedule_date_time <= '".date('Y-m-d h:i:s')."' and listing.listing_end_datetime >= '".date('Y-m-d h:i:s')."'" );
		
		$this->db->from('listing');
	
		$this->db->where('listing.status', 1);
		$this->db->where('listing.listing_type', 1);
		
		$query = $this->db->get();
		
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
		
	}
	
 public function listing_sell($offset='', $per_page=''){
		$member_id=$this->session->userdata('members_id');

		$this->db->select('listing.*');
		

		if(!empty($_GET['rating'])){
			//$this->db->or_where("product_mpn",trim($_GET['date']));
		}
		if(!empty($_GET['mpn'])){
			$this->db->where("listing.product_mpn_isbn",trim($_GET['mpn']));
		}
		
		if(!empty($_GET['model'])){
			$this->db->where("listing.product_model",trim($_GET['model']));
		}
		
		if(!empty($_GET['product_type'])){
			$this->db->where("listing.product_type",trim($_GET['product_type']));
		}
		
		if(!empty($_GET['price_range_start']) && !empty($_GET['price_range_end'])){
			$price_range_start = trim($_GET['price_range_start']);
			$price_range_end = trim($_GET['price_range_end']);
			$this->db->where("(listing.unit_price >= $price_range_start AND listing.unit_price <= $price_range_end)");
		}
		

		if(!empty($_GET['start_rating']) && !empty($_GET['end_rating'])){
			$this->db->select('feedback_score as rating');
		  $this->db->join('feedback', 'feedback.member_id=listing.member_id');
			$start_rating = trim($_GET['start_rating']);
			$end_rating = trim($_GET['end_rating']);
			$this->db->where("(feedback.feedback_score >= $start_rating AND feedback.feedback_score <= $end_rating)");
		}
		
		$this->db->select('country.country AS product_country');
		$this->db->join("company", "listing.member_id=company.admin_member_id");
		$this->db->join("country", "country.id=company.country");
			
		if(!empty($_GET['continent'])){
			$this->db->where("country.continent = '".trim($_GET['continent'])."'");
		}
		if(!empty($_GET['region'])){
			$this->db->where("country.region = '".trim($_GET['region'])."'");
		}

		
		if(!empty($_GET['countries'])){
			$this->db->where('company.country = '.trim($_GET['countries']));
		}
		
		
		if(!empty($_GET['date'])){
			$this->db->like("listing.listing_end_datetime",trim($_GET['date']),'after');
		}

		if(!empty($_GET['lc'])){
			$this->db->like('`listing`.product_type', $_GET['lc']);
		}
		
		if(!empty($_GET['currency'])){
			$this->db->like('`listing`.currency', $_GET['currency']);
		}
		
		if(!empty($_GET['condition'])){
			$this->db->like('`listing`.condition', $_GET['condition']);
		}
		if(!empty($_GET['product_color'])){
			$this->db->like('`listing`.product_color', $_GET['product_color']);
		}
		if(!empty($_GET['listing_type_status'])){
			$this->db->like('`listing`.listing_type_status', $_GET['listing_type_status']);
		}

		if( !empty($_GET['query']) ){
			foreach($_GET['query'] as $prod_make ){
				$this->db->where("(`listing`.product_make LIKE '%$prod_make%' OR `listing`.product_model LIKE '%$prod_make%')");
			}
		}

		$this->db->where("listing.schedule_date_time <= '".date('Y-m-d h:i:s')."' and listing.listing_end_datetime >= '".date('Y-m-d h:i:s')."'" );
		
		$this->db->from('listing');
	
		$this->db->where('listing.status', 1);
		$this->db->where('listing.listing_type', 2);
		
		$query = $this->db->get();
		
			
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
		
	}


	public function listing_counter_offer(){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('listing.*,company.country  AS country_id,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country');
		$where_condition="(`make_offer`.`seller_id` = ".$member_id." OR `make_offer`.`buyer_id`=".$member_id.")";
		$this->db->where($where_condition);
		$this->db->where("schedule_date_time <= '".date('Y-m-d h:i:s')."' and `listing_end_datetime` >= '".date('Y-m-d h:i:s')."'" );
		$this->db->where('listing.status', 1);
		$this->db->where('listing.listing_type', 2);
		$this->db->from('listing');
		$this->db->join('company','company.admin_member_id=listing.member_id');
		$this->db->join('make_offer','make_offer.listing_id=listing.id');
				$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function listing_offer_common($listing_type='0',$case='1',$status=0){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('listing.*');
		if($case==1){
			$this->db->where('make_offer.seller_id',$member_id);
		}
		else{
			$this->db->where('make_offer.buyer_id',$member_id);
		}
		$this->db->where("listing.schedule_date_time <= '".date('Y-m-d h:i:s')."' and listing.listing_end_datetime >= '".date('Y-m-d h:i:s')."'" );
		if($status=='1'){
			$this->db->where('make_offer.offer_status',0);
		}
		$this->db->where('listing.status', 1);
		$this->db->group_by('make_offer.id');
		$this->db->where('listing.listing_type', $listing_type);
		$this->db->from('listing');
		$this->db->join('make_offer','make_offer.listing_id=listing.id');
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function listing_sell_offer(){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('listing.*,company.country  AS country_id,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country');

		$this->db->from('listing');
		$this->db->join('company','company.admin_member_id=listing.member_id');
		$this->db->group_by('listing.id');
		$this->db->where('status', 1);
		$this->db->where('listing_type', 1);
		$this->db->where('member_id',$member_id);
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function question_asked($listing_id=0){
		 $user_id =  $this->session->userdata('members_id');
		$this->db->select('listing_question.*,members.firstname,,members.lastname');
		$this->db->from('listing_question');
		$this->db->join('members','members.id=listing_question.buyer_id');
		$this->db->where('listing_id', $listing_id);
		$this->db->where('buyer_id', $user_id);
		$this->db->limit(5);
		$this->db->order_by('id', "desc"); 
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}
	
	public function listing_buying_offer(){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('listing.*,company.country  AS country_id,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country');
		$this->db->from('listing');
		$this->db->join('company','company.admin_member_id=listing.member_id');
		$this->db->where('status', 1);
		$this->db->where('listing_type', 2);
		$this->db->where('member_id',$member_id);
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}




	public function get_buyers_offer($list_id=0){
		$member_id = $this->session->userdata('members_id');
		$this->db->select('company.*,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country,make_offer.*');
		$this->db->from('make_offer');
		$this->db->join('company','company.admin_member_id=make_offer.buyer_id');
		$this->db->where('make_offer.listing_id',$list_id);
		$this->db->where('make_offer.seller_id',$member_id);
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function view_offer($list_id=0,$status=0){
		$this->db->select('make_offer.*,company.company_name,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country');
		$this->db->from('make_offer');
		$this->db->group_by('id');
		if($status==2){
			$this->db->where('make_offer.offer_status',0);
		}
		$this->db->join('company','company.id=make_offer.buyer_id');
		$this->db->where('make_offer.listing_id',$list_id);
		//$this->db->where('make_offer.offer_status',0);
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}


	public function get_shippings_to_couriers_data($couriers=array()){
		$this->db->from('couriers');
		if(empty($couriers)) return FALSE;
		$this->db->where_in('id', json_decode($couriers));
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function advance_search($member_id=0,$listing_type=0){

		$this->db->select('listing.product_mpn_isbn,listing.product_make,listing.product_model,listing.product_type,company.country AS country_id,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country');

		$this->db->where("schedule_date_time <= '".date('Y-m-d h:i:s')."' and `listing_end_datetime` >= '".date('Y-m-d h:i:s')."'" );
		$this->db->from('listing');
		$this->db->join('company','company.id=listing.member_id');
		$this->db->where('status', 1);
		$this->db->where('listing_type', $listing_type);
		//$this->db->where('member_id != '.$member_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function get_watch_list($member_id, $listing_type=0){

		$this->db->select('listing.id,listing.listing_end_datetime,listing.product_mpn_isbn,listing.product_make,listing.product_model,listing.product_type,listing.condition,listing.unit_price,listing.total_qty,listing.spec,listing.currency,company.country AS country_id,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country');

		$this->db->where("schedule_date_time <= '".date('Y-m-d h:i:s')."' and `listing_end_datetime` >= '".date('Y-m-d h:i:s')."'" );
		$this->db->from('listing');
		$this->db->join('company','company.id=listing.member_id');
		$this->db->join('listing_watch','listing_watch.listing_id=listing.id');
		$this->db->where('listing.status', 1);
		$this->db->where('listing.listing_type', $listing_type);
		$this->db->where('listing_watch.user_id',$member_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	public function listingdetailv($id){
		$this->db->where('id',$id);
		$this->db->where("schedule_date_time <= '".date('Y-m-d h:i:s')."' and `listing_end_datetime` >= '".date('Y-m-d h:i:s')."'" );
		$this->db->from('listing');
		$this->db->where('listing.status', 1);
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
	}
	public function delete_unwatch($member_id=0)
	{
		$this->db->where('member_id',$member_id);
		$this->db->where('listing_end_datetime <', date('Y-m-d h:i'));
		$this->db->from('listing');
		$query  =$this->db->get();
		if($query->num_rows()>0){
			foreach($query->result() as $row){
					$this->db->query("delete from listing_watch where seller_id=".$row->member_id."");
			}
		}else{
			return FALSE;
		}
	}

	public function count_offer($list_id=0)
	{
		$this->db->from('make_offer');
		$this->db->where('listing_id', $list_id);
		$this->db->where('offer_status', 0);
		return $this->db->count_all_results();
		
	}

	public function sell_order(){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('listing.*,company.company_name,make_offer.id as makeofferid,make_offer.listing_id,make_offer.seller_id,make_offer.buyer_id,make_offer.buyer_currency,make_offer.product_qty,make_offer.unit_price,make_offer.total_price,make_offer.shipping,make_offer.shipping_price,make_offer.offer_status,make_offer.order_status,make_offer.payment_detail,make_offer.payment_done,make_offer.shipping_received,make_offer.tracking_shipping,make_offer.buyer_feedback,make_offer.seller_feedback,make_offer.seller_history,make_offer.buyer_history,make_offer.payment_done_datetime,make_offer.payment_recevied_datetime,make_offer.shipping_arrived_datetime,make_offer.shipping_recevied_datetime,make_offer.buyer_feedback_datetime,make_offer.seller_feedback_datetime,make_offer.created');
		
		$this->db->from('listing');
		$this->db->join('company','company.admin_member_id=listing.member_id');
		$this->db->join('make_offer','make_offer.listing_id=listing.id');
		//$this->db->where('listing.listing_type', 2);
		
		$this->db->where('make_offer.seller_history','');

		$this->db->where('make_offer.offer_status',1);
		$this->db->where('make_offer.seller_id',$member_id);
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function buy_order(){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('listing.*,company.company_name,make_offer.id as makeofferid,make_offer.listing_id,make_offer.seller_id,make_offer.buyer_id,make_offer.buyer_currency,make_offer.product_qty,make_offer.unit_price,make_offer.total_price,make_offer.shipping,make_offer.shipping_price,make_offer.offer_status,make_offer.order_status,make_offer.payment_detail,make_offer.payment_done,make_offer.shipping_received,make_offer.tracking_shipping,make_offer.buyer_feedback,make_offer.seller_feedback,make_offer.seller_history,make_offer.buyer_history,make_offer.payment_done_datetime,make_offer.payment_recevied_datetime,make_offer.shipping_arrived_datetime,make_offer.shipping_recevied_datetime,make_offer.buyer_feedback_datetime,make_offer.seller_feedback_datetime,make_offer.created');
		$this->db->from('listing');
		$this->db->join('company','company.admin_member_id=listing.member_id');
		$this->db->join('make_offer','make_offer.listing_id=listing.id');
		//$this->db->where('listing.listing_type', 1);
		$this->db->where('make_offer.offer_status',1);
		$this->db->where('make_offer.buyer_history','');
		$this->db->where('make_offer.buyer_id',$member_id);
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function offerattempt($list_id=0)
	{
		$member_id=$this->session->userdata('members_id');
		$this->db->select('COUNT(*) as totalrow');
		$this->db->where('listing_id', $list_id);
		$this->db->where('buyer_id', $member_id);
		$startDate = time();
		$yesterday=date('Y-m-d H:i:s', strtotime('-1 day', $startDate));
		$where_condition="(`created` >='$yesterday')";
		$this->db->where($where_condition);
		$query=$this->db->get('offer_attempt');
		if($query->num_rows()>0)
			return $query->row();
		else
			return FALSE;
		
	}

	public function order_history_sell()
	{
		$member_id=$this->session->userdata('members_id');
		$this->db->select('make_offer.*,company.company_name');
		$this->db->from('make_offer');
		$this->db->join('company','company.admin_member_id=make_offer.seller_id');
		//$this->db->where('listing.listing_type', 2);
		
		$this->db->where('make_offer.seller_history','1');

		$this->db->where('make_offer.offer_status',1);
		$this->db->where('make_offer.seller_id',$member_id);
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function order_history_buy()
	{
		$member_id=$this->session->userdata('members_id');
		$this->db->select('make_offer.*,company.company_name');
		$this->db->from('make_offer');
		$this->db->join('company','company.admin_member_id=make_offer.seller_id');
		//$this->db->where('listing.listing_type', 1);
		$this->db->where('make_offer.offer_status',1);
		$this->db->where('make_offer.buyer_history','1');
		$this->db->where('make_offer.buyer_id',$member_id);
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function invoice($invoice_no)
	{
		$member_id=$this->session->userdata('members_id');
		$this->db->select('make_offer.*,listing.product_mpn_isbn,listing.product_make,listing.product_model,listing.product_type,listing.product_color,listing.product_desc');
		$this->db->where('make_offer.invoice_no',$invoice_no);
		$where_condition="(`make_offer`.`seller_id` = ".$member_id." OR `make_offer`.`buyer_id`=".$member_id.")";
		$this->db->where($where_condition);
		$this->db->from('make_offer');
		$this->db->join('listing','listing.id=make_offer.listing_id');
		$query = $this->db->get('');
			if($query->num_rows()>0)
				return $query->row();
			else
				return FALSE;
	}
	public function sell_buy_negotiation(){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('negotiation.*,listing.product_mpn_isbn,listing.product_make,listing.product_model,listing.product_type,listing.product_color,listing.condition,listing.product_desc,listing.listing_end_datetime,listing.currency,listing.qty_available,listing.spec,listing.member_id as listingmemberid');
		//$this->db->where('negotiation.offer_type',1);
		$where_condition="(`negotiation`.`seller_id` = ".$member_id." OR `negotiation`.`buyer_id`=".$member_id.")";
		$this->db->where($where_condition);
		$this->db->from('negotiation');
		$this->db->join('listing','listing.id=negotiation.listing_id');
		$this->db->where('negotiation.status',0);
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}
	
	public function buyer_negotiation(){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('negotiation.*,listing.product_mpn_isbn,listing.product_make,listing.product_model,listing.product_type,listing.product_color,listing.condition,listing.product_desc,listing.listing_end_datetime,listing.currency,listing.qty_available,listing.spec');
		$where_condition="(`negotiation`.`seller_id` = ".$member_id." OR `negotiation`.`buyer_id`=".$member_id.")";
		$this->db->where($where_condition);
		
		$this->db->from('negotiation');
		$this->db->where('negotiation.status',0);
		$this->db->join('listing','listing.id=negotiation.listing_id');
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function view_negotiation_payasking($parent_id=''){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('negotiation.*,company.company_name,listing.product_mpn_isbn,listing.product_make,listing.product_model,listing.product_type,listing.product_color,listing.condition,listing.product_desc,listing.listing_end_datetime,listing.currency,listing.qty_available,listing.spec,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country');
		
		$where_condition="(`negotiation`.`status` != 1)";
		$this->db->where($where_condition);

		$this->db->where('negotiation.offer_id',$parent_id);
		$this->db->from('negotiation');
		$this->db->join('company','company.admin_member_id=negotiation.seller_id');
		$this->db->join('listing','listing.id=negotiation.listing_id');
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function view_negotiation($parent_id=''){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('negotiation.*,company.company_name,listing.product_mpn_isbn,listing.product_make,listing.product_model,listing.product_type,listing.product_color,listing.condition,listing.product_desc,listing.listing_end_datetime,listing.currency,listing.qty_available,listing.spec,(SELECT country FROM country AS ct where ct.id=company.country) AS product_country');
	
		$where_condition="(`negotiation`.`status` != 1)";
		$this->db->where($where_condition);

		$this->db->where('negotiation.offer_id',$parent_id);
		$this->db->from('negotiation');
		$this->db->order_by("id", "desc"); 
		$this->db->limit(1);
		$this->db->join('company','company.admin_member_id=negotiation.seller_id');
		$this->db->join('listing','listing.id=negotiation.listing_id');
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}

	public function count_all_offer()
	{
		$member_id=$this->session->userdata('members_id');
		$query=$this->db->query("SELECT count(id) as totaloffer from make_offer where (seller_id = ".$member_id." or buyer_id=".$member_id.") AND (offer_status=0)" );
		return $query->row()->totaloffer;
	}

	public function count_open_order()
	{
		$member_id=$this->session->userdata('members_id');
		$query=$this->db->query("SELECT count(id) as totalopenorder from make_offer where (seller_id = ".$member_id." or buyer_id=".$member_id.") AND offer_status=1 AND order_status < 5 AND seller_history=0 AND buyer_history=0" );
		return $query->row()->totalopenorder;
	}

	public function countmy_listing()
	{
		$member_id=$this->session->userdata('members_id');
		$query=$this->db->query("SELECT count(id) as totallisting from listing where member_id=".$member_id." AND schedule_date_time <= '".date('Y-m-d h:i:s')."' AND `listing_end_datetime` >= '".date('Y-m-d h:i:s')."'");
		return $query->row()->totallisting;
	}

	
	public function count_watch_listing()
	{
		$member_id=$this->session->userdata('members_id');
		$query=$this->db->query("SELECT count(id) as totalwatching
			from listing_watch where user_id=".$member_id);
		return $query->row()->totalwatching;
	}

	public function count_save_listing()
	{
		$member_id=$this->session->userdata('members_id');
		$query=$this->db->query("SELECT count(id) as totalsavelisting from listing where status=0 and member_id=".$member_id);
		return $query->row()->totalsavelisting;
	}
}