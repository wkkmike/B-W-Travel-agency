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
        	$sql_Acc = "SELECT * FROM Accomodation";
        }else {
        	$DesName = $_POST["DesName"];
        	$sql_Acc = "SELECT * FROM Accomodation WHERE Destination_DesName = '$DesName'";
        }
        $Acc = mysql_query($sql_Acc);
        $Acc_Array = Array();
        while ($Acc_row = mysql_fetch_array($Acc)) {
            $Acc_Array[] =  $Acc_row;  
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
							<th>Rating</th>
							<th>Address</th>
							<th>Image</th>
						</tr>
						<?php
							foreach($Acc_Array as $a){
								echo "<tr><td><input type='checkbox' name='AccId[]' value=".$a['AccId']." class='acb'/></td>
								<td>".$a['AccName']."</td>
								<td>".$a['Destination_DesName']."</td>
								<td>".$a['AccRating']."</td>
								<td>".$a['AccAddress']."</td>
								<td><img src='../images/HotelImage/".$a['AccName'].".jpg'  height='80px' alt='".$a['AccName']."'/></td>
								</tr>";
							}
							?>
					</table>
					</br></br>
					<input type="submit" value="Delete" class="ui_input_btn01" formaction="../server/AdminDelAcc.php"/>
				</div>
			</div>
		</div>
	</form>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
