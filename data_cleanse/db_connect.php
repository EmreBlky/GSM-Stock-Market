<?php

//$link = mysql_connect('109.203.125.38', 'gsmstock_admin', 'zv.4qAb17ph$;?$PF!') or die("Database Error");	
$link = mysql_connect('localhost', 'root', 'Rwt189K72');

if(! $link )
{
  die('Could not connect: ' . mysql_error());
}

