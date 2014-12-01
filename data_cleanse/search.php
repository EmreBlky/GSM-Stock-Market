<?php
	
$link = mysql_connect('109.203.125.38', 'gsmstock_admin', 'zv.4qAb17ph$;?$PF!') or die("Database Error");	
mysql_select_db('gsmstock_master', $link);
$return_arr = array();

$term = $_GET['term'];//retrieve the search term that autocomplete sends

$sql="SELECT * FROM master_data WHERE email_address LIKE '%$term%' ORDER BY email_address";

$result = mysql_query($sql)or die(mysql_error());
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
	$row_array['label']  = $row['email_address'];
        $row_array['value'] = $row['email_address'];
        $row_array['title']  = $row['title'];
        $row_array['first_name']  = $row['first_name'];
        $row_array['last_name']  = $row['last_name'];
        $row_array['company_name']  = $row['company_name'];
        $row_array['phone_number']  = $row['phone_number'];
        $row_array['mobile_number']  = $row['mobile_number'];
        $row_array['address_line_1']  = $row['address_line_1'];
        $row_array['address_line_2']  = $row['address_line_2'];
        $row_array['town_city']  = $row['town_city'];
        $row_array['county']  = $row['county'];
        $row_array['country']  = $row['country'];
        $row_array['post_code']  = $row['post_code'];
        $row_array['website']  = $row['website'];
        $row_array['business_sectors']  = $row['business_sectors'];
        $row_array['other_sectors']  = $row['other_sectors'];
        $row_array['vat_tax']  = $row['vat_tax'];
        $row_array['company_number']  = $row['company_number'];
        $row_array['language']  = $row['language'];
        $row_array['facebook']  = $row['facebook'];
        $row_array['twitter']  = $row['twitter'];
        $row_array['gplus']  = $row['gplus'];
        $row_array['linkedin']  = $row['linkedin'];
        $row_array['skype']  = $row['skype'];

	array_push( $return_arr, $row_array );
    }
   
mysql_close($link);

echo json_encode($return_arr),"\n";	

	
	
?>