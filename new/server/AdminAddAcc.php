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
        
        $AccName=$_POST['AccName'];
        $AccAddress = $_POST['AccAddress'];
        $AccRating = $_POST['AccRating'];
        $Destination_DesName = $_POST['DesName'];
        $LAT = $_POST['LAT'];
        $LNG = $_POST['LNG'];
        
        echo $AccName;
        echo $AccAddress;
        echo $AccRating;
        echo $Destination_DesName;
        echo $LAT;
        echo $LNG;
       
        $sql="INSERT INTO Accomodation
            (AccName, AccAddress, AccRating, Destination_DesName, LAT, LNG, AccId)
            VALUES ('$AccName','$AccAddress','$AccRating','$Destination_DesName','$LAT','$LNG',NULL)";
        
        $added=mysql_query($sql);
        
        if($added) {
            echo "Accomodation added.";
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

    if (file_exists("../images/HotelImage/" . $AccName .".jpg"))
      {
      echo $_FILES["file"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../images/HotelImage/" .  $AccName .".jpg");
      echo "Stored in: " . "../images/HotelImage/" .  $AccName .".jpg";
      }
    }
  }
else
  {
  echo "Invalid file";
  }
        } else{
            echo "Added failed.";
        }
    }
?>