<?php
    session_start();
    if(isset($_SESSION['admin']) || isset($_SESSION['user']) )
    {
        $_SESSION = array();
        session_destroy();
    }
    echo "Log Out successfully";
    sleep(3);
    header('location: ../login.php');
?>