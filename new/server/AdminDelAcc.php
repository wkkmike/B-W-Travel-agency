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
        $Acc_array = $_POST["AccId"];
        echo gettype($_POST["AccId"]);
        print_r($_POST["AccId"]);
        foreach ($Acc_array as $AccID){
            $sql_Acc = "SELECT AccName from Accomodation where AccId = $AccID";
            $r = mysql_query($sql_Acc);
            $p = mysql_fetch_row($r);
            $AccName = $p[0];
            echo $AccID;
            $sql_Acc = "DELETE from Accomodation where AccId = $AccID";
            $Acc = mysql_query($sql_Acc);
            if($Acc){ 
                if (file_exists("../images/HotelImage/" .$AccName.".jpg")){
                    echo "\nright";
                    unlink("../images/HotelImage/".$AccName.".jpg");
                }
                echo $AccName." deleted";
            }
            else{
                echo "failed";
            }
        }
    }
?>