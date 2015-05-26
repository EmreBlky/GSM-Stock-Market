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

	public function fetch_api_orders()
	{
		$this->db->select('*');
		$this->db->where('member_id', $this->session->userdata('members_id'));
		$this->db->where('api_pulled', 0);
		$this->db->order_by('Bulk_ID', 'desc');
		$query = $this->db->get('bulk_lookup_orders');

		if ($query->num_rows() > 0)
		{
			$imei_account = static::get_imei_account();

			foreach ($query->result() as $row)
			{
				$XML = $this->MobiCode->CallAPI('FetchBulkImeiCheck', array('Bulk_ID' => $row->bulk_id));

				if (is_string($XML)) {
					$data = $this->MobiCode->ParseXML($XML);

					# because the api takes time to run the results so make sure the results are included in the XML before trying to store them
					if (array_key_exists('results', $data))
					{
						foreach ($data['results'] as $result)
						{
							$data = array();
							foreach ($result as $k => $v)
							{
								$data[$k] = $v;
							}

							$data['cert_id'] = '/files/mobiguard/' . $imei_account->account_id .'/' . date('Y') . '/' . date('M') . '/' . $data['cert_id'] . '.pdf';

							$data['member_id'] = $this->session->userdata('members_id');
							$data['created_at'] = date('Y-m-d H:i:s');
							$this->db->insert('bulk_lookup_lines', $data);
						}

						// so the api is only called once for per order
						$update_data = array('api_pulled' => 1);
						$this->db->where('order_id', $data['orderid']);
						$this->db->update('bulk_lookup_orders', $update_data);
					}
				}				
			}
		}
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

	function get_bulk_orders()
	{
		$orders = $this->db->get_where('bulk_lookup_orders', array('member_id' => $this->session->userdata('members_id')));

		$bulk_orders = false;

		foreach($orders->result() as $order)
		{
			$bulk_orders[] = $order;
		}

		return $bulk_orders;	
	}

	function get_current_balance()
	{
		$current_balance = 0;

		$XML = $this->MobiCode->CallAPI('AccountInfo');
		if (is_string($XML)) {
			$data = $this->MobiCode->ParseXML($XML);

			$current_balance = $data['Credits'];
		}

		$update_data = array('credit' => $current_balance);
		$this->db->where('member_id', $this->session->userdata('members_id'));
		$this->db->update('imei_accounts', $update_data);

		return $current_balance;
	}

	function get_order_info($order_id)
	{
		$order_info = false;

		$query = $this->db->get_where('bulk_lookup_lines', array('member_id' => $this->session->userdata('members_id'), 'orderid' => $order_id));

		if ($query->num_rows() > 0)
		{
			foreach($query->result() as $order)
			{
				$order_info[] = $order;
			}
		}

		if ($order_info === false)
		{
			// see if its hpi
			$query = $this->db->get_where('hpi_checks', array('member_id' => $this->session->userdata('members_id'), 'id' => $order_id));

			if ($query->num_rows() > 0)
			{
				foreach($query->result() as $order)
				{
					$order_info[] = $order;
				}
			}			
		}

		return $order_info;
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
			$imei_account = $CI->imei_model->get_imei_account();

			$xml_string = $CI->MobiCode->CallAPI('PlaceOrder', array('Tool' => '1-62', 'IMEI' => $imei));

			$xml = simplexml_load_string($xml_string);

			if ((string)$xml->Status == 'solved')
			{
				$data['cert_id'] = '/files/mobiguard/' . $imei_account->account_id .'/' . date('M') . '/' . (string)$xml->MobiCheck->cert_id . '.pdf';

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
				   'report_path' => (string)$xml->MobiCheck->cert_id,
				   'created_at' => date('Y-m-d H:i:s'),
				);

				$data['cert_id'] = '/files/mobiguard/' . $imei_account->account_id .'/' . date('Y') . '/' . date('M') . '/' . (string)$xml->MobiCheck->cert_id . '.pdf';
				$data['report_path'] = $data['cert_id'];

				$CI->db->insert('hpi_checks', $data);

				$imei_lookup = array('report_path' => $data['cert_id']);
			}
			else if ((string)$xml->Error_no == '1012')
			{
				// insufficient funds
				$imei_lookup = 'Insufficient funds to make this request';
			}
		}
		else
		{
			$imei_lookup['Error'] = 'No Valid IMEIs to lookup';
		}

		return $imei_lookup;
	}

	function lookup_bulk_imei($imeis)
	{
		$imeis = preg_split("/\\r\\n|\\r|\\n/", $imeis);
		$bulk_lookup = array();

		foreach ($imeis as $imei)
		{
			$line = str_getcsv($imei);

			$valid_imei = $this->MobiCode->CheckIMEI($line[0]);

			if ($valid_imei)
			{
				$bulk_lookup[] = array('imei' => $line[0], 'ref' => ltrim($line[1]));
			}
		}

		if (is_array($bulk_lookup) && count($bulk_lookup) > 0)
		{
			$XML = $this->MobiCode->CallAPI('PlaceBulkImeiCheck', array('IMEIs' => $bulk_lookup,
			'BulkRef'=>'10064',
			'Notes' => 'Test Bulk From API'));

			if (is_string($XML)) {
				$data = $this->MobiCode->ParseXML($XML);
			}

			if (isset($data['Error']))
			{
				
			}
			else
			{
				$data = array(
				   'member_id' => $this->session->userdata('members_id'),
				   'order_id' => $data['Order_ID'],
				   'bulk_id' => $data['Bulk_ID'],
				   'checks_submitted' => $data['Checks_Submitted'],
				   'duplicates' => $data['Duplicates'],
				   'rejected' => $data['Rejected'],
				   'created_at' => date('Y-m-d H:i:s'),
				   'reference' => 'Test Bulk from API',
				);

				$this->db->insert('bulk_lookup_orders', $data);
			}			
		}
		else 
		{
			$data['Error'] = 'No Valid IMEIs to lookup';
		}

		return $data;

	}

	function top_up_account()
	{
		$encrypted = false;

		$top_up_amount = $_POST['credit-amount'];

	    $XML = $this->MobiCode->CallAPI('PayPalButton', array('qty'=> $top_up_amount, 'return_url' => current_url()));

	    if (is_string($XML)) 
	    {
	        /* Parse the XML stream */
	        $Data = $this->MobiCode->ParseXML($XML);
	        if (is_array($Data)) {
	            if (isset($Data['Error'])) {
	            }
	            $encrypted = $Data['encrypted']; 
	        }

	    }

	    return $encrypted;
	}
}

