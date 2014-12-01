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
    $row_array['firstname'] = $row['first_name'];
    $row_array['lastname'] = $row['last_name'];

	array_push( $return_arr, $row_array );
    }
   
mysql_close($link);

echo json_encode($return_arr),"\n";	

	
	
?>