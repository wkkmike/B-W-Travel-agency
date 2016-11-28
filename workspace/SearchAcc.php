<?php
    session_start();
   
    
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connectionz33
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
        <title>Search Travel Plan-- abc Travel Agency</title>
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQKN6OxlkMN-Y090n26z5IMPFirsY3300&signed_in=true&callback=initMap"
        async defer></script>
        <script type="text/javascript">
            
            function checkdate(){
                $('#day')
                .find('option')
                .remove()
                .end();
                if($('#month').val() == 4 || $('#month').val() == 6 || $('#month').val() == 9 || $('#month').val() == 11){
                    for(var i=1;i<31;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                    }
                }
                
                else if($('#month').val() == 1 || $('#month').val() ==3 || $('#month').val() ==5 || $('#month').val() ==7 || $('#month').val() ==8 || $('#month').val() ==10 || $('#month').val() ==12){
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
        
        </script>
    </head>
    <body>
        <div class='header'>
            <h1 style="margin-left: 30px;"> Search Travel Plan </h1>
        </div>
        <div class="left">
            <dl class="navigator">
                <dt class='link'><a href='UserHome.php'>Home</a></dt>
                <dt class='link'><a href='SearchAcc.php'>Add Travel Plan</a></dt>
                <dt class='link'><a href='ShowTp.php'>Show TP</a></dt>
                <dt class='link'><a href='server/LogOut.php'>Log Out</a></dt>
            </dl>
        </div>
        <div class='middle'>
            <form action='server/SeAccByDe.php' method='post'>
                City: <select name='Destination_DesName' id='Des'>
                    <?php
                        foreach($Des_Array as $a){
                            echo "<option value='$a'>$a</option>";
                        }
                    ?>
                </select></br>
                Start time:<select name='year' id='year' onchange = 'checkdate()'>
                            <?php 
                            for($year=2016;$year<2019;$year++) echo "<option value='$year'>$year</option>";
                            ?>
                            </select>
                            <select name='month' id='month' onchange='checkdate()'>
                            <?php 
                            for($month=1;$month<13;$month++) echo "<option value='$month'>$month</option>";
                            ?>
                            </select>
                            <select name='day' id='day'>
                            
                            </select></br>
                Duration:<select name='duration'>
                        <?php 
                            for($month=1;$month<10;$month++) echo "<option value='$month'>$month</option>";
                        ?>
                </select></br>
                Persons:<select name='TPQuota'>
                    <?php 
                            for($month=1;$month<10;$month++) echo "<option value='$month'>$month</option>";
                        ?>
                </select>
                <input type='submit' value='submit'/>
            </form>
        </div>
    </body>
</html>