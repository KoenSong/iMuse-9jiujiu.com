<style>
.address_info{font-size:12px !important;}
.address_info strong{font-size:12px !important;}
.search_sub:hover{cursor:pointer;}
.detail_card * {
    font-size: 14px;
}
.member_search .tab {
    //width: 778px;
    height: 25px;
    background: url(/images/tab_lan1.png) repeat-x 0px -25px;
    margin: 5px 0px;
}

.member_search .tab a.act {
    width: 88px;
    height: 25px;
    line-height: 25px;
    text-align: center;
    background: url(/images/tab_lan1.png) no-repeat 0px 0px;
    margin-right: 3px;
    display: inline;
    color: #ff6600;
    font-weight: bold;
    float: left;
}

.member_search .tab a {
    width: 88px;
    height: 25px;
    line-height: 25px;
    text-align: center;
    background: url(/images/tab_lan1.png) no-repeat -92px 0px;
    margin-right: 3px;
    display: inline;
    color: #565656;
    float: left;
}

.input-msg-inline{
    display: inline-block;
    position:relative;
    top:-10px;
    height:30px;
    margin-bottom: -30px;
}
.fix{width:80px;padding-left: 10px;}
.finalPrice_info{font-size: 16px;}
.finlPrice{font-size: 16px;}
</style>

<?php
$query_string=query_string(array('page', 'do'));
//商家账户
$proId = $_GET['proId'];
$turn_page_query_string=$website_url_type==0?"?$query_string&page=":'page-';
$page_count=10;
$total_pages=0;
//老师确定后,48小时候后约课确定
if($count=$db->get_row_count('orders',"Tmakesure_1 = '1' and TeacherId = '{$member_info['MemberId']}' and Smakesure_0 = '0' and Tmakesure_Time+48*60*60<$service_time")){
		//var_dump($count);
		$Order_48hours=$db->get_all('orders',"Tmakesure_1 = '1' and TeacherId = '{$member_info['MemberId']}' and Smakesure_0 = '0' and Tmakesure_Time+48*60*60<$service_time");
		//var_dump($Order_48hours);
		foreach((array)$Order_48hours as $item){
			
			$db->update('orders',"OId = '{$item['OId']}'", array(
				'Smakesure_0'	=>	1,
				'OrderStatus'	=>	3,
			));
			
			$TeacherId= $item['TeacherId'];
			$Price = $item['TotalPrice'];
			$Account_Price=$db->get_value('member',"MemberId = '$TeacherId'",'Account_Price');
			$db->update('member',"MemberId = '$TeacherId'",array('Account_Price'=>(float)$Account_Price+(float)$Price));	
		}	
}
//老师确定后，48小时候后续课确定
$OrderClass_48hours = $db->get_all('order_twos_product_list',"MemberId = '$TeacherId' and Smakesure = 1 and finish_time >= ($service_time - 48*60*60)");
foreach((array)$OrderClass_48hours as $item){
    $OrderId = $item['OrderId'];
    //完结子续课订单
    $db->update('order_twos_product_list', "LId = '{$item['LId']}'", array(
                'Smakesure'         =>  2,
                'finish_time'       =>  $service_time 
            ));
    //完结续课订单
    $FinishQty = $db->get_row_count('order_twos_product_list', "OrderId = '$OrderId' and Smakesure = 2");
    $FinishOrder_row = $db->get_one('order_twos',"OrderId = $OrderId");
    if($FinishQty == $FinishOrder_row['qty']){
        //续课小节全部完结，更新续课总订单
        $db->update('order_twos',"OrderId = '$OrderId'", array(
            'OrderStatus'   =>  3,
        ));
    }
}

if($_POST['data']=='member_cancel_orders'){
	$OId=$_GET['OId'];
	$CancelReason=$_POST['CancelReason'];
	$db->update('orders', "$where and OId='$OId' and OrderStatus in(1, 3)", array(
			'OrderStatus'	=>	7,
			'CancelReason'	=>	$CancelReason
		)
	);
	
	$order_row=$db->get_one('orders', "OId='$OId'");
	include($site_root_path.'/inc/lib/mail/order_cancel.php');
	include($site_root_path.'/inc/lib/mail/template.php');
	sendmail($order_row['Email'], $order_row['FirstName'].' '.$order_row['LastName'], "Your order#{$order_row['OId']} successfully Cancelled", $mail_contents);
	
	js_location("$member_url_cn?module=orders&OId=$OId&act=detail");
}

$act=$_GET['act'];
$Type=(int)$_POST['type'];
//$CateId=(int)$_GET['CateId'];
//$Other=(int)$_POST['Other'];
//$CateId && $where.=' and '.get_search_where_by_CateId($CateId, 'product_category');

