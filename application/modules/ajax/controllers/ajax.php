<?php
class Ajax extends CI_Controller 
{
    function lookup_imei($imei)
    {
     	$this->load->model('imei/imei_model', 'imei');

     	$imei_code = $this->imei->lookup_imei($imei);   

        echo json_encode(array('imei_code' => $imei_code));
    }
}