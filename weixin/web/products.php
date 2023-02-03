<?php 
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/category.php');//分类一起取出处理
//$alter_city=$db->get_all('product_color','1');

//if(!$_SESSION['City_name']){$_SESSION['City_name']=$alter_city[0]['Color'];$_SESSION['CId']=$alter_city[0]['CId'];}	
$ad=$db->get_one('ad',"AId = 3");
include($site_root_path.'/inc/lib/product/list_shop.php');
$alter_circle = $db->get_all('product_circle',"ColorId = '{$_SESSION['CId']}'",'CId,Circle','MyOrder desc,CId asc');
for($i=0,$ilen=count($alter_circle);$i<$ilen;$i++){
	$alter_circle_ary[$alter_circle[$i]['CId']] =  $alter_circle[$i];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1200px" />
<?=seo_meta();?>
<link href="favicon.ico" rel="shortcut icon">
<link href="/css/global.css" rel="stylesheet" type="text/css" />
<link href="/css/lib.css" rel="stylesheet" type="text/css" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/global.js"></script>
<script type="text/javascript" src="/js/checkform.js"></script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/marquee.js"></script>
<script type="text/javascript">
   
    //alert("温馨提示！微信公众平台升级中，想要获得更好的约课体验，请用电脑登录官网：http://9jiujiu.com，或致电：15820226863（刘老师）哟~~");
 var alertmessage="温馨提示！微信公众平台升级中，想要获得更好的约课体验，请用电脑登录官网：http://9jiujiu.com，或致电：15820226863（刘老师）哟~~！";
var once_per_session=1;
function get_cookie(Name) {
  var search = Name + "=";
  var returnvalue = "";
  if (document.cookie.length > 0) {
    offset = document.cookie.indexOf(search);
    if (offset != -1) {
      offset += search.length;
      end = document.cookie.indexOf(";", offset);
      if (end == -1)
         end = document.cookie.length;
      returnvalue=unescape(document.cookie.substring(offset, end));
      }
   }
  return returnvalue;
}
function alertornot(){
    //var exp = new Date();
//exp.setTime(exp.getTime() + 10);
    //document.cookie="alerted=no";
    //alert(get_cookie('alerted'));
   // delCookie('alerted');
    //alert(get_cookie('alerted'));
if (get_cookie('alerted') !='yes'){
loadalert();
var exp = new Date();
exp.setTime(exp.getTime() + 30*60*1000);
document.cookie="alerted=yes;expires=" + exp.toGMTString();
//document.cookie="alerted=yes";
}
}
function loadalert(){
alert(alertmessage);
}


if (once_per_session==0)
loadalert();
else
alertornot();

</script>
</head>

<body>
<?php include($site_root_path.'/inc/head.php');?>
<?php include($site_root_path.'/inc/in_banner.php');?>
<div id="Inproduct">
	<div class="warp">
    	<div class="webpath">
            <div class="Title">
                <div class="left">
                    <font>热门搜索</font><a>|</a><span>搜索最适合你的老师或课程</span>
                </div>
                <div class="right">
                	<img src="/images/home.jpg" alt="home" />&nbsp;&nbsp;<a>首页</a> &nbsp;>>&nbsp; <span>搜索 / 老师</span>
                </div>
            </div>
            <div class="search">
            	<div class="left"><img src="/images/pro_search_left.jpg" /></div>
                <div class="center">
                	<div class="act">
                        <div class="po">
                            <div class="menu">
                            	<div><strong><?php echo  $_SESSION['ProductByName']==''?'课程种类':$_SESSION['ProductByName']?></strong></div>
                                <dl class="menuout">
                                    <dd class="relative">
                                    <?php if($_SESSION['ProductByName']!=''){?>
                                    <a href="/inc/lib/global/info.php?ByCate=del">不限</a>
                                    <?php }?>
                                        <?php
                                        for($i=0; $i<count($products_sorted_by_ary); $i++){
											$product_scate=$db->get_all('product_category',"UId = '0,{$products_sorted_by_ary[$i]['CateId']},'");
                                        ?>
                                            <a href="/inc/lib/global/info.php?ByCate=<?=$products_sorted_by_ary[$i]['CateId'];?>&CateName=<?=$products_sorted_by_ary[$i]['Category'];?>" onmouseover="showselect(this)"><?=$products_sorted_by_ary[$i]['Category'];?></a>
                                            <ul class="absolute select_cate">
                                                <?php foreach((array)$product_scate as $item){?>
                                                	<li><a href="/inc/lib/global/info.php?ByCate=<?=$item['CateId'];?>&CateName=<?=$item['Category'];?>"><?=$item['Category'];?></a></li>
                                                <?php }?>
                                             </ul>
                                        <?php }?>
                                    </dd> 
                                </dl>
                            </div>
                            <script type="text/javascript">
								function showselect(obj){
									jQuery('.select_cate').hide();
									jQuery(obj).next('.select_cate').show();
								}
							</script>
                            <span class="fl"><img src="/images/pro_list_line.jpg"  /></span>
                            
                            
                            <div class="menu show">
                            	<div><strong><?php echo $_SESSION['ProductCircle']!=''?$alter_circle_ary[$_SESSION['ProductCircle']]['Circle']:'商区';?></strong></div>
                                <dl class="menuout">
                                    <dd> 
                                    <a href="/inc/lib/global/info.php?Circle=del">不限</a>
                                        <?php
                                        for($i=1; $i<count($alter_circle)+1; $i++){
                                        ?>
                                            <a href="/inc/lib/global/info.php?Circle=<?=$alter_circle[$i-1]['CId'];?>"><?=$alter_circle[$i-1]['Circle'];?></a>
                                        <?php }?>
                                    </dd> 
                                </dl>
                            </div>
                            <span class="fl"><img src="/images/pro_list_line.jpg"  /></span>
                            
                            <div class="menu show">
                            	<div><strong><?php echo $_SESSION['ProductGender']!=''?$Gender_ary[$_SESSION['ProductGender']]:'性别';?></strong></div>
                                <dl class="menuout">
                                    <dd> 
										<?php if($_SESSION['ProductGender']!=''){?>
                                        	<a href="/inc/lib/global/info.php?Gender=del">不限</a>
                                        <?php }?>
                                        <?php
                                        for($i=0; $i<(count($Gender_ary)); $i++){
                                        ?>
                                            <a href="/inc/lib/global/info.php?Gender=<?=$i+1;?>"><?=$Gender_ary[$i+1];?></a>
                                        <?php }?>
                                    </dd> 
                                </dl>
                            </div>
                            <span class="fl"><img src="/images/pro_list_line.jpg"  /></span>
                            
                            <div class="menu last">
                            	<div><strong><?php echo $_SESSION['ProductPriceOrder']!=''?$PriceOrder_ary[$_SESSION['ProductPriceOrder']]:'价格排序';?></strong></div>
                                <dl class="menuout"> 
                                    <dd> 
                                    	<?php if($_SESSION['ProductPriceOrder']!=''){?>
                                        	<a href="/inc/lib/global/info.php?PriceOrder=del">不限</a>
                                        <?php }?>
                                        <?php
                                        for($i=1; $i<(count($PriceOrder_ary)+1); $i++){
                                        ?>
                                            <a href="/inc/lib/global/info.php?PriceOrder=<?=$i;?>"><?=$PriceOrder_ary[$i];?></a>
                                        <?php }?>
                                    </dd> 
                                </dl>
                            </div>
                            
                            <div class="pro_from">
                            	<form action="/products.php" method="get">
                                	<input type="text" name="P0"  value="" />
                                    -
                                    <input type="text" name="P1" value=""  />
                            </div>
                            		<span class="fl"><img src="/images/pro_list_line.jpg"  /></span>
                            		<input class="btn" type="submit" value="确定">
                           	 	</form>
                        </div>
                    </div>
                    <div class="Teachsearch">
                    	<form action="/products.php" method="get">
                        	<input type="text" name="Keyword" class="input_left" value="输入老师姓名或者ID..." onfocus="if(this.value==this.defaultValue){this.value='';}" onblur="if(this.value==''){this.value=this.defaultValue;}">
                            <input type="image" src="/images/search_input_right.jpg" />
                        </form>
                    </div>
                </div>
                <div class="right"><img src="/images/pro_search_right.jpg" /></div>
            </div>
            <div class="blank25"></div>
            <!-- 列表 -->
            <div id="ProList_l">
            	<?=$product_list_shop;?>
            </div>
            <div id="ProList_r">
            	<?php include($site_root_path.'/inc/new_top.php');?>
                <?php include($site_root_path.'/inc/new_bottom.php');?>
            </div>
            <div class="blank30"></div>
        </div>
	</div>
</div>
<?php include($site_root_path.'/inc/foot.php');?>
</body>
</html>