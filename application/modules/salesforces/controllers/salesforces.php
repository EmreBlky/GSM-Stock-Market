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
        $this->load->library('salesforce');
        $this->load->model('tradereference/tradereference_model', 'tradereference_model');
    }

    function index()
    {
        $traderef = $this->tradereference_model->get_where_multiples('salesforce', 'no');
        
        echo '<pre>';
        print_r($traderef);
        exit;
        
        
        
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
    
    function insertSalesforce($custname1, $email1, $phone1, $company1, $country1, $custname2, $email2, $phone2, $company2, $country2, $trader)
    {
        $name1 = explode(' ', $custname1);
        $name2 = explode(' ', $custname2);
        
        $field1 = array (
                        'FirstName'             => $name1[0],
                        'LastName'              => $name1[1],
                        'company'               => $company1,
                        'Email'                 => $email1,
                        'Phone'                 => $phone1,
                        'Country__c'            => $country1,
                        'lead_source__c'        => 'Reference',
                        'reference_company__c'  => $trader
                      );

            $sObject1 = new SObject();
            $sObject1->fields = $field1;
            $sObject1->type = 'Lead';

            $field2 = array (
                            'FirstName'             => $name2[0],
                            'LastName'              => $name2[1],
                            'company'               => $company2,
                            'Email'                 => $email2,
                            'Phone'                 => $phone2,
                            'Country__c'            => $country2,
                            'lead_source__c'        => 'Reference',
                            'reference_company__c'  => $trader
                          );

            $sObject2 = new SObject();
            $sObject2->fields = $field2;
            $sObject2->type = 'Lead';

            $createResponse = $this->salesforce->create(array($sObject1, $sObject2));
    }
}