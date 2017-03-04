
<!DOCTYPE html>
<html>
<head>
		<meta charset="utf-8">
		<link href="css/style1.css" rel='stylesheet' type='text/css' />
		<style type="text/css">
			span{
				font-size:14px;
			}
	    </style>
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
            var nflag = false;
            var pflag = false;
            var eflag = false;
            var phflag = false;
            var ppflag = false;
            var dflag = false;
            var fnflag = false;
            var lnflag = false;
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
            
            function passwordcheck1(){
                var re=/^[0-9]{6,10}$/;
                if(!re.test($('#Pword1').val())){
                    $('#pword1').text('Invalid input, please input 6-10 numbers');
                    $('#pword1').css("color", "red");
                    pflag = false;
                }
                else{
                     $('#pword1').css("color", "silver");
                     $('#pword1').text('Valid');
                     pflag = true;
                }
            }
            
            function same(){
                if($('#checkPword1').val() != $('#Pword1').val() ){
                    $('#checkpword1').text('the password is not same with the above one.');
                    $('#checkpword1').css("color", "red");
                    ppflag = false;
                }
                else if($('#checkPword1').val() == $('#Pword1').val()){
                    $('#checkpword1').text('Same');
                    $('#checkpword1').css("color", "silver");
                    ppflag = true;
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
                if(nflag && pflag && phflag && eflag && ppflag && dflag && fnflag && lnflag) $('#login').removeAttr('disabled');
                else $('#login').attr('disabled','true');
            }
        </script>
		<!--webfonts-->
		<!--//webfonts-->
</head>
<body>
	<div class="main">
		<div class="header" >
			<h1>Login or Create a Free Account!</h1>
		</div>
		<p></p>
			<form action='server/UserSignUp.php' method='post'>
				<ul class="left-form">
					<h3>New Account:</h3>
					<div style="font-family:verdana;font-size:16px;">Username</div> 
					<li>
						<input type="text"   placeholder="8-20 characters" name="UserAccount" onchange="namecheck1()" id='Uname1' required/>
						<div class="clear"> </div>
					</li>
					<span id='uword1' style="font-size: 14px" ></span> 
					<div style="font-family:verdana;font-size:16px;">Create a password</div> 
					<li>
						<input type="password"   placeholder="6-10 numbers" name="UserPassword" onchange='passwordcheck1()' id='Pword1' required/>
						<div class="clear"> </div>
					</li>
					<span id='pword1' style="font-size: 14px" ></span> 
					<div style="font-family:verdana;font-size:16px;">Confirm your password</div>
					<li>
						<input type="password"   placeholder="6-10 numbers"  name="checkPword" onchange='same()' id='checkPword1' required/>
						<div class="clear"> </div>
					</li>
					<span id='checkpword1' style="font-size: 14px" ></span>
					<div style="font-family:verdana;font-size:16px;">Email address</div>
				    <li>
						<input type="text"   placeholder="Email address" onchange = 'emailcheck()' name="UserEmail" id="email" required/>
						<div class="clear"> </div>
					</li>
					<span id='eword'></span>
					<div style="font-family:verdana;font-size:16px;">HongKong mobile phone</div>
					<li>
						<input type="text"   placeholder="8 numbers" onchange = 'phonecheck()' name = 'UserPhoneNum' id='phone'required/>
						<div class="clear"> </div>
					</li>
					<span id='phword'></span>
					<div style="font-family:verdana;font-size:16px;">Birthday:</div>
					<li>
					    <select  name='year' id='year' onchange = 'checkdate()'>
                          <?php 
                            for($year=1949;$year<2015;$year++){ 
                                echo "<option value='$year'>$year</option>";
                            }
                            ?>
                        </select>
                        <select name='month' id='month' onchange='checkdate()'>
                            <?php 
                            for($month=1;$month<13;$month++) echo "<option value='$month'>$month</option>";
                            ?>
                        </select>
                        <select name='day' id='day'>
                            
                        </select></br>
					</li>
					<div style="font-family:verdana;font-size:16px;">FirstName</div>
					<li>
						<input type="text"   placeholder="FirstName" name="UserFirstName" onchange="fncheck()" id='fn' required/>
						<div class="clear"> </div>
					</li>
					<span id='fnword'></span>
					<div style="font-family:verdana;font-size:16px;">LastName</div>
					<li>
						<input type="text"   placeholder="LastName" name="UserLastName" onchange="lncheck()" id='ln' required/>
						<div class="clear"> </div>
					</li>
					<span id='lnword'></span>
					</br></br>
					<input type="submit" value="Create Account"  disabled="disabled" id='login'/>
						<div class="clear"> </div>
				</ul>
				</form>
				<form action='server/UserSignIn.php' method='post'>
				<ul class="right-form">
					<h2>Login:</h2>
					<div>
					<div style="font-family:verdana;font-size:16px;">Username</div>
					<li><input type="text"  placeholder="8-20 characters" name="UserAccount" onchange="namecheck()" id='Uname' required/></li>
					<span id='unword'></span>
					<div style="font-family:verdana;font-size:16px;" >Password</div>
					<li> <input type="password"  placeholder="6-10 numbers"  name="UserPassword" onchange='passwordcheck()' id='Pword' required/></li>
					<span id='pword'></span>
					<input type="submit" value="Login"  disabled="disabled" id='login1'/></div>
					<div class="clear"> </div>
					
				</ul>
				<div class="clear"> </div>
					
				</form>	
		</div>
</body>
</html>