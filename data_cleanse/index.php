<?php

include('db_connect.php');

$message = '';
if(isset($_POST['submit_form'])){
    
    mysql_select_db('gsmstock_master', $link);
    
    $email = mysql_real_escape_string($_POST['email']);
    $title = mysql_real_escape_string($_POST['title']);
    $first_name = mysql_real_escape_string($_POST['first_name']);
    $last_name = mysql_real_escape_string($_POST['last_name']);
    $company_name = mysql_real_escape_string($_POST['company_name']);
    $phone_number = mysql_real_escape_string($_POST['phone_number']);
    $mobile_number = mysql_real_escape_string($_POST['mobile_number']);
    $address_line_1 = mysql_real_escape_string($_POST['address_line_1']);
    $address_line_2 = mysql_real_escape_string($_POST['address_line_2']);
    $town_city = mysql_real_escape_string($_POST['town_city']);
    $county = mysql_real_escape_string($_POST['county']);
    $country = mysql_real_escape_string($_POST['country']);
    $post_code = mysql_real_escape_string($_POST['post_code']);
    $website = mysql_real_escape_string($_POST['website']);
    $business_sectors = mysql_real_escape_string($_POST['business_sectors']);
    $other_sectors = mysql_real_escape_string($_POST['other_sectors']);
    $vat_tax = mysql_real_escape_string($_POST['vat_tax']);
    $company_number = mysql_real_escape_string($_POST['company_number']);
    $language = mysql_real_escape_string($_POST['language']);
    $facebook = mysql_real_escape_string($_POST['facebook']);
    $twitter = mysql_real_escape_string($_POST['twitter']);
    $gplus = mysql_real_escape_string($_POST['gplus']);
    $linkedin = mysql_real_escape_string($_POST['linkedin']);
    $skype = mysql_real_escape_string($_POST['skype']);
    
    mysql_query("UPDATE master_data SET
                                    email_address = '".strtolower($email)."',
                                    title = '".$title."', 
                                    first_name = '".$first_name."', 
                                    last_name = '".$last_name."',
                                    company_name ='".$company_name."', 
                                    phone_number = '".$phone_number."',
                                    mobile_number = '".$mobile_number."',
                                    address_line_1 = '".$address_line_1 ."',
                                    address_line_2 = '".$address_line_2."',
                                    town_city = '".$town_city."',
                                    county = '".$county."',
                                    country = '".$country."',
                                    post_code = '".$post_code."',
                                    website = '".$website."',
                                    business_sectors = '".$business_sectors."',
                                    other_sectors = '".$other_sectors."',
                                    vat_tax = '".$vat_tax."',
                                    company_number = '".$company_number."',
                                    language = '".$language."',
                                    facebook = '".$facebook."',
                                    twitter = '".$twitter."',
                                    gplus = '".$gplus."',
                                    linkedin = '".$linkedin."',
                                    skype = '".$skype."',
                                    date_updated = '".date('Y-m-d H:i:s')."'
                                    WHERE email_address = '".$email."'
                ") or die (mysql_error());
		
    $message = '<span style="color:#e24139;">That has been processed successfully</span>';
    mysql_close($link);
    
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GSM Data Auto Complete</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
        	$("#email").autocomplete({
				source: "search.php",
				minLength: 2,
				select: function (event, ui) {	
					var item = ui.item;
                                        $("#title").val(item.title);
					$("#first_name").val(item.first_name);
					$("#last_name").val(item.last_name);
                                        $("#company_name").val(item.company_name);
                                        $("#phone_number").val(item.phone_number);
                                        $("#mobile_number").val(item.mobile_number);
                                        $("#address_line_1").val(item.address_line_1);
                                        $("#address_line_2").val(item.address_line_2);
                                        $("#town_city").val(item.town_city);
                                        $("#county").val(item.county);
                                        $("#country").val(item.country);
                                        $("#post_code").val(item.post_code);
                                        $("#website").val(item.website);
                                        $("#business_sectors").val(item.business_sectors);
                                        $("#other_sectors").val(item.other_sectors);
                                        $("#vat_tax").val(item.vat_tax);
                                        $("#company_number").val(item.company_number);
                                        $("#language").val(item.language);
                                        $("#facebook").val(item.facebook);
                                        $("#twitter").val(item.twitter);
                                        $("#gplus").val(item.gplus);
                                        $("#linkedin").val(item.linkedin);
                                        $("#skype").val(item.skype);
				}
			});
});
</script>
</head>
<body>
    <form action="" method="post">
        <div id="wrapper">
            <div class="wrap">
                <div class="lable_wrap"><label>Email:</label></div>
                <div class="input_wrap"><input name="email" type="text" id="email" size="20" /></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Title:</label></div>
                <div class="input_wrap"><input name="title" type="text" id="title" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>First Name:</label></div>
                <div class="input_wrap"><input name="first_name" type="text" id="first_name" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Surname:</label></div>
                <div class="input_wrap"><input name="last_name" type="text" id="last_name" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Company Name:</label></div>
                <div class="input_wrap"><input name="company_name" type="text" id="company_name" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Phone:</label></div>
                <div class="input_wrap"><input name="phone_number" type="text" id="phone_number" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Mobile:</label></div>
                <div class="input_wrap"><input name="mobile_number" type="text" id="mobile_number" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Address Line 1:</label></div>
                <div class="input_wrap"><input name="address_line_1" type="text" id="address_line_1" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Address Line 2:</label></div>
                <div class="input_wrap"><input name="address_line_2" type="text" id="address_line_2" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>City:</label></div>
                <div class="input_wrap"><input name="town_city" type="text" id="town_city" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>County:</label></div>
                <div class="input_wrap"><input name="county" type="text" id="county" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Country:</label></div>
                <div class="input_wrap"><input name="country" type="text" id="country" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Postcode:</label></div>
                <div class="input_wrap"><input name="post_code" type="text" id="post_code" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Website:</label></div>
                <div class="input_wrap"><input name="website" type="text" id="website" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Business Sector 1:</label></div>
                <div class="input_wrap"><input name="business_sector_1" type="text" id="business_sector_1" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Business Sector 2:</label></div>
                <div class="input_wrap"><input name="business_sector_2" type="text" id="business_sector_2" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>VAT Number:</label></div>
                <div class="input_wrap"><input name="vat_tax" type="text" id="vat_tax" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Company Number:</label></div>
                <div class="input_wrap"><input name="company_number" type="text" id="company_number" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Language:</label></div>
                <div class="input_wrap"><input name="language" type="text" id="language" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Facebook:</label></div>
                <div class="input_wrap"><input name="facebook" type="text" id="facebook" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Twitter:</label></div>
                <div class="input_wrap"><input name="twitter" type="text" id="twitter" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Google +:</label></div>
                <div class="input_wrap"><input name="gplus" type="text" id="gplus" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Linkedin:</label></div>
                <div class="input_wrap"><input name="linkedin" type="text" id="linkedin" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Skype:</label></div>
                <div class="input_wrap"><input name="skype" type="text" id="skype" size="20"/></div>
            </div>
            <div class="wrap">
                <div class="lable_wrap"><label>Role:</label></div>
                <div class="input_wrap"><input name="role" type="text" id="role" size="20"/></div>
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