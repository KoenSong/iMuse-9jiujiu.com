<div class="Banner relative" style="width:<?php echo $ad['Width'] ? $ad['Width'].'px' : "auto";?>; height:<?php echo $ad['Height'] ? $ad['Height'].'px' : "auto";?>;">
    <?php 
        for($i=0;$i<$ad['PicCount'];$i++){
            if(!is_file($site_root_path.$ad['PicPath_'.$i])){
                continue;
            }
    ?>
    <a href="<?php echo $ad["Url_$i"];?>" class="absolute" style=" background:url(<?php echo $ad["PicPath_$i"];?>) no-repeat center center; width:100%; height:100%;"></a>
    <?php }?>
    
    <?php if($ad['PicCount']>1){?>
    <div class="page over">
        <?php 
            for($i=0;$i<$ad['PicCount'];$i++){
                if(!is_file($site_root_path.$ad['PicPath_'.$i])){
                    continue;
                }
        ?>
        <a class="mL10 <?php echo !$i ? "cur" : "";?>"></a>
        <?php }?>
    </div>
    <script src="/js/banner.js"></script>
    <?php }?>
    <!-- 广告搜索 -->
    <div style="position:relative; width:1200px;margin:0 auto;">
    	<form action="/products.php" method="get">
        <div id="Select_b">
            <div class="C_type">课程种类
             	<div class="blank15"></div>
            	<div class="C_type_click round"><input type="text" autocomplete='off' id="Category" name="Category" value="请输入关键字..." onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" /><a class="more" href="javascript://" onclick="jQuery('#C_type_select').toggle(500);"></a></div>
                <div id="C_type_select">
                	<?php
					 foreach($FCategory as $item){
						foreach((array)$SCategory[$item['CateId']] as $val){
					?>
                		<a href="javascript://" date="<?=$val['CateId']?>" onclick="c_type_select(this)"><?=$item['Category']?> — <?=$val['Category']?></a>
                    	<?php }?>
                    <?php }?>
                </div>
                <input type="hidden" name="C_type" id="C_type" value="" />
            </div>
            <script type="text/javascript">
					function c_type_select(obj){
						jQuery('#Category').val(jQuery(obj).html());
						jQuery('#C_type').attr('value',jQuery(obj).attr('date'));
						jQuery('#C_type_select').hide(500);
					}
			</script>            
            <div class="C_addrees">上课地点
            	<div class="blank15"></div>
            	<div class="C_addrees_click round"><span id="C_addrees_S">请选择...</span><a href="javascript://" style="float:right; display:block; width:44px; height:48px;" onclick="jQuery('#C_addrees_select').toggle(500);"></a></div>
                <div id="C_addrees_select">
                	<?php $State = $db->get_all('product_color','1');?>
                	<?php foreach((array)$State as $item){?>
                		<a href="javascript://" title="<?=$item['Color']?>" date='<?=$item['CId']?>'><?=$item['Color']?></a>
                    <?php }?>
                </div>
                <input type="hidden" name="C_addrees" id="C_addrees" value="" />
            </div>
            <div class="submit">
            	<input type="image" src="/images/select_btn.png"  />
            </div>
            </form>
        </div>
    </div>
</div>
<div class="clear"></div>
<script type="text/javascript">
	jQuery('#C_addrees_select').find('a').click(
		function(){
				jQuery('#C_addrees_S').html(jQuery(this).html());
				jQuery('#C_addrees').attr('value',jQuery(this).attr('date'));
				jQuery('#C_addrees_select').hide(500);
			}
	);
	jQuery('#Category').keyup(
		function(){
			jQuery('#C_type_select').load('/ajax/c_type_select.php?calsscate='+jQuery(this).val());
			jQuery('#C_type_select').show();
		}
	)
</script>