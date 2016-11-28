<?php
    session_start();

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $_SESSION['Accomodation_AccName'] = $_POST['Accomodation'];
    //$_SESSION['duration'] = $_POST['duration'];
    //$_SESSION['city'] = $_POST['Destination_DesName'];
    //$_SESSION['year'] = $_POST['year'];
    //$_SESSION['month'] = $_POST['month'];
    //$_SESSION['day'] = $_POST['day'];
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } else {
        $DesName = $_SESSION['DesName'];
        mysql_select_db("mydb", $db);
        $sql_Fli = "SELECT * FROM Flight where Destination_DesName = '$DesName'";
        $Fli = mysql_query($sql_Fli);
        $Fli_Array = Array();
        while ($Fli_row = mysql_fetch_array($Fli)) {
            $Fli_Array[] = $Fli_row;
            print_r($Fli_Array);
        }
        $_SESSION['Fli_Array']=$Fli_Array;
        header("location: ../ShowFlight.php"); 
    }
?>