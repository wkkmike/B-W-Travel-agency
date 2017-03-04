<?php
    session_start();
    if(!isset($_SESSION['user'])) die('Please Login');
    $user = $_SESSION['user'];
    $servername = 'mysql.comp.polyu.edu.hk';
    $username = '13104036d';
    $password = "markalvin";
    $TPId = $_GET['TPId'];
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
        // $sql_Acc = "SELECT Accomodation_AccName FROM TravelPlan where TPId = $TPId";
        // $Acc = mysql_query($sql_Acc);
        // $Acc_Name = $Acc[0];
        // $sql_map = "SELECT * from Accomodation where AccName in ";
        // $map = mysql_query($sql_map);
        // $map_Array = Array();
        // while ($map_row = mysql_fetch_array($map)){
        //     $map_Array[] =  $map_row;  
        // }
        $sql_TP = "SELECT * FROM TravelPlan 
        		  join Accomodation
        		  on TravelPlan.Accomodation_AccName = Accomodation.AccName
        		  where TPId = $TPId";
        $TP = mysql_query($sql_TP);
        $TP_Array = Array();
        while ($TP_row = mysql_fetch_array($TP)) {
            $TP_Array[] =  $TP_row;
        }
        
        $DesName = $TP_Array[0]['Destination_DesName'];
        $sql_same = "SELECT * FROM TravelPlan
        			join Accomodation
        			on TravelPlan.Accomodation_AccName = Accomodation.AccName
        			where TravelPlan.Destination_DesName = '$DesName'";
        $TPsame = mysql_query($sql_same);
        $TP_Same = Array();
        while ($same_row = mysql_fetch_array($TPsame)) {
            $TP_Same[] =  $same_row;
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
<style>
    #map{
        height:400px;
        width:100%;
    }
</style>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQKN6OxlkMN-Y090n26z5IMPFirsY3300&signed_in=true&callback=initMap"
        async defer></script>
        <?php echo"
        <script type='text/javascript'>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat:".$TP_Array[0]['LAT'].", lng:".$TP_Array[0]['LNG']."}
                });
            ";
            foreach ($TP_Array as $a) {
                echo "
                var marker = new google.maps.Marker({
                    position: {lat:".$a['LAT'].", lng:".$a['LNG']."},
                    title: ' ".$a['Accomodation_AccName']." '
                });
                marker.setMap(map);
                ";
            }
            echo "}
            initMap();
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
        ";?>
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
				<span class="page-title">Detail</span>
				<span class="page-desc">What a fantastic travel plan!</span>
			</div>
		</div>
		<!--subheader -->
		
		
		<div id="content">
		<form action='./server/AddOrder.php' method='post'>
		    <input name='TPId'type='hidden' value="<?=$TP_Array[0]['TPId'];?>"/>
			<div class="post-item post-thumb-hor">
				<div class="image-place">
					<img src="images/TPImage/<?php echo $TP_Array[0]['TPName'];?>.jpg" alt="<?php echo $TP_Array[0]['TPName'];?>" />
				</div>
				<div class="post-content">
					<h2 class="post-title"><?=$TP_Array[0]['TPName'];?></h2>
					<p class="post-excerpt"><?php echo substr($TP_Array[0]['TPDescrip'],0,200);?></p>
					<ul class="post-content-detail">
						<li>
							<span>Rating</span>
							<strong class="sprite-stars star<?=$TP_Array[0]['AccRating'];?>"><?=$TP_Array[0]['AccRating'];?> Stars</strong>
						</li>
						<li>
							<span>Price:</span>
							<strong class="price">$ <?=$TP_Array[0]['TPPrice'];?></strong>
						</li>
					</ul>
					<ul class="post-cotent-detail">
					    <li>
							<span>Date:</span>
							<input type="text" name='OrderStartDate' id="flight-depart" class="input-text input-cal" placeholder="2016-12-06" autocomplete="on" />
						</li>
						<li>
							<span>Quota:</span>
							<select name='TPQuota'>
							    <?php
							        for($a = $TP_Array[0]['TPQuotaMin']; $a <= $TP_Array[0]['TPQuotaMax']; $a++){
							            echo "<option value='$a'>$a</option>";
							        }
							     ?>
							</select>
						</li>
					</ul>
				</div>
				<div class="post-meta">
					<span class="icon-place"><?=$TP_Array[0]['Destination_DesName'];?></span>
					<span class="offer-type">Quota: <?=$TP_Array[0]['TPQuotaMin'];?> to <?=$TP_Array[0]['TPQuotaMax'];?></span>
					<span class="offer-type">Duration: <?=$TP_Array[0]['TPDuration'];?>day</span>
					<span class="offer-type" style="float:right"><input type='submit' formaction='./server/AddOrder.php'value='confirm'/></span>
				</div>
			</div>
		</form>
			<!--post item -->
		
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
				
				<div class="widget similiar-place">
					<div class="h3 widget-title">
						Similiar Place					</div>
					<div class="widget-content">
						<ul>
						    <?php
						       for($a = 0; $a< count($TP_Same) && $a<3; $a++){
						           echo '
						           <li class="link-thumb">
								<div class="link-image">
									<a href="browse-detail.php?TPId='.$TP_Same[$a]["TPId"].'"><img src="images/TPImage/'.$TP_Same[$a]["TPName"].'.jpg" alt="'.$TP_Same[$a]["TPName"].'"></a>	
								</div>
								<div class="link-text">
									<h5><a href="browse-detail.php?TPId='.$TP_Same[$a]["TPId"].'">'.$TP_Same[$a]["TPName"].'</a></h5>
									<p>
										<span class="place">'.$TP_Same[$a]["Destination_DesName"].'</span><br />
										<strong class="price">$'.$TP_Same[$a]["TPPrice"].'</strong> <span class="sprite-stars star'.$TP_Same[$a]["AccRating"].'">'.$TP_Same[$a]["AccRating"].' stars</span>
									</p>
								</div>
							</li>
						    ';
						       }
						    ?>
						</ul>
					</div>
				</div>
				<!--widget -->
			</div>
			<!--one third -->
			
			<div class="two-third last">
				
				<div class="module-box">
					<img height = '160' src="images/HotelImage/<?=$TP_Array[0]['Accomodation_AccName'];?>.jpg" alt="<?=$TP_Array[0]['Accomodation_AccName'];?>" />
					<h2><?=$TP_Array[0]['Accomodation_AccName'];?></h2>
					<P>
					    <b>Address: </b><?=$TP_Array[0]['AccAddress'];?>
					</P>
				<div id='map'>
			    </div>
					<br class="clear" />
				</div>
				<!--module-box -->
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