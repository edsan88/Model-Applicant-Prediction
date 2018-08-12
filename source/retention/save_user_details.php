<?php
require('../config.php');
$sql = "INSERT INTO retention.user_details 
		VALUES(null,
				'".$_POST['user_id']."',
				'".$_POST['age']."',
				'".$_POST['brgy']."',
				'".$_POST['city']."',
				'".$_POST['educ_level']."',
				'".$_POST['marital_status']."',
				'".$_POST['province']."',
				'".$_POST['region']."',
				'".$_POST['sex']."',
				'".$_POST['religion']."',
				'".date('Y-m-d')."')";
$data = mysqli_query($link,$sql);
mysqli_close($link);
?>