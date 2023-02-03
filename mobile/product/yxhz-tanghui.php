<?php 
include_once('../../inc/site_config.php');
include_once('../../inc/set/ext_var.php');
include_once('../../inc/fun/mysql.php');
include_once('../../inc/function.php');
/*微信工具包*/
include_once('../../weixin/wx_config.php');
include_once('../../weixin/Wechat.class.php');

session_start();
$openid = $_SESSION['openid'];
$wx_product = $db->get_one("wx_product", "type ='pk-party'", '*');

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
      /*巨幕广告*/
      .ad img{width:100%;//border-radius: 8px;}
      /*产品详情*/
      .product-div{//height: 4500px;}
      .p-title{margin: 15px 0px -2px;font-size: 20px;color: #3e3e3e;}
      .price{font-style: normal; font-weight: 900; font-size: 23px; color: #f60; display: block; }
      .p-title-info{border-top:1px solid #DCD5D5; border-bottom: 1px solid #DCD5D5; margin: 5px 0px 10px; color: #3e3e3e; }
      .p-title-info p{margin:0px 0px; }
      .p-verify{float:left; height: 30px; color: #3e3e3e; }
      .p-verify span{position: relative; display: inline-block; margin-left: 25px; }
      .p-verify i{position: absolute; background: url(/mobile/img/icon_verify.png) center no-repeat; width: 20px; height: 20px; background-size: 20px; left: -23px; }
      /*产品展示图*/
      .p-ad img{width: 100%; }
      /*模板model-a*/
      .model-a{}
      .model-a-title{font-family: 微软雅黑; font-size: 16px; color: rgb(62, 62, 62); }
      .model-a-info{font-family: 微软雅黑; font-size: 16px; color: rgb(62, 62, 62); position: relative; padding-left: 70px; height: 50px; line-height: 50px; }
      .dd-icon{background: url(/mobile/img/pro/m-p-a2.png) center no-repeat; width: 65px; height: 65px; background-size: 65px; position: absolute; left: 0px; bottom: 0px; }
      .a-span-1{max-width: 100%; line-height: 1.5em; font-family: 微软雅黑; font-size: 20px; color: rgb(62, 62, 62); }
      .a-span-2{font-size: 25px; }
      .a-span-3{color: rgb(255, 41, 65); box-sizing: border-box !important; word-wrap: break-word !important; font-size: 25px; }
      .a-span-4{font-size: 20px; }
      .model-a-desc .desc{color: rgb(62, 62, 62); }
      .f20{font-size: 20px; }
      .f12{font-size:12px; }
      .f16{font-size:16px; }
      .a-span-5{font-size: 30px; color: rgb(255, 41, 65); }
      .a-span-6{font-size: 25px; }
      .a-span-7{color: #ff2941; }
      .a-span-8{color: rgb(255, 41, 65); }
      .a-span-9{color: rgb(192, 0, 0); }
      .a-span-10{font-family: 微软雅黑, sans-serif; color: rgb(255, 76, 0); }
      .a-span-11{color: rgb(0, 122, 170); font-size: 24px; }
      .a-span-12{color: rgb(255, 169, 0); font-size: 24px; }
      .f-italic{font-style: italic; }
      .h220{height: 220px;}
      .h300{height: 300px;}
      /*视频模块一*/
      .vedio-a{width: 100%; margin: 0 auto; display: block; position: relative; }
      .vedio-a-title{font-family: 微软雅黑; font-size: 16px; color: rgb(62, 62, 62); margin: 0px; text-align: center; position: absolute; background: rgba(37, 33, 33, 0.5); color: #FFF; width: 100%; }
      .vedio-a iframe{height: 200px; width: 100%; }
      .bottom10{margin-bottom: 10px; }
      /*模式二*/
      .model-b-desc{font-family: 微软雅黑; color: #FFF; }
      .model-b-desc .desc{background-color: #000; }
      .b-span-1{color: rgb(255, 41, 65); }
      /*总结模块一*/
      .sum-a p{font-family: 微软雅黑; color: rgb(62, 62, 62); }
      .split{border-bottom: 1px solid #DCD5D5; margin-bottom: 10px; }
      /*付款line*/
      .pay-line{position: fixed; bottom: 0px; left: 0px; height: 45px; width: 100%; background: #FFF; border-top: 1px solid #E6E4E4; display: table; }
      .pay-line div{display: table-cell; width: 50%; text-align: center; vertical-align: ; vertical-align: middle; }
      .pay-line .sign-span{background: #54B601; color: #FFF; width: 92%; display: block; text-align: center; margin: 0 auto; line-height: 35px; border-radius: 2px; }
      .pay-line .sign-on{background:#3C763D; }
      .pay-line .coll-span{color: rgb(62, 62, 62); width: 92%; display: block; text-align: center; margin: 0 auto; line-height: 35px; border-radius: 2px; border: 1px solid #CCC; }
      /*报名-下一步*/
      .sign-next{width:100%; background-color: #FFF; position:fixed; left:0px; z-index: 9999; }
      /*报名-标题*/
      .sign-title{width: 100%; position: relative; margin-top: 10px; border-bottom: 1px solid #E6E6E6; }
      .sign-title p{color: #3e3e3e; margin-left: 55px; margin-right: 35px; font-size: 12px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-bottom: 0px; }
      .sign-price{display: block; margin-left: 60px; color: #f60; }
      .pd-icon{background: url(/mobile/img/p1.jpg) center no-repeat; width: 50px; height: 30px; background-size: 60px; display: block; position: absolute; left: 15px; }
      .cross-icon{background: url(/mobile/img/cross37.png) center no-repeat; width: 30px; height: 30px; background-size: 30px; display: block; position: absolute; right: 15px; top: 0px; }
      /*表单*/
      #sign-form{}
      .input-a{border-radius: 3px; border:1px solid #CCC; -webkit-appearance: none;/*去除阴影*/ height: 40px; color: #3e3e3e; font-size: 16px; }
      .sign-num{height: 50px; margin-top: 10px; margin-bottom: 10px; border-bottom: 1px solid #E6E6E6; }
      .num-lable{line-height: 50px; color: #3e3e3e; font-size: 16px; }
      .pay-num-div{display: inline-block; float: right; }
      /*输入框提示文字颜色*/
      input::-webkit-input-placeholder {color: #3e3e3e; }
      input:-moz-placeholder {color: #3e3e3e; }
      .pay-num-div{width: 130px; height: 50px; }
      .pay-num{width: 40px; border: 1px solid #CCC; -webkit-appearance: none; color: #3e3e3e; display: block; float: left; margin-top: 10px; height: 28px; padding-left: 6px; border-radius: 0px; font-size: 16px; }
      .plus-icon{background: url(/mobile/img/plus-minus.png) center no-repeat; width: 35px; height: 35px; display: block; background-position: 0px 5px; background-size: 80px; float: left; margin-top: 4px; margin-left: 8px; }
      .minus-icon{background: url(/mobile/img/plus-minus.png) center no-repeat; width: 35px; height: 35px; display: block; background-position: -45px 2px; background-size: 80px; float: left; margin-top: 7px; margin-right: 8px; }
      .bottom{border-bottom: 1px solid #E6E6E6; }
      /*下一步*/
      .sign-line{height: 45px; margin-top: 20px; }
      .next-btn{display: block; vertical-align: middle; width: 100%; background: #54B601; color: #FFF; text-align: center; height: 40px; line-height: 40px; border-radius: 3px; }
      </style>
  </head>
  <body>
  <!--引入头部-->
  <?php include('../mobilehead-a.php');?>

  <!--巨幕广告-->
  <div class="ad">
    <img src="<?=$wx_product['pic']?>" alt="">
  </div>
  <!-- 产品展示 -->
  <div class="container product-div">
    <p class="p-title"><?=$wx_product['title']?></p>
    <span class="price">￥<?=$wx_product['price']?></span>
    <div class="p-title-info">
      <p>限额：<span class="amount"><?=$wx_product['num']?></span>人</p>
      <p>时间：<span class="time"><?=$wx_product['release_time']?></span></p>
      <p>场地：<span class="address"><?=$wx_product['place']?></span></p>
    </div>
    <div class="p-verify">
      <span><i class="wx-icon"></i>微信认证</span>
      <span><i class="gs-icon"></i>企业认证</span>
      <span><i class="jy-icon"></i>担保交易</span>
    </div>
    <div class="clearfix"></div>
    <!--痛点分析-->
    <!-- 模块二 
    <div class="model-b">
      <div class="model-b-desc">
        <span class="desc b">
        <span class="b-span-1">想要--</span>在KTV中寻找自信，拓展交际圈的你
        </span>
        <br/>
        <span class="desc b">
        <span class="b-span-1">想要--</span>通过专业的训练突破高低音、跑调等难点的你
        </span>
        <br/>
        <span class="desc b">
        <span class="b-span-1">想要--</span>参加选秀比赛，通过专业培训提高专业度、提高层次的你
        </span>
      </div>
    </div>-->
    <!--介绍-->
    <!--模块一-->
    <div class="model-a">
      <p class="model-a-title b non-zone">
        活动介绍：
      </p>
      <div class="model-a-desc">
        <p class="desc">
        <span class="a-span-7 f20">快  </span>5分钟之内让一个初学者感受到明显提升！
        </p>
        <p class="desc">
        <span class="a-span-7 f20">简单 </span>我们将复杂的教学体系切分成碎片式的教学点，用最简单的方式让学生掌握！
        </p>
        <p class="desc">
        <span class="a-span-7 f20">好玩  </span>边唱K边学习，学的同时还能玩，学的同时还能PK，学的同时还能交朋友！
        </p>
        <p class="desc">
        <span class="a-span-7 f20">专业  </span>我们将传统教学体系与欧美先进流行声乐体系SLS关闭唱法、BVS平衡唱法相结合，能迅速提升唱功而后巩固运用！
        </p>
      </div>
    </div>
    <!-- 模块一 -->
    <div class="model-a">
      <p class="model-a-title b">
        导师视频：
      </p>
    </div>
    <!-- 视频模块一 -->
    <div class="vedio-a">
      <div class="vedio-a-title">刘宝裕</div>
      <iframe frameborder="0" src="http://v.qq.com/iframe/player.html?vid=o0179j6ha1d&tiny=0&auto=0" allowfullscreen></iframe>
    </div>
    <div class="h10"></div>
    <!-- 视频模块一 -->
    <div class="vedio-a">
      <div class="vedio-a-title">罗如</div>
      <iframe frameborder="0" src="http://v.qq.com/iframe/player.html?vid=r0168bmbtgk&tiny=0&auto=0" allowfullscreen></iframe>
    </div>
    <!-- 展示图 -->
    <div class="p-ad bottom10">
      <img src="/mobile/img/pro/m-p-a7.jpg" alt="">
    </div>
    <div class="sum-a">
      <p>
        <span class="f16 b">活动费用：</span><span class="a-span-8 b">99元，新会员参与并转发朋友圈5折优惠仅需49元！</span>名额有限，欲购从速，从此告别鬼哭狼嚎！！！
      </p>
      <p>
        <span class="f16 b">活动地点：</span>堂会KTV 越秀区起义路1号海印缤纷广场9楼(近海珠广场)
      </p>
      <p>
        <span class="f16 b">咨询电话：</span><span class="b">15820226863</span>（微信同号）刘老师
      </p>
      <div class="split"></div>
      <p class="b">
        <span class="a-span-10">1月20日至1月31日将本文<span class="a-span-11">转发至朋友圈</span>，即可获得由singbar提供的<span class="a-span-12">免费录音房体验</span>一次！（录音前请电话预约免得与现场导师撞课）</span>
      </p>
    </div>
    <!--付款栏-->
    <div class="pay-line">
      <div class="sign">
        <span class="sign-span">我要报名</span>
      </div>
      <div class="coll">
        <span class="coll-span">收藏</span>
      </div>
    </div>
    <!--遮盖层-->
    <div class="cover-div"></div>
    <!--付款下一步-->
    <div class="sign-next">
      <form id="sign-form" action="/mobile/order.php" method="get">
      <input type="hidden" name="wx_product-id" value="<?=$wx_product['id']?>" />
      <div class="sign-title container">
        <i class="pd-icon"></i>
        <p><?=$wx_product['title']?></p>
        <span class="sign-price">￥<?=$wx_product['price']?></span>
        <i class="cross-icon"></i>
      </div>
      <div class="container">
          <div class="sign-num">
            <span class="num-lable">数量</span>
            <div class="pay-num-div">
              <i class="minus-icon"></i>
              <input type="number" class="pay-num" name="pay-num" readonly="readonly" value="1"/>
              <i class="plus-icon"></i>
            </div>
          </div>
          <input type="text" class="input-a comWidth" name="user-name" id="user-name" placeholder="*联系人"/>
          <div class="h10"></div>
          <input type="number" class="input-a comWidth" name="user-phone" id="user-phone" placeholder="*手机号"/>
      </div>
      <div class="h10 bottom"></div>
      <div class="sign-line container">
        <span class="next-btn">下一步</span>
      </div>
      </form>
    </div>
  </div>

  <!--引入尾部-->
  <?php include('../mobilefoot.php');?>

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  <script>
    $(function(){
      $(".ad img").height($(window).height() * 0.3);
    });

    //禁用body滑动
    function bodyScroll(e){    
      e.preventDefault();
    }

    //我要报名
    $(".sign-span").click(function(){
      //按钮变色
      $(this).addClass("sign-on");
      //页面回到顶部
      document.documentElement.scrollTop = document.body.scrollTop =0;
      //禁止body滚动
      document.addEventListener('touchmove', bodyScroll, false);
      //开启遮盖层
      $(".cover-div").css({height:$(window).height()+"px"});
      //弹出报名下一步
      $(".sign-next").animate({
        height:'300px',
        bottom:'0px'
      },200);
    });

    //我要报名-关闭
    $(".cross-icon").click(function(){
      //启动body滚动
      document.removeEventListener('touchmove', bodyScroll, false);
      //关闭遮盖层
      $(".cover-div").css({height:0+"px"});
      //收回报名下一步
      $(".sign-next").animate({
        height:'0px',
        //bottom:'-300px'
      },200);
      //按钮变色
      $(".sign-span").removeClass("sign-on");
    });

    //数字控制按钮
    $(".plus-icon").click(function(){
      var num = $(".pay-num").val();
      $(".pay-num").val(++num);
    });
    $(".minus-icon").click(function(){
      var num = $(".pay-num").val();
      if(num == 1){
        $(".pay-num").val(1);
      }else{
        $(".pay-num").val(--num);
      }
    });

    //表单提交
    $(".next-btn").click(function(){
      $("#sign-form").submit();
    });
  </script>
  </body>
</html>