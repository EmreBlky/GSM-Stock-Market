<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Member_model extends MY_Model {

	function __construct()
	{		
        parent::__construct();
        $this->table = 'members';
	}

    public function getCurrentCurrency_Num_Sign($member_id)
    {
        $member = $this->get_where($member_id);
        $current_currency= '';
        $current_currency_no = '';
        $current_currency_sign= '';
        if(!empty($member->currency) && ($member->currency=='EURO') ){
            $current_currency= '&euro;';
            $current_currency_no = '2';
            $current_currency_sign= 'EURO';

        }elseif (!empty($member->currency) && ($member->currency=='USD')) {
            $current_currency= '$';
            $current_currency_no = '3';
            $current_currency_sign= 'USD';
        }elseif (!empty($member->currency) && ($member->currency=='GBP')) {
            $current_currency= '&pound';
            $current_currency_no = '1';
            $current_currency_sign= 'GBP';
        }
        return [ $current_currency, $current_currency_no, $current_currency_sign ];
    }

}

