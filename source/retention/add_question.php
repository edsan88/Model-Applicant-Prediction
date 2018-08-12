<?php
require('../config.php');
$sql = "INSERT INTO retention.questionnaire 
		VALUES(null,
				'".mysqli_real_escape_string($link,$_POST['dimension_id'])."',
				'".mysqli_real_escape_string($link,$_POST['question'])."',
				'".mysqli_real_escape_string($link,$_POST['keywords'])."',
				'".mysqli_real_escape_string($link,$_POST['ideal_response'])."')";
$data = mysqli_query($link,$sql);
mysqli_close($link);
?>