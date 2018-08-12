<?php
require('../config.php');
$sql = "SELECT * FROM retention.custom_ruleset ORDER BY custom_ruleset.status ASC";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		if($row['profile_selected'] == 1){
			$profile = 'SEX';
		}else if($row['profile_selected'] == 2){
			$profile = 'CIVIL STATUS';
		}else if($row['profile_selected'] == 3){
			$profile = 'CITY';
		}else if($row['profile_selected'] == 4){
			$profile = 'PROVINCE';
		}else if($row['profile_selected'] == 5){
			$profile = 'CITIZENSHIP';
		}else if($row['profile_selected'] == 6){
			$profile = 'TOTAL YEARS WORKING';
		}else if($row['profile_selected'] == 7){
			$profile = 'DEPARTMENT';
		}else if($row['profile_selected'] == 8){
			$profile = 'WORK HISTORY';
		}else if($row['profile_selected'] == 9){
			$profile = 'EDUCATIONAL ATTAINMENT';
		}else if($row['profile_selected'] == 10){
			$profile = 'AGE';
		}
		
		if($row['sex'] == 1){$sex = "YES";}else{$sex = "NO";}
		if($row['civilstatus'] == 1){$civilstatus = "YES";}else{$civilstatus = "NO";}
		if($row['city'] == 1){$city = "YES";}else{$city = "NO";}
		if($row['province'] == 1){$prov = "YES";}else{$prov = "NO";}
		if($row['citizenship'] == 1){$citizenship = "YES";}else{$citizenship = "NO";}
		if($row['total_work'] == 1){$total_work = "YES";}else{$total_work = "NO";}
		if($row['position'] == 1){$position = "YES";}else{$position = "NO";}
		if($row['department'] == 1){$department = "YES";}else{$department = "NO";}
		if($row['work_history'] == 1){$work_history = "YES";}else{$work_history = "NO";}
		if($row['degree'] == 1){$degree = "YES";}else{$degree = "NO";}
		if($row['age'] == 1){$age = "YES";}else{$age = "NO";}
		if($row['d1'] == 1){$d1 = "YES";}else{$d1 = "NO";}
		if($row['d2'] == 1){$d2 = "YES";}else{$d2 = "NO";}
		if($row['d3'] == 1){$d3 = "YES";}else{$d3 = "NO";}
		if($row['d4'] == 1){$d4 = "YES";}else{$d4 = "NO";}
		if($row['d5'] == 1){$d5 = "YES";}else{$d5 = "NO";}
		if($row['d6'] == 1){$d6 = "YES";}else{$d6 = "NO";}
		if($row['d7'] == 1){$d7 = "YES";}else{$d7 = "NO";}
		if($row['d8'] == 1){$d8 = "YES";}else{$d8 = "NO";}
		if($row['d9'] == 1){$d9 = "YES";}else{$d9 = "NO";}
		if($row['d10'] == 1){$d10 = "YES";}else{$d10 = "NO";}
		if($row['d11'] == 1){$d11 = "YES";}else{$d11 = "NO";}
		if($row['d12'] == 1){$d12 = "YES";}else{$d12 = "NO";}
		if($row['status'] == 1){$status = 'Done';}else{$status = 'Queueing';}
		$temp[] = array("id"=>$row['custom_ruleset_id'],
						"profile_selected"=>$profile,
						"option"=>$row['option'],
						"support"=>$row['support'],
						"confidence"=>$row['confidence'],
						"sex"=>$sex,
						"civilstatus"=>$civilstatus,
						"city"=>$city,
						"province"=>$prov,
						"citizenship"=>$citizenship,
						"total_work"=>$total_work,
						"position"=>$position,
						"department"=>$department,
						"work_history"=>$work_history,
						"degree"=>$degree,
						"age"=>$age,
						"d1"=>$d1,
						"d2"=>$d2,
						"d3"=>$d3,
						"d4"=>$d4,
						"d5"=>$d5,
						"d6"=>$d6,
						"d7"=>$d7,
						"d8"=>$d8,
						"d9"=>$d9,
						"d10"=>$d10,
						"d11"=>$d11,
						"d12"=>$d12,
						"status"=>$status,
						"date"=>date('F d,Y H:i:s',strtotime($row['date_added'])));
	}
	echo json_encode($temp);
}else{
	
}
mysqli_close($link);
?>