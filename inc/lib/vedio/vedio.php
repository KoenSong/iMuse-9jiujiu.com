<?php 
include('../../../inc/site_config.php');
include('../../../inc/set/ext_var.php');
include('../../../inc/fun/mysql.php');
include('../../../inc/function.php');
include('../../../inc/category.php');//分类一起取出处理
include($site_root_path.'/inc/lib/article/detail_lang_0.php');

//参数
$vedioType = $_GET['vedioType'];
$vedioDetailType = $_GET['vedioDetailType'];
$key = $_GET['key'];
$where = array();
$tagParm = $_GET['tag'] ? "tag like '%|".$_GET['tag']."|%'" : "";
$tagGroupParm = $_GET['tagGroup'] ? "tag_group like '|".$_GET['tagGroup']."|'" : "";
$creatorParm = $_GET['creator'] ? "creator like '|".$_GET['creator']."|'" : "";
!empty($tagParm) && $where[] = $tagParm;
!empty($tagGroupParm) && $where[] = $tagGroupParm;
!empty($creatorParm) && $where[] = $creatorParm;

if(count($where) > 0){
    $whereStr = implode(" and ",$where);
}else{
    $whereStr = "1=1";
}
!empty($vedioType) && $whereStr = $whereStr." and vedio_type like '%".$vedioType."%'";
!empty($vedioDetailType) && $whereStr = $whereStr." and vedio_type = '".$vedioDetailType."'";
$key && $whereStr = "$whereStr and vedio_name like '%".urldecode($key)."%'";

//分页
$pageCount = 9;//每页个数
$totalNum = $db->get_row_count('vedio',$whereStr);//总数
$curPage = 1;//当前页数
$totalPage = ceil($totalNum/$pageCount);//总页数
//分页导航栏
$navCount = 10;//总共显示个数
$startNav = 1;//导航开始号
$endNav = 10;//导航结束号

if(isset($_GET['curPage'])){
	$curPage = $_GET['curPage'];
}


//总页数不大于10页
if($curPage <= $navCount){
	if($totalPage <= $endNav){
		$endNav = $totalPage;
	}
}else{
	$level = $curPage%$navCount > 0 ? ceil($curPage/$navCount)-1 : ($curPage/$navCount-1);//层数
	$startNav = $level * $navCount + 1;
	if($startNav == $totalPage){
		$endNav = $startNav;
	}else{
		if($totalPage <= $level * $navCount + $navCount){
			$endNav = $totalPage;
		}else{
			$endNav = $level * $navCount + $navCount;
		}
	}
}

$vedios=$db->get_limit('vedio', $whereStr, '*', 'in_date desc', ($curPage -1)*$pageCount, $pageCount);

$queryStr = "SELECT DISTINCT t.dict_name,t.dict_value FROM dict t JOIN vedio v ON v.[type] LIKE CONCAT('%|',t.dict_value,'|%') WHERE t.dict_type = '[dictType]'";
//最多显示标签个数
$maxShowNum = 7;
//标签
$str = str_replace("[type]", "tag", $queryStr);
$str = str_replace("[dictType]", "vedioTag_{$vedioType}", $str);
$result = $db->query($str);
while($row=mysql_fetch_assoc($result)){
    $dictTag[]=$row;
};
//分组
$str = str_replace("[type]", "tag_group", $queryStr);
$str = str_replace("[dictType]", "vedioTagGroup_{$vedioType}", $str);
$result = $db->query($str);
while($row=mysql_fetch_assoc($result)){
    $dictTagGroup[]=$row;
};
//指导老师
$str = str_replace("[type]", "creator", $queryStr);
$str = str_replace("[dictType]", "vedioCreator_{$vedioType}", $str);
$result = $db->query($str);
while($row=mysql_fetch_assoc($result)){
    $dictCreator[]=$row;
};
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
</style>
</head>

<body>
<div class="head_detail">
    <?php if($module!='login' || $module!='forgot' ){include($site_root_path.'/inc/head_detail.php');}?>
</div>
<!--头部-->

