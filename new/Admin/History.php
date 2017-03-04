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
        if(!isset($_POST['act']) || $_POST["act"] == 0){
        	$sql_act = "SELECT * FROM History order by HistoryDate DESC";
        }
        else { 
        	$sql_act = "SELECT * FROM History order by HistoryDate  ASC";
        }
        
    	$act = mysql_query($sql_act);
        $act_Array = Array();
        while ($act_row = mysql_fetch_array($act)) {
            $act_Array[] =  $act_row;  
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
							Show Order:
							<select name="act" id="fyXq" class="ui_select01" onchange="getFyDhListByFyXqCode();">
									<option value='0'>New to old</option>
									<option value='1'>Old to new</option>
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
							<th>Date</th>
							<th>Vistor</th>
							<th>Sales</th>
						</tr>
						<?php
							foreach($act_Array as $a){
								echo "<tr><td><input type='checkbox' name='UserAccount[]' value= 1 class='acb'/></td>
								<td>".$a['HistoryDate']."</td>
								<td>".$a['Visitor']."</td>
								<td>".$a['SalesCount']."</td>
								</tr>";
							}
							?>
					</table>
					</br></br>
				</div>
			</div>
		</div>
	</form>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
