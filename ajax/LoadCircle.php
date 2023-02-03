<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
//include('../inc/category.php');//分类一起取出处理

$ColorId=$_GET['CId'];

?>
<select name="CircleId" class="input_txt" >
<?php $ColorId_row = $db->get_all('product_circle',"ColorId = '$ColorId'");
    foreach((array)$ColorId_row as $item){
?>
    <option value="<?=$item['CId']?>"><?=$item['Circle']?></option>
<?php }?>
</select>
