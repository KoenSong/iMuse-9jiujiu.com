<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理

$calsscate=$_GET['calsscate'];

if($calsscate){
	$JCategory=$db->get_all('product_category',"Category like '%$calsscate%'");
	if($JCategory[0]['Dept']==1){
			$ZCategory=$db->get_all('product_category',"UId = '0,{$JCategory[0]['CateId']},'");
	}
	foreach((array)$ZCategory as $val){            		                	
?>
	<a href="javascript://" date="<?=$val['CateId']?>" onclick="c_type_select(this)"><?=$JCategory[0]['Category']?> — <?=$val['Category']?></a>
<?php 
	}
}else{
	foreach($FCategory as $item){
		foreach((array)$SCategory[$item['CateId']] as $val){
?>
         <a href="javascript://" date="<?=$val['CateId']?>" onclick="c_type_select(this)"><?=$item['Category']?> — <?=$val['Category']?></a>
<?php 
}}}
?>



