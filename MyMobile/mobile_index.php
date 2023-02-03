<!doctype html>
<html class="no-js">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <title>Hello Amaze UI</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="assets/i/favicon.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="assets/i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="assets/i/app-icon72x72@2x.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="assets/i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="assets/css/amazeui.min.css">
  <link rel="stylesheet" href="assets/css/app.css">
</head>
<body>
	
	
	
	
<?php include($site_root_path.'../inc/head.php');?>
<?php include($site_root_path.'../inc/banner.php');?>
<div id="Index">
	 <!--Part_one -->
    <div class="Part_one">
    	<div class="warp">
            <div class="title">
                <div class="top">课程种类</div>
                <div class="center">The Curriculum Type</div>
                <div class="bottom"></div>
            </div>
            <div class="cate_meua">
                <?php for($i=0,$len=count($nav_meua);$i<$len;$i++){
					$cur='';
					$i==0 && $cur='class="cur"';
					?>
                    <span <?=$cur?>><?=$nav_meua[$i]['Category']?></span>
                <?php }?>
            </div>
            <?php for($i=0,$len=count($nav_meua);$i<$len;$i++){
				$Curriculum=$SCategory[$nav_meua[$i]['CateId']];
				$coun=count($Curriculum);
				$coun>4 && $coun=4;
				//$Curriculum=$db->get_limit('product_category',"UId = '0,{$nav_meua[$i]['CateId']},",'');
			?>
            <div class="cate_pro <?=$i==0?'':'dis';?>">
            	<?php for($j=0;$j<$coun;$j++){
						$url=get_url('product_category',$Curriculum[$j]);
					?>
                <div class="item <?= $j!=3?'mR42':'';?>">
                <a href="<?=$url?>">
                	<div class="PicPath">
                    	<img src="<?=$Curriculum[$j]['PicPath']?>" alt="<?=$Curriculum[$j]['Category']?>"  />
                        <span></span>
                    </div>
                    <div class="name"><?=$Curriculum[$j]['Category']?></div>
                    <div class="brif"><?=$Curriculum[$j]['BriefDescription']?></div>
                    <div class="btn"></div>
                 </a>
                </div>
                <?php }?>
                <div class="clear"></div>
                <div class="more"><a href="../products.php"><img src="../images/yueke_more.png" /></a></div>
            </div>
            <?php }?>
			<script type="text/javascript">
                jQuery('.cate_meua').find('span').mouseover(
                    function(){
                        jQuery('.cate_meua').find('span').removeClass('cur');
                        jQuery(this).addClass('cur');
						jQuery('.cate_pro').addClass('dis');
						jQuery('.cate_pro').eq(jQuery(this).index()).removeClass('dis');
                    });
            </script>
    	</div>
    </div>
    <!-- Part_two -->
    <div class="Part_two">
    	<div class="warp">
        	<div class="title">
                <div class="top">预约流程</div>
                <div class="center">APPOINTMENT PROCESS</div>
            </div>
            <div class="preorder">
				<?php
				$margin=array('1'=>'margin-left:32px;',2=>'margin-left: 63px;',3=>'margin-left: 59px;');
				$pre_title=array('搜索老师','约课','续课','评价');
				$pre_cont=array('按条件进行筛选，查看老师的信息和评价记录，找到最适合自己的那一位老师。','向老师发起约课并将课程费托管到平台，老师会给您回复确认约课信息。','通过第一次约课与老师的面对面交流，老师会更加了解学生并做出课程规划，学生按需续课，平台会根据课程规划。','每节课完成后，学生确认付款，平台会将课程费打给老师，双方可以进行评价。');
				for($i=0,$len=count($prodcut_row);$i<4;$i++){?>
                <div class="item" style=" <?=$margin[$i]?>">
                    <div class="PicPath"><img src="../images/img_b<?=$i?>.png" alt="" /><span></span></div>
                    <div class="name"><?=$pre_title[$i]?></div>
                    <div class="brif"><?=$pre_cont[$i]?></div>
                </div>
                <?php }?>
                <div class="clear"></div>
                <div class="more"><a href="../article.php?AId=15"><img src="../images/yueke_b_more.png" alt="" /></a></div>
            </div>
        </div>
    </div>
    <!-- Part_three -->
    <div class="Part_three">
    	<div class="warp">
        	<div class="title">
                <div class="top">教师阵容</div>
                <div class="center">THE TEACHER TEAM</div>
                <div class="bottom">我们在别人眼中是只会拨弄音符的无业游民，我们在创作背后付出的心血无人理解。当音符串联在一起，
