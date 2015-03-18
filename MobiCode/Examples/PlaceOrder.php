<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MOBICODE API : Examples : PlaceOrder</title>
<style type="text/css">
<!--
	body, td {
		font-family: Arial;
		font-size: 11px;
		color: #333333;
		white-space: nowrap;
	}

	td {
		border-width: 0px 0px 1px 1px;
		border-style: dotted;
		border-color: #DDDDDD;
		padding: 2px;
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
<h1>PlaceOrder</h1>
<p>We cannot show a live example for PlaceOrder, please change the source code to place an order.</p>
<?
	/* Include the library */
	require('../Library/API.php');
	define('SANDBOX', true);
	
	/* Call the API */
	$XML = MOBICODE::CallAPI('PlaceOrder', array('Tool' => '2-55', 'IMEI'=>'354683302058487', 'Email'=> 'nextgenserver@gmail.com', 'Comments'=>'Reference or comment',
	'Mobile'=>'741', 'Network'=>'252'));
	/*
	, 'Provider'=> '1234567898765', 'PIN'=>'1234qwer', 'KBH'=>'qwertyuiop', 'MEP'=>'MEP-12347-123', 'PRD'=>'PRD-12345-123',
	'Type'=>'String', 'Locks'=>'NCK, NSCK, SPK, CCK, ESL', 'SMS'=>'447971406330'
	*/
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
				print('<b>' . htmlspecialchars($Data['Success']) . '</b>');
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