<?php
require('../config.php');
$sql = "INSERT INTO retention.applicant_profile 
		VALUES(null,
				'".mysqli_real_escape_string($link,$_POST['sex'])."',
				'".mysqli_real_escape_string($link,$_POST['civilstatus'])."',
				'".mysqli_real_escape_string($link,$_POST['religion'])."',
				'".mysqli_real_escape_string($link,$_POST['city'])."',
				'".mysqli_real_escape_string($link,$_POST['province'])."',
				'".mysqli_real_escape_string($link,$_POST['citizenship'])."',
				'".mysqli_real_escape_string($link,$_POST['bloodtype'])."',
				'',
				'".mysqli_real_escape_string($link,$_POST['position'])."',
				'".mysqli_real_escape_string($link,$_POST['department'])."',
				'".mysqli_real_escape_string($link,$_POST['workhistory'])."',
				'".mysqli_real_escape_string($link,$_POST['degree'])."',
				'".mysqli_real_escape_string($link,$_POST['fname'])."',
				'".mysqli_real_escape_string($link,$_POST['mname'])."',
				'".mysqli_real_escape_string($link,$_POST['lname'])."',
				'".$_POST['date']."',
				'".mysqli_real_escape_string($link,$_POST['age'])."',
				0)";
//echo $sql;
if(mysqli_query($link,$sql)){
	$last_id = mysqli_insert_id($link);
	//echo $last_id.",".$_POST['position'];
	$sqlx = "SELECT * FROM retention.assoc_support_confidence 
		WHERE assoc_support_confidence.status = 1";
	$datax = mysqli_query($link,$sqlx);
	if(mysqli_num_rows($datax)>0){
		$rowx = mysqli_fetch_array($datax);
		echo $last_id.",".$_POST['position'].",".$rowx['support'].",".$rowx['confidence'];
	}else{
		echo '0,0,0,0';
	}
}else{
	echo '0,0,0,0';
}
mysqli_close($link);
?>