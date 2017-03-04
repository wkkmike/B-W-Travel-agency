<?php
	session_start();
	if(!isset($_SESSION['user'])) die('Please Login');
	$user = $_SESSION['user'];
	$TPResult = $_SESSION['TP_Array'];
	if($TPResult)
		$DES = $TPResult[0]['DesName'];
	else
		$DES = $_SESSION['dES'];
    $servername = 'mysql.comp.polyu.edu.hk';
    $username = '13104036d';
    $password = "markalvin";
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . $db->connect_error);
    } else {
        mysql_select_db("13104036d", $db);
        $sql_Des = "SELECT DesName FROM Destination";
        $Des = mysql_query($sql_Des);
        $Des_Array = Array();
        while ($Des_row = mysql_fetch_array($Des)) {
            $Des_Array[] =  $Des_row['DesName'];  
        }
        
    }
?>
<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie ie7" lang="en"><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"><!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>TravelSite Theme</title>
<link rel="icon" type="image/x-icon" href="favicon.ico">


<!-- Mobile Specific
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/responsive.css" />

<!-- Java Script
================================================== -->
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.24.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile.customized.min.js"></script>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="js/camera.min.js"></script> 
<script type="text/javascript" src="js/jquery.isotope.min.js"></script>
<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="js/selectnav.min.js"></script>
<!--
<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyB3tShW1hLlV2lYW8_sCVln6TLF2bWvgU8"></script>-->
<script type="text/javascript" src="js/jquery.googlemaps.1.01.min.js"></script>
<script type="text/javascript" src="js/theme.js"></script>

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body class="blog">

<div id="slider-wrap">
	<div class="camera_overlayer"></div>
</div>

