<?php
    session_start();

    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    
    $TPStartDate = $_SESSION['year'].'-'.$_SESSION['month'].'-'.$_SESSION['day'];
    $TPDuration = $_SESSION['TPDuration'];
    $TPQuota = $_SESSION['TPQuota'];
    $Accomodation_AccName = $_SESSION['Accomodation_AccName'];
    $Destination_Name = $_SESSION['Destination_DesName'];
    $FlightNum = $_SESSION['FlightNum'];
    $UserAccount = $_SESSION['user'];
    
    
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } else {
        mysql_select_db("mydb", $db);
        
        echo $TPStartDate;
        echo $TPDuration;
        echo $TPQuota;
        echo $Accomodation_AccName;
        echo $Destination_Name;
        echo $FlightNum;
        
        $sql_Add = "insert into TravelPlan
            (TPId, TPStartDate, TPDuration, TPQuota, Accomodation_AccName, Flight_FlightNum, Destination_DesName)
            values (NULL, '$TPStartDate', '$TPDuration', '$TPQuota', '$Accomodation_AccName', '$FlightNum', '$Destination_Name');
            ";
        $Added = mysql_query($sql_Add);
        
        echo $Added;
        
        $sql = "SELECT LAST_INSERT_ID();";
        
        $pk = mysql_query($sql);
        echo $pk;
        echo "fuck";
        $pk_row = mysql_fetch_array($pk);
        $result = $pk_row[0];
        echo $result;
        echo $UserAccount;
        
        
        $sql_Add = "insert into OrderIF
            (OrderId, User_UserAccount, TravelPlan_TPId)
            values (NULL, '$UserAccount', '$result')";
        $Added = mysql_query($sql_Add);
        if ($Added)
            echo "Travel Plan Added.";
        else
            echo "Failed!";
        sleep(3);
        //sheader("location: ../UserHome.php"); 
    }
?>