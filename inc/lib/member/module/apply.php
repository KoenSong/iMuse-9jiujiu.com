<?php
$cur='教师申请';
$apply_cont=$db->get_one('article',"AId = 6");
?>
<div id="lib_member_apply">
	<div class="webpath">
    	<span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span>
    </div>
    <div class="blank20"></div>
	<div class="txt"><?=$apply_cont['Contents']?></div>
    <div class="blank20"></div>
    <form action="/inc/lib/member/action/mod.php" method="post" OnSubmit="return checkForm(this);">
    	
        <div class="apply">
<?php /*?>        	<?php if($member_info['Apply']){?>
            	<font class="fz_16px fc_red">你的申请正在审核中.......</font>
            <?php }else{?><?php */?>
            	<div class="item">
                    <span>年龄：</span>
					<input name="P_age" check="请正确填写年龄！~*" type="text" size="10" class="form_input fl">
                </div>
            	<div class="item">
                    <span>身份证号码：</span>
					<input name="Identity_Num" check="请正确填写身份证号码！~*" type="text" size="20" class="form_input fl">
                </div>
                <div class="item">
                    <span>教学科目：</span>
                    <?php $member_fav=$db->get_all('product_category','Dept = 2');?>
                    <select class="fl select" name="CateId" check="请选择课程类型！~*"  >
                    	<?php foreach((array)$member_fav as $item){
						?>
                        <option value="<?=$item['CateId']?>"><?=$item['Category']?></option>
                        <?php }?>
                    </select>
                </div>
                
                <div class="item">
                    <span>教龄：</span>
                    <select class="fl select" name="T_age" check="请选择教龄！~*">
                    <?php for($i=0;$i<50;$i++){
                    ?>
                    	<option value="<?=$i?>"><?=$i?></option>
                    <?php }?>
                    </select>
                </div>
                
              <?php /*?>  <div class="item">
                    <span>教学风格：</span><input class="input_txt" name="T_style" check="请填写教学风格！~*" maxlength="13" type="text" value="" />
                    <div class="clear"></div>
                </div>
                <div class="item">
                    <span>授课区域：</span><input class="input_txt" name="T_address" check="请填写授课区域！~*" maxlength="13" type="text" value="" />
                    <div class="clear"></div>
                </div>
                <div class="item">
                    <span>教学理念：</span><input class="input_txt" name="T_will" check="请填写教学理念！~*" maxlength="13" type="text" value="" />
                    <div class="clear"></div>
                </div>
                <div class="item">
                    <span>教学特长：</span><textarea class="input_trea" name="T_gift"></textarea>
                    <div class="clear"></div>
                </div>
                <div class="item">
                    <span>教学经历：</span><textarea class="input_trea" name="T_thought"></textarea>
                    <div class="clear"></div>
                </div>
                <div class="item">
                    <span>教学成果：</span><textarea class="input_trea" name="T_success"></textarea>
                    <div class="clear"></div>
                </div>
                <div class="item">
                    <span>艺术成就：</span><textarea class="input_trea" name="T_ter"></textarea>
                    <div class="clear"></div>
                </div><?php */?>
                <div class="blank20"></div>
            	<input type="submit" class="input_sub" value="提交" />
            <?php /*?><?php }?><?php */?>
            <input type="hidden" name="data" value="apply" />
            <input type="hidden" name="MemberId" value="<?=$member_info['MemberId']?>" />
        </div>
    </form>
</div>