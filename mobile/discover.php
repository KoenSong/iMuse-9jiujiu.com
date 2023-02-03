<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
/*微信工具包*/
include('../weixin/wx_config.php');
include('../weixin/Wechat.class.php');

//参数
$item = $_GET['item'];

//产品列表
$wx_products = $db->get_all("wx_product", "issell = 0", '*', "in_date desc");

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
    <title>九啾啾</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/mobile/css/bootstrap.min.css">
    <link rel="stylesheet" href="/mobile/css/main.css">
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    body{background: #F1E7E7;//background: f9f9f9;}
      /*微店产品*/
      .com-row .com-col-inline {
        text-align: center;
        margin-bottom: 15px;
        position: relative;
      }
      .com-row .com-col-inline img {
        width: 100%;
        padding: 3px;
      }
      .idx-info-inline{
        width: 90%;
        margin: 0 auto;
      }
      .idx-info-inline p {
        color: #3e3e3e;
        overflow: hidden;
        text-overflow: ellipsis;
        margin: 0px 0px;
        font-size: 14px;
        //padding: 5px 0px;
        text-align: left;
      }
      .price{
        font-style: normal;
        font-weight: 700;
        font-size: 16px;
        color: #f60;
        display: block;
        float:right;
      }
      .price-type{
        display: block;
        float: left;
        //background: #CCC;
        background:#F1E7E7;
        color: #3e3e3e;
        padding: 2px;
      }
      .idx-info-price{
        display: block;
        width: 88%;
        height: 27px;
        margin: 0 auto;
      }
      .h10{height: 10px;}
      .com-col-inline{
        text-align: center;
        margin: 0 auto;
        background: #FFF;
        width: 96%;
        border: 1px solid #EAE8E8;
      }
      .orange{background-color:#ff946e;}
      .com-row .com-col{float:left; width:50%; text-align:center; margin-bottom:5px;position:relative;}
      .com-row .com-col img{width: 95%; }
      .com-row .com-col .vedio-icon{ position: absolute; right: 10px; top: 5px; color: #C31373; font-size: 20px;}
      .com-row .com-col .idx-info{//background-color:rgba(20, 20, 21, 0.71); width: 95%; text-align: center; margin-left: auto; margin-right: auto; margin-bottom: 10px;}
      .idx-info p{height: 40px; color: #939393;//white-space: nowrap; overflow: hidden; text-overflow: ellipsis; //font-weight: bold; margin-right:0px;margin-left:0px;display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;}
      .com-row .com-col-a .idx-info-a{ width: 95%; text-align: center; margin-left: auto; margin-right: auto;  }
      .idx-info-a p{color: #939393; height: 50px;overflow: hidden; text-overflow: ellipsis;    margin: 0px 0px;}
      /*导航条 教学视频*/
      .channel-title{display: block; height: 40px; color: #939393; }
      .channel-title h4{width: 100%; display: block; float: left; height: 26px; line-height: 18px; font-size: 20px; position: relative; }
      .channel-title .ui.arrow {background: url(/mobile/img/more.png) no-repeat; display: block; width: 15px; height: 22px; float: right; background-size: contain !important; right: 0px; top: 0px; position: absolute; }
      /*巨幕广告*/
      .ad img{width:100%;border-radius: 8px;}
      .idx-guide .idx-col{width:33%; float:left; margin-left: 0%; height: 70px;}
      .idx-col img{width:50px; }
      .idx-col i{ display:block;font-style: normal;color:#3e3e3e;}
      /* .foot-nav{
        position: fixed;
        bottom:0;
        height: 44px;
        background: #FFF;
        width: 100%;
        border-top: 1px solid #E6E4E4;
      }
      .foot-nav .on{
        color:#18a1e0;
      }
      .item0,.item1,.item2{
        float:left;
        width: 33%;
        height: 44px;
      }
      .in-item{
        width: 60px;
        margin: 0 auto;
        text-align: center;
        height: 44px;
        line-height: 44px;
      }
      .in-item img{
        height: 25px;
      }
      .in-item span{
        display: block;
        float: right;
        margin-top: 3px;
      }
      .foot-nav a{
        color: #939393;
      } */
    </style>
<!--     <base target="_blank" /> -->
  </head>
  <body>
  <!--引入头部-->
  <?php include('mobilehead-a.php');?>


  <!-- 最新上架活动 -->
  <div class="h10"></div>
  <div class="container non-zone">
    <!-- 微信产品展示 
    <h4>推荐套餐<span class="badge orange">hot</span></h4>-->
    <div class="com-row">
      <?php foreach($wx_products as $product){ ?>
      <div class="com-col-inline">
        <a href="<?='/mobile/product/'.$product['place_code'].'.php';?>">
          <img src="<?=$product['pic']?>" alt="...">
          <div class="idx-info-inline">
            <p><?=$product['title']?></p>
          </div>
          <div class="clearfix"></div>
          <div class="idx-info-price">
            <span class="price-type"><?=$product['type']?></span>
            <span class="price">￥<?=$product['price']?></span>
          </div>
        </a>
      </div>
      <? } ?>
      <?php foreach($wx_products as $product){ ?>
      <div class="com-col-inline">
        <a href="<?='/mobile/product/'.$product['place_code'].'.php';?>">
          <img src="<?=$product['pic']?>" alt="...">
          <div class="idx-info-inline">
            <p><?=$product['title']?></p>
          </div>
          <div class="clearfix"></div>
          <div class="idx-info-price">
            <span class="price-type"><?=$product['type']?></span>
            <span class="price">￥<?=$product['price']?></span>
          </div>
        </a>
      </div>
      <? } ?>
      <?php foreach($wx_products as $product){ ?>
      <div class="com-col-inline">
        <a href="<?='/mobile/product/'.$product['place_code'].'.php';?>">
          <img src="<?=$product['pic']?>" alt="...">
          <div class="idx-info-inline">
            <p><?=$product['title']?></p>
          </div>
          <div class="clearfix"></div>
          <div class="idx-info-price">
            <span class="price-type"><?=$product['type']?></span>
            <span class="price">￥<?=$product['price']?></span>
          </div>
        </a>
      </div>
      <? } ?>
      <?php foreach($wx_products as $product){ ?>
      <div class="com-col-inline">
        <a href="<?='/mobile/product/'.$product['place_code'].'.php';?>">
          <img src="<?=$product['pic']?>" alt="...">
          <div class="idx-info-inline">
            <p><?=$product['title']?></p>
          </div>
          <div class="clearfix"></div>
          <div class="idx-info-price">
            <span class="price-type"><?=$product['type']?></span>
            <span class="price">￥<?=$product['price']?></span>
          </div>
        </a>
      </div>
      <? } ?>
      <!-- <div class="com-col-inline">
        <a href="/mobile/product/yxhz-tanghui.php">
          <img src="/mobile/img/w2.jpg" alt="...">
          <div class="idx-info-inline">
            <p>【K歌+交友+PK+速成】广州还有这么好玩的声乐课？</p>
          </div>
          <div class="clearfix"></div>
          <div class="idx-info-price">
            <span class="price-type">班课1V3</span>
            <span class="price">￥49.00</span>
          </div>
        </a>
      </div>
          
      <div class="com-col-inline">
        <a href="#">
          <img src="/mobile/img/w3.jpg" alt="...">
          <div class="idx-info-inline">
            <p>轻松学会一首歌【K歌级】</p>
          </div>
          <div class="clearfix"></div>
          <div class="idx-info-price">
            <span class="price-type">班课1V3</span>
            <span class="price">￥999.00</span>
          </div>
        </a>
      </div>
      <div class="com-col-inline">
        <a href="#">
          <img src="/mobile/img/w4.jpg" alt="...">
          <div class="idx-info-inline">
            <p>个人单曲录音体验！【乐趣无穷】</p>
          </div>
          <div class="clearfix"></div>
          <div class="idx-info-price">
            <span class="price-type">班课1V3</span>
            <span class="price">￥169.00</span>
          </div>
        </a>
      </div> -->
    </div>
    <div class="clearfix"></div>
  </div>
  <!-- <div class="foot-nav">
    <a href="/mobile/index.php?item=0">
    <div class="item0">
      <div class="in-item">
        <span>首页</span>
        <img src="/mobile/img/foot-d-nav0.png" />
      </div>
    </div>
    </a>
    <a href="/mobile/index.php?item=1">
    <div class="item1">
      <div class="in-item">
        <span>发现</span>
        <img src="/mobile/img/foot-d-nav1.png" />
      </div>
    </div>
    </a>
    <a href="/mobile/cart.php">
    <div class="item2">
      <div class="in-item">
        <span>我的</span>
        <img src="/mobile/img/foot-d-nav2.png" />
      </div>
    </div>
    </a>
  </div> -->

  <!--引入底部导航栏-->
  <?php include('foot-nav.php');?>

  <!--引入尾部-->
  <?php include('mobilefoot.php');?>

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  <script>
    $(function(){
      $(".banner-img").height($(window).height() * 0.27);

      //选项卡
      var item = "<?=$item;?>" == "" ? "0" : "<?=$item;?>";
      var itemOn = "/mobile/img/foot-nav"+item+".png";
      $(".item" + item).addClass("onNav");
      $(".item" + item).find("img").attr('src',itemOn); 
    })
  </script>
  </body>
</html>