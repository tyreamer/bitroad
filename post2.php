<?php
	require_once("./include/membersite_config.php");
	
	//Make sure we have a location set
	if (isset($_GET['id'])) 
	{		
		$post_id = $_GET['id'];
	}
	
	else 
	{
		$fgmembersite->RedirectToURL('index.php');
	}
	
	//Check if it's a new post
	if (isset($_GET['new'])) 
	{		
		$new = 1;
		$page_link  = "http://$_SERVER[HTTP_HOST]/post.php?id=".$post_id;
	}
	else 
	{
		$page_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}	
	
//Get post information
$post_info = $fgmembersite->GetPost($post_id);

$post_title = $post_info['title'];

//Make sure we have information
if (sizeOf($post_info) <= 0) 
{
	$fgmembersite->RedirectToURL('index.php');
}

?>

<HTML>
<head>
  
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta property="og:title" content="Bit Road - <?php echo $post_title; ?>" />
<meta property="og:site_name" content="Bit Road" />
<meta property="og:description" content="Local Cryptocurrency Economy" />
<meta property="og:image" content="http://bitroad.org/images/fullLogo.jpg" />

<!-- Bootstrap core CSS -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="mainStyle.css">
<link rel="stylesheet" href="postStyle.css">
<link rel="icon" href="images/smallLogo.jpg">

<title>Bit Road <?php echo '- '.$post_title ?></title>
</head>

<body>

<!-- 
	<div id="post-overlay" style="position: fixed; width: 100%;">
	   <div class="col-sm-2" style="float: left">
	   
			<div class= "xs-hidden col-sm-12" style="z-index: 200; background-color: #fff; height: 100vh;"> </div>
	   </div>
		<div class="col-sm-2"style="float: right"><div class= "xs-hidden col-sm-2" style="z-index: 200; background-color: #fff; height: 100vh; width: 100%;"> </div></div>
	</div>
-->


<!-- Modal for New Posts-->

<?php if ($new) { ?>
<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4><b>Sharing</b> your Ad to popular networks has shown not only to <b>increase</b> cryptocurrency adoption, but <b>increase</b> the odds someone will respond to you!</h4>
			</div>
			<div class="modal-body" style="padding: 3%;">
				<div class="row">				
					<div id="share-buttons-modal">
						<div class="row absolute-center">
							<!-- Email -->
							<a href="mailto:?Subject=check this out on bitroad&amp;Body=<?php echo $page_link; ?>">
								<img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email"/>
							</a>
						 
							<!-- Facebook -->
							<a href="http://www.facebook.com/sharer.php?appid=1227412770623232&u=<?php echo $page_link ?>&name=bitroad&caption=bitroad&description=<?php echo $post_title?>&picture=http://www.bitroad.org/images/fullLogo.jpg" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
							</a>
							
							<!-- Google+ -->
							<a href="https://plus.google.com/share?url=<?php echo $page_link; ?>" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
							</a>
							
							<!-- LinkedIn -->
							<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $page_link; ?>" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
							</a>					
							<!-- Pinterest -->
							<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
								<img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
							</a>
							
							<!-- Reddit -->
							<a href="http://reddit.com/submit?url=<?php echo $page_link; ?>&amp;title=bitroad: <?php echo $post_info['title']; ?>" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
							</a>
							
							<!-- Twitter -->
							<a href="https://twitter.com/share?url=<?php echo $page_link; ?>&amp;text=Check out this bitroad post: &amp;hashtags=bitroad" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
							</a>   
						</div>
					</div>
				</div>
				<div class="row">	
					<button class="btn btn-default" id="skip" style="float: right; margin-right: 20px;">Skip</button>
				</div>
			</div>
		</div>	
	</div>		
</div>
<?php 
}
?>
<div id="container" class="container">	
<div class="row">
	<div class="col-xs-12" id="post-wrapper">
		<div class="row">
		<div class="xs-hidden"></div>
				<div class="col-xs-3">
					<a href="home.php?loc=<?php echo $post_info['location'] ?> "><img src="images/fullLogo.jpg" id="logo"></img></a>					
				</div>
				<div class="col-xs-9 post-header">
					<div class="col-xs-7">	
						<h4> 
							  <?php
							  echo '<u>
										<a href="home.php?loc='.$post_info['location'].'">'.$post_info['location'].'</a> <br class="mobile-fix"><br class="mobile-fix">
												<span class="glyphicon glyphicon-menu-right" style="font-size: 14px;"> </span> 
										<a href="search.php?loc='.$post_info['location'].'&c='.$post_info['category'].'">'.$post_info['category'].'</a>							
									</u>'; ?>
						</h4>
					</div>
					<div class="col-xs-4">	
					<h4 id="post-date"><?php echo $fgmembersite->humanTiming(strtotime($post_info['date'])); ?> </h4>					
					</div>	
					<!-- <hr class="mobile-fix" style="border-color: white"/><hr class="mobile-fix" style="border-color: white"/> -->
					<div class="col-xs-1" style="padding-left: 0;">	
						<h4 class="glyphicon glyphicon-heart" id="post-like"></h4>
					</div>
				</div>
				
		</div>
