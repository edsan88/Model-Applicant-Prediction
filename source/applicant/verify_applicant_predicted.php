<?php
require('../config.php');
$sql = "SELECT * FROM retention.applicant_prediction 
		WHERE applicant_prediction.applicant_id = '".$_POST['applicant_id']."' 
		AND applicant_prediction.support = '".$_POST['support']."' 
		AND applicant_prediction.confidence = '".$_POST['confidence']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	echo 1;
}else{
	echo 0;
}
mysqli_close($link);
?>