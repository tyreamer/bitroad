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
				<center><h1>Personal Safety</h1></center>
				<hr/>
			</div>
		</div>
		<div class="row absolute-center">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				<div class="row">
                                       

<h3>When meeting someone for the first time, please remember to:</h3>
    • Insist on a public meeting place like a cafe, bank, or shopping center.<br/>
    • Do not meet in a secluded place, or invite strangers into your home.<br/>
    • Be especially careful buying/selling high value items.<br/>
    • Tell a friend or family member where you're going.<br/>
    • Take your cell phone along if you have one.<br/>
    • Consider having a friend accompany you.<br/>
    • Trust your instincts.<br/>
 <br/>
Taking these simple precautions helps make Bit Road safer for everyone.<br/>
<h3>Avoiding Scams</h3>
Deal locally, face-to-face —follow this one rule and avoid 99% of scam attempts.<br/>
 
    • Do not extend payment to anyone you have not met in person.<br/>
 
    • Beware offers involving shipping - deal with locals you can meet in person.<br/>
 
    • Never wire funds (e.g. Western Union) - anyone who asks you to is a scammer.<br/>
 
    • Don't accept cashier/certified checks or money orders - banks cash fakes, then hold you responsible.<br/>
 
    • Transactions are between users only, no third party provides a “guarantee".<br/>
 
    • Never give out financial info (bank account, social security, paypal account, etc).<br/>
 
    • Do not rent or purchase sight-unseen—that amazing "deal" may not exist.<br/>
 
    • Refuse background/credit checks until you have met landlord/employer in person.<br/>
 
 
<h3>Who should I notify about fraud or scam attempts?</h3>
United States<br/>
    • Internet Fraud Complaint Center<br/>
    • FTC Video: How to report scams to the FTC<br/>
    • FTC complaint form and hotline: 877-FTC-HELP (877-382-4357)<br/>
    • Consumer Sentinel/Military (for armed service members and families)<br/>
    • SIIA Software and Content Piracy reporting<br/>
    • Ohio Attorney General Consumer Complaints<br/>
    • New York Attorney General, Avoid Online Investment Fraud<br/><br/>
Canada<br/>
    • Canadian Anti-Fraud Centre or 888-495-8501 (toll-free)<br/>
    • Royal Canadian Mounted Police (RCMP)<br/>
 
If you are defrauded by someone you met in person, contact your local police department.
If you suspect that a Bit Road post may be connected to a scam, please send us the details.

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
//Footer
$('#footerDiv').load('footer.html').trigger("create");

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


