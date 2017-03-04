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
        
        $UserAccount=$_POST['UserAccount'];
        $UserEmail=$_POST['UserEmail'];
        $UserPhoneNum=$_POST['UserPhoneNum'];
        $UserBirthday=$_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];
        $UserLastName = $_POST['UserLastName'];
        $UserFirstName = $_POST['UserFirstName'];
        $User = $_SESSION["user"];
        
        echo $UserAccount;
        echo $UserPassword;
        echo $UserEmail;
        echo $UserPhoneNum;
        echo $UserBirthday;
        echo $UserFirstName;
        echo $UserLastName;
        
    
        
        $sql="update User
              set UserEmail = '$UserEmail',UserPhoneNum = '$UserPhoneNum',UserBirthday = '$UserBirthday',UserFirstName = '$UserFirstName',UserLastName = '$UserLastName'
              where UserAccount = '$User';";
        $num=mysql_query($sql);
        
        if($num) {
            $num=mysql_query($sql); 
            echo "<script type='text/javascript'>alert('edit success')</script>";
            header("location: ../index.php");
        } else{
            echo "update failed.";
            sleep(3);
            header("location: ../edit.php");
        }
    }
?>