<!--检索-->
<div class="whole" style="margin-top: 20px;">
    <div class="plain_top">
        <div class="plain_round_TL"></div>
        <div class="plain_round_TR"></div>
    </div>
    <div class="plain_middle">
        <div class="plain_left">
            <div class="plain_right">
                <div class="contentF_01">
                    <!--检索列表-->
                    <div class="list01 gray">
                        <div class="list01_B" id="tag_div">
                            标签：
                            <a href="javascript:void(0)" class="blue weight" val="0">全部</a>
                                <?php 
                                    //最多显示7个
                                    for($i = 0; $i < $maxShowNum; $i++){
                                        echo "<a href='javascript:void(0)' val='".$dictTag[$i]['dict_value']."'>".$dictTag[$i]['dict_name']."</a>";
                                    }
                                ?>
                                
                        </div>
                        <div id="all_tags" class="all_hidden" style="display:none;">
                            标签：
                            <a href="javascript:void(0)" class="blue weight" val="0">全部</a>
                                <?php 
                                    for($i = 0; $i < count($dictTag); $i++){
                                        echo "<a href='javascript:void(0)' val='".$dictTag[$i]['dict_value']."'>".$dictTag[$i]['dict_name']."</a>";
                                    }
                                ?>
                        </div>
                        <div class="list01_C" id="teacher_div">
                            讲解老师：
                            <a href="javascript:void(0)" class="blue weight" val="0">全部</a>
                                <?php 
                                    //最多显示7个
                                    for($i = 0; $i < $maxShowNum; $i++){
                                        echo "<a href='javascript:void(0)' val='".$dictCreator[$i]['dict_value']."'>".$dictCreator[$i]['dict_name']."</a>";
                                    }
                                ?>
                        </div>
                        <div id="all_teachers" class="all_hidden" style="display:none;">
                            讲解老师：
                            <a href="javascript:void(0)" class="blue weight" val="0">全部</a>
                                <?php 
                                    for($i = 0; $i < count($dictTag); $i++){
                                        echo "<a href='javascript:void(0)' val='".$dictCreator[$i]['dict_value']."'>".$dictCreator[$i]['dict_name']."</a>";
                                    }
                                ?>
                        </div>
                        <div class="list01_D" id="category_div">
                            分组：
                            <a href="javascript:void(0)" class="blue weight" val="0">全部</a>
                                <?php 
                                    //最多显示7个
                                    for($i = 0; $i < $maxShowNum; $i++){
                                        echo "<a href='javascript:void(0)' val='".$dictTagGroup[$i]['dict_value']."'>".$dictTagGroup[$i]['dict_name']."</a>";
                                    }
                                ?>
                        </div>
                        <div class="all_hidden" id="all_categories" style="display:none;">
                            分组：
                            <a href="javascript:void(0)" class="blue weight" val="0">全部</a>
                                <?php 
                                    for($i = 0; $i < count($dictTag); $i++){
                                        echo "<a href='javascript:void(0)' val='".$dictTagGroup[$i]['dict_value']."'>".$dictTagGroup[$i]['dict_name']."</a>";
                                    }
                                ?>
                        </div>
                        <!-- <div class="list01_B" id="order_div">
                            排序：
                            <a href="javascript:void(0)" class="blue weight" val="createTime">最新上传</a>
                            <a href="javascript:void(0)" val="clickTimes">人气最高</a>
                            <a href="javascript:void(0)" val="commentTimes">评论最多</a>
                            <a href="javascript:void(0)" val="collectTimes">收藏最多</a>
                        </div>
                        <div class="list01_C" id="day_div">
                            时间：
                            <a href="javascript:void(0)" class="blue weight" val="0">不限</a>
                            <a href="javascript:void(0)" val="3">三天内</a>
                            <a href="javascript:void(0)" val="7">一周内</a>
                            <a href="javascript:void(0)" val="30">一个月内</a>
                            <a href="javascript:void(0)" val="365">一年内</a>
                        </div>
                        <div class="list01_D" id="size_div">
                            每页：
                            <a href="javascript:void(0)"  class="blue weight" val="9">9个结果</a>
                            <a href="javascript:void(0)"  val="18">18个结果</a>
                            <a href="javascript:void(0)"  val="27">27个结果</a>
                        </div> -->
                        <div class="bug"></div>
                    </div>
                    <!--检索列表结束-->
                    <!--搜索框-->
                    <div class="list02">
                        <div ><a href="/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>" class="list02_tb"></a></div>
                        <div class="list02_search"><input id="key_text" type="text" placeholder="请输入教程标题或老师名" value="<?=urldecode($key)?>"/></div>
                        <a href="javascript:void(0)" class="list02_btn" id="search_free">重新搜索</a>
                        <div class="bug"></div>
                    </div>
                    <!--搜索框结束-->
                </div>
            </div>
        </div>
    </div>
    <div class="plain_bottom">
        <div class="plain_round_BL"></div>
        <div class="plain_round_BR"></div>
    </div>
