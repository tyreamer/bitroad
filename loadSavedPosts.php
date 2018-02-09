<?PHP

require_once("./include/membersite_config.php");

//Make sure we have a category and location
if (!(isset($_POST['postArr']))) 
{
	return false;
}

if (isset($_POST['qry'])) 
{
  $key = $_POST['qry'];
}	
else {
   $key = '';
}
		$postArr = $fgmembersite->GetPostsFromArray($_POST['postArr'], $key);		
		
		for ($i = 0; $i < sizeOf($postArr); $i++) {
			
			//Get post details
			$post_id		= $postArr[$i]['post_id'];		
			$title 			= $postArr[$i]['title'];	
			$date 			= $postArr[$i]['date'];	
			$price 			= $postArr[$i]['price'];
			$currency 		= $postArr[$i]['currency'];			
			$spec_location	= $postArr[$i]['specific_location'];
			?>
   		
		<a href="post.php?id=<?php echo $post_id; ?>">
									<div class="panel search-listing" id="<?php echo $post_id; ?>">
											<div class="panel-heading" style="background-color: #f5f5f5;">				
												<!-- Top Row -->
												<h4><?php echo $title ?></h4>
											</div>
											<div class="panel-body">					
												<div class="col-xs-2">
													<div class="col-xs-12"><center><h4 class="glyphicon glyphicon-heart favorite-icon" style="color: red"></h4></center></div>
												</div>
												<div class="col-xs-10">
													<a href="post.php?id=<?php echo $post_id; ?>">														
																											
															
															<!-- Middle Row -->
															<div class="col-xs-4"><center><i class="glyphicon glyphicon-time"> </i> </center></div>
															<div class="col-xs-4"><center><i class="glyphicon glyphicon-map-marker"> </i> </center></div>
															<div class="col-xs-4"><center><img src="https://coinmarketcap.com/static/img/coins/16x16/<?php echo $currency  ?>.png"> </center></div>
															
															
															<!-- bottom row -->
															<div class="col-xs-4" id="post-date"><center> <h6><?php echo $fgmembersite->humanTiming(strtotime($date)); ?>	</h6></center></div>
															<div class="col-xs-4" id="post-location"><center><h6><?php echo $spec_location ?></h6></center></div>
															<div class="col-xs-4" id="post-price"><center><h6><?php echo $price ?> <?php echo $currency ?></h6></div> <!-- Harcoded images for now -->
														</div>
													</a>
											</div>
									</div>		
									</a>	

<?php 
}//for

?>