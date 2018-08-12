<?php
	require('../config.php');

	
	$sql = "UPDATE retention.employee_associated SET employee_associated.status = 1  
			WHERE employee_associated.employee_associated IN (".$_POST['id'].") 
			AND employee_associated.support = '".$_POST['support']."' 
			AND employee_associated.confidence = '".$_POST['confidence']."'";
	mysqli_query($link,$sql);
	mysqli_close($link);
?>