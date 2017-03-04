<?php
    session_start();
		if(!isset($_SESSION['admin'])) die('Please log in');
    $servername = 'mysql.comp.polyu.edu.hk';
    $username = '13104036d';
    $password = "markalvin";
    
    // Create connection
    $db = mysql_connect($servername, $username, $password);
    $DesType;
    // Check connection
    if (!$db) {
        die("Connection failed: " . $db->connect_error);
    } else {
        mysql_select_db("13104036d", $db);
        if(!isset($_POST['DesType']) || $_POST["DesType"] == 0)
        	$sql_Des = "SELECT * FROM Destination";
        else { $DesType = $_POST["DesType"];
        switch ($DesType)
        {
            case 1:
              $sql_Des = "SELECT * FROM Destination WHERE DesType = 1";
              break;
            case 2:
              $sql_Des = "SELECT * FROM Destination WHERE DesType = 2";
              break;
            case 3:
              $sql_Des = "SELECT * FROM Destination WHERE DesType = 3";
              break;
            case 4:
              $sql_Des = "SELECT * FROM Destination WHERE DesType = 4";
              break;
            case 5:
              $sql_Des = "SELECT * FROM Destination WHERE DesType = 5";
              break;
        }
		}
        $Des = mysql_query($sql_Des);
        $Des_Array = Array();
        while ($Des_row = mysql_fetch_array($Des)) {
            $Des_Array[] =  $Des_row;  
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
							Destination type:
							<select name="DesType" id="fyXq" class="ui_select01" onchange="getFyDhListByFyXqCode();">
									<option value='0'>Any</option>
									<option value='1'>Cultural tourism</option>
								    <option value='2'>Adventure travel</option>
									<option value='3'>Ecotourism</option>
									<option value='4'>Sex tourism</option>
									<option value='5'>Religious tourism</option>
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
							<th>name</th>
							<th>Type</th>
							<th>Image</th>
						</tr>
						<?php
							foreach($Des_Array as $a){
								echo "<tr><td><input type='checkbox' name='DesId[]' value=".$a['DesId']." class='acb'/></td>
								<td>".$a['DesName']."</td>
								<td>";
								switch($a['DesType']){
									case 1:
										echo "Cultural tourism";
										break;
									case 2:
										echo "Adventure travel";
										break;
									case 3:
										echo "Ecotourism";
										break;
									case 4:
										echo "Sex tourism";
										break;
									case 5: 
										echo "Religious tourism";
								}
								echo"</td>
								<td><img src='../images/DesImage/".$a['DesName'].".jpg'  height='80px' alt='".$a['DesName']."'/></td>
								</tr>";
							}
							?>
					</table>
					</br></br>
					<input type="submit" value="Delete" class="ui_input_btn01" formaction="../server/AdminDelDes.php"/>
				</div>
			</div>
		</div>
	</form>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
