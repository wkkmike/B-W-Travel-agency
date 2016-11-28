<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign In</title>
        <style type="text/css">
           #uword{
               color: black;
           } 
           #pword{
               color: black;
           }
        </style>
        <script src="//codepen.io/assets/libs/fullpage/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script type="text/javascript">
            var nflag = false;
            var pflag = false;
            var eflag = false;
            var phflag = false;
            var ppflag = false;
            var dflag = false;
            setInterval(check, 10);
            
            function namecheck(){
                var re=new RegExp("^[(A-z)|(0-9)]{8,20}$");
                if(!re.test($('#Uname1').val())){
                    $('#uword1').text('Invalid input,please input 8-20 characters');
                    $('#uword1').css("color", "red");
                    nflag = false;
                }
                else{
                     $('#uword1').css("color", "black");
                     $('#uword1').text('Valid');
                     nflag = true;
                }
            }
            
            function passwordcheck(){
                var re=/^[0-9]{6,10}$/;
                if(!re.test($('#Pword1').val())){
                    $('#pword1').text('Invalid input, please input 6-10 numbers');
                    $('#pword1').css("color", "red");
                    pflag = false;
                }
                else{
                     $('#pword1').css("color", "black");
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
                    $('#checkpword1').text('ok');
                    $('#checkpword1').css("color", "black");
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
                     $('#eword').css("color", "black");
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
                     $('#phword').css("color", "black");
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
                if(nflag && pflag && phflag && eflag && ppflag && dflag) $('#login').removeAttr('disabled');
                else $('#login').attr('disabled','true');
            }
        </script>
    </head>
    <body>
        <h1>Please Input Your Infomation</h1>
        <form action='server/UserSignUp.php' method='post'>
              User name:<input type="text" name="UserAccount" onchange="namecheck()" id='Uname1'/><span id='uword1'>8-20 characters</span><br/>
              Password: <input type="password" name="UserPassword" onchange='passwordcheck()' id='Pword1'/><span id='pword1'>6-10 numbers</span></input></br>
              Password(again): <input type="password" name="checkPword" onchange='same()' id='checkPword1'/><span id='checkpword1'>6-10 numbers</span></input></br>
              Email: <input type = 'text' size='50' onchange = 'emailcheck()' name="UserEmail" id="email"/><span id='eword'></span></br>
              Phone: <input type = 'text' size = '10' onchange = 'phonecheck()' name = 'UserPhoneNum' id='phone'/><span id='phword'>Please enter a HongKong Phone number(Only 8 numbers)</span></br>
              Birthday: <select name='year' id='year' onchange = 'checkdate()'>
                          <?php 
                            for($year=1901;$year<2015;$year++) echo "<option value='$year'>$year</option>";
                            ?>
                        </select>
                        <select name='month' id='month' onchange='checkdate()'>
                            <?php 
                            for($month=1;$month<13;$month++) echo "<option value='$month'>$month</option>";
                            ?>
                        </select>
                        <select name='day' id='day'>
                            
                        </select></br>
              <input type="submit" value="Sign Up" disabled="disabled" id='login'/>
              <div id="map"></div>
        </form>
    </body>