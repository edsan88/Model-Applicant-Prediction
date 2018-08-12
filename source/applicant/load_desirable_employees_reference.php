<?php
require('../config.php');
$sql = "SELECT * FROM retention.employee_associated
		LEFT JOIN retention.employee_profile ON
		employee_profile.id = employee_associated.employee_association_rules
		WHERE employee_associated.support = '".$_GET['support']."'
		AND employee_associated.confidence = '".$_GET['confidence']."' 
		AND employee_profile.position = '".$_GET['position']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['id'],
						"sex"=>$row['sex'],
						"civilstatus"=>$row['civilstatus'],
						"religion"=>$row['religion'],
						"city"=>$row['city'],
						"province"=>$row['province'],
						"citizenship"=>$row['citizenship'],
						"bloodtype"=>$row['bloodtype'],
						"position"=>$row['position'],
						"dept"=>$row['department'],
						"work_years_current"=>$row['total_years_work'],
						"work_years_previous"=>$row['work_history'],
						"degree"=>$row['degree']);
	}
	echo json_encode($temp);
}else{
	
}
mysqli_close($link);
?>