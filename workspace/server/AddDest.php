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
        
        $DesName=$_POST['DesName'];
        $DesType=$_POST['DesType'];
        $DesDescribe=$_POST['DesDescribe'];
        
        $sql="INSERT INTO Destination
            VALUES ('$DesName','$DesType','$DesDescribe')";
        
        $added=mysql_query($sql);
        
        if($added) {
            echo "Destination added.";
        } else{
            echo "Added failed.";
        }
    }
?>