<?php 
include('../inc/site_config.php');
include('../inc/set/ext_var.php');
include('../inc/fun/mysql.php');
include('../inc/function.php');
include('../inc/lib/article/detail_lang_0.php');

//参数
$vedioType = $_POST['vedioType'];
$vedioDetailType = $_POST['vedioDetailType'];
$key = $_GET['key'];
$where = array();
$tagParm = $_GET['tag'] ? "tag like '%|".$_GET['tag']."|%'" : "";
$tagGroupParm = $_GET['tagGroup'] ? "tag_group like '|".$_GET['tagGroup']."|'" : "";
$creatorParm = $_GET['creator'] ? "creator like '|".$_GET['creator']."|'" : "";
!empty($tagParm) && $where[] = $tagParm;
!empty($tagGroupParm) && $where[] = $tagGroupParm;
!empty($creatorParm) && $where[] = $creatorParm;

if(count($where) > 0){
    $whereStr = implode(" and ",$where);
}else{
    $whereStr = "1=1";
}
!empty($vedioType) && $whereStr = $whereStr." and vedio_type like '%".$vedioType."%'";
!empty($vedioDetailType) && $whereStr = $whereStr." and vedio_type = '".$vedioDetailType."'";
$key && $whereStr = "$whereStr and vedio_name like '%".urldecode($key)."%'";

//分页
$pageCount = 9;//每页个数
$totalNum = $db->get_row_count('vedio',$whereStr);//总数
$curPage = 1;//当前页数
$totalPage = ceil($totalNum/$pageCount);//总页数
//分页导航栏
$navCount = 10;//总共显示个数
$startNav = 1;//导航开始号
$endNav = 10;//导航结束号

if(isset($_POST['curPage'])){
  $curPage = $_POST['curPage'];
}


//总页数不大于10页
if($curPage <= $navCount){
  if($totalPage <= $endNav){
    $endNav = $totalPage;
  }
}else{
  $level = $curPage%$navCount > 0 ? ceil($curPage/$navCount)-1 : ($curPage/$navCount-1);//层数
  $startNav = $level * $navCount + 1;
  if($startNav == $totalPage){
    $endNav = $startNav;
  }else{
    if($totalPage <= $level * $navCount + $navCount){
      $endNav = $totalPage;
    }else{
      $endNav = $level * $navCount + $navCount;
    }
  }
}

$vedios=$db->get_limit('vedio', $whereStr, '*', 'in_date desc', ($curPage -1)*$pageCount, $pageCount);
echo json_encode($vedios);



?>
