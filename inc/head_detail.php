<iframe src="/inc/lib/global/info.php" style="display:none;"></iframe>
<?php $nav_meua=$db->get_limit('product_category',"UId = '0,' and IsNav = 1",'*','MyOrder desc,CateId asc');?>
<div id="Head" class="warp">
	<div class="l"><a href="/" title="九啾啾官网"><img src="/images/logo_web_t1.png" height="61px;" alt="九啾啾官网" /></a></div>
    <div class="r">
    	<div class="Member_btn">
        	<?php /*?><div id="select_city">
            	<img class="city_img" src="/images/city_tip.png" alt="城市" />
                <span id="Cityname"><?=$_SESSION['City_name']?$_SESSION['City_name']:'选择'?></span>&nbsp;&nbsp;<strong id="city_hand">[ 城市切换 ]</strong>
            </div><?php */?>
            <div class="teacherin"><a href="/products.php"><img src="/images/teacherin.png"/></a></div>&nbsp;&nbsp;
            <div id="select_city">
            	<img class="city_img" src="/images/city_tip.png" alt="城市" />
                <span id="Cityname"><?=$_SESSION['City_name']?$_SESSION['City_name']:'选择'?></span>&nbsp;&nbsp;<strong id="city_hand">[ 城市切换 ]</strong>
                <div class="showcy" id="showCity" style="z-index: 99; opacity: 1;">
                    <ul>
                    <?php 
                        $alter_city=$db->get_all('product_color','1');
                            foreach((array) $alter_city as $item){?>
                    <li><span><a href="/inc/lib/global/info.php?_City_name=<?=$item['Color']?>&_CId=<?=$item['CId']?>"><?=$item['Color']?></a></span></li>
                    <?php }?>
                    </ul>
                    <div class="clear"></div>
                    <p>更多城市即将开放，敬请期待！</p>
                </div>
            </div>
            
            <div id="member_lr">
            	<?php if($_SESSION['member_MemberId']){?>
            		<font class="fc_white fl">欢迎</font><a class="fc_organ" style="width:80px;" href="/account.php?module=orders&act=prelist#contents"><?=$_SESSION['member_UserName']?$_SESSION['member_UserName']:$_SESSION['member_Phone']?></a>
                    <a class="head_reg" href="/account.php?module=logout">退&nbsp;出</a>
                <?php }else{?>
                	<a class="head_login" href="/account.php?module=login">登&nbsp;录</a>
                	<a class="head_reg" href="/account.php?module=create">注&nbsp;册</a>
                <?php }?>
            </div>
           
        </div>
     <?php /*?><div id="alter_city" class="<?=$_SESSION['City_name']?'dis':''?>">
            <div class="city_bg">
                <div class="city_l">
                    <div class="fl select_item">
                        <form action="/inc/lib/global/info.php" method="get">
                        <div class="cur"><a id="city_choose" title="广州" name="490" href="javascript:void(0)">广州</a></div>
                        <div id="test" class="nor">
                        	<?php 
								$alter_city=$db->get_all('product_color','1');
							foreach((array) $alter_city as $item){?>
                            <a title="<?=$item['Color']?>" name="<?=$item['CId']?>" href="javascript:void(0)"><?=$item['Color']?></a>
                            <?php }?>
                        </div>
                    </div>
                    <a class="fl" id="select_btn"> <img src="/images/select_btn.jpg"></a>
                    <input class="fl select_sub" type="image" src="/images/city_btn.jpg">
                    <input type="hidden" name="action" value="city">
                    <input type="hidden" id="IId" name="_CId" value="<?=$alter_city[0]['CId']?>">
                    <input type="hidden" id="City_name" name="_City_name" value="<?=$alter_city[0]['Color']?>">
                    </form>
                </div>
            </div>
        </div><?php */?>
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
	/*jQuery('.cate_li').mouseover(
		function(){
			var i =jQuery(this).index()-1;
			if(!jQuery('.SNav').is(":animated") && jQuery('.SNav').eq(i).css('display')!='block'){
				jQuery('.SNav').hide(400)
				jQuery('.SNav').eq(i).show(400);	
			}
		}
	)*/
</script>
<script type="text/javascript">
	jQuery('#select_btn').click(
		function(){
			jQuery('#showCity').toggle();
		});
	jQuery('#city_hand').click(
		function(){
			jQuery('#showCity').toggle();
		}
	)
	jQuery('.select_item').find('a').click(
		function(){
			jQuery("#test").toggle();
			jQuery("#city_choose").html(jQuery(this).attr('title'));
			
			jQuery('#City_name').attr('value',jQuery(this).attr('title'));
			jQuery('#IId').attr('value',jQuery(this).attr('name'));
		}
	)
</script>