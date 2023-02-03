<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/lib/article/detail_lang_0.php');

//获取get参数
$vedioId = $_GET['id'];
$vedioType = $_GET['vedioType'];
$vedio = $db->get_one('vedio', 'id = '.$vedioId, $field='*', $order=1);

$vedios=$db->get_limit('vedio', "id > {$vedioId} and vedio_type = '{$vedioType}'", '*', 'in_date desc', 0, 8);
//var_dump(count($vedios));
if(count($vedios) < 8){
  $con = 8 - count($vedios);
  $vedioId = $vedioId - $con;
}
$vedios=$db->get_limit('vedio', "id > {$vedioId} and vedio_type = '{$vedioType}'", '*', 'in_date desc', 0, 8);

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
      /*视频播放*/
      .vedio-cover{background:#000; margin-bottom:10px; }
      .vedio-cover iframe{width:100%; padding-bottom: 3%; vertical-align: middle; }
      .vedio-title{font-size:16px;color:#FFF; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; text-align: center; }
      .vedio-pad{margin-bottom: -20px; }
      .control-btn {display: inline-block; height: 38pt; width: 38pt; text-align: center; vertical-align: top; }
      .control-btn span {display: block; font-size: .75rem; color: #999; }
      .icons {display: inline-block; vertical-align: top; background: url(/mobile/img/ui_2.png) center no-repeat; background-size: 400px; }
      .icons.icons-share-gray {width: 24px; height: 24px; vertical-align: top; background-position: -251px -100px; }
      .icons.icons-addFav {width: 24px; height: 24px; vertical-align: top; background-position: -251px -33px; }
      /*相关推荐*/
      .orange{background-color:#ff946e;}
      .com-row .com-col{float:left; width:50%; text-align:center; margin-bottom:5px;position:relative;}
      .com-row .com-col img{width: 95%; }
      .com-row .com-col .vedio-icon{ position: absolute; right: 10px; top: 5px; color: #C31373; font-size: 20px;}
      .com-row .com-col .idx-info{//background-color:rgba(20, 20, 21, 0.71); width: 95%; text-align: center; margin-left: auto; margin-right: auto; margin-bottom: 10px;}
      .idx-info p{height: 40px; color: #939393;//white-space: nowrap; overflow: hidden; text-overflow: ellipsis; //font-weight: bold; margin-right:0px;margin-left:0px;display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;}
      .com-row .com-col-a .idx-info-a{ width: 95%; text-align: center; margin-left: auto; margin-right: auto;  }
      .idx-info-a p{color:#333; height: 50px;overflow: hidden; text-overflow: ellipsis;}
    </style>
  </head>
  <body>
  <!--引入头部-->
  <?php include('mobilehead.php');?>

  <div class="vedio-cover comWidth">
    <div class="vedio-title"><?=$vedio['vedio_name']?></div>
    <iframe frameborder="0" src="<?=$vedio['mobile_url']?>" allowfullscreen></iframe>
  </div>

  <div class="container">
    <div class="vedio-pad row">
      <div class="col-xs-6">
         <span class="control-btn btn-share">
            <i class="icons icons-share-gray"></i>
            <span>分享</span>
        </span>
        <span class="control-btn btn-addFav">
            <i class="icons icons-addFav"></i>
            <span>收藏</span>
        </span>
      </div>
    </div>
    <br>
    <!--相关推荐-->
    <h4>相关推荐</h4>
    <div class="com-row comWidth">
    <?php foreach($vedios as $vedio){ ?>
      <div class="com-col">
        <a href="/mobile/vedio.php?vedioType=<?=$vedioType?>&id=<?=$vedio['id']?>">
          <span class="glyphicon glyphicon-facetime-video vedio-icon" aria-hidden="true"></span>
          <img src="<?=$vedio['pic']?>" alt="...">
          <div class="idx-info">
            <p><?=$vedio['vedio_name']?></p>
          </div>
        </a>
      </div>
     <?php }?> 
    
  </div>
  </div>

  <!--引入尾部-->
  <?php include('mobilefoot.php');?>

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  <script>
    $(function(){
      $(".vedio-cover iframe").height($(window).height() * 0.35);
    })
  </script>
  </body>
</html>