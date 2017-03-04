<?php
    session_start();
	if(!isset($_SESSION['admin'])) die('Please log in');
    $servername = 'mysql.comp.polyu.edu.hk';
    $username = '13104036d';
    $password = "markalvin";
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . $db->connect_error);
    } else {
        mysql_select_db("13104036d", $db);
        
        $DesName=$_POST['DesName'];
        $DesType=$_POST['DesType'];
        
        $sql="INSERT INTO Destination
            (DesName, DesType, DesId)
            VALUES ('$DesName','$DesType', NULL)";
        
        $added=mysql_query($sql);
        
        if($added) {
            echo "Destination added.";
            if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/pjpeg"))
            && ($_FILES["file"]["size"] < 5000000)){
                if ($_FILES["file"]["error"] > 0){
                  echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
                  }
                else{
                  echo "Upload: " . $_FILES["file"]["name"] . "<br />";
                  echo "Type: " . $_FILES["file"]["type"] . "<br />";
                  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
                  echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
              
                  if (file_exists("../images/DesImage/" . $DesName .".jpg")){
                    echo $DesName . " already exists. ";
                  }
                  else{
                    move_uploaded_file($_FILES["file"]["tmp_name"],
                    "../images/DesImage/" .$DesName.".jpg");
                    echo "Stored in: " . "../images/DesImage/" .  $DesName .".jpg";
                  }
                }
            }
            else{
              echo "Invalid file";
            }
       } else{
          echo "Added failed.";
        }
    }
?>