<?php
$query_string=query_string('page');

if($_GET['act']=='remove'){
	$ProId=(int)$_GET['ProId'];
	$db->delete('wish_lists', "$where and ProId='$ProId'");
	js_location("$member_url_cn?".query_string(array('act', 'ProId')));
}

if($_GET['act']=='add' || $_POST['act']=='add'){
	$ProId=(int)$_GET['ProId'];
	!$ProId && $ProId=(int)$_POST['ProId'];

	if($db->get_row_count('product', "ProId='$ProId'") && !$db->get_row_count('wish_lists', "$where and ProId='$ProId'")){
		$db->insert('wish_lists', array(
				'MemberId'	=>	(int)$_SESSION['member_MemberId'],
				'ProId'		=>	$ProId,
				'WishTime'	=>	$service_time,
			)
		);
	}
	js_location("$member_url_cn?module=wishlists");
}

$where="ProId in(select ProId from wish_lists where $where)";
$page_count=20;
$row_count=$db->get_row_count('product', $where);
$total_pages=ceil($row_count/$page_count);
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*$page_count;
$list_row=$db->get_limit('product', $where, '*', 'ProId desc', $start_row, $page_count);
?>
<div id="lib_member_wishlists">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur">关注的课程</span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="item_list">
		<tr class="tb_title">
			<td width="15%">图片</td>
            <td width="10%">科目</td>
			<td width="45%">老师信息</td>
			<td width="15%">详情</td>
			<td width="15%" class="last">移除</td>
		</tr>
		<?php
		for($i=0; $i<count($list_row); $i++){
			$url=get_url('product', $list_row[$i]);
		?>
        <style type="text/css">
        .proname{font-size:12px !important;}
        </style>
		<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
			<td valign="top"><table width="94" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="94" align="center" class="item_img"><a href="<?=$url;?>" target="_blank"><img src="<?=str_replace('s_','105X105_',$list_row[$i]['PicPath_0']);?>" /></a></td></tr></table></td>
            <td align="center"><?=$Category[$list_row[$i]['CateId']]['Category'];?></td>
			<td align="center">
				<a href="<?=$url;?>" target="_blank" class="proname"><?=$list_row[$i]['Name'];?></a><br /><br />
			</td>
			<td><a href="<?=$url;?>" target="_blank" class="proname">查看</a></td>
			<td><a href="<?=$member_url_cn.'?'.query_string();?>&act=remove&ProId=<?=$list_row[$i]['ProId'];?>" class="proname">移除</a></td>
		</tr>
		<?php }?>
		<?php if(!count($list_row)){?>
		<tr class="item_list">
			<td align="center" height="150" colspan="4" bgcolor="#ffffff" style="font-size:12px;">没有关注的老师！</td>
		</tr>
		<?php }?>
	</table>
	<div id="turn_page"><?=turn_page_ext($page, $total_pages, $turn_page_query_string, $row_count,'&nbsp;上一页', '下一页&nbsp;&nbsp;', $website_url_type);?></div>