<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/category.php');//分类一起取出处理

$action = $_GET['act']; 
$save_dir='/u_file/cer/';
$mypic0=$_POST['mypic0'];
$mypic1=$_POST['mypic1'];
$mypic2=$_POST['mypic2'];

if($action=='delimg'){ //删除图片 
	$filename = $_POST['imagename']; 
	if(!empty($filename)){ 
		unlink('/u_file/cer/'.$filename); 
		echo '1'; 
	}else{ 
		echo '删除失败.'; 
	} 
}else{ //上传图片
	if($_FILES['mypic0']){ 
		$picname = $_FILES['mypic0']['name']; 
		$picsize = $_FILES['mypic0']['size'];
	}elseif($_FILES['mypic1']){
		$picname = $_FILES['mypic1']['name']; 
		$picsize = $_FILES['mypic1']['size'];	
	}elseif($_FILES['mypic2']){
		$picname = $_FILES['mypic2']['name']; 
		$picsize = $_FILES['mypic2']['size'];
	}
	if ($picname != "") { 
		if ($picsize > 512000) { //限制上传大小 
			echo '图片大小不能超过500k'; 
			exit; 
		} 
		$type = strstr($picname, '.'); //限制上传格式 
		if ($type != ".gif" && $type != ".jpg") { 
			echo '图片格式不对！'; 
			exit; 
		} 
		$rand = rand(100, 999); 
		$pics = date("YmdHis") . $rand . $type; //命名图片名称 
		//上传路径 
		$pic_path = $save_dir; 
		//move_uploaded_file($_FILES['mypic']['tmp_name'], $pic_path);
		
	if($_FILES['mypic0']){ 
		$pics=up_file2($_FILES['mypic0'], $pic_path);
	}elseif($_FILES['mypic1']){
		$pics=up_file2($_FILES['mypic1'], $pic_path);	
	}elseif($_FILES['mypic2']){
		$pics=up_file2($_FILES['mypic2'], $pic_path);
	}
		
	} 
	$size = round($picsize/1024,2); //转换成kb 
	$arr = array( 
		'name'=>$picname, 
		'pic'=>$pics, 
		'size'=>$size 
	); 
	echo json_encode($arr); //输出json数据 
	exit;
}
?>

