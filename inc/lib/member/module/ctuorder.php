<?php 
$cur='续课订单';
$OId=$_POST['OId'];
$order_row=$db->get_one('orders',"OId = '$OId'");
$orderItem=$db->get_one('orders_product_list',"OrderId='{$order_row['OrderId']}'");
$product_row=$db->get_one('product', "ProId='{$orderItem['ProId']}'");
$selPrice = $item_price = $orderItem['Price'];
$price_all = $orderItem['Price']*$orderItem['Qty'];
$pro_count += $orderItem['Qty'];
?>
<style>
/*续课表单*/
.ctuForm {//width: 100%; //border-radius: 5px; //border: 1px solid #ebebeb; height: 95px; font-size: 16px; //line-height: 95px; margin-top: 30px; height: 400px;}
.ctuForm h2{background:#efefef;margin-top:5px;font-size: 16px;height:35px;line-height: 35px;}
.ctuForm .price_title {color: #b0b0b0; font-size: 20px; margin-top: 19px; }
.P_1_span {color: #ff7200; font-size: 30px; }
.input2 {float: left; margin: 5px 10px 0px 0px; height: 40px; width: 150px; border: 1px solid #d5d5d5; font-size: 14px; padding-left: 10px; }
.input1xx {float: left; margin-right: 10px; text-indent: 10px; outline: 0; height: 40px; width: 150px; border: 1px solid #d5d5d5; font-size: 16px; color: #999; }
.ctuDate{height:60px; }
.input-span{display:inline-block; }
.input-span span{width: 130px; height: 60px; line-height: 60px; text-align: right; vertical-align: middle; font-size: 14px; display: inline-block; margin-bottom: 25px; }
.input-msg{display:inline-block; margin-left:8px; font-size:16px; }
.finalPrice_info{font-size: 16px;}
.finlPrice{font-size: 16px;}
/* 上课方式样式 */
.P_2{margin-top:5px;height:35px; }
.P_2_ul{padding-left: 0px; }
.P_2_ul .metatit{display: block; width: 55px; line-height: 41px; color: #838383; float:left; }
.P_2_ul li{float:left; margin: 0 4px 4px 0; padding: 1px; position: relative; }
.P_2_ul li a{height:38px; line-height: 38px; border: 1px solid #b8b7bd; padding: 0 9px 0 9px; display: block; width: 50px; }
.P_2_ul li a:hover{border: 2px solid #be0106; margin: -1px; text-decoration: none; color:#333; }
.P_2_ul li .hover{border: 2px solid #be0106; margin: -1px; text-decoration: none; color:#333; }
.P_2_ul li a span{max-width: 97px; }
.P_2_ul li i {position: absolute; bottom: 0; right: 0; width: 12px; height: 12px; overflow: hidden; text-indent: -99em; display: block; background-repeat: no-repeat; background-position: -62px -16px; background-image: url(/images/TB1LBaOHFXXXXaMXFXXBJc1_FXX-114-30.png); }
.P_3{display: none; }
.P_3 .s1{display: block; width: 55px; line-height: 41px; color: #838383; float:left; }
.P_3 .s2{display: block; width: 250px; line-height: 41px; margin-left: 4px; font-size: 16px; float:left; height: 60px;line-height: 60px;} 
.ctuForm dl {height: 60px; border: 1px #fff solid; margin-bottom: 2px; //margin-top: 10px; line-height: 60px; font-family: Arial,helvetica,sans-serif; }
.ctuForm dl dt {width: 130px; text-align: right; float: left; font-size: 18px; }
.ctuForm dl dd {width: 470px; padding-bottom: 1px; margin-left:10px; float: left; font-size: 18px; }
/*结算明细*/
.detail_item {border: 1px solid #ddd; margin: 8px 0; }
.detail_item .tb_title td{border-right:1px solid #ddd; height:28px; font-weight:bold; text-align:center; background:#efefef;}
.detail_item .total td {height: 26px; background: #efefef; text-align: center; color: #B50C08; font-size: 11px; font-weight: bold; }
.detail_item .tb_title .last{border-right:none; }
.detail_item .item_list_over td {background: #f7f7f7; }
.detail_item .item_list td {padding: 7px 5px; border-top: 1px solid #ddd; border-bottom: 1px solid #ddd; border-right: 1px solid #ddd; font-size: 10px; }
.detail_item .item_list td.item_img {border: 1px solid #ccc; padding: 0; background: #fff; }
.detail_item .item_list .last{border-right:none; }
/*结算按钮*/
.ctuBottom a {background: url(/images/buynow.png) no-repeat; line-height: 37px; font-size: 18px; color: #fff; width: 108px; height: 37px; float: left; border: 0px; outline: 0; cursor: pointer; text-align: center; }

.ctuBtn{display: inline-block;float: right; margin-top: 3px; margin-right: 50px;}
.ctuBtn span{margin-right: 10px; padding: 5px 20px; border-radius: 5px; border: 1px solid #E2E2E2; line-height: 37px; font-size: 18px; float: left; background: #f6f5f0; }
.ctuBtn span:hover{text-decoration: none;color:#565656;border:1px solid #be0106;cursor:pointer;}
</style>
<div id="ctuorderMain">
<div class="webpath">
    <div class="fl"><span>当前位置：</span><a href="/">首页</a> > <a href="/account.php?module=index">会员中心</a> > <span class="cur"><?=$cur?></span></div>
    <div class="fr account_web">
    <a href="<?=$account_url?>">个人主页</a>
    </div>
</div>
<!--表单-->
<form action="/ajax/makesure.php" method="post" id="ctuForm">
<input type="hidden" name="act" value="ContinueClass" />
<input type="hidden" name="OId" value="<?=$OId?>" />
<input type="hidden" name="start_time_hls" id="start_time_hls" value="" check="请选择开始时间!~*"/>
<input type="hidden" name="end_time_hls" id="end_time_hls" value="" check="请选择开始时间!~*"/>
<input type="hidden" name="singlePrice" value="" />

<div class="ctuForm">
    <h2>续课订单：</h2>
    <!-- <div class="price_title">——— &nbsp;九啾啾价&nbsp; ———</div> -->
    <dl class="tips-box-text">
        <dt>价格:</dt>
        <dd>
        <span class="P_1_span"></span>&nbsp;&nbsp;<font style="font-size: 14px;">元/小时</font>
        </dd>
    </dl>
    <div class="clear"></div>
    <dl>
        <dt style="font-size:16px;">上课方式:</dt>
        <dd>
        <div class="P_2">
            <ul class="P_2_ul">
                <?php if(!empty($product_row['Price_1']) && $product_row['Price_1'] != 0){ ?>
                <li data='<?=$product_row['Price_1']?>'>
                    <a href="#"><span>老师上门</span></a>
                </li>
                <?php } ?>
                <?php if(!empty($product_row['Price_2']) && $product_row['Price_2'] != 0){ ?>
                <li data='<?=$product_row['Price_2']?>' dataType='student'>
                    <a href="#"><span>学生上门</span></a>
                </li>
                <?php } ?>
                <?php if(!empty($product_row['Price_3']) && $product_row['Price_3'] != 0){ ?>
                <li data='<?=$product_row['Price_3']?>'>
                    <a href="#"><span>协商地点</span></a>
                </li>
                <?php } ?>
            </ul>
        </div>
        </dd>
    </dl>
    <div class="clear"></div>
    <dl class="P_3" style="display: none;">
        <dt style="font-size:16px;">授课地址:</dt>
        <dd>
            <div>
                <span class="s2"><?=$product_row['address_2']?></span>
            </div>
        </dd>
    </dl>
    <div class="clear"></div>
    <dl class="tips-box-text">
        <dt>课时:</dt>
        <dd>
            <input type="text" name="Qty" value="1" style="width: 50px;padding-left: 10px;font-size: 18px;border: 1px solid #ccc;"/>&nbsp;&nbsp;节
            <div class="ctuBtn">
                <span data="4">4 节</span>
                <span data="12">12 节</span>
                <span data="20">20 节</span>
            </div>
        </dd>
    </dl>
    <div class="clear"></div>
    <div class="ctuDate">
        <div class="input-span"><span>预计续课开始日期:</span></div>
        <div class="input-msg" style="position:relative;">
            <input type="text" name="PerTime" id="from_date" onclick="SelectDate(this);" contenteditable="false" check="期望试听时间必须填写!~*" class="input1 on_date runcode" placeholder="请选择日期" style="padding:0px 0 0 5px;text-align:left;//color:#999;line-height:40px;font-size: 14px;width: 120px;    border: 1px solid #ccc;">
            <script type="text/javascript" src="/js/date.js"></script>
            <div class="clear"></div>
        </div>
    </div>
    <div class="clear"></div>
    <dl class="tips-box-text">
        <dt style="font-size:14px;">预计续课时间段:</dt>
        <dd>
            <select  class="input2" onchange="jQuery('#start_time_hls').val(this.value)"><option value="">请选择开始时间</option><option value="07:00">7:00</option><option value="07:30">7:30</option><option value="08:00">8:00</option><option value="08:30">8:30</option><option value="09:00">9:00</option><option value="09:30">9:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:00">23:30</option><option value="00:00">0:00</option><option value="00:30">0:30</option><option value="01:00">1:00</option><option value="01:30">1:30</option><option value="02:00">2:00</option><option value="02:30">2:30</option><option value="03:00">3:00</option><option value="03:30">3:30</option><option value="04:00">4:00</option><option value="04:30">4:30</option><option value="05:00">5:00</option><option value="05:30">5:30</option><option value="06:00">6:00</option><option value="06:30">6:30</option></select>
            <span style="display:block;float:left;line-height: 40px;font-size: 25px;margin:5px 10px 0px 0px;">-</span>                                        
            <select class="input2" onchange="jQuery('#end_time_hls').val(this.value)"><option value="">请选择结束时间</option><option value="07:00">7:00</option><option value="07:30">7:30</option><option value="08:00">8:00</option><option value="08:30">8:30</option><option value="09:00">9:00</option><option value="09:30">9:30</option><option value="10:00">10:00</option><option value="10:30">10:30</option><option value="11:00">11:00</option><option value="11:30">11:30</option><option value="12:00">12:00</option><option value="12:30">12:30</option><option value="13:00">13:00</option><option value="13:30">13:30</option><option value="14:00">14:00</option><option value="14:30">14:30</option><option value="15:00">15:00</option><option value="15:30">15:30</option><option value="16:00">16:00</option><option value="16:30">16:30</option><option value="17:00">17:00</option><option value="17:30">17:30</option><option value="18:00">18:00</option><option value="18:30">18:30</option><option value="19:00">19:00</option><option value="19:30">19:30</option><option value="20:00">20:00</option><option value="20:30">20:30</option><option value="21:00">21:00</option><option value="21:30">21:30</option><option value="22:00">22:00</option><option value="22:30">22:30</option><option value="23:00">23:00</option><option value="23:00">23:30</option><option value="00:00">0:00</option><option value="00:30">0:30</option><option value="01:00">1:00</option><option value="01:30">1:30</option><option value="02:00">2:00</option><option value="02:30">2:30</option><option value="03:00">3:00</option><option value="03:30">3:30</option><option value="04:00">4:00</option><option value="04:30">4:30</option><option value="05:00">5:00</option><option value="05:30">5:30</option><option value="06:00">6:00</option><option value="06:30">6:30</option></select>
        </dd>
    </dl>
    <div class="clear"></div>
     <?php
    if(!$_SESSION['member_IsTeacher']){?>
    <dl class="tips-box-text">
        <dt style="font-size:16px;">我的留言:</dt>
        <dd>
            <textarea id="td_evaluate" name="td_evaluate" placeholder="您可以填写上课后，期望达到的目标，或是对老师的要求。" class="inp" style="width:490px;height:120px; resize:none;"></textarea>
        </dd>
    </dl>
    <?php } else{?>
    <dl class="tips-box-text">
        <dt style="font-size:16px;">续课规划:</dt>
        <dd>
            <textarea id="tea_evaluate" name="tea_evaluate" placeholder="请老师您根据学生情况，填写上整体的课时规划，让学生知悉，等待学生同意。" class="inp" style="width:490px;height:120px; resize:none;"></textarea>
        </dd>
    </dl>  
    <?php } ?>
</div>
<div class="clear"></div>

<!--订单详情-->
<!-- <div class="item_info">订单明细:</div> -->
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="detail_item">
    <tr class="tb_title">
        <td width="14%">图片</td>
        <td width="50%">课程信息</td>
        <td width="12%">价格</td>
        <td width="12%">数量</td>
        <td width="12%" class="last">总价</td>
    </tr>
    <style type="text/css">
    .flh_150{font-size:12px !important;}
    </style>
    <tr class="item_list item_list_out" onmouseover="this.className='item_list item_list_over';" onmouseout="this.className='item_list item_list_out';" align="center">
        <td valign="top"><table width="92" border="0" cellpadding="0" cellspacing="0" align="center"><tr><td height="92" align="center" class="item_img">
        <a href="<?=get_url('product',$orderItem);?>" target="_blank">
            <img width="100" src="<?=$orderItem['PicPath'];?>" />
        </a>
        </td>
    </tr>
</table>    
        <td align="center" class="flh_150">
            老师: <a href="<?=get_url('product',$orderItem);?>" target="_blank" class="proname"><?=$orderItem['Name'];?></a><br /><br />
            科目: <?=$Category[$orderItem['CateId']]['Category']?><br /><br />
        </td>
        <td><span class="singlePrice"><?=iconv_price($item_price);?></span></td>
        <td><span class="proCount"><?=$pro_count?></span></td>
        <td class="last"><span class="calcPrice"><?=iconv_price($price_all);?><span></td>
    </tr>
    <tr class="total">
        <td colspan="3">&nbsp;</td>
        <td><span class="finalPrice_info">总价:</span></td>
        <td><span class="finlPrice"><?=iconv_price($price_all);?></span></td>
    </tr>
</table>
<div class="ctuBottom fr">
    <?php
    if(!$_SESSION['member_IsTeacher']){?>
        <a href='#' onclick="submitCtuForm('student');">付&nbsp;&nbsp;款</a>
    <?php }else{ ?>
        <a href='#' onclick="submitCtuForm('teacher');">发起续课</a>
    <?php } ?>
</div>
</div>
</form>
<script>
var selPrice = "<?=$selPrice?>";
var len = $(".P_2_ul li").length;
$(function() {
    //选中上课方式
    var idx = 0;
    for(var i = 0; i < len; i++){
       var selData = $(".P_2_ul li:eq(" + i +")").attr('data');
       if(selData == selPrice){
            idx = i;
            break;
       }
    }
    if(selPrice == 'select1'){
        idx = 1;
    }
    var selLi = $(".P_2_ul li:eq(" + idx + ")");
    selLi.find('a').addClass('hover');
    selLi.append('<i>已选中</i>');
    $('.P_1_span').html(selLi.attr('data'))
    if(selLi.attr('dataType') == 'student'){
        $('.P_3').show();
    }
    //约课价格
    $('.price_span').html(selLi.attr('data'));
    $("input[name='price']").val(selLi.attr('data'));
    $('.price_detail').html('(' + selLi.find('span').html() + ')');

    //课时节数选择
    $(".ctuBtn span").click(function(){
        var data = $(this).attr("data");
        $("input[name='Qty']").val(data);
        calcForm(data);
    });
})

//上课方式绑定事件
$('.P_2_ul li').each(function(index){
    console.log(index);
    if(index == 0){
         return true;
    }
    $(this).on('click',function(){
    //当前价格
    var data = $(this).attr('data');
    var dataDetail = $(this).find('span').html();
    //清除选项样式
    $('.P_2_ul li').find('a').removeClass('hover');
    $('.P_2_ul li').find('i').remove();
    //选中选项样式
    $(this).find('a').addClass('hover');
    $(this).append('<i>已选中</i>');
    $('.P_1_span').html(data);
    if($(this).attr('dataType') == 'student'){
        $('.P_3').show();
    }else{
        $('.P_3').hide();
    }
    //约课价格
    $('.price_span').html(data);
    $("input[name='price']").val(data);
    $('.price_detail').html("(" +dataDetail + ")");
})
});
$("input[name='Qty']").blur(function(){
    var val = $(this).val();
    if(isNaN(val)){
        $(this).val(1);
    }else if(val == ''){
        $(this).val(0);
    }
    else{
        /*//单价
        var singlePrice = $(".P_1_span").html();
        //总价
        var calcPrice = (val*singlePrice).toFixed(2);
        //折扣总价
        var finlPrice = calcPrice;

        $(".singlePrice").html("¥" + singlePrice);
        $(".proCount").html(val);
        $(".calcPrice").html("¥" + calcPrice);
        $(".finlPrice").html("¥" + finlPrice);*/
        calcForm(val);
    }
});

//显示计算价格
function calcForm(qty){
    //单价
    var singlePrice = $(".P_1_span").html();
    //总价
    var calcPrice = (qty*singlePrice).toFixed(2);
    //折扣总价
    var finlPrice = calcPrice;

    $(".singlePrice").html("¥" + singlePrice);
    $(".proCount").html(qty);
    $(".calcPrice").html("¥" + calcPrice);
    $(".finlPrice").html("¥" + finlPrice);
}

function submitCtuForm(type){
    if(type == "teacher"){
        var text = $("#tea_evaluate").val();
        if(text == null || text == ''){
            alert("请老师您填写整体课时规划！");
            return;
        }
    }
    var qty = $("input[name='Qty']").val();
    var singlePrice = $(".P_1_span").html();
    if(isNaN(qty) || qty == ''){
        return false;
    }
    $("input[name='singlePrice']").val($(".P_1_span").html());
    $("#ctuForm").submit();
}
</script>