<hr/>
		<div class="row" id="post-details" >				
			<div class="col-xs-12">						
					<div class="col-xs-12 col-sm-4 post-detail-item" id="chat-name" style="font-size: 14px;">
						<?php echo $post_info['chat_name']?>
					</div>
					<div class="col-xs-12 col-sm-4 post-detail-item" id="price" style="font-size: 14px;">
						<img src="https://coinmarketcap.com/static/img/coins/16x16/<?php echo $post_info['currency']  ?>.png"><?php echo ' '.$post_info['price'].' '. $post_info['currency']?>
					</div>
					<div class="col-xs-12 col-sm-4 post-detail-item" id="spec-location" style="font-size: 14px;">
						<?php if ($post_info['specific_location'] != '') {echo $post_info['specific_location'];} else {echo 'No location specified.';} ?>
					</div>		
			</div>
		</div>
		<div class="row">		
				<div class="col-xs-12"><h3 id="post-title"><?php echo $post_info['title'] ?></h3></div>
				
		</div>
		<hr/>
		<?php if ($post_info['img_folder'] != 'images/postImages/default/') { ?>
		<div class="row">
			<div class="col-xs-12">		
					<div id="main-photo-area" class="col-sm-4 col-sm-offset-4 col-xs-12">
					
						<!-- Slider -->
						<div class="row">
							<div class="col-xs-12" id="slider">
								<!-- Top part of the slider -->
								<div class="row">
									<div class="col-xs-12" id="carousel-bounding-box">
										<div class="carousel slide" id="myCarousel" data-interval="false">
											<!-- Carousel items -->
											<div class="carousel-inner">
												<?php
													
													$images=preg_grep('/\.(jpg|jpeg|png|gif)(?:[\?\#].*)?$/i', $files);
													$imgfolder = $post_info['img_folder'];
													$imgCount = 0;
													
													if ($handle = opendir(dirname(realpath(__FILE__))."/$imgfolder")) {
														
															while($file = readdir($handle)){
																
																if($file !== '.' && $file !== '..'){	
																	if ($imgCount == 0) 
																	{
																	?>
																		<div class="active item" data-slide-number="0">																	
																	<?php
																		echo "<img src='$imgfolder/$file'/> </div>";
																	}
																	else
																	{
																	?>
																		<div class="item" data-slide-number="<?php echo $imgCount; ?>">																	
																	<?php
																		echo "<img src='$imgfolder/$file'/> </div>";
																	}
																	
																	$imgCount++;
																}
															}
															
															closedir($handle);
													}
																							
												?>
												
											</div>

	<?php if ($imgCount > 1) { ?>

	<!-- Carousel nav -->
											<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
												<span class="glyphicon glyphicon-chevron-left"></span>                                       
											</a>
											<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
												<span class="glyphicon glyphicon-chevron-right"></span>                                       
											</a> 
	<?php } ?>                               
											</div>
									</div>
								</div>
							</div>
						</div>
						<br/><br/>
						<!--/Slider-->	
						<div class="row hidden-xs"  id="slider-thumbs">
							<!-- Bottom switcher of slider -->
							<ul class="hide-bullets">
								<?php
											
									$images=preg_grep('/\.(jpg|jpeg|png|gif)(?:[\?\#].*)?$/i', $files);
									$imgfolder = $post_info['img_folder'];
									$imgCount = 0;
																	
									if ($handle = opendir(dirname(realpath(__FILE__))."/$imgfolder")) {
										
										$count = 0;
										
											while($file = readdir($handle)){
												
												//Rows of 5 for thumbnails
												if (($count+1) % 5==1) 
												{
													echo '<div class="row">';	
													echo '<div class="absolute-center">';
												}
												
												
												if($file !== '.' && $file !== '..'){	
													
													echo '<li class="col-sm-3 thumb-container">
																<a class="thumbnail" id="carousel-selector-'. $imgCount .'"><img src="'.$imgfolder.'/'.$file.'"></a>
														  </li>';																																						
													
													$imgCount++;
												}	
												
												if (($count+1) % 5==0) 
												{
													echo '</div>
															</div>';	
												}
												
												$count ++;
												
											}
											
											closedir($handle);
									}
																			
								?>
							</ul>                 
						</div>
					</div> 
			</div>
	</div>		
		
	<?php 
	} //if not the default directory
	
	?>
	
		<div class="row" id="main_description_area">
			
			<div class="col-sm-12">
				<div class="jumbotron">
					<div class="col-xs-12" style="margin-bottom: 2%;">	
						<div id="share-buttons">
							<!-- Email -->
							<a href="mailto:?Subject=check this out on bitroad&amp;Body=<?php echo $page_link; ?> ">
								<img src="https://simplesharebuttons.com/images/somacro/email.png" alt="Email" />
							</a>
						 
							<!-- Facebook -->
							<a href="http://www.facebook.com/sharer.php?u=<?php echo $page_link ?>" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/facebook.png" alt="Facebook" />
							</a>
							
							<!-- Google+ -->
							<a href="https://plus.google.com/share?url=<?php echo $page_link; ?>" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/google.png" alt="Google" />
							</a>
							
							<!-- LinkedIn -->
							<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $page_link; ?>" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/linkedin.png" alt="LinkedIn" />
							</a>
							
							<!-- Pinterest -->
							<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
								<img src="https://simplesharebuttons.com/images/somacro/pinterest.png" alt="Pinterest" />
							</a>
							
							<!-- Reddit -->
							<a href="http://reddit.com/submit?url=<?php echo $page_link; ?>&amp;title=bitroad: <?php echo $post_info['title']; ?>" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/reddit.png" alt="Reddit" />
							</a>
							
							<!-- Twitter -->
							<a href="https://twitter.com/share?url=<?php echo $page_link; ?>&amp;text=bitroad&amp;hashtags=bitroad" target="_blank">
								<img src="https://simplesharebuttons.com/images/somacro/twitter.png" alt="Twitter" />
							</a>   
						</div>
						<button class="btn btn-default" style="background-color: #eee;" id="contact-button" style="float: left;" onclick="getContactInfo();"> contact </button>
						<tr >							
							<span id="contact-info"></span>
						</tr>
					</div>			
					<center> <p style="font-size: 24px; font-weight: normal !important"><?php echo $post_info['description'] ?>	</p></center>
					</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<div class="col-xs-2"><p style="float: left;"><b>id:</b> <?php echo $post_id ?> </p>			</div>
				<div class="spam col-xs-8">				
					<center><?php if ($post_info['noSpam'] = 1) { echo '<i>please do not contact me with unsolicited services or offers.</i> ';}?></center>				
				</div>
				<div class="col-xs-2">
					<form class="form-horizontal" id="flag-post" method="POST" action="flagPost.php" enctype="multipart/form-data" style="float: right;">			
					
						<input type="text" class="form-control"  name="postId" style="display: none;" value="<?php echo $post_id ?>"> </input>	
						<button id="flag-btn" class="btn btn-default"><i class="glyphicon glyphicon-flag"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
	</div><!-- Container -->
