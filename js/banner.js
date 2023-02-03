/*广告图*/

/*最大父元素*/var $bDiv = jQuery(".Banner");
/*广告图容器*/var $Banner = $bDiv.find(".absolute");
/*定义一个变量作为下标*/var $page = 0;


var $pages = jQuery(".page a");
$pages.first().addClass("cur");
$Banner.first().show();
$pages.hover(
	function(){
		clearInterval($auto);
		$page = jQuery(this).index();
		$Banner.eq(jQuery(this).index()).fadeIn(1000).siblings(".Banner .absolute").fadeOut(600);
		jQuery(this).addClass("cur").siblings($pages).removeClass("cur");
		},
	function(){
		$auto = setInterval("autos()",3000);
		}
);

function autos(){
	$page = $page==$pages.length ? 0 : $page;
	$pages.eq($page).addClass("cur").siblings($pages).removeClass("cur");
	$Banner.eq($page).fadeIn(1000).siblings(".Banner .absolute").fadeOut(600);
	$page++;
}
var $auto = setInterval("autos()",3000);



//手风琴 一个数组，里面的参数是所有图片的初始定位$po_arr[<?php echo $i;?>] = '<?php echo $i*248;?>';
/*var $inbBnner = jQuery('#inbBnner');
var $item = $inbBnner.find('.item');
var $offset = 40;
var $length = $item.length;
function setPosition(eq){
	$item.eq(eq).stop(true,false).animate({left:(eq*$offset)+"px"},300);
	for(var $begin=eq;$begin>0;$begin--){
		$item.eq($begin).stop(true,false).animate({left:($begin*$offset)+"px"},400);
	}
	for(var $end=eq+1;$end<$length;$end++){
		$item.eq($end).stop(true,false).animate({left:($po_arr[$end])+"px"},400);
	}
}
function rePosition(){
	for(var $i=0;$i<$length;$i++){
		$item.eq($i).animate({left:($po_arr[$i])+"px"},100);
	}
}*/