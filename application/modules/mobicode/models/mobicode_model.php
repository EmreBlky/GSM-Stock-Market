<?
	/*
    
		This is a PHP 4/5 library for connecting the MobiCode API (v2)

		It supposes that you have cURL installed.
		If it is not the case, please ask your system administrator.
		More information : http://www.php.net/curl

		If you need assistance, please contact server@mobi-server.com
	*/

	/* Enter your API key here */

	//define('MOBICODE_API_KEY', '(4DF7-D3D1-73F7-AF15)'); // user_1
	
	/* Set this value to true if something goes wrong and you want to display error messages */
	
	define('MOBICODE_API_DEBUG', false);
	
	/* This is the url of the api, don't change it */

	define('MOBICODE_API_URL', 'http://www.mobi-server.com/api/v2/interface.php');
	
	/*
		To allow MOBICODE class functions to be called statically - e.g. MOBICODE::Function()
		and to keep backward compatibility with PHP4, some variables to be shared between
		member functions will be allocated globally. Their names are listed below.
		This is just for information, as they almost certainly won't interact in any way with your scripts.
		If you did not understand the above, this is not important :-)
		
		For the same reason (backward compatibility), you may experience warnings such as :
		Strict standards : Non-static method MOBICODE:: ... () should not be called statically
		In this case, change your error reporting directive to remove the E_STRICT level,
		Or, if this is not acceptable to you, add a static keyword in front of each function name in this file.
	*/
	
	define('MOBICODE_VARIABLE_ERROR',    '_MOBICODEError'    );
	define('MOBICODE_VARIABLE_ARRAY',    '_MOBICODEArray'    );
	define('MOBICODE_VARIABLE_POINTERS', '_MOBICODEPointers' );
	
	/* Check that cURL is installed */
	
	if (! extension_loaded('curl'))
	{
		trigger_error('cURL extension not installed', E_USER_ERROR);
	}
	
	/* Here comes the main class */
	
	class Mobicode_model extends MY_Model
	{
		function __construct()
		{
			$query = $this->db->get_where('imei_accounts', array('member_id' => $this->session->userdata('members_id')));

			if ($query->num_rows() > 0)
			{
				$row = $query->row();
				define('MOBICODE_API_KEY', $row->api_key);
			}
			else
			{
				define('MOBICODE_API_KEY', '(4DF7-D3D1-73F7-AF15)');
			}
		}

		/*
			mixed MOBICODE::CallAPI (string $Action, array $Parameters)
			Call the MOBICODE API.
			Returns the xml stream sent by the MOBICODE server
			Or false if an error occurs
		*/

		function CallAPI ( $Action, $Parameters = array() )
		{
			
			if (is_string($Action))
			{
				if (is_array($Parameters))
				{
					/* Add the API Key and the Action to the parameters */
					$Parameters['Key'] = MOBICODE_API_KEY;
					$Parameters['Action'] = $Action;
					$postfields = static::BuildQuery($Parameters);
					if (preg_match('/Examples/', $_SERVER['REQUEST_URI'])) {
						print '<hr>Sending to the server<br><textarea name="textarea" id="textarea" cols="120" rows="5">'.$postfields.'</textarea>';
					}
					
					/* Prepare the cURL session */
					$Ch = curl_init(MOBICODE_API_URL);		
					curl_setopt($Ch, CURLOPT_CONNECTTIMEOUT, 10);
					curl_setopt($Ch, CURLOPT_TIMEOUT, 60);
					curl_setopt($Ch, CURLOPT_HEADER, false);
					curl_setopt($Ch, CURLOPT_RETURNTRANSFER, true);
					curl_setopt($Ch, CURLOPT_ENCODING, '');
					curl_setopt($Ch, CURLOPT_POST, true);
					curl_setopt($Ch, CURLOPT_POSTFIELDS, $postfields);
					
					/* Perform the session */
					$Data = curl_exec($Ch);
					if (preg_match('/Examples/', $_SERVER['REQUEST_URI'])) {
						print '<hr>Received From Server<br><textarea name="textarea" id="textarea" cols="120" rows="5">'.$Data.'</textarea><hr>';
					}
					if (MOBICODE_API_DEBUG && curl_errno($Ch) != CURLE_OK)
					{
						/* If an error occurred, report it in debug mode */
						trigger_error(curl_error($Ch), E_USER_WARNING);
					}
					
					/* Close the session */
					curl_close($Ch);
					//print $Data;
					/* Return the data, or false if an error occurred */
					return $Data;
				}
				else trigger_error('Parameters must be an array', E_USER_WARNING);
			}
			else trigger_error('Action must be a string', E_USER_WARNING);
			
			return false;
		}

		/*
			mixed MOBICODE::ParseXML (string $XML)
			Parse an XML stream from the MOBICODE API.
			Returns an associative array of the parsed XML string
			Or false if an error occurs
		*/
		
		function ParseXML ( $XML )
		{
			if (! is_string($XML))
			{
				/* If the argument is not a string, report the error in debug mode & stop here */
				if (MOBICODE_API_DEBUG) trigger_error('Invalid argument supplied for MOBICODE::ParseXML()', E_USER_WARNING);
				return false;
			}

			/* Globalize variables */
			global ${MOBICODE_VARIABLE_ERROR}    ;
			global ${MOBICODE_VARIABLE_ARRAY}    ;
			global ${MOBICODE_VARIABLE_POINTERS} ;

			/* Initialize variables */
			${MOBICODE_VARIABLE_ERROR}    = false   ;
			${MOBICODE_VARIABLE_ARRAY}    = array() ;
			${MOBICODE_VARIABLE_POINTERS} = array() ;

			/* Configure the parser */
			$Parser = xml_parser_create('UTF-8');
			xml_set_element_handler($Parser, array('MOBICODE', 'XML_Start'), array('MOBICODE', 'XML_End'));
			xml_set_character_data_handler($Parser, array('MOBICODE', 'XML_CData'));
			xml_parser_set_option($Parser, XML_OPTION_CASE_FOLDING, 0);
			
			/* Start parsing, check the success of both parsing and analyzing */
			$Success = xml_parse($Parser, $XML, true) && ! ${MOBICODE_VARIABLE_ERROR};
			
			/* Report errors in debug mode */
			if (MOBICODE_API_DEBUG)
			{
				if (${MOBICODE_VARIABLE_ERROR})
				{
					/* The XML stream has not been recognized */
					trigger_error('Unrecognized XML format', E_USER_WARNING);
				}
				elseif (xml_get_error_code($Parser) != XML_ERROR_NONE)
				{
					/* A parser error occurred */
					trigger_error(xml_error_string(xml_get_error_code($Parser)), E_USER_WARNING);
				}
			}

			/* Free the parser */
			xml_parser_free($Parser);
			
			/* Get a reference to the result */
			$Array =& ${MOBICODE_VARIABLE_ARRAY};
			
			/* Unset global variables */
			unset ( $GLOBALS[MOBICODE_VARIABLE_ERROR]    );
			unset ( $GLOBALS[MOBICODE_VARIABLE_ARRAY]    );
			unset ( $GLOBALS[MOBICODE_VARIABLE_POINTERS] );

			/* Return the result */
			return ($Success ? $Array : false);
		}

		/*
			bool MOBICODE::CheckEmail (string $Email)
			Check the validity of an email address
			This function is *not* RFC 2822 compliant, but instead reflects today's email reality
			Returns true if the email address seems correct, false otherwise
		*/
		
		function CheckEmail ( $Email )
		{
			return (bool) preg_match('/^[0-9a-z_\\-\\.]+@([0-9a-z][0-9a-z\\-]*[0-9a-z]\\.)+[a-z]{2,}$/i', $Email);
		}

		/*
			bool MOBICODE::CheckIMEI (string $IMEI, bool $Checksum)
			Check a 15-digit IMEI serial number.
			You are free to verify the checksum, or not;
			Bad checksums are 99% likely to provide unavailable unlock codes (exceptions exist, however)
			Returns true if the IMEI seems correct, false otherwise
		*/
		
		function CheckIMEI ( $IMEI, $Checksum = true )
		{
			if (is_string($IMEI))
			{
				if (preg_match('/^[0-9]{15}$/', $IMEI))
				{
					if (! $Checksum) return true;

					for ($i = 0, $Sum = 0; $i < 14; $i++)
					{
						$Tmp = $IMEI[$i] * ( ($i % 2) + 1 );
						$Sum += ($Tmp % 10) + intval($Tmp / 10);
					}
					
					return ( ( ( 10 - ( $Sum % 10 ) ) % 10 ) == $IMEI[14] );
				}
			}
			
			return false;
		}
		
		/*
			bool MOBICODE::CheckProviderID (string $ProviderID)
			Verify an Alcatel Provider ID
			Returns true if the Provider ID seems correct, false otherwise
		*/
		
		function CheckProviderID ( $ProviderID )
		{
			return (is_string($ProviderID) && eregi('^[0-9a-z]{4,5}\\-[0-9a-z]{7}$', $ProviderID));
		}
		
		/*
			bool MOBICODE::CheckMEP_PRD (string $Type, string $String)
			Check a MEP/PRD number before submitting it to the API
			$Type is either 'MEP' or 'PRD'
			Returns true if the MEP/PRD seems correct, false otherwise
		*/
		
		function CheckMEP_PRD( $Type, $String )
		{
			return ereg('^' . $Type . '\\-[0-9]{5}\\-[0-9]{3}$', $String);
		}
	
		/* Internal functions - do not care */
		
		function BuildQuery ( $Parameters )
		{
			if (function_exists('http_build_query'))
			{ 
				/* PHP 5 */
				return http_build_query($Parameters);
			}
			else
			{
				/* PHP 4 */
				$Data = array();
				foreach ($Parameters as $Name => $Value) array_push($Data, urlencode($Name) . '=' . urlencode($Value));
				return implode('&', $Data);
			}
		}

		function XML_Start ( $Parser, $Name, $Attributes )
		{
			/* Globalize variables */
			global ${MOBICODE_VARIABLE_ERROR};
			global ${MOBICODE_VARIABLE_ARRAY};
			global ${MOBICODE_VARIABLE_POINTERS};
			
			/* Do nothing if an error occurred previously */
			if (${MOBICODE_VARIABLE_ERROR}) return;

			if (count( ${MOBICODE_VARIABLE_POINTERS} ) == 0)
			{
				/* Root Element : create the first pointer to the array */
				${MOBICODE_VARIABLE_POINTERS}[] =& ${MOBICODE_VARIABLE_ARRAY};
			}
			else
			{
				/* Get the latest pointer */
				$Pointer =& ${MOBICODE_VARIABLE_POINTERS} [ count( ${MOBICODE_VARIABLE_POINTERS} ) -1 ];
				
				if (is_null($Pointer))
				{
					/* This is the first sub-tag with that name, create the new container array for it */
					$Pointer[] = array();
					
					/* Replace the latest pointer, point to the first item of the new container */
					${MOBICODE_VARIABLE_POINTERS}[ count(${MOBICODE_VARIABLE_POINTERS}) -1 ] =& $Pointer[0];
					$Pointer =& $Pointer[0];
				}
				elseif (is_array($Pointer))
				{
					if (isset($Pointer[$Name]))
					{
						if (! is_array($Pointer[$Name]))
						{
							/* Unrecognized XML stream */
							${MOBICODE_VARIABLE_ERROR} = true;
							return;
						}
						
						/* The tag is already known, add an item to the array and create a pointer to it */
						$Pointer[$Name][] = array();
						${MOBICODE_VARIABLE_POINTERS}[] =& $Pointer[$Name][ count($Pointer[$Name]) -1 ];
						return;
					}
				}
				else
				{
					/* Unrecognized XML stream */
					${MOBICODE_VARIABLE_ERROR} = true;
					return;
				}
				
				/* Set the default value and create a pointer to it */
				$Pointer[$Name] = NULL;
				${MOBICODE_VARIABLE_POINTERS}[] =& $Pointer[$Name];
			}
		}
		
		function XML_End ( $Parser, $Name )
		{
			/* Globalize variables */
			global ${MOBICODE_VARIABLE_ERROR};
			global ${MOBICODE_VARIABLE_POINTERS};

			/* Do nothing if an error occurred previously */
			if (${MOBICODE_VARIABLE_ERROR}) return;

			/* Remove the latest pointer */
			array_pop( ${MOBICODE_VARIABLE_POINTERS} );
		}
		
		function XML_CData ( $Parser, $Data )
		{
			/* Ignore whitespaces */
			if (rtrim($Data) == '') return;

			/* Globalize variables */
			global ${MOBICODE_VARIABLE_ERROR};
			global ${MOBICODE_VARIABLE_POINTERS};

			/* Do nothing if an error occurred previously */
			if (${MOBICODE_VARIABLE_ERROR}) return;
			
			/* Get the latest pointer */
			$Pointer =& ${MOBICODE_VARIABLE_POINTERS} [ count( ${MOBICODE_VARIABLE_POINTERS} ) -1 ];
			
			if (is_array($Pointer))
			{
				/* Unrecognized XML stream, should be null or string here */
				${MOBICODE_VARIABLE_ERROR} = true;
				return;
			}
			
			/* Append the character data */
			$Pointer .= $Data;
		}
	}
?>