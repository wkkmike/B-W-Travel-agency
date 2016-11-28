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
        <title>AddAccom -- abc Travel Agency</title>
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
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQKN6OxlkMN-Y090n26z5IMPFirsY3300&signed_in=true&callback=initMap"
        async defer></script>
        <script src="//codepen.io/assets/libs/fullpage/jquery.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script type="text/javascript">
            function initMap() {
                 var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: 22.3101809, lng: 114.18419779999999}
                });
                var geocoder = new google.maps.Geocoder();

                document.getElementById('submitAdd').addEventListener('click', function() {
                    geocodeAddress(geocoder, map);
                    
                });
            }
            function geocodeAddress(geocoder, resultsMap) {
                var address = document.getElementById('address').value;
                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
		                document.getElementById('lat').value = results[0].geometry.location.lat();
		                document.getElementById('lng').value = results[0].geometry.location.lng();
		                flag = true;
                        resultsMap.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                        map: resultsMap,
                        position: results[0].geometry.location
                        });
                    } 
                    else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
            initMap();
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
        <script type="text/javascript">
            setInterval(check, 10);
            function check(){
                if($('#name').val()!='' && $('#address').val()!='' && $('#price').val()!='' ) 
                    $('#submit').removeAttr('disabled');
                else $('#submit').attr('disabled', 'disabled');
            }
        </script>
    </head>
    <body>
        <div class='header'>
            <h1 style="margin-left: 30px;"> Add Hotel </h1>
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
            <form action="server\AddAccom.php" method='post'>
                Hotel Name: <input type="text" name="AccName" id='name'/></br>
                City: <select name='Destination_DesName' id='Des'>
                    <?php
                        foreach($Des_Array as $a){
                            echo "<option value='$a'>$a</option>";
                        }
                    ?>
                </select></br>
                Address: <input type='text' size ='50' name='AccAddress' id='address'/>
                After enter address please click this button <input type="button" value = 'ok' size='10' name="ok" id='submitAdd'/></br>
                Rating:<select name='AccRating' id='rating'>
                    <option value='1'>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4'>4</option>
                    <option value='5'>5</option>
                </select></br>
                Price: <input type='text' name='AccPrice' id='price'/></br>
                <input type='hidden' name = 'LAT' id = 'lat'/>
                <input type='hidden' name = 'LNG' id = 'lng'/>
                <input type='submit' value = 'submit' id='submit' disabled='disabled'/>
            </form>
            <div id='map'>
            </div>
        </div>
    </body>
</html>