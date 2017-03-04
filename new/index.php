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
 
        $sql = "SELECT * from TravelPlan order by TPSalesCount DESC"; 
        
        $result = mysql_query($sql);
        $pop = Array();
        while ($TP_row = mysql_fetch_array($result)) {
            $pop[] = $TP_row;
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
<!--<script type="text/javascript" src="http://maps.google.com/maps?file=api&amp;v=2&amp;sensor=false&amp;key=AIzaSyB3tShW1hLlV2lYW8_sCVln6TLF2bWvgU8"></script>-->
<script type="text/javascript" src="js/jquery.googlemaps.1.01.min.js"></script>
<script type="text/javascript" src="js/theme.js"></script>

<!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>

<body class="home">
<div id="slider-wrap">
	<div class="camera_wrap" id="camera-wrap">
		<div data-src="images/uploads/1280x800/shanghai.jpg">
		
			<div class="camera_caption moveFromBottom camera_text_center">
				<div class="caption_slider h2">
					30% Discount : 3 days travel to Shanghai
				</div>
			</div>
			
		</div>
		<div data-src="images/uploads/1280x800/hangzhou.jpg">
        
        	<div class="camera_caption moveFromLeft camera_text_center">
				<div class="caption_slider h2">
					Luxurious holiday in Hangzhou
				</div>
			</div>
        
        </div>
		<div data-src="images/uploads/1280x800/xizang.jpg">
        	
            <div class="camera_caption fadeIn camera_text_center">
				<div class="caption_slider h2">
					30% Discount : 3 days travel to Tibet
				</div>
			</div>
        
        </div>
		<div data-src="images/uploads/1280x800/beijing.jpg">
        
        	<div class="camera_caption moveFromBottom camera_text_center">
				<div class="caption_slider h2">
					Beijing most interesting spot
				</div>
			</div>
        
        </div>
		
		
	</div><!--camera-wrap -->
</div>

<div id="wrapper">
	<div id="container">
	
		<!--start header -->
		<header id="header">
			<div id="logo"><a href="index.php"><font color="#2b4d7f"><strong>B&amp;W agency</strong></font></a></div>	
			<div id="searchbox">
				
			</div>
			<div id="navigation">
			<div id="navigation">
				<ul id="nav">
					<li class='selected'><a href="index.php">Home</a></li>
					<li><a href="newRelase.php">New Realse</a></li>
					<li><a href="order.php">Order</a></li>
					<li><a href="edit.php" style="color:#20B4D9">User: <?php echo $user;?></a></li>
					<li><a><button onclick='javascript: location.href="./server/LogOut.php"'>logout</button></a></li>
				</ul>
			</div>
			</div>
		</header>
		<!--end header -->
		
		<!--start content -->
		<section id="content">
			<div class="two-third">
				<div id="searchmodule" class="tabs">
					<ul class="tab-control">
					  <li><a href="#hotel-search">Holiday Plan</a></li>
					</ul>
					
					<div id="hotel-search" class="tab-content">
						<form action="./server/UserSearchTP.php" method='post'>
							<div class="field">
								<label for="hotel-to">City:</label>
								<input name='DesName'type="text" id="hotel-to" class="input-text" placeholder="Destination" autocomplete="off" />
							</div>
							<div class="field half">
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
							<div class="field half even">
								<label for="hotel-return">Duration:</label>
								<select name="TPDuration">
									<option value='0'>Any</option>
									<option value='1'>1-5 Day</option>
									<option value='2'>6-10 Day</option>
									<option value='3'>10 Day up</option>
								</select>
							</div>
							<div class="field half">
							  <label for="hotel-class2">Price:</label>
							  <select name='TPPrice'>
							  	<option value='0'>Any</option>
							  	<option value='1'>$500-2500</option>
							  	<option value='2'>$2501-10000</option>
							  	<option value='3'>$10000up</option>
							  </select>
							</div>
							<div class="field half even">
							  <label for="hotel-class2">Rating:</label>
							  <select name='TPPrice'>
							  	<option value='0'>Any</option>
							  	<option value='1'>1</option>
							  	<option value='2'>2</option>
							  	<option value='3'>3</option>
							  	<option value='4'>4</option>
							  	<option value='5'>5</option>
							  </select>
							</div>
							<button type="submit" class="submit">Search</button>
							<br class="clear" />
						</form>
					</div>
					<!--hotel search -->
					
				</div>
			</div>
			<!--searchmodule -->
			
			<div class="one-third last">
				<div id="newsletter" class="module"> </div>
			</div>
			<!--newsletter -->
			<div class="copyrights">Collect from <a href="http://www.cssmoban.com/"  title="网站模板">网站模板</a></div>
			<div class="hr"><hr /></div>
			
			<div class="one-third">
				<h3 class="icon32 icon-tick thin">Book Easy</h3>
				<p>Most straightforward and convenient way to book your preferred flight and hotel.</p>
			</div>
			
			<div class="one-third">
				<h3 class="icon32 icon-tick thin">Save Cost</h3>
				<p>Provide various choices to help you save money.</p>
			</div>
			
			<div class="one-third last">
				<h3 class="icon32 icon-tick thin">Enjoy Flight</h3>
				<p>Cooperate with reliable flight companies to give you an enjoyable journey.</p>
			</div>
			
			<div class="hr"><hr /></div>			
			
			<!--newsection -->
			<div class="section-title">
				<span class="h3">Popular Travel Plan</span>
			</div>
			<?php
			for($a=0;$a<4 && $a<count($pop);$a++){
			echo '
			<div class="one-fourth">
				<div class="post-item">
					<div class="image-place">
						<img src="images/TPImage/'.$pop[$a]['TPName'].'.jpg" alt="'.$pop[$a]['TPName'].'" />
					</div>
					<div class="post-content">
						<h4 class="post-title">'.$pop[$a]['TPName'].'</h4>
					</div>
					<div class="post-meta">
						<span class="comment-count">$'.$pop[$a]['TPPrice'].'</span>
						<a class="read-more" href="./browse-detail.php?TPId='.$pop[$a]['TPId'].'">Detail</a>
					</div>
				</div>
			</div>
			';}
			?>
			<br class="clear" />
			
			<!--action-box -->
			
			
			<br class="clear" />
		</section>
		<!--end content -->
	
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