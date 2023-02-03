<div class="Banner over relative" style="width:<?php echo $ad['Width'] ? $ad['Width'].'px' : "auto";?>; height:<?php echo $ad['Height'] ? $ad['Height'].'px' : "auto";?>;">
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
        <a class="fl mL10 <?php echo !$i ? "cur" : "";?>"></a>
        <?php }?>
    </div>
    <script src="/js/banner.js"></script>
    <?php }?>
</div>