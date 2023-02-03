<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/lib/article/detail_lang_0.php');

//当前视频类型
$result = $db->query('select distinct vedio_type from vedio');
while($row=mysql_fetch_assoc($result)){
  $vedioTypes[]=$row;
}

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
      /*微店产品*/
      .orange{background-color:#ff946e;}
      .com-row .com-col{float:left; width:50%; text-align:center; margin-bottom:5px;position:relative;}
      .com-row .com-col img{width: 95%; }
      .com-row .com-col .vedio-icon{ position: absolute; right: 10px; top: 5px; color: #C31373; font-size: 20px;}
      .com-row .com-col .idx-info{//background-color:rgba(20, 20, 21, 0.71); width: 95%; text-align: center; margin-left: auto; margin-right: auto; margin-bottom: 10px;}
      .idx-info p{height: 40px; color: #939393;//white-space: nowrap; overflow: hidden; text-overflow: ellipsis; //font-weight: bold; margin-right:0px;margin-left:0px;display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;}
      .com-row .com-col-a .idx-info-a{ width: 95%; text-align: center; margin-left: auto; margin-right: auto;  }
      .idx-info-a p{color:#333; height: 50px;overflow: hidden; text-overflow: ellipsis;    margin: 0px 0px;}
      /*导航条 教学视频*/
      .channel-title{display: block; height: 40px; color: #939393; }
      .channel-title h4{width: 100%; display: block; float: left; height: 26px; line-height: 18px; font-size: 20px; position: relative; }
      .channel-title .ui.arrow {background: url(/mobile/img/more.png) no-repeat; display: block; width: 15px; height: 22px; float: right; background-size: contain !important; right: 0px; top: 0px; position: absolute; }
    </style>
  </head>
  <body>
  <!--引入头部-->
  <?php include('mobilehead.php');?>

  <!-- 最新上架活动 -->
  <div class="container">
    <!-- 视频展示 -->
    <?php 
      foreach($vedioTypes as $detailType){
        $vedioDetailType = $detailType['vedio_type'];
        $strArr = explode("_",$vedioDetailType);
        $vedioType = $strArr[0];
        $typeName = $db->get_value("product_category", "code = '{$vedioDetailType}'", "Category");
    ?>
    <div class="clearfix"></div>
    <a href="/mobile/detailchannel.php?vedioType=<?=$vedioType?>&vedioDetailType=<?=$vedioDetailType?>" class="channel-title" id="channel">
      <h4><?=$typeName?> <i class="ui arrow"></i></h4>  
    </a>
    <div class="clearfix"></div>
    <div class="com-row comWidth">
      <?php
        $vedios=$db->get_limit('vedio', "vedio_type = '{$vedioDetailType}'", '*', 'in_date desc', 0, 4);
        foreach ($vedios as $vedio) {
      ?>
        <div class="com-col">
          <a class="a-list" href="/mobile/vedio.php?vedioType=<?=$vedio['vedio_type']?>&id=<?=$vedio['id']?>">
            <span class="glyphicon glyphicon-facetime-video vedio-icon" aria-hidden="true"></span>
            <img src="<?=$vedio['pic']?>" alt="...">
            <div class="idx-info">
              <p><?=$vedio['vedio_name']?></p>
            </div>
          </a>
        </div>
      <?php
        }
      ?>
    </div>
    <?php 
      } 
    ?>
    
  </div>

  <!--引入尾部-->
  <?php include('mobilefoot.php');?>

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  </body>
</html>