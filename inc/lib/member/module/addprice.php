<?php
$cur='会员充值';
?>
<div id="lib_member_apply">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
    <div class="blank20"></div>
    <form action="/inc/lib/member/action/mod_addprice.php" method="post" OnSubmit="return checkForm(this);">
        <div class="apply">
                <div class="item">
                    <span>充值：</span><input type="text" name="Price" class="input_txt" value="" style="width:100px;"/> <span style="float:left;">元</span>
                    <div class="clear"></div>
                </div>
                <div class="blank20"></div>
            	<input type="submit" class="input_sub" value="充值" />
            <?php /*?><?php }?><?php */?>
            <input type="hidden" name="data" value="addprice" />
            <input type="hidden" name="MemberId" value="<?=$member_info['MemberId']?>" />
        </div>
    </form>
</div>