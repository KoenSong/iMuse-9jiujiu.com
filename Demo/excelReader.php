<?php
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理

require_once('../inc/lib/phpExcel1.8.0/PHPExcel.php');
$file_name = "excel.xlsx";
$php_excel_obj = new PHPExcel();
$php_reader = new PHPExcel_Reader_Excel2007();
if(!$php_reader->canRead($file_name)){
       $php_reader= new PHPExcel_Reader_Excel5();
       if(!$php_reader->canRead($file_name)){
              echo'NO Excel!';
       }
}

$php_excel_obj = $php_reader->load($file_name);
$current_sheet =$php_excel_obj->getSheet(0);
$all_column =$current_sheet->getHighestColumn();  
$all_row =$current_sheet->getHighestRow();  
$all_arr = array();  
$c_arr = array();

/*for($r_i = 2; $r_i<=$all_row; $r_i++){
   $c_arr= array();
   for($c_i= 'A'; $c_i<= 'S'; $c_i++){
		$adr= $c_i . $r_i;
		$value= $current_sheet->getCell($adr)->getValue();
		if($c_i== 'A' && empty($value) )
		break;
		if(is_object($value)){
			$value= $value->__toString();
		}
		//echo(iconv("UTF-8","UTF-8",$value)."<br/>");
		//$c_arr[$c_i]= $value;
		$c_arr[$c_i]= iconv("UTF-8","UTF-8",$value);
   }
   if(empty($c_arr['A']))
   		break;
   $c_arr&& $all_arr[] =  $c_arr;
   $product_data 		= 		array(
	   					'Name'		=>	$c_arr['A'],
	   					'Title'		=>	$c_arr['B'],
	   					'age'		=>	$c_arr['C'],
	   					'T_age'		=>	$c_arr['D'],
	   					'Price_0'	=>	$c_arr['E'],
	   					'Price_1'	=>	$c_arr['G'],
	   					'Price_2'	=>	$c_arr['F'],
	   					'Price_3'	=>	$c_arr['H'],
	   					'address_2'	=>	$c_arr['I'],
	   					'CateId'	=> 	$c_arr['J'],//教学科目
	   					'ColorId'	=>	1,			//默认广州市
	   					'CircleId'	=>	$c_arr['L'],//教学区域
	   					'Date' 		=>	'|1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|16|17|18|19|20|21|',//授课时间
	   					'PicPath_0'	=>	'/u_file/face/dealer/'.$c_arr['O'].'.jpeg',
	   					'Video'		=>	$c_arr['P'],
	   					'SoldOut'	=>	0,			//审核不通过 1 通过0
	   					'MemberId'	=>	117,		//默认指定用户
	   					'is_dealer'	=>	1,			//商家账户
	   					'AccTime'	=> 	time()
   	);
   	//$db->insert('product',$product_data);
	$proId = $db->get_value('product', "Name = '".$c_arr['A']."'", "ProId");
	
	$product_ext_data 	= 		array(
   						'Warranty4'	=>	addslashes($c_arr['S'])
   	);
   	$db->update('product_ext', "ProId = $proId", $product_ext_data);
}*/

/*for($r_i = 2; $r_i<=$all_row; $r_i++){
   $c_arr= array();
   for($c_i= 'A'; $c_i<= 'V'; $c_i++){
		$adr= $c_i . $r_i;
		$value= $current_sheet->getCell($adr)->getValue();
		if($c_i== 'A' && empty($value) )
		break;
		if(is_object($value)){
			$value= $value->__toString();
		}
		//echo(iconv("UTF-8","UTF-8",$value)."<br/>");
		//$c_arr[$c_i]= $value;
		$c_arr[$c_i]= iconv("UTF-8","UTF-8",$value);
   }
   if(empty($c_arr['A']))
   		break;
   $c_arr&& $all_arr[] =  $c_arr;
   $product_data 		= 		array(
	   					'Name'		=>	$c_arr['A'],
	   					'Title'		=>	$c_arr['B'],
	   					'age'		=>	$c_arr['C'],
	   					'T_age'		=>	$c_arr['D'],
	   					'Price_0'	=>	$c_arr['E'],
	   					'Price_1'	=>	$c_arr['G'],
	   					'Price_2'	=>	$c_arr['F'],
	   					'Price_3'	=>	$c_arr['H'],
	   					'address_2'	=>	$c_arr['I'],
	   					'CateId'	=> 	$c_arr['J'],//教学科目
	   					'ColorId'	=>	1,			//默认广州市
	   					'CircleId'	=>	$c_arr['L'],//教学区域
	   					'Date' 		=>	'|1|2|3|4|5|6|7|8|9|10|11|12|13|14|15|16|17|18|19|20|21|',//授课时间
	   					'PicPath_0'	=>	'/u_file/face/dealer/'.$c_arr['O'].'.jpeg',
	   					'Video'		=>	$c_arr['P'],
	   					'SoldOut'	=>	0,			//审核不通过 1 通过0
	   					'MemberId'	=>	117,		//默认指定用户
	   					'is_dealer'	=>	1,			//商家账户
	   					'AccTime'	=> 	time()
   	);
   	$db->insert('product',$product_data);
   	$proId = $db->get_insert_id();
	$product_ext_data 	= 		array(
   						'ProId'		=>	$proId,
   						'Warranty0'	=>	addslashes($c_arr['R']),
   						'Warranty1'	=>	addslashes($c_arr['S']),
   						'Warranty2'	=>	addslashes($c_arr['T']),
   						'Warranty3'	=>	addslashes($c_arr['U']),
   						'Warranty4'	=>	addslashes($c_arr['V']),
   						'Applicable'=>	$c_arr['B']
   	);
   	$db->insert('product_ext',$product_ext_data);
}*/

