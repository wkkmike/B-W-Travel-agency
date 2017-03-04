<?php
    session_start();
    	if(!isset($_SESSION['user'])) die('Please log in');
    $servername = 'mysql.comp.polyu.edu.hk';
    $username = '13104036d';
    $password = "markalvin";

    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } else {
        $DesName = '%'.$_POST['DesName'].'%';
        
        $TPPrice = $_POST['TPPrice'];
        if ($TPPrice == 0) {
            $TPPriceMin = 0;
            $TPPriceMax = 999999;
        } else if ($TPPrice == 1) {
            $TPPriceMin = 500;
            $TPPriceMax = 2500;            
        } else if ($TPPrice == 2) {
            $TPPriceMin = 2501;
            $TPPriceMax = 10000;
        } else {
            $TPPriceMin = 10001;
            $TPPriceMax = 999999; 
        }
        $DesType = $_POST['DesType'];
        
        switch ($DesType)
        {
            case 0:
              $DesType = "%";
              break;
            case 1:
              $DesType = "1";
              break;
            case 2:
              $DesType = "2";
              break;
            case 3:
              $DesType = "3";
              break;
            case 4:
              $DesType = "4";
              break;
            case 5:
              $DesType = "5";
        }

        $TPDuration = $_POST['TPDuration'];
        switch ($TPDuration) {
        case 1:
            $TPDurationMin = 1;
            $TPDurationMax = 5;
            break;
        case 2:
            $TPDurationMin = 6;
            $TPDurationMax = 10;   
            break;
        case 3:
            $TPDurationMin = 11;
            $TPDurationMax = 99;
            break;
        case 0:
            $TPDurationMin = 1;
            $TPDurationMax = 99; 
        }
        $AccRating = $_POST['AccRating'];
        if ($AccRating == 0)
            $AccRating = '%';
        
        mysql_select_db("13104036d", $db);
 
        $sql = "SELECT * 
        from TravelPlan 
        join Accomodation 
        on TravelPlan.Accomodation_AccName = Accomodation.AccName
        join Destination
        on Destination.DesName = Accomodation.Destination_DesName
        where DesName like '$DesName'
        and TPPrice>='$TPPriceMin'
        and TPPrice<='$TPPriceMax'
        and DesType like '$DesType'
        and TPDuration>='$TPDurationMin'
        and TPDuration<='$TPDurationMax'
        and AccRating like '$AccRating'";
        
        
        $result = mysql_query($sql);
        $tp = Array();
        while ($TP_row = mysql_fetch_array($result)) {
            $tp[] = $TP_row;
        }
        $_SESSION['TP_Array']=$tp;
        header("location: ../browse-result.php"); 
    }
?>