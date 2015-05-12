<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Addressbook_model extends MY_Model {

    function __construct()
    {		
        parent::__construct();
        $this->table = 'addressbook';

    }

    function get_addressbook()
    {
    	$addressbook = false;

    	$query = $this->db->get_where('addressbook', array('member_id' => $this->session->userdata('members_id')));

		if ($query->num_rows() > 0)
		{
			$addressbook = $query->row();
		}

    	return $addressbook;
    }
}

