<?php
include_once('../inc/site_config.php');
include_once('../inc/fun/mysql.php');
include_once('../weixin/wx_config.php');
include_once('../weixin/Wechat.class.php');
include_once('../inc/function.php');
include_once('../inc/category.php');//分类一起取出处理
$options = array(
			'token'=>'tokenaccesskey', //填写你设定的key
			'encodingaeskey'=>'encodingaeskey', //填写加密用的EncodingAESKey
 			'appid'=>$wx_appid, //填写高级调用功能的app id
			'appsecret'=>$wx_appsecret //填写高级调用功能的密钥
		);
$weObj = new Wechat($options);
$Oauth = $weObj->getOauthAccessToken(); 
//$auth = $weObj->checkAuth();
//$jsTicket = $weObj->getJsTicket();
$jsUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
$jsSign = $weObj->getJsSign($jsUrl);
//var_dump($jsSign['signature']);
$accessToken = $Oauth['access_token'];
$openid = $Oauth['openid'];
//var_dump($openid);
$memberid = $_GET['memberid'];
//获取老师账号信息
$member_info=$db->get_one('member', "MemberId='{$memberid}'");
$member_ident=$db->get_one('member_ident',"MemberId='{$memberid}'");
$ProId=$db->get_value('product',"MemberId = '{$member_info['MemberId']}'",'ProId');
$product_row=$db->get_one('product', "ProId='$ProId'");
$ext_row=$db->get_one('product_ext',"ProId = '{$product_row['ProId']}'");
//获取评论信息
$table = 'weixin_like';
$row_list = $db->get_limit($table, "memberid = {$memberid}", "*" , "in_date desc", 0, 5);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- Apple iOS Settings -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
<title>九啾啾十大名师投票页——<?=$product_row['Name']?></title>
<script type="text/javascript" src="../js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script>
/**** start 微信分享的标题、缩略图、连接及描述设置 ****/
wx.config({
    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
    appId: '<?=$wx_appid?>', // 必填，公众号的唯一标识
    timestamp: <?=$jsSign['timestamp']?>, // 必填，生成签名的时间戳
    nonceStr: '<?=$jsSign['noncestr']?>', // 必填，生成签名的随机串
    signature: '<?=$jsSign['signature']?>',// 必填，签名，见附录1
    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
});
wx.ready(function(){
	wx.onMenuShareTimeline({
    title: '九啾啾十大名师投票页——<?=$product_row['Name']?>', 
    link: '<?=$jsUrl?>', 
    imgUrl: "http://9jiujiu.com"+"<?=$product_row['PicPath_0']?$product_row['PicPath_0']:'/images/face.jpg';?>", 
    success: function () {},
    cancel: function () {}
	});
	wx.onMenuShareAppMessage({
    title: '九啾啾十大名师投票页——<?=$product_row['Name']?>', // 分享标题
    desc: '9jiujiu.com', // 分享描述
    link: '<?=$jsUrl?>', // 分享链接
    imgUrl: "http://9jiujiu.com"+"<?=$product_row['PicPath_0']?$product_row['PicPath_0']:'/images/face.jpg';?>", // 分享图标
    type: '', // 分享类型,music、video或link，不填默认为link
    dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
    success: function () { 
        // 用户确认分享后执行的回调函数
    },
    cancel: function () { 
        // 用户取消分享后执行的回调函数
    }
	});
	wx.onMenuShareQQ({
    title: '九啾啾十大名师投票页——<?=$product_row['Name']?>', // 分享标题
    desc: '9jiujiu.com', // 分享描述
    link: '<?=$jsUrl?>', // 分享链接
    imgUrl: "http://9jiujiu.com"+"<?=$product_row['PicPath_0']?$product_row['PicPath_0']:'/images/face.jpg';?>", // 分享图标
    success: function () { 
       // 用户确认分享后执行的回调函数
    },
    cancel: function () { 
       // 用户取消分享后执行的回调函数
    }
	});
});
/**** end 微信分享的标题、缩略图、连接及描述设置 ****/