</div>
<!--检索结束-->

<!--免费课程列表-->
<div class="whole02">
    
    	<?php foreach($vedios as $vedio){ ?>
        <!--列表单个-->
        <div class="contentF_02">
            <div class="plain_top">
                <div class="plain_round_TL"></div>
                <div class="plain_round_TR"></div>
            </div>
            <div class="plain_middle">
                <div class="plain_left">
                    <div class="plain_right">
                        <div class="left03 gray">
                            <div class="tag_list02"></div>
                            <a href="/inc/lib/vedio/vedio_detail.php?vedioType=<?=$vedioType?>&id=<?=$vedio['id']?>" target="_top" class="left03_img_alter01">
                                <img src="<?=$vedio['pic']?>" width="286" height="200" alt="<?=$vedio['vedio_name']?>"/>
                                <span class="cutd size14 weight"><?=$vedio['vedio_name']?></span>
                                <span class="mask"></span>
                            </a>

                            <div class="left03_wz01">
                                <div class="tag">
                                    标签：
                                        <?php
                                            $tagItem = explode('|',substr($vedio['tag'],1,-1));
                                            $tagNameItem = explode('|',$vedio['tag_name']);
                                            for($i = 0; $i < count($tagItem); $i++){
                                                echo "<span class='size14'>".
                                                     "<a class='blue' href='/inc/lib/vedio/vedio.php?vedioType=$vedioType&tag=".$tagItem[$i]."'>".
                                                     $tagNameItem[$i].
                                                     "  </a>".
                                                     "  </span>";
                                            }
                                        ?>
                                </div>
                            </div>
                            <div class="left03_wz01">
                                分组：
                                    <?php
                                        $tagGroupItem = explode('|',substr($vedio['tag_group'],1,-1));
                                        $tagGroupNameItem = explode('|',$vedio['tag_group_name']);
                                        for($i = 0; $i < count($tagItem); $i++){
                                            echo "<span class='size14'>".
                                                 "<a class='blue' href='/inc/lib/vedio/vedio.php?vedioType=$vedioType&tagGroup=".$tagGroupItem[$i]."'>".
                                                 $tagGroupNameItem[$i].
                                                 "  </a>".
                                                 "  </span>";
                                        }
                                    ?>
                            </div>
                            <div class="left03_wz01">
                              讲解老师：
                                    <?php
                                        $creatorItem = explode('|',substr($vedio['creator'],1,-1));
                                        $creatorNameItem = explode('|',$vedio['creator_name']);
                                        for($i = 0; $i < count($tagItem); $i++){
                                            echo "<span class='size14'>".
                                                 "<a class='blue' href='/inc/lib/vedio/vedio.php?vedioType=$vedioType&creator=".$creatorItem[$i]."'>".
                                                 $creatorNameItem[$i].
                                                 "  </a>".
                                                 "  </span>";
                                        }
                                    ?>
                            </div>
                            <div class="left03_wz01">
                                <div class="floatLeft ">
                                    更新：<?=date('Y-m-d H:i:s',$vedio['in_date'])?>
                                </div>
                               <!--  <div class="floatRight"><span class="size14 red">204</span> 人气 / <span
                                       class="size14 red">0</span> 评论
                               </div> -->
                                <div class="bug"></div>
                            </div>
                            <!-- <div class="left03_wz01 starbox" fid="157014">
                                <span class="s_name">评分：</span>
                                
                                <ul class="star fl" score="0.0" free_id="157014">
                                    <li><a class="one-star " href="javascript:void(0)"></a></li>
                                    <li><a class="two-star " href="javascript:void(0)"></a></li>
                                    <li><a class="three-star " href="javascript:void(0)"></a></li>
                                    <li><a class="four-star " href="javascript:void(0)"></a></li>
                                    <li><a class="five-star " href="javascript:void(0)"></a></li>
                                </ul>
                                <span class="s_result fl" id="s_result_157014" score="0.0">未评分</span>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="plain_bottom">
                <div class="plain_round_BL"></div>
                <div class="plain_round_BR"></div>
            </div>
        </div>
        <!--列表单个结束-->
 		<?php }?>
    <div class="bug"></div>
