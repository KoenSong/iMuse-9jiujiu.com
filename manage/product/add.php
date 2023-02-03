<?php
include('../../inc/site_config.php');
include('../../inc/set/ext_var.php');
include('../../inc/fun/mysql.php');
include('../../inc/function.php');
include('../../inc/manage/config.php');
include('../../inc/manage/do_check.php');

check_permit('product', 'product.add');

$pro_row=$db->get_all('product','1');

if($_POST){
	$save_dir=get_cfg('ly200.up_file_base_dir').'product/'.date('y_m_d/', $service_time);
	$Name=$_POST['Name'];
	$CateId=$db->get_row_count('product_category')>1?(int)$_POST['CateId']:$db->get_value('product_category', 1, 'CateId');
	$ItemNumber=$_POST['ItemNumber'];
	$Model=$_POST['Model'];
	$IsInIndex=(int)$_POST['IsInIndex'];
	$IsHot=(int)$_POST['IsHot'];
	$IsRecommend=(int)$_POST['IsRecommend'];
	$IsNew=(int)$_POST['IsNew'];
	$SoldOut=(int)$_POST['SoldOut'];
	$ColorId=get_cfg('product.color_ele_mode')?('|'.@implode('|', $_POST['ColorId']).'|'):(int)$_POST['ColorId'];
	$SizeId=get_cfg('product.size_ele_mode')?('|'.@implode('|', $_POST['SizeId']).'|'):(int)$_POST['SizeId'];
	$CircleId=get_cfg('product.circle_ele_mode')?('|'.@implode('|', $_POST['CircleId']).'|'):(int)$_POST['CircleId'];
	$BrandId=(int)$_POST['BrandId'];
	$Stock=(int)$_POST['Stock'];
	$StartFrom=(int)$_POST['StartFrom']?(int)$_POST['StartFrom']:1;
	$Weight=(float)$_POST['Weight'];
	$Price_0=(float)$_POST['Price_0'];
	$Price_1=(float)$_POST['Price_1'];
	$Price_2=(float)$_POST['Price_2'];
	$Price_3=(float)$_POST['Price_3'];
	$IsSpecialOffer=(int)$_POST['IsSpecialOffer'];
	$SpecialOfferPrice=(float)$_POST['SpecialOfferPrice'];
	$BriefDescription=$_POST['BriefDescription'];
	$SeoTitle=$_POST['SeoTitle'];
	$SeoKeywords=$_POST['SeoKeywords'];
	$SeoDescription=$_POST['SeoDescription'];
	$AccTime=@strtotime($_POST['AccTime']);
	$Title= $_POST['Title'];
	$MemberId = (int)$_POST['MemberId'];
	$Review=$_POST['Review'];
	
	$Identity=(int)$_POST['Identity'];
	$Degree=(int)$_POST['Degree'];
	$Certification=(int)$_POST['Certification'];
	
	$BigPicPath=$SmallPicPath=$PicAlt=array();	//$SmallPicPath存入数据库的
	if(get_cfg('product.pic_count')){
		include('../../inc/fun/img_resize.php');
		for($i=0; $i<get_cfg('product.pic_count'); $i++){
			$PicAlt[]=$_POST['Alt_'.$i];
			if($tmp_path=up_file($_FILES['PicPath_'.$i], $save_dir)){
				$BigPicPath[$i]=$SmallPicPath[$i]=$tmp_path;
				foreach(get_cfg('product.pic_size') as $key=>$value){
					$w_h=@explode('X', $value);
					$filename="$key"=='default'?'':dirname($tmp_path).'/'.$value.'_'.basename($tmp_path);
					$path=img_resize($SmallPicPath[$i], $filename, (int)$w_h[0], (int)$w_h[1]);
					"$key"=='default' && $SmallPicPath[$i]=$path;
				}
			}
		}
		if(get_cfg('ly200.img_add_watermark')){
			include('../../inc/fun/img_add_watermark.php');
			foreach($BigPicPath as $value){
				img_add_watermark($value);
			}
		}
	}
	if($db->get_row_count('product',"MemberId = '$MemberId'")){
		js_back('改会员已经有老师信息存在！');
	}
	$db->insert('product', array(
			'CateId'			=>	$CateId,
			'Name'				=>	$Name,
			'ItemNumber'		=>	$ItemNumber,
			'Model'				=>	$Model,
			'IsInIndex'			=>	$IsInIndex,
			'IsHot'				=>	$IsHot,
			'IsRecommend'		=>	$IsRecommend,
			'IsNew'				=>	$IsNew,
			'SoldOut'			=>	$SoldOut,
			'ColorId'			=>	$ColorId,
			'SizeId'			=>	$SizeId,
			'CircleId'			=>  $CircleId,
			'BrandId'			=>	$BrandId,
			'Stock'				=>	$Stock,
			'StartFrom'			=>	$StartFrom,
			'Weight'			=>	$Weight,
			'PicPath_0'			=>	$SmallPicPath[0],
			'Price_0'			=>	$Price_0,
			'Price_1'			=>	$Price_1,
			'IsSpecialOffer'	=>	$IsSpecialOffer,
			'SpecialOfferPrice'	=>	$SpecialOfferPrice,
			'BriefDescription'	=>	$BriefDescription,
			'SeoTitle'			=>	$SeoTitle,
			'SeoKeywords'		=>	$SeoKeywords,
			'SeoDescription'	=>	$SeoDescription,
			'AccTime'			=>	$AccTime,
			'Identity'			=>	$Identity,
			'Degree'			=>	$Degree,
			'Certification'		=>	$Certification,
			'Title'				=>	$Title,
			'MemberId'			=>	$MemberId,
		)
	);
	
	$ProId=$db->get_insert_id();
	get_cfg('product.description') && $Description=save_remote_img($_POST['Description'], $save_dir);
	$db->insert('product_description', array(
			'ProId'			=>	$ProId,
			'Description'	=>	$Description
		)
	);
	
	//保存课程表
	for($i=0; $i<count($_POST['Issue_D']); $i++){
		$Issue_D=format_post_value($_POST['Issue_D'][$i]);
		$Issue_T=format_post_value($_POST['Issue_T'][$i]);
		$Issue_L=(int)$_POST['Issue_L'][$i];
		if($Issue_T && $Issue_T && $Issue_L){
			$db->insert('product_wholesale_class', array(
					'ProId'		=>	$ProId,
					'Issue_T'	=>	$Issue_T,
					'Issue_D'	=>	$Issue_D,
					'Issue_L'	=>	$Issue_L,
				)
			);}
		$A_Issue_L+=$Issue_L;
	}
	
	//保存批发价
	if(get_cfg('product.price') && get_cfg('product.wholesale_price')){
		for($i=0; $i<count($_POST['Qty']); $i++){
			$qty=(int)$_POST['Qty'][$i];
			$price=(float)$_POST['WholesalePrice'][$i];
			if($qty && $price){
				$db->insert('product_wholesale_price', array(
						'ProId'	=>	$ProId,
						'Qty'	=>	$qty,
						'Price'	=>	$price
					)
				);
			}
		}
	}
	
	//保存另外的语言版本的数据
	if(count(get_cfg('ly200.lang_array'))>1){
		add_lang_field('product', array('Name', 'BriefDescription', 'SeoTitle', 'SeoKeywords', 'SeoDescription'));
		add_lang_field('product_description', 'Description');
		
		for($i=1; $i<count(get_cfg('ly200.lang_array')); $i++){
			$field_ext='_'.get_cfg('ly200.lang_array.'.$i);
			$NameExt=$_POST['Name'.$field_ext];
			$BriefDescriptionExt=$_POST['BriefDescription'.$field_ext];
			$SeoTitleExt=$_POST['SeoTitle'.$field_ext];
			$SeoKeywordsExt=$_POST['SeoKeywords'.$field_ext];
			$SeoDescriptionExt=$_POST['SeoDescription'.$field_ext];
			$db->update('product', "ProId='$ProId'", array(
					'Name'.$field_ext				=>	$NameExt,
					'BriefDescription'.$field_ext	=>	$BriefDescriptionExt,
					'SeoTitle'.$field_ext			=>	$SeoTitleExt,
					'SeoKeywords'.$field_ext		=>	$SeoKeywordsExt,
					'SeoDescription'.$field_ext		=>	$SeoDescriptionExt
				)
			);
			
			if(get_cfg('product.description')){
				$DescriptionExt=save_remote_img($_POST['Description'.$field_ext], $save_dir);
				$db->update('product_description', "ProId='$ProId'", array(
						'Description'.$field_ext	=>	$DescriptionExt
					)
				);
			}
		}
	}
	
	//保存扩展数据
	$field=$field_type=array();
	$data['ProId']=$ProId;
	$columns=$db->show_columns('product_ext', 1);	//获取数据表的所有字段名称
	foreach(get_cfg('product.ext') as $form_type=>$field_list){	//扩展参数，form_type=>表单类型，field_list=>表单各项配置值
		foreach($field_list as $field_name=>$field_cfg){	//field_name=>表单名称，field_cfg=>表单配置
			if(in_array($form_type, array('input_text', 'textarea', 'ckeditor'))){
				if($field_cfg[0]){	//多语言输入
					for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){
						$data[$field_name.lang_name($i, 1)]=$form_type=='ckeditor'?save_remote_img($_POST[$field_name.lang_name($i, 1)], $save_dir):$_POST[$field_name.lang_name($i, 1)];
						$field[]=$field_name.lang_name($i, 1);
						$field_type[]=$form_type;
					}
				}else{	//不区分语言输入
					$data[$field_name]=$form_type=='ckeditor'?save_remote_img($_POST[$field_name], $save_dir):$_POST[$field_name];
					$field[]=$field_name;
					$field_type[]=$form_type;
				}
			}elseif(in_array($form_type, array('input_radio', 'input_checkbox', 'select'))){
				$data[$field_name]=$form_type=='input_checkbox'?('|'.@implode('|', $_POST[$field_name]).'|'):$_POST[$field_name];
				$field[]=$field_name;
				$field_type[]=$form_type;
			}elseif($form_type=='input_file'){
				$data[$field_cfg]=up_file($_FILES[$field_cfg], $save_dir);
				$field[]=$field_cfg;
				$field_type[]=$form_type;
			}
		}
	}
	for($i=0; $i<count($field); $i++){	//添加字段
		if(!in_array($field[$i], $columns)){
			if($field_type[$i]=='textarea'){
				$f='varchar(255)';
			}elseif($field_type[$i]=='ckeditor'){
				$f='text';
			}else{
				$f='varchar(100)';
			}
			$db->query("alter table product_ext add $field[$i] $f");
		}
	}
	$db->insert('product_ext', $data);
	set_page_url('product', "ProId='$ProId'", get_cfg('product.page_url'), 1);
	
	$db->update('manage_operation_log', 'Operation="product_add"', array(
			'Value'	=>	$CateId
		)
	);
	
	save_manage_log('添加产品:'.$Name);
	
	header('Location: index.php');
	exit;
}
$teacher_row = $db->get_all('member',"IsTeacher=1",'MemberId,UserName,Phone','MemberId desc');

