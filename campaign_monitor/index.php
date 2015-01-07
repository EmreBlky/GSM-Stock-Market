<?php

ini_set('max_execution_time', 0);
include('db_connect.php');
//mysql_select_db('gsmstock_master', $conn);

require_once 'csrest_lists.php';
//$wrap = new CS_REST_Lists('7d12ef820da06a613ce63e94c6d38dbe', $auth); //EMAIL 
$wrap = new CS_REST_Lists('83452bc1f84d841531d8a6fbf9911f68', $auth); //MASTER

$result_get = $wrap->get();
$result_page = $wrap->get_active_subscribers('', NULL, NULL, 'email', 'asc');
$result_active = $wrap->get_active_subscribers('', NULL, NULL, 'email', 'asc');
//$result_unsubscribed = $wrap->get_unsubscribed_subscribers('', NULL, NULL, 'email', 'asc');
//$result_unconfirmed = $wrap->get_unconfirmed_subscribers('', NULL, NULL, 'email', 'asc');

//echo '<h1>GET INFORMATION</h1>';
//echo '<pre>';
//echo '<h2>GET ALL</h2>';
//print_r($result_get);
//echo '<h2>GET PAGE</h2>';
//print_r($result_page);
//echo '<h2>GET ACTIVE</h2>';
//print_r($result_active);
//echo '</pre>';
//exit;

$count = 1;
$page_count = $result_page->response->NumberOfPages;