/*$row_count=$db->get_row_count('orders', $where);
$total_pages=ceil($row_count/$page_count);
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*$page_count;
$order_row=$db->get_limit('orders', $where, '*', 'OrderId desc', $start_row, $page_count);*/

$other_par=$order_status_ary;
$order_par=array(1=>'时间从高到低',2=>'时间从等到高');
$sort_by=array(1=>'OrderTime desc,',2=>'OrderTime asc,');
$cur='课程管理系统';
?>
<link href="/css/calendar.css" rel="stylesheet" type="text/css" />
<div id="lib_member_orders">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
    <?php
	if($act=='list'){
		if($member_info['IsTeacher']){
			$where_tearch="TeacherId = '{$member_info['MemberId']}'";
            if($proId)
                $where_tearch="TeacherId = '{$member_info['MemberId']}' and ProId = '{$proId}'";
		}else{
			$where_tearch="MemberId = '{$member_info['MemberId']}'";
            if($proId)
                $where_tearch="MemberId = '{$member_info['MemberId']}' and ProId = '{$proId}'";
		}
		$page_count=10;
		
		//$K_Name=$_POST['K_Name'];
		//$K_Name && $where_tearch.=" and (OId like '%$K_Name%')";
		
		$Other=$_POST['Par']?$_POST['Par']:$_GET['Par'];
		
		$Other && $status=(int)$Other;
		//$Order=$_POST['Order']?(int)$_POST['Order']:(int)$_GET['Order'];		
		
		$status && $where_tearch.=" and OrderStatus='$status'";
		$row_count=$db->get_row_count('order_twos', $where_tearch);
		$total_pages=ceil($row_count/$page_count);
		$page=(int)$_GET['page'];
		$page<1 && $page=1;
		$page>$total_pages && $page=1;
		$start_row=($page-1)*$page_count;
		//echo $where_tearch;
		$order_row=$db->get_limit('order_twos', $where_tearch, '*', $sort_by[$Order].'OrderId desc', $start_row, $page_count);
	?>
    <div class="member_search">
        <div class="blank15"></div>
        <!-- <div class="cate_nav">
            <a class="<?=$Other==1?'cur':''?>" href="/account.php?module=orders&act=list&Par=1">待成交</a>
            <a class="<?=$Other==2?'cur':''?>" href="/account.php?module=orders&act=list&Par=2">上课中</a>
            <a class="<?=$Other==3?'cur':''?>" href="/account.php?module=orders&act=list&Par=3">已完成</a>
        </div> -->
        <div class="tab">
            <a class="<?=$Other==''?'act':''?>" href="/account.php?module=orders&act=list">全部</a>
            <a class="<?=$Other==1?'act':''?>" href="/account.php?module=orders&act=list&Par=1">待付款</a>
            <a class="<?=$Other==2?'act':''?>" href="/account.php?module=orders&act=list&Par=2">待上课</a>
            <a class="<?=$Other==3?'act':''?>" href="/account.php?module=orders&act=list&Par=3">完结课程</a>
        </div>
   	</div>
    <!-- <div class="blank8"></div> -->
    <table width="100%" border="0" cellpadding="0" c cellspacing="0" class="item_list">
        <tr class="tb_title">
            <td width="16%" nowrap>订单号</td>
			<td width="9%">科目</td>
			<td width="10%"><?=$member_info['IsTeacher']?'学生':'老师'?></td>
            <td width="7%" nowrap>课时费</td>
            <td width="9%" nowrap>状态</td>
            <?php /*if(($status==0 || $status==1 || $status==3) && */ if(count($order_row)){?> <td width="18%" nowrap>操作</td><?php }?>
        </tr>
        <?php
        for($i=0; $i<count($order_row); $i++){
			$status=$order_row[$i]['OrderStatus'];
			$Compelet='';
			$Classnum='';
			$Compelet=$db->get_row_count('order_twos_product_list',"OrderId = '{$order_row[$i]['OrderId']}' and Smakesure =2");
			$Classnum=$db->get_row_count('order_twos_product_list',"OrderId = '{$order_row[$i]['OrderId']}'");
			$Classnum && $compelet_rate=$Compelet/$Classnum*100;
			
        ?>
        <tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
            <td nowrap><a href="<?=$member_url;?>?module=order_twos&OId=<?=$order_row[$i]['OId'];?>&act=detail&opt=none" class="detail_link"><?=$order_row[$i]['OId'];?></a></td>
			<td nowrap><?=$Category[$order_row[$i]['CateId']]['Category'];?></td>
			<td nowrap><?=$member_info['IsTeacher']?$order_row[$i]['Shipping_Name']:$order_row[$i]['ProName']?></td>
            <td nowrap><?=iconv_price((1-$order_row[$i]['Discount'])*$order_row[$i]['TotalPrice']);?></td>
            <td nowrap><?=$order_status_ary[$status];?></td>
            <?php if($member_info['IsTeacher']==1){?>
            
            	<td nowrap align="center">
                <?php if($status==1){?>
                <?php if($order_row[$i]['Tmakesure_0']==1){?>
                <!--<form action="/ajax/makesure_three.php" style="position:relative;" method="get">
						<script type="text/javascript" src="/js/date.js"></script>
                         时间：<input type="text" name="PerTime" id="from_date" onclick="SelectDate(this);" contenteditable="false" check="期望试听时间必须填写!~*"  class="input1 on_date runcode" value="<?=$order_row[$i]['PerTime'];?>"  placeholder="请选择日期" style="padding:0px 0 0 5px; width:80px;text-align:left;color:#999;line-height:16px;">
                        <input type="hidden" name="TotalPrice"  value="<?=$order_row[$i]['TotalPrice'];?>" />
                        <input type="hidden" name="act" value="Tmakesure_0"  />
                        <input type="hidden" name="OId" value="<?=$order_row[$i]['OId'];?>"  />
                        <input type="submit" class="qa_btn" id="date_hand"  value="确定约课" />
                 </form>-->
				待付款
				<?php }?>
               <?php }elseif($status==2){?>
                    <!--<a href="/account.php?module=orders&act=classlist&OId=<?=$order_row[$i]['OrderId']?>" class="qa_btn">课程进度</a>
                    (已完成&nbsp;&nbsp;<?php //echo (int)$compelet_rate;?><?=$Compelet.'/'.$Classnum?>)-->
                    <?php if($order_row[$i]['Tmakesure_1']==0){?>
                    <!-- <a href="/account.php?module=orders&act=classlist&OId=<?=$order_row[$i]['OrderId']?>" class="qa_btn">课程进度</a> -->
                    <a href="/account.php?module=ctulist&OId=<?=$order_row[$i]['OrderId']?>" class="qa_btn">课程进度</a>
                    (已完成&nbsp;&nbsp;<?php //echo (int)$compelet_rate;?><?=$Compelet.'/'.$Classnum?>)                    
                    <?php }else if($order_row[$i]['Tmakesure_1']==1){
                        
                    } else if($order_row[$i]['Tmakesure_1']==2){?>
                    <a href="<?=$member_url;?>?module=order_twos&OId=<?=$order_row[$i]['OId'];?>&act=detail&opt=edit" class="qa_btn">确定续课</a>
                     <?php }?>
                </td>
               <?php }elseif($status==3){?>
                    <a href="/account.php?module=ctulist&OId=<?=$order_row[$i]['OrderId']?>" class="qa_btn">课程进度</a>
                    (已完成&nbsp;&nbsp;<?php //echo (int)$compelet_rate;?><?=$Compelet.'/'.$Classnum?>)
               	<?php }?>
                </td>
                
            <?php }else{?>
            
                <td nowrap align="center">
                 <?php if($status==1){?>
                    <?php if($order_row[$i]['Tmakesure_0']==1){?><a href="<?=$cart_url_cn;?>?module=payment_two&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">付款</a><?php }else{?>老师未确定 &nbsp;&nbsp;<a href="/ajax/order_del.php?OId=<?=$order_row[$i]['OId'];?>&act=remove">删除</a><?php }?>
                <?php }elseif($status==2){?>
                    <?php if($order_row[$i]['Tmakesure_1']==2){?>
                        <span style="color:#5BC648">等待老师课程规划</span>
                    <?php } else if($order_row[$i]['Tmakesure_1']==0){?>
                        <a href="/account.php?module=ctulist&OId=<?=$order_row[$i]['OrderId']?>" class="qa_btn">课程进度</a>
                        (已完成&nbsp;&nbsp;<?php //echo (int)$compelet_rate;?><?=$Compelet.'/'.$Classnum?>)
                    <?php } ?>
                <?php }elseif($status==3){?>
                		<a href="/account.php?module=review&type=2&OId=<?=$order_row[$i]['OId']?>" class="qa_btn">评价</a>
                        <a href="/account.php?module=ctulist&OId=<?=$order_row[$i]['OrderId']?>" class="qa_btn">课程进度</a>
                        (已完成&nbsp;&nbsp;<?php //echo (int)$compelet_rate;?><?=$Compelet.'/'.$Classnum?>)
                <?php }?>
                </td>
          	<?php }?>
        </tr>
        <?php }?>
        <?php if(!count($order_row)){?>
        <tr>
            <td align="center" height="150" colspan="8" bgcolor="#ffffff">暂无订单</td>
        </tr>
        <?php }?>
    </table>
	<div class="blank15"></div>
	<form action="/account.php?module=orders&act=list" method="get">
                <div id="turn_page" class="relative"><?=turn_page_ext($page, $total_pages, $turn_page_query_string, $row_count,'&nbsp;&nbsp;上一页', '下一页&nbsp;&nbsp;', $website_url_type);?>
                <?php if($total_pages>=1){ ?>
                    <span>跳转:&nbsp;</span>
                    <input type="text" class="input_type2" name="page" value="" />
                    <!-- <input type="image" class="search_sub" src="/images/member_page.jpg" /> -->
                    <img src="/images/member_page.jpg" class="search_sub" /> 
                <?php } ?>
                </div>
    </form>
    <?php }elseif($act=='classlist'){?>

    	
    <?php }elseif($act=='prelist'){
		if($member_info['IsTeacher']){
			$where_tearch="TeacherId = '{$member_info['MemberId']}'";
            if($proId)
                $where_tearch="TeacherId = '{$member_info['MemberId']}' and ProId = '{$proId}'";
        }else{
			$where_tearch="MemberId = '{$member_info['MemberId']}'";
            if($proId)
                $where_tearch="MemberId = '{$member_info['MemberId']}' and ProId = '{$proId}'";
		}
     	$page_count=10;
		
		$Other=$_POST['Par']?$_POST['Par']:$_GET['Par'];
		
		$Other && $status=(int)$Other;
		
		$status && $where_tearch.=" and OrderStatus='$status'";
		$row_count=$db->get_row_count('orders', $where_tearch);
		$total_pages=ceil($row_count/$page_count);
		$page=(int)$_GET['page'];
		$page<1 && $page=1;
		$page>$total_pages && $page=1;
		$start_row=($page-1)*$page_count;
		
		$order_row=$db->get_limit('orders', $where_tearch, '*', $sort_by[$Order].'OrderId desc', $start_row, $page_count);
	?>
    <div class="member_search">
        <div class="blank15"></div>
        <div class="tab">
            <a class="<?=$Other==''?'act':''?>" href="/account.php?module=orders&act=prelist">全部</a>
            <a class="<?=$Other==1?'act':''?>" href="/account.php?module=orders&act=prelist&Par=1">待付款</a>
            <a class="<?=$Other==2?'act':''?>" href="/account.php?module=orders&act=prelist&Par=2">待上课</a>
            <a class="<?=$Other==3?'act':''?>" href="/account.php?module=orders&act=prelist&Par=3">完结课程</a>
        </div>
   	</div>
    <!-- <div class="blank8"></div> -->
    <table width="100%" border="0" cellpadding="0" c cellspacing="0" class="item_list">
        <tr class="tb_title">
            <td width="16%" nowrap>订单号</td>
			<td width="9%">科目</td>
			<td width="10%"><?=$member_info['IsTeacher']?'学生':'老师'?></td>
            <td width="7%" nowrap>课时费</td>
            <td width="9%" nowrap>状态</td>
            <?php /*if(($status==0 || $status==1 || $status==3) && */ if(count($order_row)){?> <td width="41%" nowrap>操作&nbsp;&nbsp;<?=$member_info['IsTeacher']?"<span style='color:red;'>收到信息后请尽快和学生联系</span>":"<span style='color: #fb3601;font-size: 12px;'>付款成功后老师会与您联系</span>"?></td><?php }?>
        </tr>
        <?php
        for($i=0; $i<count($order_row); $i++){
			$status=$order_row[$i]['OrderStatus'];
        ?>
        <tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
            <td nowrap><a href="<?=$member_url;?>?module=orders&OId=<?=$order_row[$i]['OId'];?>&act=detail&opt=none" class="detail_link"><?=$order_row[$i]['OId'];?></a></td>
			<td nowrap><?=$Category[$order_row[$i]['CateId']]['Category'];?></td>
			<td nowrap><?=$member_info['IsTeacher']?$order_row[$i]['Shipping_Name']:$order_row[$i]['ProName']?></td>
            <td nowrap><?=iconv_price((1-$order_row[$i]['Discount'])*$order_row[$i]['TotalPrice']);?></td>
            <td nowrap><?=$order_status_ary[$status];?></td>
            <?php if($member_info['IsTeacher']==1){?>
            
            	<td nowrap align="center">
            	<?php if($status==1){?>
                    <?php if($order_row[$i]['Tmakesure_0']==1){?>
                         待付款
                    <?php }?>
                <?php }elseif($status==2){?>
					<?php if($order_row[$i]['Tmakesure_1']==0){?>
                    <a href="/ajax/makesure.php?act=Tmakesure_1&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">已经上课</a>&nbsp;&nbsp;
                    <a href="<?=$member_url;?>?module=orders&OId=<?=$order_row[$i]['OId'];?>&act=detail&opt=editProject" class="qa_btn">课程规划</a> 
                    <?php }else if($order_row[$i]['Tmakesure_1']==1){
                        echo '<font class="fc_red">已上课确定</font>';
                    } else if($order_row[$i]['Tmakesure_1']==2){?>
                        <a href="<?=$member_url;?>?module=orders&OId=<?=$order_row[$i]['OId'];?>&act=detail&opt=edit" class="qa_btn">确定约课</a>
                     <?php }?>
                </td>
                <?php }elseif($status==3){?>
                    <!-- 
                     <a href="<?=$member_url;?>?module=orders&OId=<?=$order_row[$i]['OId'];?>&act=detail&opt=editProject" class="qa_btn">课程规划</a> 
                     -->
                    <form action="/account.php?module=ctuorder" method="post">
                        <div class="row">
                            <input type="hidden" name="act" value="ContinueClass" />
                            <input type="hidden" name="OId" value="<?=$order_row[$i]['OId'];?>" />
                            <!-- <a href="<?=$member_url;?>?module=orders&OId=<?=$order_row[$i]['OId'];?>&act=detail&opt=editProject" class="qa_btn">课程规划</a>  -->
                            <!--老师发起续课-->
                            &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="qa_btn" name="submit" value="发起续课" />                                         
                         </div>
                    </form>
				<?php }?>
                </td>
            <?php }else{?>
            
                <td nowrap align="center">
                 <?php if($status==1){?>
                    <?php if($order_row[$i]['Tmakesure_0']==1){?><a href="<?=$cart_url_cn;?>?module=payment&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">付款</a><?php }else{?>老师未确定<?php }?>
                <?php }elseif($status==2){?>
                        <?php if($order_row[$i]['Tmakesure_1']==2){?>
                            <span style="color:#5BC648">等待老师课程规划</span>
                        <?php } else if($order_row[$i]['Tmakesure_1']==0){?>
                            <a href="/ajax/makesure.php?act=Smakesure_0&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">已经上课</a> 
                        <?php } else if($order_row[$i]['Tmakesure_1']==1){//老师已经确定上课，等待学生确认?>
                            <a href="/ajax/makesure.php?act=Smakesure_0&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">已经上课</a>
                            <!--编辑当前课程规划-->
                            &nbsp;&nbsp;<a href="<?=$member_url;?>?module=orders&OId=<?=$order_row[$i]['OId'];?>&act=detail&opt=none" class="qa_btn">课程规划</a>
                        <?php } ?>
                <?php }elseif($status==3){?>
                        <div>
                            <!-- <form action="/ajax/makesure.php" method="post"> -->
                            <form action="/account.php?module=ctuorder" method="post">
                                <div class="row">
                                	<!-- <input type="text" name="Qty" class="form" style=" text-align:center;width:30px; outline:0px; border:1px solid #ccc;" value="1" />&nbsp;&nbsp;节 -->
                                    	<input type="hidden" name="act" value="ContinueClass" />
                                        <input type="hidden" name="OId" value="<?=$order_row[$i]['OId'];?>" />
                                        <!--学生发起续课-->
                                        &nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" class="qa_btn" name="submit" value="续课" /> 										
                                        &nbsp;&nbsp;<a href="/account.php?module=review&type=1&OId=<?=$order_row[$i]['OId']?>" class="qa_btn">评价</a> 
                                 </div>
                            </form>
                        </div>
                <?php }?>
                </td>
          	<?php }?>
        </tr>
        <?php }?>
        <?php if(!count($order_row)){?>
        <tr>
            <td align="center" height="150" colspan="8" bgcolor="#ffffff">
				<?php if(!$member_ident['Is_ident'] && $member_info['Apply'] && $module=='orders'){ ?>
                    <div class="member_tips">
                        <div name="con" style="display: block;" class="con">
                            <!-- 未完善老师资料的提示 start -->	
                            <div style="" class="complete_own_infor">
                                <h2>请按照以下表格<span>完善资料</span></h2>
                                <p class="tips_zl">你提交的全部资料我们将进行人工审核，在通过审核之前，家长不能在网站上看到你，所以无法向你约课.</p>
                                <?php if(!$member_info['Is_All_0']){?>
                                <div class="nor_approve">
                                    <label class="label_type1" for="">个人信息</label>
                                    <span class="span_type1">尚未上传，请 <a href="/account.php?module=index#contents">立即上传</a></span>
                                    <div class="clear"></div>
                                </div>
                                <?php }?>
                                
                                <?php if(!$member_info['Is_All_1']){?>
                                <div class="nor_approve">
                                    <label class="label_type1" for="">授课信息</label>
                                    <span class="span_type1">尚未上传，请 <a href="/account.php?module=issue_mod#contents">立即上传</a></span>
                                    <div class="clear"></div>
                                </div>
                                <?php }?>
                                
                                 <?php if(!$member_ident['Is_ident']){?>
                                <div class="nor_approve">
                                    <label class="label_type1" for="">资质认证</label>
                                    <span class="span_type1">尚未上传，请 <a href="account.php?module=ident#contents">立即上传</a></span>
                                    <div class="clear"></div>
                                </div>
                                <?php }?>
                            </div>
                            <!-- 未完善老师资料的提示 end -->
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php }else{ ?>
            		暂无订单
                <?php } ?>
            </td>
        </tr>
        <?php }?>
    </table>
	<form action="/account.php?module=orders&act=prelist" method="get">
		<div id="turn_page" class="relative"><?=turn_page_ext($page, $total_pages, $turn_page_query_string, $row_count, '&nbsp;&nbsp;上一页', '下一页&nbsp;&nbsp;', $website_url_type);?>
        <?php if($total_pages>=1){ ?>
			<span>跳转:&nbsp;</span>
			<input type="text" class="input_type2" name="page" value="" />
            <img src="/images/member_page.jpg" class="search_sub" />  
        <?php } ?>
		</div>
     </form>
    <?php }elseif($act=='cancel'){?>
		<div class="lib_member_title"><a href="<?=$member_url_cn;?>?module=orders&act=list">课程订单</a> - 取消订单</div>
		<?php
		$OId=$_GET['OId'];
		$order_row=$db->get_one('orders', "$where and OId='$OId' and OrderStatus in(1, 3)");
		!$order_row && js_location("$member_url_cn?module=orders&act=list");
		?>
		<div class="blank12"></div>
		<div class="lib_member_item_card">
			<form action="<?=$member_url_cn.'?'.$query_string;?>" method="post" name="member_cancel_orders_form" OnSubmit="return checkForm(this);">
				<div class="cancel">
					<div class="info">
						您好 <?=htmlspecialchars($_SESSION['member_FirstName'].' '.$_SESSION['member_LastName']);?>:<br /><br />
						感谢您的订单，请告诉我们您要取消的原因：
					</div>
					<textarea name="CancelReason" class="form_area" check="Sorry, the reason you want to cancel information is required!~*"></textarea>
					<div class="btn"><input name="Submit" type="submit" class="form_button form_button_130" value="取消订单！">&nbsp;&nbsp;&nbsp;<input type="button" name="return" value="<< 返回" onclick="window.history.back(-1);" class="form_button" /></div>
				</div>
				<input type="hidden" name="data" value="member_cancel_orders" />
			</form>
		</div>
	<?php
	}else if($act=='detail'){
		$OId = $_GET['OId'];
        $opt = $_GET['opt'];
		$order_row = $db->get_one('orders', "OId='$OId'");
		!$order_row && js_location("$member_url_cn?module=orders&act=list");
	?>
		<div class="blank12"></div>
		<div class="order_detail">
			<div style="font-size:18px; font-weight:bold;">订单详情</div>
		</div>
		<div class="detail_card">
            <form action="/ajax/order_mod.php" method="post">
            <input type="hidden" name="start_time_hls" id="start_time_hls" value="<?=$order_row['StartTime']?>" check="请选择开始时间!~*"/>
            <input type="hidden" name="end_time_hls" id="end_time_hls" value="<?=$order_row['EndTime']?>" check="请选择开始时间!~*"/>
			<input type="hidden" name="OId" value="<?=$order_row['OId']?>" />
            <input type="hidden" name="act" value="mod_afterclass" />
            <table width="100%" border="0" cellspacing="0" cellpadding="0" class="order_info">
			  <tr>
				<td width="110">订单号:</td>
				<td><?=$order_row['OId'];?></td>
			  </tr>
              <tr>
                <td>下单日期:</td>
                <td><?=date('Y-m-d H:i:s', $order_row['OrderTime']);?></td>
              </tr>
			  <tr>
				<td>订单状态:</td>
				<td><?=$order_status_ary[$order_row['OrderStatus']];?><?php if($order_row['OrderStatus']==5){?><a href="<?=$member_url_cn.'?'.$query_string;?>&do=confirm_receiving" class="confirm_receiving" onClick="if(!confirm('Are you sure?')){return false;}else{return true;};">确认到货</a><?php }?></td>
			  </tr>
			  <tr>
				<td>开课时间:</td>
                <?php if($opt == 'edit'){?>
				<td>
                    <div class="input-msg" style="position:relative;display: inline-block;">
                        <input type="text" name="PerTime" id="from_date" onclick="SelectDate(this);" value="<?=$order_row['PerTime'];?>" contenteditable="false" check="期望试听时间必须填写!~*" class="input1 on_date runcode" placeholder="请选择日期" style="padding:0px 0 0 10px;text-align:left;//color:#999;line-height:28px;font-size: 15px;width: 100px;    border: 1px solid #ccc;">
                        <script type="text/javascript" src="/js/date.js"></script>
                        <div class="clear"></div>
                    </div>
                    <select  id="startSel" class="input-msg-inline fix" onchange="jQuery('#start_time_hls').val(this.value)"><option value="">开始</option><option value="07:00">7:00</option><option value="07:30">7:30</option><option value="08:00">8:00</option><option value="08:30">8:30</option><option value="09:00">9:00</option><option value="09:30">9:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:00">23:30</option><option value="00:00">0:00</option><option value="00:30">0:30</option><option value="01:00">1:00</option><option value="01:30">1:30</option><option value="02:00">2:00</option><option value="02:30">2:30</option><option value="03:00">3:00</option><option value="03:30">3:30</option><option value="04:00">4:00</option><option value="04:30">4:30</option><option value="05:00">5:00</option><option value="05:30">5:30</option><option value="06:00">6:00</option><option value="06:30">6:30</option></select>
                    <span class="input-msg-inline">-</span>                                        
                    <select id="endSel" class="input-msg-inline fix" onchange="jQuery('#end_time_hls').val(this.value)"><option value="">结束</option><option value="07:00">7:00</option><option value="07:30">7:30</option><option value="08:00">8:00</option><option value="08:30">8:30</option><option value="09:00">9:00</option><option value="09:30">9:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:00">23:30</option><option value="00:00">0:00</option><option value="00:30">0:30</option><option value="01:00">1:00</option><option value="01:30">1:30</option><option value="02:00">2:00</option><option value="02:30">2:30</option><option value="03:00">3:00</option><option value="03:30">3:30</option><option value="04:00">4:00</option><option value="04:30">4:30</option><option value="05:00">5:00</option><option value="05:30">5:30</option><option value="06:00">6:00</option><option value="06:30">6:30</option></select>
                </td>
                <?php }else if($opt == 'none' || $opt == 'editProject'){?>
                <input type="hidden" name="PerTime" value="<?=$order_row['PerTime'];?>" />
                <td>
                    <span><?=$order_row['PerTime'];?>&nbsp;&nbsp;</span>
                    <span><?=$order_row['StartTime'];?></span>
                    <span>-</span>                                        
                    <span><?=$order_row['EndTime'];?></span>
                    </td>    
                <?php }?>
			  </tr>
			  <?php if($order_row['Discount']>0){?>
				  <tr>
					<td>折扣:</td>
					<td><?=$order_row['Discount']*100;?>%</td>
				  </tr>
				  <tr>
					<td>Save:</td>
					<td><?=iconv_price($order_row['Discount']*$order_row['TotalPrice']);?></td>
				  </tr>
			  <?php }?>
			  <tr>
				<td>总价:</td>
				<td><?=iconv_price(((1-$order_row['Discount'])*$order_row['TotalPrice']+$order_row['ShippingPrice'])*(1+$order_row['PayAdditionalFee']/100));?></td>
			  </tr>
              <tr>
				<td>类型:</td>
				<td>约课</td>
			  </tr>
              <?php if($member_info['IsTeacher']){?>
              <tr>
              	<td <?=$opt == 'edit' ? "style='border-bottom:none;'" : '' ?> <?=$opt == 'editProject' ? "style='border-bottom:none;'" : '' ?>>课程规划：</td>
				<td <?=$opt == 'edit' ? "style='border-bottom:none;'" : '' ?> <?=$opt == 'editProject' ? "style='border-bottom:none;'" : '' ?>>
                    <textarea name="Comments_two" style=" text-align:left; border:1px solid #ccc;width:500px; height:230px;resize: none;"  <?php if($opt == 'none'){ echo "disabled='disabled'";}?> 
                        onfocus="if(value=='请老师填好课程规划，给学生更好的课程了解！'){value=''}"  onblur="if (value ==''){value='请老师填好课程规划，给学生更好的课程了解！'}"><?=$order_row['Comments_two']?></textarea>
                </td>
              </tr>
              <?php if($opt == 'edit' || $opt == 'editProject') {?>
              <tr>
                <td></td>
                <td><input type="submit" style="background:#ff6600;; color:#fff; width:80px; height:30px;margin-right: 170px;float:right;    border: none;border-radius: 4px;margin-top:-10px;" name="submit" value="保&nbsp;&nbsp;存" /></td>
              </tr>
              <?php }?>
              </form>
              <?php }?>
              <?php if(!$member_info['IsTeacher']){?>
              <tr>
                <td>课程规划:</td>
                <td>
                    <textarea name="Comments_two" style=" text-align:left; border:1px solid #ccc;width:500px; height:230px;resize: none;"  disabled='disabled' ><?=$order_row['Comments_two'] == '请老师填好课程规划，给学生更好的课程了解！' ? '老师还没填写课程规划！' : $order_row['Comments_two']?></textarea>
                </td>
              </tr>
              <?php }?>
              <tr>
                <?php if(!$member_info['IsTeacher']){?>
                <td>我的留言:</td>
                <?php } else{?>
                <td>学生留言:</td>
                <?php }?>
                <td>
                    <!-- <textarea name="Comments_two" style=" text-align:left; border:1px solid #ccc;width:500px; height:230px;resize: none;"><?=$order_row['Comments']?></textarea> -->
                    <?=nl2br($order_row['Comments'])?>
                </td>
              </tr>
			</table>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail_item_list">
				<tr class="tb_title">
					<td width="14%">图片</td>
					<td width="50%">课程信息</td>
					<td width="12%">价格</td>
					<td width="12%">数量</td>
					<td width="12%" class="last">总价</td>
				</tr>
                <style type="text/css">
				.flh_150{font-size:12px !important;}
				</style>
				<?php
				$pro_count=0;
				$item_row=$db->get_all('orders_product_list', "OrderId='{$order_row['OrderId']}'", '*', 'ProId desc, LId desc');
				for($i=0; $i<count($item_row); $i++){
					$item_price=$item_row[$i]['Price'];
					$price_all=$item_row[$i]['Price']*$item_row[$i]['Qty'];
					$pro_count+=$item_row[$i]['Qty'];
				?>
				<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
					<td valign="top"><table width="92" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="92" align="center" class="item_img"><a href="<?=get_url('product',$item_row[$i]);?>" target="_blank"><img width="100" src="<?=$item_row[$i]['PicPath'];?>" /></a></td></tr></table></td>
					<td align="center" class="flh_150">
						老师: <a href="<?=get_url('product',$item_row[$i]);?>" target="_blank" class="proname"><?=$item_row[$i]['Name'];?></a><br /><br />
						科目: <?=$Category[$item_row[$i]['CateId']]['Category']?><br /><br />
					</td>
					<td><?=iconv_price($item_price);?></td>
					<td><?=$item_row[$i]['Qty'];?></td>
					<td class="last"><?=iconv_price($price_all);?></td>
				</tr>
				<?php }?>
				<tr class="total">
					<td colspan="3">&nbsp;</td>
                    <td><span class="finalPrice_info">总价:</span></td>
                    <td><span class="finlPrice"><?=iconv_price($order_row['TotalPrice']);?></span></td>
				</tr>
			</table>
		</div>
    <?php }?>
</div>
<script>
    var query = "<?=$query_string?>";
    var total = <?=$total_pages?>;

    $(function(){
        $("#startSel").val("<?=$order_row['StartTime']?>");
        $("#endSel").val("<?=$order_row['EndTime']?>");
    });

    $(".search_sub").click(function(){
        var num = $(".input_type2").val();
        var queryUrl = "account.php?";
        if(!isNaN(num)){
            if(num >= 0 && num <= total){ 
                queryUrl += query + "&page=" + num;
            }else if(num < 0){
                queryUrl += query + "&page=1";
            }else if(num > total){
                queryUrl += query + "&page=" + total;
            }
            self.location=queryUrl; 
        }else{
            alert("请输入数字!");
        }
    })

    function confirmContinuneLessons(){
        if (!confirm("确认续课吗？")) { 
            window.event.returnValue = false; 
        }
    }
</script>