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
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Select Hotel -- abc Travel Agency</title>
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
            <h1 style="margin-left: 30px;"> Select Hotel </h1>
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
            <form action='ConfirmTp.php' method='post'>
                <table border='1'>
                    <tr>
                        <th>Flight Number</th>
                        <th>Depture Time</th>
                        <th>Arrival Time</th>
                        <th>Flight Duration</th>
                        <th>Flight Price</th>
                        <th>Choose</th>
                    </tr>
                        <?php
                        foreach($Des as $a){
                        $dhour = substr($a['FlightDepTime'],0,2);
                        $dmin = substr($a['FlightDepTime'],3,2);
                        $ahour =  substr($a['FlightArrTime'],0,2);
                        $amin =  substr($a['FlightArrTime'],3,2);
                        $rhour = ($ahour - $dhour + 24) % 24;
                        $rmin = ($amin - $dmin +60) % 60;
                            echo "<tr>
                            <td>".$a['FlightNum']."</td>
                            <td>".$a['FlightDepTime']."</td>
                            <td>".$a['FlightArrTime']."</td>
                            <td>".$rhour."hr".$rmin."min</td>
                            <td>".$a['FlightPrice']."</td>
                            <td><input type='radio' name = 'FlightNum' value='".$a['FlightNum']."'/><td>
                            </tr>";
                        }
                        ?>
                </table>
                <input type='submit' value='submit'/>
            </form></br></br>
        </div>
    </body>
</html>