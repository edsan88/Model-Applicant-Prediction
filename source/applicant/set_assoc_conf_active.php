<?php
require('../config.php');
$sql = "SELECT * FROM retention.assoc_support_confidence 
		WHERE assoc_support_confidence.status = 1";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$s = "UPDATE retention.assoc_support_confidence SET assoc_support_confidence.status = 0 
			WHERE assoc_support_confidence.assoc_support_confidence_id = '".$row['assoc_support_confidence_id']."'";
		mysqli_query($link,$s);
	}
}else{
	
}
$ss = "UPDATE retention.assoc_support_confidence SET assoc_support_confidence.status = 1 
	WHERE assoc_support_confidence.assoc_support_confidence_id = '".$_POST['id']."'";
mysqli_query($link,$ss);
mysqli_close($link);
?>