<?php 
ini_set('soap.wsdl_cache_enabled', '0');
/*
https://developer.salesforce.com/page/PHP_Toolkit_20.0_Samples
https://www.salesforce.com/developer/docs/api/Content/sforce_api_objects_list.htm
*/
define("SOAP_CLIENT_BASEDIR", "soapclient");
require_once (SOAP_CLIENT_BASEDIR.'/SforceEnterpriseClient.php');
require_once ('samples/userAuth.php');

	$mySforceConnection = new SforceEnterpriseClient();
	$mySoapClient = $mySforceConnection->createConnection(SOAP_CLIENT_BASEDIR.'/enterprise.wsdl.xml');
	$mylogin = $mySforceConnection->login($USERNAME, $PASSWORD);
        
        
        try { 
            $currentTime = mktime();
            //exit;
            // assume that update occured within the last 5 mins.
            //$startTime = $currentTime-(300*10);
            //$endTime = $currentTime;

            echo "***** Get Updated Leads *****\n";
            $getUpdateddResponse = $mySforceConnection->getUpdated('Lead', 1417388400, $currentTime);
            echo '<pre>';
            //print_r($getUpdateddResponse);
            foreach($getUpdateddResponse->ids as $id){
                echo $id.'<br/>';
            }
          } catch (Exception $e) {
            echo $mySforceConnection->getLastRequest();
            print_r($e);
          }
        
	
	/*
	try {  
            //$query = "SELECT L.Id, L.FirstName, L.LastName, L.Email FROM Lead L WHERE L.Email = 'dipogeorge@imarveldesign.co.uk'";
            //$query = 'SELECT Id, Name, Email, Company, Address_Line_1__c, Address_Line_2__c, Town_City__c, County__c, Position__c FROM Lead ORDER BY Name';
            $query =  "SELECT Id, Name, Email, Company, Address_Line_1__c, Address_Line_2__c, Town_City__c, County__c, Position__c FROM Lead WHERE Id = '00Qb000000CCgUyEAL' ";
            //$query = 'SELECT Id, Name, Email FROM Contact ORDER BY Name';
            //$query = 'SELECT Id, Name FROM Account ORDER BY Name';
            //$query = 'SELECT Id, Name FROM Opportunity ORDER BY Name';
            $response = $mySforceConnection->query(($query));

            foreach ($response->records as $record) {
                  echo '<pre>';
                  print_r($record);
                  //$record->Address_Line_1__c;
            }
	} 
        catch (Exception $e) {
	  echo $e->faultstring;
	}
        */
        
	/*	
	// UPDATE DETAILS
	$id = '00Q24000001CkcgEAC';
	try {
	  $sObject = new stdclass();
	  $sObject->Id = $id;
	  $sObject->FirstName = 'Dipo';
	  $sObject->LastName = 'George';
	  $sObject->Phone = '01234567890';
	  $sObject->Email = 'dipogeorge@imarveldesigns.co.uk';
	  $sObject->Company = 'iMarvel Design Solutions LTD';

	  $response = $mySforceConnection->update(array ($sObject), 'Lead');
	  
	  echo '<pre>';
	  print_r($response);

	} catch (Exception $e) {
	  echo '<pre>';
	  print_r($mySforceConnection->getLastRequest());
	  echo $e->faultstring;
	}
	*/
	
	/*
	// CREATE DETAILS
	try {
	  $sObject = new stdclass();
	  $sObject->FirstName = 'Dipo';
	  $sObject->LastName = 'George';
	  $sObject->Phone = '01234567890';
	  $sObject->Email = 'dipogeorge@imarveldesign.co.uk';
	  $sObject->Company = 'iMarvel Design Solutions LTD';
	  
	  echo "**** Creating the following:\r\n";
	  $createResponse = $mySforceConnection->create(array($sObject), 'Lead');

	  $ids = array();
	  foreach ($createResponse as $createResult) {
		echo '<pre>';
		print_r($createResult);
		array_push($ids, $createResult->id);
	  }
	  
	} catch (Exception $e) {
	  echo $mySforceConnection->getLastRequest();
	  echo $e->faultstring;
	}
	*/
	/*
	// CONVERT LEAD
	$eLEADID = '';
	try {
	  $leadConvert = new stdClass;
	  $leadConvert->convertedStatus='Closed - Converted';
	  $leadConvert->doNotCreateOpportunity='true';
	  $leadConvert->leadId = $eLEADID;
	  $leadConvert->overwriteLeadSource='true';
	  $leadConvert->sendNotificationEmail='false';

	  $leadConvertArray = array($leadConvert);
	  $leadConvertResponse = $mySforceConnection->convertLead($leadConvertArray);
	  
	  echo '<pre>';
	  print_r($leadConvertResponse);
	} catch (Exception $e) {
	  echo $e->faultstring;
	}
	*/
?>

