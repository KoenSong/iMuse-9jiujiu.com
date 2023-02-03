<?php
!isset($product_row) && include($site_root_path.'/inc/lib/student/get_detail_row.php');
$member_ext=$db->get_one('member_ext',"MemberId = '$MemberId'");
$member_img=$db->get_one('student_pic',"MemberId = '$MemberId'");
ob_start();
?>
<div id="student_product_detail">
	<div class="P_one relative">
    	<div class="l">
        	<div class="PicPath">
            	<img src="<?=$product_row['Face']?>" alt="<?=$product_row['UserName']?>" />
                <span></span>
            </div>
            <div class="ItemNumber">学生ID:<?php echo sprintf('%08s',$product_row['MemberId'])?></div>
        </div>
        <div class="c">
        	<div class="info_cer">
            	<span class="name"><?=$product_row['UserName']?></span>
                <div class="clear"></div>
            </div>
            <div class="teacher_par">
                <span>性别:</span><span>&nbsp;<?=$ext_row['Title']=='1'?'男':'女';?></span>
                <br /><br />
                <span>希望学习的科目:</span>&nbsp;<?php 
					$hobby=explode('|',$member_ext['Hobby']);
					foreach((array)$hobby as $item){
						if($item=='')continue;
					?>
                       <span><?php echo $Category[$item]['Category']?></span>&nbsp;&nbsp;
                    <?php }?>
            </div>
            <div class="teach_info">
                <div class="par_0"><span><?=$ext_row['S_0']?>%</span><font>退课率</font></div>
            </div>
        </div>
         <div class="r">
            <div class="title">自我介绍</div>
            <div class="desc"><?=$member_ext['IntroDes']?></div>
            
            
         </div>
    </div>
    <div class="clear"></div>
    <div class="line"></div>
    <!-- Part5 -->
    <div class="P_five">
    	<div class="title" id="P_five">视频展示</div>
        <div class="cont">
        	<embed src="<?=$member_ext['Video']?>" width="600" height="498" type="application/x-shockwave-flash"> </embed>
            <?php for($i=0;$i<4;$i++){
				if(!is_file($site_root_path.$member_img['PicPath_'.$i])) continue;
			?>
            	<div><img src="<?=$member_img['PicPath_'.$i]?>" /></div>
            <?php }?>
        </div>
        
    </div>
     
    	</div>
    </div>  
     </div>
</div>
<?php
$product_detail_lang_0=ob_get_contents();
ob_end_clean();
?>