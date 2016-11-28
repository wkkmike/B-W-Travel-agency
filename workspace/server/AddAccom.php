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
        
        $AccName=$_POST['AccName'];
        $AccAddress = $_POST['AccAddress'];
        $AccRating = $_POST['AccRating'];
        $AccPrice  = $_POST['AccPrice'];
        $Destination_DesName = $_POST['Destination_DesName'];
        $LAT = $_POST['LAT'];
        $LNG = $_POST['LNG'];
       
        $sql="INSERT INTO Accomodation
            VALUES ('$AccName','$AccAddress','$AccRating','$AccPrice','$Destination_DesName','$LAT','$LNG')";
        
        $added=mysql_query($sql);
        
        if($added) {
            echo "Accomodation added.";
        } else{
            echo "Added failed.";
        }
    }
?>