<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Imei_model extends MY_Model {

	function __construct()
	{		
		parent::__construct();
		$this->table = 'hpi_checks';
		$this->load->model('mobicode/mobicode_model', 'MobiCode');
		$this->load->model('addressbook/addressbook_model', 'Addressbook');
		$this->load->model('company/company_model', 'Company');
	}

	# Might move the location of this function...
	function create_mobicode_account()
	{
		$company = $this->Company->get_company();

		$required_fields = array(
			# MobiCode gave the reg_set value 
			'reg_set' => '9',
			'name' => $company->firstname . ' ' . $company->lastname,
			'name_first' => $company->firstname,
			'name_last' => $company->lastname,
			'company' => $company->company_name,
			'street1' => $company->address_line_1,
			'street2' => $company->address_line_2,
			'city' => $company->town_city,
			'state' => $company->county,
			'zip' => $company->post_code,
			'country' => $company->country,
			'email' => $company->email,
			'phone' => $company->phone_number,
			'mobile' => $company->mobile_number,
		);

		$xml_string = $this->MobiCode->CallAPI('addAccount', $required_fields);

		$xml = simplexml_load_string($xml_string);

		var_dump($xml);
		if (isset($xml->Success))
		{
			if ((string)$xml->Success === 'OK')
			{
				$data = array(
				   	'account_id' => (string)$xml->Account->id,
				   	'member_id' => $this->session->userdata('members_id'),
				   	'api_key' => (string)$xml->Account->apikey,
				   	'otp' => '',
				   	'credit' => 0.00,
			   	);

				$this->db->insert('imei_accounts', $data);	
				$account_created = true;		
			}
			else
			{
				$account_created = false;
			}
		}
		else
		{
			$account_created = false;
		}
		
		return $account_created;
	}

	public static function get_hpi_checks()
	{
		$CI = get_instance();
		$hpi_checks = $CI->imei_model->get_where_custom('member_id', $CI->session->userdata('members_id'));

		$hpi_check_data = false;

		foreach($hpi_checks->result() as $data)
		{
			$hpi_check_data[] = $data;
		}
		
		return $hpi_check_data;
	}

	function get_imei_account()
	{
		$query = $this->db->get_where('imei_accounts', array('member_id' => $this->session->userdata('members_id')));

		if ($query->num_rows() > 0)
		{
			$imei_account = $query->row();
		}
		else
		{
			$imei_account = false;
		}

		return $imei_account;
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
			$xml_string = $CI->MobiCode->CallAPI('PlaceOrder', array('Tool' => '1-62', 'IMEI' => $imei));

			$xml = simplexml_load_string($xml_string);

			if ((string)$xml->Status == 'Solved')
			{
				//success
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
			else if ((string)$xml->Error_no == '1012')
			{
				// insufficient funds
				$imei_lookup = false;
			}
		}
		else
		{
			$imei_lookup = false;
		}

		return $imei_lookup;
	}
}

