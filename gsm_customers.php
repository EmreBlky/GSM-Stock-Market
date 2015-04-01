<?php

mysql_connect('109.203.125.38', 'gsmstock_admin', 'zv.4qAb17ph$;?$PF!');
mysql_select_db('gsmstock_securelive');

//mysql_connect('localhost', 'root', 'People1205');
//mysql_select_db('gsmstock_secure');

$qry = mysql_query("SELECT * FROM members") or die (mysql_error());
$email_message = "";
$data = "";
$blank = "";
$data ="Name,Email Address,Date Added,Address Line 1,Address Line 2,Business Sectors,ClickMobileShop Retail,ClickMobileShop Trade,Company Name,Company Number,Country,County,Facebook,GooglePlus,Group,GSMStockMarket,Language,Linkedin,Phone Number,Please state other business,Postal/Zip Code,Role,Sent First Email,Skype,Town/City,Twitter,VAT/Tax Number,Website\n";

while($rowMember = mysql_fetch_array($qry)) {
	
  $qry_company = mysql_query("SELECT * FROM company WHERE admin_member_id = '".$rowMember['id']."'") or die (mysql_error());
  while($rowCompany = mysql_fetch_array($qry_company)) {
	
	$data .= $rowMember['firstname'].' '.$rowMember['lastname'].",".$rowMember['email'].",".$rowMember['date'].",".$rowCompany['address_line_1'].",".$rowCompany['address_line_2'].",".$rowCompany['business_sector_1'].'||'.$rowCompany['business_sector_2'].'||'.$rowCompany['business_sector_3'].",".$blank.",".$blank.",".$rowCompany['company_number'].",".$rowCompany['country'].",".$rowCompany['county'].",".$rowMember['facebook'].",".$rowMember['gplus'].",".$blank.",".$blank.",".$rowMember['language'].",".$rowMember['linkedin'].",".$rowMember['mobile_number'].",".$rowMember['phone_number'].",".$blank.",".$rowCompany['post_code'].",".$rowMember['role'].",".$blank.",".$rowMember['skype'].",".$rowCompany['town_city'].",".$rowMember['twitter'].",".$rowCompany['vat_tax'].",".$rowCompany['website']."\n";
  
  }
	
}

$file = 'public/main/template/gsm/files/gsm_customers.csv';
file_put_contents($file, $data);

sleep(1);

$email_to = "tim@gsmstockmarket.com";
//$email_to = "info@imarveldesign.co.uk";
$email_from = "server@gsmstockmarket.com";
$email_subject = "GSM Stock Members";
$email_txt = "Please find csv attached with this email.";
$fileatt = 'public/main/template/gsm/files/gsm_customers.csv';
$fileatt_type = "application/csv";
$fileatt_name = "gsm_customers.csv";
$file = fopen($fileatt,'rb');
$data = fread($file,filesize($fileatt));
fclose($file);
$semi_rand = md5(time());
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
$headers="From: $email_from";
$headers .= "\nMIME-Version: 1.0\n" .
"Content-Type: multipart/mixed;\n" .
" boundary=\"{$mime_boundary}\"";
$email_message .= "This is a multi-part message in MIME format.\n\n" .
"--{$mime_boundary}\n" .
"Content-Type:text/html; charset=\"iso-8859-1\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $email_txt;
$email_message .= "\n\n";
$data = chunk_split(base64_encode($data));
$email_message .= "--{$mime_boundary}\n" .
"Content-Type: {$fileatt_type};\n" .
" name=\"{$fileatt_name}\"\n" .
"Content-Transfer-Encoding: base64\n\n" .
$data . "\n\n" .
"--{$mime_boundary}--\n";

mail($email_to,$email_subject,$email_message,$headers);
//header('location: https://www.theoutdoorshop.com/cron_google/cron_email.php');

?>