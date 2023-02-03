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
.flh_150{font-size:12px !important;}
.finalPrice_info{font-size: 16px;}
.finlPrice{font-size: 16px;}
#submitBtn{
    background:#ff6600;
    color:#fff; 
    width:80px; 
    height:30px;
    margin-right: 170px;
    float:right; 
    border: none;
    border-radius: 4px;
    margin-top:-10px
}
#submitBtn:hover{
    cursor:pointer;
}
</style>

<?php
$query_string=query_string(array('page', 'do'));
$turn_page_query_string=$website_url_type==0?"?$query_string&page=":'page-';
$page_count=10;

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
$other_par=$order_status_ary;
$order_par=array(1=>'时间从高到低',2=>'时间从等到高');
$sort_by=array(1=>'OrderTime desc,',2=>'OrderTime asc,');
$cur='课程管理系统';
?>
<div id="lib_member_orders">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
    <?php
	if($act=='list'){
		if($_SESSION['member_IsTeacher']){
			$where_tearch="TeacherId = '{$_SESSION['member_MemberId']}'";
		}else{
			$where_tearch="MemberId = '{$_SESSION['member_MemberId']}'";
		}
		$page_count=20;
		
		$K_Name=$_POST['K_Name'];
		$K_Name && $where_tearch.=" and (OId like '%$K_Name%')";
		
		$Other=$_POST['Par']?$_POST['Par']:$_GET['Par'];
		
		$Other && $status=(int)$Other;
		$Order=$_POST['Order']?(int)$_POST['Order']:(int)$_GET['Order'];		
		
		$status && $where_tearch.=" and OrderStatus='$status'";
		$row_count=$db->get_row_count('order_twos', $where_tearch);
		$total_pages=ceil($row_count/$page_count);
		$page=(int)$_GET['page'];
		$page<1 && $page=1;
		$page>$total_pages && $page=1;
		$start_row=($page-1)*$page_count;
		$order_row=$db->get_limit('order_twos', $where_tearch, '*', $sort_by[$Order].'OrderId desc', $start_row, $page_count);
	?>
    <div class="member_search">
        <form action="/account.php?module=orders&act=list" method="post">
            订单号&nbsp;:&nbsp;<input type="text" name="K_Name" class="input_type" value="" /> &nbsp;
            其它属性&nbsp;:&nbsp;<select name="Par" class="select_type">
                    <option value="0">-选择-</option>
                    <?php foreach((array)$other_par as $key =>$item){?>
                        <option value="<?=$key?>"><?=$item?></option>
                     <?php }?>
                    </select>
           排序&nbsp;:&nbsp;<select name="Order" class="select_type">
                        <option value="0">-选择-</option>
                    <?php foreach((array)$order_par as $key =>$item){?>
                        <option value="<?=$key?>"><?=$item?></option>
                     <?php }?>
                </select>
                <input type="image" class="search_sub" src="/images/member_search.jpg"  />
               <div class="blank6"></div>
               <form action="/account.php?module=orders&act=list" method="get">
                <div id="turn_page" class="relative"><?=turn_page($page, $total_pages, $turn_page_query_string, $row_count, '上一页', '下一页', $website_url_type);?>
                    <span>跳转:&nbsp;</span>
                    <input type="text" class="input_type2" name="page" value="" />
                    <input type="image" class="search_sub" src="/images/member_page.jpg" />
                </div>
       			</form>
        <div class="blank35"></div>
        <div class="cate_nav">
            <a class="<?=$Other==1?'cur':''?>" href="/account.php?module=orders&act=list&Par=1">待成交</a>
            <a class="<?=$Other==4?'cur':''?>" href="/account.php?module=orders&act=list&Par=4">上课中</a>
            <a class="<?=$Other==0?'cur':''?>" href="/account.php?module=orders&act=list">其它</a>
        </div>
   	</div>
    <div class="blank8"></div>
    <table width="100%" border="0" cellpadding="0" c cellspacing="0" class="item_list">
        <tr class="tb_title">
            <td width="16%" nowrap>订单号</td>
            <td width="7%" nowrap>课时费</td>
            <td width="9%" nowrap>状态</td>
            <?php /*if(($status==0 || $status==1 || $status==3) && */ if(count($order_row)){?> <td width="18%" nowrap>操作</td><?php }?>
        </tr>
        <?php
        for($i=0; $i<count($order_row); $i++){
			$status=$order_row[$i]['OrderStatus'];
        ?>
        <tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
            <td nowrap><a href="<?=$member_url;?>?module=order_twos&OId=<?=$order_row[$i]['OId'];?>&act=detail" class="detail_link"><?=$order_row[$i]['OId'];?></a></td>
            <td nowrap><?=iconv_price((1-$order_row[$i]['Discount'])*$order_row[$i]['TotalPrice']);?></td>
            <td nowrap><?=$order_status_ary[$status];?></td>
            <?php if($_SESSION['member_IsTeacher']==1){?>
            
            	<td nowrap align="center">
            	<?php if($status==1){?>
                    <?php if($order_row[$i]['Tmakesure_0']==0){?><a href="/ajax/makesure.php?act=Tmakesure_0&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">确定约课</a><?php }else{echo '<font class="fc_red">已确定</font>';}?>
                <?php }elseif($status==2){?>
					<a href="/ajax/makesure.php?act=Tmakesure_1&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">确定上课</a>
                </td>
                <?php }?>
                </td>
                
            <?php }else{?>
            
                <td nowrap align="center">
                 <?php if($status==1){?>
                    <?php if($order_row[$i]['Tmakesure_0']==1){?><a href="<?=$cart_url_cn;?>?module=payment&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">付款</a><?php }else{?>老师未确定<?php }?>
                <?php }elseif($status==2){?>
                        <a href="/ajax/makesure.php?act=Smakesure_0&OId=<?=$order_row[$i]['OId'];?>" class="qa_btn">课程进度</a>
                        <?=$db->get_row_count('order_twos_product_list',"OId= '{$order_row[$i]['OId']}' and Scompelet =1")/$db->get_row_count('order_twos_product_list',"OId= '{$order_row[$i]['OId']}' and Scompelet =0")?>% 
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
	<form action="/account.php?module=orders&act=list" method="get">
		<div id="turn_page" class="relative"><?=turn_page($page, $total_pages, $turn_page_query_string, $row_count, '上一页', '下一页', $website_url_type);?>
			<span>跳转:&nbsp;</span>
			<input type="text" class="input_type2" name="page" value="" />
			<input type="image" class="search_sub" src="/images/member_page.jpg" />
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
		$OId=$_GET['OId'];
		$opt = $_GET['opt'];
		$order_row=$db->get_one('order_twos', "OId='$OId'");
		$orderId = $order_row['OrderId'];
		$qty = $db->get_row_count('order_twos_product_list', "OrderId = '$orderId'");
		!$order_row && js_location("$member_url_cn?module=orders&act=list");
	?>
		<div class="blank12"></div>
		<div class="order_detail">
			<div style="font-size:18px; font-weight:bold;">订单详情</div>
		</div>
		<div class="detail_card">
		<form id="ctuForm" action="/ajax/makesure_three.php" method="post">
            <input type="hidden" name="start_time_hls" id="start_time_hls" value="<?=$order_row['StartTime']?>" check="请选择开始时间!~*"/>
            <input type="hidden" name="end_time_hls" id="end_time_hls" value="<?=$order_row['EndTime']?>" check="请选择开始时间!~*"/>
			<input type="hidden" name="OId" value="<?=$order_row['OId']?>" />
            <input type="hidden" name="act" value="Tmakesure_0" />
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
				<td>课时数:</td>
				<td><?=$qty;?></td>
			  </tr>
              <tr>
				<td>类型:</td>
				<td>续课</td>
			  </tr>
			  <?php if($member_info['IsTeacher']){?>
              <tr>
              	<td <?=$opt == 'edit' ? "style='border-bottom:none;'" : '' ?> <?=$opt == 'editProject' ? "style='border-bottom:none;'" : '' ?>>总体课程规划:</td>
				<td <?=$opt == 'edit' ? "style='border-bottom:none;'" : '' ?> <?=$opt == 'editProject' ? "style='border-bottom:none;'" : '' ?>>
                    <textarea id="editText" name="Comments_two" style=" text-align:left; border:1px solid #ccc;width:500px; height:230px;resize: none;"  <?php if($opt == 'none'){ echo "disabled='disabled'";}?> 
                        placeholder="请老师填好总体课程规划，给学生更好的课程了解！"><?=$order_row['Comments_two']?></textarea>
                </td>
              </tr>
              <?php if($opt == 'edit' || $opt == 'editProject') {?>
              <tr>
                <td></td>
                <td><input id="submitBtn" type="button" value="保&nbsp;&nbsp;存" /></td>
              </tr>
              <?php }?>
              </form>
              <?php }?>
			  <?php if(!$member_info['IsTeacher']){?>
              <tr>
                <td>总体课程规划:</td>
                <td>
                    <textarea name="Comments_two" style=" text-align:left; border:1px solid #ccc;width:500px; height:230px;resize: none;" placeholder="请老师填好总体课程规划，给学生更好的课程了解！" disabled='disabled' ><?=$order_row['Comments_two']?></textarea>
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
                	<?=nl2br($order_row['Comments'])?>
                </td>
              </tr>
			</table>
            <style type="text/css">
			.address_info{font-size:12px !important;}
			.address_info strong{font-size:12px !important;}
			</style>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail_item_list">
				<tr class="tb_title">
					<td width="14%">图片</td>
					<td width="50%">课程信息</td>
					<td width="12%">价格</td>
					<td width="12%">数量</td>
					<td width="12%" class="last">总价</td>
				</tr>
				<?php
				$pro_count=0;
				$ProId=$db->get_value('order_twos_product_list', "OrderId='{$order_row['OrderId']}'", 'ProId');
				$Product_row=$db->get_one('product',"ProId = '$ProId'");

				?>
				<tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
					<td valign="top"><table width="92" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="92" align="center" class="item_img"><a href="<?=get_url('product',$Product_row)?>" target="_blank"><img width="100" src="<?=$Product_row['PicPath_0']?$Product_row['PicPath_0']:'/images/face.jpg';?>" /></a></td></tr></table></td>
					<td align="center" class="flh_150">
						老师: <a href="<?=get_url('product',$Product_row)?>" target="_blank" class="proname"><?=$Product_row['Name'];?></a><br /><br />
						科目: <?=$Category[$Product_row['CateId']]['Category']?><br /><br />
					</td>
					<td><?=iconv_price($Product_row['Price_1']);?></td>
					<td><?=$qty;?></td>
					<td><?=iconv_price($order_row['TotalPrice']);?></td>
				</tr>
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
$(function(){
    $("#startSel").val("<?=$order_row['StartTime']?>");
    $("#endSel").val("<?=$order_row['EndTime']?>");


    
    $("#submitBtn").click(function(){
        var text = $("#editText").val();
        if(text == null || text == ""){
            alert("请老师填好总体课程规划！");
            return;
        }
        $("#ctuForm").submit();
    })
});
</script>
