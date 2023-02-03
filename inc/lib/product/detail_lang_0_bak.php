<?php
//价格
$selPrice = $_GET['selPrice'];
!isset($product_row) && include($site_root_path.'/inc/lib/product/get_detail_row.php');
$ext_row=$db->get_one('product_ext',"ProId = '{$product_row['ProId']}'");
$member_ident=$db->get_one('member_ident',"MemberId='{$product_row['MemberId']}'");
$T_age=$member_ident['T_age'];
//商家账户
$member_info=$db->get_one('member',"MemberId ='{$product_row['MemberId']}'");
if(isset($member_info['is_dealer']) && $member_info['is_dealer'] == '1'){
    $T_age = $product_row['T_age'];
}
//$SumTime=$db->get_sum('product_wholesale_class',"ProId = '{$product_row['ProId']}'",'Issue_L');

//$StudentNum1=$db->get_row_count('orders_product_list',"ProId = '{$product_row['ProId']}'");
$_StudentNum1=mysql_fetch_assoc($db->query("select count(*) as sum from orders_product_list as p left join (select * from orders  where OrderStatus in(2,3,4)) o on p.OrderId = o.OrderId where p.ProId = '{$product_row['ProId']}' and o.OrderStatus in(2,3,4) order by o.OId desc"));
$StudentNum1=$_StudentNum1['sum'];
$_StudentNum2=mysql_fetch_assoc($db->query("select count(*) as sum from order_twos_product_list as p left join (select * from order_twos  where OrderStatus in(2,3,4)) o on p.OrderId = o.OrderId where p.ProId = '{$product_row['ProId']}' and o.OrderStatus in(2,3,4) order by o.OId desc"));
$StudentNum2=$_StudentNum2['sum'];
$StudentNum=$StudentNum1+$StudentNum2;

//续课率
$meet_calss_Count=mysql_fetch_assoc($db->query("SELECT COUNT( DISTINCT (MemberId)) as count FROM orders WHERE ProId ='{$product_row['ProId']}' and OrderStatus = '3'"));
$continue_calss_Count=mysql_fetch_assoc($db->query("SELECT COUNT( DISTINCT (MemberId)) as count FROM order_twos WHERE ProId ='{$product_row['ProId']}' and OrderStatus = '3'"));
$meet_calss_Count=$meet_calss_Count['count'];
$continue_calss_Count=$continue_calss_Count['count'];