$(function(){
	var memberid = $("input[name='memberid']").val();
	var openid = "<?=$openid?>";
	if(openid != ""){
		$("input[name='openid']").val(openid);
	}
	countComment(memberid);
	
	$("#submit").click(function(){
		var flag = true;
		var phoneNum = $("input[name='phone']").val();
		var name =  $("input[name='name']").val();
		var desc = $("input[name='desc']").val();
		flag = isMobil(phoneNum);
		if(!flag){
			//$("#tDiv").append("<span style='color:red;font-weight:bold;'>请输入正确的手机号！</span>");
			//setTimeout(function(){$("#tDiv").html("")}, 3000);
			$("#tip-txt").html("请输入正确的手机号！");
			$("#xjz-tip-info").show();
			setTimeout(function(){$("#xjz-tip-info").hide();}, 3000);
			return;
		}
		flag = name.trim();
		if(!flag){
			//$("#tDiv").append("<span style='color:red;font-weight:bold;'>请输入您的名字！</span>");
			//setTimeout(function(){$("#tDiv").html("")}, 3000);
			$("#tip-txt").html("请输入您的名字！");
			$("#xjz-tip-info").show();
			setTimeout(function(){$("#xjz-tip-info").hide();}, 3000);
			return;
		}
		flag = desc.trim();
		if(!flag){
			//$("#tDiv").append("<span style='color:red;font-weight:bold;'>请写上您的评论吧！</span>");
			//setTimeout(function(){$("#tDiv").html("")}, 3000);
			$("#tip-txt").html("请写上您的评论吧！");
			$("#xjz-tip-info").show();
			setTimeout(function(){$("#xjz-tip-info").hide();}, 3000);
			return;
		}
		if(flag)
			submitForm();
	});
});
//表单提交
function submitForm(){
	$.ajax({
		    type: 'post',
		    url: 'oauth2_form.php',
		    data: $("#ifrom").serialize(),
		    dataType: 'json',
		    success: function(data) {
		    	var memberid = data.row_list[0].memberid;
		    	if(data.result_code == 7000){
					//$("#tDiv").append("你已经成功提交，感谢你的支持！");
					$("#tip-txt").html("你已经成功提交，感谢你的支持！");
					$("#xjz-tip-info").show();
					setTimeout(function(){$("#xjz-tip-info").hide();}, 3000);
					var divStr = "";
					$.each(data.row_list,function(n, value){
						//alert(value.custom_name);
						var str = 	"<div class='chat_board'>" +
									"<div class='pic'>"+
									"<img src='/weixin/images/pic.jpg' width='45px' height='45px' style='border-radius:50%;'/>" +
									"</div>" +
									"<div class='content'>";
							str +=  "<div class='chat_name'>" + value.custom_name + "</div>";
							str +=  "<div class='chat'>" + value.custom_desc + "</div>";
							str +=  "</div>";
							str +=  "<div class='clear'></div>";
							str +=  "<div class='split_line'></div>";
							str +=  "</div>";
						divStr += str;
					});
					countComment(memberid);
					$("#chat_board_list").html(divStr);
		    	}
				if(data.result_code == 7001){
					//$("#tDiv").append("你已经评论过了，感谢你的支持！");
					$("#tip-txt").html("你已经评论过了，感谢你的支持！");
					$("#xjz-tip-info").show();
					setTimeout(function(){$("#xjz-tip-info").hide();}, 3000);
				}
				$("#submit").attr({'disabled': true});
		    },
		    error:function(data){
				$("#tDiv").append("error");
				$("#submit").attr({'disabled': true});
		    }
		});
}
//评论统计数量
function countComment(memberid){
	$.post("oauth2_form.php",{type:"count",memberid:memberid},function(data){
		$("#total_count").html(data);
	});
}
//校验
function isMobil(s) 
{ 
//var reg=/^((13[0-9])|(15[^4,\D])|(18[0,5-9]))\d{8}$/; 
var reg=/^1\d{10}$/;
if (!reg.exec(s)) {
 return false; 
}
return true; 
}
</script>
<style type="text/css">
body{margin:0;padding:0;width:100%;font-family: arial,"Hiragino Sans GB","Microsoft Yahei",sans-serif;background: url(/weixin/images/weixin_bg1.jpg);color:white;}
/* reset */
.fl{float:left;}
.fr{float:right;}
.clear{clear:both;}
a { text-decoration:none;color:#929292; }
/* topBar */
.comWidth{width:90%; margin-left:auto; margin-right:auto;//background-color:#F5F5F5;}
.activity_title{width:90%;margin-left:auto; margin-right:auto;font-size:18px;color:#F99E1A;//background-color:#FDF8E2;}
/* 图片展区 */
.pic_show{text-align:center;}
/*图片边框*/
.wx_logo{padding-top:15px;}
.borderImg{
	/* border: 3px solid #fff;
	    width: 200px;
	    height: 200px;
	    border-radius: 50%;
	    border: 2px solid #35D097;
	    margin: 0 auto;
	    display: block; */
	width: 200px;
  	height: 200px;
  	//border: 5px solid white;
  	box-shadow: 0 0 2px 2px white;
 	border-top-left-radius: 999px; /* 左上角 */
  	border-top-right-radius: 999px; /* 右上角 */
  	border-bottom-right-radius: 999px; /* 右下角 */
  	border-bottom-left-radius: 999px; /* 左下角 */
  	border-radius: 999px;
  	background-color: #ccc;
  	background-clip: padding-box;
}
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
/*微信二维码*/
.wx_jiujiu{}
.wx_qrcode{text-align: center;}
/** 活动规则 start **/
.activity-rule-box{  color: #D1D3DB;  padding: 20px 3%;}
.rule-title-box{   margin-bottom: 20px;
  border-bottom: 1px solid #fff;
  height: 15px;}
.rule-title-box .rule-title{display: block;
  text-align: center;
  width: 170px;
  height: 30px;
  line-height: 30px;
  background-color: #15A9E0;
  color: #FFF;
  border-radius: 5px;
  margin: 0 auto;}

.rule-list-box{  padding: 15px 0;}
.rule-list-box .rule-item{line-height: 30px;}

.activity-rule-box2{  color: #D1D3DB;  padding:20px 3%;}
.rule-title-box2{   margin-bottom: 20px;
  border-bottom: 1px solid #fff;
  height: 15px;}
.rule-title-box2 .rule-title2{display: block;
  text-align: center;
  width: 170px;
  height: 30px;
  line-height: 30px;
  background-color: #fff;
  color: #000;
  border-radius: 5px;
  margin: 0 auto;}

.rule-list-box2{  padding: 15px 0;}
.rule-list-box2 .rule-item2{line-height: 30px;}


.qr-code-box{padding-bottom: 15px;}
.qr-code-box img{  width: 100px;
  margin: 0 auto;
  display: block;}

/** 活动规则 end **/
/** 提示框 start **/
.tip-box{   position: fixed;
  top: 30%;
  left: 25%;
  margin: 0 auto;
  z-index: 100;
  width: 50%;}
.tip-box .tip-info-box{  background-color: #ddd;
  min-height: 35px;
  line-height: 30px;
  padding: 0 2%;
  text-align: center;
  border-radius: 10px;  border: 1px solid #09133C;}
.tip-box .tip-info-box .tip-txt{}
.tip-box .tip-info-box .tip-icon{ display:inline-block; width:24px; height:24px;  position: relative;top: 6px;}
.tip-box .tip-info-box .info-msg-icon{ background:url(info_icon_24.png) no-repeat;}
.tip-box .tip-info-box .succeed-icon{background:url(succeed_icon_24.png) no-repeat;}
.tip-box .tip-info-box .error-icon{background:url(error_icon_24p.png) no-repeat;}

/** 提示框 end **/
</style>
</head>
<body>

<div class="topBar">
	<div class="comWidth">
	<!--<div class="title"><h2>九啾啾独家 | 十大名师打造计划</h2></div>-->
	<!--<div class="pic_show">
		<div class="showcase"><img src="/weixin/images/showcase1.jpg"  width="280"/></div>
		<div class="showcase"><img src="/weixin/images/showcase2.jpg"  width="280"/></div>
		<div class="showcase"><img src="/weixin/images/showcase3.jpg"  width="280"/></div>
	</div>-->
		<div class="activity_title">
			<p>你的朋友<?=$product_row['Name']?><br/>正在参与九啾啾举办的“十大名师打造计划”，需要您的支持，鼓励。</p>
		</div>
		<div class="shopTip">
			<div class="shopSimple">
				<div class="shopPhoto"><img class="borderImg" src="<?=$product_row['PicPath_0']?$product_row['PicPath_0']:'/images/face.jpg';?>" /></div>
				<div class="shopSketch">
					<span style="font-weight:bold;font-size:20px;"><?=$product_row['Name']?></span>
					<p>教学科目:&nbsp; &nbsp;<span style="font-weight:bold;"><?=$Category[$product_row['CateId']]['Category']?></span></p>
					<img src="/images/dou_left.png" />&nbsp;&nbsp;<?=$ext_row['Warranty0']?>&nbsp;&nbsp;<img src="/images/dou_right.png" />
				</div>
			</div>
			<div class="like">
				<div id="tDiv" style="color:#F67816;text-align: center;"></div>
				<div class="like_title"><h3>请给我个支持吧</h3></div>
				<form id="ifrom">
					<!-- 针对页面返回，保存openid -->
					<input type="hidden" name="memberid" value="<?php echo $memberid; ?>" />
					<!--<input type="hidden" name="openid" value="<?php echo $openid; ?>" />-->
					<input type="hidden" name="openid" />
					<div class="like_box">
						<input type="text" class="search_text" placeholder="手机号" name="phone"/>
					</div>
					<div class="like_box">
						<input type="text" class="search_text" placeholder="姓名" name="name" size="40"/>
					</div>
					<div class="like_box">
						<input type="text" class="search_text" placeholder="您的一句话鼓励！" name="desc" size="40"/>
					</div>
					<div class="like_box">
						<input type="button" class="search_btn" id="submit" value="支&nbsp;&nbsp;持" />
						<!--<button class="search_btn" id="submit">支&nbsp;&nbsp;持</button>-->
					</div>
				</form>
			</div>
		</div>
		<!-- 活动规则 start -->
        <div class="activity-rule-box">
            <div class="rule-title-box">
                <span class="rule-title" style="font-weight: bold;"><a style="color:#FFF;font-weight: bold;text-decoration:underline;" href="http://u.eqxiu.com/s/WI0jln3O"> <span style="text-decoration:underline">立即参与活动</span></a></span>
            </div>
        </div>
		<div class="comment">
			<div class="comment_count">评论&nbsp;&nbsp;(<span id="total_count"></span>)</div>
			<!--<div class="chat_board">
				<div class="pic">
					<img src="/weixin/images/pic.jpg" width="45px" height="45px" style="border-radius:50%;"/>
				</div>
				<div class="content">
					<div class="chat_name">柠檬不酸我不爱</div>
					<div class="chat">好厉害 继续加油！！！好厉害 继续加油！！！好厉害 继续加油！！！好厉害 继续加油！！！</div>
				</div>
				<div class="clear"></div>
				<div class="split_line"></div>
			</div>-->
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
			<div class="more"><span><a href="/weixin/oauth2_more.php?memberid=<?=$memberid ?>">查看更多评论</a></span></div>
		</div>
		<div class="wx_jiujiu">
			<div class="wx_qrcode">
				<img width="120" src="/weixin/images/wx_qrcode.jpg" />
			</div>
		</div>
		<!-- 消息框 start -->
        <div id="xjz-tip-info" class="tip-box" style="display:none;">
            <p class="tip-info-box">
                <em id="tip-icon" class="tip-icon"></em><span id="tip-txt" class="tip-txt" style="color:red;">222</span>
            </p>
        </div>
        <!-- 消息框 end -->
		<div class="activity-rule-box2">
			<div class="rule-title-box2">
	             <span class="rule-title2">扫二维码，关注九啾啾</span>
	        </div>
        </div>
	</div>
</div>

</div>
</body>
</html>