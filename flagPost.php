<?php 
require_once("./include/membersite_config.php");

//Make sure we have a post id
if (!(isset( $_POST['postId'] )))  
	{
		$fgmembersite->RedirectToURL("index.php");
	}
		
		
else 
{	
	$postId = $_POST['postId'];
	
	//Make sure this is a post id
	if (is_numeric($postId)) {

		if ($fgmembersite->AlertFlaggedPost($postId)) 
		{
			echo "<script>
						alert('Thank you for your help, your flag has been submitted.');
						window.location.href='post.php?id=$postId';
				   </script>";		
		}
		
		else 
		{
			$fgmembersite->Alert('Something went wrong, please try again.');
		}
		
	}
	
	else 
	{
		$fgmembersite->Alert('Something went wrong, please try again.');
	}
}	

	



?>