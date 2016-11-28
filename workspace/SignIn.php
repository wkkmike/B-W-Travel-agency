<!DOCTYPE html>
<html lang="en">
    <head>
        <title>WelcomePage - abc Travel Agency</title>
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
            function namecheck(){
                var re=new RegExp("^[(A-z)|(0-9)]{8,20}$");
                if(!re.test($('#Uname').val())){
                    $('#uword').text('Invalid input,please input 8-20 characters');
                    $('#uword').css("color", "red");
                }
                else{
                     $('#uword').css("color", "black");
                     $('#uword').text('Valid');
                     if(/^[0-9]{6,10}$/.test($('#Pword').val())){
                        $('#login').removeAttr('disabled');
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
                     $('#pword').css("color", "black");
                     $('#pword').text('Valid');
                     if(/^[(A-z)|(0-9)]{8,20}$/.test($('#Uname').val())){
                        $('#login').removeAttr('disabled');
                    }
                }
            }
            
        </script>
    </head>
    <body>
        <h1>abc Travel Agency</h1>
        <h2 id='wrongmessage'></h2>
        <form action='server/UserSignIn.php' method='post'>
              User name:<input type="text" name="UserAccount" onchange="namecheck()" id='Uname'/><span id='uword'>8-20 characters</span><br/>
              Password: <input type="password" name="UserPassword" onchange='passwordcheck()' id='Pword'/><span id='pword'>6-10 numbers</span></input></br>
              <input type="submit" value="Log In" disabled="disabled" id='login'/><br/>
              <button name="Sign Up" type="submit"  formaction='SignUp.php'>Sign Up</button>
        </form>
    </body>
</html>