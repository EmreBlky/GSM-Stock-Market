<?php
error_reporting(E_ALL);
$dateTime = new DateTime(date('Y-m-d H:i:s'));
$dateTime->modify('-5 minutes');
$updated_date = $dateTime->format('Y-m-d H:i:s'); 


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

$results = mysql_query("SELECT * FROM master_data");

if (mysql_num_rows($results) > 0) {

    while($row = mysql_fetch_assoc($results)) {
        
        //if($row['first_name'] && $row['last_name'] && $row['phone_number'] && $row['company_name'] && $row['date_updated'] > $updated_date){
	if($row['first_name'] && $row['last_name'] && $row['phone_number'] && $row['company_name']){
        
            $query = "SELECT L.Id, L.Email FROM Lead L WHERE L.Email = '".$row['email_address']."'";

            $response = $mySforceConnection->query(($query));

            foreach ($response->records as $record) { 
                //echo $id = $response->Id.'<br/>';
                //echo $email = $record->Email.'<br/>';
		$id = $record->Id;
                $email = $record->Email;

            }

            if($email != $row['email_address']){

                //echo 'NOT SAME EMAIL!<br/>';
				
                $sObject = new stdclass();
                $sObject->FirstName = $row['first_name'];
                $sObject->LastName = $row['last_name'];
                $sObject->Phone = $row['phone_number'];
                $sObject->Email = $row['email_address'];
                $sObject->Company = $row['company_name'];
                $sObject->MobilePhone = $row['mobile_number'];
                $sObject->Address_Line_1__c = $row['address_line_1'];
                $sObject->Address_Line_2__c = $row['address_line_2'];
                $sObject->Town_City__c = $row['town_city'];
                $sObject->County__c = $row['county'];
                $sObject->Country__c = $row['country'];
                $sObject->Postal_Zip_Code__c = $row['post_code'];
                $sObject->Website = $row['website'];
                $sObject->Business_Sectors__c = $row['business_sectors'];
                $sObject->Other_Business_Sectors__c = $row['other_sectors'];
                $sObject->VAT_Tax_Number__c = $row['vat_tax'];
                $sObject->Company_Number__c = $row['company_number'];
                $sObject->Language__c = $row['language'];
                $sObject->Deskcom__twitter_username__c = $row['twitter'];
                $sObject->Facebook__c = $row['facebook'];
                $sObject->Google_Plus__c = $row['gplus'];
                $sObject->Linkedin__c = $row['linkedin'];
                $sObject->Skype__c = $row['skype'];
                $sObject->Position__c = $row['role'];

                $createResponse = $mySforceConnection->create(array($sObject), 'Lead');
				
            }
            else{
                 //echo 'SAME EMAIL!<br/>';
				
                $sObject = new stdclass();
                $sObject->Id = $id;
                $sObject->FirstName = $row['first_name'];
                $sObject->LastName = $row['last_name'];
                $sObject->Phone = $row['phone_number'];
                $sObject->Email = $row['email_address'];
                $sObject->Company = $row['company_name'];
                $sObject->MobilePhone = $row['mobile_number'];
                $sObject->Address_Line_1__c = $row['address_line_1'];
                $sObject->Address_Line_2__c = $row['address_line_2'];
                $sObject->Town_City__c = $row['town_city'];
                $sObject->County__c = $row['county'];
                $sObject->Country__c = $row['country'];
                $sObject->Postal_Zip_Code__c = $row['post_code'];
                $sObject->Website = $row['website'];
                $sObject->Business_Sectors__c = $row['business_sectors'];
                $sObject->Other_Business_Sectors__c = $row['other_sectors'];
                $sObject->VAT_Tax_Number__c = $row['vat_tax'];
                $sObject->Company_Number__c = $row['company_number'];
                $sObject->Language__c = $row['language'];
                $sObject->Deskcom__twitter_username__c = $row['twitter'];
                $sObject->Facebook__c = $row['facebook'];
                $sObject->Google_Plus__c = $row['gplus'];
                $sObject->Linkedin__c = $row['linkedin'];
                $sObject->Skype__c = $row['skype'];
                $sObject->Position__c = $row['role'];

                $createResponse = $mySforceConnection->update(array($sObject), 'Lead');
				
            }	
       }
    }            
}


