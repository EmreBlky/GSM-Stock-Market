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
    mysql_select_db('gsmstock_secure');
}

function random_string($type = 'alnum', $len = 8)
{
    switch ($type)
    {
            case 'alpha'	:	$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
            case 'alnum'	:	$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    break;
            case 'numeric'	:	$pool = '0123456789';
                    break;
            case 'nozero'	:	$pool = '123456789';
                    break;
    }

    $str = '';
    for ($i=0; $i < $len; $i++)
    {
            $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
    }
    return $str;
}

$qry = mysql_query("SELECT * FROM company") or die (mysql_error());

while($rowMember = mysql_fetch_array($qry)) {
    
    $invitation_code = $rowMember['id'].'-'.random_string('alnum', 3).'-'. random_string('alnum', 3).'-'. random_string('alnum', 3);

    mysql_query("UPDATE company SET invitation_code = '".$invitation_code."' WHERE id = '".$rowMember['id']."'") or die (mysql_error());
    //echo '<pre>';
    //print_r($rowMember);
    //echo $rowMember['id'].'<br/>';
    //exit;
	
  
}
  //mysql_query("UPDATE members SET gsm_check = 'yes' WHERE id = '".$rowMember['id']."'") or die (mysql_error());




?>