<?php
	
include('db_connect.php');

$source = '';
$cv_count = '';
$count = '';
$delete_count = '';

mysql_select_db('gsmstock_generator', $link);
$result = mysql_query("SELECT * FROM emails");
if($result){
    $num_rows = mysql_num_rows($result);
}
 else {
    $num_rows =  0; 
}
// 
if(isset($_POST['submit_form'])){
$source = mysql_real_escape_string($_POST['source']);
$cv_count = 0;
$count = 0;
$delete_count = 0;

if ($_FILES[csv][size] > 0) { 

    //get the csv file
    $message_start = 1;
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
    
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) {
            
            mysql_query("INSERT INTO emails (email_address, source, date_created) VALUES 
                        ( 
                            '".strtolower(addslashes($data[0]))."', 
                            '".$source."',
                            '".date('Y-m-d H:i:s')."'
                        ) 
                    ") or die (mysql_error());
                    
                    $count++;
           
            $sql= "SELECT * FROM gsmstock_master.master_data WHERE email_address ='".$data[0]."' ORDER BY email_address";
            $result = mysql_query($sql)or die(mysql_error());
            while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
            
                echo 'This is where master ID goes: '.$row['master_id'];
                if((int)$row['master_id'] > 1){
                   
                    mysql_query("DELETE FROM emails WHERE email_address = '".$row['email_address']."'");
                    $delete_count++;
                }
                
            }
        }
        $cv_count++;
    } while ($data = fgetcsv($handle,1000,",","'")); 


    

}
}

$data_total = $num_rows+($count-$delete_count);
$csv_inserted = $cv_count-1;
$data_inserted = $count-$delete_count;
            $message = '<span style="color:#e24139;"> Current Database size: '.$data_total.'<br/>';
            if(isset($message_start)){ 
                
                $message .= 'CSV Records Uploaded: '.$csv_inserted.'<br/>
                Total number of records successfully added: '.$data_inserted.'<br/>
                Duplicates: '.$delete_count.'<br/>';
            }
            $message .= '</span>';
unset($num_rows);
unset($message_start);
mysql_close($link);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GSM Email Generator</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<body>
    <form action="" method="post" enctype="multipart/form-data" name="form1" id="form1">
        <div id="wrapper">
            <div class="wrap">
                <div class="lable_wrap"><label>Upload CSV File:</label></div>
                <div class="input_wrap"><input name="csv" type="file" id="csv" /></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Source:</label></div>
                <div class="input_wrap"><input name="source" type="text" id="source" size="20"/></div>
            </div>
            <div class="wrap">
            <div class="lable_wrap"><label>&nbsp;</label></div>
            <div class="input_wrap"><input name="submit_form" type="submit" id="submit_form"/></div>
            </div>
        </div>
    </form>
    <?php echo $message; ?>
</body>
</html>