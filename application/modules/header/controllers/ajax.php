<?php
class Ajax extends MX_Controller 
{
	function __construct(){	
		parent::__construct();
		$this->load->module('marketplace');
	}

	function offer(){ echo all_offer(); }
	function watch_listing(){ echo count_watch_listing();	}
	function open_order(){ echo count_open_order(); }
	function my_listing(){ echo countmy_listing(); }
	function save_listing(){ echo count_save_listing(); }
}