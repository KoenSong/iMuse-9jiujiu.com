<?php 
include('../../../inc/site_config.php');
include('../../../inc/set/ext_var.php');
include('../../../inc/fun/mysql.php');
include('../../../inc/function.php');
include('../../../inc/category.php');//分类一起取出处理
include($site_root_path.'/inc/lib/article/detail_lang_0.php');
//获取get参数
$vedioId = $_GET['id'];
$vedioType = $_GET['vedioType'];
$vedio = $db->get_one('vedio', 'id = '.$vedioId, $field='*', $order=1);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1200px" />
<?=seo_meta();?>
<link href="favicon.ico" rel="shortcut icon">
<link href="/inc/lib/vedio/css/global.css" rel="stylesheet" type="text/css" />
<link href="/css/lib.css" rel="stylesheet" type="text/css" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/inc/lib/vedio/css/common.css"/>
<link rel="stylesheet" type="text/css" href="/inc/lib/vedio/css/list.css"/>
<link rel="stylesheet" type="text/css" href="/inc/lib/vedio/css/pop-up-window.css">
<script type="text/javascript" src="/js/global.js"></script>
<script type="text/javascript" src="/js/checkform.js"></script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/marquee.js"></script>
<style>
body{background: url(/images/pro_list_bg.jpg) repeat;}
.head_detail #Nav .nav_ul li .SNav {
    background: #443636;
}
.head_detail #Nav .nav_ul li .SNav a {
    color: #F7F7F7;
}
.videoMore{width:800px;height:25px;}
</style>
</head>

<body>
<div class="head_detail">
    <?php if($module!='login' || $module!='forgot' ){include($site_root_path.'/inc/head_detail.php');}?>
</div>
<!--头部-->

