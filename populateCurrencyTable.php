<?php
		require_once("./include/membersite_config.php");

		$fgmembersite->Alert('---');
	 $currency = array();
		
	for ($i = 0; $i < sizeOf($_POST['currency']); $i++) 
	{
		$path = "https://coinmarketcap.com/static/img/coins/16x16/".$_POST['currency'][$i].".png";		
		array_push($currency, array($_POST['currency'][$i], $path));	
	}

	$success = $fgmembersite->insertCurrency($currency);
	echo json_encode($success);
	
?>