<?php
    session_start();
    unset($_SESSION['user']);
    
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } else {
        mysql_select_db("mydb", $db);
        
        $UserAccount=$_POST['UserAccount'];
        $UserPassword=$_POST['UserPassword'];
        $UserEmail=$_POST['UserEmail'];
        $UserPhoneNum=$_POST['UserPhoneNum'];
        $UserBirthday=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
        
        echo $UserAccount;
        echo $UserPassword;
        echo $UserEmail;
        echo $UserPhoneNum;
        echo $UserBirthday;
        
        $sql="INSERT INTO User
            VALUES ('$UserAccount','$UserPassword','$UserEmail','$UserPhoneNum','$UserBirthday')";
        $num=mysql_query($sql);
        
        if($num) {
            $_SESSION['user']=$row['UserAccount'];
            header("location: ../UserHome.php");
        } else{
            echo "Register failed.";
        }
    }
?>