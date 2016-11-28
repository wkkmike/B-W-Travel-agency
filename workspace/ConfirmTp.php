<?php
    session_start();
    $result = $_SESSION['Des_Array'];
    $duration = $_SESSION['TPDuration'];
    $city = $_SESSION['city'];
    $year = $_SESSION['year'];
    $month = $_SESSION['month'];
    $day = $_SESSION['day'];
    $Des = $_SESSION['Fli_Array'];
    $quota = $_SESSION['TPQuota'];
    $_SESSION['FlightNum'] = $_POST['FlightNum'];
    $flight = $_POST['FlightNum'];
    $hotel = $_SESSION['Accomodation_AccName'];
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
                <form action='server/UserAddTP.php' method='post'>
                <table border='1'>
                    <tr>
                        <th>Date</th>
                        <th>Duration</th>
                        <th>City</th>
                        <th>Hotel</th>
                        <th>Flight</th>
                        <th>Person</th>
                    </tr>
                    <tr>
                        <?php
                            echo "
                            <td>$year/$month/$day</td>
                            <td>$duration days</td>
                            <td>$city</td>
                            <td>$hotel</td>
                            <td>$flight</td>
                            <td>$quota</td>
                            ";
                        ?>
                    </tr>
                </table>
                <input type='submit' value='submit'/>
            </form>
        </div>
    </body>
</html>