$meet_calss_Count && $Continue_rate=$continue_calss_Count/$meet_calss_Count*100;
//$db->get_all('order_twos',"ProId ='{$product_row['ProId']}' and OrderStatus = '3'",'DISTINCT(MemberId)');
//评论
$review_good=$db->get_row_count('product_review',"ProId ='{$product_row['ProId']}' and Review_Level='5'");
$review_all=$db->get_row_count('product_review',"ProId ='{$product_row['ProId']}'");
$review_all && $review_rate=($review_good/$review_all)*100;
$review_sum=$db->get_sum('product_review',"ProId ='{$product_row['ProId']}'",'Review_Level');
ob_start();
?>
<?php 
if(!$member_info['IsTeacher']){ 
?>
<div class="approve_tips">
     您在本平台还没有上线，家长暂时还无法看到您的这个页面，请利用当前时间尽可能的完善您的资料，以便届时让您的个人主页对学生和家长充满吸引力,吸引家长和学生向您约课。
     <br>
     上线步骤：提交认证资料——通过审核认证——平台上线老师——家长学生可搜索到老师查看老师个人主页 
</div>
<?php } ?>
<div id="custom_product_detail">
    <div class="P_one relative">
        <div class="l">
            <div class="PicPath">
                <img width="160" src="<?=$product_row['PicPath_0']?$product_row['PicPath_0']:'/images/face.jpg';?>" alt="<?=$product_row['Name']?>" />
                <span></span>
            </div>
            <div class="ItemNumber">教师ID:<?php echo sprintf('%08s',$product_row['ProId'])?></div>
            <div class="atten"><a href="<?=$member_url_cn?>?module=wishlists&act=add&ProId=<?=$product_row['ProId']?>&CateId=<?=$product_row['CateId']?>">+&nbsp;关注</a></div>
        </div>
        <div class="c">
            <div class="info_cer">
                <span class="name"><?=$product_row['Name']?></span>
                <?php if($member_info['MemberLevel']==3){?>
                    <a title="每个季度好评课时数超过192的老师，将获得金牌老师荣誉称号"><img class="pai" src="/images/jinpai.jpg" alt="每个季度好评课时数超过192的老师，将获得金牌老师荣誉称号" /></a>
                <?php }elseif($member_info['MemberLevel']==4){?>
                    <a title="每个季度好评课时数超过96的老师，将获得银牌牌老师荣誉称号"><img class="pai2" src="/images/yinpai.png" alt="每个季度好评课时数超过96的老师，将获得银牌牌老师荣誉称号" /></a>
                <?php }elseif($member_info['MemberLevel']==5){?>
                    <a title="每个季度好评课时数超过48的老师，将获得铜牌老师荣誉称号"><img class="pai2" src="/images/tongpai.png" alt="每个季度好评课时数超过48的老师，将获得铜牌老师荣誉称号" /></a>
                <?php }?>
                <div class="fr">
                <?php 
                    if($product_row['Identity']){echo '<img src="/images/shenfen.jpg" />&nbsp;';}
                    if($product_row['Degree']){echo '<img src="/images/xueli.jpg" />&nbsp;';}
                    if($product_row['Certification']){echo '<img src="/images/zhuanye.jpg" />&nbsp;';}      
                ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="cate">
                教学科目:&nbsp; &nbsp;<?=$Category[$product_row['CateId']]['Category']?> 
            </div>
            <div class="furture">
                <img src="/images/dou_left.png" />&nbsp;&nbsp;<?=$ext_row['Warranty0']?>&nbsp;&nbsp;<img src="/images/dou_right.png" />
            </div>
            <div class="teacher_par">
                <span>教龄:</span><span>&nbsp;<?=$T_age?>年</span>&nbsp;&nbsp;|&nbsp;&nbsp;
                <span>性别:</span><span>&nbsp;<?=$product_row['Title']?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
                <!-- <span>年龄:</span><span>&nbsp;<?=(int)date('Y',$service_time)-(int)$member_info['Brithday']?>岁</span>&nbsp;&nbsp;
                |&nbsp;&nbsp; -->
                <span><img style="width:20px;" src="/images/location.png" /></span>
                <span>
                    <?=$db->get_value('product_color',"CId='{$product_row['ColorId']}'",'Color')?>
                    <?=$db->get_value('product_circle',"CId='{$product_row['CircleId']}'",'Circle') == '' ? '' : '- '.$db->get_value('product_circle',"CId='{$product_row['CircleId']}'",'Circle')?>
                </span>             
           </div>
            <div class="teach_info">
                <div class="par_0"><span><?=$review_rate?$review_rate:'100'?>%</span><font>好评率</font></div>
                <div class="par_3"><span><?=$Continue_rate?>%</span><font class="right">续课率</font></div>
                <div class="blank8"></div>
                <div class="par_2"><span><?=$StudentNum?>h</span><font>授课时长</font></div>
                <div class="par_1"><span><?=$StudentNum1?>人</span><font class="right">学生总数</font></div>
            </div>
        </div>
        <div class="r">
            <div class="review_star">
                <span style=" display:block; float:left; margin-left:66px;width:98px; height:17px; background:url(/images/star.png) -100px 60px;">
                              <span style=" display:block; float:left; width:<?=$review_all?($review_sum/($review_all*5))*100:'0'?>%;height:17px; background:url(/images/star.png) 0px 140px;"></span>
                  </span>
                
                <span style="margin-left: 15px;">(<?=$review_all?>条评论)</span>
            </div>
            <div class="price_title">——— &nbsp;九啾啾价&nbsp; ———</div>
            <!-- <div class="P_0"><del>机构价:<?=$product_row['Price_0']==''?'':$product_row['Price_0']?></del></div>-->            
            <div class="P_1"><span class="P_1_span"></span>&nbsp;&nbsp;<font>元/小时</font></div>
            <div class="P_2">
                <ul class="P_2_ul">
                    <li>
                        <span class="metatit">上课方式</span>
                    </li>
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
            <div class="clear"></div>
            <div class="P_3"><span class="s1">授课地址</span><span class="s2"><?=$product_row['address_2']?></span></div>
            <iframe name="addtocart_iframe" id="addtocart_iframe" src="about:blank" style="display:none;"></iframe>
            <div class="Detail relative">
                <input type="submit" value="向TA约课" class="add" onclick="<?php if($_SESSION['member_MemberId']!=$product_row['MemberId']){?>addclass(<?=$_SESSION['member_MemberId']?>);<?php }else{?> alert('自己不可约自己！')<?php }?>" />
                <a  href="javascript://" onclick="course_mast(1)" class="look">授课时间</a>
            </div>
        </div>
        <div class="course_bg"><!-- 课程表 -->
            <div class="course over">
            <div class="t">
                可授课时间  <a href="javascript://"><img onclick="course_mast(2)" src="images/course_jian.jpg"></a>
            </div>
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
                    <?php 
                        $date_ary=explode('|',$product_row['Date']);
                    ?>
                    
                    <tr>
                    <?php for($i=1;$i<8;$i++){
                            $cur='';
                            in_array($i,$date_ary) && $cur='class="cur"';
                    ?>
                        <td align="center" <?=$cur?>>早上</td>
                    <?php }?>
                    </tr>
                     <tr>
                     <?php for($i=8;$i<15;$i++){
                            $cur='';
                            in_array($i,$date_ary) && $cur='class="cur"'; 
                        ?>
                        <td align="center" <?=$cur?>>下午</td>
                     <?php }?>
                    </tr>
                    <tr>
                     <?php for($i=15;$i<22;$i++){
                            $cur='';
                            in_array($i,$date_ary) && $cur='class="cur"';
                        ?>
                        <td align="center" <?=$cur?>>晚上</td>
                     <?php }?>
                    </tr>
                    
                   <?php /*?> <?php $product_wholesale_class_row=$db->get_all('product_wholesale_class', "ProId='$ProId'", '*', 'PId asc');
                        foreach((array)$product_wholesale_class_row as $item){
                            $all_L+=$item['Issue_L'];
                    ?>
                    <tr>
                        <td align="center"><?=$item['Issue_T'];?></td>
                        <td align="center"><?=$item['Issue_L'];?></td>
                    </tr>
                     <?php }?><?php */?>
                </tbody>
             </table>
             <div class="blank15"></div>
             <?php /*?><div><strong>总课时:</strong>&nbsp;&nbsp;&nbsp;<span class="fc_red"><?=$all_L?></span></div>
             <div class="blank15"></div><?php */?>
            </div>
         </div>
    </div>
    <div class="clear"></div>
        
    <script type="text/javascript">
        function course_mast(i){
            if(i==1){
                jQuery('.course').slideDown(1000);
            }
            if(i==2){
                jQuery('.course').slideUp(1000);
            }   
        }
    </script>
    <!-- Part2 -->
    <div class="P_two">
        <div style="height:51px; position:relative;">
        <div class="Pmeua" id="Pmeua">
            <a class="first cur" href="#P_two">自我介绍</a>
            <a class="second" href="#P_three">教学记录</a>
            <a class="third" href="#P_four">家长评价</a>
            <a class="fourth" href="#P_five">视频展示</a>
        </div>
        </div>
        <div class="desc" id="P_two">
            <?php //echo $db->get_value('product_description',"ProId = '{$product_row['ProId']}'",'Description');?>
            <?php for($i=0;$i<5;$i++){
                if($ext_row['Warranty'.$i]=='') continue;   
            ?>
                <div class="Desctips"><img src="/images/desc_<?=$i?>.jpg" /></div>
                <div class="desc_content"><?=nl2br($ext_row['Warranty'.$i]);?></div>
            <?php }?>
        </div>
    </div>
     <div class="line"></div>
     <script type="text/javascript">
        jQuery('#Pmeua').find('a').click(
            function(){
                jQuery('#Pmeua').find('a').removeClass('cur');
                jQuery(this).addClass('cur');
            }
        )
        window.onscroll = function(){
            var t = document.documentElement.scrollTop || document.body.scrollTop; 
            if(t >= 475 ) {
                jQuery('#Pmeua').css({position:'fixed',top:'-25px'});
            }else{
                jQuery('#Pmeua').css({position:'absolute',top:'0px'});
            }
            if(t>parseInt(jQuery('#custom_product_detail').css('height').replace('px',''))) {
                jQuery('#Pmeua').css({position:'absolute',top:'0px'});
            }
            //console.info(123);
        }
        
     </script>
    <!-- Part3 -->
    <div class="P_three">
        <div class="title" id="P_three">教学记录</div>
        <?php 
            $th_ary=array('课程ID','课程类型','学生','教学科目','课时数','操作');
            //$continue_row=$db->get_all('orders',"");
            $where="p.ProId = '{$product_row['ProId']}' and o.OrderStatus in(2,3,4)";
            $continue_rs=$db->query("select p.*,1 as c,o.Shipping_Name,o.OId from orders_product_list as p left join (select * from orders  where OrderStatus in(2,3,4)) o on p.OrderId = o.OrderId where $where group by o.OId order by o.OId desc");
            while($result=mysql_fetch_assoc($continue_rs)){
                $continue_row[]=$result;
            }
            //var_dump($continue_row[1]);
            $continue_rs=$db->query("select p.*,2 as c,o.Shipping_Name,o.OId,o.CateId from order_twos_product_list p left join (select * from order_twos o where o.OrderStatus in(2,3,4)) o on p.OrderId = o.OrderId where $where group by o.OId order by o.OId desc");
            while($result=mysql_fetch_assoc($continue_rs)){
                $continue_row[]=$result;
            }
            
            //var_dump($continue_row);
            //var_dump($continue_row);
        ?>
        <table width="100%" border="0" cellpadding="0" cellspacing="0" class="item_list" style="border-bottom:none;">
                    <tbody>
                    <tr class="tb_title">
                        <td style="border-bottom:1px solid #ddd;" width="5%">课程ID</td>
                        <td style="border-bottom:1px solid #ddd;" width="20%">课程类型</td>
                        <td style="border-bottom:1px solid #ddd;" width="15%">学生</td>
                        <td style="border-bottom:1px solid #ddd;" width="15%">教学科目</td>
                        <td style="border-bottom:1px solid #ddd;" width="15%">课时数</td>
                        <?php /*?><td style="border-bottom:1px solid #ddd; border-right:none;" width="10%">操作</td><?php */?>
                    </tr>
                    <?php for($i=0;$i<count($continue_row);$i++){?>
                    <tr align="center" bgcolor="#ffffff">
                        <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;" height="28"><?=$continue_row[$i]['OId']?></td>
                        <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;"><?=$continue_row[$i]['c']=='1'?'约课':'续课'?></td>
                        <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;"><?=$continue_row[$i]['Shipping_Name']?></td>
                        <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;"><?=$Category[$continue_row[$i]['CateId']]['Category']?></td>
                        <td style="border-bottom:1px solid #ddd; border-right:1px solid #ddd;"><?php if($continue_row[$i]['c']==1){echo $db->get_row_count('orders_product_list',"OrderId ='{$continue_row[$i]['OrderId']}'");}else{echo $db->get_row_count('order_twos_product_list',"OrderId ='{$continue_row[$i]['OrderId']}'");}?></td>
                        <?php /*?><td style="border-bottom:1px solid #ddd;" nowrap="nowrap"><a href="orders.php?del=1&amp;OId=2015012802102390" style="margin-left:10px;" onclick="return c_del(this);">续课无授课计划与目标</a>&nbsp;</td><?php */?>
                    </tr>
                    <?php }?>
                    </tbody>
       </table>
    </div>
    <div class="line"></div>
    <!-- Part4 -->
    <div class="P_four">
        <div class="title" id="P_four">
            <span class="span0">家长评价</span><span class="span1">(&nbsp;默认评论不显示&nbsp;)</span> 
            <div class="ave">
                <span class="span2">综合评价:</span> 
                <span class="span3">
                    <span style=" display:block; float:left; margin-top:9px;width:98px; height:17px; background:url(/images/star.png) -100px 60px;">
                      <span style=" display:block; float:left; width:<?=$review_all?($review_sum/($review_all*5))*100:'0'?>%;height:17px; background:url(/images/star.png) 0px 140px;"></span>
                    </span>
                </span>
                <span class="span4"><?=$review_all?$review_sum/$review_all:'0'?>分</span>
                <span class="span5">(&nbsp;<?=$db->get_row_count('product_review',"ProId = '{$product_row['ProId']}'")?>条评价&nbsp;)</span>
            </div>
        </div>
        <div class="clear"></div>
        
        <div class="type_review">
            <div id="lib_product_review"></div>
            <iframe src="/inc/lib/product/review_en.php?ProId=<?=$product_row['ProId'];?>" style="display:none;"></iframe>
        </div>
        <script type="text/javascript">
            function review_show(obj){
                jQuery(obj).siblings().removeClass('cur');
                jQuery(obj).addClass('cur');
                jQuery('.level').hide();
                jQuery('.level').eq(jQuery(obj).index()).show();
            }
        </script>
    </div>
     <div class="line"></div>
    <!-- Part5 -->
    
    <div class="P_five">
        <div class="title" id="P_five">视频展示</div>
        <?php if($product_row['Video']){?>
        <div class="cont">
            <embed src="<?=$product_row['Video']?>" width="600" height="498" type="application/x-shockwave-flash"> </embed>
        </div>
        <?php }?>
    </div>
     <div class="line"></div>
     <div class="P_six">
        <div class="title">哪些同学选择了他 / 她</div>
        <div id="wrap4" class="wrap" style="height:170px;">
                    <ul class="item">
                    <?php
                        
                        $query=$db->query("select MemberId from orders where OrderStatus in(2,3,4) and TeacherId = '{$product_row['MemberId']}' group by TeacherId union select MemberId from order_twos where OrderStatus in(2,3,4) and TeacherId = '{$product_row['MemberId']}' group by TeacherId");
                        //echo "select MemberId from orders where OrderStatus in(2,3,4) and TeacherId = '{$product_row['MemberId']}' union select MemberId from order_twos where OrderStatus in(2,3,4) and TeacherId = '{$product_row['MemberId']}'";
                        while($result=mysql_fetch_assoc($query)){
                            $order_row[]=$result;
                        }
                        //$order_row=$db->get_limit('orders',"TeacherId = '{$product_row['MemberId']}'",'MemberId');
                        //var_dump($order_row);
                        
                        for($i=0;$i<count($order_row);$i++){
                            $student_row=$db->get_one('member',"MemberId = '{$order_row[$i]['MemberId']}'",'Face,MemberId,ID,UserName,State');
                            //var_dump($student_row);   
                        ?>
                        <li>
                            <div class="PicPath">
                                <a href="/student.php?MemberId=<?=$student_row['MemberId']?>"><img width="150" src="<?=$student_row['Face']?$student_row['Face']:'/images/face.jpg'?>" alt="<?=$student_row['UserName']?>" /></a>
                                <span></span>
                            </div>
                            <div class="name"><?=$student_row['UserName']?$student_row['UserName']:$student_row['ID']?></div>
                            <div class=""> <img src="/images/pro_address_tips.jpg" /> <?=$student_row['State']?> </div>
                        </li>
                        <?php }?>
                    </ul>
            </div>
            <img src="/images/pro_bottom_left.jpg" id="prev4" alt="prev" />
            <img src="/images/pro_bottom_right.jpg" id="next4" alt="next" />
            </div>
        </div>
    </div>

