<?php /*?><div id="lib_cart_add_success">
	<div class="close"><img src="/images/lib/cart/close_button.jpg" /><a href="javascript:void(0);" onclick="close_cart_add_success();">关闭</a></div>
	<div class="tips"><img src="/images/lib/cart/add_success.png" align="absmiddle" />产品已成功添加到购物车!</div>
	<div class="cart_info"><span>预约课程共<?=(int)$db->get_sum('shopping_cart', $where, 'Qty');?></span> 节。 总费用: <span><?=$db->get_sum('shopping_cart', $where, 'Qty*Price');?></span></div>
	<div class="checkout"><a href="<?=$cart_url_cn;?>?module=list"><img src="/images/lib/cart/btn_cheakout_cn.png" /></a></div>
</div><?php */?>
<?php 
	$cart_row=$db->get_one('shopping_cart',$where);
	$product_row=$db->get_one('product',"ProId = '{$cart_row['ProId']}'");
	$product_ext=$db->get_one('product_ext',"ProId = '{$cart_row['ProId']}'");
?>
<div id="lib_cart_add_success">
    <div class="bg-r-c-s">&nbsp;</div>
    <div class="poptrox-popup overfl-pop" id="yk_pop" style="width:980px;">
        <h1>向<span><?=$product_row['Name']?></span>约课<em>请填写约课信息</em><i class="closeyk-card" onclick="close_cart_add_success();">&times;</i></h1>
        <div class="yk-hls">
            <!-- <h3>所约老师</h3> -->
            <div class="for-on">
                <dl class="clear-fx">
                    <dd><img src="<?=$product_row['PicPath_0']?>"></dd>
                    <dd>
					<div class="spanbr">
                    <span class="t_name"><?=$product_row['Name']?></span><span><?=$product_ext['Applicable']?></span><span><?=$Category[$product_row['CateId']]['Category']?></span><span><strong><?=$product_row['Price_1']?></strong>元/小时</span><br><span class="areayk"><span style="color:rgb(121, 121, 121);">上课区域：</span><?=$db->get_value('product_color',"CId
='{$product_row['ColorId']}'",'Color')?></span>
                    </div></dd>
                </dl>
            </div>

            <div class="subform" style="margin-top:35px;padding-left:110px">

				<div class="form-gp las">
                <form action="/cart.php?moudle=checkout" method="post">
                    <label>学生的学习情况：</label>
                    <div class="input-msg">
                        <select name="grade_site">
							<option value="0">请选择年级排名</option>
							<option value="1">年级靠前</option>
							<option value="2">年级中等偏上</option>
							<option value="3">年级中等</option>
							<option value="4">年级中等偏下</option>
							<option value="5">年级靠后</option>
						</select>
						<select name="class_site">
							<option value="0">请选择班级排名</option>
							<option value="1">班级靠前</option>
							<option value="2">班级中等偏上</option>
							<option value="3">班级中等</option>
							<option value="4">班级中等偏下</option>
							<option value="5">班级靠后</option>
						</select>
                    </div>
                </div>
				<div class="form-gp las">
                    <label><span class="redstar">*</span>期望试听时间：</label>
                    <div class="input-msg">
                        <input type="text" name="txt2" id="from_date" class="input1 on_date runcode"  placeholder="请选择日期" style="padding:0px 0 0 5px;text-align:left;color:#999;line-height:40px;">
                        <select name="start_time_hls" class="input2"><option value="请选择开始时间">请选择开始时间</option><option value="07:00">7:00</option><option value="07:30">7:30</option><option value="08:00">8:00</option><option value="08:30">8:30</option><option value="09:00">9:00</option><option value="09:30">9:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:00">23:30</option><option value="00:00">0:00</option><option value="00:30">0:30</option><option value="01:00">1:00</option><option value="01:30">1:30</option><option value="02:00">2:00</option><option value="02:30">2:30</option><option value="03:00">3:00</option><option value="03:30">3:30</option><option value="04:00">4:00</option><option value="04:30">4:30</option><option value="05:00">5:00</option><option value="05:30">5:30</option><option value="06:00">6:00</option><option value="06:30">6:30</option></select>
                                                                    
                                                                    <select name="end_time_hls" class="input2"><option value="请选择结束时间">请选择结束时间</option><option value="07:00">7:00</option><option value="07:30">7:30</option><option value="08:00">8:00</option><option value="08:30">8:30</option><option value="09:00">9:00</option><option value="09:30">9:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:00">23:30</option><option value="00:00">0:00</option><option value="00:30">0:30</option><option value="01:00">1:00</option><option value="01:30">1:30</option><option value="02:00">2:00</option><option value="02:30">2:30</option><option value="03:00">3:00</option><option value="03:30">3:30</option><option value="04:00">4:00</option><option value="04:30">4:30</option><option value="05:00">5:00</option><option value="05:30">5:30</option><option value="06:00">6:00</option><option value="06:30">6:30</option></select>
                    </div>
                </div>
                <div class="form-gp las">
                    <label>备注信息：</label>
                    <div class="input-msg">
                        <textarea id="td_evaluate" placeholder="您可以填写学生期望补习的内容，或是对老师的要求。" class="inp" style="width:490px; resize:none;"></textarea>
                    </div>
                </div>
			
            </div>
        </div>
        <div>
			<div style="padding-left: 285px;text-align: left;margin-top:25px;"><span style="color:#ff9900;">温馨提示：</span>试听成功后，若您向该老师购买课时，也需支付试听的课时费</div>
            <input type="submit" class="btn-orig" style="padding:0 65px;width:270px;margin: 20px auto; border:0px; outline:0;" value="提交约课">
            <input type="hidden" name="data" value="cart_checkout" />
        </div>
        <p style="display:none;text-align:center;" class="errorMSG" id="errorMSG">您目前已预约数学科目的老师，暂时无法继续预约该科目老师。请您安排好时间与已约老师进行试听。</p>
        </form>
    </div>
	<!-- 续课弹层 start-->

</div>
<script language="javascript">
(function(){
	parent.div_mask();
	cart_add_success();
	parent.close_cart_add_success=function(){	//关闭弹出窗口
		window.top.document.body.removeChild(parent.$_('div_mask'));
		window.top.document.body.removeChild(parent.$_('lib_cart_add_success'));
		clearInterval(scroll_cart_add_success_timer);
	}
})()
</script>