<?php

echo '<h1>SALESFORCE TO MASTER DATABASE</h1>';
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
//$startTime = $currentTime-(60*120);
$startTime = mktime(date("00"), date("00"), date("00"), date("12"), date("1"), date("2014"));
$endTime = $currentTime;

$getUpdateddResponse = $mySforceConnection->getUpdated('Lead', $startTime, $endTime);

if(!empty($getUpdateddResponse->ids)){
    //print_r($getUpdateddResponse);
    foreach($getUpdateddResponse->ids as $id){
        //echo $id.'<br/>';
        $query =  "SELECT 
                        Id, 
                        Title, 
                        FirstName, 
                        LastName, 
                        Email, 
                        Company, 
                        Phone, 
                        Address_Line_1__c, 
                        Address_Line_2__c, 
                        Town_City__c, 
                        County__c, 
                        Postal_Zip_Code__c, 
                        Website,
                        Business_Sectors__c,
                        Other_Business_Sectors__c,
                        VAT_Tax_Number__c,
                        Company_Number__c,
                        Language__c,
                        Deskcom__twitter_username__c,
                        Facebook__c,
                        Google_Plus__c,
                        Linkedin__c,
                        Skype__c,
                        Position__c 
                 FROM Lead WHERE Id = '".$id."' ";
        
        $response = $mySforceConnection->query(($query));

            foreach ($response->records as $record) {
                //echo '<pre>';
                //print_r($record);
                  
                $results = mysql_query("SELECT * FROM master_data WHERE email_address = '".$record->Email."'");

                if (mysql_num_rows($results) > 0) {
                    
                    //echo 'IN DATBASE';
                    mysql_query("UPDATE master_data SET 
                                                  first_name = '".ucfirst(strtolower($record->FirstName))."',
                                                  last_name = '".ucfirst(strtolower($record->LastName))."', 
                                                  company_name = '".$record->Company."',
                                                  phone_number = '".$record->Phone."',
                                                  mobile_number = '".$record->MobilePhone."',
                                                  address_line_1 = '".$record->Address_Line_1__c."', 
                                                  address_line_2 = '".$record->Address_Line_2__c."', 
                                                  town_city = '".$record->Town_City__c."', 
                                                  county = '".$record->County__c."',
                                                  country = '".$record->Country__c."',
                                                  post_code = '".$record->Postal_Zip_Code__c."',
                                                  website = '".$record->Website."',
                                                  business_sectors = '".$record->Business_Sectors__c."',
                                                  other_sectors = '".$record->Other_Business_Sectors__c."',
                                                  vat_tax = '".$record->VAT_Tax_Number__c."',
                                                  company_number = '".$record->Company_Number__c."', 
                                                  language = '".$record->Language__c."',
                                                  twitter = '".$record->Deskcom__twitter_username__c."',
                                                  facebook = '".$record->Facebook__c."',
                                                  gplus = '".$record->Google_Plus__c."',
                                                  linkedin = '".$record->Linkedin__c."',
                                                  skype = '".$record->Skype__c."',
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
                                                            phone_number, 
                                                            mobile_number, 
                                                            address_line_1 , 
                                                            address_line_2, 
                                                            town_city, 
                                                            county, 
                                                            country, 
                                                            post_code, 
                                                            website, 
                                                            business_sectors, 
                                                            other_sectors, 
                                                            vat_tax, 
                                                            company_number, 
                                                            language, 
                                                            twitter, 
                                                            facebook, 
                                                            gplus, 
                                                            linkedin, 
                                                            skype, 
                                                            role
                                                            date_created,
                                                            date_updated
                                                           )
                                                        VALUES (
                                                            '".strtolower($record->Email)."',
                                                            '".ucfirst(strtolower($record->FirstName))."',
                                                            '".ucfirst(strtolower($record->LastName))."',
                                                            '".$record->Company."',
                                                            '".$record->Phone."',
                                                            '".$record->MobilePhone."',
                                                            '".$record->Address_Line_1__c."',
                                                            '".$record->Address_Line_2__c."',
                                                            '".$record->Town_City__c."',
                                                            '".$record->County__c."',
                                                            '".$record->Country__c."',
                                                            '".$record->Postal_Zip_Code__c."',
                                                            '".$record->Website."',
                                                            '".$record->Business_Sectors__c."',
                                                            '".$record->Other_Business_Sectors__c."',
                                                            '".$record->VAT_Tax_Number__c."',
                                                            '".$record->Company_Number__c."',
                                                            '".$record->Language__c."',
                                                            '".$record->Deskcom__twitter_username__c."',
                                                            '".$record->Facebook__c."',
                                                            '".$record->Google_Plus__c."',
                                                            '".$record->Linkedin__c."',
                                                            '".$record->Skype__c."',
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