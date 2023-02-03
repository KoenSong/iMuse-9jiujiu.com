<?php
$member_info=$db->get_one('member', "MemberId='{$_SESSION['member_MemberId']}'");
$member_ident=$db->get_one('member_ident',"MemberId='{$_SESSION['member_MemberId']}'");
//暂时只开放广州区（临时加入）
$_SESSION['City_name']= '广州市';
$_SESSION['CId']=1;
?>

<div id="Head" class="warp">
	<div class="l"><a href="/" title="九啾啾官网"><img src="/images/logo_web_new.png" alt="九啾啾官网" /></a></div>
    <div class="r">
    	<div class="Member_btn">
        	<div id="select_city"></div>
            <div id="member_lr"></div>
        </div>
        <iframe style="display:none;" src="/inc/head_iframe.php"></iframe>
        <div class="clear"></div>
        <div id="Nav">
        	<ul class="nav_ul">
            	<li><a class="Fa" href="/">首页</a></li>
                <?php 
				$len=count($nav_meua);
				count($nav_meua)>7 && $len=7;
				for($i=0; $i<$len;$i++){?>
				<li class="cate_li"><a class="Fa" href="<?=get_url('product_category',$nav_meua[$i])?>"><?=$nav_meua[$i]['Category']?></a>
                        <div class="SNav">
                            <?php 
                                $S_cate=$SCategory[$nav_meua[$i]['CateId']];
                                foreach((array)$S_cate as $item){
                            ?>
                            <a href="<?=get_url('product_category',$item)?>"><?=$item['Category']?></a>
                            <?php }?>
                       </div>
                </li>
				<?php }?>
                <li><a class="Fa" href="/article.php?GroupId=1">关于我们</a>
                	<div class="SNav">
                            <?php 
                                $S_headart=$db->get_limit('article',"GroupId = 1");
                                foreach((array)$S_headart as $item){
                            ?>
                            <a href="<?=get_url('article',$item)?>"><?=$item['Title']?></a>
                            <?php }?>
                       </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="clear"></div>
</div>
<script type="text/javascript">
	function select_btn(){
		jQuery('#showCity').toggle();
	}
	function city_hand(){
		jQuery('#showCity').toggle();
	}
	function select_item(){
		jQuery("#test").toggle();
		jQuery("#city_choose").html(jQuery(this).attr('title'));
		
		jQuery('#City_name').attr('value',jQuery(this).attr('title'));
		jQuery('#IId').attr('value',jQuery(this).attr('name'));
	}
</script>