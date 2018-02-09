<?php 
require_once("./include/membersite_config.php");

$fgmembersite->Alert('Submitted');

if ( !(isset(  	$_POST['number'],
				$_POST['location'],
				$_POST['category'],
				$_POST['title'],
				$_POST['price'],
				$_POST['currency'],
				$_POST['description']
			))
	) 
	{
		echo'	<script type="text/javascript">
					alert("Please fill out all required fields and try again");
					window.location = "create-post.php?loc=$_POST["location"]";
					</script>      ';
					return false;
					break;
	}
		
		
else 
{	

			//Prevent SQL Injection
			$email 			= addslashes($_POST['email']);	
			$number			= addslashes( $_POST['number']);
			$location 		= addslashes($_POST['location']);
			$spec_location  = addslashes($_POST['spec_location']);
			$category 		= addslashes($_POST['category']);
			$name 			= addslashes($_POST['name']);
			$title 			= addslashes($_POST['title']);
			$price 			= addslashes($_POST['price']);
			$currency 		= addslashes($_POST['currency']);
			$description 	= addslashes($_POST['description']);

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
			
			
	//Users may only post once every 48 hours in one category/location pair
	if ($fgmembersite->NotSpamming($number, $category, $location, $ip)) 
	{

		//Image Upload Section				
				if (count($_FILES['file']['name']) > 0 && $_FILES['file']['name'][0] != '') {
					
						// Generate a random 8 character name for the image
						// Generate up to 10 times to find a unique name
						$nameLength = 50;
						$tryCount = 10;
						$random = "";
						$tries = 0;
						$validChars = "abcdefghijklmnopqrstuvwxyz0123456789";
						while ($tryCount > 0 && strlen($random) == 0) {
							$tmpName = "";
							for ($i = 0; $i < $nameLength; $i++) {
								$tmpName = $tmpName . substr($validChars, rand(0, strlen($validChars)), 1);
								$tryCount--;
							}
							if (!file_exists('./images/postImages/' . $tmpName)) {
								// Found a name
								$random = $tmpName;
							}
						}
						
						 //Make the unique directory
						mkdir("images/postImages/$random", 0777, false);
					
						
						$j = 0; //Variable for indexing uploaded image 
					
						$target_path = "images/postImages/$random/"; //Declaring Path for uploaded images
						
						//loop to get individual element from the array
						for ($i = 0; $i < count($_FILES['file']['name']); $i++) 
						{

							$validextensions = array("jpeg", "jpg", "JPG", "png");  //Extensions which are allowed
							$ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
							$file_extension = end($ext); //store extensions in the variable
							
							$newFileName = md5(uniqid()) . "." . $ext[count($ext) - 1];
							
							$full_image_path = $target_path . $newFileName;//set the target path with a new name of image
							$j = $j + 1;//increment the number of uploaded images according to the files in array       
						  
						  if (in_array($file_extension, $validextensions)) {
								if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $full_image_path)) 
								{
									$fgmembersite->imageResizing($target_path, $newFileName, 1000, 1000);		
								} 
								else {//if file was not moved.
									$fgmembersite->Alert('Error moving file');
								}
							} else {//if file size and file type was incorrect.
									$fgmembersite->Alert('Invalid file type'.$file_extension);
							}
						}
				} 
				
				else {
					//Assign it a default image
					$target_path = 'images/postImages/default/';
				}				
							
				if (isset($_POST['noSpam']) && $_POST['noSpam'] == 1) {
					$noSpam = 1;
				}
				
				else {
					$noSpam = 0;
				}
				
				if (isset($_POST['displayPhone']) && $_POST['displayPhone'] == 1) {
					$displayPhone = 1;
				}
				
				else {
					$displayPhone = 0;
				}

				
					
			
		//End Image Upload Section
		$postArr = array(
				"chat_name" 		=> $name, 
				"author_email" 		=> $email,
				"author_phone"		=> $number,
				"location" 			=> $location,
				"spec_location"	 	=> $spec_location,
				"category" 			=> $category,
				"title" 			=> $title,
				"price"				=> $price,
				"currency" 			=> $currency,
				"description" 		=> $description,
				"img_folder"		=> $target_path,
				"noSpam"			=> $noSpam,
				"displayPhone"		=> $displayPhone,
				"ipAddress"			=> $ipaddress,
		);
		
		$pid = $fgmembersite->InsertNewPost($postArr);
		$fgmembersite->RedirectToURL("post.php?id=$pid&new=1");
	}
	
	else 
	{
		$fgmembersite->RedirectToURL("home.php?loc=$location&neg=You are posting too often in $location under $category");
	}
		
}	


?>