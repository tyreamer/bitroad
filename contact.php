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
				<center><h1>Contact</h1></center>
				<hr/>
			</div>
		</div>
		<div class="row absolute-center">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				<div class="row">
                                       
<center><h3>info@bitroad.org</h3></center>
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


