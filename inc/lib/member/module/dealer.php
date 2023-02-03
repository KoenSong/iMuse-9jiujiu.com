<?php
$cur='商家账户';
$turn_page_query_string=$website_url_type==0?"?$query_string&page=":'page-';
$page_count=10;
$row_count=$db->get_row_count('product', 'memberId = '.$member_info['MemberId']);
$total_pages=ceil($row_count/$page_count);
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*$page_count;
$products=$db->get_limit('product', 'memberId = '.$member_info['MemberId'], '*', $order=1, $start_row, $page_count);

?>
<div id="lib_member_orders">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>

    <table width="100%" border="0" cellpadding="0" c cellspacing="0" class="item_list">
	<tbody>
	<tr class="tb_title">
		<td>序号</td>
		<td>老师账号</td>
		<td>老师ProId</td>
		<td>头像</td>
		<td>教学科目</td>
		<td>操作</td>
	</tr>
	<?php 
	for($idx = 0; $idx < count($products); $idx++){
		$CateId = $products[$idx]['CateId'];
		$CateName = $db->get_value('product_category', 'CateId = '.$CateId, 'Category', $order=1);
		$ordersCount = $db->get_row_count('orders', ' ProId = '.$products[$idx]['ProId']);
		$orderTowsCount = $db->get_row_count('order_twos', ' ProId = '.$products[$idx]['ProId']);
	?>
	<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
		<td><?=($idx + 1) ?></td>
		<td><a href="/account.php?module=issue_mod&ProId=<?=$products[$idx]['ProId'] ?>"><?=$products[$idx]['Name'] ?></a></td>
		<td><?=$products[$idx]['ProId'] ?></td>
		<td><img style="width:25px;height: 25px;" src="<?=$products[$idx]['PicPath_0'] ?>" /></td>
		<td><?=$CateName ?></td>
		<td>
			<span style="margin-right: 15px;"><a href="/account.php?module=orders&amp;act=prelist&proId=<?=$products[$idx]['ProId'] ?>">约课查看(<span style="color:red;font-weight: bold;"><?=$ordersCount?></span>)</a></span>
			<span><a href="/account.php?module=orders&amp;act=list&proId=<?=$products[$idx]['ProId'] ?>">续课查看(<span style="color:red;font-weight: bold;"><?=$orderTowsCount?></span>)</a></span>
		</td>
	</tr>
	<?php }?> 
	</tbody>
</table>
<form action="/account.php?module=dealer&act=list" method="get">
    <div id="turn_page" class="relative"><?=turn_page_ext($page, $total_pages, 'account.php?module=dealer&page=', $row_count,'&nbsp;上一页', '下一页&nbsp;&nbsp;', 'account.php?module=dealer&');?>
    <?php if($total_pages>=1){ ?>
        <span>跳转:&nbsp;</span>
        <input type="text" class="input_type2" name="page" value="" />
        <input type="image" class="search_sub" src="/images/member_page.jpg" />
    <?php } ?>
    </div>
</form>    
</div>