<div class="whole" style="margin-top: 25px;">
    <!--左侧列表-->
    <!-- <div class="contentF_01 freef">
        <div class="plain_top">
            <div class="plain_round_TL"></div>
            <div class="plain_round_TR"></div>
        </div>
        <div class="plain_middle">
            <div class="plain_left">
                <div class="plain_right">
                    列表内容
                    <div id="box">
                    <div class="list01F">
                        <div class="list01">
                            <div class="list01_left">相关会员教程：</div>
                            <span class="down"><a class="list01_btnB"></a></span>
                            <span class="up"><a class="list01_btnA"></a></span>
                            <div class="bug"></div>
                        </div>
                    </div>
                    <div class="list_hidden">
                        <ul class="list" id="scroll_ul">
                            
                                
                                    <li>
                                        <a href="/s/lesson/160956" class="a3">分手快乐</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160957" class="a3">勇气</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160974" class="a3">后来</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160941" class="a3">好久不见</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160939" class="a3">十年</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160942" class="a3">红玫瑰</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160943" class="a3">答应不爱你</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160968" class="a3">宁夏</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160948" class="a3">至少还有你</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160940" class="a3">白天不懂夜的黑</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                            
                                
                                    <li>
                                        <a href="/s/lesson/160956" class="a3">分手快乐</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160957" class="a3">勇气</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160974" class="a3">后来</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160941" class="a3">好久不见</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160939" class="a3">十年</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160942" class="a3">红玫瑰</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160943" class="a3">答应不爱你</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160968" class="a3">宁夏</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160948" class="a3">至少还有你</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">辛欣</a>
                                    </li>
                                
                                    <li>
                                        <a href="/s/lesson/160940" class="a3">白天不懂夜的黑</a><br />
                                        <span class="gray">示范老师：</span>
                                        <a href="javascript:void(0)" class="a2">沈昂</a>
                                    </li>
                                
                            
                        </ul>
                    </div>
                </div>
                    列表内容结束
                </div>
            </div>
        </div>
        <div class="plain_bottom">
            <div class="plain_round_BL"></div>
            <div class="plain_round_BR"></div>
        </div>
    </div> -->
    <!--左侧列表结束-->
    <!--右侧视频-->
    <div class="contentF_02 freef">
        <div class="videoTitle size16 weight"><?=$vedio['vedio_name']?></div>
        
        <div class="videoMore">
            <div class="videoMore_Left">
                <!-- 教程时长：<span class="size14 red">08:17 </span> -->
                
                标签：
                    <?php
                        $tagItem = explode('|',substr($vedio['tag'],1,-1));
                        $tagNameItem = explode('|',$vedio['tag_name']);
                        for($i = 0; $i < count($tagItem); $i++){
                            echo "<a href='/inc/lib/vedio/vedio.php?vedioType=$vedioType&tag=".$tagItem[$i]."'>".
                            "<span class='blue'>".
                            $tagNameItem[$i].
                            "  </span>".
                            "</a>";
                        }
                    ?>
                
                分组：
                    <?php
                        $tagGroupItem = explode('|',substr($vedio['tag_group'],1,-1));
                        $tagGroupNameItem = explode('|',$vedio['tag_group_name']);
                        for($i = 0; $i < count($tagGroupItem); $i++){
                            echo "<a href='/inc/lib/vedio/vedio.php?vedioType=$vedioType&tagGroup=".$tagGroupItem[$i]."'>".
                            "<span class='blue'>".
                            $tagGroupNameItem[$i].
                            "  </span>".
                            "</a>";
                        }
                    ?>
                
                主讲：
                    <?php
                        $creatorItem = explode('|',substr($vedio['creator'],1,-1));
                        $creatorNameItem = explode('|',$vedio['creator_name']);
                        for($i = 0; $i < count($creatorItem); $i++){
                            echo "<a href='/inc/lib/vedio/vedio.php?vedioType=$vedioType&creator=".$creatorItem[$i]."'>".
                            "<span class='blue'>".
                            $creatorNameItem[$i].
                            "  </span>".
                            "</a>";
                        }
                    ?>
            </div>
           <!--  <div class="videoMore_right"><span class="size14 red">301</span> 人气 / <span
                   class="size14 red">0</span> 评论
           </div> -->
            <div class="bug"></div>
        </div>
        <div class="videoFrame">
            
                <embed pluginspage="http://www.macromedia.com/go/getflashplayer"
                       src="<?=$vedio['url']?>"
                       type="application/x-shockwave-flash" name="ssss" allowFullScreen="true"
                       allowScriptAccess="always" width="700" height="435" wmode="transparent">
                </embed>

                <!-- <video width="320" height="240" controls="controls">
                  <source src="<?=$vedio['url']?>" type="video/ogg">
                    Your browser does not support the video tag.
                </video> -->
            
            
        </div>
        <div class="videoText cuts">
            <!-- <a href="javascript:void(0)" class="videoTextOpen a3">查看全部</a> -->
            <span class="weight" style="margin-right: 5px;">教程简介：</span>
            <?=$vedio['vedio_desc']?>
            <a href="javascript:void(0)" class="videoTextOff a3" style="display: none;">隐藏全部</a>
        </div>
    </div>
    <!--右侧视频结束-->
    <div class="bug"></div>
    <!--菜单-->
    <!-- <div class="palyMenu">
        <div class="palyMenu_left"></div>
        <div class="palyMenu_right"></div>
        <div class="palyMenu_Btn">
            <a href="javascript:void(0)" class="palyMenu_BtnA" id="share_free" ></a>
    
                Baidu Button BEGIN
                <script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=0" ></script>
                <script type="text/javascript" id="bdshell_js"></script>
                <script type="text/javascript">
                    document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000)
                </script>
                Baidu Button END
            
            <div class="palyMenu_BtnD02">
                <span>总评分:<span id="score_num">0.0</span></span>
            </div>
            <div class="palyMenu_BtnD">
                <span class="gray">|</span>已有<span class="size14 yellow" id="grader_num" amo="0">0</span>人评分
            </div>
            <div class="palyMenu_BtnD02 starbox" fid="157014">
                这里加入评分控件
                <ul class="star_ul fl" free_id="157014">
                    <li><a class="one-star" title="很差" va="1" href="javascript:void(0)"></a></li>
                    <li><a class="two-star" title="差" va="2" href="javascript:void(0)"></a></li>
                    <li><a class="three-star" title="一般" va="3" href="javascript:void(0)"></a></li>
                    <li><a class="four-star" title="好" va="4" href="javascript:void(0)"></a></li>
                    <li><a class="five-star" title="很好" va="5" href="javascript:void(0)"></a></li>
                </ul>
                这里加入评分控件
            </div>
            <div class="palyMenu_BtnD02">
                <span class="weight">我要评分：</span>
            </div>
                <div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare">
                    <span class="bds_more">分享到：</span>
                    <a class="bds_qzone"></a>
                    <a class="bds_tsina"></a>
                    <a class="bds_tqq"></a>
                    <a class="bds_renren"></a>
                    <a class="bds_t163"></a>
                </div>
        </div>
        <div class="bug"></div>
    </div> -->
    <!--菜单结束-->
</div>

<div class="clear"></div>
<?php  if($module!='login' || $module!='forgot'){include($site_root_path.'/inc/foot.php');}?>
</body>
</html>