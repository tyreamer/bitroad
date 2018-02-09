<?php
	require_once("./include/membersite_config.php");
	
	//Make sure we have a location set
	if (isset($_GET['loc']) && $_GET['loc'] != NULL) 
	{
		$location = $_GET['loc'];
	}
	
	else 
	{
		$fgmembersite->RedirectToURL('index.php');
	}		
	
	//Check if we were given a category
	if (isset($_GET['c'])) {
		$category 	  = $_GET['c'];		
	}
	//Default category to for sale
	else {
		$category = 'for sale';
	}
	
	//Check if we're on a specific page
	if (isset($_GET['p'])) {
		$page 	  = $_GET['p'];
		
		//Limit 100 results per page
		$offset	  = ($page - 1) * 100;
	}
	else {
		$page = 1;
	}
	
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
	
	//check for a currency param
	if (isset($_GET['curr']) && $_GET['curr'] != '') 	{		
		$currency = $_GET['curr'];
		//For use in form
		$currency_placeholder = $currency;
	}
	
	else {
		$currency = NULL;
		//For use in form
		$currency_placeholder = 'Currency';
	}
	
	//check for a currency param
	if (isset($_GET['sl']) && $_GET['sl'] != '') 	{		
		$spec_loc = $_GET['sl'];
		//For use in form
		$spec_loc_placeholder = $spec_loc;
	}
	
	else {
		$spec_loc = NULL;
		//For use in form
		$spec_loc_placeholder = 'specific location';
	}
	
	//check for a order param
	if (isset($_GET['o'])) 	{
		//Check the sort order
		if (isset($_GET['s'])) 
		{
			$orderBy = $_GET['o'];
			$orderSort = $_GET['s'];
		}
		else 
		{
			$orderBy = $_GET['o'];
			$orderSort = "DESC"; //Default order sort to descending
		}
	}
	else {
		$orderBy = NULL;
		$orderSort =  NULL;
	}
	
	
	
	//Get category posts based on page number and search param
	$posts = $fgmembersite->GetCategoryPosts($category, $location, $offset, $key, $currency, $orderBy, $orderSort, $spec_loc);
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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  
</head>

<body>

		<!-- Modal -->
		<div class="modal fade" id="adultModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body">
						<div class="container" style="max-width: 100%;">
							<div class="row">
								This section contains sexual content, including pictorial nudity and adult language. It is to be accessed only by persons who are 18 years of age or older (and is not considered to be a minor in his/her state of residence) and who live in a community or local jurisdiction where nude pictures and explicit adult materials are not prohibited by law. By accessing this website, you are representing to us that you meet the above qualifications. A false representation may be a criminal offense.
								<br/><br/>I confirm and represent that I am 18 years of age or older (and am not considered to be a minor in my state of residence) and that I am not located in a community or local jurisdiction where nude pictures or explicit adult materials are prohibited by any law. I agree to report any illegal services or activities which violate the Terms of Use. I also agree to report suspected exploitation of minors and/or human trafficking to the appropriate authorities.
								<br/><br/>
								<center>
									<b>I have read and agree to this disclaimer as well as the Terms of Use.</b>
								<br/>
									<a href="home.php?loc=<?php echo $location ?>"><button class="btn btn-default">I do not agree</button></a> 
									<a href="#" onclick="removeModal()" id="safe"><button class="btn btn-default" >I agree</button></a>
								</center>
							</div>
						</div>
					</div>
				</div>	
			</div>		
		</div>

