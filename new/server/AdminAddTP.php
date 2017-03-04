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
        
        $TPName = $_SESSION['TPName'];
        $TPDuration = $_SESSION['TPDuration'];
        $TPQuotaMin = $_SESSION['QuotaMin'];
        $TPQuotaMax = $_SESSION['QuotaMax'];
        $Accomodation_AccName = $_POST['Accomodation'];
        $Destination_DesName = $_SESSION['DesName'];
        $TPPrice = $_SESSION['TPPrice'];
        $TPDescrip = $_SESSION['TPDes'];
        
        echo $TPName;
        echo $TPDuration;
        echo $TPQuotaMin;
        echo $TPQuotaMax;
        echo $Accomodation_AccName;
        echo $Destination_DesName;
        echo $TPPrice;
        echo $TPDescrip;
        
        $sql_Add = "insert into TravelPlan
            (TPId, TPName, TPDuration, TPQuotaMin, Accomodation_AccName, Destination_DesName, TPPrice, TPQuotaMax, TPDescrip, TPSalesCount)
            values (NULL, '$TPName', '$TPDuration', '$TPQuotaMin', '$Accomodation_AccName', '$Destination_DesName', '$TPPrice', '$TPQuotaMax', '$TPDescrip', '0');";
        
        $added=mysql_query($sql_Add);
        
        if($added) {
             if ((($_FILES["file"]["type"] == "image/gif")
            || ($_FILES["file"]["type"] == "image/jpeg")
            || ($_FILES["file"]["type"] == "image/pjpeg"))
            && ($_FILES["file"]["size"] < 5000000))
{
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("../images/TPImage/" . $TPName .".jpg"))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../images/TPImage/" .  $TPName .".jpg");
      echo "Stored in: " . "../images/TPImage/" .  $TPName .".jpg";
      }
    }
}
            echo "TP added.";
        }
        else{
            echo "Added failed.";
        }
    }
?>