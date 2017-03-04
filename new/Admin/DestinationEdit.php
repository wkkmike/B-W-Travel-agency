<?php
	session_start();
	if(!isset($_SESSION['admin'])) die('Please log in');
?>
<!DOCTYPE html>
<html>
<head>
<title>Destination edit</title>
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
<script type="text/javascript" src="scripts/jquery/jquery-1.4.4.min.js"></script>
<script src="scripts/My97DatePicker/WdatePicker.js" type="text/javascript" defer="defer"></script>
<script type="text/javascript" src="scripts/artDialog/artDialog.js?skin=default"></script>
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
<form id="submitForm" name="submitForm" action="../server/AdminAddDes.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="fyID" value="14458625716623" id="fyID"/>
	<div id="container">
		<div class="ui_content">
			<table  cellspacing="0" cellpadding="0" width="100%" align="left" border="0">
				<tr>
					<td class="ui_text_rt">Name</td>
					<td class="ui_text_lt">
						<input type="text" id="fyCh" name="DesName" class="ui_input_txt02"/>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Type</td>
					<td class="ui_text_lt">
						<select name="DesType" id="submitForm_fangyuanEntity_fyHxCode" class="ui_select01">
									<option value='1'>Cultural tourism</option>
								    <option value='2'>Adventure travel</option>
									<option value='3'>Ecotourism</option>
									<option value='4'>Sex tourism</option>
									<option value='5'>Religious tourism</option>
                        </select>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Picture:</td>
					<td class="ui_text_lt">
						<input type="file" id="fyCh" name="file" class="ui_input_txt02"/>
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
		</div>
	</div>
</form>
<div style="display:none"><script src='http://v7.cnzz.com/stat.php?id=155540&web_id=155540' language='JavaScript' charset='gb2312'></script></div>
</body>
</html>