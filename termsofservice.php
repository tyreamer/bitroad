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
				<center><h1>Terms of Service</h1></center>
				<hr/>
			</div>
		</div>
		<div class="row absolute-center">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
<div class="container">
				

                                       
<h4>


<b>WELCOME TO BIT ROAD
</b>. By using our site you agree to these terms of use, last updated: 8/22/2016
 <br/><hr/>

<b>LICENSE</b>.  If you are 18 or older, we grant you a limited, revocable, nonexclusive, nonassignable, nonsublicensable license to access Bit Road in compliance with the terms of use; unlicensed access is unauthorized. You agree not to license, distribute, make derivative works, display, sell, or "frame" content from Bit Road, excluding content you create and sharing with friends/family. You grant us a perpetual, irrevocable, unlimited, worldwide, fully paid/sublicensable license to use, copy, perform, display, distribute, and make derivative works from content you post.
 <br/><hr/>

<b>USE</b>. You agree not to use or provide software (except for general purpose web browsers and email clients, or software expressly licensed by us) or services that interact or interoperate with Bit Road, e.g. for downloading, uploading, posting, flagging, emailing, search, or mobile use. Robots, spiders, scripts, scrapers, crawlers, etc. are prohibited, as are misleading, unsolicited, unlawful, and/or spam postings/email. You agree not to collect users' personal and/or contact information.
 <br/><hr/>

<b>MODERATION</b>. You agree we may moderate Bit Road access and use in our sole discretion, e.g. by blocking (e.g. IP addresses), filtering, deletion, delay, omission, verification, and/or access/account/license termination. You agree (1) not to bypass said moderation, (2) we are not liable for moderating, not moderating, or representations as to moderating, and (3) nothing we say or do waives our right to moderate, or not.
 <br/><hr/>

<b>DISCLAIMER</b>. MANY JURISDICTIONS HAVE LAWS PROTECTING CONSUMERS AND OTHER CONTRACT PARTIES, LIMITING THEIR ABILITY TO WAIVE CERTAIN RIGHTS AND RESPONSIBILITIES. WE RESPECT SUCH LAWS; NOTHING HEREIN SHALL WAIVE RIGHTS OR RESPONSIBILITIES THAT CANNOT BE WAIVED.
To the extent permitted by law, (1) we make no promise as to Bit Road, its completeness, accuracy, availability, timeliness, propriety, security or reliability; (2) your access and use are at your own risk, and Bit Road is provided "AS IS" and "AS AVAILABLE"; (3) we are not liable for any harm resulting from (a) user content; (b) user conduct, e.g. illegal conduct; (c) your Bit Road use; or (d) our representations; (4) WE AND OUR OFFICERS, DIRECTORS, EMPLOYEES (“Bit Road ENTITIES"), DISCLAIM ALL WARRANTIES & CONDITIONS, EXPRESS OR IMPLIED, OF MERCHANTABILITY, FITNESS FOR PARTICULAR PURPOSE, OR NON-INFRINGEMENT; (5) Bit Road ENTITIES ARE NOT LIABLE FOR ANY INDIRECT, INCIDENTAL, SPECIAL, CONSEQUENTIAL OR PUNITIVE DAMAGES, OR ANY LOSS (E.G. OF PROFIT, REVENUE, DATA, OR GOODWILL); (6) IN NO EVENT SHALL OUR TOTAL LIABILITY EXCEED $100 OR WHAT YOU PAID US IN THE PAST YEAR.
 <br/><hr/>

<b>CLAIMS</b>. You agree (1) any claim, cause of action or dispute ("Claim") arising out of or related to the terms of service or your Bit Road use is governed by California ("CA") law regardless of your location or any conflict or choice of law principle; (2) Claims must be resolved exclusively by state or federal court in San Francisco, CA (except we may seek injunctive remedy anywhere); (3) to submit to personal jurisdiction of said courts; (4) any Claim must be filed by 1 year after it arose or be forever barred; (5) not to bring or take part in a class action against Bit Road Entities; (6) (except government agencies) to indemnify Bit Road Entities for any damage, loss, and expense (e.g. legal fees) arising from claims related to your Bit Road use; (7) you are liable for terms of use breaches by affiliates (e.g. marketers) paid by you, directly or indirectly (e.g. through an affiliate network); and (8) to pay us for breaching or inducing others to breach the "USE" section, not as a penalty, but as a reasonable estimate of our damages (actual damages are often hard to calculate): $0.10 per server request, $1 per post, email, flag, or account created, $1 per item of PI collected, and $1000 per software distribution, capped at $25,000 per day.
 <br/><hr/>
<b>MISC.</b> Users complying with prior written licenses may access Bit Road thereby until authorization is terminated. Otherwise, this is the exclusive and entire agreement between us. If a terms of service term is unenforceable, other terms are unaffected.


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



//Footer
$('#footerDiv').load('footer.html').trigger("create");
});


</script>

</body>
</html>


