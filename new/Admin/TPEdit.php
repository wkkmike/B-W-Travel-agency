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
</style>
<script type="text/javascript" src="scripts/authority/commonAll.js"></script>
<script src="//codepen.io/assets/libs/fullpage/jquery.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery/jquery-1.4.4.min.js"></script>
<script src="scripts/My97DatePicker/WdatePicker.js" type="text/javascript" defer="defer"></script>
        <script type="text/javascript">
            
            function checkdate(){
                $('#day')
                .find('option')
                .remove()
                .end();
                if($('#month').val() == 4 || $('#month').val() == 6 || $('#month').val() == 9 || $('#month').val() == 11){
                    for(var i=1;i<31;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                    }
                }
                
                else if($('#month').val() == 1 || $('#month').val() ==3 || $('#month').val() ==5 || $('#month').val() ==7 || $('#month').val() ==8 || $('#month').val() ==10 || $('#month').val() ==12){
                    for(var i=1;i<32;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                    }
                }
                
                else{
                    if($('#year').val() % 4 == 0){
                       for(var i=1;i<30;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                    } 
                    }
                    else{
                       for(var i=1;i<29;i++){
                        $('#day').append($('<option>', {
                            value: i,
                            text: i
                        }));
                     
                    }
                }
            }
            }
        
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
<form id="submitForm" name="submitForm" action="TPEdit2.php" method="post" enctype="multipart/form-data">
	<div id="container">
		<div class="ui_content">
			<table  cellspacing="0" cellpadding="0" width="100%" align="left" border="0">
				<tr>
					<td class="ui_text_rt">Destination:      </td>
					<td class="ui_text_lt">
						<select name='DesName'>
							<?php
                        		foreach($Des_Array as $a){
                            		echo "<option value='$a'>$a</option>";
                        		}
                    		?>
						</select>
					</td>
				</tr>
				<tr >
					<td class="ui_text_rt" >Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="ui_text_lt">
						<input type="text" id="ade" name="TPName" class="ui_input_txt02"/>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Quota:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="ui_text_lt">
						Min:<input type='number' name='QuotaMin' class="ui_input_txt02"/>
						Max:<input type='number' name='QuotaMax' class="ui_input_txt02"/>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Price:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td class="ui_text_lt">
						$<input type='number' name='price' class="ui_input_txt02"/>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Duration:&nbsp;&nbsp;&nbsp;</td>
					<td class="ui_text_lt">
						<select name='duration'>
                    	<?php 
                            for($month=1;$month<20;$month++) echo "<option value='$month'>$month</option>";
                        ?>
               			</select>
					</td>
				</tr>
				<tr>
					<td class="ui_text_rt">Describtion:&nbsp;&nbsp;&nbsp;</td>
					<td class="ui_text_lt">
						<textarea rows="4" cols="50" name="des" form="submitForm" Placeholder='Enter description here...'></textarea></br>	
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