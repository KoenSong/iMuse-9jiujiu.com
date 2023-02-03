<?php
$cur='账号设置';
$holder_info = $db->get_one('member_holder',$where);
$bank_row = $db->get_all('translate','1','LId,Name,LogoPath','MyOrder desc,LId asc');
for($i=0,$ilen=count($bank_row);$i<$ilen;$i++){
	$bank_ary[$bank_row[$i]['LId']] = $bank_row[$i];
}

//提现记录
$turn_page_query_string=$website_url_type==0?"?$query_string&page=":'page-';
$page_count=5;
$row_count=$db->get_row_count('member_withdraw', 'MemberId = '.$_SESSION['member_MemberId']);
$total_pages=ceil($row_count/$page_count);
$page=(int)$_GET['page'];
$page<1 && $page=1;
$page>$total_pages && $page=1;
$start_row=($page-1)*$page_count;
$products=$db->get_limit('member_withdraw', 'MemberId = '.$_SESSION['member_MemberId'], '*', $order=1, $start_row, $page_count);


?>
<style>
	.subform{ position:relative;}
	#success_alt{ background-color:#000; opacity:0.7;filter:alpha(opacity=70); color:#fff; font-size:14px; width:109px; height:64px; line-height:180%; padding:48px; border:3px solid #CCC; position:absolute; left:242px; top:20px; display:none;}
    .bg{display: block; width: 32px; height: 32px; margin: 20px auto 5px; background-position: 0 -2415px; } 
    .bg{background-image: url(/images/bg-s1655eea543.png); background-repeat: no-repeat;}
    .addBank{display:block;text-align:center;font-size:14px;color: #5b9fe2;font-weight: 700;}
    .addBankA{color: #5b9fe2;}
    .addBankA:hover{text-decoration:none;}
    .bankTop img{width:100px;margin-right:5px;}
    .bankTop span{margin-top:10px;margin-right:5px;display:block;float:right;font-size:14px;font-weight:700;color:#323232;} 
    .bankBottom{margin-top:-10px;}
    .bankBottom .fl{margin-right: 5px;}
    .bankBottom .fr{margin-top:35px;margin-right: 8px;}
    .bankBottom .fr a{display:none;}
    .cardmodel:hover{border:1px solid #8cb5de;;}
    .cardmodel:hover .bankBottom .fr a{display:block;color:#8cb5de;text-decoration:none;}
    .cashTitle{margin:15px 10px;}
    .cashTitle h3{font-size: 16px;font-weight: bold;}
    .cashTitleTap{color:red;}
</style>
<!--资金账户开始-->
<div id="lib_member_profile">
	<div class="webpath">
    	<div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
		<div class="fr account_web">
       	<a href="<?=$account_url?>">个人主页</a>
		</div>
    </div>
    <div class="form lib_member_item_card">
        <form action="/inc/lib/member/action/mod.php" method="post"  name="member_profile_form" OnSubmit="return checkForm(this);">
            <div class="lib_member_sub_title">更改您的个人信息</div>
            <div class="rows">
                <label>会员类型: </label>
                <span>
                    <?=$member_info['IsTeacher'] || $member_info['Apply']?'教师会员':'个人会员'?>
                </span>
                <div class="clear"></div>
            </div>
            <div class="money_info fl">
                现金余额<span><?=$member_info['Account_Price']?></span>元
                <a href="<?=$member_url_cn?>?module=addprice" style="margin:0 20px;">充值</a>
                <?php if((int)$holder_info['Holder_Num']){?>
                	<a href="<?=$member_url_cn?>?module=withdraw">提现</a>
                <?php }else{?>
                	<a href="javascript://" onclick="alert('请绑定银行卡！')">提现</a>
                <?php }?>
            </div>
            <div class="cardbang fl" onmouseover="this.className='cardbang fl hover'" onmouseout="this.className='cardbang fl'">
                <div class="mycard">我的银行卡</div>
                <div class="cardmodel fl">
                    <?php if(!empty($bank_ary[$holder_info['Holder_Bank']]['LogoPath'])){ ?>
                    <div>
                        <div class="bankTop">
                            <img src="<?=$bank_ary[$holder_info['Holder_Bank']]['LogoPath']?>"/>
                            <span>尾号<?=substr($holder_info['Holder_Num'],-4)?></span>
                        </div>
                        <div class="bankBottom">
                            <div class="fl">
                                <p style="text-indent: 5px;color: #8f8f8f;">持卡人姓名：<?=$holder_info['Holder_UserName']?></p>
                                <p style="text-indent: 5px;color: #8f8f8f;">手机号：<?=substr($_SESSION['member_Phone'],0,3)?>****<?=substr($_SESSION['member_Phone'],-4)?></p>
                            </div>
                            <div class="fr">
                                <a href="#" onclick="addclass();">修改</a>
                            </div>
                        </div>
                    </div>
                    <?php }else{?>
                    <div>
                        <span class="bg"></span>
                        <span class="addBank">
                            <a href="javascript:void(0);" class="addBankA" onclick="addclass();">添加银行卡</a>
                        </span>
                    </div>
                    <?php } ?>
                </div>
                <!-- <a href="javascript:void(0);" class="fl mody" onclick="addclass();">修改</a> -->	
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </form>
        <!--提现记录开始-->
        <div id="lib_member_orders">
        <div class="cashTitle">
            <h3>提现记录 <font class="cashTitleTap">(申请提现后，3-5个工作日将结算到您的银行卡，请查收！)</font></h3>
        </div>
        <table width="100%" border="0" cellpadding="0" c cellspacing="0" class="item_list">
            <tbody>
            <tr class="tb_title">
                <td>序号</td>
                <td>提现金额</td>
                <td>提现卡号</td>
                <td>时间</td>
                <td>状态</td>
            </tr>
            <?php 
            for($idx = 0; $idx < count($products); $idx++){ ?>
            <tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
                <td><?=($idx + 1) ?></td>
                <td>￥<?=$products[$idx]['Price'] ?></td>
                <td>尾号<?=substr($holder_info['Holder_Num'],-4)?></td>
                <td><?=date("Y-m-d H:i", $products[$idx]['PostTime'])?> </td>
                <td><?=$products[$idx]['Status'] == '0' ? '待审核' : '已提现'?></td>
                
            </tr>
            <?php }?> 
            </tbody>
        </table>
        <form action="/account.php?module=price&act=list" method="get">
            <div id="turn_page" class="relative"><?=turn_page_ext($page, $total_pages, 'account.php?module=price&page=', $row_count,'&nbsp;上一页', '下一页&nbsp;&nbsp;', 'account.php?module=price&');?>
            <?php if($total_pages>=1){ ?>
                <span>跳转:&nbsp;</span>
                <input type="text" class="input_type2" name="page" value="" />
                <input type="image" class="search_sub" src="/images/member_page.jpg" />
            <?php } ?>
            </div>
        </form> 
        </div>
        <!--提现记录结束-->
    </div>
</div>
<!--资金账户结束-->




<!--填写开户人信息开始-->
<div id="lib_cart_add_success" style="left:484px; top:70px !important; display:none;">
    <div class="poptrox-popup overfl-pop" id="yk_pop">
        <h1><span>绑定银行卡</span><i class="closeyk-card" onclick="close_cart_add_success();">&times;</i></h1>
        <div class="subform" style="margin-top:35px;">
            <form action="" method="post" OnSubmit="return checkForm(this);" id="holder_form">
            <div class="form-gp las">
                <label>开户人姓名：</label>
               <div class="input-msg">
                    <input type="text" name="Holder_UserName" class="input1" style="width:200px;" value="<?=$holder_info['Holder_UserName']?>" onfocus="if(this.value=='请填写开户人姓名')this.value=''" onblur="if(this.value=='')this.value='请填写开户人姓名'" check="请填写开户人姓名!~*" id="Holder_UserName"/>
                    <span style="color:red;line-height: 30px;font-size: 14px;">(请与银行卡上持卡人姓名一致)</span>
                </div>
            </div>
            <div class="clear"></div>
            

            <div class="form-gp las">
                <label>开户银行所在城市：</label>
               <div class="input-msg">
                    <select style="height:30px;" name="Holder_City" id="Holder_City">
                    <?php 
                        //print_r($alter_city);
                        $holder_city = $db->get_all('product_color','1','CId,Color','MyOrder desc,CId asc');
                        for($i=0,$ilen=count($holder_city);$i<$ilen;$i++){ 
                    ?>
                        <option value="<?=$holder_city[$i]['CId']?>"<?=$holder_info['Holder_City']==$holder_city[$i]['CId']?' selected="selected"':''?>><?=$holder_city[$i]['Color']?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
            
            
            <div class="form-gp las">
                <label>选择银行：</label>
               <div class="input-msg">
                    <select style="height:30px;" name="Holder_Bank" check="请选择银行!~*" id="Holder_Bank">                      	
                        <?php 
                            for($i=0,$ilen=count($bank_row);$i<$ilen;$i++){ 
                        ?>
                            <option value="<?=$bank_row[$i]['LId']?>" <?=$holder_info['Holder_Bank']==$bank_row[$i]['LId']?' selected="selected"':''?>><?=$bank_row[$i]['Name']?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="clear"></div>
            
            
            <!-- <div class="form-gp las">
                <label>开户行详细名称：</label>
               <div class="input-msg">
                    <input type="text" name="Holder_Detail" class="input1" style="width:491px;" value="<?=$holder_info['Holder_Detail']?$holder_info['Holder_Detail']:'请输入开户行详细名称'?>" onfocus="if(this.value=='请输入开户行详细名称')this.value=''" onblur="if(this.value=='')this.value='请输入开户行详细名称'" check="请输入开户行详细名称!~*" id="Holder_Detail"/>
                </div>
            </div> -->
            <div class="clear"></div>
            
            <div class="form-gp las">
                <label>银行卡号：</label>
               <div class="input-msg">
                    <input type="text" name="Holder_Num" class="input1" style="width:300px;" value="<?=$holder_info['Holder_Num']?$holder_info['Holder_Num']:'请输入银行卡号'?>" onfocus="if(this.value=='请输入银行卡号')this.value=''" onblur="if(this.value=='')this.value='请输入银行卡号'" check="请输入银行卡号!~*" id="Holder_Num"/>
                </div>
            </div>
            <div class="clear"></div>
            
            <input type="button" class="btn-orig" value="提交绑定" onclick="PostHolder();" style="cursor:pointer;">

            <?php /*?><input type="hidden" name="Phone" value="<?=$_SESSION['member_Phone']?>" />
            <input type="hidden" name="data" value="cart_checkout" /><?php */?>
            </form>
            <div id="success_alt">恭喜，绑定银行卡操作成功！</div>
        </div>
    </div>
</div>
<!--填写开户人信息结束-->

<script type="text/javascript">
	function PostHolder(){
		jQuery.post(
			'/ajax/holder_form_post.php',
			{
				Holder_UserName:jQuery('#Holder_UserName').val(),
				Holder_City:jQuery('#Holder_City').find('option:selected').val(),
				Holder_Bank:jQuery('#Holder_Bank').find('option:selected').val(),
				Holder_Detail:jQuery('#Holder_Detail').val(),
				Holder_Num:jQuery('#Holder_Num').val()	
			},
			function(data){
				if(data){
					jQuery('#success_alt').show();
					window.setTimeout( "window.location = '<?=$_SERVER['REQUEST_URI']?>'",2000);
				}
			}
		);
	}
	function addclass(){
		div_mask();
		jQuery('#lib_cart_add_success').show();
		$_('lib_cart_add_success').style.left=(parent.document.documentElement.scrollLeft || parent.window.pageXOffset || parent.document.body.scrollLeft)+parent.doc.clientWidth/2-parent.$_('lib_cart_add_success').offsetWidth/2+'px';
		$_('lib_cart_add_success').style.top=(parent.document.documentElement.scrollTop || parent.window.pageYOffset || parent.document.body.scrollTop)+parent.doc.clientHeight/2-parent.$_('lib_cart_add_success').offsetHeight/2-50+'px';
	}
	close_cart_add_success=function(){	//关闭弹出窗口
		window.top.document.body.removeChild(parent.$_('div_mask'));
		jQuery('#lib_cart_add_success').hide();
	}
	
</script>


