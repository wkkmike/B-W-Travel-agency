<?php
    session_start();
    
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } else {
        mysql_select_db("mydb", $db);
        $sql_Des = "SELECT DesName FROM Destination";
        $Des = mysql_query($sql_Des);
        $Des_Array = Array();
        while ($Des_row = mysql_fetch_array($Des)) {
            $Des_Array[] =  $Des_row['DesName'];  
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AddFlight -- abc Travel Agency</title>
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
            
            #map{
                width: 500px; height: 400px;
            }
        </style>
        <script src="//codepen.io/assets/libs/fullpage/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script type="text/javascript">
            setInterval(check, 10);
            var flag = false;
            var tflag = false;
            function change(){
                var re=/^[A-Z]{2}[0-9]{3,4}$/
                if(!re.test($('#fnum').val())){
                    $('#nword').text('Invalid Flight Number(e.g. CA1305)');
                    $('#nword').css("color", "red");
                    flag = false;
                }
                else{
                     $('#nword').css("color", "black");
                     $('#nword').text('Valid');
                     flag = true;
                }
            }
            
            function check(){
                if(tflag && flag && $('#price').val() !='') $('#submit').removeAttr('disabled');
                else $('#submit').attr('disabled', 'disabled');
            }
            
            function time(){
                var hour;
                var min;
                hour = ($('#Ahour').val() - $('#Dhour').val() + 24) % 24;
                min = ($('#Amin').val() - $('#Dmin').val() + 60) % 60;
                $("#ftime").html(hour + 'hr' + min + 'min');
                tflag = true;
            }
        </script>
    </head>
    <body>
        <div class='header'>
            <h1 style="margin-left: 30px;"> Add Flight </h1>
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
            <form action="server\AddFlight.php" method='post'>
                FlightNum: <input onchange='change()' type="text" name="FlightNum" id='fnum'/><span id='nword'>e.g. CA1305</span></br>
                Destination: <select name='Destination_DesName' id='Des'>
                    <?php
                        foreach($Des_Array as $a){
                            echo "<option value='$a'>$a</option>";
                        }
                    ?>
                </select></br>
                Depart time:<select name='DepHour' id='Dhour'>
                    <option value='00'>00</option>
                    <option value='01'>01</option>
                    <option value='02'>02</option>
                    <option value='03'>03</option>
                    <option value='04'>04</option>
                    <option value='05'>05</option>
                    <option value='06'>06</option>
                    <option value='07'>07</option>
                    <option value='08'>08</option>
                    <option value='09'>09</option>
                    <option value='10'>10</option>
                    <option value='11'>11</option>
                    <option value='12'>12</option>
                    <option value='13'>13</option>
                    <option value='14'>14</option>
                    <option value='15'>15</option>
                    <option value='16'>16</option>
                    <option value='17'>17</option>
                    <option value='18'>18</option>
                    <option value='19'>19</option>
                    <option value='20'>20</option>
                    <option value='21'>21</option>
                    <option value='22'>22</option>
                    <option value='23'>23</option>
                </select>hr
                <select name='DepMin' id='Dmin'>
                    <option value='00'>00</option>
                    <option value='05'>05</option>
                    <option value='10'>10</option>
                    <option value='15'>15</option>
                    <option value='20'>20</option>
                    <option value='25'>25</option>
                    <option value='30'>30</option>
                    <option value='35'>35</option>
                    <option value='40'>40</option>
                    <option value='45'>45</option>
                    <option value='50'>50</option>
                    <option value='55'>55</option>
                </select>min</br>
                Arrival time:<select name='ArrHour' id='Ahour'>
                    <option value='00'>00</option>
                    <option value='01'>01</option>
                    <option value='02'>02</option>
                    <option value='03'>03</option>
                    <option value='04'>04</option>
                    <option value='05'>05</option>
                    <option value='06'>06</option>
                    <option value='07'>07</option>
                    <option value='08'>08</option>
                    <option value='09'>09</option>
                    <option value='10'>10</option>
                    <option value='11'>11</option>
                    <option value='12'>12</option>
                    <option value='13'>13</option>
                    <option value='14'>14</option>
                    <option value='15'>15</option>
                    <option value='16'>16</option>
                    <option value='17'>17</option>
                    <option value='18'>18</option>
                    <option value='19'>19</option>
                    <option value='20'>20</option>
                    <option value='21'>21</option>
                    <option value='22'>22</option>
                    <option value='23'>23</option>
                </select>hr
                <select name='ArrMin' id='Amin'>
                    <option value='00'>00</option>
                    <option value='05'>05</option>
                    <option value='10'>10</option>
                    <option value='15'>15</option>
                    <option value='20'>20</option>
                    <option value='25'>25</option>
                    <option value='30'>30</option>
                    <option value='35'>35</option>
                    <option value='40'>40</option>
                    <option value='45'>45</option>
                    <option value='50'>50</option>
                    <option value='55'>55</option>
                </select>min</br>
                <input type='button' onclick='time()' value='confirm'></br>
                Flight time:<span id='ftime'></span></br>
                Price: $<input type='text' name='FlightPrice' id='price'/>HKD</br>
                <input type='submit' value = 'submit' id='submit' disabled='disabled' />
            </form>
        </div>
    </body>
</html>