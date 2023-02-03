<?php
!isset($article_row) && include($site_root_path.'/inc/lib/article/get_detail_row.php');
$GroupId = $article_row['GroupId'];
$ArtNav=$db->get_all('article',"GroupId = '$GroupId'");
ob_start();
?>
<div id="ArtTitle"><?=$article_row['Title']?></div>
<?php if($article_row['GroupId']==1){?>
<div id="ArtNav">
<img class="tipl" src="/images/aticle_round.jpg" />
	<?php for($i=0,$len=count($ArtNav);$i<$len;$i++){
			$url=get_url('article_group_0',$ArtNav[$i]);	
	?>
    <div class="fl" style="width:<?=100/count($ArtNav)?>%">
        <div class="item <?=$article_row['AId'] == $ArtNav[$i]['AId']?'cur':''?>">
            <a href="<?=$url?>"><?=$ArtNav[$i]['Title']?></a>
        </div>
    </div>
    <?php }?>
<img class="tipr" src="/images/aticle_round.jpg" />
</div>
<?php }?>
<div id="lib_article"><?=$article_row['Contents'];?></div>
<?php
$article_detail_lang_0=ob_get_contents();
ob_clean();
?>