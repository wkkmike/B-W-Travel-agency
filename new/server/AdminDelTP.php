<?php
    session_start();
	if(!isset($_SESSION['admin'])) die('Please log in');
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
        $TP_array = $_POST["TPId"];
        echo gettype($_POST["TPId"]);
        print_r($_POST["TPId"]);
        foreach ($TP_array as $TPID){
            $sql_TP = "SELECT TPName from TravelPlan where TPId = $TPID";
            $r = mysql_query($sql_TP);
            $p = mysql_fetch_row($r);
            $TPName = $p[0];
            echo $TPID;
            $sql_TP = "DELETE from TravelPlan where TPId = $TPID";
            $TP = mysql_query($sql_TP);
            if($TP){ 
                if (file_exists("../images/TPImage/" .$TPName.".jpg")){
                    echo "\nright";
                    unlink("../images/TPImage/".$TPName.".jpg");
                }
                echo $TPName." deleted";
            }
            else{
                echo "failed";
            }
        }
    }
?>