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

    private function isValidDurationStr($durationStr)
    {
        return array_key_exists( $durationStr, $this->durationArray );
    }

    public function selectedDuration()
    {
        if( isset( $_GET['duration'] ) && array_key_exists( $_GET['duration'], $this->durationArray ) )
            return $_GET['duration'];
        return 'Monthly';
    }

    public function getNumOfDays($durationString){
        if(array_key_exists($durationString, $this->durationArray))
            return $this->durationArray[$durationString];
        return null;
    }

    public function getTotal( $transactions, $current_currency_no, $current_currency_sign )
    {
        $total_price = 0;
        if(!empty($transactions)){
            foreach ( $transactions as $value ) {
                if($value->buyer_currency != $current_currency_no){
                    $price = get_currency(currency_class($value->buyer_currency), $current_currency_sign, $value->total_price);
                    $total_price+= $price;
                }else{
                    $total_price+= $value->total_price;
                }
            }
        }
        return $total_price;
    }

    /**
     * @param $duration: array_keys() of $this->durationArray
     * @param null $endTimeStamp
     * @param string $type = sales | purchase
     * @return bool
     * e.g. if $duration = "Monthly" and $endTimeStamp = time()
     * it will return transactions from a month before today till today i.e. this month's transaction
     */
    public function getTransactions( $type, $duration, $endTimeStamp = null ){
        if(!$endTimeStamp) $endTimeStamp = time();
        if( !array_key_exists($duration,$this->durationArray) || empty($this->durationArray[$duration]) )
            // invalid duration string or it is equal to Lifetime
            return call_user_func_array( [ $this, 'total_'.$type.'_transaction' ], []);

        $seconds = $this->durationArray[$duration] * 24 * 60 * 60;
        $startTimeStamp = $endTimeStamp - $seconds;
        $startDate = date("Y-m-d H:i:s", $startTimeStamp); //format: 2015-05-09 08:52:01
        $endDate = date("Y-m-d H:i:s", $endTimeStamp); //format: 2015-05-09 08:52:01
        //echo "startDate: $startDate<br>";
        //echo "endDate: $endDate<br>";
        return call_user_func_array( [ $this, 'total_'.$type.'_transaction' ], [ $startDate, $endDate ]);
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
     
   public function total_purchase_transaction( $startDateTime = null, $endDateTime = null )
	{
		$member_id=$this->session->userdata('members_id');
		//$this->db->select_sum('make_offer.total_price');
		$this->db->select('make_offer.total_price,make_offer.buyer_currency');
		$this->db->where('make_offer.offer_status',1);
		$this->db->where('make_offer.buyer_history','1');
		$this->db->where('make_offer.buyer_id',$member_id);
        $startDateTime and $this->db->where("payment_recevied_datetime >= '{$startDateTime}'");
        $endDateTime and $this->db->where("payment_recevied_datetime < '{$endDateTime}'");
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

    public function recentProfileViews( $durationString )
    {
        if( $this->isValidDurationStr($durationString) )
        {
            $startTimeStamp = strtotime('-'.$this->getNumOfDays($durationString).' days');
            return $this->profileViews($startTimeStamp);
        }
        return $this->profileViews();

    }

    public function profileViews( $startTimeStamp = 0, $endTimeStamp = null )
    {
        // if no $startTimeStamp is provided, it will be the very beginning of epoch time
        $start_date = date('Y-m-d H:i:s', $startTimeStamp);
        // if no $endTimeStamp is provided, current time will be used
        if( !$endTimeStamp ) $endTimeStamp = time();
        $end_date = date( 'Y-m-d H:i:s', $endTimeStamp );

        $this->load->module('viewed');
        $count = $this->viewed_model->_custom_query_count("SELECT COUNT(*) AS viewed FROM viewed WHERE viewed_id = '".$this->session->userdata('members_id')."' AND record_date BETWEEN '".$start_date."' AND '".$end_date."'");

        if($count[0]->viewed > 0){
            return  '
              <div class="ibox-content" style="min-height:89px">
                <h1 class="no-margins">'.$count[0]->viewed.'</h1>
                <!-- <div class="stat-percent font-bold">0%
                <i class="fa fa-level-up"></i>
                </div> -->
                <small>New visits</small>
              </div>';
        }
        else{
            return
            '<div class="ibox-content" style="min-height:89px">
                    <h1 class="no-margins">0</h1>
                    <div class="stat-percent font-bold">
                    <!-- <i class="fa fa-level-up"></i> -->
                    </div>
                    <small>&nbsp;</small>
                </div>';
        }
    }

    public function getNumOrdersForDuration( $memberType, $durationStr, $endTimeStamp = null )
    {
        return $this->callFuncForDuration("getNumOrders", $memberType, $durationStr, $endTimeStamp );
    }

    private function callFuncForDuration( $func, $memberType, $durationStr, $endTimeStamp = null )
    {
        if( $this->isValidDurationStr($durationStr) && $days = $this->durationArray[$durationStr] )
        {
            if(!$endTimeStamp ) $endTimeStamp = time();
            $startTimeStamp = $endTimeStamp - $days * 24 * 60 * 60;
            return call_user_func_array( [ $this, $func ], [ $memberType,$startTimeStamp,$endTimeStamp ]);
        }
        // if it is not a valid duration string or if it is 'Lifetime':
        return call_user_func_array( [ $this, $func ], [ $memberType ]);
    }

    public function getOrdersPerDayForDuration( $memberType, $durationStr, $endTimeStamp = null )
    {
        return $this->callFuncForDuration("getOrdersPerDay", $memberType, $durationStr, $endTimeStamp );
    }

    public function getNumOrders( $memberType, $startTimeStamp = 0, $endTimeStamp = null ){
        if( !in_array( $memberType, ['seller','buyer'] ) ) return 0;

        $startDateTime = date("Y-m-d H:i:s", $startTimeStamp);
        if(!$endTimeStamp ) $endTimeStamp = time();
        $endDateTime = date("Y-m-d H:i:s", $endTimeStamp);

        $member_id=$this->session->userdata('members_id');

        $this->db->select('COUNT(*) as orders');
        $this->db->where("make_offer.{$memberType}_history","1");
        $this->db->where("make_offer.offer_status",1);
        $this->db->where("make_offer.{$memberType}_id",$member_id);
        $startDateTime and $this->db->where("payment_recevied_datetime >= '{$startDateTime}'");
        $endDateTime and $this->db->where("payment_recevied_datetime < '{$endDateTime}'");
        $query = $this->db->get('make_offer');
        if( $query->num_rows() > 0 ) {
            $result = $query->result();
            return $result[0]->orders;
        }
        return FALSE;
    }

    public function getOrdersPerDay( $memberType, $startTimeStamp = 0, $endTimeStamp = null )
    {
        if( !in_array( $memberType, ['seller','buyer'] ) ) return 0;

        $startDateTime = date("Y-m-d H:i:s", $startTimeStamp);
        if(!$endTimeStamp ) $endTimeStamp = time();
        $endDateTime = date("Y-m-d H:i:s", $endTimeStamp);

        $member_id=$this->session->userdata('members_id');

        /*
        SELECT
        COUNT(*) as orders,
        UNIX_TIMESTAMP(date(`payment_recevied_datetime`)) as time
        FROM (`make_offer`)
        WHERE `make_offer`.`seller_history` = '1'
        AND `make_offer`.`offer_status` = 1
        AND `make_offer`.`seller_id` = '167'
        ...
        ...
        GROUP BY `payment_recevied_datetime`
        ORDER BY `payment_recevied_datetime`
        */
        $this->db->select("COUNT(*) as orders, UNIX_TIMESTAMP(date(`payment_recevied_datetime`)) as time");
        $this->db->where("make_offer.{$memberType}_history","1");
        $this->db->where("make_offer.offer_status",1);
        $this->db->where("make_offer.{$memberType}_id",$member_id);
        $startDateTime and $this->db->where("payment_recevied_datetime >= '{$startDateTime}'");
        $endDateTime and $this->db->where("payment_recevied_datetime < '{$endDateTime}'");
        $this->db->group_by("payment_recevied_datetime");
        $this->db->order_by("payment_recevied_datetime");
        $query = $this->db->get('make_offer');
        if( $query->num_rows() > 0 ) {
            return $query->result();
        }
        return FALSE;
    }
}
