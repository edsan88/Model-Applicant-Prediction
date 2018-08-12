<?php
require('../config.php');
$sql = "SELECT * FROM retention.assoc_support_confidence 
		WHERE assoc_support_confidence.support = '".$_POST['sup']."' AND 
		assoc_support_confidence.confidence = '".$_POST['conf']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	
}else{
	$s = "INSERT INTO retention.assoc_support_confidence 
		VALUES(null,
			'".$_POST['sup']."',
			'".$_POST['conf']."',
			'".$_POST['status']."',
			'".$_POST['sex']."',
			'".$_POST['civilstatus']."',
			'".$_POST['city']."',
			'".$_POST['province']."',
			'".$_POST['citizenship']."',
			1,
			1,
			'".$_POST['department']."',
			'".$_POST['work_history']."',
			'".$_POST['degree']."',
			'".$_POST['age']."',
			'".$_POST['d1']."',
			'".$_POST['d2']."',
			'".$_POST['d3']."',
			'".$_POST['d4']."',
			'".$_POST['d5']."',
			'".$_POST['d6']."',
			'".$_POST['d7']."',
			'".$_POST['d8']."',
			'".$_POST['d9']."',
			'".$_POST['d10']."',
			'".$_POST['d11']."',
			'".$_POST['d12']."',
			'".$_POST['discreet']."')";
	//echo $s;
	mysqli_query($link,$s);
}
mysqli_close($link);
?>