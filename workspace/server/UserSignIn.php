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
        
        $AdminAccount=$UserAccount=$_POST['UserAccount'];
        $AdminPassword=$UserPassword=$_POST['UserPassword'];
        
        $sql1="SELECT * FROM User WHERE UserAccount='$UserAccount' AND UserPassword='$UserPassword';";
        $sql2="SELECT * FROM Admin WHERE AdminAccount='$AdminAccount' AND AdminPassword='$AdminPassword';";
        
        $rs1=mysql_query($sql1);
        $rs2=mysql_query($sql2);
        
        $num1=mysql_num_rows($rs1);
        $num2=mysql_num_rows($rs2);
        
        if($num1) {
            $row=mysql_fetch_array($rs1);
            $_SESSION['user']=$row['UserAccount'];
            echo $_SESSION['user'];
            //header("location: ../UserHome.php");
        } else if ($num2) {
            $row=mysql_fetch_array($rs2);
            echo $row;
            $_SESSION['admin']=$row['AdminAccount'];
            header("location: ../AdminHome.php");              
        } else{
            echo "UserName not exist or Wrong password";
        }
    }
?>