<div class="col-lg-2 col-sm-2"></div>
<div class="col-lg-8 col-sm-8">
		<div class="row">
				<div class="col-md-4 col-xs-4">
					<div id="left-header" style="line-height: 15px;">
						<a href="home.php?loc=<?php echo $location ?>">
							<h4 id="search-category"> <?php echo $location ?> </h4>
						</a>
						<i class="glyphicon glyphicon-menu-right"> </i> 
						<br/>
						<a href="search.php?loc=<?php echo $location ?>&c=<?php echo $category ?>">
							<h4 id="search-sub-category"> <?php echo $category ?> </h4> 
						</a>
					</div>
				</div>
				<div class="col-md-4 col-xs-4">
					<a href="saved.php"><center><h2 class="glyphicon glyphicon-heart" style="color: red" ></h2></center></a>
				</div>
				<div class="col-md-4 col-xs-4">
					<a href="home.php?loc=<?php echo $location ?>"><img class="img-responsive" height=80px width=80px style="float:right" src="images/fullLogo.png" id="logo"></img></a>
				</div>
		</div>
		<div class="row" id="post-search">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="row">
					<form class="form-horizontal" method="GET" id="search-form" action="search.php">
						<div class="input-group" style="padding: 0px 10px 0px 10px;">
						  <input type="text" class="form-control" name="qry" placeholder="<?php if (isset($_GET['qry'])) {echo $key;} else { echo 'Search';}?>" id="searchText" type="text">
						  <!-- Hidden inputs for current parameters -->
						  <input type="text" class="form-control"  name="loc" id="location" style="display: none;" value="<?php echo $location ?>"> </input>
						  <input type="text" class="form-control"  name="c" id="category" style="display: none;" value="<?php echo $category ?>"> </input>	
						  <input type="text" class="form-control"  name="curr" id="currency2" style="display: none;" value="<?php echo $currency ?>"> </input>	
						 <span class="input-group-btn">
						  <button type="submit" class="btn btn-default" style="height: 34px;"><span class="glyphicon glyphicon-search"></span></button>
						</div>
					</form>
				</div>
				<hr/>
				<div class="row">
					<center><small>
						<!-- Pagination -->
						 <?php 
							//Only display the back arrow on pages 2+
							if($page > 1) { ?><a href="search.php?loc=<?php echo $location; ?>&c=<?php echo $category; ?>&p=<?php echo $page - 1; if (isset($_GET['qry'])) {echo '&qry='.$key;}?>"><i class="glyphicon glyphicon-lg glyphicon-menu-left"></i> </a><?php }?>
							page <?php echo $page; 
							
							//Check if there is a next page (100 posts per page)
							$nextPagePosts = $fgmembersite->GetCategoryPosts($category, $location,$offset + 100, $key, $currency);
							
							//Only display the next arrow if we have more results
							if (sizeOf($nextPagePosts) != 0) 
							{							
							?> 	
								<a href="search.php?loc=<?php echo $location; ?>&c=<?php echo $category; ?>&p=<?php echo $page + 1; if (isset($_GET['qry'])) {echo '&qry='.$key;}?>"><i class="glyphicon glyphicon-menu-right"></i>
								
							<?php
							}
						?>
					</small></center></a>	
				</div>
				<hr/>
				<br/>