while($count <= $page_count){

$result_active = $wrap->get_active_subscribers('', $count, NULL, 'email', 'asc');

	foreach($result_active->response->Results as $result){
            
            $results = $conn->query("SELECT * FROM master_data WHERE email_address = '".$result->EmailAddress."'") or die (mysql_error());
            
                    $name =  explode(' ', $result->Name);
                    $first_name = ucfirst($name[0]);
                    $last_name = ucfirst($name[1]);
                    
                    $email_address = $result->EmailAddress;
                    $date_created = $result->Date;
                    $date_updated = date('Y-m-d H:i:s');
                    $subscribe_status = strtolower($result->State);
                    
                    //echo '<pre>';
                    //print_r($result);
                    
                    foreach($result->CustomFields as $key){

                            if($key->Key == '[PhoneNumber]'){

                                    $phone_number = $key->Value;

                            }
                            if($key->Key == '[MobileNumber]'){

                                    $mobile_number = $key->Value;

                            }

                            if($key->Key == '[VAT/TaxNumber]'){

                                    $vat_tax = $key->Value;

                            }

                            if($key->Key == '[Website]'){

                                    $website = $key->Value;

                            }

                            if($key->Key == '[Postal/ZipCode]'){

                                    $post_code = $key->Value;

                            }

                            if($key->Key == '[Town/City]'){

                                    $town_city =  $key->Value;

                            }

                            if($key->Key == '[AddressLine1]'){

                                    $address_line_1 = $key->Value;

                            }
                            if($key->Key == '[AddressLine2]'){

                                    $address_line_2 = $key->Value;

                            }
                            
                            if($key->Key == '[County]'){

                                    $county = $key->Value;

                            }
                            
                            if($key->Key == '[Country]'){

                                    $country = $key->Value;

                            }

                            if($key->Key == '[CompanyName]'){

                                    $company_name =  $key->Value;

                            }
                            
                            if($key->Key == '[CompanyNumber]'){

                                    $company_number =  $key->Value;

                            }
                            if($key->Key == '[BusinessSectors]'){

                                    $business_sectors =  $key->Value;

                            }

                            if($key->Key == '[Pleasestateotherbusiness]'){

                                    $other_sectors =  $key->Value;

                            }

                            if($key->Key == '[Language]'){

                                    $language =  $key->Value;

                            }
                            if($key->Key == '[ClickMobileShopRetail]'){

                                    $clickretail =  strtolower($key->Value);

                            }
                            if($key->Key == '[ClickMobileShopTrade]'){

                                    $clicktrade =  strtolower($key->Value);

                            }
                            if($key->Key == '[GSMStockMarket]'){

                                    $gsmstock =  strtolower($key->Value);

                            }
                            if($key->Key == '[Group]'){

                                    $group =  $key->Value;

                            }
                            
                            if($key->Key == '[Facebook]'){

                                    $facebook =  $key->Value;

                            }
                            
                            if($key->Key == '[Twitter]'){

                                    $twitter =  $key->Value;

                            }
                            
                            if($key->Key == '[GooglePlus]'){

                                    $gplus =  $key->Value;

                            }
                            
                            if($key->Key == '[Linkedin]'){

                                    $linkedin =  $key->Value;

                            }
                            
                            if($key->Key == '[Skype]'){

                                    $skype =  $key->Value;

                            }
                            
                            if($key->Key == '[Role]'){

                                    $role =  $key->Value;

                            }

                    }

                if (mysqli_num_rows($results) > 0) {
                    
                    $sql = "UPDATE master_data SET
                                                    email_address = '".strtolower($email_address)."',
                                                    title = '".$title."',
                                                    first_name = '".ucfirst(strtolower($first_name))."', 
                                                    last_name = '".ucfirst(strtolower($last_name))."',
                                                    company_name = '".$company_name."',
                                                    phone_number = '".$phone_number."',
                                                    mobile_number = '".$mobile_number."',
                                                    address_line_1 = '".$address_line_1."',
                                                    address_line_2 = '".$address_line_2."',
                                                    town_city = '".$town_city."',
                                                    county = '".$county."',
                                                    country = '".$country."',
                                                    post_code = '".$post_code."',
                                                    website = '".$website."',
                                                    business_sectors = '".$business_sectors."',
                                                    other_sectors = '".$other_sectors."',
                                                    vat_tax = '".$vat_tax."',
                                                    company_number = '".$company_number."',
                                                    language = '".$language."',
                                                    twitter = '".$twitter."',
                                                    facebook = '".$facebook."',
                                                    gplus = '".$gplus."',
                                                    linkedin = '".$linkedin."',
                                                    skype = '".$skype."',
                                                    role = '".$role."',
                                                    date_updated = '".$date_updated."',
                                                    subscribe_status = '".$subscribe_status."',
                                                    gsmstockmarket = '".$gsmstock."',
                                                    clicktrade = '".$clicktrade."',
                                                    clickretail = '".$clickretail."',
                                                    group = '".$group."'    
                                        WHERE email_address = '".$result->EmailAddress."'";
                $conn->query($sql);
                    
                }
                else{ 

                    $sql = "INSERT INTO master_data (
                                                    email_address,
                                                    title,
                                                    first_name,
                                                    last_name,
                                                    company_name,
                                                    phone_number,
                                                    mobile_number,
                                                    address_line_1,
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
                                                    role,
                                                    date_created,
                                                    date_updated,
                                                    subscribe_status,
                                                    gsmstockmarket,
                                                    clicktrade,
                                                    clickretail,
                                                    group
                                                    )  
                                                    VALUES 
                                                    ( 
                                                    '".strtolower($email_address)."', 
                                                    '".$title."', 
                                                    '".ucfirst(strtolower($first_name))."', 
                                                    '".ucfirst(strtolower($last_name))."', 
                                                    '".$company_name."', 
                                                    '".$phone_number."', 
                                                    '".$mobile_number."', 
                                                    '".$address_line_1."', 
                                                    '".$address_line_2."', 
                                                    '".$town_city."', 
                                                    '".$county."', 
                                                    '".$country."', 
                                                    '".$post_code."', 
                                                    '".$website."', 
                                                    '".$business_sectors."', 
                                                    '".$other_sectors."', 
                                                    '".$vat_tax."', 
                                                    '".$company_number."', 
                                                    '".$language."', 
                                                    '".$twitter."', 
                                                    '".$facebook."', 
                                                    '".$gplus."', 
                                                    '".$linkedin."', 
                                                    '".$skype."', 
                                                    '".$role."', 
                                                    '".$date_created."', 
                                                    '".$date_updated."', 
                                                    '".$subscribe_status."',
                                                    '".$gsmstock."',
                                                    '".$clicktrade."',
                                                    '".$clickretail."',
                                                    '".$group."'    
                                                    )";
                $conn->query($sql);
                
                }                
                        //unset($email_address); 
                        unset($title); 
                        unset($first_name); 
                        unset($last_name); 
                        unset($company_name); 
                        unset($phone_number); 
                        unset($mobile_number); 
                        unset($address_line_1); 
                        unset($address_line_2); 
                        unset($town_city); 
                        unset($county); 
                        unset($country); 
                        unset($post_code); 
                        unset($website); 
                        unset($business_sectors); 
                        unset($other_sectors); 
                        unset($vat_tax); 
                        unset($company_number); 
                        unset($language); 
                        unset($twitter); 
                        unset($facebook); 
                        unset($gplus); 
                        unset($linkedin); 
                        unset($skype); 
                        unset($role); 
                        unset($date_created); 
                        unset($date_updated); 
                        unset($subscribe_status);
                        unset($gsmstock);
                        unset($clicktrade);
                        unset($clickretail);
                        unset($group);  
//		
        }               

$count++;       
}

$conn->close();