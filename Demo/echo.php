<?php
	include('../inc/site_config.php');
	/*echo strtotime("2015-8-10 16:00:10");
	echo "</br>";	
	echo strtotime("2015-8-13 16:00:10");	
	echo "</br>";	
	echo strtotime("2015-9-15 16:00:10");	
	echo "</br>";	
	echo strtotime("2015-10-17 16:00:10");	
	echo "</br>";	
	echo strtotime("2015-8-11 16:00:10");
	echo "</br>";	
	echo strtotime("2015-10-28 16:00:10");	*/
	echo date('Y-m-d H:i:s',$service_time);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=800px" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/calendar.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="../js/lang/cn.js"></script>
<script type="text/javascript" src="../js/date.js"></script>
<script type="text/javascript">
function transdate(endTime){ 
var date=new Date(); 
date.setFullYear(endTime.substring(0,4)); 
date.setMonth(endTime.substring(5,7)-1); 
date.setDate(endTime.substring(8,10)); 
date.setHours(endTime.substring(11,13)); 
date.setMinutes(endTime.substring(14,16)); 
date.setSeconds(endTime.substring(17,19));
return Date.parse(date)/1000; 
}
function writeDiv(endTime){
	var sortTime = transdate(endTime);
	document.getElementById("tDiv").innerHTML = sortTime;
}
</script>
</head>
<body>
<div style="margin:0 auto;width:350px;height:300px;">
<span style="padding-left:5px;">输入时间：</span><!--<input type="text" name="time" id="time"/>-->
<input type="text" name="PerTime" id="time" onclick="SelectDate(this);" contenteditable="false" check="期望试听时间必须填写!~*"  
	class="input1 on_date runcode"  placeholder="请选择日期3" 
	style="padding:0px 0 0 5px;color:#999;line-height:40px;">
<input type="button" value="转化" id="btn" onclick="writeDiv(document.getElementById('time').value);" />
<div id="tDiv" style="margin:5px 5px;width:300px;height:50px;border:1px solid #DDDDDD"></div>
</div>
</body>
</html> 