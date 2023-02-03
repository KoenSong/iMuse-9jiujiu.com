<?php
/*
Powered by ly200.com		http://www.ly200.com
广州联雅网络科技有限公司		020-83226791
*/

$website_url_type=0;	//链接地址类型，0：动态，1：静态，2：伪静态，当值为0时请设置$website_url_ary变量
$website_url_ary=array(
	'article_group_0'	=>	'return sprintf("/article.php?AId=%s", $row["AId"]);',	//信息页分组一
	'article_group_1'	=>	'return sprintf("/article.php?AId=%s", $row["AId"]);',	//信息页分组二
	'article_group_2'	=>	'return sprintf("/article.php?AId=%s", $row["AId"]);',	//信息页分组三
	'article_group_3'	=>	'return sprintf("/article.php?AId=%s", $row["AId"]);',	//信息页分组四
	'article_group_4'	=>	'return sprintf("/article.php?AId=%s", $row["AId"]);',	//信息页分组五
	
	'info'				=>	'return sprintf("/info-detail.php?InfoId=%s", $row["InfoId"]);',	//文章详细页
	'info_category'		=>	'return sprintf("/info.php?CateId=%s", $row["CateId"]);',	//文章分类列表页
	
	'instance'			=>	'return sprintf("/instance-detail.php?CaseId=%s", $row["CaseId"]);',	//成功案例详细页
	'instance_category'	=>	'return sprintf("/instance.php?CateId=%s", $row["CateId"]);',	//成功案例分类列表页
	
	'product'			=>	'return sprintf("/products-detail.php?ProId=%s", $row["ProId"]);',	//产品详细页
	'product_category'	=>	'return sprintf("/products.php?CateId=%s", $row["CateId"]);',	//产品分类列表页
	'product_brand'		=>	'return sprintf("/brand.php?BId=%s", $row["BId"]);',	//产品品牌列表页
);

$LockChinaIp=0;	//是否屏蔽国内IP
($LockChinaIp==1 && (int)$_SESSION['ly200_AdminUserId']==0 && $_SERVER['PHP_SELF']!='/404.php' && substr_count($_SERVER['PHP_SELF'], '/manage/')==0 && (preg_match('/zh-c/i', substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4)) || preg_match('/zh/i', substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4)))) && exit('<script language="javascript">window.top.location="/404.php";</script>');


$mCfg['ExchangeRate']['RMB']['Invocation']==1 && $_SESSION['Currency']='RMB';


$member_url_cn='/account.php';
$cart_url_cn='/cart.php';
$order_status_ary=array(1=>'待成交',2=>'已付款',3=>'已成交');
$student_ary=array(0=>'请选择年级排名',1=>'年级靠前',2=>'年级中等偏上',3=>'年级中等',4=>'年级中等偏下',5=>'年级靠后');
$student2_ary=array(0=>'请选择班级排名',1=>'班级靠前',2=>'班级中等偏上',3=>'班级中等',4=>'班级中等偏下',5=>'班级靠后');
//银行类型
//$bank_ary = array(
//	array(0=>'工商银行',1=>'/images/bank_icbc.gif'),
//	array(0=>'农业银行',1=>'/images/bank_abc.gif'),
//	array(0=>'建设银行',1=>'/images/bank_ccb.gif'),
//);
//充值记录状态
$recharge_record_ary = array(
	0 => '待充值',
	1 => '充值成功',
	2 => '充值失败',
);

//withdraw提现状态
$withdraw_ary = array(
	0 => '待审批',
	1 => '已审批',
);


function turn_page_ext($page, $total_pages, $query_string, $row_count, $pre_page='<<', $next_page='>>', $html=0, $base_page=3){	//翻页
	if(!$row_count){
		return '';
	}
	
	if($html==1){
		$query_string='page-';
		$html_ext='.html';	//静态链接的后辍
	} 
	
	$i_start=$page-$base_page>0?$page-$base_page:1;
	$i_end=$page+$base_page>=$total_pages?$total_pages:$page+$base_page;
	
	($total_pages-$page)<$base_page && $i_start=$i_start-($base_page-($total_pages-$page));
	$page<=$base_page && $i_end=$i_end+($base_page-$page+1);
	
	$i_start<1 && $i_start=1;
	$i_end>=$total_pages && $i_end=$total_pages;
	
	$turn_page_str='';
	
	$pre=$page-1>0?$page-1:1;
	$turn_page_str.="<a href='$query_string$pre$html_ext' class='page_button'>$pre_page</a>&nbsp;";
	
	for($i=$i_start; $i<=$i_end; $i++){
		$turn_page_str.=$page!=$i?"<a href='{$query_string}{$i}{$html_ext}' class='page_item'>$i</a>&nbsp;":"<font class='page_item_current'>$i</font>&nbsp;";
	}
	
	$i_end<$total_pages && $turn_page_str.="<font class='page_item'>...</font>&nbsp;<a href='{$query_string}{$total_pages}{$html_ext}' class='page_item'>$total_pages</a>";
	
	$next=$page+1>$total_pages?$total_pages:$page+1;
	$page>=$total_pages && $page--;
	$turn_page_str.="<a href='$query_string$next$html_ext' class='page_button second'>$next_page</a>";
	return $turn_page_str;
}
?>