include('../../inc/manage/header.php');
?>
<div class="header"><?=get_lang('ly200.current_location');?>:<a href="index.php"><?=get_lang('product.product_manage');?></a>&nbsp;-&gt;&nbsp;<?=get_lang('ly200.add');?></div>
<form method="post" name="act_form" id="act_form" class="act_form" action="add.php" enctype="multipart/form-data" onsubmit="return checkForm(this);">
<table width="100%" border="0" cellpadding="0" cellspacing="1" id="mouse_trBgcolor_table">
        <tr>
            <td nowrap>所属会员:</td>
            <td>
            	<select name="MemberId">
                <?php for($i=0,$ilen=count($teacher_row);$i<$ilen;$i++){ ?>
                	<option value="<?=$teacher_row[$i]['MemberId']?>"><?=$teacher_row[$i]['UserName'].'--'.$teacher_row[$i]['Phone']?></option>
                <?php } ?>
                </select>
            </td>
        </tr>
	<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
		<tr> 
			<td width="5%" nowrap><?=get_lang('ly200.name').lang_name($i, 0);?>:</td>
			<td width="95%"><input name="Name<?=lang_name($i, 1);?>" type="text" value="<?=htmlspecialchars($product_row['Name'.lang_name($i, 1)]);?>" class="form_input" size="50" maxlength="100" check="<?=get_lang('ly200.filled_out').get_lang('ly200.name');?>!~*"></td>
		</tr>
	<?php }?>
		<tr>
			<td nowrap>性别:</td>
			<td><input type="radio" name="Title" value="男" <?=$product_row['Title']=='男'?'checked':''?> /> &nbsp;&nbsp;男 <input type="radio" name="Title" value="女" <?=$product_row['Title']=='女'?'checked':''?> /> &nbsp;&nbsp;女</td>
		</tr>
	<?php if($db->get_row_count('product_category')>1){?>
		<tr>
			<td nowrap><?=get_lang('ly200.category');?>:</td>
			<td><?=ouput_Category_to_Select('CateId', $product_row['CateId'], 'product_category', 'UId="0,"', 1, get_lang('ly200.select'));?></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.item_number')){?>
		<tr>
			<td nowrap><?=get_lang('product.item_number');?>:</td>
			<td><input name="ItemNumber" type="text" value="<?=htmlspecialchars($product_row['ItemNumber']);?>" class="form_input" size="25" maxlength="50"></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.model')){?>
		<tr>
			<td nowrap><?=get_lang('product.model');?>:</td>
			<td><input name="Model" type="text" value="<?=htmlspecialchars($product_row['Model']);?>" class="form_input" size="25" maxlength="50"></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.pic_count')){?>
		<tr>
			<td nowrap><?=get_lang('ly200.photo');?>:</td>
			<td>
				<?php for($i=0; $i<get_cfg('product.pic_count'); $i++){?>
					<?=get_cfg('product.pic_count')>1?($i+1).'. ':'';?><input name="PicPath_<?=$i?>" type="file" size="50" class="form_input" contenteditable="false"><?php if(get_cfg('product.pic_alt')){?>&nbsp;&nbsp;<?=get_lang('ly200.alt');?>:<input name="Alt_<?=$i;?>" type="text" value="<?=htmlspecialchars($product_row['Alt_'.$i]);?>" class="form_input" size="25" maxlength="100"><?php }?><br>
				<?php }?>
				<iframe src="about:blank" name="del_img_iframe" style="display:none;"></iframe>
				<table border="0" cellspacing="0" cellpadding="0" style="margin-top:8px; margin-left:<?=get_cfg('product.pic_count')>1?'12':'0';?>px;">
				  <tr>
					<?php
					for($i=0; $i<get_cfg('product.pic_count'); $i++){
						if(!is_file($site_root_path.$product_row['PicPath_'.$i])){
							continue;
						}
					?>
						<td>
							<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td width="70" height="70" style="border:1px solid #ddd; background:#fff;" align="center" id="img_list_<?=$i;?>"><a href="<?=str_replace('s_', '', $product_row['PicPath_'.$i]);?>" target="_blank"><img src="<?=$product_row['PicPath_'.$i];?>" <?=img_width_height(70, 70, $product_row['PicPath_'.$i]);?> /></a><input type='hidden' name='S_PicPath_<?=$i;?>' value='<?=$product_row['PicPath_'.$i];?>'></td>
								</tr>
								<tr>
									<td align="center" style="padding-top:4px;"><?=get_lang('ly200.photo').(get_cfg('product.pic_count')>1?($i+1):'');?><span id="img_list_<?=$i;?>_a">&nbsp;<a href="mod.php?action=delimg&ProId=<?=$ProId;?>&Field=PicPath_<?=$i;?>&PicPath=<?=$product_row['PicPath_'.$i];?>&ImgId=img_list_<?=$i;?>" target="del_img_iframe" class="blue">(<?=get_lang('ly200.del');?>)</a></span></td>
								</tr>
							</table>
						</td>
						<td width="5">&nbsp;&nbsp;</td>
					<?php }?>
				  </tr>
				</table>
			</td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.color_ele')){?>
		<tr>
			<td nowrap><?=get_lang('product.color');?>:</td>
			<td class="list_data"><?=get_cfg('product.color_ele_mode')?ouput_table_to_input('product_color', 'CId', 'Color', 'ColorId[]', 'MyOrder desc, CId asc', 1, 1, 'checkbox', $product_row['ColorId']):ouput_table_to_select('product_color', 'CId', 'Color', 'ColorId', 'MyOrder desc, CId asc', 1, 1, $product_row['ColorId'], '', get_lang('ly200.select'));?></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.circle_ele')){?>
		<tr>
			<td nowrap><?=get_lang('product.circle');?>:</td>
			<td class="list_data"><?=get_cfg('product.circle_ele_mode')?ouput_table_to_input('product_circle', 'CId', 'Circle', 'CircleId[]', 'MyOrder desc, CId asc', 1, 1, 'checkbox', $product_row['CircleId']):ouput_table_to_select('product_circle', 'CId', 'Circle', 'CircleId', 'MyOrder desc, CId asc', 1, 1, $product_row['CircleId'], '', get_lang('ly200.select'));?></td>
		</tr>
	<?php }?>
    <?php if(get_cfg('product.acctime')){?>
		<tr>
			<td nowrap>开课时间:</td>
			<td><input name="AccTime" type="text" size="8" onclick="SelectDate(this);" contenteditable="false" value="<?=date('Y-m-d', $service_time);?>" class="form_input" /></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.size_ele')){?>
		<tr>
			<td nowrap><?=get_lang('product.size');?>:</td>
			<td class="list_data"><?=get_cfg('product.size_ele_mode')?ouput_table_to_input('product_size', 'SId', 'Size', 'SizeId[]', 'MyOrder desc, SId asc', 1, 1, 'checkbox', $product_row['SizeId']):ouput_table_to_select('product_size', 'SId', 'Size', 'SizeId', 'MyOrder desc, SId asc', 1, 1, $product_row['SizeId'], '', get_lang('ly200.select'));?></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.brand_ele')){?>
		<tr>
			<td nowrap><?=get_lang('product.brand');?>:</td>
			<td><?=ouput_table_to_select('product_brand', 'BId', 'Brand', 'BrandId', 'MyOrder desc, BId asc', 1, 1, $product_row['BrandId'], '', get_lang('ly200.select'));?></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.stock')){?>
		<tr>
			<td nowrap><?=get_lang('product.stock');?>:</td>
			<td><input name="Stock" type="text" value="<?=$product_row['Stock'];?>" class="form_input" size="5" maxlength="10" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);"></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.start_from')){?>
		<tr>
			<td nowrap><?=get_lang('product.start_from');?>:</td>
			<td><input name="StartFrom" type="text" value="<?=$product_row['StartFrom'];?>" class="form_input" size="5" maxlength="10" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);"></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.weight')){?>
		<tr>
			<td nowrap><?=get_lang('product.weight');?>:</td>
			<td><input name="Weight" type="text" value="<?=$product_row['Weight'];?>" class="form_input" size="5" maxlength="10" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);"><?=get_lang('product.weight_unit');?></td>
		</tr>
	<?php }?>
	<?php if(get_cfg('product.price')){?>
		<tr>
			<td nowrap><?=get_lang('product.price');?>:</td>
			<td>
				<?php
				$p_ary=get_cfg('product.price_list');
				for($i=0; $i<count($p_ary); $i++){
				?>
					<?=get_lang('product.price_list.'.$p_ary[$i]);?>:<?=get_lang('ly200.price_symbols');?><input name="Price_<?=$i;?>" type="text" value="<?=$product_row['Price_'.$i];?>" class="form_input" size="5" maxlength="10" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);" check="<?=get_lang('ly200.filled_out').get_lang('product.price_list.'.$p_ary[$i]);?>!~*">
				<?php
				}
				if(get_cfg('product.special_offer')){
				?>
					<?=get_lang('product.special_offer');?>:<input name="IsSpecialOffer" type="checkbox" <?=$product_row['IsSpecialOffer']==1?'checked':'';?> value="1" onclick="if(this.checked){$_('SpecialOfferPriceInput').style.display='';}else{$_('SpecialOfferPriceInput').style.display='none';};"><span id="SpecialOfferPriceInput" style="display:<?=$product_row['IsSpecialOffer']==1?'':'none';?>;"><?=get_lang('ly200.price_symbols');?><input name="SpecialOfferPrice" value="<?=$product_row['SpecialOfferPrice'];?>" class="form_input" type="text" size="5" maxlength="10" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);"></span>
				<?php }?>
			</td>
		</tr>
       <?php /*?> <tr>
				<td nowrap>课程表:</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0" id="wholesale_price_list" class="item_data_table">
						<tr>
							<td><a href="javascript:void(0);" onClick="this.blur(); add_wholesale_class_item('wholesale_price_list');" class="red"><?=get_lang('ly200.add_item');?></a></td>
						</tr>
						<?php for($i=0; $i<count($product_wholesale_class_row); $i++){?>
							<tr>
								<td>
                                课程： <select name="Issue_D[]">
                                <option value="1" <?= $product_wholesale_class_row[$i]['Issue_D']=='1'?'selected="selected"':''?>>星期一</option>
                                <option value="2" <?=$product_wholesale_class_row[$i]['Issue_D']=='2'?'selected="selected"':''?>>星期二</option>
                                <option value="3" <?=$product_wholesale_class_row[$i]['Issue_D']=='3'?'selected="selected"':''?>>星期三</option>
                                <option value="4" <?=$product_wholesale_class_row[$i]['Issue_D']=='4'?'selected="selected"':''?>>星期四</option>
                                <option value="5" <?=$product_wholesale_class_row[$i]['Issue_D']=='5'?'selected="selected"':''?>>星期五</option>
                                <option value="6" <?=$product_wholesale_class_row[$i]['Issue_D']=='6'?'selected="selected"':''?>>星期六</option>
                                <option value="7" <?=$product_wholesale_class_row[$i]['Issue_D']=='7'?'selected="selected"':''?>>星期日</option>
                                </select>&nbsp;&nbsp;&nbsp;上课时间&nbsp;<select name="Issue_T[]" <?=$product_wholesale_class_row[$i]['Issue_T']=='1'?'selected="selected"':''?>><option value="1">早上</option><option value="2" <?=$product_wholesale_class_row[$i]['Issue_T']=='2'?'selected="selected"':''?>>下午</option><option value="3" <?=$product_wholesale_class_row[$i]['Issue_T']=='3'?'selected="selected"':''?>>晚上</option></select>&nbsp;&nbsp;&nbsp;时长:<input type="text" class="form_input" name="Issue_L[]"onkeyup="set_number(this, 0);" value="<?=$product_wholesale_class_row[$i]['Issue_L']?>" onpaste="set_number(this, 0);" /><a href="javascript:void(0)" onClick="$_('wholesale_price_list').deleteRow(this.parentNode.parentNode.rowIndex);"><img src="../images/del.gif" hspace="5" /></a></td>
							</tr>
						<?php }?>
					</table>
				</td>
		</tr><?php */?>
		<?php if(get_cfg('product.wholesale_price')){?>
			<tr>
				<td nowrap><?=get_lang('product.wholesale_price');?>:</td>
				<td>
					<table border="0" cellspacing="0" cellpadding="0" id="wholesale_price_list" class="item_data_table">
						<tr>
							<td><a href="javascript:void(0);" onClick="this.blur(); add_wholesale_price_item('wholesale_price_list');" class="red"><?=get_lang('ly200.add_item');?></a></td>
						</tr>
						<?php for($i=0; $i<count($product_wholesale_price_row); $i++){?>
							<tr>
								<td><?=get_lang('ly200.qty');?>:<input name="Qty[]" onkeyup="set_number(this, 0);" onpaste="set_number(this, 0);" value="<?=$product_wholesale_price_row[$i]['Qty'];?>" class="form_input" type="TEXT" size="5" maxlength="10"><?=get_lang('ly200.price_symbols');?><input name="WholesalePrice[]" value="<?=$product_wholesale_price_row[$i]['Price'];?>" class="form_input" type="text" size="5" maxlength="10" onkeyup="set_number(this, 1);" onpaste="set_number(this, 1);"><a href="javascript:void(0)" onClick="$_('wholesale_price_list').deleteRow(this.parentNode.parentNode.rowIndex);"><img src="../images/del.gif" hspace="5" /></a></td>
							</tr>
						<?php }?>
					</table>
				</td>
			</tr>
		<?php }?>
	<?php }?>
	<?php /*?><?php if(get_cfg('product.brief_description')){?>
		<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
			<tr>
				<td nowrap><?=get_lang('ly200.brief_description').lang_name($i, 0);?>:</td>
				<td><textarea name="BriefDescription<?=lang_name($i, 1);?>" rows="5" cols="60" class="form_area"><?=htmlspecialchars($product_row['BriefDescription'.lang_name($i, 1)]);?></textarea></td>
			</tr>
		<?php }?>
	<?php }?>
	<?php if(get_cfg('product.seo_tkd')){?>
		<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
			<tr>
				<td nowrap><?=get_lang('ly200.seo.seo').lang_name($i, 0);?>:</td>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
					  <tr>
						<td width="5%" nowrap="nowrap"><?=get_lang('ly200.seo.title');?>:</td>
						<td width="95%"><input name="SeoTitle<?=lang_name($i, 1);?>" type="text" value="<?=htmlspecialchars($product_row['SeoTitle'.lang_name($i, 1)]);?>" class="form_input" size="70" maxlength="200"></td>
					  </tr>
					  <tr>
						<td nowrap="nowrap"><?=get_lang('ly200.seo.keywords');?>:</td>
						<td><input name="SeoKeywords<?=lang_name($i, 1);?>" type="text" value="<?=htmlspecialchars($product_row['SeoKeywords'.lang_name($i, 1)]);?>" class="form_input" size="70" maxlength="200"></td>
					  </tr>
					  <tr>
						<td nowrap="nowrap"><?=get_lang('ly200.seo.description');?>:</td>
						<td><input name="SeoDescription<?=lang_name($i, 1);?>" type="text" value="<?=htmlspecialchars($product_row['SeoDescription'.lang_name($i, 1)]);?>" class="form_input" size="70" maxlength="200"></td>
					  </tr>
					</table>
				</td>
			</tr>
		<?php }?>
	<?php }?>
	<?php */?>
	<?php if(get_cfg('product.is_in_index') || get_cfg('product.is_hot') || get_cfg('product.is_recommend') || get_cfg('product.is_new') || get_cfg('product.sold_out')){?>
		<tr>
			<td nowrap><?=get_lang('ly200.other_property');?>:</td>
			<td>
				<?php if(get_cfg('product.is_in_index')){?><input name="IsInIndex" <?=$product_row['IsInIndex']==1?'checked':'';?> type="checkbox" value="1"><?=get_lang('ly200.is_in_index');?><?php }?>
				<?php if(get_cfg('product.is_hot')){?><input name="IsHot" <?=$product_row['IsHot']==1?'checked':'';?> type="checkbox" value="1"><?=get_lang('product.is_hot');?><?php }?>
				<?php if(get_cfg('product.is_recommend')){?><input name="IsRecommend" <?=$product_row['IsRecommend']==1?'checked':'';?> type="checkbox" value="1"><?=get_lang('product.is_recommend');?><?php }?>
				<?php if(get_cfg('product.is_new')){?><input name="IsNew" <?=$product_row['IsNew']==1?'checked':'';?> type="checkbox" value="1"><?=get_lang('product.is_new');?><?php }?>
                <?php if(get_cfg('product.identity')){?><input name="Identity" <?=$product_row['Identity']==1?'checked':'';?> type="checkbox" value="1"><?=get_lang('product.identity');?><?php }?>
                <?php if(get_cfg('product.degree')){?><input name="Degree" <?=$product_row['Degree']==1?'checked':'';?> type="checkbox" value="1"><?=get_lang('product.degree');?><?php }?>
                <?php if(get_cfg('product.certification')){?><input name="Certification" <?=$product_row['Certification']==1?'checked':'';?> type="checkbox" value="1"><?=get_lang('product.certification');?><?php }?>
                <?php if(get_cfg('product.sold_out')){?><input name="SoldOut" <?=$product_row['SoldOut']==1?'checked':'';?> type="checkbox" value="1"><?=get_lang('product.sold_out');?><?php }?>
			</td>
		</tr>
	<?php }?>
	<?php
	foreach(get_cfg('product.ext') as $form_type=>$field_list){	//扩展参数，form_type=>表单类型，field_list=>表单各项配置值
		foreach($field_list as $field_name=>$field_cfg){	//field_name=>表单名称，field_cfg=>表单配置
			if($form_type=='input_text'){
			?>
				<?php if($field_cfg[0]){	//多语言输入?>
					<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
						<tr>
							<td nowrap><?=get_lang('product.ext.'.$field_name).lang_name($i, 0);?>:</td>
							<td><input name="<?=$field_name.lang_name($i, 1);?>" type="text" value="<?=htmlspecialchars($product_ext_row[$field_name.lang_name($i, 1)]);?>" class="form_input" size="<?=$field_cfg[1];?>" maxlength="<?=$field_cfg[2];?>"></td>
						</tr>
					<?php }?>
				<?php }else{?>
					<tr>
						<td nowrap><?=get_lang('product.ext.'.$field_name);?>:</td>
						<td><input name="<?=$field_name;?>" type="text" value="<?=htmlspecialchars($product_ext_row[$field_name]);?>" class="form_input" size="<?=$field_cfg[1];?>" maxlength="<?=$field_cfg[2];?>"></td>
					</tr>
				<?php }?>
			<?php }elseif($form_type=='input_radio'){?>
				<tr>
					<td nowrap><?=get_lang('product.ext.'.$field_name);?>:</td>
					<td class="list_data"><?php
					$value_list=@explode('|', $field_cfg[0]);
					for($i=0; $i<count($value_list); $i++){
						$check=$value_list[$i]==$product_ext_row[$field_name]?'checked':'';
						$value=htmlspecialchars($value_list[$i]);
						echo "<div><input type='radio' name='$field_name' value=\"$value\" $check>{$value_list[$i]}</div>";
					}?></td>
				</tr>
			<?php }elseif($form_type=='input_checkbox'){?>
				<tr>
					<td nowrap><?=get_lang('product.ext.'.$field_name);?>:</td>
					<td class="list_data"><?php
					$value_list=@explode('|', $field_cfg[0]);
					$checked_ary=@explode('|', $product_ext_row[$field_name]);
					for($i=0; $i<count($value_list); $i++){
						$check=in_array($value_list[$i], $checked_ary)?'checked':'';
						$value=htmlspecialchars($value_list[$i]);
						echo "<div><input type='checkbox' name='{$field_name}[]' value=\"$value\" $check>{$value_list[$i]}</div>";
					}?></td>
				</tr>
			<?php }elseif($form_type=='input_file'){?>
				<tr>
					<td nowrap><?=get_lang('product.ext.'.$field_cfg);?>:</td>
					<td><input name="<?=$field_cfg;?>" type="file" size="50" class="form_input" contenteditable="false"><input type="hidden" name="S_<?=$field_cfg;?>" value="<?=$product_ext_row[$field_cfg];?>" /><?php if(is_file($site_root_path.$product_ext_row[$field_cfg])){?>&nbsp;<?=get_lang('ly200.view');?>:<a href="../system/down_file.php?path=<?=$product_ext_row[$field_cfg];?>" class="red"><?=$product_ext_row[$field_cfg];?></a><?php }?></td>
				</tr>
			<?php }elseif($form_type=='select'){?>
				<tr>
					<td nowrap><?=get_lang('product.ext.'.$field_name);?>:</td>
					<td><select name="<?=$field_name;?>">
						<option value="">--<?=get_lang('ly200.select');?>--</option>
						<?php
						$value_list=@explode('|', $field_cfg[0]);
						for($i=0; $i<count($value_list); $i++){
							$select=$value_list[$i]==$product_ext_row[$field_name]?'selected':'';
							$value=htmlspecialchars($value_list[$i]);
							echo "<option value=\"$value\" $select>{$value_list[$i]}</option>";
						}?></select></td>
				</tr>
			<?php }elseif($form_type=='textarea'){?>
				<?php if($field_cfg[0]){	//多语言输入?>
					<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
						<tr>
							<td nowrap><?=get_lang('product.ext.'.$field_name).lang_name($i, 0);?>:</td>
							<td><textarea name="<?=$field_name.lang_name($i, 1);?>" rows="<?=$field_cfg[1];?>" cols="<?=$field_cfg[2];?>" class="form_area"><?=htmlspecialchars($product_ext_row[$field_name.lang_name($i, 1)]);?></textarea></td>
						</tr>
					<?php }?>
				<?php }else{?>
					<tr>
						<td nowrap><?=get_lang('product.ext.'.$field_name);?>:</td>
						<td><textarea name="<?=$field_name;?>" rows="<?=$field_cfg[1];?>" cols="<?=$field_cfg[2];?>" class="form_area"><?=htmlspecialchars($product_ext_row[$field_name]);?></textarea></td>
					</tr>
				<?php }?>
			<?php }elseif($form_type=='ckeditor'){?>
				<?php if($field_cfg[0]){	//多语言输入?>
					<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
						<tr>
							<td nowrap><?=get_lang('product.ext.'.$field_name).lang_name($i, 0);?>:</td>
							<td class="ck_editor"><textarea class="ckeditor" name="<?=$field_name.lang_name($i, 1);?>"><?=htmlspecialchars($product_ext_row[$field_name.lang_name($i, 1)]);?></textarea></td>
						</tr>
					<?php }?>
				<?php }else{?>
					<tr>
						<td nowrap><?=get_lang('product.ext.'.$field_name);?>:</td>
						<td class="ck_editor"><textarea class="ckeditor" name="<?=$field_name;?>"><?=htmlspecialchars($product_ext_row[$field_name]);?></textarea></td>
					</tr>
				<?php }?>
			<?php
			}
		}
	}
	?>
	<?php if(get_cfg('product.description')){?>
		<?php for($i=0; $i<count(get_cfg('ly200.lang_array')); $i++){?>
			<tr>
				<td nowrap><?=get_lang('ly200.description').lang_name($i, 0);?>:</td>
				<td class="ck_editor"><textarea class="ckeditor" name="Description<?=lang_name($i, 1);?>"><?=htmlspecialchars($product_description_row['Description'.lang_name($i, 1)]);?></textarea></td>
			</tr>
		<?php }?>
	<?php }?>
	<tr>
		<td>&nbsp;</td>
		<td><input type="submit" value="<?=get_lang('ly200.mod');?>" name="submit" class="form_button"><a href="index.php?<?=$query_string;?>" class="return"><?=get_lang('ly200.return');?></a><input type="hidden" name="query_string" value="<?=$query_string;?>"><input type="hidden" name="ProId" value="<?=$ProId;?>"></td>
	</tr>
</table>
</form>