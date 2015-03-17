<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>MOBICODE API : Examples : GetToolMobiles</title>
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
<h1>GetToolMobiles</h1>
<?
	/* Include the library */
	require('../Library/API.php');
	
	/*
	 * First, let's search for a tool that needs the mobile phone model
	 * ================================================================
	 */

	$Found = false;
	
	/* Call the API */
	$XML = MOBICODE::CallAPI('GetTools');
	
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
				foreach ($Data['Group'] as $Group)
				{
					foreach ($Group['Tool'] as $Tool)
					{
						if ($Tool['Requires.Mobile'] != 'None')
						{
							/* We found a candidate for GetToolMobiles */
							$Found = true;
							break 2;
						}
					}
				}
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

	/*
	 * Now, let's call GetToolMobiles for this tool
	 * ============================================
	 */
	
	if ($Found)
	{
		print('<p>List of the mobile phones supported by the tool <b>' . htmlspecialchars($Tool['Name']) . '</b></p>');

		/* Call the API */

		$XML = MOBICODE::CallAPI('GetToolMobiles', array('ID' => $Tool['ID']));
		
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
					foreach ($Data['Mobile'] as $Mobile)
					{
						print(htmlspecialchars($Mobile['Name']));
						print('<br />');
					}
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
	}
?>
<p><a href="./">Go back</a></p>
</body>
</html>