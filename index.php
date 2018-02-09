<?php
echo 1;
		require_once("./include/membersite_config.php");

//Get all locations
$regions = $fgmembersite->getRegions();

	//Get List of Categories
	$categories = $fgmembersite->GetCategories(); 
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">

<link rel="stylesheet" href="mainStyle.css">
<link rel="icon" href="images/smallLogo.jpg">

<title>Bit Road</title>

</head>

<body>

<div id="container">
	<div class="col-md-10 col-md-offset-1">
		<div class="col-lg-2 col-md-2 col-sm-12" id="sidebar-left">		
			<div class="row" id="logo-container">
				<div class="absolute-center">
					<img class="img-responsive" src="images/fullLogo.jpg" id="logo"></img>
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
<hr class="filler"style="border-color: white;"/>
<hr class="filler"style="border-color: white;"/>			
			<div class="row text-center" id="middle-left-sidebar">	
						<a href="search.php?loc=<?php echo $location ?>&c=<?php echo 'buy cryptocurrency';?>"><button type="button" id="buy-currency" class="btn btn-success text-center">Buy Cryptocurrency</button></a>
						<br/>						
						<a href="search.php?loc=<?php echo $location ?>&c=<?php echo 'sell cryptocurrency';?>"><button type="button" id="sell-currency" class="btn btn-warning text-center">Sell Cryptocurrency</button></a>		
			</div>
			<hr class="filler"style="border-color: white;"/>		
			<hr class="filler"style="border-color: white;"/>
			<hr class="filler"style="border-color: white;"/>
			<div class="row" id="bottom-left-sidebar">
				<div class="absolute-center" style="background-color: #fff;">
						<ul id="about">
							<li> <a href= "about.php"> About</a></li>
							<li> <a href= "contact.php"> Contact </a>  </li>
							<li> <a href= "termsofservice.php"> Terms </a>  	</li>
							<li> <a href= "privacy.php"> Privacy </a>  	</li>	
                            <li> <a href= "safety.php"> Safety </a>  	</li>
							<li> <a href= "prohibited.php"> Prohibited </a>  	</li>			
						</ul>
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-12 jumbotron" id="main-content">	
			<div class="row" id="post-ad-mobile" >
				<a href="create-post.php?loc=<?php echo $location ?>"> <h5 style="float: left; display: inline;">post ad </h5> </a>	
			</div>				
			<div class="row" id="header">			
				<div class="absolute-center header-mobile">							
					<h1 style="display: inline;"> Bit Road </h1>			
					<a href="saved.php"><center><h2 class="glyphicon glyphicon-heart" style="color: red; position:relative; left: 40px;"></h2></center></a>					
				</div>	
			</div>
			<div class="row">				
				<div class="absolute-center header-mobile">					
					<h2> [Crypto Classifieds] </h2>				
				</div>	
			</div>
			<div class="row absolute-center" id="selection-table">
				<div class="table-responsive" id="home-categories">
				  <table class="table table-hover">
					<thead>
					  <tr>
					  <th></th>
							<th> <h3 id="city-name">Select a city<a href="index.php"><h6 id="edit-location" style="position: relative; left: 5px;" class="glyphicon glyphicon-edit"></h6></a></h3></th>

						<th></th>
					  </tr>
					</thead>
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
						</tbody>
					</table>
					</div>			
				</div>
			</div>
			<div class="row">
				<h3 class="absolute-center" style="text-align: center;"> Local Cryptocurrency Economy </h3>
			</div>
			<br/>
			<div class="row" >
				<div class= "col-xs-12 col-sm-8 col-sm-offset-2">
					<div class="col-xs-4 col-sm-4"><img src="images/ethereum.png" height=90px width=90px style="float: left"></img></div>
					<div class="col-xs-4 col-sm-4"><img class="absolute-center" src="images/bitcoin.png" height=90px width=90px style="margin-left: auto; margin-right:auto;"></img></div>
					<div class="col-xs-4 col-sm-4"><img src="images/litecoin.png" height=90px width=90px style="float: right;"></img></div>
				</div>
			</div>
		</div>		
		<div class="col-lg-2 col-md-2 col-sm-12" id="sidebar-right">		
		</div>
		<!-- Modal -->
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" style="padding: 10%;">
						<div class="row">
							<center><h2> Select a Location </h2></center>
							<h4> Quick Nav: </h4>
								<ul>
								<?php 
									for ($i = 0; $i < sizeOf($regions); $i++) 
									{
										echo '<a href="#'.$regions[$i]["region"].'"><li>'. $regions[$i]["region"] .'</li></a>';
									}
												
								?>
								</ul>
						</div>
						<?php 
						//Get the list of regions
						for ($i = 0; $i < sizeOf($regions); $i++) 
						{
							echo '<h3 id="'.$regions[$i]["region"].'"><u><b>'. $regions[$i]["region"] .'</u></b> </h3>';
							
							//Get the states from this region
							$states = $fgmembersite->getStates($regions[$i]["region"]);							
							for ($j = 0; $j <sizeOf($states); $j++) 
							{								
								if ($j == 0) {
									echo '<div class="row">';
								}
								else if ($j%3 == 0) {
									echo '</div> <div class="row">';
								}
								
								echo '<div class="col-md-4 col-xs-12 '.$j.'">
										<h4><b>'. $states[$j]["state"] .'</b> </h4>  ';
								
								//Get the states from this region
								$locations = $fgmembersite->getCities($states[$j]["state"]);
								for ($k = 0; $k < sizeOf($locations); $k++)
								{
									echo '<a href="home.php?loc='.$locations[$k]["url_name"].'"><p>'. $locations[$k]["location_name"] .'</p></a>';
								}
								
								echo '</div>';
								if ($j == sizeOf($states)-1) {
									echo '</div>';
								}
							}
							echo '<div class="row"></div><hr/><br/>';
						}					
						?>	
					</div>
				</div>	
			</div>		
		</div>
	</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>

<script>		
    $(window).load(function(){
        $('#myModal1').modal('show');
  });
	
	//Require a location to be selected
	$(window).on('hidden.bs.modal', function() { 
		 $('#myModal1').modal('show');
	});


//Check if localStorage exists 
		if (localStorage.getItem("location") != null) 
		{	
			var url = "http://www.bitroad.org/home.php?loc=" + localStorage.getItem("location");
			window.location.href = url;
		}

	
</script>
		

</body>
</html>
