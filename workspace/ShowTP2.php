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
        $tp = $_POST['TravelPlan_TPId'];
        mysql_select_db("mydb", $db);
        $sql = "SELECT * FROM TravelPlan where TPId = '$tp'";
        $Fli = mysql_query($sql);
        $Fli_Array = Array();
        while ($Fli_row = mysql_fetch_array($Fli)) {
            $Fli_Array[] = $Fli_row;
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title>SearchResult -- abc Travel Agency</title>
        <style type="text/css">
            .header{
                position:absolute;
                top:0px;
                margin:0;
                border:0;
                height:70px;
                width:100%;
                background-color: LightSkyBlue;
            }
            
            .left{
                position:absolute;
                float:left;
                top:70px;
                margin:0;
                border:0;
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
            
            #user{
                text-align:right;
            }
            
            #map{
                width: 500px; height: 400px;
            }
        </style>
        <script src="//codepen.io/assets/libs/fullpage/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
    </head>
    <body>
        <div class='header'>
            <p style="margin-left: 30px;"> Home </p>
            <p class='user' style='text-align:right'>UserName:<?php echo $_SESSION['user'];?></p>
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
            <p>City: <?php echo $city;?>   start time: <?php echo $year."/".$month."/".$day."     Duration: ".$duration."day"?>
                        Person: <?php echo $quota;?></p>
            <form action='ShowTP2.php' method='post'>
                <table border='1'>
                    <tr>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>Quota</th>
                        <th>City</th>
                        <th>Hotel</th>
                        <th>Flight</th>
                        <th>cancle</th>
                    </tr>
                    <tr>
                        <?php
                        foreach($Fli_Array as $a){
                            echo "
                            <th>".$a['TPStartDate']."</th>
                            <th>".$a['TPDuration']."</th>
                            <th>".$a['TPQuota']."</th>
                            <th>".$a['Destination_DesName']."</th>
                            <th>".$a['Accomodation_AccName']."</th>
                            <th>".$a['Flight_FlightNum']."</th>
                            <th><input type='radio'/>";
                        }
                        ?>
                    </tr>
                </table>
                <?php
                    echo "
                <input type='submit' name='TravelPlan_TPId' value='".$a['TravelPlan_TPId']."'/>";
                ?>
            </form>
        </div>
    </body>
</html>