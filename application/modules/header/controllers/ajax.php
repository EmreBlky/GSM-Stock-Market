<?php
class Ajax extends MX_Controller 
{
    function __construct(){	
		parent::__construct();
		$this->load->module('marketplace');
	}

	function watch_listing(){ 
		if($a=count_watch_listing())
			echo '<span class="label label-warning pull-right">'.$a.'</span>';	
	}
	
	function offer(){ 
		if($a=all_offer())
			echo '<span class="label label-info pull-right">'.$a.'</span>';	
		}
	
	function open_order(){ 
		if($a=count_open_order())
			echo '<span class="label label-warning pull-right">'.$a.'</span>';	
	}
	
	function my_listing(){ 
		if($a=countmy_listing())
			echo '<span class="label label-warning pull-right">'.$a.'</span>';	
	}
	
	function count_negotiation_ajax(){ 
		if($a=count_negotiation())
			echo '<span class="label label-success pull-right">'.$a.'</span>';	
	}

	function count_order_history(){ 
		if($a=count_order_history())
			echo '<span class="label label-success pull-right">'.$a.'</span>';	
	}

}//EndClass