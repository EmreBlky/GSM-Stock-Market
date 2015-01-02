<?php

echo '<h1>SALESFORCE DATABASE</h1>';
echo 'Cron Job started at: '.date('d-m-Y H:i:s').'<br/>';

ini_set('max_execution_time', 300);
ini_set('soap.wsdl_cache_enabled', '0');
//require('../../salesforce');
define("SOAP_CLIENT_BASEDIR", "../salesforce/");
require_once (SOAP_CLIENT_BASEDIR.'/soapclient/SforceEnterpriseClient.php');
require_once (SOAP_CLIENT_BASEDIR.'/samples/userAuth.php');
include('db_connect.php');

mysql_select_db('gsmstock_master', $link);

$mySforceConnection = new SforceEnterpriseClient();
$mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/soapclient/enterprise.wsdl.xml');
$mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);

$currentTime = mktime();
$startTime = $currentTime-(60*120);
$endTime = $currentTime;

$getUpdateddResponse = $mySforceConnection->getUpdated('Lead', $startTime, $endTime);

if(!empty($getUpdateddResponse->ids)){
    //print_r($getUpdateddResponse);
    foreach($getUpdateddResponse->ids as $id){
        //echo $id.'<br/>';
        $query =  "SELECT Id, Title, FirstName, LastName, Email, Company, Address_Line_1__c, Address_Line_2__c, Town_City__c, County__c, Position__c FROM Lead WHERE Id = '".$id."' ";
        
        $response = $mySforceConnection->query(($query));

            foreach ($response->records as $record) {
                //echo '<pre>';
                //print_r($record);
                  
                $results = mysql_query("SELECT * FROM master_data WHERE email_address = '".$record->Email."'");

                if (mysql_num_rows($results) > 0) {
                    
                    //echo 'IN DATBASE';
                    mysql_query("UPDATE master_data SET 
                                                  first_name = '".$record->FirstName."',
                                                  last_name = '".$record->LastName."', 
                                                  company_name = '".$record->Company."', 
                                                  address_line_1 = '".$record->Address_Line_1__c."', 
                                                  address_line_2 = '".$record->Address_Line_2__c."', 
                                                  town_city = '".$record->Town_City__c."', 
                                                  county = '".$record->County__c."', 
                                                  role = '".$record->Position__c."',
                                                  date_updated = '".date('Y-m-d H:i:s')."'
                              WHERE email_address = '".$record->Email."'
                              ") or die(mysql_error());
                    //}
                }
                else{
                    //echo 'NOT IN DATBASE!';
                    mysql_query("INSERT INTO  master_data (  
                                                            email_address,
                                                            first_name,
                                                            last_name, 
                                                            company_name, 
                                                            address_line_1, 
                                                            address_line_2, 
                                                            town_city, 
                                                            county, 
                                                            role,
                                                            date_created,
                                                            date_updated
                                                           )
                                                        VALUES (
                                                            '".$record->Email."',
                                                            '".$record->FirstName."',
                                                            '".$record->LastName."', 
                                                            '".$record->Company."', 
                                                            '".$record->Address_Line_1__c."', 
                                                            '".$record->Address_Line_2__c."', 
                                                            '".$record->Town_City__c."', 
                                                            '".$record->County__c."', 
                                                            '".$record->Position__c."',
                                                            '".date('Y-m-d H:i:s')."',
                                                            '".date('Y-m-d H:i:s')."'
                                                            )
                                ") or die(mysql_error());
                }
                  
                  //$record->Title.'<br/>';
                  /*
                  mysql_query("UPDATE master_data SET 
                                                  first_name = '".$record->FirstName."',
                                                  last_name = '".$record->LastName."', 
                                                  company_name = '".$record->Company."', 
                                                  address_line_1 = '".$record->Address_Line_1__c."', 
                                                  address_line_2 = '".$record->Address_Line_2__c."', 
                                                  town_city = '".$record->Town_City__c."', 
                                                  county = '".$record->County__c."', 
                                                  role = '".$record->Position__c."'  
                              WHERE email_address = '".$record->Email."'
                              ");
                   
                   */
            }
    }
}
echo 'Cron Job completed at: '.date('d-m-Y H:i:s');