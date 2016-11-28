<!DOCTYPE html>
<html lang="en">
    <head>
        <title>WelcomePage - abc Travel Agency</title>
        <style type="text/css">
            .header{
                position:absolute;
                top:0px;
                height:70px;
                width:100%;
                background-color: LightSkyBlue;
            }
            
            .left{
                position:absolute;
                float:left;
                top:70px;
                height:100%;
                width:15%;
                background-color:Bisque;
            }
            
            .middle{
                position:relative;
                top:70px;
                float:right;
                width:84%;
                height:100%;
            }
            .link{
                padding:30px;
                font-size:200%;
                text-align:left;
            }
        </style>
    </head>
    <body>
        <div class='header'>
            <h1 style="margin-left: 30px;"> Home </h1>
        </div>
        <div class="left">
            <dl class="navigator">
                
            </dl>
        </div>
        <div class='middle'>
            <form action=''>
                <button type='submit' formaction='SignIn.php'>Sign In</button>
                <button type='submit' formaction='SignUp.php'>Sign Up</button>
            </form>
        </div>
    </body>