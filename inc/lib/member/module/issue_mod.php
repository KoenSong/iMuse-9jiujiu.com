<?php
$cur='课程管理';



$ProId = $_GET['ProId'];

if($ProId){
    //商家账户
    $account_url = "/products-detail.php?ProId=".$ProId;
    $issue_ary=$db->get_one('product'," ProId = '{$ProId}' ",'*');
    $issue_ary_ext=$db->get_one('product_ext',"ProId ='{$ProId}'");
}else{
    //普通会员账号
    $issue_ary=$db->get_one('product',"MemberId = '{$member_info['MemberId']}'",'*');
    $issue_ary_ext=$db->get_one('product_ext',"ProId ='{$issue_ary['ProId']}'");
}
$issue_data = array();
$issue_ary['Date'] &&  $issue_data=explode('|',$issue_ary['Date']);
?>
<style>
#check:hover{cursor:pointer;color:red;}
</style>
<div id="lib_member_issue">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>

		<div class="form lib_member_item_card">
			<form action="/inc/lib/member/action/mod.php" method="post" enctype="multipart/form-data" OnSubmit="return checkForm(this);">
				<?php /*?><div class="lib_member_sub_title">添加你的课程 (添加后,还需要经过我们确认之后,同学们就可以看到你的课程信息.)</div><?php */?>
                <?php if($issue_ary['SoldOut']==1){?>
                 <div class="rows">
					<label>停课:</label>
					<span class="fc_red">是</span>
					<div class="clear"></div>
				</div>
                <?php }?>
                <?php if($issue_ary['is_dealer']=='1'){?>
                 <div class="rows">
                    <label>商家账户:</label>
                    <span style="font-size: 14px;"><?=$issue_ary['Name'];?></span>
                    <div class="clear"></div>
                </div>
                <?php }?>
				 <div class="rows">
					<label>授课科目:<font class="fc_red" style="font-size:18px;">*</font></label>
					<span>
                     <?php $member_fav=$db->get_all('product_category','Dept = 2');?>
					 <select class="fl select input_txt" name="CateId" check="请选择课程类型！~*"  >
                     		<option value="" selected >请选择课程类型</option>
							<?php foreach((array)$member_fav as $item){?>
							<option <?=$issue_ary['CateId']==$item['CateId']?'selected':''?> value="<?=$item['CateId']?>"><?=$item['Category']?></option>
							<?php }?>
					 </select>
                    </span>
					<div class="clear"></div>
				</div>
				<div class="blank15"></div>
                <?php /*?><div class="rows">
					<label>开课时间:</label>
					<span>
                       <input name="IssueTime" type="text" size="10" check="请正确填写开课时间！~*" value="<?=$issue_ary['IssueTime']?>" class="form_input" />
                       (如 2015-10-1)
                    </span>
					<div class="clear"></div>
				</div><?php */?>
                 <?php /*?><div class="blank15"></div>
                 <div class="rows">
					<label>学生人数:</label>
					<span>
                       <input name="Stock" check="请正确填写学生人数！~*" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);"  type="text" size="10" class="form_input fl" />
                    </span>
					<div class="clear"></div>
				</div><?php */?>
                <div class="rows">
					<label>机构价(元):</label>
					<span>
                       <input name="Price_0" onkeyup="set_number(this, 0);" value="<?=$issue_ary['Price_0']?>" onpaste="set_number(this, 0);"  type="text" size="10" class="input_txt fl" />
                    </span>
					<div class="clear"></div>
				</div>
                <div class="blank15"></div>
                <div class="rows">
					<label>在线价(元):<font class="fc_red" style="font-size:18px;">*</font></label>
					<span>
                       <input name="Price_1" check="请正确填写在线价！~*"  value="<?=$issue_ary['Price_1']?>" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);"  type="text" size="10" class="input_txt fl" />
                    </span>
					<div class="clear"></div>
				</div>
                <div class="blank15"></div>
                <div class="rows">
					<label>居住地区:<font class="fc_red" style="font-size:18px;">*</font></label>
					<span>
                     	<select name="ColorId" class="input_txt" onchange="LoadCircle(this.value)" check="请选择授课地区！~*">
                        	<option value="">请选择</option>
                        	<?php $ColorId = $db->get_all('product_color','1');
								$i=0;
								foreach((array)$ColorId as $item){
									$i==0 && $First_CId=$item['CId'];
									$i++;
							?>
                            	<option value="<?=$item['CId']?>" <?=$issue_ary['ColorId']==$item['CId']?'selected':''?>><?=$item['Color']?></option>
                            <?php }?>
                        </select>
                        <font class="fl">商区:&nbsp;&nbsp;</font>
                        <div class="fl" id="Circle_Select">
                        	<select name="CircleId" class="input_txt">
								<?php 
								$issue_ary['ColorId'] && $First_CId=$issue_ary['ColorId'];
								$circle= $db->get_all('product_circle',"ColorId = '{$First_CId}'");
                                    foreach((array)$circle as $item){
                                ?>
                                    <option value="<?=$item['CId']?>" <?=$issue_ary['CircleId']==$item['CId']?'selected':''?>><?=$item['Circle']?></option>
                                <?php }?>
                            </select>
                        </div>
                    </span>
					<div class="clear"></div>
				</div>
                <div class="blank15"></div>
                <script type="text/javascript">
					function LoadCircle(val){
						jQuery("#Circle_Select").load("/ajax/LoadCircle.php?CId="+val);
					}
				</script>
                <div class="rows">
					<label>视频地址:</label>
					<span>
                       <input name="Video" type="text" size="50" value="<?=$issue_ary['Video']?>" class="input_txt fl" />
                       <!--<span>(推荐使用优酷flash地址上传)</span><span style="display:inline">查看操作</span>-->
                    </span>
                    <div>
                        <div class="fl" style="padding-left:150px;">(推荐使用优酷flash地址上传)</div>
                        <div id="check" class="fl" style="padding-left:30px;font-weight: bold;font-size:14px;">查看操作</div>
                    </div>
                    <div id="check_pic"><img src="/images/vedio_address.jpg" height="300px"/></div>
					<div class="clear"></div>
				</div>
                 <div class="blank15"></div>
                <?php /*?><div class="rows">
					<label>自我介绍:</label>
					<span>
                       <select name="Intro_Type" onchange="show(this.value)" >
                       	<option>-- 请选择 --</option>
                       	<option value="1">默认</option>
                        <option value="2">自定义</option>
                       </select>
                    </span>
					<div class="clear"></div>
				</div><?php */?>
                <input type="hidden" name="Intro_Type" value="2" />
                <div id="Desc" <?php /*?>class="dis"<?php */?>>
                    <div class="item">
                        <span>教学理念：</span><input class="input_txt" name="T_will" maxlength="13" placeholder="请输入13个字内" type="text" value="<?=$issue_ary_ext['Warranty0']?>" />
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <span>教学特长：</span><textarea class="input_trea" name="T_gift"><?=$issue_ary_ext['Warranty1']?></textarea>
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <span>教学经历：</span><textarea class="input_trea" name="T_thought"><?=$issue_ary_ext['Warranty2']?></textarea>
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <span>教学成果：</span><textarea class="input_trea" name="T_success"><?=$issue_ary_ext['Warranty3']?></textarea>
                        <div class="clear"></div>
                    </div>
                    <div class="item">
                        <span>艺术成就：</span><textarea class="input_trea" name="T_ter"><?=$issue_ary_ext['Warranty4']?></textarea>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="blank15"></div>
                <div class="rows">
					<label>授课时间:<font class="fc_red" style="font-size:18px;">*</font></label>
                    <span>
                      <table class="table" cellpadding="1" align="center" cellspacing="1" id="gallery">
                        <tbody>
                            <tr>
                                <th>星期一</th>
                                <th>星期二</th>
                                <th>星期三</th>
                                <th>星期四</th>
                                <th>星期五</th>
                                <th>星期六</th>
                                <th>星期日</th>
                            </tr>
                            <tr>
                            <?php for($i=1;$i<8;$i++){?>
                                <td align="center" <?=in_array($i,$issue_data)?'class="cur"':''?>>早上
                                    <input type="hidden" class="date" value="<?=$i?>" />
                                    <input type="hidden" class="select" name="Selected[]" value="<?=in_array($i,$issue_data)?$i:''?>" />
                                </td>
                            <?php }?>
                            </tr>
                            <tr>
                             <?php for($i=8;$i<15;$i++){?>
                                <td align="center" <?=in_array($i,$issue_data)?'class="cur"':''?>>下午
                               	 	<input type="hidden" class="date" value="<?=$i?>" />
                                    <input type="hidden" class="select" name="Selected[]" value="<?=in_array($i,$issue_data)?$i:''?>" />
                                </td> 
                             <?php }?>
                            </tr>
                            <tr>
                             <?php for($i=15;$i<22;$i++){?>
                                <td align="center" <?=in_array($i,$issue_data)?'class="cur"':''?>>晚上
                                	<input type="hidden" class="date" value="<?=$i?>" />
                                    <input type="hidden" class="select" name="Selected[]" value="<?=in_array($i,$issue_data)?$i:''?>" />
                                </td>
                             <?php }?>
                            </tr>
                        </tbody>
                     </table>
                     <input type="hidden" id="Select_issue" name="Select_issue" value="<?=$issue_data?'1':''?>"  check="请选择授课时间！~*" />
                     <script type="text/javascript">
					 	jQuery('#gallery td').click(
							function(){
								jQuery(this).toggleClass('cur');
								
								if(jQuery(this).find('.select').val()){
									jQuery(this).find('.select').val('');
								}else{
									jQuery(this).find('.select').val(jQuery(this).find('.date').val());
								}
									for(i = 0;i <jQuery('#gallery td .select').length;i++){
										//console.info(jQuery('#gallery td .select').eq(i).val());
										if(jQuery('#gallery td .select').eq(i).val()){
											jQuery('#Select_issue').val(1);
											//alert(jQuery('.select').eq(i).val());
											break;
										}else{
											jQuery('#Select_issue').val('');
										}
									}
									
							}
						);
					 </script>
                    </span>
                  <div class="clear"></div>
				</div>
                <div class="blank20"></div>
				<div class="rows" style="border-bottom:0;">
					<label></label>
					<span><input name="Submit" type="submit" class="sub_rad fl" value="保  存">
					<?php if($issue_ary['SoldOut']){?>
					<a class="sub_rad fr" style=" background:#29aedf;text-align:center; color:#fff;" href="/inc/lib/member/action/mod.php?data=slodin&MemberId=<?=$_SESSION['member_MemberId'];?>">开启约课</a>
					<?php }else{?>
					<a class="sub_rad fr" style="background:#29aedf; text-align:center; color:#fff;" href="/inc/lib/member/action/mod.php?data=slodout&MemberId=<?=$_SESSION['member_MemberId'];?>">停止约课</a>
					<?php }?>
					</span>
					<div class="clear"></div>
				</div>
                <input type="hidden" name="MemberId" value="<?=$_SESSION['member_MemberId'];?>" />
                <!-- 商家账户 -->
                <input type="hidden" name="ProId" value="<?=$ProId;?>" />
				<input type="hidden" name="data" value="member_add_issue" />
                <?php /*?><input type="hidden" name="Intro" id="Intro" check="请选择自我介绍！~*" /><?php */?>
			</form>
		</div>
