<?php
		require_once("./include/membersite_config.php");


	//Make sure we have a location set
	if (isset($_GET['loc']) && $_GET['loc'] != NULL)
	{
		$location = $_GET['loc'];
		//Get the user friendly location name
		$locationName = $fgmembersite->GetLocationName($location);
	}
	else {
		$fgmembersite->RedirectToURL('index.php');
	}

	if (isset($_GET['neg'])) {
		$neg= $_GET['neg'];
		$fgmembersite->Alert("$neg");
	}

	//Get List of Categories
	$categories = $fgmembersite->GetCategories();

	$footerHTML = file_get_contents('footer.html');



?>

<HTML>
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

<!-- Bootstrap core CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="mainStyle.css">
<link rel="icon" href="images/smallLogo.jpg">

<title>Bit Road</title>

<script>
  function showCategories()
  {
	  document.getElementById("category-dropdown").size = document.getElementById("category-dropdown").length;
	  document.getElementById("category-dropdown").style.display= "block";
	  document.getElementById("category-dropdown").style.visibility = "visible";
	  document.getElementById("category-dropdown").style.border= "none";
  }
</script>

</head>

<body>

<div id="container">
	<div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1">
		<div class="col-lg-3 col-md-3 col-sm-12" id="sidebar-left">
			<div class="row" id="logo-container">
				<div class="absolute-center">
					<img class="img-responsive" src="images/fullLogo.png" id="logo"></img>
				</div>
			</div>
			<div class="row" id="top-left-sidebar">
				<a href="create-post.php?loc=<?php echo $location ?>">
					<button class="btn btn-default absolute-center" id="post-btn" style="text-align: left;">
						post ad
					</button>
				</a>
				<form class="form-horizontal" id="main-search-form" method="GET" action="search.php">
					<div class="input-group main-search">
					  <input type="text" class="form-control" name="qry" placeholder="Search" id="searchText" onclick="showCategories()">
					  <!-- Hidden input for current parameters -->
					  <input type="text" class="form-control"  name="loc" id="location" style="display: none;" value="<?php echo $location ?>"> </input>
					   <select class="form-control" id="category-dropdown" name="c" multiple="multiple" onchange="this.form.submit()">
								<?php
								for ($i = 0; $i < sizeOf($categories); $i++)
								{
								?>
									<option class="category-item" value="<?php echo $categories[$i]["category_name"];?>"> <?php echo $categories[$i]["category_name"];?></option>
								<?php
								}
								?>
						</select>
					</div>
				</form>
				<form class="form-horizontal" method="GET" action="search.php" id="mobile-search-form" role="search" >
					<div class="input-group main-search">
					  <input type="text" class="form-control" name="qry" placeholder="Search" id="searchText" >
					  <!-- Hidden input for current parameters -->
					  <input type="text" class="form-control"  name="loc" id="location" style="display: none;" value="<?php echo $location ?>"> </input>
					   <select class="form-control" id="category-dropdown-mobile" name="c" onclick="submitForm()">
								<?php
								for ($i = 0; $i < sizeOf($categories); $i++)
								{
								?>
									<option value="<?php echo $categories[$i]["category_name"];?>" > <?php echo $categories[$i]["category_name"];?></option>
								<?php
								}
								?>
						</select>
						<button class="btn btn-default" id="submit-mobile" style="display: inline; " type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</form>
			</div>
<hr class="filler" style="border-color: white;"/>
			<div class="row text-center" id="middle-left-sidebar">
				<a href="search.php?loc=<?php echo $location ?>&c=<?php echo 'buy cryptocurrency';?>"><button type="button" id="buy-currency" class="btn btn-success text-center">Buy Cryptocurrency</button></a>
				<br/>
				<a href="search.php?loc=<?php echo $location ?>&c=<?php echo 'sell cryptocurrency';?>"><button type="button" id="sell-currency" class="btn btn-warning text-center">Sell Cryptocurrency</button></a>
			</div>
