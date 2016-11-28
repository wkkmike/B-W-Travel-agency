<?php
    session_start();
    $result = $_SESSION['Des_Array'];
    $duration = $_SESSION['TPDuration'];
    $city = $_SESSION['city'];
    $year = $_SESSION['year'];
    $month = $_SESSION['month'];
    $day = $_SESSION['day'];
    $Des = $_SESSION['Acc_Array'];
    $quota = $_SESSION['TPQuota'];
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Select Hotel -- abc Travel Agency</title>
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
        <?php echo"
        <script type='text/javascript'>
            function initMap() {
                 var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat:".$Des[0]['LAT'].", lng:".$Des[0]['LNG']."}
                });
            ";
            foreach ($Des as $a) {
                echo "
                var marker = new google.maps.Marker({
                    position: {lat:".$a['LAT'].", lng:".$a['LNG']."},
                    title: ' ".$a['AccName']." '
                });
                marker.setMap(map);
                ";
            }
            echo "}
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
        ";?>
        <script type="text/javascript">
        </script>
    </head>
    <body>
        <div class='header'>
            <h1 style="margin-left: 30px;"> Select Hotel </h1>
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
            <form action='server/SeFliByDe.php' method='post'>
                <table border='1'>
                    <tr>
                        <th>Hotel Name</th>
                        <th>Hotel Rating</th>
                        <th>Price</th>
                        <th>Address</th>
                        <th>Choose</th>
                    </tr>
                        <?php
                        foreach($Des as $a){
                            echo "<tr>
                            <td>".$a['AccName']."</td>
                            <td>".$a['AccRating']."</td>
                            <td>".$a['AccPrice']."</td>
                            <td>".$a['AccAddress']."</td>
                            <td><input type='radio' name = 'Accomodation' value='".$a['AccName']."'/><td>
                            </tr>";
                        }
                        ?>
                </table>
                <input type='submit' value='submit'/>
            </form></br></br>
            <div id='map'>
            </div>
        </div>
    </body>
</html>