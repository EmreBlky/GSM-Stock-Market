<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller 
{
function __construct(){
	parent::__construct();
	if ( ! $this->session->userdata('logged_in')){ 
		redirect('login');
	}
	if ($this->session->userdata('terms') == 'no'){ 
		redirect('legal/terms_conditions');
	}
	$this->load->model('marketplace_model'); 
	
}

function index(){}

function getregions(){
	$cont = $this->input->post('cont');
	$result = $this->marketplace_model->get_regions($cont);
	
	$data ='<option value="">All Regions</option>';
	foreach ($result as $val) { 
		$data.='<option value="'.$val->region.'">'.$val->region.'</option>';
	}
	echo $data;
}

function getcountries(){
	$regn = $this->input->post('regn');
	$result = $this->marketplace_model->get_countries($regn);
	
	$data ='<option value="">All Countries</option>';
	foreach ($result as $val) { 
		$data.='<option value="'.$val->id.'">'.$val->country.'</option>';
	}
	echo $data;
}

}