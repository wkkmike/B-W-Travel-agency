<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AddDestination - abc Travel Agency</title>
        <script src="//codepen.io/assets/libs/fullpage/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script type="text/javascript">
            setInterval(check,10);
            function check(){
                if($('#name').val()!='') $('#submit').removeAttr('disabled');
                else $('#submit').attr('disabled', 'disabled');
            }
        </script>
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
            <h1 style="margin-left: 30px;"> Add Destination  </h1>
        </div>
        <div class="left">
            <dl class="navigator">
                <dt class='link'><a href='AdminHome.php'>Home</a></dt>
                <dt class='link'><a href='AddDes.php'>Add Destination</a></dt>
                <dt class='link'><a href='AddAcc.php'>Add Hotel</a></dt>
                <dt class='link'><a href='AddFlight.php'>Add Flight</a></dt>
                <dt class='link'><a href='LogOut.php'>Log Out</a></dt>
            </dl>
        </div>
        <div class='middle'>
            <form action="server\AddDest.php" method='post' id='a'>
                Name: <input type='text' name='DesName' id='name'/></br>
                type: <select name='DesType'>
                    <option value='Culture'>Culture</option>
                    <option value='Seaside'>Seaside</option>
                    <option value='BigCity'>BigCity</option>
                    <option value='NaturalScenery'>Natural Scencry</option>
                    </select></br>
                <textarea rows="4" cols="50" name="DesDescribe" form="a">Enter description here...</textarea></br>
                <input type='submit' value = 'submit' disabled='disabled' id='submit'/>
            </form>
        </div>
    </body>