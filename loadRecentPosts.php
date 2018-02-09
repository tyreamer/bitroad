<?PHP

require_once("./include/membersite_config.php");


			

//Make sure we have a category and location
if (!(isset($_POST['loc']))) 
{	
	return false;
}

		$postArr = $fgmembersite->GetRecentPosts($_POST['loc']);	
		
		for ($i = 0; $i < sizeOf($postArr); $i++) {
			
			//Get post details
			$post_id		= $postArr[$i]['post_id'];		
			$title 			= $postArr[$i]['title'];	
			$date 			= $postArr[$i]['date'];	
			$price 			= $postArr[$i]['price'];
			$currency 		= $postArr[$i]['currency'];			
			$spec_location	= $postArr[$i]['specific_location'];
			$category		= $postArr[$i]['category'];
			
			
			?>
   		
		<div class="row">
			<a href="post.php?id=<?php echo $post_id; ?>"> 
				<div class="col-xs-12" style="background-color: #fff;">
					<center>
						<h4><?php echo $title ?></h4>
						<h6><?php echo $price ?> <?php echo $currency ?></h6>
						<h6><?php echo $category ?></h6>
					</center>
				</div>
			</a>
			<center><h1 style="margin: 0; padding: 0;">.</h1></center>
		</div>
		

<?php 
}//for

?>