</div>
<div class="col-xs-12">					
				<div class="col-xs-12 col-sm-4">
					<form class="form-horizontal" method="GET" action="search.php">						
							<div class="input-group">
								<input type="text" class="form-control" style="width: 100%;"  name="sl" id="spec_loc" placeholder= <?php echo "'$spec_loc_placeholder'"; ?>> </input>							
								 <!-- Hidden inputs for current parameters -->
								<input type="text" class="form-control"  name="loc" id="location2" style="display: none;" value="<?php echo $location ?>"> </input>
								<input type="text" class="form-control"  name="c" id="category2" style="display: none;" value="<?php echo $category ?>"> </input>	
								<input type="text" class="form-control"  name="qry" id="query2" style="display: none;" value="<?php echo $key ?>"> </input>	
								<input type="text" class="form-control"  name="o" style="display: none;" value="<?php echo $orderBy ?>"> </input>	
								<input type="text" class="form-control"  name="s" style="display: none;" value="<?php echo $orderSort ?>"> </input>	
								<input type="text" class="form-control"  name="curr" id="currencyFilter" style="display: none;" value="<?php echo $currency ?>"> </input>
								
								<span class="input-group-btn">
								<button type="submit" class="btn <?php if ($spec_loc != NULL && $spec_loc != "") { ?> btn-danger <?php } else { ?> btn-default <?php }?>" style="height: 34px;"><span class="glyphicon <?php if ($spec_loc != NULL && $spec_loc != "") { ?> glyphicon-remove-sign <?php } else { ?> glyphicon-triangle-right <?php }?>" ></span></button>
							</div>
						</form>	
				</div>
				<div class="col-xs-8 col-sm-4" style="padding-left: 0; margin-left: 15px;">
					<form class="form-horizontal" method="GET" action="search.php">						
						<div class="input-group">
							<!-- <center> Currency Filter: </center>  -->
							<div class="ui-widget">
								  <select class="form-control" id="combobox" style="display: none">
										<!-- <option selected="true" disabled = "disabled" disabled>Filter by Currency</option> -->
								  </select>

							</div>							
							 <!-- Hidden inputs for current parameters -->
							<input type="text" class="form-control"  name="loc" id="location2" style="display: none;" value="<?php echo $location ?>"> </input>
							<input type="text" class="form-control"  name="c" id="category2" style="display: none;" value="<?php echo $category ?>"> </input>	
							<input type="text" class="form-control"  name="qry" id="query2" style="display: none;" value="<?php echo $key ?>"> </input>	
							<input type="text" class="form-control"  name="o" style="display: none;" value="<?php echo $orderBy ?>"> </input>	
							<input type="text" class="form-control"  name="s" style="display: none;" value="<?php echo $orderSort ?>"> </input>	
							<input type="text" class="form-control"  name="sl" style="display: none;" value="<?php echo $spec_loc ?>"> </input>	
							
							<span class="input-group-btn">
							<button type="submit" class="btn <?php if ($currency != NULL && $currency !="") {?> btn-danger <?php } else {?> btn-default <?php } ?>" style="height: 32px;"><span class="<?php if ($currency != NULL && $currency !="") {?> glyphicon glyphicon-remove-sign <?php } else { ?> glyphicon glyphicon-filter <?php }?>"></span></button>

						</div>
					</form>		
				</div>
				<div class="col-xs-3">
					<form class="form-horizontal" method="GET" action="search.php">						
						<div class="input-group">													
							 <!-- Hidden inputs for current parameters -->
							<input type="text" class="form-control"  name="loc" id="location3" style="display: none;" value="<?php echo $location ?>"> </input>
							<input type="text" class="form-control"  name="c" id="category3" style="display: none;" value="<?php echo $category ?>"> </input>	
							<input type="text" class="form-control"  name="qry" id="query3" style="display: none;" value="<?php echo $key ?>"> </input>	
							<input type="text" class="form-control"  name="curr" id="currencyFilter" style="display: none;" value="<?php echo $currency ?>"> </input>	
							<input type="text" class="form-control"  name="o" id="orderBy" style="display: none;" value="price"> </input>	
							<input type="text" class="form-control"  name="sl" id="spec_loc2" style="display: none;" value="<?php echo $spec_loc ?>"> </input>	
							
							<span class="input-group-btn">
							<button type="submit" class="btn <?php if ($orderSort =="ASC") { ?> btn-danger <?php } else { ?> btn-default <?php } ?>" style="height: 32px; font-size: 10px;" name="s" value="<?php if ($orderSort !="ASC") { ?>ASC<?php } ?>"><span class="glyphicon glyphicon-triangle-top"></span></button>

<button type="submit" class="btn <?php if ($orderSort =="DESC") { ?> btn-danger <?php } else { ?>btn-default<?php } ?>" style="height: 32px; font-size: 10px;" name="s" value="<?php if ($orderSort !="DESC") {?>DESC<?php } ?>"><span class="glyphicon glyphicon-triangle-bottom"></span></button>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-2">					
			</div>
		</div>
		<div class="row jumbotron" id="results" style="margin-bottom: 0">
			<div class="col-md-12">
				<div class="list-group" id="all-posts">
					<?php
						
						//If we somehow ended up on this page with no posts, go home
						if (sizeOf($posts) ==0) 
						{
							?> 
								
										<div class="alert alert-warning absolute-center">
										  <strong>oops!</strong> we were not able to find any posts. please <a href="home.php?loc=<?php echo $location ?>"> go back</a> and try again.
										</div>
							<?php
						}
						
						for ($i = 0; $i < sizeOf($posts); $i++) {
			
									//Get post details
									$post_id		= $posts[$i]['post_id'];		
									//Trim title if too long
									$title 			= $posts[$i]['title'];
									$date 			= $posts[$i]['date'];	
									$price 			= $posts[$i]['price'];
									$currency 		= $posts[$i]['currency'];		
									//Trim location if too long
									$spec_location	= $posts[$i]['specific_location'];							
									
						
						?>

							<!-- Post Details -->
								<a href="post.php?id=<?php echo $post_id; ?>">
									<div class="panel search-listing" id="<?php echo $post_id; ?>">
											<div class="panel-heading" style="background-color: #f5f5f5;">				
												<!-- Top Row -->
												<h4><?php echo $title ?></h4>
											</div>
											<div class="panel-body">					
												<div class="col-xs-2">
													<div class="col-xs-12"><center><h4 class="glyphicon glyphicon-heart favorite-icon"></h4></center></div>
												</div>
												<div class="col-xs-10">
													<a href="post.php?id=<?php echo $post_id; ?>">														
																											
															
															<!-- Middle Row -->
															<div class="col-xs-4"><center><i class="glyphicon glyphicon-time"> </i> </center></div>
															<div class="col-xs-4"><center><i class="glyphicon glyphicon-map-marker"> </i> </center></div>
															<div class="col-xs-4"><center><img src="https://coinmarketcap.com/static/img/coins/16x16/<?php echo $currency  ?>.png"/> </center></div><!-- Harcoded images for now -->
															
															
															<!-- bottom row -->
															<div class="col-xs-4" id="post-date"><center> <h6><?php echo $fgmembersite->humanTiming(strtotime($date)); ?>	</h6></center></div>
															<div class="col-xs-4" id="post-location"><center><h6><?php echo $spec_location ?></h6></center></div>
															<div class="col-xs-4" id="post-price"><center><h6><?php echo $price ?> <?php echo $currency ?></h6></div> 
														</div>
													</a>
											</div>
									</div>		
									</a>									
									<!-- For querying more -->
									<span class="postSort" id="<?php echo $time?>"></span>
						

						<?php 
						}//for
					?>
				</div>
			</div>
		</div>
