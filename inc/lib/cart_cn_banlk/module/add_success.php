<div id="lib_cart_add_success">
	<div class="close"><img src="/images/lib/cart/close_button.jpg" /><a href="javascript:void(0);" onclick="close_cart_add_success();">关闭</a></div>
	<div class="tips"><img src="/images/lib/cart/add_success.png" align="absmiddle" />产品已成功添加到购物车!</div>
	<div class="cart_info"><span>预约课程共<?=(int)$db->get_sum('shopping_cart', $where, 'Qty');?></span> 节。 总费用: <span><?=$db->get_sum('shopping_cart', $where, 'Qty*Price');?></span></div>
	<div class="checkout"><a href="<?=$cart_url;?>?module=list"><img src="/images/lib/cart/btn_cheakout_cn.png" /></a></div>
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