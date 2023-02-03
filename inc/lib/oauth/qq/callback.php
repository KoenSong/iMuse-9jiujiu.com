<?php
require_once("API/qqConnectAPI.php");
$qc = new QC();
echo $qc->qq_callback();
echo $qc->get_openid();
$ret = $qc->get_info();

foreach($ret['data'] as $k => $v){
?>
<li><?=$k?>: &nbsp; <?=$v?></li>
<?php
}
?>
