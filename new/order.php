<?php
    session_start();
    	if(!isset($_SESSION['user'])) die("Please log in");
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
	}
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
 
        $sql = "SELECT * from TravelPlan
        		join UserOrder
        		on TravelPlan.TPId = UserOrder.TravelPlan_TPId
        		where User_UserAccount = '$user';"; 
        
        $result = mysql_query($sql);
        $TP_new = Array();
        while ($TP_row = mysql_fetch_array($result)) {
            $TP_new[] = $TP_row;
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
					<li class="selected"><a href="order.php">Order</a></li>
					<li><a href="edit.php" style="color:#20B4D9">User: <?php echo $user;?></a></li>
					<li><a><button onclick='javascript: location.href="./server/LogOut.php"'>logout</button></a></li>
				</ul>
			</div>
		</header>
		<!--end header -->
		
		
		<div class="subheader">
			<div class="left">
				<span class="page-title">Order</span>
				<span class="page-desc">Your Order</span>
			</div>
		</div>
		<!--subheader -->
		<div id="content">
			<div class="two-third">
						
		<?php 
		for($a = 0;$a<count($TP_new) && $a<5;$a++){
				echo'<div class="post-item post-blog">
				<div class="image-place">
					<img src="images/TPImage/'.$TP_new[$a]['TPName'].'.jpg" alt="'.$TP_new[$a]['TPName'].'" />
					</div>
					<div class="post-content">
						<h2 class="post-title"><a href="./browse-detail.php?TPId='.$TP_new[$a]['TPId'].'">'.$TP_new[$a]['TPName'].'v</a></h2>
						<p class="post-excerpt">'.substr($TP_new[$a]['TPDescrip'],0,200).'</p>
					</div>
					<div class="post-meta">
					    <span class="comment-count">Price: $'.$TP_new[$a]['TPPrice'].'</span>
					    <span class="comment-count">Start date: $'.$TP_new[$a]['OrderStartDate'].'</span>
					    <span class="comment-count">Quota: $'.$TP_new[$a]['OrderQuota'].'</span>
						<a class="read-more" href="./browse-detail.php?TPId='.$TP_new[$a]['TPId'].'">Detail</a>
					</div>
				</div>';
		}
		?>
			</div>
			<!--two-third -->
			
			<div class="hr"><hr /></div>
						
		
						
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