<hr class="filler"style="border-color: white;"/>
<hr class="filler"style="border-color: white;"/>
				<center><a href="chat/index.html" data-toggle="modal" data-target="#chatModal"><h3 class="glyphicon glyphicon-leaf chatLink" id="cl-desktop"></h3></a></center>
			<hr class="filler"style="border-color: white;"/>
			<hr class="filler"style="border-color: white;"/>
			<div class="row" id="bottom-left-sidebar">
				<div class="absolute-center" style="background-color: #fff; font-size: 15px;">
						<ul id="about">
							<li> <a href= "about.php"> About</a></li>
							<li> <a href= "contact.php"> Contact </a>  </li>
							<li> <a href= "termsofservice.php"> Terms </a>  	</li>
							<li> <a href= "privacy.php"> Privacy </a>  	</li>
                            <li> <a href= "safety.php"> Safety </a>  	</li>
							<li> <a href= "prohibited.php"> Prohibited </a>  	</li>
							<li> <center>&copy; <span id="desktop-date"></span> Bit Road</center> </li>
						</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 jumbotron" id="main-content">
			<div class="row" id="post-ad-mobile" >
				<a href="create-post.php?loc=<?php echo $location ?>"> <h5 style="float: left; display: inline;">post ad </h5> </a>
			</div>
			<div class="row" id="header">
				<div class="absolute-center" id="header-1">
					<h1 style="display: inline;"> Bit Road </h1>
					<a href="saved.php"><center><h2 class="glyphicon glyphicon-heart" style="color: red; position:relative; left: 30px; margin: 0"></h2></center></a>
				</div>
			</div>
			<div class="row" id="header-2">
				<div class="absolute-center header-mobile">
					<h2> [Crypto Classifieds] </h2>
				</div>
			</div>
			<div class="row" id="header-3">
				<div class="absolute-center header-mobile">
					<h3 id="city-name"><?php echo $locationName; ?><a href="index.php" onclick="clearLoc()"><h6 id="edit-location" style="position: relative; left: 5px;" class="glyphicon glyphicon-edit"></h6></a></h3>
				</div>
			</div>
			<div class="row absolute-center" id="selection-table">
				<div class="table-responsive" id="home-categories">
				  <table class="table table-hover">
					<tbody>
					   <?php

						$count = 0;
						for ($i = 0; $i < sizeOf($categories); $i++)
						{
							//Do not display buy/sell cryptocurrency
							if ($categories[$i]["category_name"] != 'buy cryptocurrency' &&  $categories[$i]["category_name"] != 'sell cryptocurrency')
							{
								if (($count+1) % 3==1)
								{
									echo '<tr>';
								}

								echo '<td><a href="search.php?loc='.$location.'&c='.$categories[$i]['category_name'].'" style="display: block;">'. $categories[$i]['category_name'].'</a></td>';


								if (($count+1) % 3==0)
								{
									echo '</tr>';
								}

								$count ++;
							}
						}

					  ?>
					</tbody>
				  </table>
				</div>
				<div id="home-categories-mobile" style="width: 100%;">
					<div class="table-responsive">
					 <table class="table" style="text-align: left;">
						<tbody>
						<?php
 for ($i = 0; $i < sizeOf($categories); $i++)
								{

									  echo '<tr><td><a href="search.php?loc='.$location.'&c='.$categories[$i]['category_name'].'" style="display: block;">'. $categories[$i]['category_name'].'</a></td></tr>';
										$count ++;
								}

						?>
							<tr>
								<td class="chatLink"><a href="chat/index.html" data-toggle="modal" data-target="#chatModal" style="display: block;"><h5 class="glyphicon glyphicon-leaf" ></h5></a></td>
							</tr>
							<tr>
								<td><a href="saved.php" style="display: block;"><h4 class="glyphicon glyphicon-heart" style="color: red;"></h4></a></td>
							</tr>
						</tbody>
					</table>
					</div>
				</div>

			</div>
			<div class="row">
				<h2 class="absolute-center" style="text-align: center;"> Local Cryptocurrency Economy </h2>
			</div>
