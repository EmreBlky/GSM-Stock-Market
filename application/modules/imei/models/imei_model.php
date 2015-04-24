<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Imei_model extends MY_Model {

	function __construct()
	{		
		parent::__construct();
		$this->table = 'Change_this';
		$this->load->model('mobicode/mobicode_model', 'MobiCode');
	}

	public static function lookup_imei($imei)
	{
		$CI = get_instance();

		$imei_lookup = $CI->MobiCode->CheckIMEI($imei);

		if ($imei_lookup !== false)
		{
			$imei_lookup = 'good code';
		}
		else
		{
			$imei_lookup = 'bad code';
		}

		return $imei_lookup;
	}
}

