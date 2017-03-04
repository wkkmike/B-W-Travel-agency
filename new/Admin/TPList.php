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
        
        // $DesName = $_POST["DesType"];
        if(!isset($_POST['DesName'])){
        	$sql_TP = "SELECT * FROM TravelPlan";
        }else {
        	$DesName = $_POST["DesName"];
        	$sql_TP = "SELECT * FROM TravelPlan WHERE Destination_DesName = '$DesName'";
        }
        $TP = mysql_query($sql_TP);
        $TP_Array = Array();
        while ($TP_row = mysql_fetch_array($TP)) {
            $TP_Array[] =  $TP_row;  
        }
    }
        
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="scripts/jquery/jquery-1.7.1.js"></script>
<link href="style/authority/basic_layout.css" rel="stylesheet" type="text/css">
<link href="style/authority/common_style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="scripts/authority/commonAll.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.js"></script>
<script type="text/javascript" src="scripts/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="style/authority/jquery.fancybox-1.3.4.css" media="screen"></link>
<script type="text/javascript" src="scripts/artDialog/artDialog.js?skin=default"></script>
<title>Admin</title>
<style>
	.alt td{ background:black !important;}
</style>
</head>
<body>
	<form id="submitForm" name="submitForm" method="post">
		<input type="hidden" name="allIDCheck" value="" id="allIDCheck"/>
		<input type="hidden" name="fangyuanEntity.fyXqName" value="" id="fyXqName"/>
		<div id="container">
			<div class="ui_content">
				<div class="ui_text_indent">
					<div id="box_border">
						<div id="box_top">Search</div>
						<form action="" method="post">
						<div id="box_center">
							Destination:
							<select name="DesName" id="fyXq" class="ui_select01" onchange="getFyDhListByFyXqCode();">
							<?php
                                foreach($Des_Array as $a){
                                    echo "<option value='$a'>$a</option>";
                                }
                            ?>
                            </select>
                            <input type="submit" value="Search" class="ui_input_btn01" onclick="window.location='' " /> 
						</div>
						</form>
					</div>
				</div>
			</div>
			<div class="ui_content">
				<div class="ui_tb">
					<table class="table" cellspacing="0" cellpadding="0" width="100%" align="center" border="0">
						<tr>
							<th width="30"><input type="checkbox" id="all" onclick="selectOrClearAllCheckbox(this);" />
							</th>
							<th>Name</th>
							<th>City</th>
							<th>Hotel</th>
							<th>QuotaMin</th>
							<th>QuotaMax</th>
							<th>Duration</th>
							<th>Description</th>
							<th>Picture</th>
							<th>Sales volume</th>
							<th>Price</th>
						</tr>
						<?php
							foreach($TP_Array as $a){
								echo "<tr><td><input type='checkbox' name='TPId[]' value=".$a['TPId']." class='acb'/></td>
								<td>".$a['TPName']."</td>
								<td>".$a['Destination_DesName']."</td>
								<td>".$a['Accomodation_AccName']."</td>
								<td>".$a['TPQuotaMin']."</td>
								<td>".$a['TPQuotaMax']."</td>
								<td>".$a['TPDuration']."</td>
								<td>".$a['TPDescrip']."</td>
								<td><img src='../images/TPImage/".$a['TPName'].".jpg'  height='80px' alt='".$a['TPName']."'/></td>
								<td>".$a['TPSalesCount']."</td>
								<td>".$a['TPPrice']."</td>
								</tr>";
							}
							?>
					</table>
					</br></br>
					<input type="submit" value="Delete" class="ui_input_btn01" formaction="../server/AdminDelTP.php"/>
				</div>
			</div>
		</div>
	</form>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
