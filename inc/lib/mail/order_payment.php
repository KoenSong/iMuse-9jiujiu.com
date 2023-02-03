<?php
!isset($order_row) && $order_row=$db->get_one('orders', "OId='$OId'");

ob_start();
?>
亲爱的 <strong><?=htmlspecialchars($order_row['ShippingLastName']);?></strong>:<br /><br />

这是来自<a href="<?=get_domain();?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;"><?=get_domain(0);?></a>自动发送的邮件，请不要回复此邮件。<br /><br />

我们从您的付款收到订单#<a href="<?=get_domain().$member_url;?>?module=orders&OId=<?=$order_row['OId'];?>&act=detail" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;"><?=$order_row['OId'];?></a>, 谢谢!<br /><br />

<?php include($site_root_path.'/inc/lib/mail/order_detail.php');?>

此致,<br /><br />

<?=get_domain(0);?> 客户服务团队
<?php
$mail_contents=ob_get_contents();
ob_end_clean();
?>