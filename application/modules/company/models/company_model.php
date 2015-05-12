<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends MY_Model {

    function __construct()
    {		
        parent::__construct();
        $this->table = 'company';
    }

    function get_company()
    {
    	$get_company = false;

    	$query = $this->db->select('*')
		->from('members')
		->join('company', 'members.company_id = company.id')
		->where('members.id', $this->session->userdata('members_id'));

		$query = $this->db->get();

		if ($query->num_rows() > 0)
		{
			$get_company = $query->row();
		}

    	return $get_company;
    }
}

