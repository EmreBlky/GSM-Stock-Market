<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends MX_Controller 
{
    function _construct()
    {
        $this->load->model('imei');
    }

    function lookup_imei($imei)
    {
        $imei_lookup = $this->imei->lookup_imei($imei);

        return $imei_lookup;
    }
  }