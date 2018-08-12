<?php
require('../config.php');
$sql = "INSERT INTO retention.dimensions 
		VALUES(null,
				'".mysqli_real_escape_string($link,$_POST['dimension'])."',
				'".mysqli_real_escape_string($link,$_POST['desc'])."')";
$data = mysqli_query($link,$sql);
mysqli_close($link);
?>