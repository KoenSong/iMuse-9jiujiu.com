<div id="foot">
    <!-- Part_five -->
    <div class="foot_one">
        <div class="warp">
            <div class="title">
                <div class="top">友情链接</div>
                <div class="bottom"></div>
            </div>
            <div id="wrap5">
                <ul class="links">
                <?php 
					$footlink = $db->get_all('links','1','Name,Url,LogoPath','MyOrder desc,LId asc');
					for($i=0,$ilen=count($footlink);$i<$ilen;$i++){ 
				?>
                    <li><a href="<?=$footlink[$i]['Url']?>" title="<?=$footlink[$i]['Name']?>" target="_blank"><img src="<?=$footlink[$i]['LogoPath']?>" alt="<?=$footlink[$i]['Name']?>" /></a></li>
                <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    $(function() {
        $('#wrap5').marquee({
            auto: true,
            speed: 1000,
            showNum: 5,
            stepLen: 1,
        });
    })
    </script>
    <div class="foot_two">
    	<div class="warp">
        	<!-- top -->
        	<div class="border1">
                <div class="gotop"><img onclick="go_top()" src="/images/go_top.jpg" /></div>
                <?php /*?><div class="foot_logo"><img src="/images/foot_logo.jpg" alt="" /></div><?php */?>
                <div class="foot_nav">
                    <div class="item">
                        <div class="Title">关于我们</div>
                        <ul>
                        <?php $article_foot=$db->get_all('article','GroupId = 1');
							foreach((array)$article_foot as $item){
								$url=get_url('article',$item);
						?>
                            <li><a href="<?=$url?>"><?=$item['Title']?></a></li>
                         <?php }?>
                        </ul>
                    </div>
                    <div class="item">
                        <div class="Title">老师指南</div>
                        <ul>
                        <?php $article_foot=$db->get_all('article','GroupId = 2');
							foreach((array)$article_foot as $item){
								$url=get_url('article',$item);
						?>
                             <li><a href="<?=$url?>"><?=$item['Title']?></a></li>
                         <?php }?>
                        </ul>
                    </div>
                    <div class="item">
                        <div class="Title">学生指南</div>
                        <ul>
                        <?php $article_foot=$db->get_all('article','GroupId = 3');
							foreach((array)$article_foot as $item){
								$url=get_url('article',$item);
						?>
                             <li><a href="<?=$url?>"><?=$item['Title']?></a></li>
                         <?php }?>
                        </ul>
                    </div>
                </div>
                <div class="bus_opt">
                    <div class="top">商务合作</div>
                    <div class="bottom"><?=htmlspecialchars($mCfg['_Tel']);?></div>
                </div>
                <div class="now">
                    <div class="left">
                        <a href=""><img src="/images/sina_attion.jpg" /></a>
                        <a href=""><img src="/images/read_now.jpg" /></a>
                    </div>
                    <div class="right">
                        <div class="top"><img src="/images/erwei_bg.jpg"  /></div>
                        <div class="bottom">关注微信公众账号</div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <!-- bottom -->
            <div class="border2">
            	<div class="power">
                	<?=$db->get_value('article','AId = 3','Contents');?> <?php /*?><span style="font-size:12px; color:#ccc; margin-left:10px;">技术支持：</span><a target="_blank" href="http://www.ly200.com" title="广州联雅网络" style="color:#ccc; font-size:12px;">广州联雅网络</a><?php */?>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="GetTop"><a href="javascript://" onclick="go_top()"><img src="/images/get_top.png" /></a></div>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?move=0" charset="utf-8"></script>
<!-- JiaThis Button END -->
<script type="text/javascript">
function go_top(){
		jQuery("html, body").stop(false,true).animate({scrollTop: 0}, 1000);
	}
</script>
<?php echo js_code();?>