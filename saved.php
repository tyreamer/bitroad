<?php
	require_once("./include/membersite_config.php");	

		//check for a search param
	if (isset($_GET['qry'])) 	{
		//This search parameter was not long enough
		if (strlen($_GET['qry']) < 2) 
		{
			$key = NULL;
		}
		else 
		{
			$key = $_GET['qry'];
		}
	
	}
	else {
		$key = NULL;
	}
?>

<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta property="og:url"           content="http://bitroad.org/" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Bit Road" />
<meta property="og:description"   content="Local Cryptocurrency Economy" />
<meta property="og:image" content="" />

  <title>Bit Road</title>

  <!-- Bootstrap core CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="mainStyle.css">
<link rel="stylesheet" href="searchsaved.css">
<link rel="icon" href="images/smallLogo.jpg">
  
  
<style>

 
#search-bar {
	width: 100%;
}

#post-search hr{
	margin: 0;
	padding: 0;
}

</style>

<body>
<div class="col-lg-2 col-sm-2"></div>
<div class="col-lg-8 col-sm-8 jumbotron" style="padding-top: 0; margin-bottom: 0; background-color: #fff;">
		<div class="row">
				<div class="col-md-12">
					<div class="col-xs-4"><a href="#" onclick="goHome()"><img class="img-responsive" height=90px width=90px src="images/fullLogo.png" id="logo"></img></a></div>
				</div>
		</div>
		
		<div class="row" id="search-header">
			<div class="header-wrapper" style="background-color: #fff;"><center><h1 class="glyphicon glyphicon-heart" style="color: red"></h1></center>
			</div>
		</div>
		<br/>
		<div class="row" id="post-search">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row">
					<form class="form-horizontal" method="GET" action="saved.php" role="search">
						<div class="input-group" style="padding: 0px 10px 0px 10px;">
						  <input type="text" class="form-control" name="qry" placeholder="<?php if ($key != null) { echo $key; } else {echo 'Search Saved';}?>" id="searchText" type="text">
						  <span class="input-group-btn">
							<button type="submit" class="btn btn-default" style="height: 34px;"><span class="glyphicon glyphicon-search"></span></button>
						</div>
					</form>
				</div>
				<hr/>
				<!-- <div class="row">
					<center><small><i class="glyphicon glyphicon-lg glyphicon-menu-left"></i> Page 1 of 20 <i class="glyphicon glyphicon-menu-right"></i></small></center>
				</div>
				-->
				<hr/>
				<br/>
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row" id="results">
			<div class="col-md-12">
				<div class="list-group" id="all-posts">
					
					
					
				</div>
			</div>
		</div>
</div>
<div class="col-lg-2 col-sm-2"></div>
<div id="footerDiv"></div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>

		function goHome() {			
			
			//Check if localStorage exists 
			if (localStorage.getItem("location") != null) 
			{	
				var url = "http://www.bitroad.org/home.php?loc=" + localStorage.getItem("location");
				window.location.href = url;
			}
			
			//Go get a location
			else 
			{
				window.location.href = "http://www.bitroad.org/index.php";
			}
		}
		
		
</script>

<script>



$( document ).ready(function() {
		
			//Check if localStorage exists 
			if (localStorage.getItem("saved_posts") != null) 
			{			
				//Check for a null saved_posts
				if (JSON.parse(localStorage["saved_posts"]) != '') 
				{
					//Get the localStorage array
					var saved_posts = JSON.parse(localStorage["saved_posts"]);
					
					//Make sure we have no nulls in the array
					$.each(saved_posts,function(key, value) 
					{
						if (value == null) 
						{
							//Remove it from the array
							saved_posts = jQuery.grep(saved_posts, function( a ) {
										  return ( a !== value );
										});
							//Update the localStorage	
							localStorage["saved_posts"] = JSON.stringify(saved_posts);
						}
					});
					
					var qry = '<?php echo $key; ?>';
					$.ajax({											
								type: "POST",
								url: "loadSavedPosts.php",
								data: {postArr : saved_posts, qry : qry},
								cache: false,
								success: function(msg){
											$('#all-posts' ).append( msg );
																					
											if(!msg){
												
											}												
										}
							}); 	
				}

				else {
					$('#all-posts' ).html('<div class="alert alert-warning absolute-center"><strong>We could not find any saved posts. Please <a href="#" onclick="goHome()"> Go Back</a> and try again.</div>');
				}				
			}
			
			
			else 
			{
				$('#all-posts' ).html('<div class="alert alert-warning absolute-center"><strong>We could not find any saved posts. Please <a href="#" onclick="goHome()">  Go Back</a> and try again.</div>');
			}	
			


$('.glyphicon-heart').click(function(event){
   if ($(this).hasClass('favorite-icon')) {  
		event.preventDefault();
		return false;		
	}	
});

		// Save Posts
			
			$(document).on('click', '.favorite-icon', function(){
				event.preventDefault();
				//Get the id of the post to be saved
				var save_post_id = $(this).closest('.search-listing').attr('id');
					
				//Check if localStorage exists 
				if (localStorage.getItem("saved_posts") != null) 
				{	
					//Get the localStorage array
					var saved_posts = JSON.parse(localStorage["saved_posts"]);
					
					//Make sure we don't already have this saved
					if (jQuery.inArray(save_post_id, saved_posts) == -1) 
					{
						saved_posts.push(save_post_id);
						localStorage["saved_posts"] = JSON.stringify(saved_posts);
						
						//Highlight it red
						$(this).css('color', 'red');
					}

					else 
					{
						//Remove it from the array
						saved_posts = jQuery.grep(saved_posts, function( a ) {
										  return ( a !== save_post_id );
										});
						//Update the localStorage	
						localStorage["saved_posts"] = JSON.stringify(saved_posts);
						
						//Remove the red color
						$(this).css('color', 'black');
						
						//Remove the post
						$(this).closest('.search-listing').remove();
						
						if ($('.search-listing').length == 0) {
							$('#all-posts' ).html('<div class="alert alert-warning absolute-center"><strong>You have no more saved posts. Please <a href="home.php?loc=<?php echo $location ?>"> Go Back</a> and try again.</div>');
						}
					}
					
				}
				
				//Create a new array and save the post
				else 
				{		
					var post = [save_post_id];
					localStorage["saved_posts"] = JSON.stringify(post);
					
					//Highlight it red
					$(this).css('color', 'red');
				}	
			});
			
		//END Save Posts
		
});


//Footer
$('#footerDiv').load('footer.html').trigger("create");
</script>

</body>
</html>

