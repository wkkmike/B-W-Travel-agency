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
        
        $FlightDepTime=$_POST['DepHour'].':'.$_POST['DepMin'].':00';
        $FlightArrTime=$_POST['ArrHour'].':'.$_POST['ArrMin'].':00';
        $FlightPrice=$_POST['FlightPrice'];
        $FlightNum=$_POST['FlightNum'];
        $Destination_DesName=$_POST['Destination_DesName'];
        
        echo $FlightDepTime;
        echo $FlightArrTime;
        echo $FlightPrice;
        echo $FlightNum;
        echo $Destination_DesName;
        
        $sql="INSERT INTO Flight
            VALUES ('$FlightDepTime','$FlightArrTime','$FlightPrice','$FlightNum','$Destination_DesName')";
        $num=mysql_query($sql);
        
        if($num) {
            echo "Flight added.";
        } else{
            echo "Added failed.";
        }
    }
?>