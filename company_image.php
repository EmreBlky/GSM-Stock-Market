<?php

$url = $_SERVER['SERVER_NAME'];
//exit;
if($url == 'localhost'){
    mysql_connect('localhost', 'root', 'Rwt189K72');
    mysql_select_db('gsmstock_secure');
}
elseif($url == 'secure-dev.gsmstockmarket.com'){
    mysql_connect('alpha.tebihost.com', 'deviousd_gsmdev', 'CnXvfXN^s9w=');
    mysql_select_db('deviousd_gsmdev');
}
else{
    mysql_connect('localhost', 'gsmstock_admin', 'zv.4qAb17ph$;?$PF!');
    mysql_select_db('gsmstock_securelive');
}

function image_name($name){
    
    $name = ltrim($name, 'public/main/template/gsm/images/company/');
    $name = rtrim($name, '.png');
    
    return $name;
}

foreach(glob('public/main/template/gsm/images/company/*.*') as $filename){
    
    if(is_numeric(image_name($filename))){
        //echo image_id(image_name($filename)).'<br/>';
        //echo image_name($filename).'<br/>';
        mysql_query("UPDATE company SET photo = 'yes' WHERE id = '".image_name($filename)."'") or die (mysql_error());
    
    }
    
}

echo 'That has been completed.';