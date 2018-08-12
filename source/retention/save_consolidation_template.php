<?php
	require('../config.php');
	$sql = "INSERT INTO retention.consolidation_template 
			VALUES(null,
					'".$_POST['age']."',
					'".$_POST['sex']."',
					'".$_POST['religion']."',
					'".$_POST['marital_status']."',
					'".$_POST['educ_level']."',
					'".$_POST['region']."',
					'".$_POST['province']."',
					'".$_POST['city']."',
					'".$_POST['brgy']."',
					'".$_POST['template_desc']."',
					0,
					'".date('Y-m-d')."',
					'".$_POST['start']."',
					'".$_POST['end']."')";
	echo $sql;
	mysqli_query($link,$sql);
	mysqli_close($link);
?>