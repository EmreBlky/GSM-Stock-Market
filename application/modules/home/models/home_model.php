<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home_model extends MY_Model {

    public $durationArray = [
        'Monthly' => 30,
        'Quarterly' => 90,
        'Semi-Annually' => 180,
        'Annual' => 365,
        'Lifetime' => '',
    ];

    function __construct()
    {
		parent::__construct();
		$this->table = 'pages';
	
	}

    public function selectedDuration()
    {
        if( isset( $_GET['duration'] ) && array_key_exists( $_GET['duration'], $this->durationArray ) )
            return $_GET['duration'];
        return 'Monthly';
    }

    /**
     * @param $duration
     * @param null $endTimeStamp
     * @return bool
     */
    public function recentSalesTransactions( $duration, $endTimeStamp = null ){
        if(!$endTimeStamp) $endTimeStamp = time();
        if( !array_key_exists($duration,$this->durationArray) || empty($this->durationArray[$duration]) )
            return $this->total_sales_transaction(); // invalid duration string or it is equal to Lifetime
        $seconds = $this->durationArray[$duration] * 24 * 60 * 60;
        $startTimeStamp = $endTimeStamp - $seconds;
        $startDate = date("Y-m-d H:i:s", $startTimeStamp); //format: 2015-05-09 08:52:01
        $endDate = date("Y-m-d H:i:s", $endTimeStamp); //format: 2015-05-09 08:52:01
        //echo "startDate: $startDate<br>";
        //echo "endDate: $endDate<br>";
        return $this->total_sales_transaction($startDate,$endDate);
    }

	public function total_sales_transaction( $startDateTime = null, $endDateTime = null )
	{
		 $member_id=$this->session->userdata('members_id');
		// $this->db->select_sum('make_offer.total_price');
		 $this->db->select('make_offer.total_price,make_offer.buyer_currency');
		 $this->db->where('make_offer.seller_history','1');
		 $this->db->where('make_offer.offer_status',1);
		 $this->db->where('make_offer.seller_id',$member_id);
        $startDateTime and $this->db->where("payment_recevied_datetime >= '{$startDateTime}'");
        $endDateTime and $this->db->where("payment_recevied_datetime < '{$endDateTime}'");
         $query = $this->db->get('make_offer');
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
	}
     
   public function total_purchase_transaction()
	{
		$member_id=$this->session->userdata('members_id');
		//$this->db->select_sum('make_offer.total_price');
		$this->db->select('make_offer.total_price,make_offer.buyer_currency');
		$this->db->where('make_offer.offer_status',1);
		$this->db->where('make_offer.buyer_history','1');
		$this->db->where('make_offer.buyer_id',$member_id);
		$query = $this->db->get('make_offer');
			if($query->num_rows()>0)
				return $query->result();
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
