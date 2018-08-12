<?php
	require('../config.php');
	$sql = "DELETE FROM retention.applicant_attachment WHERE applicant_attachment.applicant_attachment_id = '".$_POST['id']."'";
	mysqli_query($link,$sql);
	mysqli_close($link);
?>