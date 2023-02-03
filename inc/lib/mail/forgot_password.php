<?php
ob_start();
?>
亲爱的 <strong><?=htmlspecialchars($fullname);?></strong>:<br /><br />

这是从<a href="<?=get_domain();?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;"><?=get_domain(0);?></a>自动发送的邮件响应您的要求重置密码。 请不要回复此邮件。<br /><br />

<strong>要重置您的密码并访问您的 <a href="<?=get_domain();?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;"><?=get_domain(0);?></a> 账户,请按照下列步骤:</strong><br /><br />

<div style="font-family:Arial; line-height:180%; padding-left:20px;">1)&nbsp;&nbsp;点击以下链接或者复制并粘贴链接到浏览器的地址栏.<br /><a href="<?=get_domain().$member_url;?>?module=forgot&email=<?=urlencode($EmailEncode);?>&expiry=<?=urlencode($Expiry);?>" target="_blank" style="color:#1E5494; text-decoration:underline; font-family:Arial; font-size:12px;"><?=get_domain().$member_url;?>?module=forgot&amp;email=<?=urlencode($EmailEncode);?>&amp;expiry=<?=urlencode($Expiry);?></a></div><br />
<div style="font-family:Arial; line-height:180%; padding-left:20px;">2)&nbsp;&nbsp;上面的链接将带您到我们的“重设密码”页面。在填写相应的字段，然后点击“提交”，您将能够立即访问您的帐户.</div><br />

如果您有任何疑问，请发邮件给我们的客户服务团队.<br /><br />

此致,<br /><br />

<?=get_domain(0);?> 客户服务团队
<?php
$mail_contents=ob_get_contents();
ob_end_clean();
?>