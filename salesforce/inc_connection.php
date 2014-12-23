<?php 
require ('inc_config.php'); 

ini_set('soap.wsdl_cache_enabled', 0); 
ini_set('soap.wsdl_cache_ttl', 0);   

	//Create a new Salesforce Partner object 
	$connection = new SforcePartnerClient();  

	//Create the SOAP connection to Salesforce 
	try {  
	$connection->createConnection(salesforce_wsdl); 
	} 
	catch (Exception $e) {
    //Salesforce could be down, or you have an error in configuration  
	//Check your WSDL path  
	//Otherwise, handle this exception 
	}  
	
	//Pass login details to Salesforce 
	try {  
	$connection->login(salesforce_username, salesforce_password.salesforce_token); 
	} 
	catch (Exception $e) {
	//Make sure your username and password is correct  //Otherwise, handle this exception 
	}
?>