<?php

require_once("./include/membersite_config.php");

//Get the user's ip address
	 $ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';

if (isset($_POST['phone']) && isset($_POST['category']) && isset($_POST['location']) ) 
{
$fgmembersite->Alert($fgmembersite->NotSpamming($_POST['phone'], $_POST['category'], $_POST['location'], $ipaddress))	;
	if ($fgmembersite->NotSpamming($_POST['phone'], $_POST['category'], $_POST['location'], $ipaddress)) 
	{
		return 'not spam';
	}
	
	else 
	{
		return 'spam';
	}
}

?>