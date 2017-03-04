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
        $user_array = $_POST["UserAccount"];
        echo gettype($_POST["UserAccount"]);
        print_r($_POST["UserAccount"]);
        foreach ($user_array as $UserAccount){
            $sql_user = "DELETE from User where UserAccount = '$UserAccount'";
            $user = mysql_query($sql_user);
            if($user){ 
                echo $UserAccount." deleted";
            }
            else{
                echo "failed";
            }
        }
    }
?>