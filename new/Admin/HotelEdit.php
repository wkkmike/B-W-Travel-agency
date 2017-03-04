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
        $sql_Des = "SELECT DesName FROM Destination";
        $Des = mysql_query($sql_Des);
        $Des_Array = Array();
        while ($Des_row = mysql_fetch_array($Des)) {
            $Des_Array[] =  $Des_row['DesName'];  
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
        width: 100%; height: 400px;
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
        <script type="text/javascript">
            function initMap() {
                 var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 14,
                center: {lat: 22.3101809, lng: 114.18419779999999}
                });
                var geocoder = new google.maps.Geocoder();

                document.getElementById('submitAdd').addEventListener('click', function() {
                    geocodeAddress(geocoder, map);
                    
                });
            }
            function geocodeAddress(geocoder, resultsMap) {
                var address = document.getElementById('ade').value;
                geocoder.geocode({'address': address}, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
		                document.getElementById('lat').value = results[0].geometry.location.lat();
		                document.getElementById('lng').value = results[0].geometry.location.lng();
		                flag = true;
                        resultsMap.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                        map: resultsMap,
                        position: results[0].geometry.location
                        });
                    } 
                    else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
            initMap();
            google.maps.event.addDomListener(window, 'load', initMap);
        </script>
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
<form id="submitForm" name="submitForm" action="../server/AdminAddAcc.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="fyID" value="14458625716623" id="fyID"/>
	<div id="container">

		<div class="ui_content">
			<table  cellspacing="0" cellpadding="0" width="100%" align="left" border="0">
				<tr>
					<td class="ui_text_rt">Hotel Name</td>
					<td class="ui_text_lt">
						<input type="text" id="fyCh" name="AccName" class="ui_input_txt02"/>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Rating</td>
					<td class="ui_text_lt">
						<select name="AccRating" id="submitForm_fangyuanEntity_fyHxCode" class="ui_select01">
                            		<option value='1'>1</option>
									<option value='2'>2</option>
								    <option value='3'>3</option>
									<option value='4'>4</option>
									<option value='5'>5</option>
                        </select>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Destination</td>
					<td class="ui_text_lt">
						<select name="DesName" id="submitForm_fangyuanEntity_fyHxCode" class="ui_select01">
                        <?php
                            foreach($Des_Array as $a){
                                echo "<option value='$a'>$a</option>";
                            }
                        ?>
                        </select>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">AccAddress:</td>
					<td class="ui_text_lt">
						<input type="text" id="ade" name="AccAddress" class="ui_input_txt02"/>
						<input type="button" value = 'ok' size='10' name="ok" id='submitAdd'/>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Pic:</td>
					<td class="ui_text_lt">
						<input type="file" id="ade" name="file" class="ui_input_txt02"/>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td class="ui_text_lt">
						&nbsp;<input id="submitbutton" type="submit" value="submit" class="ui_input_btn01"/>
						&nbsp;<input id="cancelbutton" type="button" value="cancle" onclick="javascript:window.close()" class="ui_input_btn01"/>
					</td>
				</tr>
			</table>
			<input type='hidden' name = 'LAT' id = 'lat'/>
            <input type='hidden' name = 'LNG' id = 'lng'/>
		</div>
	</div>
</form>
<div id='map'>
</div>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>