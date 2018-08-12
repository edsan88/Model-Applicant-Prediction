<?php
require('../config.php');
$sql = "SELECT * FROM retention.assoc_support_confidence 
		WHERE assoc_support_confidence.status = 1";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	$row = mysqli_fetch_array($data);
	echo $row['support'].",".$row['confidence'];
}else{
	echo '0,0';
}
mysqli_close($link);
?>