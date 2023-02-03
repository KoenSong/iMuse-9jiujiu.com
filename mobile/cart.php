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

//参数
$item = $_GET['item'];

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

//订单列表
$wxOrders = $db->get_all("wx_order", "openid = '".$openId."'", '*', "end_time desc");
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
    /*购物车选项卡*/
    .cart-tab{width: 100%;height: 50px;border-bottom: 1px solid #E6E6E6;}
    .cart-tab .item{width: 25%;float:left;text-align: center;line-height: 50px;font-size: 14px;}
    .on{color: #f60;border-bottom: 2px solid #F60; height: 49px;}
    /*分割块*/
    .split-div{height: 10px;background: #F8F8F8;}
    /*订单标题*/
    .sign-title{padding-bottom: 5px; border-bottom: 1px solid #E6E6E6; border-top: 1px solid #E6E6E6;}
    .order-title{border-bottom: 1px solid #e6e6e6;height: 30px;}
    .order-title span{font-size: 12px;line-height: 30px;}
    .sum-info,.oid{color: #3e3e3e;}
    .oid-cancle{color:#4F98C0;}
    .order-content{height: 50px; padding-top: 8px;height: 62px; //border-bottom: 1px solid #E6E6E6;}
    .order-pay{height: 25px;}
    .order-pay span{line-height: 25px;}
    .pd-icon{display: block; width: 18%; height: 45px; float: left; margin-right: 5px; }
    .sign-p{float: left; color: #3e3e3e; width: 60%; overflow: hidden; margin-bottom: 0px; -webkit-line-clamp: 2; -webkit-box-orient: vertical; display: -webkit-box; font-size: 14px; padding-top: 2px; }
    .sign-div{display: block; width: 20%; float: left; position: relative; height: 45px; }
    .sign-price{position: absolute; display: block; right: 0px; top: 5px; //color: #f60; }
    .sign-num{position: absolute; display: block; right: 0px; bottom: 5px; //color: #f60; }
    .is-pay{color: #f60;}
    .order-pay .pay-btn{background: #f60;color: #FFF;border-radius: 2px;padding: 0px 5px;line-height: 20px;margin-top: 2px;}
    </style>
  </head>
  <body style="padding-top: 0px;">
  <!--订单
  <div class="sign-title container">
    <img class="pd-icon" src="/mobile/img/p1.jpg"  alt="..."/>
    <p class="sign-p"><?=$wx_product['title']?></p>
    <div class="sign-div">
    <span class="sign-price">￥<?=$wx_product['price']?></span>
    <span class="sign-num">x<?=$payNum?></span>
    </div>
  </div>-->
  <div class="cart-tab">
    <div class="item">购物车</div>
    <div class="item on">购物记录</div>
    <div class="item">我的红包</div>
    <div class="item">优惠券</div>
  </div>
  <div class="split-div"></div>
  <!--购物车-->
  <!-- <div class="order">
    <div class="sign-title container">
      <div class="order-title">
        <span class="oid l">订单号：E201602010212020212143260</span>
        <span class="oid-cancle r">取消</span>
      </div>
      <div class="order-content">
        <img class="pd-icon" src="/mobile/img/p1.jpg"  alt="..."/>
        <p class="sign-p">【K歌+交友+PK+速成】广州还有这么好玩的声乐课？</p>
        <div class="sign-div">
          <span class="sign-price">￥49.00</span>
          <span class="sign-num">x1</span>
        </div>
      </div>
      <div class="order-pay">
        <span class="l sum-info">总价：</span>
        <span class="l sum-price">￥49.00</span>
        <span class="r pay-btn">付款</span>
      </div>
    </div>
  </div>
   -->
  <!--购物记录-->
  <?php foreach($wxOrders as $wxOrder){ 
    $wxProduct = $db->get_one('wx_product',"id = {$wxOrder['wx_pid']}");
  ?>
  <div class="order">
    <div class="sign-title container">
      <div class="order-title">
        <span class="oid l">订单号：<?=$wxOrder['transaction_id']?></span>
        <!-- <span class="oid-cancle r">取消</span> -->
      </div>
      <div class="order-content">
        <img class="pd-icon" src="/mobile/img/p1.jpg"  alt="..."/>
        <p class="sign-p"><?=$wxProduct['title']?></p>
        <div class="sign-div">
          <span class="sign-price">￥<?=$wxProduct['price']?></span>
          <span class="sign-num">x<?=$wxOrder['num']?></span>
        </div>
      </div>
      <div class="order-pay">
        <span class="l sum-info">总价：</span>
        <span class="l sum-price">￥<?=sprintf("%.2f",$wxOrder['total_fee'] / 100)?></span>
        <!-- <span class="r pay-btn">付款</span> -->
        <span class="r is-pay">已付款</span>
      </div>
    </div>
  </div>
  <div class="split-div"></div>
  <?php } ?>
  <!--引入底部导航栏-->
  <?php include('foot-nav.php');?>

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  <script>
    $(function(){
      $(".ad img").height($(window).height() * 0.3);

      //选项卡
      var item = "<?=$item;?>" == "" ? "0" : "<?=$item;?>";
      var itemOn = "/mobile/img/foot-nav"+item+".png";
      $(".item" + item).addClass("onNav");
      $(".item" + item).find("img").attr('src',itemOn); 
    });
  </script>
  </body>
</html>