//视频导入
for($r_i = 2; $r_i<=$all_row; $r_i++){
   $c_arr= array();
   for($c_i= 'A'; $c_i<= 'G'; $c_i++){
		$adr= $c_i . $r_i;
		$value= $current_sheet->getCell($adr)->getValue();
		if($c_i== 'A' && empty($value) )
		break;
		if(is_object($value)){
			$value= $value->__toString();
		}
		$c_arr[$c_i]= iconv("UTF-8","UTF-8",$value);
   }
   if(empty($c_arr['A']))
   		break;
   $c_arr&& $all_arr[] =  $c_arr;
   //转换标签、分组、指导老师字典代码
   $tranTag = "";
   $tranTagGroup = "";
   $tranCreator = "";
   if(!empty($c_arr['D'])){
   		$tagArr = explode('|',$c_arr['D']);
   		$tagGroupArr = explode('|',$c_arr['E']);
		$CreatorArr = explode('|',$c_arr['F']);

   		$tranTagArr = array();
   		$tranTagGroupArr = array();
   		$tranCreatorArr = array();

   		//转换标签
		$dictArr = $db->get_all('dict',"dict_type = 'vedioTag_westInstrument'");
   		foreach((array)$tagArr as $item){
   			foreach((array)$dictArr as $dictArrItem){
   				if($item == $dictArrItem['dict_name']){
   					$tranTagArr[] = $dictArrItem['dict_value'];
   				}
   			}
   		}
		$tranTag = "|".implode("|", $tranTagArr)."|";

		//转换分组
		$dictArr = $db->get_all('dict',"dict_type = 'vedioTagGroup_westInstrument'");
		foreach((array)$tagGroupArr as $item){
   			foreach((array)$dictArr as $dictArrItem){
   				if($item == $dictArrItem['dict_name']){
   					$tranTagGroupArr[] = $dictArrItem['dict_value'];
   				}
   			}
   		}
		$tranTagGroup = "|".implode("|", $tranTagGroupArr)."|";

		//转换指导老师
		$dictArr = $db->get_all('dict',"dict_type = 'vedioCreator_westInstrument'");
		foreach((array)$CreatorArr as $item){
   			foreach((array)$dictArr as $dictArrItem){
   				if($item == $dictArrItem['dict_name']){
   					$tranCreatorArr[] = $dictArrItem['dict_value'];
   				}
   			}
   		}
		$tranCreator = "|".implode("|", $tranCreatorArr)."|";

   }
   $product_data 		= 		array(
	   					'vedio_name'	=>	$c_arr['A'],
	   					'url'			=>	$c_arr['B'],
	   					'pic'			=>	'/u_file/face/vedio/'.$c_arr['C'].'.jpg',
	   					'tag'			=>	$tranTag,
	   					'tag_name'		=>	$c_arr['D'],
	   					'tag_group'		=>	$tranTagGroup,
	   					'tag_group_name'=>	$c_arr['E'],
	   					'creator'		=>	$tranCreator,
	   					'creator_name'	=>	$c_arr['F'],
	   					'vedio_desc'	=>	$c_arr['G'],
	   					'in_date'		=>	$service_time,
	   					'vedio_type'	=>	'westInstrument_guitar'
   	);
   	$db->insert('vedio',$product_data);
}
?>