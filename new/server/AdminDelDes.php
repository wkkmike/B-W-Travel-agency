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
        $Des_array = $_POST["DesId"];
        echo gettype($_POST["DesId"]);
        print_r($_POST["DesId"]);
        foreach ($Des_array as $DesID){
            $sql_Des = "SELECT DesName from Destination where DesId = $DesID";
            $r = mysql_query($sql_Des);
            $p = mysql_fetch_row($r);
            $DesName = $p[0];
            echo $DesID;
            $sql_Des = "DELETE from Destination where DesId = $DesID";
            $Des = mysql_query($sql_Des);
            if($Des){ 
                if (file_exists("../images/DesImage/" .$DesName.".jpg")){
                    echo "\nright";
                    unlink("../images/DesImage/".$DesName.".jpg");
                }
                echo $DesName." deleted";
            }
            else{
                echo "failed";
            }
        }
    }
?>