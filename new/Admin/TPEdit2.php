<?php
    session_start();
	if(!isset($_SESSION['admin'])) die('Please log in');
    $servername = 'mysql.comp.polyu.edu.hk';
    $username = '13104036d';
    $password = "markalvin";
    $_SESSION['TPDuration'] = $_POST['duration'];
    $_SESSION['TPDes'] = $_POST['des'];
    $_SESSION['TPName'] = $_POST['TPName'];
    $_SESSION['DesName'] = $_POST['DesName'];
    $_SESSION['TPPrice'] = $_POST['price'];
    $_SESSION['QuotaMin'] = $_POST['QuotaMin'];
    $_SESSION['QuotaMax'] = $_POST['QuotaMax'];
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . $db->connect_error);
    } else {
        $DesName = $_SESSION['DesName'];
        mysql_select_db("13104036d", $db);
        $sql_Acc = "SELECT * FROM Accomodation where Destination_DesName = '$DesName'";
        $Acc = mysql_query($sql_Acc);
        $Acc_array = Array();
        while ($Acc_row = mysql_fetch_array($Acc)) {
            $Acc_array[] = $Acc_row;
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
<title>Hotel edit</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="scripts/jquery/jquery-1.7.1.js"></script>
<link href="style/authority/basic_layout.css" rel="stylesheet" type="text/css">
<link href="style/authority/common_style.css" rel="stylesheet" type="text/css">
<style type="text/css">
    #map{
        width: 100%; height: 400px
        }
</style>
<script type="text/javascript" src="scripts/authority/commonAll.js"></script>
<script src="//codepen.io/assets/libs/fullpage/jquery.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-1.4.4.min.js"></script>
<script src="scripts/My97DatePicker/WdatePicker.js" type="text/javascript" defer="defer"></script>
<script type="text/javascript" src="scripts/artDialog/artDialog.js?skin=default"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQKN6OxlkMN-Y090n26z5IMPFirsY3300&signed_in=true&callback=initMap"
        async defer></script>
        <?php echo"
        <script type='text/javascript'>
            function initMap() {
                var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: {lat:".$Acc_array[0]['LAT'].", lng:".$Acc_array[0]['LNG']."}
                });
            ";
            foreach ($Acc_array as $a) {
                echo "
                var marker = new google.maps.Marker({
                    position: {lat:".$a['LAT'].", lng:".$a['LNG']."},
                    title: ' ".$a['AccName']." '
                });
                marker.setMap(map);
                ";
            }
            echo "}
            initMap();
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
        ";?>
<script type="text/javascript">
	$(document).ready(function() {
		$("#submitbutton").click(function() {
			if(validateForm()){
				checkFyFhSubmit();
			}
		});
		
		$("#cancelbutton").click(function() {

			window.parent.$.fancybox.close();
		});
		
		var result = 'null';
		if(result =='success'){
			window.parent.$.fancybox.close();
		}
	});
</script>
</head>
<body>
<form id="submitForm" name="submitForm" action="../server/AdminAddTP.php" method="post" enctype="multipart/form-data">
	<div id="container">
		<div class="ui_content">
		    		<table>
		    <tr>
				<td class="ui_text_rt">Picture:&nbsp;&nbsp;&nbsp;</td>	
				<td class="ui_text_lt">
					<input type="file" id="ade" name="file" class="ui_input_txt02"/>	
				</td>
			</tr>
		</table>
			     <table border='1'>
                    <tr>
                        <th>Hotel Name</th>
                        <th>Hotel Rating</th>
                        <th>Address</th>
                        <th>Picture</th>
                        <th>Choose</th>
                    </tr>
                        <?php
                        foreach($Acc_array as $a){
                            echo "<tr>
                            <td>".$a['AccName']."</td>
                            <td>".$a['AccRating']."</td>
                            <td>".$a['AccAddress']."</td>
                            <td><img src='../images/HotelImage/".$a['AccName'].".jpg'  height='80px' alt='".$a['AccName']."' />
                            <td><input type='radio' name = 'Accomodation' value='".$a['AccName']."'/><td>
                            </tr>";
                        }
                        ?>
                </table>
                <input type='submit' value='submit' class="ui_input_btn01"/>
		</div>
	</div>
			<div id='map'>
</div>
</form>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>