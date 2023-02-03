<?php
if($member_info['IsTeacher']){
    $ordersConut = $db->get_row_count('orders', 'TeacherId = '.$member_info['MemberId']);
    $orderTwosCount = $db->get_row_count('order_twos', 'TeacherId = '.$member_info['MemberId']); 
}else{
    $ordersConut = $db->get_row_count('orders', 'MemberId = '.$member_info['MemberId']);
    $orderTwosCount = $db->get_row_count('order_twos', 'MemberId = '.$member_info['MemberId']); 
}
?>


<div id="member_left_top">
	<div class="member_info">
        <div class="img"><img width="74" src="<?=is_file($site_root_path.$member_info['Face'])?$member_info['Face']:'/images/face.jpg';?>" /></div>
        <div class="par">
            <div class="name"><?=$member_info['UserName']?$member_info['UserName']:$member_info['Phone']?></div>
            <div class="Idnum">ID:<?php echo sprintf('%08s',$_SESSION['member_MemberId'])?></div>
        </div>
    </div>
    <div class="clear"></div>
    <div class="member_momey">
    	<div class="member_e"><strong>账号余额</strong>&nbsp;&nbsp;<font class="font0"><?=$db->get_value('member',"MemberId = '{$_SESSION['member_MemberId']}'",'Account_Price')?>元</font></div>
    	<?php /*?><div class="member_c">现金余额<font class="font0">&nbsp;&nbsp;<?=$db->get_value('member',"MemberId = '{$_SESSION['member_MemberId']}'",'Account_Cash')?>元</font></div><?php */?>
    </div>
    <div class="btn">
    	<?php if(!$member_info['IsTeacher'] && !$member_info['Apply']){?>
       		<a href="/account.php?module=addprice">充&nbsp;&nbsp;值</a>
        <?php }else{?>
        	<!-- <a href="/account.php?module=withdraw">提&nbsp;&nbsp;现</a> -->
            <a href="/account.php?module=price">提&nbsp;&nbsp;现</a>
        <?php }?>
    </div>
    
</div>

<div id="member_left_bottom">
<div class="title">会员中心</div>
   <?php if($member_info['Apply']){?>

    <?php if($member_info['is_dealer'] != '1'){?>
    <dl class="member_meua_dl">
        <dt>课程管理系统</dt>
        <dd><a href="/account.php?module=orders&act=prelist#contents">约课订单(<span style="color:red;font-weight: bold;"><?=$ordersConut?></span>)</a></dd>
        <dd><a href="/account.php?module=orders&act=list#contents">续课订单(<span style="color:red;font-weight: bold;"><?=$orderTwosCount?></span>)</a></dd>
    </dl>
    <?php } ?>
    <dl class="member_meua_dl">
    	<dt>账户中心</dt>
        <dd class="<?=$module=='index'?'cur':''?>"><a href="/account.php?module=index#contents">个人信息</a>&nbsp;&nbsp;&nbsp;<?= $member_info['Is_All_0']?'':'<span class="fc_red">(未完善)</span>'?></dd>
		<?php /*?><?php if(!$member_info['IsTeacher']){?>
        	<dd class="<?=$module=='apply'?'cur':''?>"><a href="/account.php?module=apply#contents">教师资料申请</a>&nbsp;&nbsp;&nbsp;<?=$member_apply['Is_apply']?'':'<span class="fc_red">(未完善)</span>'?></dd>
       	<?php }else{?>
<?php */?>        	
        <dd class="<?=$module=='issue_mod'?'cur':''?>"><a href="/account.php?module=issue_mod#contents">授课信息</a>&nbsp;&nbsp;&nbsp;<?= $member_info['Is_All_1']?'':'<span class="fc_red">(未完善)</span>'?></dd>
       	<?php /*?><?php }?><?php */?>
        <dd class="<?=$module=='ident'?'cur':''?>"><a href="/account.php?module=ident#contents">资料认证</a>&nbsp;&nbsp;&nbsp;<?= $member_ident['Is_ident']?'':'<span class="fc_red">(未完善)</span>'?></dd>
        <?php /*?><dd><a href="/account.php?module=face_mod">头像设置</a></dd><?php */?>
        <dd class="<?=$module=='profile'?'cur':''?>"><a href="/account.php?module=profile#contents">帐号设置</a>&nbsp;&nbsp;&nbsp;</dd>
        
        <dd class="<?=$module=='password'?'cur':''?>"><a href="/account.php?module=password#contents">密码修改</a></dd>
        <dd class="<?=$module=='price'?'cur':''?>"><a href="/account.php?module=price#contents">资金账户</a></dd>
        <dd class="<?=$module=='qrcode'?'cur':''?>"><a href="/account.php?module=qrcode#contents">十大名师打造计划</a><div style="display:inline;"><img src="/images/hot.gif"/></div></dd>
        <?php if($member_info['is_dealer'] == '1'){?>
        <dd class="<?=$module=='dealer'?'cur':''?>"><a href="/account.php?module=dealer#contents">商家账户</a><div style="display:inline;"><img src="/images/hot.gif"/></div></dd>
        <?php } ?>
    </dl>
    
    <?php }else{?>
    <dl class="member_meua_dl">
        <dt>课程管理系统</dt>
        <dd class="<?=$_GET['act']=='prelist'?'cur':''?>"><a href="/account.php?module=orders&act=prelist#contents">约课订单(<span style="color:red;font-weight: bold;"><?=$ordersConut?></span>)</a></dd>
        <dd class="<?=$_GET['act']=='list'?'cur':''?>"><a href="/account.php?module=orders&act=list#contents">续课订单(<span style="color:red;font-weight: bold;"><?=$orderTwosCount?></span>)</a></dd>
        <dd class="<?=$module=='wishlists'?'cur':''?>"><a href="/account.php?module=wishlists#contents">关注的老师</a></dd>
    </dl>
    <dl class="member_meua_dl">
    	<dt>账户中心</dt>
        <dd class="<?=$module=='index'?'cur':''?>"><a href="/account.php?module=index#contents">个人信息</a></dd>
        <?php /*?><dd><a href="/account.php?module=face_mod">头像设置</a></dd><?php */?>
        <dd class="<?=$module=='profile'?'cur':''?>"><a href="/account.php?module=profile#contents">帐号设置</a></dd>
        <dd class="<?=$module=='password'?'cur':''?>"><a href="/account.php?module=password#contents">密码修改</a></dd>
        <dd class="<?=$module=='price'?'cur':''?>"><a href="/account.php?module=price#contents">资金账户</a></dd>
    </dl>
    <?php }?>
    <dl class="member_meua_dl last">
    	<dt>退出登录</dt>
        <dd><a href="/account.php?module=logout">安全退出</a></dd>
    </dl>
</div>