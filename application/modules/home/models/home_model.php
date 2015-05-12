<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Home_model extends MY_Model {

    function __construct()
	{
		
		parent::__construct();
		$this->table = 'pages';
	
	}

	public function total_sales_transaction()
	{
		 $member_id=$this->session->userdata('members_id');
		 $this->db->select_sum('make_offer.total_price');
		 $this->db->where('make_offer.seller_history','1');
		 $this->db->where('make_offer.offer_status',1);
		 $this->db->where('make_offer.seller_id',$member_id);
         $query = $this->db->get('make_offer');
			if($query->num_rows()>0)
				return $query->row();
			else
				return FALSE;
	}
     

	public function total_purchase_transaction()
	{
		$member_id=$this->session->userdata('members_id');
		$this->db->select_sum('make_offer.total_price');
		$this->db->where('make_offer.offer_status',1);
		$this->db->where('make_offer.buyer_history','1');
		$this->db->where('make_offer.buyer_id',$member_id);
		$query = $this->db->get('make_offer');
			if($query->num_rows()>0)
				return $query->row();
			else
				return FALSE;
	}
  
    public function get_watch_list(){
    	$member_id=$this->session->userdata('members_id');
		$this->db->select('listing.id,listing.product_mpn_isbn,listing.product_make,listing.product_model,listing.unit_price,listing.total_qty,listing.currency,listing.status,listing.schedule_date_time,listing.listing_end_datetime');
		$this->db->where("schedule_date_time <= '".date('Y-m-d h:i:s')."' and `listing_end_datetime` >= '".date('Y-m-d h:i:s')."'" );
		$this->db->from('listing');
		$this->db->join('listing_watch','listing_watch.listing_id=listing.id');
		//$this->db->where('listing.status', 1);
		$this->db->order_by("id", "desc"); 
		$this->db->limit(10);
		//$this->db->where('listing.listing_type', $listing_type);
		$this->db->where('listing_watch.user_id',$member_id);
		$query = $this->db->get();
		if($query->num_rows()>0)
			return $query->result();
		else
			return FALSE;
	}

	// public function selling_offers(){
	// 	$member_id=$this->session->userdata('members_id');
	// 	$this->db->select('listing.*');
	// 	$this->db->from('listing');
	// 	//$this->db->group_by('listing.id');
	// 	//$this->db->where('status', 1);
	// 	$this->db->order_by('listing.id','desc');
	// 	$this->db->limit(10);
	// 	//$this->db->where_or('scheduled_status', 1);
	// 	$this->db->where('listing_type', 1);
	// 	$this->db->where('member_id',$member_id);
	// 	$query = $this->db->get();
	// 		if($query->num_rows()>0)
	// 			return $query->result();
	// 		else
	// 			return FALSE;
	// }
	// public function buying_requests(){
	// 	$member_id=$this->session->userdata('members_id');
	// 	$this->db->select('listing.*');
	// 	$this->db->from('listing');
	// 	//$this->db->where('status', 1);
	// 	$this->db->order_by('listing.id','desc');
	// 	$this->db->limit(10);
	// 	//$this->db->where_or('scheduled_status', 1);
	// 	$this->db->where('listing_type', 2);
	// 	$this->db->where('member_id',$member_id);
	// 	$query = $this->db->get();
	// 		if($query->num_rows()>0)
	// 			return $query->result();
	// 		else
	// 			return FALSE;
	// }

	public function listing_offer_common($case='1'){
		$member_id=$this->session->userdata('members_id');
		$this->db->select('listing.*');
		if($case==1){
			$this->db->where('make_offer.buyer_id',$member_id);
		}
		else{
			$this->db->where('make_offer.seller_id',$member_id);
			
		}
		$this->db->where("listing.schedule_date_time <= '".date('Y-m-d h:i:s')."' and listing.listing_end_datetime >= '".date('Y-m-d h:i:s')."'" );
		$this->db->where('make_offer.offer_status',0);
		
		$this->db->where('listing.status', 1);
		$this->db->group_by('make_offer.id');
		$this->db->group_by('listing.id');
		$this->db->order_by('make_offer.id','desc');
		$this->db->limit(10);
		$this->db->from('listing');
		$this->db->join('make_offer','make_offer.listing_id=listing.id');
		$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}



}




