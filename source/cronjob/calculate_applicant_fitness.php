<?php
require('../config.php');
$sql = "SELECT * FROM retention.applicant_profile
		WHERE applicant_profile.predicted = 0";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$s = "SELECT * FROM retention.assoc_support_confidence";
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			while($r = mysqli_fetch_array($d)){
				//$r['support'] $r['confidence'] $row['applicant_profile_id'] $row['position']
				file_get_contents("http://localhost:8080/?support=$r['support']&confidence=$r['confidence']&position=$row['position']&applicant=$row['applicant_profile_id']");
			}
		}else{
			echo "XX";
		}
	}
}else{
	echo "XXX";
}
mysqli_close($link);
?>