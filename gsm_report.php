<?php

$url = $_SERVER['SERVER_NAME'];
//exit;
if($url == 'localhost'){
    mysql_connect('localhost', 'root', 'Rwt189K72');
    mysql_select_db('gsmstock_secure');
}
elseif($url == 'secure-dev.gsmstockmarket.com'){
    mysql_connect('109.203.125.38', 'gsmstock_admin', 'zv.4qAb17ph$;?$PF!');
    mysql_select_db('gsmstock_secure');
}
else{
    mysql_connect('5.77.55.42', 'gsmstock_admin', 'zv.4qAb17ph$;?$PF!');
    mysql_select_db('gsmstock_secure');
}

function country($code)
{
    $qry = mysql_query("SELECT country FROM country WHERE id = '".$code."'") or die (mysql_error());
    
    while($row = mysql_fetch_array($qry)) {        
        $country = $row['country'];        
    }
    
    return $country;
}

function dial_code($code)
{
    $qry = mysql_query("SELECT dial_code FROM country WHERE id = '".$code."'") or die (mysql_error());
    
    while($row = mysql_fetch_array($qry)) {        
        
        $dial_code = $row['dial_code'];
    }
    
    return $dial_code;
}

$qry = mysql_query("SELECT * FROM members") or die (mysql_error());
$email_message = "";
$data = "";
$blank = "";
$data ="Name,Email Address,Date Added,Country,Company Name, Phone Number,Role,Skype,Website\n";

while($rowMember = mysql_fetch_array($qry)) {
	
  $qry_company = mysql_query("SELECT * FROM company WHERE admin_member_id = '".$rowMember['id']."'") or die (mysql_error());
  while($rowCompany = mysql_fetch_array($qry_company)) {
	
	$data .= $rowMember['firstname'].' '.$rowMember['lastname'].",".$rowMember['email'].",".$rowMember['date'].",".country($rowCompany['country']).",".$rowCompany['company_name'].",".dial_code($rowMember['dial_phone']).' '.$rowMember['phone_number'].",".$rowMember['role'].",".$rowMember['skype'].",".$rowCompany['website']."\n";
  
  }
  mysql_query("UPDATE members SET gsm_check = 'yes' WHERE id = '".$rowMember['id']."'") or die (mysql_error());
}

$file = 'public/main/template/gsm/files/gsm_report.csv';
file_put_contents($file, $data);

sleep(1);

$email_to = "tim@gsmstockmarket.com";
//$email_to = "info@imarveldesign.co.uk";
$email_from = "server@gsmstockmarket.com";
$email_subject = "GSM Stock Members Weekly Report";
$email_txt = "Please find csv attached with this email.";
$fileatt = 'public/main/template/gsm/files/gsm_report.csv';
$fileatt_type = "application/csv";
$fileatt_name = "gsm_report.csv";
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

?>