搭建成一座座人与人之间心灵沟通的桥梁，我们是快乐的。</div>
            </div>
            <div class="team_show">
            <div id="wrap4" class="wrap">
                    <ul class="item">
                    <?php
						//$where='IsInIndex = 1 and SoldOut=0';
						$where=1;
						//$CId = (int)$_SESSION['CId'];
						//$CId && $where.=" and ColorId = '$CId'";
					//var_dump($where);
					$prodcut_row=$db->get_all('product',$where,'*');
					for($i=0,$len=count($prodcut_row);$i<$len;$i++){
						$ext=$db->get_one('member_apply',"MemberId = '{$prodcut_row[$i]['MemberId']}'");
						$url=get_url('product',$prodcut_row[$i]);
						//$name=$prodcut_row[$i]['FirstName'].' '.$prodcut_row[$i]['FirstName'];
						$name=$prodcut_row[$i]['Name'];
						//$prodcut_row[$i]['Face']=$prodcut_row[$i]['Face']?$prodcut_row[$i]['Face']:'/images/face.jpg';
						$prodcut_row[$i]['PicPath_0']=$prodcut_row[$i]['PicPath_0']?$prodcut_row[$i]['PicPath_0']:'/images/face.jpg';
						?>
                        <li>
                            <div class="PicPath">
                                <a href="<?=$url?>"><img src="../<?=str_replace('s_','235X235_',$prodcut_row[$i]['PicPath_0'])?>" alt="<?=$name?>" /></a>
                                <span></span>
                            </div>
                            <div class="name">
                                <?=$name?>
                            </div>
                            
                            <div class="feature">
                            	<?=$ext['T_style']?>
                            </div>
                            
                            <div class="teachcate">
                            	教学科目：<?=$Category[$ext['CateId']]['Category']?>
                            </div>
                            
                            <div class="item_btn">
                            	<?php /*?><a class="btn1" target="addtocart_iframe" href="/cart.php?module=add&ProId=<?=$prodcut_row[$i]['ProId']?>&JumpUrl=/cart.php?module=add_success">向TA约课</a><?php */?>
                                <a class="btn1" target="addtocart_iframe" href="<?=$url?>">向TA约课</a>
                                <a class="btn2" href="<?=$url?>">查看详情</a>
                            </div>
                            <div class="hover_bg">
                                <div><?=$prodcut_row[$i]['Name']?></div>
                                <div>教学科目<?=$Category[$ext['CateId']]['Category']?></div>
                                <div>实际教龄：<?=$ext['T_age']?></div>
                                <?php /*?><div>授课方式：<?=?></div><?php */?>
                                <div>教学特长：<?=$ext['T_gift']?></div>
                                <div><?=$ext['T_style']?></div>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
            </div>
            <img src="../images/yueke_btn_left_no.png" id="prev4" alt="prev" />
            <img src="../images/yueke_btn_right_no.png" id="next4" alt="next" />
            </div>
    	</div>
    </div>
    <?php /*?><iframe name="addtocart_iframe" id="addtocart_iframe" src="about:blank" style="display:none;"></iframe><?php */?>
<script type="text/javascript">
    $(function() {
        $('#wrap4').marquee({
            auto: false,
            speed: 1000,
            showNum: 4,
            stepLen: 1,
            prevElement: $('#prev4'),
            nextElement: $('#next4')
        });
    })
</script>
    <!-- Part_four -->
    <div class="Part_four">
    	<div class="warp">
        	<div class="more_div">
        		<a class="more" href="../article.php?AId=16"> <img src="../images/yueke_more.png" alt="more" /></a>
            </div>
			<div class="title">
                <div class="top">我们的优势</div>
                <div class="center">OUR  ADVANTAGE</div>
            </div>
            <div class="blank63"></div>
            <?php 
				for($i=0;$i<4;$i++){		
			?>
            <div class="item">
            	<div class="number <?=($i+1)%2==0?'num0':'num1'?>"><?=($i+1)?></div>
                <div class="Title <?=($i+1)%2==0?'t0':'t1'?>"><?=$i==0?'专业水准':($i==1?'真实可靠':($i==2?'货真价实':'有保障'))?></div>
                <div class="Cont">&nbsp;&nbsp;————&nbsp;&nbsp;<?=$i==0?'全国首家专注于音乐教育的平台':($i==1?'师资审核严格，评价真实可靠':($i==2?'直面老师，质高价低':'备课等功能保障教学过程，担保交易可退款'))?></div>
            </div>
            <div class='clear'></div>
            <?php }?>
    	</div>
    </div>
</div>
<?php include($site_root_path.'/inc/foot.php');?>
	
	
	
	
	

<!--在这里编写你的代码-->

<!--[if (gte IE 9)|!(IE)]><!-->
<script src="assets/js/jquery.min.js"></script>
<!--<![endif]-->
<!--[if lte IE 8 ]>
<script src="http://libs.baidu.com/jquery/1.11.3/jquery.min.js"></script>
<script src="http://cdn.staticfile.org/modernizr/2.8.3/modernizr.js"></script>
<script src="assets/js/amazeui.ie8polyfill.min.js"></script>
<![endif]-->
<script src="assets/js/amazeui.min.js"></script>
</body>
</html>