</div>
<!--免费课程列表结束-->
<!--翻页控件-->
<div id="page">
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<?php if($startNav != 1){ ?>
				<td>
					<a href="/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>&curPage=<?=$startNav - 1;?>" class="pageLeft" title="上一组"></a>
				</td>
			<?php } ?>
			<!-- <td class="active">
					<span>1</span>
				</td>
				<td><a href="/free?page=1&tagId=0&teacherId=0&order=createTime&size=9&day=0&categoryId=0">2</a></td>
				 -->
			<?php for($i = $startNav; $i <= $endNav; $i++){ ?>
				<?php if($i == $curPage){ ?>
					<td class="active">
						<span><?=$i?></span>
					</td>
				<?php }else{ ?>
					<td>
						<a href="/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>&curPage=<?=$i?>"><?=$i?></a>
					</td>
				<?php }?>
			<?php }?>

			<?php if($endNav != $totalPage){ ?>
				<td>
					<a href="/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>&curPage=<?=$endNav + 1;?>" class="pageRigit" title="下一组"></a>
				</td>
			<?php } ?>

			<td><div class="pageWZ">跳转到：</div></td>

			<td><div class="textbox"><input id="target" type="text" class="bk02" placeholder="?" /></div></td>
			
			<td><a href="javascript:void(0)" id="jump_go">GO</a></td>
		</tr>
	</table>
	<script type="text/javascript">
		var totalPage = <?=$totalPage?>;
		$("#jump_go").bind({
			click:function(e){
				e.preventDefault();
				var page=$("#target").val();
				if($.isNumeric(page)&&page>0&&page<=totalPage){
					window.location="/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>&curPage="+page;
				}
			}
		});

        $("#tag_div,#all_tags a").bind({
        click: function (e) {
            var tagId = $(this).attr("val");
            window.location.href = "/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>&tag=" + tagId;
        }
        });
        $("#teacher_div,#all_teachers a").bind({
            click: function () {
                var teacherId = $(this).attr("val");
                window.location.href = "/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>&creator=" + teacherId;
            }
        });
        $("#category_div,#all_categories a").bind({
            click: function () {
                var categoryId = $(this).attr("val");
                window.location.href = "/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>&tagGroup=" + categoryId;
            }
        });
        $("#day_div a").bind({
            click: function () {
                var day = $(this).attr("val");
                window.location.href = "/free?tagId=" + '0' + "&teacherId=" + '0' + "&day=" + day + "&order=" + 'createTime' + "&size=" + '9' + "&categoryId=0";
            }
        });
        $("#order_div a").bind({
            click: function () {
                var order = $(this).attr("val");
                window.location.href = "/free?tagId=" + '0' + "&teacherId=" + '0' + "&day=" + '0' + "&order=" + order + "&size=" + '9' + "&categoryId=0";
            }
        });
        $("#size_div a").bind({
            click: function () {
                var size = $(this).attr("val");
                window.location.href = "/free?tagId=" + '0' + "&teacherId=" + '0' + "&day=" + '0' + "&order=" + 'createTime' + "&size=" + size + "&categoryId=0";
            }
        });
        $("#search_free").bind({
            click: function () {
                var key = $("#key_text").val();
                //key = encodeURI(key);
                key = encodeURI(encodeURI(key));
                window.location.href = "/inc/lib/vedio/vedio.php?vedioType=<?=$vedioType?>&key=" + key;
            }
        });

        $("#tag_div").mouseover(function () {
            $("#all_tags").show();
        });
        $("#teacher_div").mouseover(function () {
            $("#all_teachers").show();
        });
        $("#category_div").mouseover(function () {
            $("#all_categories").show();
        });
        $(".all_hidden").mouseleave(function () {
            $(this).hide();
        });
	</script>
</div>
    
<!--翻页控件结束-->
<div class="clear"></div>
<?php  if($module!='login' || $module!='forgot'){include($site_root_path.'/inc/foot.php');}?>
</body>
</html>