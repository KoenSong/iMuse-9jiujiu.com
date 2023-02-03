<?php
include '../../inc/lib/phpqrcode/phpqrcode.php';
include '../../inc/fun/toSortUrl.php';
$value = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=wxf2bd74751985d977&redirect_uri=http://9jiujiu.com/weixin/oauth2.php?memberid={$_SESSION['member_MemberId']}&response_type=code&scope=snsapi_base&state=1#wechat_redirect"; //二维码内容   
$value = bdUrlAPI(1,$value);
$errorCorrectionLevel = 'L';//容错级别   
$matrixPointSize = 20;//生成图片大小   
//生成二维码图片   
QRcode::png($value, 'qrcode.png', $errorCorrectionLevel, $matrixPointSize, 2);   
$QR = 'qrcode.png';//已经生成的原始二维码图   
?>
<style>
.wx{padding:60px 30px;}
.wx_title{color:#E1163F;font-size:20px;font-weight: bold;}
.wx_content{font-size:15px;}
</style>
<div class="wx">
    <span class="wx_title">分享到微信朋友圈</span>
    <p class="wx_content">
        朋友的支持和肯定越多，代表您的实力真正被大家认可，也一定能通过
        自身的努力成为一名名师。
    </p>
</div>
<div>
    <img width="300px;" src="qrcode.png">
</div>