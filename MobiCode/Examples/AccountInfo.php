<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MobiCode API : Examples : AccountInfo</title>
<style type="text/css">
<!--
	body {
		font-family: Arial;
		font-size: 13px;
		color: #333333;
	}

	h1 {
		font-size: 16px;
	}

	a {
		color: #6699CC;
	}
	
	a:hover {
		text-decoration: none;
	}
-->
</style>
</head>

<body>
<h1>AccountInfo</h1>
<?
	/* Include the library */
	require('../Library/API.php');
	
	
	/* Call the API */
	$XML = MOBICODE::CallAPI('AccountInfo');
	
	if (is_string($XML))
	{
		/* Parse the XML stream */
		$Data = MOBICODE::ParseXML($XML);
		
		if (is_array($Data))
		{
			if (isset($Data['Error']))
			{
				/* The API has returned an error */
				print('API error : ' . htmlspecialchars($Data['Error']));
			}
			else
			{
				/* Everything works fine */
				printf('Account email : <b>%s</b>', htmlspecialchars($Data['Email']));
				printf('<br />');
				printf('Credits available : <b>%s</b>', htmlspecialchars($Data['Credits']));
				printf('<br />');
				printf('Currency : <b>%s</b>', htmlspecialchars($Data['Currency']));
				printf('<br />');
				printf('Current Server Time : <b>%s</b>', htmlspecialchars($Data['Server.Time']));
			}
		}
		else
		{
			/* Parsing error */
			print('Could not parse the XML stream');
		}
	}
	else
	{
		/* Communication error */
		print('Could not communicate with the api');
	}
?>
<p><a href="./">Go back</a></p>
</body>
</html>