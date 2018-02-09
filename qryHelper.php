<?php

include('connect.php');
 
class QryHelper {
	
	function QryHelper()
    {
		$conn = new mysqli("$hostname", "$username", "$password", $database);
	}
	
	function Test()
    {		
	
		$qry = "Select * from location";  
							
		if(!$result2 = $conn->query($qry)){
			die('There was an error running the query [' . $conn->error . ']');
		}
			
		$row2 = mysqli_fetch_assoc($result2);			
		return $row2['location_id'];
	}
}


//Get Closest City
//SELECT latitude, longitude, SQRT( POW( 69.1 * ( latitude - 39.449976 ) , 2 ) + POW( 69.1 * ( - 76.628915 - longitude ) * COS( latitude / 57.3 ) , 2 ) ) //AS distance
//FROM Location
//HAVING distance <25
//ORDER BY distance
//LIMIT 0 , 30

?>