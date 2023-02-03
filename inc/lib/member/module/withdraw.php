<?php
$cur='会员提现';
?>
<div id="lib_member_apply">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
    <div class="blank20"></div>
    <form action="/inc/lib/member/action/mod.php" method="post" OnSubmit="return checkForm(this);" id="withdraw_form">
        <div class="apply">
        		<div class="item">
                    <span style="width:200px;">现金余额:<font style="font-size: 18px;color:#f39e07;"><?=$member_info['Account_Price']?></font>元</span>
                    <div class="clear"></div>
                </div>
                <div class="item">
                    <span>请输入提现金额：</span><input type="text" name="Price" id="Price" class="input_txt" value="" style="width:100px;" onkeyup="set_number(this, 1);CheckPrice(this);" onpaste="set_number(this, 1);CheckPrice(this);"  placeholder="请输入金额" check="请输入金额~*"/> <span style="float:left;">元</span> <?php /*?><span class="fc_red" style="font-size:14px; color:red; display:inline-block; width:310px;">(支付宝会收取2%手续费，平台不收取任何费用)</span><?php */?>
                    <div class="clear"></div>
                </div>
                <div class="blank20"></div>
                <div class="item">
                    <span>请输入登录密码：</span><input type="password" name="Password" class="input_txt" value="" check="请输入登录密码~*"/>
                    <div class="clear"></div>
                </div>
                <div class="showerror">您输入的提现金额已超出最高可提现金额或者不是一个有效的！（可提现金额：<?=$member_info['Account_Price']?>元）</div>
            	<input type="submit" class="input_sub inputsubclass" value="提现" />
                <input type="submit" class="input_sub inputsubclass2" value="提现" disabled="disabled" style=" display:none;"/>
            <?php /*?><?php }?><?php */?>
            <input type="hidden" name="data" value="withdraw" />
            <input type="hidden" name="MemberId" value="<?=$member_info['MemberId']?>" />
        </div>
    </form>
    <script>
    	function CheckPrice(obj){
			var withdrawprice = parseFloat(jQuery(obj).val());
			if(withdrawprice><?=$member_info['Account_Price']?>){
				jQuery('.showerror').show();
				jQuery('.inputsubclass').hide();
				jQuery('.inputsubclass2').show();
			}else if(withdrawprice>0){
				jQuery('.showerror').hide();
				jQuery('.inputsubclass').show();
				jQuery('.inputsubclass2').hide();
			}else{
				jQuery('.showerror').show();
				jQuery('.inputsubclass').hide();
				jQuery('.inputsubclass2').show();	
			}
		}
		$(function() {
		var withdrawprice = parseFloat(jQuery('#Price').val());
			if(withdrawprice><?=$member_info['Account_Price']?> && withdrawprice>0){
				jQuery('.showerror').show();
				jQuery('.inputsubclass2').hide();
				jQuery('.inputsubclass').show();
				jQuery('.inputsubclass').attr('disabled','disabled');
			}else{
				jQuery('.showerror').hide();
				jQuery('.inputsubclass').hide();
				jQuery('.inputsubclass2').show();
			}
		});
    </script>
</div>