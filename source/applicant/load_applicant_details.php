<?php
require('../config.php');
$sql = "SELECT * FROM retention.applicant_profile WHERE applicant_profile.applicant_profile_id = '".$_GET['id']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Position Applying",
						"details"=>$row['position']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Department Designation",
						"details"=>$row['department']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Possible # of Yrs Applicant will stay",
						"details"=>" ????? ");
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"# of Work History(years)",
						"details"=>$row['work_history']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"First Name",
						"details"=>$row['first_name']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Middle Name",
						"details"=>$row['middle_name']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Last Name",
						"details"=>$row['last_name']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Sex",
						"details"=>$row['sex']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Civil Status",
						"details"=>$row['civilstatus']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"City",
						"details"=>$row['city']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Province",
						"details"=>$row['province']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Citizenship",
						"details"=>$row['citizenship']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Blood Type",
						"details"=>$row['bloodtype']);
		$temp[] = array("id"=>$row['applicant_profile_id'],
						"profile"=>"Degree",
						"details"=>$row['degree']);
	}
	echo json_encode($temp);
}else{
	
}
mysqli_close($link);
?>