<div id="footerDiv"></div>
</div>
</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<script>	

 $(window).load(function(){
       $('#shareModal').modal('show');
    });	

	//Close modal on skip
	$('#skip').click(function(){
		   $('#shareModal').modal('hide');
	});
	//Get the post id
	var post_id = <?php echo $post_id; ?>;

	$(function() {
		var intYear = "" + (new Date).getFullYear();
		$('#year').append(intYear);
				
		
// Save Posts	
	
	$('.glyphicon-heart').click(function(event){
		   if ($(this).hasClass('#post-like')) {  
				return false;
				event.preventDefault();
			}	
		});

	
	//Check if we like this post
	$('#post-like').each(function() {
			
			//Make sure localStorage exists
			if (localStorage.getItem("saved_posts") != null) 
			{		
				var id = String(post_id);
				
				//If this is in the saved posts array, make the heart red
				if (($.inArray(id, JSON.parse(localStorage["saved_posts"])) != -1)) 
				{
					$(this).css('color', 'red');
				}		
			}		
			
			else 
			{				
				return;
			}
	});
	
	$('#post-like').click(function(){
		
		//Get the id of the post to be saved
		var save_post_id = String(post_id);
			
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
				saved_posts.splice($.inArray(save_post_id, saved_posts),1);
				
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
				
		//CAROUSEL
	 
			$('#carousel-text').html($('#slide-content-0').html());
	 
			//Handles the carousel thumbnails
		   $('[id^=carousel-selector-]').click( function(){
				var id = this.id.substr(this.id.lastIndexOf("-") + 1);
				var id = parseInt(id);
				$('#myCarousel').carousel(id);
			});
	 
	 
			// When the carousel slides, auto update the text
			$('#myCarousel').on('slid.bs.carousel', function (e) {
					 var id = $('.item.active').data('slide-number');
					$('#carousel-text').html($('#slide-content-'+id).html());
			});

		
		//END CAROUSEL
		
		
	});
	
	function getContactInfo() {
		$.ajax({											
				type: "POST",
				url: "getContact.php",
				data: {postID : <?php echo $post_id; ?>},
				dataType:'json',
				cache: false,
				success: function(data){					
					var email = data["author_email"];
					var phone = data["author_phone"];
					var displayPhone = data["displayPhone"];
					
					//Check their preference
					if (displayPhone == 0) 
					{						
						phone = '';
					}
										
					//Check for email
					if (email == '') 
					{
						email = 'No e-mail provided.';
					}
					
					$('#contact-button').remove();
                                        $('#contact-button').css("pointer-events", "none");
					$('#contact-info').html('<p style="font-size: 14px !important;"><i class="glyphicon glyphicon-envelope" style="padding-right: 10px;"></i>' + email + '<br/><i class="glyphicon glyphicon-phone" style="padding-right: 10px;"></i>' + phone + '</p>');
					
				}
							
			}); 
	}



//Footer
$('#footerDiv').load('footer.html').trigger("create");
	
</script>
		

</body>
</html>
