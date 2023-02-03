<?php
//var_dump($_SESSION['__CheckNum']);

$type=$_GET['type'];
if($type==''){?>
<div class="poptrox-popup succyk shadow" id="register">
<ul>
<li class="p_reg">
<p><span>我是<em>学生</em></span><br>我找艺术导师</p>
<a href="/account.php?module=create&type=parent">现在加入</a>
</li>
<li>
<p><span>我是<em>老师</em></span><br>我想帮助学生提高艺术素养</p>
<a href="/account.php?module=create&type=teacher">现在加入</a>
</li>
<div class="clear"></div>
</ul>
</div>
<?php }elseif($type=='teacher'){?>

<div class="layout-center">
			<h3><span>用户注册</span>欢迎加入九啾啾大家庭</h3>
            <form class="subform" action="/inc/lib/member/action/mod.php" method="post" name="member_create_form" OnSubmit="return checkForm(this);">
                <div class="form-gp">
                    <label style="font-size:16px; margin-top:2px">手机号：</label>
                    <div class="input-msg">
                        <div class="okcoded">
                            <input name="Phone" id="Phone" type="text"  check="请正确填写手机号码！~mobile|“{value}”不是一个有效的手机号码！" class="inp" autocomplete="off" maxlength="11" placeholder="请输入手机号作为登录账号">
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                
                 <div class="form-gp">
            <label style="font-size:16px; margin-top:2px">图形码：</label>
            <div class="input-msg">
                <div class="yzm">
                    <input id="txt_valid" name="VCode" type="text" autocomplete="off" placeholder="请输入图形码" class="inp no-code fl" check="请输入图形码!~4m|*"  maxlength="4"><br /><br /><br />
                    <div style="margin-top:10px;">
						<?=verification_code('create');?> <a href='javascript:void(0);' onclick='this.blur(); obj=$_("<?=md5('create');?>"); obj.src=obj.src+Math.random(); return false'>换一张</a></span>
                    </div>
                 </div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="form-gp">
            <label style="font-size:16px; margin-top:2px">验证码：</label>
            <div class="input-msg">
                <div class="yzm">
                     <input id="txt_valid" name="CheckCode" type="text" autocomplete="off" placeholder="请输入验证码" class="inp no-code fl">
                     <input type="button" class="btn-blue fl" id="getcodes" value="获取短信验证码"><a id="getcodes2" style=" text-align:center;display:none;" class="btn-blue" href="javascript://">已发送(&nbsp;<span id="timeload">120</span>&nbsp;s)</a>
                <div class="clear"></div>
            </div>
        </div>
        </div>
                
                <div class="form-gp mt60" style=" margin-bottom:0;">
                    <label style="font-size:16px; margin-top:2px">密&nbsp;&nbsp;&nbsp;码：</label>
                    <div class="input-msg">
                        <div id="change">
							<input name="Password" check="请正确填写密码！~pwd|“{value}”不是一个有效的密码*" maxlength="24" placeholder="请输入6位以上密码" autocomplete="off" class="inp" type="password">
						</div>
                    </div>
                </div>				
				<input type="hidden" id="reserve_url" value=""> 
				<div class="form-gp" style="margin-top:20px;">
					<label style="font-size:16px; margin-top:2px;float:left;">授课城市：</label>
					<select name="CId" style="height:40px;padding:6px 5px;min-width:100px;float:left;;font-size:16px;border:1px solid #b9b9b9;border-radius:5px;-webkit-border-radius:5px;-ms-border-radius:5px;-moz-border-radius:5px;cursor:pointer;">
                    <?php  
						$alter_city=$db->get_all('product_color','1');
						foreach((array) $alter_city as $item){
					?> 	
                    	<option value="<?=$item['CId']?>"><?=$item['Color']?></option>
                    <?php }?>      						
					</select>
				</div>
                <div class="form-gp">
                    <label></label>
                    <div class="input-msg">
                        <div><label style="width:auto;font-size:15px; font-weight:normal;cursor:pointer;margin-left:0px;"><input id="chk_agreement" type="checkbox" style="margin: 0 6px 0 0;cursor:pointer;" checked="false" check="同意服务协议!~*">我已阅读并遵守<a href="/article.php?AId=4" style="color:#2E86E6; text-decoration:underline;" target="_blank">&nbsp;"九啾啾"服务协议&nbsp;</a></label></div>
                    </div>
                </div>
                <input type="submit" class="btn-orig2 o-k" />
                <input type="hidden" name="data" value="member_create" />
                <input type="hidden" name="IsTeacher" value="1" />
                <input type="hidden" name="CheckNum" value="0" />
            </form>	
</div>
    
<?php }elseif($type=='parent'){?>
<div class="layout-center">
	<h3><span>用户注册</span>欢迎加入九啾啾大家庭</h3>
    <form class="subform" action="/inc/lib/member/action/mod.php" method="post" name="member_create_form" OnSubmit="return checkForm(this);" id="regform">
        <div class="form-gp">
            <label style="font-size:16px; margin-top:2px">手机号：</label>
            <div class="input-msg">
                <div class="okcoded">
                    <input name="Phone" id="Phone" maxlength="11" type="text" check="请正确填写手机号码！~mobile|“{value}”不是一个有效的手机号码*" value="" class="inp" placeholder="请输入手机号作为登录账号">
                    <div class="clear"></div>
                </div>
            </div>
        </div>
		<?php /*?><div class="rows">
			<label>Code Shown: <font class='fc_red'>*</font></label>
			<span><input name="VCode" type="text" class="form_input vcode" size="4" maxlength="4" check="Code Shown is required!~4m|*"><br /><?=verification_code('feedback');?> <a href='javascript:void(0);' onclick='this.blur(); obj=$_("<?=md5('feedback');?>"); obj.src=obj.src+Math.random(); return false' class="red">Load new image</a></span>
			<div class="clear"></div>
		</div><?php */?>        
        
        <div class="form-gp">
            <label style="font-size:16px; margin-top:2px">图形码：</label>
            <div class="input-msg">
                <div class="yzm">
                    <input id="txt_valid" name="VCode" type="text" autocomplete="off" placeholder="请输入图形码" class="inp no-code fl" check="请输入图形码!~4m|*"  maxlength="4"><br /><br /><br />
                    <div style="margin-top:10px;">
						<?=verification_code('create');?> <a href='javascript:void(0);' onclick='this.blur(); obj=$_("<?=md5('create');?>"); obj.src=obj.src+Math.random(); return false'>换一张</a></span>
                    </div>
                 </div>
                <div class="clear"></div>
            </div>
        </div>
        
        <div class="form-gp">
            <label style="font-size:16px; margin-top:2px">验证码：</label>
            <div class="input-msg">
                <div class="yzm">
                     <input id="txt_valid" name="CheckCode" type="text" autocomplete="off" placeholder="请输入验证码" class="inp no-code fl">
                     <input type="button" class="btn-blue fl" id="getcodes" value="获取短信验证码"><a id="getcodes2" style=" text-align:center;display:none;" class="btn-blue" href="javascript://">已发送(&nbsp;<span id="timeload">120</span>&nbsp;s)</a>
                <div class="clear"></div>
            </div>
        </div>
        </div>
       <div class="form-gp mt60" style=" margin-bottom:0;">
			<label style="font-size:16px; margin-top:2px">密&nbsp;&nbsp;&nbsp;码：</label>
			<div class="input-msg">
				<div id="change">
					<input name="Password" id="pwd" check="请正确填写密码！~pwd|“{value}”不是一个有效的密码*" maxlength="24" placeholder="请输入6位以上密码" autocomplete="off" class="inp" type="password">
				</div>
			</div>
		</div>
        <input type="hidden" id="reserve_url" value=""> 
        <div class="form-gp">
            <label></label>
            <div class="input-msg">
                <div><label style="width:auto; font-size:15px; font-weight:normal;cursor:pointer;margin:30px 0 0 0;"><input id="chk_agreement" type="checkbox" style="margin: 0 6px 0 0;" check="同意服务协议!~*" checked="false">我已阅读并遵守<a href="/article.php?AId=18" style="color:#2E86E6; text-decoration:underline;" target="_blank">&nbsp;"九啾啾"服务协议&nbsp;</a></label></div>
                <span id="msg-inp-agree" class="msg-inp"></span>
            </div>
        </div>
        <input type="submit" class="btn-orig2 o-k" />
        <input type="hidden" name="data" value="member_create" />
        <input type="hidden" name="IsTeacher" value="0" />
        <input type="hidden" id="CheckNum" name="CheckNum" value="0" />
    </form>
</div>
<?php }?>
<script type="text/javascript">
	 
    $('#getcodes').click(
		function(){
			 phsta=1;;
			 txtsta =1;
			 CheckNum=1;
			 Phone = $('#Phone').val();
			 if(!Phone){phsta=0;}
			 
			 txt_valid = $('#txt_valid').val();
			 if(!txt_valid){txtsta=0;}
			 
			 
			 			 
			 if(!phsta){ 
			 	alert('请填写手机号!');
				return false;
			 }
			 else if(!txtsta){
				 alert('请填写图形码!');
				 return false;
			 }
			 SendCheck(txt_valid,Phone,1);
	})
</script>