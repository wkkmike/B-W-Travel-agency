<?php
    session_start();
    if(!isset($_SESSION['user'])) die('Please Login');
    $servername = 'mysql.comp.polyu.edu.hk';
    $username = '13104036d';
    $password = "markalvin";
    $user = $_SESSION['user'];
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . $db->connect_error);
    } else {
        mysql_select_db("13104036d", $db);
        
        $sql = "Select * from User where UserAccount = '$user';";
        $result = mysql_query($sql);
        $user_array = Array();
        while ($user_row = mysql_fetch_array($result)) {
            $user_array[] = $user_row;
        }
        
        $str = $user_array[0]['UserBirthday'];
        $umonth = substr($str,5,2);
        $uday = substr($str,8,2);
        $uyear = substr($str,0,4);
        
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
<link href="css/style1.css" rel='stylesheet' type='text/css' />
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
<script src="//codepen.io/assets/libs/fullpage/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script type="text/javascript">
            function namecheck(){
                var re=new RegExp("^[(A-z)|(0-9)]{8,20}$");
                if(!re.test($('#Uname').val())){
                    $('#unword').text('Invalid input,please input 8-20 characters');
                    $('#unword').css("color", "red");
                }
                else{
                     $('#unword').css("color", "silver");
                     $('#unword').text('Valid');
                     if(/^[0-9]{6,10}$/.test($('#Pword').val())){
                        $('#login1').removeAttr('disabled');
                    }
                }
            }
            function passwordcheck(){
                var re=/^[0-9]{6,10}$/;
                if(!re.test($('#Pword').val())){
                    $('#pword').text('Invalid input, please input 6-10 numbers');
                    $('#pword').css("color", "red");
                }
                else{
                     $('#pword').css("color", "silver");
                     $('#pword').text('Valid');
                     if(/^[(A-z)|(0-9)]{8,20}$/.test($('#Uname').val())){
                        $('#login1').removeAttr('disabled');
                    }
                }
            }
        </script>
        <script type="text/javascript">
            var nflag = true;
            var pflag = true;
            var eflag = true;
            var phflag = true;
            var ppflag = true;
            var dflag = true;
            var fnflag = true;
            var lnflag = true;
            setInterval(check, 10);
            
            function fncheck(){
                if($("#fn").val()== ""){
                    $('#fnword').text('Please input your first name');
                    $('#fnword').css("color", "red");
                    fnflag = false;
                }
                else{
                    $('#fnword').text('Valid');
                    $('#fnword').css("color", "silver");
                    fnflag = true;
                }
            }
            
            function lncheck(){
                if($("#ln").val()== ""){
                    $('#lnword').text('Please input your last name');
                    $('#lnword').css("color", "red");
                    lnflag = false;
                }
                else{
                    $('#lnword').text('Valid');
                    $('#lnword').css("color", "silver");
                    lnflag = true;
                }
            }
            
            function namecheck1(){
                var re=new RegExp("^[(A-z)|(0-9)]{8,20}$");
                if(!re.test($('#Uname1').val())){
                    $('#uword1').text('Invalid input,please input 8-20 characters');
                    $('#uword1').css("color", "red");
                    nflag = false;
                }
                else{
                     $('#uword1').css("color", "silver");
                     $('#uword1').text('Valid');
                     nflag = true;
                }
            }
            
            $(function(){
                $('#date').combodate();    
            });
            
            function emailcheck(){
                var re=/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i;
                if(!re.test($('#email').val())){
                    $('#eword').text('Invalid Email');
                    $('#eword').css("color", "red");
                    eflag = false;
                }
                else{
                     $('#eword').css("color", "silver");
                     $('#eword').text('Valid');
                     eflag = true;
                }
            }
            
            function phonecheck(){
                var re=/^[0-9]{8}$/
                if(!re.test($('#phone').val())){
                    $('#phword').text('Invalid Phone Number');
                    $('#phword').css("color", "red");
                    phflag = false;
                }
                else{
                     $('#phword').css("color", "silver");
                     $('#phword').text('Valid');
                     phflag = true;
                }
            }
            
            function checkdate(){
                $('#day')
                .find('option')
                .remove()
                .end();
                dflag = true;
                if($('#month').val() == 4 || $('#month').val() == 6 || $('#month').val() == 9 || $('#month').val() == 11){
                    for(var i=1;i<31;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                    }
                }
                
                else if($('#month').val() == 1 || $('#month').val() ==3 || $('#month').val() ==5  || $('#month').val() ==7 || $('#month').val() ==8 || $('#month').val() ==10 || $('#month').val() ==12){
                    for(var i=1;i<32;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                    }
                }
                
                else{
                    if($('#year').val() % 4 == 0){
                       for(var i=1;i<30;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                    } 
                    }
                    else{
                       for(var i=1;i<29;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                     
                    }
                }
            }
            }
            
            function check(){
                if(nflag && phflag && eflag && dflag && fnflag && lnflag) $('#login').removeAttr('disabled');
                else $('#login').attr('disabled','true');
            }
        </script>
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
					<li class='selected'><a><button onclick='javascript: location.href="./server/LogOut.php"'>logout</button></a></li>
				</ul>
			</div>
		</header>
		<!--end header -->
		
		
		<div class="subheader">
			<div class="left">
				<span class="page-title">Edit</span>
				<span class="page-desc">New information?</span>			</div>
		</div>
		<!--subheader -->
		<div id="content">
			<div class="module-box">
				<div class="one-half">
			<form action='./server/UserEditProfile.php' method='post'>
				<ul class="left-form">
					<h2>Edit :</h2></br></br>
					<div style="font-family:verdana;font-size:16px;">Email address</div>
				    <li>
						<input type="text" value="<?=$user_array[0]['UserEmail'];?>"  placeholder="Email address" onchange = 'emailcheck()' name="UserEmail" id="email" required/>
						<div class="clear"> </div>
					</li>
					<span id='eword'></span>
					<div style="font-family:verdana;font-size:16px;">HongKong mobile phone</div>
					<li>
						<input type="text" value="<?=$user_array[0]['UserPhoneNum'];?>"  placeholder="8 numbers" onchange = 'phonecheck()' name = 'UserPhoneNum' id='phone'required/>
						<div class="clear"> </div>
					</li>
					<span id='phword'></span>
					<div style="font-family:verdana;font-size:16px;">Birthday:</div>
					<li>
                        <select  name='year' id='year' onchange = 'checkdate()'>
                          <?php 
                            for($year=1949;$year<2015;$year++) {
                                if($year == $uyear) echo "<option value='$year' selected='selected'>$year</option>";
                                else echo "<option value='$year'>$year</option>";
                            }
                            ?>
                        </select>
                        <select name='month' id='month' onchange='checkdate()'>
                            <?php 
                            for($month=1;$month<13;$month++) {
                                if($month == $umonth) echo "<option value='$month' selected='selected'>$month</option>";
                                else  echo "<option value='$month'>$month</option>";
                            }
                            ?>
                        </select>
                        <select name='day' id='day'>
                            <option value='<?=$uday;?>'><?=$uday;?></option>
                        </select></br>
					</li>
					<div style="font-family:verdana;font-size:16px;">FirstName</div>
					<li>
						<input type="text" value="<?=$user_array[0]['UserFirstName'];?>" placeholder="FirstName" name="UserFirstName" onchange="fncheck()" id='fn' required/>
						<div class="clear"> </div>
					</li>
					<span id='fnword'></span>
					<div style="font-family:verdana;font-size:16px;">LastName</div>
					<li>
						<input type="text"  value="<?=$user_array[0]['UserLastName'];?>" placeholder="LastName" name="UserLastName" onchange="lncheck()" id='ln' required/>
						<div class="clear"> </div>
					</li>
					<span id='lnword'></span>
					</br></br>
					<input type="submit" value="Edit"  disabled="disabled" id='login'/>
						<div class="clear"> </div>
				</ul>
			</form>
				</div>
				
				<br class="clear" />
			</div>
			<!--module-box -->
			
			<br class="clear" />	
		</div>
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