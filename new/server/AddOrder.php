<?php
    session_start();
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
        
        $User_UserAccount = $_SESSION['user'];
        $TravelPlan_TPId = $_POST['TPId'];
        $str = $_POST['OrderStartDate'];
        $month = substr($str,0,2);
        $day = substr($str,3,2);
        $year = substr($str,6,4);
        $OrderStartDate = $year.'-'.$month.'-'.$day;
        $OrderQuota = $_POST['TPQuota'];
        
       
        
        $sql_Add = "insert into UserOrder
            (User_UserAccount, TravelPlan_TPId, OrderStartDate, OrderQuota )
            values ('$User_UserAccount', '$TravelPlan_TPId', '$OrderStartDate', '$OrderQuota');";
        
        $added=mysql_query($sql_Add);
        
        if($added) {
			date_default_timezone_set("Asia/Hong_Kong");
            $time = time();
            $date = date('y-m-d', $time);
            
            $sql_Update = "update TravelPlan
                           set TPSalesCount = TPSalesCount + 1
                           where TPId = $TravelPlan_TPId";
                       
            $update = mysql_query($sql_Update);
            
            $sql = "update History
                    set SalesCount = SalesCount + 1
                    where HistoryDate = '$date';";
                    
            $update = mysql_query($sql);
            echo "<script type='text/javascript'>alert('Order added');</script>/";
            echo "<script>window.location = '../index.php?';</script>";
        }
        else{
            echo "<script type='text/javascript'>alert('Added failed, you may have already ordered this TravelPlan');</script>";
            echo "<script>window.location = '../browse-detail.php?TPId=".$TravelPlan_TPId."';</script>";
        }
    }
?>