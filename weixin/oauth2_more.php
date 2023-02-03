<?php
include('../inc/site_config.php');
include('../inc/fun/mysql.php');

$memberid = $_GET['memberid'];

//获取评论信息
$table = 'weixin_like';
$row_list = $db->get_all($table, "memberid = {$memberid}", "*" , "in_date desc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Apple iOS Settings -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
<title>九啾啾 - 喜欢就给我点支持吧</title>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script>
$(function(){
	var memberid = $("input[name='memberid']").val();
	countComment(memberid);
});
//评论统计数量
function countComment(memberid){
	$.post("oauth2_form.php",{type:"count",memberid:memberid},function(data){
		$("#total_count").html(data);
	});
}
</script>
<style type="text/css">
body{margin:0;padding:0;width:100%;font-family: arial,"Hiragino Sans GB","Microsoft Yahei",sans-serif;background: url(/weixin/images/weixin_bg1.jpg);color:white;}
/* reset */
.fl{float:left;}
.fr{float:right;}
.clear{clear:both;}
a{text-decoration: none;}
/* topBar */
.comWidth{width:90%; margin-left:auto; margin-right:auto;//background-color:#F5F5F5;}
.activity_title{width:80%;margin-left:auto; margin-right:auto;background-color:#FDF8E2;}
/*图片边框*/
.wx_logo{padding-top:15px;}
.borderImg{border: 3px solid #9AD8EE;padding: 2px;background: #fff;}
/* shopTip */
.shopPhoto{text-align: center;}
.shopSketch{padding-top: 20px;text-align: center;}
.destips{font-size:18px;font-weight:bold;padding-top: 5px;line-height: 24px;color:#0A388E;padding-bottom: 5px;}
.des_content{text-indent:2em;border: 3px solid #9AD8EE;border-radius: 8px;padding:3px;}
/*点赞表单*/
.like{padding:10px 0px 20px 0px;margin-left:auto; margin-right:auto}
.like_box{text-align: center;padding-top:8px;}
.like_title{text-align: center;color:#F67816;}
.search_text{width:90%;height:25px;background-color: #FFF;padding:0 5px;font-size:16px;}
//.search_btn{width:85%;height:35px;font-size:16px;font-family:"Microsoft YaHei", "微软雅黑";background-color:#FF8C00;color:#FFF;}
.search_btn, .search_btn:visited {
	background: #F99E1A url(overlay.png) repeat-x;
	display: inline-block;
	//padding: 5px 10px 6px;
	color: #fff;
	text-decoration: none;
	-moz-border-radius: 6px;
	-webkit-border-radius: 6px;
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
	-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.6);
	text-shadow: 0 -1px 1px rgba(0,0,0,0.25);
	border: 1px solid rgba(0,0,0,0.25);
	position: relative;
	width:85%;height:25px;font-size:18px;font-weight:bold;
}
/*微信二维码*/
.wx{padding-bottom: 20px;}
/*评论*/
.comment{//border-top: 10px solid #EBEBEB;//background-color:#F5F5F5;}
.comment_count{padding-top:10px;padding-left:5px;color:#929292;font-weight: bold;font-size:16px;}
.chat_board{padding-top:10px;}
.pic{padding-left:5px;float:left;width:15%;}
.content{padding-left:10px;float:left;padding-top:7px;width:78%;padding-bottom: 10px;}
.chat_name{font-weight: bold;}
.chat{color: #5A5A5A;}
.split_line{border-bottom:1.5px solid #EBEBEB;}
.more{text-align: center;height:35px;color:#929292;padding-top: 15px;}
</style>
</head>
<body>
<input type="hidden" name="memberid" value="<?php echo $memberid; ?>" />
<div class="topBar">
	<div class="comWidth">
		<div class="comment">
			<div class="comment_count">评论&nbsp;&nbsp;(<span id="total_count"></span>)</div>
			<div id="chat_board_list">
			<?php 
				for($i = 0; $i < count($row_list); $i++){
			?>
			<div class="chat_board">
				<div class="pic">
					<img src="/weixin/images/pic.jpg" width="45px" height="45px" style="border-radius:50%;"/>
				</div>
				<div class="content">
					<div class="chat_name"><?=$row_list[$i]['custom_name'] ?></div>
					<div class="chat"><?=$row_list[$i]['custom_desc'] ?></div>
				</div>
				<div class="clear"></div>
				<div class="split_line"></div>
			</div>
			<?php
				}
			?>
			</div>
		</div>
	</div>
</div>

</div>
</body>
</html>