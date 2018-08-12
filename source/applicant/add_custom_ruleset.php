<?php
require('../config.php');
$sql = "INSERT INTO retention.custom_ruleset 
		VALUES(null,
				'".mysqli_real_escape_string($link,$_POST['profile_selected'])."',
				'".mysqli_real_escape_string($link,$_POST['option'])."',
				'".mysqli_real_escape_string($link,$_POST['support'])."',
				'".mysqli_real_escape_string($link,$_POST['confidence'])."',
				'".mysqli_real_escape_string($link,$_POST['sex_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['civilstatus_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['city_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['province_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['citizenship_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['total_work_years_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['position_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['department_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['work_history_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['degree_allowed'])."',
				'".mysqli_real_escape_string($link,$_POST['age'])."',
				'".mysqli_real_escape_string($link,$_POST['d1'])."',
				'".mysqli_real_escape_string($link,$_POST['d2'])."',
				'".mysqli_real_escape_string($link,$_POST['d3'])."',
				'".mysqli_real_escape_string($link,$_POST['d4'])."',
				'".mysqli_real_escape_string($link,$_POST['d5'])."',
				'".mysqli_real_escape_string($link,$_POST['d6'])."',
				'".mysqli_real_escape_string($link,$_POST['d7'])."',
				'".mysqli_real_escape_string($link,$_POST['d8'])."',
				'".mysqli_real_escape_string($link,$_POST['d9'])."',
				'".mysqli_real_escape_string($link,$_POST['d10'])."',
				'".mysqli_real_escape_string($link,$_POST['d11'])."',
				'".mysqli_real_escape_string($link,$_POST['d12'])."',
				0,
				'".date('Y-m-d H:i:s')."')";
mysqli_query($link,$sql);

mysqli_close($link);
?>