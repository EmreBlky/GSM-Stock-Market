<?php

//echo '<pre>';
//print_r($notification);

?>
<?php 
    echo $this->session->flashdata('confirmation'); 
?>
<form action="notification/updateProfile" method="post">
<?php if($notification->report_views == 'yes') {?>
    PROFILE VIEWS <input type="radio" name="report_views" value="yes" checked/> YES <input type="radio" name="report_views" value="no"/> NO
<?php } else {?>
    PROFILE VIEWS <input type="radio" name="report_views" value="yes"/> YES <input type="radio" name="report_views" value="no" checked/> NO
<?php }?>
<br/>
<?php if($notification->email_members == 'yes') {?>
    Mailbox Messages <input type="radio" name="email_members" value="yes" checked/> YES <input type="radio" name="email_members" value="no"/> NO
<?php } else {?>
    Mailbox Messages <input type="radio" name="email_members" value="yes"/> YES <input type="radio" name="email_members" value="no" checked/> NO
<?php }?>
<br/>
<?php if($notification->email_market == 'yes') {?>
    Mailbox Market <input type="radio" name="email_market" value="yes" checked/> YES <input type="radio" name="email_market" value="no"/> NO
<?php } else {?>
    Mailbox Market <input type="radio" name="email_market" value="yes"/> YES <input type="radio" name="email_market" value="n" checked/> NO
<?php }?>
<br/>
<?php if($notification->email_support == 'yes') {?>
    Mailbox Support <input type="radio" name="email_support" value="yes" checked/> YES <input type="radio" name="email_support" value="no"/> NO
<?php } else {?>
    Mailbox Support <input type="radio" name="email_support" value="yes"/> YES <input type="radio" name="email_support" value="no" checked/> NO
<?php }?>

<br/>
<input type="submit" value="submit"/>
</form>