<div id="wrapper">
	<div id="container">
	
		<!--start header -->
				<header id="header">
			<div id="logo"><a href="index.php"><font color="#2b4d7f"><strong>B&amp;W agency</strong></font></a></div>	
			<div id="searchbox">
				
			</div>
			<div id="navigation">
				<ul id="nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="newRelase.php">New Realse</a></li>
					<li><a href="order.php">Order</a></li>
					<li><a href="edit.php" style="color:#20B4D9">User: <?php echo $user;?></a></li>
					<li><a><button onclick='javascript: location.href="./server/LogOut.php"'>logout</button></a></li>
				</ul>
			</div>
		</header>
		<!--end header -->
		
		
		<div class="subheader">
			<div class="left">
				<span class="page-title">Result</span>
				<span class="page-desc">Choose your faviroute plan</span>			</div>
		</div>
		<!--subheader -->
		
		
		<div id="content">
			<div class="one-third">
				<div id="searchmodule">
					<ul class="tab-control">
						<li class="ui-tabs-selected"><a href="#hotel-search">Travel Plan</a></li>						
					</ul>					
					<div id="hotel-search" class="tab-content">
						<form action="./server/UserSearchTP.php">
							<div class="field">
								<label for="hotel-to">City:</label>
									<select name='DesName'>
									<?php
                        				foreach($Des_Array as $a){
                            				echo "<option value='$a'>$a</option>";
                        				}
                    				?>
						</select>
							</div>
							<div class="field half">
								<label for="hotel-return">Duration:</label>
								<select name="TPDuration">
									<option value='0'>Any</option>
									<option value='1'>1-5 Day</option>
									<option value='2'>6-10 Day</option>
									<option value='3'>10 Day up</option>
								</select>
							</div>
							<div class="field half even">
								<label for="hotel-depart">Travel Type:</label>
								<select name='DesType'>
									<option value='0'>Any</option>
									<option value='1'>Cultural tourism</option>
								  	<option value='2'>Adventure travel</option>
									<option value='3'>Ecotourism</option>
									<option value='4'>Sex tourism</option>
									<option value='5'>Religious tourism</option>
								</select>
							</div>
							<button type="submit" class="submit">Search</button>
							<br class="clear" />
						</form>
					</div>
					<!--hotel search -->
				</div>
				<!--searchmodule -->				
				
				<div class="widget refine-search">
					<div class="h3 widget-title">
						Refine Your Search					</div>
					<div class="widget-content">
						<h5>Stars</h5>
						<ul class="pointer">
							<li>
								<a href="./server/UserRefineSR.php?AccRating=1&DesName=<?php echo $DES;?>" class="sprite-stars star1">1 Star</a>
							</li>
							<li>
								<a href="./server/UserRefineSR.php?AccRating=2&DesName=<?php echo $DES;?>" class="sprite-stars star2">2 Star</a>
							</li>
							<li>
								<a href="./server/UserRefineSR.php?AccRating=3&DesName=<?php echo $DES;?>" class="sprite-stars star3">3 Star</a>
							</li>
							<li>
								<a href="./server/UserRefineSR.php?AccRating=4&DesName=<?php echo $DES;?>" class="sprite-stars star4">4 Star</a>
							</li>
							<li>
								<a href="./server/UserRefineSR.php?AccRating=5&DesName=<?php echo $DES;?>" class="sprite-stars star5">5 Star</a>
							</li>
						</ul>
						
						<h5>Price Range ($)</h5>
						<ul class="pointer">
							<li>
								<a href="./server/UserRefineSR.php?TPPrice=1&DesName=<?php echo $DES;?>">500 - 2500</a>
							</li>
							<li>
								<a href="./server/UserRefineSR.php?TPPrice=2&DesName=<?php echo $DES;?>">2501 - 10000</a>
							</li>
							<li>
								<a href="./server/UserRefineSR.php?TPPrice=3&DesName=<?php echo $DES;?>">10000 up</a>
							</li>
						</ul>
						
					</div>
				</div>
				<!--widget -->
			</div>
			<!--one third -->
			
			<div class="two-third last">
			<?php
				foreach ($TPResult as $a) {
					echo '
				<div class="post-item post-thumb-hor">
					<div class="image-place">
						<img src="./images/TPImage/'.$a["TPName"].'.jpg" alt="'.$a["TPName"].'"/>					
					</div>
					<div class="post-content">
						<h2 class="post-title">'.$a["TPName"].'</h2>
						<p class="post-excerpt">'.substr($a['TPDescrip'],0,200).'</p>
						<ul class="post-content-detail">
							<li>
								<span>Rating</span>
								<strong class="sprite-stars star'.$a["AccRating"].'">'.$a["AccRating"].'Stars</strong>							
							</li>
							<li>
								<span>Price: </span>
								<strong class="price">$ '.$a["TPPrice"].'</strong>							
							</li>
							<li>
								<span>Type: </span>
								<strong class="price">';
							switch($a["DesType"]){
								case 1:
									echo 'Culture';
									break;
								case 2:
									echo 'Adventure';
									break;
								case 3:
									echo 'Ecotourism';
									break;
								case 4:
									echo 'Sex';
									break;
								case 5:
									echo 'Religious';
									break;
							}
								echo '
								</strong>							
							</li>
						</ul>
					</div>
					<div class="post-meta">
						<span class="icon-place">'.$a["DesName"].'</span>
						<span class="offer-type">Quota: '.$a["TPQuotaMin"].' to '.$a["TPQuotaMax"].'</span>
						<span class="offer-type">Duration: '.$a["TPDuration"].'day</span>
						<a class="read-more" href="./browse-detail.php?TPId='.$a["TPId"].'">Booking</a>					
					</div>
				</div>
					';
				}
				?>
			</div>
			<!--two third -->
			
			<br class="clear" />	
		</div>
		<!--content -->
	
	</div>
	<!--container -->
	
	<!--start footer -->
	<footer id="footer">
		<div class="wrap">
			<div class="one-fourth">
				<div class="theme-logo"><strong>B&W</strong>Agency</div>
				<p>Our tourism platform aims to providing you with a fantastic holiday.</p>
			</div>
			
			<div class="one-fourth">
				<h3>Quick Links</h3>
				<ul>
					<li><a href="https://www.polyu.edu.hk/web/en/home/index.html">The Hong Kong Polytechnic University</a></li>
					<li><a href="http://www.comp.polyu.edu.hk/en-us/">PolyU COMP</a></li>
				</ul>
			</div>
			
			<div class="one-fourth">
				<h3>Our Office</h3>
				<ul>
					<li class="glyph-home">PQ818</li>
					<li class="glyph-briefcase">Phone : +852-2766-7259</li>
					<li class="glyph-envelope">Email : cssongguo@comp.polyu.edu.hk</li>
				</ul>
			</div>
			
			
			
			<br class="clear" />
		</div>
		<!--footer wrap -->
	</footer>
	<!--end footer -->
	
	<section id="subfooter">
		<div class="wrap">
			<div class="left">
				Copyright &copy; 2016.B&amp;W agency All rights reserved.</a>
			</div>
			
			<div class="foot-links right">
				
			</div>
			
			<br class="clear" />
		</div>
	</section>
	<!--subfooter -->
	
</div>
<!--wrapper -->

</body>
</html>