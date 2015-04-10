<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MOBICODE API : Examples : GetOrders</title>
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
<h1>GetOrders</h1>
<?
	/* Include the library */
	require('../Library/API.php');
	
	/* Call the API */
	//$XML = MOBICODE::CallAPI('GetOrders', array('IMEI'=>'358794049842491', 'ID'=>'868')); //, array('Status'=>'Delivered', 'Available'=>'True', 'Tool'=>'2-231', 'Mobile'=>'1', 'Network'=>'1', 'IMEI'=>'358150044060433', 'ID'=>'1234', 'DateFrom'=>'2012-01-26', 'DateTo'=>'2012-03-26 ', 'DeliveryFrom'=>'2012-01-26', 'DeliveryTo'=>'2012-03-26 '));
	$XML = MOBICODE::CallAPI('GetOrders');
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
				print('<table>');

				/* We will print only these fields */
				$Fields = array('ID', 'Date', 'IMEI', 'Credits', 'Tool', 'Status', 'Available', 'Delivery', 'Codes');
				
				print('<tr>');
				foreach ($Fields as $Field) print('<td><b>' . htmlspecialchars($Field) . '</b></td>');
				print('</tr>');

				foreach ($Data['Order'] as $Order)
				{
					print('<tr>');
					foreach ($Fields as $Field)
					{
						print('<td>');
						if (isset($Order[$Field])) print(htmlspecialchars($Order[$Field]));
						else print('&nbsp;');
						print('</td>');
					}
					print('</tr>');
				}
				
				print('</table>');
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