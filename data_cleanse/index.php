<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Auto Complete Input box</title>
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
					$("#firstname").val(item.firstname);
					$("#lastname").val(item.lastname);				
				}
			})
});
</script>
</head>
<body>
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
<div class="input_wrap"><input name="firstname" type="text" id="firstname" size="20"/></div>
</div>
<div class="wrap">
<div class="lable_wrap"><label>Surname:</label></div>
<div class="input_wrap"><input name="lastname" type="text" id="lastname" size="20"/></div>
</div>
<div class="wrap">
<div class="lable_wrap"><label>Company Name:</label></div>
<div class="input_wrap"><input name="company_name" type="text" id="company_name" size="20"/></div>
</div>
<div class="wrap">
<div class="lable_wrap"><label>Phone:</label></div>
<div class="input_wrap"><input name="phone" type="text" id="phone" size="20"/></div>
</div>
<div class="wrap">
<div class="lable_wrap"><label>Mobile:</label></div>
<div class="input_wrap"><input name="mobile" type="text" id="mobile" size="20"/></div>
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
<div class="input_wrap"><input name="city" type="text" id="city" size="20"/></div>
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
<div class="input_wrap"><input name="postcode" type="text" id="postcode" size="20"/></div>
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
</body>
</html>