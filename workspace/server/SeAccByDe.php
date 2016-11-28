<?php
    session_start();

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $_SESSION['TPDuration'] = $_POST['duration'];
    $_SESSION['Destination_DesName'] = $_POST['Destination_DesName'];
    $_SESSION['year'] = $_POST['year'];
    $_SESSION['month'] = $_POST['month'];
    $_SESSION['day'] = $_POST['day'];
    $_SESSION['TPQuota'] = $_POST['TPQuota'];
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } else {
        $DesName = $_POST['Destination_DesName'];
        $_SESSION['DesName']=$DesName;
        mysql_select_db("mydb", $db);
        $sql_Acc = "SELECT * FROM Accomodation where Destination_DesName = '$DesName'";
        $Acc = mysql_query($sql_Acc);
        $Acc_Array = Array();
        while ($Acc_row = mysql_fetch_array($Acc)) {
            $Acc_Array[] = $Acc_row;
           // print_r($Acc_Array);
        }
        $_SESSION['Acc_Array']=$Acc_Array;
        header("location: ../ShowAcc.php");
    }
?>