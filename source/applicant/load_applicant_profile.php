<?php
require('../config.php');
if($_GET['type'] == 0){
	$sql = "SELECT * FROM retention.applicant_profile ORDER BY applicant_profile.applicant_profile_id DESC";
}else if($_GET['type'] == 1){
	$sql = "SELECT * FROM retention.applicant_profile 
			WHERE applicant_profile.date_applied >= '".$_GET['start']."' 
			AND applicant_profile.date_applied <= '".$_GET['end']."' 
			ORDER BY applicant_profile.applicant_profile_id DESC";
}
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"sex"=>$row['sex'],
						"civilstatus"=>$row['civilstatus'],
						"religion"=>$row['religion'],
						"city"=>$row['city'],
						"province"=>$row['province'],
						"citizenship"=>$row['citizenship'],
						"bloodtype"=>$row['bloodtype'],
						"total_years_work"=>$row['total_years_work'],
						"position"=>$row['position'],
						"department"=>$row['department'],
						"work_history"=>$row['work_history'],
						"degree"=>$row['degree'],
						"fname"=>$row['first_name'],
						"mname"=>$row['middle_name'],
						"lname"=>$row['last_name'],
						"app_date"=>$row['date_applied']);
	}
	echo json_encode($temp);
}else{
	
}
mysqli_close($link);
?>