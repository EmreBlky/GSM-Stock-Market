<?php

ini_set('max_execution_time', 0);
include('db_connect.php');

$dateTime = new DateTime(date('Y-m-d H:i:s'));
$dateTime->modify('-30 minutes');
//$updated_date = $dateTime->format('Y-m-d H:i:s');
$updated_date = $dateTime->format('2014-12-01 00:00:00');

require_once 'csrest_subscribers.php';
//$wrap_get = new CS_REST_Subscribers('7d12ef820da06a613ce63e94c6d38dbe', $auth);
$wrap_get = new CS_REST_Subscribers('83452bc1f84d841531d8a6fbf9911f68', $auth); //MASTER

//$wrap_create = new CS_REST_Subscribers('7d12ef820da06a613ce63e94c6d38dbe', $auth);
$wrap_create = new CS_REST_Subscribers('83452bc1f84d841531d8a6fbf9911f68', $auth); //MASTER

//$wrap_update = new CS_REST_Subscribers('7d12ef820da06a613ce63e94c6d38dbe', $auth);
$wrap_update  = new CS_REST_Subscribers('83452bc1f84d841531d8a6fbf9911f68', $auth); //MASTER

//$results = $conn->query("SELECT * FROM master_data") or die (mysql_error());
$sql = "SELECT * FROM master_data";
$result_info = $conn->query($sql);
    if ($result_info) {
        
        while($obj = $result_info->fetch_object()){
            
            if($obj->date_updated > $updated_date){
            
            $email_add = $obj->email_address;
            $fname = $obj->first_name;
            $lname = $obj->last_name;
            $title = $obj->title;            
            $company_name = $obj->company_name;
            $phone_number = $obj->phone_number;
            $mobile_number = $obj->mobile_number;
            $address_line_1 = $obj->address_line_1;
            $address_line_2 = $obj->address_line_2;
            $town_city = $obj->town_city;
            $county = $obj->county;
            $country = $obj->country;
            $post_code = $obj->post_code;
            $website = $obj->website;
            $business_sectors = $obj->business_sectors;
            $other_sectors = $obj->other_sectors;
            $vat_tax = $obj->vat_tax;
            $company_number = $obj->company_number;
            $language = $obj->language;
            $facebook = $obj->facebook;
            $twitter = $obj->twitter;
            $gplus = $obj->gplus;
            $linkedin = $obj->linkedin;
            $skype = $obj->skype;
            $role = $obj->role;
            
            $results = $wrap_get->get($email_add);

		if(empty($results->response->EmailAddress)){
			
			$result = $wrap_create->add(
                                                    array(
                                                            'EmailAddress' => $email_add,
                                                            'Name' => $fname.' '.$lname,
                                                            'CustomFields' => array(
                                                                                    array(
                                                                                            'Key' => 'AddressLine1',
                                                                                            'Value' => $address_line_1
                                                                                            ),																		
                                                                                    array(
                                                                                            'Key' => 'Address Line 2',
                                                                                            'Value' => $address_line_2
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Town/City',
                                                                                            'Value' => $town_city
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'County',
                                                                                            'Value' => $county
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Country',
                                                                                            'Value' => $country
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Postal/ZipCode',
                                                                                            'Value' => $post_code
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'ClickMobileShopRetail',
                                                                                            'Value' => ''
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'SentFirstEmail',
                                                                                            'Value' => ''
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Website',
                                                                                            'Value' => $website
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Business Sectors',
                                                                                            'Value' => $business_sectors
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'VAT/Tax Number',
                                                                                            'Value' => $vat_tax
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Group',
                                                                                            'Value' => ''
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Please state other business',
                                                                                            'Value' => $other_sectors
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Mobile Number',
                                                                                            'Value' => $mobile_number
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Phone Number',
                                                                                            'Value' => $phone_number
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'ClickMobileShop Trade',
                                                                                            'Value' => 'No'
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'ClickMobileShop Retail',
                                                                                            'Value' => 'No'
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'GSMStockMarket',
                                                                                            'Value' => 'No'
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Language',
                                                                                            'Value' => $language
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Sent First Email',
                                                                                            'Value' => ''
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Twitter',
                                                                                            'Value' => $twitter
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Facebook',
                                                                                            'Value' => $facebook
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'GooglePlus',
                                                                                            'Value' => $gplus
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Role',
                                                                                            'Value' => $role
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Company Number',
                                                                                            'Value' => $company_number
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Linkedin',
                                                                                            'Value' => $linkedin
                                                                                            ),
                                                                                    array(
                                                                                            'Key' => 'Skype',
                                                                                            'Value' => $skype
                                                                                            )
                                                            ),
                                                            'Resubscribe' => true
                                                    )
                                            );
			
			
		}
		else{
		
			$result = $wrap_update->update($email_add, array(
                                                                        'EmailAddress' => $email_add,
                                                                        'Name' => $fname.' '.$lname,
                                                                        'CustomFields' => array(
                                                                                                array(
                                                                                                        'Key' => 'AddressLine1',
                                                                                                        'Value' => $address_line_1
                                                                                                        ),																		
                                                                                                array(
                                                                                                        'Key' => 'Address Line 2',
                                                                                                        'Value' => $address_line_2
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Town/City',
                                                                                                        'Value' => $town_city
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'County',
                                                                                                        'Value' => $county
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Country',
                                                                                                        'Value' => $country
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Postal/ZipCode',
                                                                                                        'Value' => $post_code
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'ClickMobileShopRetail',
                                                                                                        'Value' => ''
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'SentFirstEmail',
                                                                                                        'Value' => ''
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Website',
                                                                                                        'Value' => $website
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Business Sectors',
                                                                                                        'Value' => $business_sectors
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'VAT/Tax Number',
                                                                                                        'Value' => $vat_tax
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Group',
                                                                                                        'Value' => ''
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Please state other business',
                                                                                                        'Value' => $other_sectors
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Mobile Number',
                                                                                                        'Value' => $mobile_number
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Phone Number',
                                                                                                        'Value' => $phone_number
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'ClickMobileShop Trade',
                                                                                                        'Value' => 'No'
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'ClickMobileShop Retail',
                                                                                                        'Value' => 'No'
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'GSMStockMarket',
                                                                                                        'Value' => 'No'
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Language',
                                                                                                        'Value' => $language
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Sent First Email',
                                                                                                        'Value' => ''
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Twitter',
                                                                                                        'Value' => $twitter
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Facebook',
                                                                                                        'Value' => $facebook
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'GooglePlus',
                                                                                                        'Value' => $gplus
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Role',
                                                                                                        'Value' => $role
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Company Number',
                                                                                                        'Value' => $company_number
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Linkedin',
                                                                                                        'Value' => $linkedin
                                                                                                        ),
                                                                                                array(
                                                                                                        'Key' => 'Skype',
                                                                                                        'Value' => $skype
                                                                                                        )
                                                                                        ),
                                                                                        'Resubscribe' => true
                                                                                )
                                                                        );
                }
            }
        }
    }
    $result_info->close();
