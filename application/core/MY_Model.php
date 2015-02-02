<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class MY_Model extends CI_Model {
	
	public $table;
	

	function __construct()
	{
		
		parent::__construct();
	
	}
	
	function get_all()
	{
		$data = '';
		
		$table = $this->table;
		$query = $this->db->get($table);
			if($query->num_rows() > 0){
				
					foreach ($query->result() as $row)
						 {
							 $data[] = $row;
						 }
					
			}
		
		return $data;
	}
	
	function get($order_by)
	{
		
		$table = $this->table;
		$this->db->order_by($order_by);
		$query=$this->db->get($table);
		
		return $query;
	
	}
	
	function get_with_limit($limit, $offset, $order_by) 
	{
		
		$table = $this->table;
		$this->db->limit($limit, $offset);
		$this->db->order_by($order_by);
		$query=$this->db->get($table);
		
		return $query;
	
	}
	
	function get_where($id)
	{
		
		$table = $this->table;
		$this->db->where('id', $id);
		$query=$this->db->get($table);
		
		if($query->num_rows() > 0){
				
					foreach ($query->result() as $row)
						 {
							 $data = $row;
						 }
					
			}
		
		return $data;
		
	
	}
	
	function get_where_multiple($chose, $value, $chose2 = NULL, $value2 = NULL, $limit = NULL, $offset = NULL)
	{
		$data = '';
		
		$table = $this->table;
		$this->db->where($chose, $value);
		if($chose2 == NULL){
		}else{
		$this->db->where($chose2, $value2);
		}
		$query=$this->db->get($table, $limit, $offset);
		
		if($query->num_rows() > 0){
				
			foreach ($query->result() as $row)
		   {
			   $data = $row;
		   }
				
		}		
		
		return $data;
	
	}
	
	function get_where_multiples($chose, $value, $chose2 = NULL, $value2 = NULL, $limit = NULL, $offset = NULL)
	{
		$data = '';
		
		$table = $this->table;
		$this->db->where($chose, $value);
		if($chose2 == NULL){
		}else{
		$this->db->where($chose2, $value2);
		}
		$query=$this->db->get($table, $limit, $offset);
		
		if($query->num_rows() > 0){
				
			foreach ($query->result() as $row)
		   {
			   $data[] = $row;
		   }
				
		}		
		
		return $data;
	
	}
        
        function get_where_multiples_order($order_by, $order, $chose, $value, $chose2 = NULL, $value2 = NULL, $chose3 = NULL, $value3 = NULL, $chose4 = NULL, $value4 = NULL, $limit = NULL, $offset = NULL)
	{
		//$data = '';
		
		$table = $this->table;
		$this->db->where($chose, $value);
		if($chose2 != NULL){
		$this->db->where($chose2, $value2);
		}
                if($chose3 != NULL){
		$this->db->where($chose3, $value3);
		}
                if($chose4 != NULL){
		$this->db->where($chose4, $value4);
		}
                $this->db->order_by($order_by, $order);
		$query = $this->db->get($table, $limit, $offset);
                
		if($query->num_rows() > 0){
				
                    foreach ($query->result() as $row)
                    {
                            $data[] = $row;
                    }
				
		}		
		
		return $data;
	
	}
	
	function get_where_custom($col, $value) 
	{
		
		$table = $this->table;
		$this->db->where($col, $value);
		$query=$this->db->get($table);
		
		return $query;
	
	}
	
	function _insert($data)
	{
		
		$table = $this->table;
		$this->db->insert($table, $data);
                
        return $this->db->insert_id();
	
	}
		
	function _update($id, $data)
	{
		
		$table = $this->table;
		$this->db->where('id', $id);
		$this->db->update($table, $data);
	
	}
	
	function _update_where($type, $value, $data)
	{
		
		$table = $this->table;
		$this->db->where($type, $value);
		$this->db->update($table, $data);
	
	}
	
	function _delete($id)
	{
		
		$table = $this->table;
		$this->db->where('id', $id);
		$this->db->delete($table);
	
	}
	
	function _delete_where($chose, $value)
	{
		
		$table = $this->table;
		$this->db->where($chose, $value);
		$this->db->delete($table);
	
	}
	
	function count_where($column, $value, $column2 = NULL, $value2 = NULL, $column3 = NULL, $value3 = NULL, $column4 = NULL, $value4 = NULL, $limit = NULL, $offset = NULL) 
	{
		
		$table = $this->table;
		$this->db->where($column, $value);
                if($column2 != NULL){
		$this->db->where($column2, $value2);
		}
                if($column3 != NULL){
		$this->db->where($column3, $value3);
		}
                if($column4 != NULL){
		$this->db->where($column4, $value4);
		}
		$query=$this->db->get($table, $limit, $offset);
		$num_rows = $query->num_rows();
		
		return $num_rows;
	
	}
        
        function count_where_multiple($column, $value, $column2 = NULL, $value2 = NULL,  $column3 = NULL, $value3 = NULL, $column4 = NULL, $value4 = NULL) 
	{
		
		$table = $this->table;
		$this->db->where($column, $value);
                if($column2 != NULL){
		$this->db->where($column2, $value2);
		}
                if($column3 != NULL){
		$this->db->where($column3, $value3);
		}
                if($column4 != NULL){
		$this->db->where($column4, $value4);
		}
		$query=$this->db->get($table);
		$num_rows = $query->num_rows();
		
		return $num_rows;
	
	}
	
	function count_all() 
	{
		
		$table = $this->table;
		$query=$this->db->get($table);
		$num_rows = $query->num_rows();
		
		return $num_rows;
	
	}
	
	function get_max() 
	{
		
		$table = $this->table;
		$this->db->select_max('id');
		$query = $this->db->get($table);
		$row=$query->row();
		$id=$row->id;
		
		return $id;
	
	}
	
	function _custom_query($mysql_query) 
	{		
            $query = $this->db->query($mysql_query);
        
            if($query->num_rows() > 0){

                    foreach ($query->result() as $row)
               {
                       $data[] = $row;
               }

            }		

            return $data;
	
	}
        
        function canLogIn()
        {

            $id = '';
            $table = $this->table;

            $query = $this->db->query("SELECT * FROM $table WHERE (username = '".$this->input->post('username')."' AND password = '".md5($this->input->post('password'))."') OR (email = '".$this->input->post('username')."' AND password = '".md5($this->input->post('password'))."')");

            foreach ($query->result() as $row)
            {
                $id = $row->id;
            }

            return $id;
        }
        function truncate()
        {
            $table = $this->table;
            $this->db->truncate($table);
        }

}