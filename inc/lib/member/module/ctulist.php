<?php
$where_tearch="OrderId = '{$_GET['OId']}'";
if($member_info['IsTeacher']){
	$where_tearch.=" and TeacherId = '{$member_info['MemberId']}'";
    if($proId)
        $where_tearch.=" and TeacherId = '{$member_info['MemberId']}' and ProId = '{$proId}'";
}else{
	$where_tearch.=" and MemberId = '{$member_info['MemberId']}'";
    if($proId)
        $where_tearch.=" and MemberId = '{$member_info['MemberId']}' and ProId = '{$proId}'";
}
$class_row=$db->get_limit('order_twos_product_list', $where_tearch, '*', $sort_by[$Order].'Class_num asc');
$stdent_name=$db->get_value('member',"MemberId = '{$class_row[0]['MemberId']}'",'Username');
?>
<div id="lib_member_orders">
<table width="100%" border="0" cellpadding="0" c cellspacing="0" class="item_list">
    <tr class="tb_title">
        <td width="9%" nowrap>第几节数</td>
        <td width="10%" nowrap><?=$member_info['IsTeacher']?'学生':'老师'?></td>
        <td width="16%" nowrap>开课时间</td>
        <td width="9%" nowrap>状态</td>
        <?php  if(count($class_row)){?> <td width="18%" nowrap>操作</td><?php }?>
    </tr>
    <?php
    for($i=0; $i<count($class_row); $i++){
    ?>
    <tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
        <td nowrap>
            <a href="<?=$member_url;?>?module=ctuplan&OId=<?=$class_row[$i]['OrderId'];?>&act=detail&opt=none&curClass=<?=$class_row[$i]['Class_num']?>">课时<?=$class_row[$i]['Class_num'];?></a>
        </td>
        <td nowrap>
        <?php if($member_info['IsTeacher']==1){?>
            <?=$stdent_name?>
        <?php }else{?>
            <a href="/products-detail.php?ProId=<?=$class_row[$i]['ProId']?>" class="detail_link">
            <?=$class_row[$i]['Name'];?></a>
        <?php }?>
        </td>
        <td>
            <?=empty($class_row[$i]['PerTime']) ? '未填写' : $class_row[$i]['PerTime']." ".$class_row[$i]['StartTime']."-".$class_row[$i]['EndTime']?>
        </td>
        <td>
        <?php if($member_info['IsTeacher']==1){
            if($class_row[$i]['Smakesure'] == 1){
                echo "已上课(待学生确认)";
            }else if($class_row[$i]['Smakesure'] == 2){
                echo "已上课";
            }else{
                echo "未上课";
            }
         }else{
            if($class_row[$i]['Smakesure'] == 2){
                echo "已上课";
            }else{
                echo "未上课";
            }
        }?>
        </td>
        <?php if($member_info['IsTeacher']==1){?>
        	<td nowrap align="center">
                <?php if($class_row[$i]['Smakesure_0']==0 && $class_row[$i]['Tmakesure_0']==0){?>
                    <a href="<?=$member_url;?>?module=ctuplan&OId=<?=$class_row[$i]['OrderId'];?>&act=detail&opt=edit&curClass=<?=$class_row[$i]['Class_num']?>" class="qa_btn">课程规划</a>
                <?php }else if($class_row[$i]['Tmakesure_0']==1 && empty($class_row[$i]['Smakesure'])){?>
                    <a href="/ajax/makesure_two.php?act=ctuOrder_T&OId=<?=$class_row[$i]['OrderId'];?>&class_num=<?=$class_row[$i]['Class_num'];?>" class="qa_btn">已经上课</a>
                <?php }else if($class_row[$i]['Smakesure'] == 1 || $class_row[$i]['Smakesure'] == 2){
                    echo '<font class="fc_red">已确定</font>';
                }?>
            </td>
        <?php }else{?>
            <td nowrap align="center">
				<?php if($class_row[$i]['Tmakesure_0']==0){?>
                    <span style="color:#5BC648">等待老师课程规划</span>
                <?php }else if($class_row[$i]['Tmakesure_0']==1 && $class_row[$i]['Smakesure'] != 2){?>
                    <a href="/ajax/makesure_two.php?act=ctuOrder_S&OId=<?=$class_row[$i]['OrderId'];?>&class_num=<?=$class_row[$i]['Class_num'];?>" class="qa_btn">已经上课</a>
                <?php }else if($class_row[$i]['Smakesure'] == 2){
                    echo '<font class="fc_red">已确定</font>';
                }?>
            </td>
      	<?php }?>
    </tr>
    <?php }?>
     <?php if(!count($class_row)){?>
    <tr>
        <td align="center" height="150" colspan="8" bgcolor="#ffffff">暂无订单</td>
    </tr>
    <?php }?>
</table>
</div>