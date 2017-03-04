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
        
        mysql_select_db("13104036d", $db);
        $DesName = $_GET['DesName'];
		$_SESSION['dES'] = $DesName;
        if(!isset($_GET['AccRating'])) {
            $TPPrice = $_GET['TPPrice'];
            echo $TPPrice;
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
            $sql = "SELECT * 
                    from TravelPlan 
                    join Accomodation 
                    on TravelPlan.Accomodation_AccName = Accomodation.AccName
                    join Destination
                    on Destination.DesName = Accomodation.Destination_DesName
                    where DesName = '$DesName'
                    and TPPrice>='$TPPriceMin'
                    and TPPrice<='$TPPriceMax'";
        } else{
            
            $AccRating = $_GET['AccRating'];
            if ($AccRating == 0)
                $AccRating = '%';
             $sql = "SELECT * 
                    from TravelPlan 
                    join Accomodation 
                    on TravelPlan.Accomodation_AccName = Accomodation.AccName
                    join Destination
                    on Destination.DesName = Accomodation.Destination_DesName
                    where DesName = '$DesName'
                    and AccRating like '$AccRating'";
        }
        
        
        
        $result = mysql_query($sql);
        $tp = Array();
        while ($TP_row = mysql_fetch_array($result)) {
            $tp[] = $TP_row;
        }
        $_SESSION['TP_Array']=$tp;
        header("location: ../browse-result.php"); 
    }
?>