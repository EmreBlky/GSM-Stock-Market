<?php
class Home extends MX_Controller 
{

	function __construct()
	{
		
		parent::__construct();
                if ( ! $this->session->userdata('logged_in'))
                { 
                    redirect('login');
                }
                //$this->load->helper('security');
	
	}
	
	function index()
	{
            
            $data['page'] = 'index';

            $this->load->module('templates');
            $this->templates->home($data);
		
	}
        
        
        
        function confirmation($var = NULL)
	{
            
            $data['page'] = 'cofirm';

            $this->load->module('templates');
            $this->templates->home($data);
		
	}
        
        
        
        
	
	/*function get_where($id)
	{
		
		$this->load->model('pages_model');
		$query = $this->pages_model->get_where($id);
		
		return $query;
	}
	
	function get_where_multiple($col, $value)
	{
		
		$this->load->model('pages_model');
		$query = $this->pages_model->get_where_multiple($col, $value);
		
		return $query;
	}
	
	function insert_data()
	{
		$data = array(
					'name' => 'Video Games',
					'parent_id' => '3',
					);
		$this->_insert($data);
	}
	
	function update_data()
	{
		$data = array(
					'name' => 'Electronic',
					'parent_id' => '1',
					);
		$this->_update('1', $data);
	}
	
	function delete_data()
	{
		
		$this->_delete(4);
	}
	
	function get_all()
	{
		
		$this->load->model('home_model', 'home');
		$query = $this->home->get_all();
		
		return $query;
	
	}
	
	function get($order_by)
	{
		
		$this->load->model('home_model', 'home');
		$query = $this->home->get($order_by);
		
		return $query;
	
	}
	
	function get_with_limit($limit, $offset, $order_by) 
	{
		
		$this->load->model('home_model', 'home');
		$query = $this->home->get_with_limit($limit, $offset, $order_by);
		
		return $query;
	}
	
	function get_where($id)
	{
		
		$this->load->model('home_model', 'home');
		$query = $this->home->get_where($id);
		
		return $query;
	}
	
	function get_where_custom($col, $value) 
	{
		
		$this->load->model('home_model', 'home');
		$query = $this->home->get_where_custom($col, $value);
		
		return $query;
	}
	
	function _insert($data)
	{
		
		$this->load->model('home_model', 'home');
		$this->home->_insert($data);
		
	}
	
	function _update($id, $data)
	{
		
		$this->load->model('home_model', 'home');
		$this->home->_update($id, $data);
		
	}
	
	function _delete($id)
	{
		
		$this->load->model('home_model', 'home');
		$this->home->_delete($id);
		
	}
	
	function count_where($column, $value) 
	{
		
		$this->load->model('home_model', 'home');
		$count = $this->home->count_where($column, $value);
		
		return $count;
	}
	
	function get_max() 
	{
		
		$this->load->model('home_model', 'home');
		$max_id = $this->home->get_max();
		
		return $max_id;
	}
	
	function _custom_query($mysql_query)
	{
		
		$this->load->model('home_model', 'home');
		$query = $this->home->_custom_query($mysql_query);
		
		return $query;
	}*/

}