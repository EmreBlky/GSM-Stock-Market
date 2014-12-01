<?php

//connect to the database 
$link = mysql_connect('109.203.125.38', 'gsmstock_admin', 'zv.4qAb17ph$;?$PF!') or die("Database Error");	
 mysql_select_db('gsmstock_generator', $link);
// 
$source = mysql_real_escape_string($_POST['source']);
if ($_FILES[csv][size] > 0) { 

    //get the csv file
    
    $file = $_FILES[csv][tmp_name]; 
    $handle = fopen($file,"r"); 
     
    //loop through the csv file and insert into database 
    do { 
        if ($data[0]) { 
            mysql_query("INSERT INTO emails (email_address, source, date_created) VALUES 
                ( 
                    '".addslashes($data[0])."', 
                    '".$source."',
                    '".date('Y-m-d H:i:s')."'
                ) 
            ") or die (mysql_error());
        } 
    } while ($data = fgetcsv($handle,1000,",","'")); 
    // 

    $message = '<span style="color:#e24139;">That has been processed successfully</span>';
    mysql_close($link);

}
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