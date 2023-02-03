<style>
.form-gp .input-msg .input2 {float: left; margin-right: 10px; height: 40px; width: 120px; border: 1px solid #d5d5d5; }
.for-on {padding: 0 0 0 20px; background: #f5f5f5; border-bottom: 1px solid #e8e8e8; }
.for-on dd img {width: 150px; height: 150px; border-radius: 50%; border: 2px solid #fff; margin: 20px 24px; }
.for-on dd .spanbr {font-size: 13px; color: #000; line-height: 26px; margin: 60px 20px; text-align: left; }
.price_detail{color:red;margin-right: 10px;display: inline-block;text-indent: 1em;}
</style>
<div id="lib_cart_add_success" style="display:none;">
    <div class="poptrox-popup overfl-pop" id="yk_pop">
        <h1>向<span><?=$product_row['Name']?></span>约课<em>请填写约课信息</em><i class="closeyk-card" onclick="close_cart_add_success();">&times;</i></h1>
        <div class="yk-hls">
            <!-- <h3>所约老师</h3> -->
            <div class="for-on">
                <dl class="clear-fx">
                    <dd><img src="<?=$product_row['PicPath_0']?$product_row['PicPath_0']:'/images/face.jpg'?>"></dd>
                    <dd>
					<div class="spanbr">
                    <span class="t_name"><?=$product_row['Name']?></span><span><?=$ext_row['Applicable']?></span><span><?=$Category[$product_row['CateId']]['Category']?></span><span><strong class="price_span"></strong>元/小时<strong class="price_detail"></strong></span><br><span class="areayk"><span style="color:rgb(121, 121, 121);">上课区域：</span><?=$db->get_value('product_color',"CId
='{$product_row['ColorId']}'",'Color')?></span>
                    </div></dd>
                </dl>
            </div>
			<div class="clear"></div>
            <div class="subform">

				<div class="form-gp las">
				<form action="/ajax/checkout.php" method="post" OnSubmit="return checkForm(this);">
                    <label>学生的学习情况：</label>
                   <div class="input-msg">
                        <input type="text" name="grade_site" class="input1" style="width:491px;" value="请填写学生的学习情况" onfocus="if(this.value==this.defaultValue)this.value=''" onblur="if(this.value=='')this.value=this.defaultValue" check="请填写学生的学习情况!~*" />
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
				<div class="form-gp las">
                    <label>期望试听时间<span style="vertical-align:middle;margin-left: 5px;margin-right:-5px;" class="redstar">*</span>：</label>
                    <div class="input-msg" style="position:relative;">
                        <input type="text" name="PerTime" id="from_date" onclick="SelectDate(this);" contenteditable="false" check="期望试听时间必须填写!~*"  class="input1 on_date runcode"  placeholder="请选择日期" style="padding:0px 0 0 5px;text-align:left;color:#999;line-height:40px;">
                        <script type="text/javascript" src="/js/date.js"></script>
                        <select  class="input2" onchange="jQuery('#start_time_hls').val(this.value)"><option value="">请选择开始时间</option><option value="07:00">7:00</option><option value="07:30">7:30</option><option value="08:00">8:00</option><option value="08:30">8:30</option><option value="09:00">9:00</option><option value="09:30">9:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:00">23:30</option><option value="00:00">0:00</option><option value="00:30">0:30</option><option value="01:00">1:00</option><option value="01:30">1:30</option><option value="02:00">2:00</option><option value="02:30">2:30</option><option value="03:00">3:00</option><option value="03:30">3:30</option><option value="04:00">4:00</option><option value="04:30">4:30</option><option value="05:00">5:00</option><option value="05:30">5:30</option><option value="06:00">6:00</option><option value="06:30">6:30</option></select>
                        <span style="display:block;float:left;line-height: 40px;font-size: 25px;margin-right: 10px;">-</span>                                        
              			<select class="input2" onchange="jQuery('#end_time_hls').val(this.value)"><option value="">请选择结束时间</option><option value="07:00">7:00</option><option value="07:30">7:30</option><option value="08:00">8:00</option><option value="08:30">8:30</option><option value="09:00">9:00</option><option value="09:30">9:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:00">23:30</option><option value="00:00">0:00</option><option value="00:30">0:30</option><option value="01:00">1:00</option><option value="01:30">1:30</option><option value="02:00">2:00</option><option value="02:30">2:30</option><option value="03:00">3:00</option><option value="03:30">3:30</option><option value="04:00">4:00</option><option value="04:30">4:30</option><option value="05:00">5:00</option><option value="05:30">5:30</option><option value="06:00">6:00</option><option value="06:30">6:30</option></select>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
                <div class="form-gp las">
                    <label>备注信息：</label>
                    <div class="input-msg">
                        <textarea id="td_evaluate" name="td_evaluate" placeholder="您可以填写学生期望补习的内容，或是对老师的要求。" class="inp" style="width:490px; resize:none;"></textarea>
                    </div>
                    <div class="clear"></div>
                </div>
				<div class="clear"></div>
            </div>
        </div>
        <div>
			<div style="padding-left: 285px;text-align: left;"><span style="color:#ff9900;">温馨提示：</span>约课成功后，若对该课程不满意，可联系客服申请退款！</div>
            <input type="submit" class="btn-orig" value="提交约课">
            <input type="hidden" name="ProId" value="<?=$ProId?>" />
            <input type="hidden" name="Phone" value="<?=$_SESSION['member_Phone']?>" />
            <input type="hidden" name="data" value="cart_checkout" />
            <input type="hidden" name="price" />
            <input type="hidden" name="_MemberId" value="<?=$_SESSION['member_MemberId']?>" />
            <input type="hidden" name="start_time_hls" id="start_time_hls" value="" check="请选择开始时间!~*"/>
            <input type="hidden" name="end_time_hls" id="end_time_hls" value="" check="请选择开始时间!~*"/>
            </form>
        </div>
	<!-- 续课弹层 start-->
</div>