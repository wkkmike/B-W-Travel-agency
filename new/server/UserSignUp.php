<?php
    session_start();
    unset($_SESSION['user']);
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
        
        $UserAccount=$_POST['UserAccount'];
        $UserPassword=$_POST['UserPassword'];
        $UserEmail=$_POST['UserEmail'];
        $UserPhoneNum=$_POST['UserPhoneNum'];
        $UserBirthday=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
        $UserLastName = $_POST['UserLastName'];
        $UserFirstName = $_POST['UserFirstName'];
        date_default_timezone_set("Asia/Hong_Kong");
		$time = time();
        
        echo $UserAccount;
        echo $UserPassword;
        echo $UserEmail;
        echo $UserPhoneNum;
        echo $UserBirthday;
        echo $UserFirstName;
        echo $UserLastName;
        echo $time;
        
        $date = date('y-m-d', $time);
        
        $sql="INSERT INTO User
            VALUES ('$UserAccount','$UserPassword','$UserEmail','$UserPhoneNum','$UserBirthday',DEFAULT,'$UserFirstName','$UserLastName')";
        $num=mysql_query($sql);
        
        if($num) {
            $_SESSION['user']= $UserAccount;
            $sql = "INSERT INTO History (HistoryDate,Visitor,SalesCount)
                    VALUES ('$date','1','0')
                    ON DUPLICATE KEY UPDATE 
                    Visitor= Visitor + 1;";
            $k = mysql_query($sql);
            header("location: ../index.php");
        } else{
            echo "Register failed.";
        }
    }
?>