<br/>
			<div class="row" id="crypto-images">
				<div class= "col-xs-12 col-sm-8 col-sm-offset-2" style="padding-top: 10px;">
					<div class="col-xs-4 col-sm-4" style="max-height: 100%;"><img src="images/ethereum.png" class="img-responsive" style="float: left;" ></img></div>
					<div class="col-xs-4 col-sm-4" style="max-height: 100%;"><img class="absolute-center img-responsive" src="images/bitcoin.png"></img></div>
					<div class="col-xs-4 col-sm-4" style="max-height: 100%;"><img src="images/litecoin.png" class="img-responsive" style="float: right;"></img></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12 col-xs-8 col-xs-offset-2 col-sm-offset-0">
			<div id="sidebar-right-top">
				<center><h3> Recent Ads </h3></center>
			</div>
			<div id="sidebar-right-bottom">
				<br/>
				<div id="recent-posts"></div>
			</div>

		</div>

		<!-- Chat Modal -->
		<div class="modal fade" id="chatModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" style="padding: 10%;">
						<div class="row">
							<h4>Chat coming soon...</h4>
						</div>
						<div class="row">
							<button data-toggle="modal" data-target="#chatModal" class="btn btn-default" id="accept" style="float: right; margin-right: 20px;">Awesome!</button>
						</div>
					</div>
				</div>
			</div>
		</div>



	</div>
</div>
<div id="home-footer"> <!-- TODO Make dynamic for iPhone browser -->
	<div id="footer-page" style="padding-top: 10px">
		<div class="row">
			<div class="col-xs-12">
				<ul id="about" style="text-align: center;">
					<li style="display: inline; padding: 0px 15px 0px 15px">
						<a href= "about.php"> About Us </a>
					</li>
					<li style="display: inline; padding: 0px 15px 0px 15px">
						<a href= "contact.php"> Contact </a>
					</li>
					<li style="display: inline;padding: 0px 15px 0px 15px">
						<a href= "termsofservice.php"> Terms </a>
					</li>
					<li style="display: inline;padding: 0px 15px 0px 15px">
						<a href= "privacy.php"> Privacy </a>
					</li>
					<li style="display: inline;padding: 0px 15px 0px 15px">
						<a href= "safety.php"> Safety </a>
					</li>
					<li style="display: inline;padding: 0px 15px 0px 15px">
						<a href= "prohibited.php"> Prohibited </a>
					</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<center>&copy; <span id="date"></span> Bit Road</center>
		</div>
	</div>
 </div>
 <div class="twitter"></div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script type="text/javascript">

	$(window).bind('load', function(){
		var location = '<?php echo $location ?>';
		//Load recent posts
		$.ajax({
				type: "POST",
				url: "loadRecentPosts.php",
				data: {loc : location},
				cache: false,
				success: function(msg){
							$('#recent-posts' ).append( msg );
							if(!msg){

							}
						}
			});

		//In case we need this
		localStorage["location"] = location;
	});

</script>

<script>
	function clearLoc() {
		localStorage.removeItem("location");
	}
</script>

<script>
	// Date for footer
	var currentTime = new Date();
	var year = currentTime.getFullYear();
	document.getElementById('date').innerHTML= year;
	document.getElementById('desktop-date').innerHTML= year;
</script>

<script>



/*
	$('#searchText').click(function() {
		 $('#category-dropdown').attr('size', $('#category-dropdown').children().length);
		$('#category-dropdown').show();

	});

	$('#searchText').keypress(function (e) {
		  if (e.which == 13) {
			$('form').submit();
			return false;
		  }
		}); */

	//Open chat modal
	/* $('.chatLink').click(function(){
		   $('#chatModal').modal('show');
	});

	//Close modal on skip
	$('#accept').click(function(){
		   $('#chatModal').modal('hide');
	});
	 */

	$('#category-dropdown').change(function(){
		 $(this).closest("form").submit();
	});




	//Scott
	var pastkeys = [];
window.addEventListener("keyup", function(e) {
   pastkeys.push(e.which);
    if (pastkeys.length > 11) {
        pastkeys.shift();
    }
    check();
});
function check() {
    if (pastkeys.join(",") == "38,38,40,40,37,39,37,39,66,65,13") {
        document.querySelectorAll("img")
            .forEach(i => i.src = "http://dogecoin.com/imgs/dogecoin-300.png");
    }
}

</script>


</body>
</html>
