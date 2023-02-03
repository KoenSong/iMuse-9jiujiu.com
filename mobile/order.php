<?php 
ini_set('date.timezone','Asia/Shanghai');
include_once('../inc/site_config.php');
include_once('../inc/set/ext_var.php');
include_once('../inc/fun/mysql.php');
include_once('../inc/function.php');
/*微信工具包*/
include_once('../weixin/wx_config.php');
include_once('../weixin/Wechat.class.php');
/*微信支付*/
require_once "../wxpay/lib/WxPay.Api.php";
require_once "../wxpay/tool/WxPay.JsApiPay.php";
require_once '../wxpay/tool/log.php';

//session_start();
//$openid = $_SESSION['openid'];

//表单提交参数
$userName = $_GET['user-name'];
$userPhone = $_GET['user-phone'];
$payNum = $_GET['pay-num'];
$wxProductId = $_GET['wx_product-id'];
$attach = $userName."&".$userPhone."&".$payNum."&".$wxProductId;
$attachArr = explode("&",$attach);

//支付接口
$tools = new JsApiPay();
session_start();
if(!session_is_registered('openId')){
  //获取用户openid
  $openId = $tools->GetOpenid();
  $_SESSION['openId']=$openId;
}else{
  $openId = $_SESSION['openId'];
}



//产品
$wx_product = $db->get_one("wx_product", "id = {$wxProductId}", '*');
//var_dump($payNum."--->".$userName."--->".$userPhone."--->".$wxProductId."--->".$openId);
//合计
$sumAmunt = sprintf("%.2f", $wx_product['price'] * $payNum);

//初始化日志
$logHandler= new CLogFileHandler("../log/wxpay_log/".date('Y-m-d').'.log');
$log = Log::Init($logHandler, 15);
//打印输出数组信息
function printf_info($data){
  foreach($data as $key=>$value){
    echo "<font color='#00ff55;'>$key</font> : $value <br/>";
  }
}

//统一下单
$input = new WxPayUnifiedOrder();
$input->SetBody($wx_product['title']);
$input->SetAttach($attach);
$input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
//$input->SetTotal_fee($sumAmunt * 100);//元转成分
$input->SetTotal_fee(1);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetGoods_tag($wx_product['type']);
$input->SetNotify_url("http://9jiujiu.com/wxpay/notify/notify.php");
$input->SetTrade_type("JSAPI");
$input->SetOpenid($openId);
$order = WxPayApi::unifiedOrder($input);
//echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
//printf_info($order);
$jsApiParameters = $tools->GetJsApiParameters($order);
//获取共享收货地址js函数参数
$editAddress = $tools->GetEditAddressParameters();


?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!--去除ios号码样式-->
    <meta name="format-detection" content="telephone=no" />
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>九啾啾|最好的音乐老师都在这里</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/mobile/css/bootstrap.min.css">
    <link rel="stylesheet" href="/mobile/css/main.css">
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    /*订单标题*/
    .sign-title{margin-top:10px; padding-bottom: 5px; border-bottom: 1px solid #E6E6E6; }
    .pd-icon{display: block; width: 18%; height: 45px; float: left; margin-right: 5px; }
    .sign-p{float: left; color: #3e3e3e; width: 60%; overflow: hidden; margin-bottom: 0px; -webkit-line-clamp: 2; -webkit-box-orient: vertical; display: -webkit-box; font-size: 14px; padding-top: 2px; }
    .sign-div{display: block; width: 20%; float: left; position: relative; height: 45px; }
    .sign-price{position: absolute; display: block; right: 0px; top: 5px; color: #f60; }
    .sign-num{position: absolute; display: block; right: 0px; bottom: 5px; color: #f60; }
    /*活动信息*/
    .p-title-info{border-bottom: 1px solid #E6E6E6; margin: 5px 0px 10px; color: #3e3e3e; }
    .p-title-info p{margin:0px 0px; }

    .bottom{border-bottom: 1px solid #E6E6E6; }
    /*模式一*/
    .model-a{color: #3e3e3e; height: 30px; line-height: 30px; }
    .sum-price{color: #f60; }
    .weal-price{color: #f60; }
    .split {height: 8px; background: #F2DEDE; border-top: 1px solid #E6E6E6; border-bottom: 1px solid #E6E6E6; }
    /*模式二*/
    .model-b{text-align: center; color: #3e3e3e; }
    .model-b .payc-div{height: 25px; line-height: 25px; }
    .model-b .pay-div{color: #f60; font-size: 16px; line-height: 30px; }
    /*微信支付*/
    .wxpay-line {height: 45px; margin-top: 20px; }
    .wx-btn {display: block; vertical-align: middle; width: 100%; background: #54B601; color: #FFF; text-align: center; height: 40px; line-height: 40px; border-radius: 3px; }
    </style>
  </head>
  <body style="padding-top: 0px;">
  <!--订单-->
  <div class="sign-title container">
    <img class="pd-icon" src="/mobile/img/p1.jpg"  alt="..."/>
    <p class="sign-p"><?=$wx_product['title']?></p>
    <div class="sign-div">
    <span class="sign-price">￥<?=$wx_product['price']?></span>
    <span class="sign-num">x<?=$payNum?></span>
    </div>
  </div>
  <div class="container">
    <div class="p-title-info">
      <p>联系：<span class="amount"><?=$userName?></span></p>
      <p>手机：<span class="amount"><?=$userPhone?></span></p>
      <p>时间：<span class="time"><?=$wx_product['release_time']?></span></p>
      <p>场地：<span class="address"><?=$wx_product['place']?></span></p>
    </div>
    <div class="model-a">
      <span class="sum l">合计</span>
      <span class="sum-price r">￥<?=$sumAmunt?></span>
    </div>
    <div class="clearfix"></div>
    <div class="split"></div>
    <div class="model-a">
      <span class="weal l">限时优惠</span>
      <span class="weal-price r">￥0.00</span>
    </div>
    <div class="clearfix"></div>
    <div class="split"></div>
    <div class="model-b">
      <div class="payc-div">
        <span class="pay">￥<?=$sumAmunt?> - ￥0.00优惠</span>
      </div>
      <div class="pay-div">
        <span class="pay-info">需付：</span> 
        <span class="pay-price">￥<?=$sumAmunt?></span>
      </div>
    </div>
  </div>
  <div class="bottom"></div>
  <div class="wxpay-line container">
    <span class="wx-btn">微信安全支付</span>
  </div>

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  <script>
    $(function(){
      $(".ad img").height($(window).height() * 0.3);

      // 微信支付按钮
      $(".wx-btn").click(function(){
        callpay();
      });
    });
    
    //调用微信JS api 支付
    function jsApiCall(){
      WeixinJSBridge.invoke(
        'getBrandWCPayRequest',
        <?php echo $jsApiParameters; ?>,
        function(res){
          WeixinJSBridge.log(res.err_msg);
          if(res.err_msg == "get_brand_wcpay_request：ok" ) {
            // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。 
          }     
        }
      );
    }
    function callpay(){
      if (typeof WeixinJSBridge == "undefined"){
          if( document.addEventListener ){
              document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
          }else if (document.attachEvent){
              document.attachEvent('WeixinJSBridgeReady', jsApiCall); 
              document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
          }
      }else{
          jsApiCall();
      }
    }
  </script>
  </body>
</html>