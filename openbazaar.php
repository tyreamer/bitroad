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
				<center><h1>OpenBazaar</h1></center>
				<hr/>
			</div>
		</div>
		<div class="row absolute-center">
			<div class="col-xs-1"></div>
			<div class="col-xs-10">
				<div class="row">
					 <a href="https://openbazaar.org/">https://openbazaar.org/</a>
				</div>		
				<br/>
				<div class="row">
					<h3><b> BITCOIN ESCROW </b></h3>
					<p>We suggest using OpenBazaar's Bitcoin escrow service. Bit Roads fee-less escrow service, which will support all cryptocurrency, is coming soon.</p>
				</div>	
				<br/>
				<div class="row">
					<h3><b>WHAT IS OPENBAZAAR?</b></h3>
					<p>OpenBazaar is a different way to do online commerce. Instead of visiting a website, you download and install a program on your computer that directly connects you to other people looking to buy and sell goods and services with you. This peer to peer network isnt controlled by any company or organization - it's a community of people who want to engage in trade directly with each other.</p>
				</div>				
				<div class="row">
					<p> Bitcoin Escrow: How Moderators and Dispute Resolution Work in OpenBazaar </p>
				</div>	
				<br/>
				<div class="row">
					<p><b>Summary:</b> <i>OpenBazaar helps prevent fraud by having buyers send their bitcoins into a 2-of-3 multisignature address controlled by the buyer, seller, and a trusted third party. This third party offers dispute resolution in case something goes wrong. These third parties offer their services on an open marketplace.</i> </p>
					<p>Because OpenBazaar is a decentralized network for trade it has a very different system for moderation and dispute resolution than existing ecommerce platforms.</p>
					<p>Traditional centralized ecommerce platforms (Amazon, eBay, Etsy, etc) have dispute resolution built into their service to reduce fraud and scams. The companies listen to disputes from a buyer or seller, make a decision to determine which party they side with, and then take action to reward the winning party or penalize the losing party. Since they control the platform directly, they have the power to issue refunds (or work with the payment processors who do), uphold negative reviews (or delete negative ones) and ban people from their platform altogether. The fees associated with using the platforms pays for this service (among other services).</p>
					<p>This type of top-down, centralized disputed resolution on the platform isn't possible with OpenBazaar, which has no central point of control. However, a platform which had no safeguards to prevent fraud wouldnt be very appealing to users. So OpenBazaar introduces a different model: 2-of-3 multisignature escrow along with an open marketplace for third party key holders (called moderators). If these terms dont make sense to you, let me break it down.</p>
					<p></p>
				</div>	
				<br/>
				<div class="row">
					<h3><b>2-of-3 Multisignature Escrow</b></h3>
					<p>OpenBazaar uses Bitcoin. Unlike credit cards or Paypal, Bitcoin transactions cannot be reversed after they are sent. An important part of handling fraud over existing centralized platforms is reversing charges that are fraudulent. Since Bitcoin cannot be reversed, how can it handle fraud? </p>
					<p>Fortunately Bitcoin has a unique capability called multisignature transactions (also called multisig). Instead of just having one person control the bitcoins in a certain account (called addresses), you can have multiple people control the same bitcoins. However, they can only send those coins to another address if a certain number of people controlling the bitcoins agree.</p>
					<p>For example, you can have a 2-of-2 multisig address. This means that there are two people who control the address, and both of them must agree to a transaction before the bitcoins can be sent anywhere else. A 2-of-3 address means three people control the address, and two of them must agree before the funds can be spent.</p>
					<p>OpenBazaar uses 2-of-3 multisig addresses for transactions. When a buyer wants to purchase a listing, instead of sending the funds directly to the seller, he will send the funds to the multisig account. The three people who control this account are the buyer, the seller, and a trusted third party selected beforehand. We call these trusted third parties "moderators".</p>
					<p></p>
				</div>	
				<br/>
				<div class="row">
					<p>Now there are five possible ways for the funds to be released from the multisig address:</p>
					<ol class="list-group">
						<li class="list-group-item">The seller sends the product or delivers the service and the buyer is satisfied. The buyer and seller are the two of three parties needed for the multisig, and together they release the funds to the seller. This is what a normal transaction will look like.</li>
						<li class="list-group-item">The seller cannot deliver the listing as promised or the buyer is unhappy with the listing, and <b>they mutually agree to refund the buyer</b>. Again, the buyer and seller are the two of three parties needed for the multisig. This time they join together and release the funds to the buyer.</li>
						<li class="list-group-item">The buyer and seller are in a dispute and cannot agree how to release funds. The moderator comes in and decides that the <b>seller is at fault</b>. The moderator then joins with the buyer to release a refund to the buyer.</li>
						<li class="list-group-item">The buyer and seller are in a dispute and cannot agree how to release funds. The moderator comes in and decides that the <b>buyer is at fault</b>. The moderator then joins with the seller and releases the funds to the seller.</li>
						<li class="list-group-item">The buyer and seller are in a dispute and cannot agree how to release funds. The moderator comes in and decides that neither or both parties are at fault, and the moderator joins with either party to release funds in a split between buyer and seller.</li>						
					</ol>
					<p>In this fashion fraud is prevented by only allowing funds to be sent to the seller or refunded to buyer when either 1) buyer and seller mutually agree or 2) an independent third party decides which party is at fault and joins with the winning party to release funds.</p>
					<p>In the current OpenBazaar design, moderators make money by taking a percentage of the funds they release after a dispute. This percentage is set by the moderator and publicly displayed on their profile. Future designs may allow moderators to charge for being selected for a trade, or charge based on a subscription service.</p>
					<p>Astute readers will recognize that the moderator must be trustworthy for this system to work, otherwise he/she could collude with one of the other parties to release funds to them. This is why moderator selection and reputation are important.</p>
				</div>	
				<br/>
				<div class="row">
					<h3><b>Moderator selection and reputation</b></h3>
					<p>It is important that moderators are trustworthy. Competition is the best way to ensure accountability, and in OpenBazaar moderators are offered on a free market.</p>
					<p>Unlike central platforms which only offer one option for dispute resolution (themselves) on OpenBazaar these moderators are available on a marketplace within the platform itself. You can search through them and determine which one you want to use for dispute resolution, based on their own rules, or expertise, or their prices, or their real-world credentials, or based on the recommendation of other users.</p>
					<p>Over time, these moderators will develop reputations. OpenBazaar doesnt currently have a built-in reputation system for moderators, and users will need to rely on word of mouth, real world credentials, and/or forums such as the <a href="https://www.reddit.com/r/openbazaarmoderators">OpenBazaar Moderators subreddit</a>.</p>
					<p></p>
					<p></p>
				</div>	
				<br/>			
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

</body>
</html>

