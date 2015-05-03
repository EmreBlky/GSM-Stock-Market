<?php
class Ajax extends MX_Controller 
{
	function __construct(){	
		parent::__construct();
		$this->load->module('marketplace');
	}

	function watch_listing(){ 
		if(count_watch_listing())
			echo '<span class="label label-warning pull-right">'.count_watch_listing().'</span>';	
	}
	
	function offer(){ 
		if(all_offer())
			echo '<span class="label label-info pull-right">'.all_offer().'</span>';	
		}
	
	function open_order(){ 
		if(count_open_order())
			echo '<span class="label label-warning pull-right">'.count_open_order().'</span>';	
	}
	
	function my_listing(){ 
		if(countmy_listing())
			echo '<span class="label label-warning pull-right">'.countmy_listing().'</span>';	
	}
	
	function save_listing(){ 
		if(count_save_listing())
			echo '<span class="label label-success pull-right">'.count_save_listing().'</span>';	
	}

}//EndClass