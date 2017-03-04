<?php
    session_start();
    unset($_SESSION['user']);
    unset($_SESSION['admin']);
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
        
        $AdminAccount=$UserAccount=$_POST['UserAccount'];
        $AdminPassword=$UserPassword=$_POST['UserPassword'];
        
        $sql1="SELECT * FROM User WHERE UserAccount='$UserAccount' AND UserPassword='$UserPassword';";
        $sql2="SELECT * FROM Admin WHERE AdminAccount='$AdminAccount' AND AdminPassword='$AdminPassword';";
        
        $rs1=mysql_query($sql1);
        $rs2=mysql_query($sql2);
        
        $num1=mysql_num_rows($rs1);
        $num2=mysql_num_rows($rs2);
        
        if($num2) {
            $row=mysql_fetch_array($rs2);
            $_SESSION['admin']=$row['AdminAccount'];
            header("location: ../Admin/index.php"); 
        } else if ($num1) {
			date_default_timezone_set("Asia/Hong_Kong");
            $time = time();
            $date = date('y-m-d', $time);
            $row=mysql_fetch_array($rs1);
            $_SESSION['user']=$row['UserAccount'];
            $sql="update User
                  set UserLogInTime= CURRENT_TIMESTAMP
                  where UserAccount='$UserAccount';";
            $k = mysql_query($sql);
            $sql = "INSERT INTO History (HistoryDate,Visitor,SalesCount)
                    VALUES ('$date','1','0')
                    ON DUPLICATE KEY UPDATE 
                    Visitor= Visitor + 1;";
            $k = mysql_query($sql);
            header("location: ../index.php");
        } else{
            echo "UserName not exist or Wrong password";
        }
    }
?>