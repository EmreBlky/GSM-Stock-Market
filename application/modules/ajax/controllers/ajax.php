<?php
class Ajax extends CI_Controller 
{
    function create_mobicode_account()
    {
    	$this->load->model('imei/imei_model', 'imei');
    	$create_mobicode_account = $this->imei->create_mobicode_account();

    	echo json_encode(array('account_created' => $create_mobicode_account));
    }

    function lookup_imei($imei)
    {
     	$this->load->model('imei/imei_model', 'imei');

     	$imei_code = $this->imei->lookup_imei($imei);   

        echo json_encode(array('imei_code' => $imei_code));
    }

    function get_current_balance()
    {
        $this->load->model('imei/imei_model', 'imei');

        $current_balance = $this->imei->get_current_balance();  

        echo json_encode(array('current_balance' => $current_balance));
    }
}