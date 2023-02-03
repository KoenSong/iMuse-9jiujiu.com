<?php
ob_start();
?>
亲爱的 <strong><?=htmlspecialchars($_SESSION['member_LastName']);?></strong>:<br /><br />

这是来自<a href="<?=get_domain();?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;"><?=get_domain(0);?></a>自动发送的邮件，请不要回复此邮件。<br /><br />

感谢您选择 <?=get_domain(0);?>.<br /><br />

你一直是我们公司的一员，欢迎加入我们的行列，享受便捷，安全的购物体验。您的帐户信息如下：:<br />
-------------------------------------------------------------------------------------------<br />
<div style="height:24px; line-height:24px; clear:both;">
	<div style="float:left; width:92px;">您的账号</div>
	<div style="float:left; width:400px;">: <?=htmlspecialchars($_SESSION['member_FirstName'].' '.$_SESSION['member_LastName']);?></div>
</div>
<div style="height:24px; line-height:24px; clear:both;">
	<div style="float:left; width:92px;">您的邮箱</div>
	<div style="float:left; width:400px;">: <?=htmlspecialchars($_SESSION['member_Email']);?></div>
</div>
<div style="height:24px; line-height:24px; clear:both;">
	<div style="float:left; width:92px;">您的密码</div>
	<div style="float:left; width:400px;">: ********</div>
</div><br /><br />

请点击以下链接，或复制并粘贴链接到浏览器的地址栏中购物:<br />
<a href="<?=get_domain();?>" target="_blank" style="font-family:Arial; color:#1E5494; text-decoration:underline; font-size:12px;"><strong><?=get_domain();?></strong></a><br /><br />

此致,<br /><br />

<?=get_domain(0);?> 客户服务团队
<?php
$mail_contents=ob_get_contents();
ob_end_clean();
?>