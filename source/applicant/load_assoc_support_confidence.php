<?php
require('../config.php');
$sql = "SELECT * FROM retention.assoc_support_confidence ORDER BY assoc_support_confidence.support DESC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		if($row['status'] == 0){
			$status = "Inactive";
		}else if($row['status'] == 1){
			$status = "Active";
		} 
		$temp[] = array("id"=>$row['assoc_support_confidence_id'],
						"support"=>$row['support'],
						"confidence"=>$row['confidence'],
						"status"=>$status,
						"sex_allowed"=>$row['sex_allowed'],
						"civilstatus_allowed"=>$row['civilstatus_allowed'],
						"city_allowed"=>$row['city_allowed'],
						"province_allowed"=>$row['province_allowed'],
						"citizenship_allowed"=>$row['citizenship_allowed'],
						"total_work_years_allowed"=>$row['total_work_years_allowed'],
						"position_allowed"=>$row['position_allowed'],
						"department_allowed"=>$row['department_allowed'],
						"work_history_allowed"=>$row['work_history_allowed'],
						"degree_allowed"=>$row['degree_allowed'],
						"age_allowed"=>$row['age'],
						"d1"=>$row['d1'],
						"d2"=>$row['d2'],
						"d3"=>$row['d3'],
						"d4"=>$row['d4'],
						"d5"=>$row['d5'],
						"d6"=>$row['d6'],
						"d7"=>$row['d7'],
						"d8"=>$row['d8'],
						"d9"=>$row['d9'],
						"d10"=>$row['d10'],
						"d11"=>$row['d11'],
						"d12"=>$row['d12'],
						"discretize"=>$row['discreetize_value']);
	}
	echo json_encode($temp);
}else{
	
}
mysqli_close($link);
?>