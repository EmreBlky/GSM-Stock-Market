<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salesforces extends MX_Controller 
{
    function __construct()
    {
        parent::__construct();
//        if ( ! $this->session->userdata('logged_in'))
//        { 
//            redirect('login');
//        }
        $this->load->model('tradereference/tradereference_model', 'tradereference_model');
    }

    function index()
    {
        $traderef = $this->tradereference_model->get_where_multiples('salesforce', 'no');
        
        echo '<pre>';
        print_r($traderef);
        exit;
        
        $this->load->library('salesforce');
        
        foreach ($traderef as $ref){
            
            $field1 = array (
                        'FirstName' => 'OLADIPO',
                        'LastName' => 'GEORGEESE',
                        'company' => 'iMarvel Design Solution LTD',
                        'Phone' => '510-555-5555',
                      );

            $sObject1 = new SObject();
            $sObject1->fields = $field1;
            $sObject1->type = 'Lead';

            $field2 = array (
                            'FirstName' => 'OLADIPO',
                            'LastName' => 'GEORGEESE',
                            'company' => 'iMarvel Design Solution LTD',
                            'Phone' => '510-555-5555',
                          );

            $sObject2 = new SObject();
            $sObject2->fields = $field2;
            $sObject2->type = 'Lead';

            $createResponse = $this->salesforce->create(array($sObject1, $sObject2));
            
        }
        
        //echo '<pre>';
        //print_r($createResponse);
    } 
}