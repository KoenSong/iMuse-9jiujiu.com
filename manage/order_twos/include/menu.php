<div class="act_form">
	<div class="card_list">
		<div class="<?=$module=='base'?'cur':'';?>"><a href="view.php?OrderId=<?=$OrderId;?>&module=base"><?=get_lang('orders.base_info');?></a></div>
		<?php /*?><div class="<?=$module=='address'?'cur':'';?>"><a href="view.php?OrderId=<?=$OrderId;?>&module=address"><?=get_lang('orders.address_info');?></a></div><?php */?>
		<div class="<?=$module=='status'?'cur':'';?>"><a href="view.php?OrderId=<?=$OrderId;?>&module=status"><?=get_lang('orders.order_status');?></a></div>
        <div class="<?=$module=='memberinfo'?'cur':'';?>"><a href="view.php?OrderId=<?=$OrderId;?>&module=memberinfo">会员信息</a></div>
		<?php /*?><div class="<?=$module=='product_list'?'cur':'';?>"><a href="view.php?OrderId=<?=$OrderId;?>&module=product_list"><?=get_lang('orders.products_list');?></a></div><?php */?>
		<?php /*?><?php if(get_cfg('orders.mod')){?><div class="<?=$module=='product_add'?'cur':'';?>"><a href="view.php?OrderId=<?=$OrderId;?>&module=product_add"><?=get_lang('orders.product_add');?></a></div><?php }?><?php */?>
		<?php /*?><div class="<?=$module=='print'?'cur':'';?>"><a href="view.php?OrderId=<?=$OrderId;?>&module=print" target="_blank"><?=get_lang('orders.print_order');?></a></div>
		<div class="<?=$module=='export'?'cur':'';?>"><a href="view.php?OrderId=<?=$OrderId;?>&module=export"><?=get_lang('orders.export_order');?></a></div><?php */?>
	</div>
</div>