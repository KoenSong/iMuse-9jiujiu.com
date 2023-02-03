<?php
include('../../inc/category.php');//分类一起取出处理

$ad=$db->get_one('ad',"AId = 1");
ob_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=1200px" />
<?=seo_meta();?>
<link href="favicon.ico" rel="shortcut icon">
<meta property="qc:admins" content="464623340152156375" />
<link href="/css/global.css" rel="stylesheet" type="text/css" />
<link href="/css/lib.css" rel="stylesheet" type="text/css" />
<link href="/css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/global.js"></script>
<script type="text/javascript" src="/js/checkform.js"></script>
<script type="text/javascript" src="/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="/js/marquee.js"></script>
<style>
.sbj_a{color: #545454;}
span.cur:hover .sbj_a{color:#FFF;text-decoration: none;}
</style>
<script>
$(function(){
    $(".Part_one .cate_pro .item").hover(
        function(){
            $(this).children("a").children("div").children(".play").attr("src","/images/playQ_cur2.png");
        },function(){
            $(this).children("a").children("div").children(".play").attr("src","/images/playQ.png");
        }
    );

})
</script>
</head>

<body>
<?php include($site_root_path.'/inc/head.php');?>
<?php include($site_root_path.'/inc/banner.php');?>
<div id="Index">
	 <!--Part_one -->
    <div class="Part_one">
    	<div class="warp">
            <div class="title">
                <div class="top">教学视频种类</div>
                <div class="center">The Curriculum Vedio Type</div>
                <div class="bottom"></div>
            </div>
            <div class="cate_meua">
                <?php for($i=0,$len=count($nav_meua);$i<$len;$i++){
					$cur='';
					$cur=$i==0?'class="cur"':'class="translate"';
                    $code = $nav_meua[$i]['code'];
                    //TODO
                    if($i == 0 || $i == 3 || $i == 4){
                        $code = "vocality";
                    }
					?>
                    <span <?=$cur?>>
                        <a class="sbj_a" href="/inc/lib/vedio/vedio.php?vedioType=<?=$code?>"><?=$nav_meua[$i]['Category']?></a>
                    </span>
                <?php }?>
            </div>
            <?php for($i=0,$len=count($nav_meua);$i<$len;$i++){
				$Curriculum=$SCategory[$nav_meua[$i]['CateId']];
				$coun=count($Curriculum);
				$coun>4 && $coun=4;
				//$Curriculum=$db->get_limit('product_category',"UId = '0,{$nav_meua[$i]['CateId']},",'');
			?>
            <div class="cate_pro <?=$i==0?'':'dis';?>">
            	
                <?php
                    for($j=0;$j<$coun;$j++){
                        $nav_meua[$i]['CateId'] == 1 && $vedioType = "nationInstrument";
                        $nav_meua[$i]['CateId'] == 2 && $vedioType = "westInstrument";
                        $nav_meua[$i]['CateId'] == 3 && $vedioType = "vocality";
                        $nav_meua[$i]['CateId'] == 4 && $vedioType = "dance";
                        $nav_meua[$i]['CateId'] == 9 && $vedioType = "musicTheory";

                        //TODO
                        if($nav_meua[$i]['CateId'] == 1 || $nav_meua[$i]['CateId'] == 4 || $nav_meua[$i]['CateId'] == 9){
                            $vedioType = "vocality";
                        }
                        $url = "/inc/lib/vedio/vedio.php?vedioType=$vedioType";

                ?>
                <div class="item <?= $j!=3?'mR42':'';?> translate">
                <a href="<?=$url?>">
                	<div class="PicPath">
                    	<img src="<?=$Curriculum[$j]['PicPath']?>" alt="<?=$Curriculum[$j]['Category']?>"  />
                        <img src="/images/playQ.png" class="play translate" alt="播放" />
                        <span></span>
                    </div>
                    <div class="name"><?=$Curriculum[$j]['Category']?></div>
                    <div class="brif"><?=$Curriculum[$j]['BriefDescription']?></div>
                    <div class="btn translate"></div>
                 </a>
                </div>
                <?php }?>
                <div class="clear"></div>
                <div class="more"><a href="/products.php"><img src="/images/yueke_more.png" /></a></div>
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
				$pre_cont=array('按条件进行筛选，查看老师的信息和评价记录，找到最适合自己的那一位老师。','向老师发起约课并将课程费托管到平台，老师会给您回复确认约课信息。','通过第一次约课，老师会更加了解学生并做出课程规划，学生按需续课，平台会根据课程规划、备课、课后作业信息保障课程质量。','每节课完成后，学生确认付款，平台会将课程费打给老师，双方可以进行评价。');
				for($i=0,$len=count($prodcut_row);$i<4;$i++){?>
                <div class="item" style=" <?=$margin[$i]?>">
                    <div class="PicPath"><img src="/images/img_b<?=$i?>.png" alt="" /><span></span></div>
                    <div class="name"><?=$pre_title[$i]?></div>
                    <div class="brif"><?=$pre_cont[$i]?></div>
                </div>
                <?php }?>
                <div class="clear"></div>
                <div class="more"><a href="/article.php?AId=7"><img src="/images/yueke_b_more.png" alt="" /></a></div>
            </div>
        </div>
    </div>
    <!-- Part_three -->
    <div class="Part_three">
    	<div class="warp">
        	<div class="title">
                <div class="top">教师阵容</div>
                <div class="center">THE TEACHER TEAM</div>
                <!-- <div class="bottom">我们在别人眼中是只会拨弄音符的无业游民，我们在背后付出的心血无人理解。当音符串联在一起，
                搭建成一座座人与人之间心灵沟通的桥梁，我们是快乐的。</div> -->
                <div class="bottom">我们是音乐的爱好者，站在巨人的肩膀上，我们更是音乐的传播者。当音符串联在一起，
                搭建成一座座人与人之间心灵沟通的桥梁，我们是快乐的。</div>
            </div>
            <div class="team_show">
            <div id="wrap4" class="wrap">
                    <ul class="item">
                    <?php
						//$where='IsInIndex = 1 and SoldOut=0';
						$where='SoldOut=0';
						//$CId = (int)$_SESSION['CId'];
						//$CId && $where.=" and ColorId = '$CId'";
					//var_dump($where);
					//$prodcut_row=$db->get_all('product',$where,'*','Review desc,MyOrder desc');
                    $prodcut_row=$db->get_limit('product', $where, '*', 'Review desc,MyOrder desc', 0, 15);
					for($i=0,$len=count($prodcut_row);$i<$len;$i++){
						//$ext=$db->get_one('member_apply',"MemberId = '{$prodcut_row[$i]['MemberId']}'");
						$ext=$db->get_one('product_ext',"ProId = '{$prodcut_row[$i]['ProId']}'");
						//var_dump($ext);
						$url=get_url('product',$prodcut_row[$i]);
						//$name=$prodcut_row[$i]['FirstName'].' '.$prodcut_row[$i]['FirstName'];
						$name=$prodcut_row[$i]['Name'];
						//$prodcut_row[$i]['Face']=$prodcut_row[$i]['Face']?$prodcut_row[$i]['Face']:'/images/face.jpg';
						$prodcut_row[$i]['PicPath_0']=$prodcut_row[$i]['PicPath_0']?$prodcut_row[$i]['PicPath_0']:'/images/face.jpg';
						?>
                        <li>
                            <div class="PicPath">
                                <a href="<?=$url?>"><img src="<?=str_replace('s_','235X235_',$prodcut_row[$i]['PicPath_0'])?>" alt="<?=$name?>" /></a>
                                <span></span>
                            </div>
                            <div class="name">
                                <?=$name?>
                            </div>
                            
                            <div class="feature">
                            	<?=$ext['Warranty0']?>
                            </div>
                            
                            <div class="teachcate">
                            	科目：<?=$Category[$prodcut_row[$i]['CateId']]['Category']?>
                            </div>
                            
                            <div class="item_btn">
                            	<?php /*?><a class="btn1" target="addtocart_iframe" href="/cart.php?module=add&ProId=<?=$prodcut_row[$i]['ProId']?>&JumpUrl=/cart.php?module=add_success">向TA约课</a><?php */?>
                                <a class="btn1 translate" target="addtocart_iframe" href="<?=$url?>">向TA约课</a>
                                <a class="btn2 translate" href="<?=$url?>">查看详情</a>
                            </div>
                            <div class="hover_bg">
                                <div style=" font-size:16px; font-weight:bold;"><label style=" font-size:14px; font-weight:normal;">教学:</label> <span><?=$prodcut_row[$i]['Name']?></span></div>
                                <div><label>科目:</label><span><?=$Category[$prodcut_row[$i]['CateId']]['Category']?></span></div>
                                <div><label>实际教龄:</label><span><?=$db->get_value('member_ident',"MemberId='{$prodcut_row[$i]['MemberId']}'",'T_age');?></span></div>
                                <?php /*?><div>授课方式：<?=?></div><?php */?>
                                <div><label>教学特长:</label><span><?=$ext['Warranty1']?></span></div>
                            </div>
                        </li>
                        <?php }?>
                    </ul>
            </div>
            <img src="/images/yueke_btn_left_no.png" id="prev4" alt="prev" />
            <img src="/images/yueke_btn_right_no.png" id="next4" alt="next" />
            </div>
    	</div>
    </div>
    <?php /*?><iframe name="addtocart_iframe" id="addtocart_iframe" src="about:blank" style="display:none;"></iframe><?php */?>
<script type="text/javascript">
	/*$('#wrap4').on('mouseover','.item li',
        function(){
            // if(!$(this).find('.hover_bg').is(":animated")){
                $(this).find('.hover_bg').stop(false,true).slideDown(1000);
            // }
        }
    )
    $('#wrap4').on('mouseout','.item li',
        function(){
            // if(!$(this).find('.hover_bg').is(":animated")){
                $(this).find('.hover_bg').stop(false,true).slideUp(600);
            // }
        }
    )*/
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
        		<a class="more" href="http://9jiujiu.com/products.php"> <img src="/images/yueke_more.png" alt="more" /></a>
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
</body>
</html>
<?php
$html_contents=ob_get_contents();
ob_end_clean();
$file=write_file('/', 'index.html', $html_contents, 1);
echo get_lang('html.write_success').": {$file}<br>";
?>