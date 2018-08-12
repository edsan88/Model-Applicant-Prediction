<?php
require('../config.php');
$sql = "SELECT * FROM retention.assoc_support_confidence WHERE assoc_support_confidence.status = 1";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$row = mysqli_fetch_array($data);
	$temp[] = array('support'=>$row['support'],'confidence'=>$row['confidence']);
	//array_pop($temp);
	echo json_encode($temp);
}else{
	//echo json_encode(array("# of Years"=>0,"% Value"=>0));
}
mysqli_close($link);
?>