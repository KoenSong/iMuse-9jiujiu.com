<?php
$cur='课程发布';
$product_row=$db->get_all('product',"MemberId = '{$member_info['MemberId']}'");
?>
<div id="lib_member_issue">
	<div class="webpath">
    	<span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span>
    </div>
		<div class="lib_member_info">
        	<?php if(!count($product_row)){?><span class="issue_t">如果您要发布课程,请点击</span><a class="addissue" href="/account.php?module=issue_add">添加</a><?php }?>
        	<div class="clear"></div>
        </div>
		<div class="form lib_member_item_card">
        	<!--<div class="issue_list_t">课程列表</div>-->
            <div class="lib_member_sub_title">课程列表</div>
			<?php if(count($product_row)){?>
            	<?php 
					$th_ary=array('课程ID','课程类型','学生','教学科目','课时数','操作');
				?>
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="item_list" style="border-bottom:none;">
                                <tbody>
                                <tr class="tb_title">
                                    <td style="border-bottom:1px solid #ddd;" width="5%">课程ID</td>
                                    <?php /*?><td style="border-bottom:1px solid #ddd;" width="20%">课程类型</td><?php */?>
                                    <td style="border-bottom:1px solid #ddd;" width="15%">报名学生数</td>
                                    <td style="border-bottom:1px solid #ddd;" width="15%">教学科目</td>
                                    <td style="border-bottom:1px solid #ddd;" width="15%">课时数</td>
                                    <td style="border-bottom:1px solid #ddd; border-right:none;" width="10%">操作</td>
                                </tr>
                                <?php
									$i=1;
									foreach((array)$product_row as $item){
									$pro_ext=$db->get_one('product_ext',"ProId = '{$item['ProId']}'");
								?>
                                <tr align="center" bgcolor="#ffffff">
                                    <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;" height="28"><?=$i++?></td>
                                    <?php /*?><td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;">续课</td><?php */?>
                                    <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;"><?=$pro_ext['S_1']?></td>
                                    <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;"><?=$Category[$item['CateId']]['Category']?></td>
                                    <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;"><?=$db->get_sum('product_wholesale_class',"ProId = '{$item['ProId']}'",'Issue_L')?></td>
                                    <td style="border-bottom:1px solid #ddd;" nowrap="nowrap"><a href="" style="margin-left:10px;" onclick="return c_del(this);">修改</a>&nbsp;</td>
                                </tr>
                                <?php }?>
                                </tbody>
                   </table>
            <?php }else{?>
            	<div class="no_issue">亲,你还没有发布一次课程.</div>
            <?php }?>
		</div>
</div>