<style>
/* 上课方式样式 */
.P_2{margin: 5px 5px; height:35px; }
.P_2_ul{padding-left: 0px; }
.P_2_ul .metatit{display: block; width: 55px; line-height: 41px; color: #838383; float:left; }
.P_2_ul li{float:left; margin: 0 4px 4px 0; padding: 1px; position: relative; }
.P_2_ul li a{height:38px; line-height: 38px; border: 1px solid #b8b7bd; padding: 0 9px 0 9px; display: block; width: 50px; }
.P_2_ul li a:hover{border: 2px solid #be0106; margin: -1px; text-decoration: none; color:#333; }
.P_2_ul li .hover{border: 2px solid #be0106; margin: -1px; text-decoration: none; color:#333; }
.P_2_ul li a span{max-width: 97px; }
.P_2_ul li i {position: absolute; bottom: 0; right: 0; width: 12px; height: 12px; overflow: hidden; text-indent: -99em; display: block; background-repeat: no-repeat; background-position: -62px -16px; background-image: url(/images/TB1LBaOHFXXXXaMXFXXBJc1_FXX-114-30.png); }
.P_3{display: none; margin: 5px 5px 0px; height:35px; }
.P_3 .s1{display: block; width: 55px; line-height: 41px; color: #838383; float:left; }
.P_3 .s2{display: block; width: 250px; line-height: 41px; margin-left: 4px; font-size: 14px; float:left; } 
</style>

<script type="text/javascript">
        var selPrice = <?=$selPrice?>;
        var len = $(".P_2_ul li").length;
        $(function() {
            $('#wrap4').marquee({
                auto: false,
                speed: 1000,
                showNum: 6,
                stepLen: 1,
                prevElement: $('#prev4'),
                nextElement: $('#next4')
            });

            //选中上课方式
            var idx = 0;
            for(var i = 0; i < len; i++){
               var selData = $(".P_2_ul li:eq(" + i +")").attr('data');
               if(selData == selPrice){
                    idx = i;
                    break;
               }
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
          
        })


        /*$('.P_2_ul li').on('click',function(){
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
        })*/
</script>
     </div>
</div>
<?php include($site_root_path.'/inc/alert.php');?>
<script type="text/javascript">
    function addclass(i){
        if(i){
            div_mask();
            jQuery('#lib_cart_add_success').show();
            $_('lib_cart_add_success').style.left=(parent.document.documentElement.scrollLeft || parent.window.pageXOffset || parent.document.body.scrollLeft)+parent.doc.clientWidth/2-parent.$_('lib_cart_add_success').offsetWidth/2+'px';
            $_('lib_cart_add_success').style.top=(parent.document.documentElement.scrollTop || parent.window.pageYOffset || parent.document.body.scrollTop)+parent.doc.clientHeight/2-parent.$_('lib_cart_add_success').offsetHeight/2-50+'px';
        }else{
            var error_info='请登录会员';
            pop_info_tips(error_info);
        }
    }
    close_cart_add_success=function(){  //关闭弹出窗口
        window.top.document.body.removeChild(parent.$_('div_mask'));
        jQuery('#lib_cart_add_success').hide();
    }
    
</script>
<?php
$product_detail_lang_0=ob_get_contents();
ob_end_clean();
?>