</div>
<div id="footerDiv"></div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
 <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>		
    $(window).load(function(){
		var category = '<?php echo $category ?>';
		
		if (category == 'adult') 
		{			
			$('#adultModal').modal('show');		
		}
    });
	
	//Require a location to be selected
	$(window).on('hidden.bs.modal', function() { 		 
			$('#adultModal').modal('show');
	});
	
	//TODO: make more efficient
	function removeModal() 
	{
		$( '.modal' ).remove();
		$( '.modal-backdrop' ).remove();
		$( 'body' ).removeClass( "modal-open" );
	}
		
</script>

<script>

//AutoComplete Functionality
  $( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
		
		var placeholder = '<?php echo $currency_placeholder; ?>';
	
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
		  .attr("id", "custom-combobox-input")
		  .attr("name", "curr")
          .attr( "title", "" )
		  .attr("placeholder", placeholder)
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: $.proxy( this, "_source" )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            
				$("#combobox").trigger("change");
			this._trigger( "select", event, {
              item: ui.item.option			
			  });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
		
      },
  
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {          
		  return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
			return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
		
    $( "#combobox" ).combobox();
  } );
  
  
</script>

<script>
$('ui-menu-item').change(function(){
	 $('#search-form').form.submit(); 
  });



// Save Posts	
	
	$('.glyphicon-heart').click(function(event){
		   if ($(this).hasClass('favorite-icon')) {  
				return false;
				event.preventDefault();
			}	
		});

	
	//Check for saved posts on the page
	$('.search-listing').each(function() {
			
			//Make sure localStorage exists
			if (localStorage.getItem("saved_posts") != null) 
			{
				//Get all the posts
				var ids = [];
				ids.push(this.id);
			
				//If this is in the saved posts array, make the heart red
				if ((jQuery.inArray(this.id, JSON.parse(localStorage["saved_posts"])) != -1)) 
				{
					$(this).find('.glyphicon-heart').css('color', 'red');
				}			
			}
			
			else {
				return;
			}
	});

	//In case we need the location
	localStorage["location"] = '<?php echo $location ?>';
	
	
	$('.search-listing').click(function(){
		var post = $(this).attr('id');
		$(location).attr('href', "post.php?id=" + post);
	});
	
	$('.glyphicon-heart').click(function(){
		
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



//Currency
	$.getJSON( "https://api.coinmarketcap.com/v1/ticker/", function( data ) {
	  var items = [];
	  var  i = 0;	  
	  $.each( data, function( key, val ) 
		  {
			items.push( "<option class='currencyType' value='" + val.id + "'>" + val.id + "</option>" );		
		  });
		  
	  $("#combobox").append(items);

	});
//End Currency


//Submit currency filter
	$('#combobox').change(function() {
		var newVal = $(this).val();
        $("input[name='curr'").val(newVal);
		this.form.submit();
    });



	//Remove currency filter
function removeFilter() {						
	$(location).attr('href', 'search.php?loc=<?php echo $location ?>&c=<?php echo $category ?>&qry=<?php echo $key?>');
}
//Footer
$('#footerDiv').load('footer.html').trigger("create");

</script>
</body>
</html>

