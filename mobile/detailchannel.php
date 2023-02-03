<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/lib/article/detail_lang_0.php');

//参数
$vedioType = $_GET['vedioType'];
$vedioDetailType = $_GET['vedioDetailType'];
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
      /*视频列表*/
      .vedio-icon{ color: #C31373; font-size: 20px;}
      .media{display:block; widows: 100%; padding:0px 0px; }
      .media a{display:block;     position: relative;    margin-bottom: 10px;text-decoration: none;}
      .media li{list-style-type:none; }
      .media-li .img-div{width: 36%;padding: 1%; }
      .media-li .img-div img{width:100%; }
      .media-li .media-info{width:60%; position: absolute; height: 100%; right:0px; bottom: 0px; right: 0px; padding-top: 5px; }
      .media-li .media-info p{margin: 0px 0px; overflow : hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; color:#939393; font-size: 14px; }
      .more-btn{display: block; width: 80%; height: 40px; font-size: 16px; margin: 0 auto; margin-bottom: 10px; }
      .finish-line{text-align: center; height: 50px; display: none; }
      .btn-warning {color: #fff; background-color: #ff946e; border-color: #ff946e; }
      .btn-warning:hover {color: #fff; background-color: #F17E56; border-color: #F17E56; }
    </style>
  </head>
  <body>
  <!--引入头部-->
  <?php include('mobilehead.php');?>

  <!-- 最新上架活动 -->
  <div class="container">
  <h4>相关视频</h4>
  <ul class="media">
  <!-- 异步加载list -->
  </ul>
  <button type="button" class="btn btn-warning btn-lg more-btn" id="loadBtn">加载更多</button>
  <div class="finish-line">_____________ . _____________</div>
  </div>

  <!--引入尾部-->
  <?php include('mobilefoot.php');?>

  <script src="/mobile/js/jquery.1.11.3.min.js"></script>
  <script src="/mobile/js/bootstrap.min.js"></script>
  <script src="/mobile/js/base.js"></script>
  <script>
    var curPage = 1;
    var vedioType = "<?=$vedioType?>";
    var vedioDetailType = "<?=$vedioDetailType?>";
    $(function(){
      getVedioList(1);

      $("#loadBtn").click(function(){
        curPage ++;
        getVedioList(curPage);
      });
    })

    function getVedioList(curPage){
      var jsonData = "{\"vedioType\":\"" + vedioType + "\",\"vedioDetailType\":\"" 
                    + vedioDetailType +"\",\"curPage\":" + curPage + "}";
      $.ajax({
        type: "POST",
        url: "/mobile/vediodao.php",
        data: jQuery.parseJSON(jsonData),
        success: function(data){
          var dataJson = jQuery.parseJSON(data); 
          if(dataJson.length == 0 || dataJson.length != 9){//9为当前最多个数
            $("#loadBtn").hide();
            $(".finish-line").show();
          }
          var strList = "";
          
          $.each(dataJson, function(n,value){
            strList += "<a href='/mobile/vedio.php?vedioType="+ value.vedio_type +"&id=" + value.id +"' target='_blank'>"+
                      "<li class='media-li'>"+
                      "<div class='img-div'>"+
                      "  <img src='"+ value.pic +"' alt='...'>"+
                      "</div>"+
                      "<div class='media-info'>"+
                      "  <p>"+ value.vedio_name +"</p>"+
                      "  <div>"+
                      "    <span class='glyphicon glyphicon-facetime-video vedio-icon' aria-hidden='true'></span>"+
                      "  </div>"+
                      "</div>"+
                      "</li>"+
                      "</a>"+
                      "<div class='clearfix'></div>";
          });
          $(".media").append(strList);
          //点击效果
          //tapStyle(".media a");
        },
        error:function(){
          curPage --;
          alert("出错了！")
        }
      });
    }
  </script>
  </body>
</html>