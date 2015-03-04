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
		$this->db->where("schedule_date_time <= '".date('Y-m-d h:i:s')."' and `listing_end_datetime` >= '".date('Y-m-d h:i:s')."'" );
		$this->db->from('listing');
		$this->db->where('status', 1);
		$this->db->where('listing_type', 1);
		$this->db->where('member_id != '.$member_id);
		if($offset>=0 && $per_page>0){
			$this->db->limit($per_page,$offset);
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			return $this->db->count_all_results();
		}
	}

	public function listing_sell($offset='', $per_page=''){
		$member_id=$this->session->userdata('members_id');
		$this->db->where("schedule_date_time <= '".date('Y-m-d h:i:s')."' and `listing_end_datetime` >= '".date('Y-m-d h:i:s')."'" );
		$this->db->from('listing');
		$this->db->where('status', 1);
		$this->db->where('listing_type', 2);
		$this->db->where('member_id != '.$member_id);
		if($offset>=0 && $per_page>0){
			$this->db->limit($per_page,$offset);
			$query = $this->db->get();
			if($query->num_rows()>0)
				return $query->result();
			else
				return FALSE;
		}else{
			return $this->db->count_all_results();
		}
	}
}

