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
				<center><h1>Prohibited</h1></center>
				<hr/>
			</div>
		</div>
		<div class="row absolute-center">
			<div class="col-xs-2"></div>
			<div class="col-xs-8">
				<div class="row">      
<h4>
Here is a partial list of goods, services, and content prohibited on Bit Road:<br/><br/>
    <ul>
		<li>weapons; firearms/guns and components; BB/pellet, stun, and spear guns; etc</li>
    <li> ammunition, clips, cartridges, reloading materials, gunpowder, fireworks, explosives</li>
    <li> recalled items, hazardous materials; body parts/fluids; unsanitized bedding/clothing</li>
    <li> prescription drugs, medical devices; controlled substances and related items</li>
    <li> alcohol or tobacco; unpackaged or adulterated food or cosmetics</li>
    <li> child pornography; bestiality; offers or solicitation of illegal prostitution</li>
    <li> pet sales (re-homing with small adoption fee ok), animal parts, stud service</li>
    <li> endangered, imperiled and/or protected species and any parts thereof, e.g. ivory</li>
    <li> false, misleading, deceptive, or fraudulent content; bait and switch; keyword spam</li>
    <li> offensive, obscene, defamatory, threatening, or malicious postings or email</li>
    <li> anyones personal, identifying, confidential or proprietary information</li>
    <li> food stamps, WIC vouchers, SNAP or WIC goods, governmental assistance</li>
    <li> stolen property, property with serial number removed/altered, burglary tools, etc</li>
    <li> ID cards, licenses, police insignia, government documents, birth certificates, etc</li>
    <li> US military items not demilitarized in accord with Defense Department policy</li>
    <li> counterfeit, replica, or pirated items; tickets or gift cards that restrict transfer</li>
    <li> lottery or raffle tickets, sweepstakes entries, slot machines, gambling items</li>
    <li> spam; miscategorized, overposted, cross-posted, or nonlocal content</li>
    <li> postings or email the primary purpose of which is to drive traffic to a website</li>
    <li> postings or email offering, promoting, or linking to unsolicited products or services</li>
    <li> affiliate marketing; network, or multi-level marketing; pyramid schemes</li>
    <li> any good, service, or content that violates the law or legal rights of others</li>
	</ul>
 <br/><hr/>
Please do not use Bit Road for these purposes, and flag anyone else you see doing so.</h4>
	
</div>
			</div>
			<div class="col-xs-2"></div>
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

</body>
</html>