</div>
<script>
function show(i){
	if(i==2){
		jQuery('#Desc').show(400);
	}
	else{
		jQuery('#Desc').hide(400);
	}
	jQuery('#Intro').val(i);
}
/*function add_wholesale_price_item(obj){
	var newrow=$_(obj).insertRow(-1);
	newcell=newrow.insertCell(-1);
	newcell.innerHTML='&nbsp;&nbsp;&nbsp;课程:&nbsp;&nbsp;'+'<select name="Issue_D[]"><option value="星期一">星期一</option><option value="星期二">星期二</option><option value="星期三">星期三</option><option value="星期四">星期四</option><option value="星期五">星期五</option><option value="星期六">星期六</option><option value="星期日">星期日</option></select>&nbsp;&nbsp;&nbsp;上课时间(如19:30)<input type="text" class="form_input" name="Issue_T[]"  />&nbsp;&nbsp;&nbsp;时间长:<input type="text" class="form_input" name="Issue_L[]"onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" />&nbsp;&nbsp;&nbsp;价格:<input type="text" class="form_input" name="Price[]" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" /><a href="javascript:void(0)" onclick="$_(\'wholesale_price_list\').deleteRow(this.parentNode.parentNode.rowIndex);"><img src="../images/del.gif" hspace="5" /></a><div class="blank15"></div>';
}*/
$(function(){
    $("#check_pic").hide();

    $("#check").click(function(){
        var isNotView=$("#check_pic").is(":hidden");
        if(isNotView){
            $("#check").html("隐藏操作");
            $("#check_pic").show();
        }else{
            $("#check").html("查看操作");
            $("#check_pic").hide();
        }
    });
})
</script>