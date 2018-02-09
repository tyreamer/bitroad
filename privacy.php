<?php
	require_once("./include/membersite_config.php");	
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
<link rel="icon" href="images/smallLogo.jpg">
  
  
<body style="text-transform: none;">
<div class="col-lg-2 col-sm-2"></div>
<div class="col-lg-8 col-sm-8 jumbotron" style="padding-top: 0; padding-left: 0; background-color: #fff;">
		<div class="row">
				<div class="col-md-10">
					<div class="col-xs-4"><a href="#" onclick="goHome()"><img class="img-responsive" height=90px width=90px src="images/fullLogo.png" id="logo"></img></a></div>
				</div>
		</div>
		
		<div class="row" id="search-header">
			<div class="header-wrapper">
				<hr/>
				<center><h1>Privacy Policy</h1></center>
				<hr/>
			</div>
		</div>
		<div class="row absolute-center">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				<div class="row">
                                       
<h4>
This policy details how data about you is used when you access our websites and services (together, “Bit Road") or interact with us. If we update it, we will revise the date, place notices on Bit Road if changes are material, and/or obtain your consent as required by law.
<br/><hr/>
<h3>1. Protecting your privacy</h3><br/>
    • We take precautions to prevent unauthorized access to or misuse of data about you.<br/>
    • We do not run ads, other than the classifieds posted by our users.<br/>
    • We do not share your data with third parties for marketing purposes.<br/>
    • We do not engage in cross-marketing or link-referral programs.<br/>
    • We do not employ tracking devices for marketing purposes.<br/>
    • We do not send you unsolicited communications for marketing purposes.<br/>
    • We do not engage in affiliate marketing (and prohibit it on Bit Road).<br/>
    • Please review privacy policies of any third party sites linked to from Bit Road.<br/>
 <br/><hr/>
<h3>2. Data we use to provide/improve our services and/or combat fraud/abuse:</h3><br/>
    • data you post on or send via Bit Road, and/or send us directly or via other sites<br/>
    • data you submit or provide (e.g. name, address, email, phone, fax, photos, tax ID).<br/>
    • web log data (e.g. web pages viewed, access times, IP address, HTTP headers).<br/>
    • data collected via cookies (e.g. search data and "favorites" lists).<br/>
    • data about your device(s) (e.g. screen size, DOM local storage, plugins).<br/>
    • data from 3rd parties (e.g. phone type, geo-location via IP address).<br/>
 <br/><hr/>
<h3>3. Data we store</h3><br/>
    • We retain data as needed for our business purposes and/or as required by law.<br/>
    • We make good faith efforts to store data securely, but can make no guarantees.
   <br/><hr/>
 
<h3>4. Circumstances in which we may disclose user data:</h3><br/>
    • to vendors and service providers (e.g. payment processors) working on our behalf.<br/>
    • to respond to subpoenas, search warrants, court orders, or other legal process.<br/>
    • to protect our rights, property, or safety, or that of users of Bit Road or the general public.<br/>
    • with your consent (e.g. if you authorize us to share data with other users).<br/>
    • in connection with a merger, bankruptcy, or sale/transfer of assets.<br/>
    • in aggregate/summary form, where it cannot reasonably be used to identify you.<br/>
 <br/><hr/>
<h3>International Users</h3> By accessing Bit Road or providing us data, you agree we may use and disclose data we collect as described here or as communicated to you, transmit it outside your resident jurisdiction, and store it on servers in the United States.
 <br/><hr/>

 

</h4>
</div>
			</div>
			<div class="col-xs-1"></div>
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

//Footer
$('#footerDiv').load('footer.html').trigger("create");


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


</script>

</body>
</html>


