<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Imei_model extends MY_Model {

	function __construct()
	{		
		parent::__construct();
		$this->table = 'hpi_checks';
		$this->load->model('mobicode/mobicode_model', 'MobiCode');
	}

	public static function get_hpi_checks()
	{
		$CI = get_instance();
		$hpi_checks = $CI->imei_model->get_where_custom('member_id', $CI->session->userdata('members_id'));

		foreach($hpi_checks->result() as $data)
		{
			$hpi_check_data[] = $data;
		}
		
		return $hpi_check_data;
	}

	function has_imei_account()
	{
		$query = $this->db->get_where('imei_accounts', array('member_id' => $this->session->userdata('members_id')));

		$imei_account = false;
		if ($query->num_rows() > 0)
		{
			$imei_account = true;
		}

		return $imei_account;
	}

	public static function lookup_imei($imei)
	{
		$CI = get_instance();

		$imei_lookup = $CI->MobiCode->CheckIMEI($imei);

		if ($imei_lookup !== false)
		{
			//$api_callback = $CI->MobiCode->CallAPI('PlaceOrder', array('Tool' => '1-62', 'IMEI' => $imei));
			$xml_string = '<?xml version="1.0" ?>
			<API>
				<Success>Your order has been submitted and your codes are ready</Success>
				<ID>1172111</ID>
				<Codes>ImeiHPI Check Result: passed&lt;br&gt;Cert ID:1019010-A4AFEE86&lt;br&gt;Result Colour: GREEN&lt;br&gt;Manufacturer: Apple&lt;br&gt;Model: iPhone 4 (A1332)</Codes>
				<Status>solved</Status>
				<MobiCheck>
					<cert_id>1019010-A4AFEE86</cert_id>
					<serial>012547007607290</serial>
					<make>Apple</make>
					<model>iPhone 4 (A1332)</model>
					<colour_code>2</colour_code>
					<colour>GREEN</colour>
					<cr_count>0</cr_count>
					<police_lost_property>0</police_lost_property>
					<owner_temp_block>0</owner_temp_block>
					<expired_owner_temp_block>0</expired_owner_temp_block>
					<result>passed</result>
					<recycled_previously>NO</recycled_previously>
				</MobiCheck>
			</API>';

			$xml = simplexml_load_string($xml_string);

			$file_path = 'http://imei.gsmstockmarket.com/files/mobiguard/2103/2015/Apr/'. $xml->MobiCheck->cert_id .'.pdf';

			$data = array(
			   'id' => (string)$xml->ID,
			   'member_id' => $CI->session->userdata('members_id'),
			   'cert_id' => (string)$xml->MobiCheck->cert_id,
			   'serial' => (string)$xml->MobiCheck->serial,
			   'make' => (string)$xml->MobiCheck->make,
			   'model' => (string)$xml->MobiCheck->model,
			   'colour_code' => (string)$xml->MobiCheck->colour_code,
			   'colour' => (string)$xml->MobiCheck->colour,
			   'cr_count' => (string)$xml->MobiCheck->cr_count,
			   'police_lost_property' => (string)$xml->MobiCheck->police_lost_property,
			   'owner_temp_block' => (string)$xml->MobiCheck->owner_temp_block,
			   'expired_owner_temp_block' => (string)$xml->MobiCheck->expired_owner_temp_block,
			   'result' => (string)$xml->MobiCheck->result,
			   'recycled_previously' => (string)$xml->MobiCheck->recycled_previously,
			   'report_path' => $file_path,
			   'created_at' => date('Y-m-d H:i:s'),
			);

			$CI->db->insert('hpi_checks', $data);
		}
		else
		{
			$imei_lookup = false;
		}

		return $imei_lookup;
	}
}

