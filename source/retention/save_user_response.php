<?php
require('../config.php');
$sql = "INSERT INTO retention.user_response 
		VALUES(null,
				'".$_POST['user_id']."',
				'".mysqli_real_escape_string($link,$_POST['dimensions_id'])."',
				'".$_POST['questionnaire_id']."',
				'".mysqli_real_escape_string($link,$_POST['response'])."',
				'".date('Y-m-d H:i:s')."',
				'".mysqli_real_escape_string($link,$_POST['ratings'])."',
				0)";
$data = mysqli_query($link,$sql);
mysqli_close($link);
?>