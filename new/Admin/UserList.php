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
        	$sql_act = "SELECT * FROM User order by UserLoginTime DESC";
        }
        else { 
        	$sql_act = "SELECT * FROM User order by UserLoginTime ASC";
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
									<option value='0'>Activite</option>
									<option value='1'>Unactivite</option>
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
							<th>UserName</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Last Login time</th>
						</tr>
						<?php
							foreach($act_Array as $a){
								echo "<tr><td><input type='checkbox' name='UserAccount[]' value=".$a['UserAccount']." class='acb'/></td>
								<td>".$a['UserAccount']."</td>
								<td>".$a['UserFirstName']."</td>
								<td>".$a['UserLastName']."</td>
								<td>".$a['UserEmail']."</td>
								<td>".$a['UserPhoneNum']."</td>
								<td>".$a['UserLoginTime']."</td>
								</tr>";
							}
							?>
					</table>
					</br></br>
					<input type="submit" value="Delete" class="ui_input_btn01" formaction="../server/AdminDelUser.php"/>
				</div>
			</div>
		</div>
	</form>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>
