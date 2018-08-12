<?php
require('../config.php');
$divisory = 100/$_GET['discretize'];
for($xy=0;$xy<$_GET['dval'];$xy++){
	$miny_age = (($xy * $divisory)/100)*65;
	$maxy_age = ((($xy * $divisory)+$divisory)/100)*65;
	//$temp[$x] = array("id"=>$x+1,"val"=>($x * $divisor)."-".(($x * $divisor)+$divisor));
	//echo $miny_age."---)".$maxy_age."<br>";
}
if($_GET['dval'] == 0 && $_GET['discretize'] == 0){
$sql = "SELECT * FROM retention.employee_associated LEFT JOIN retention.employee_profile ON employee_profile.id = employee_associated.employee_association_rules WHERE employee_associated.support = '".$_GET['support']."' AND employee_associated.confidence = '".$_GET['confidence']."'";	
}else if($_GET['dval'] != 0 && $_GET['discretize'] != 0){
$sql = "SELECT * FROM retention.employee_associated LEFT JOIN retention.employee_profile ON employee_profile.id = employee_associated.employee_association_rules WHERE employee_associated.support = '".$_GET['support']."' AND employee_associated.confidence = '".$_GET['confidence']."' AND employee_profile.age >= '".number_format($miny_age,0,'','')."' AND employee_profile.age <= '".number_format($maxy_age,0,'','')."'";
//echo $sql;		
}else if($_GET['dval'] == 0 && $_GET['discretize'] != 0){
$sql = "SELECT * FROM retention.employee_associated LEFT JOIN retention.employee_profile ON employee_profile.id = employee_associated.employee_association_rules WHERE employee_associated.support = '".$_GET['support']."' AND employee_associated.confidence = '".$_GET['confidence']."'";		
}

// $sql = "SELECT * FROM retention.employee_associated
		// LEFT JOIN retention.employee_profile ON
		// employee_profile.id = employee_associated.employee_association_rules
		// WHERE employee_associated.support = '".$_GET['support']."'
		// AND employee_associated.confidence = '".$_GET['confidence']."' 
		// AND employee_profile.age >= '".number_format($miny_age,0,'','')."' 
		// AND employee_profile.age <= '".number_format($maxy_age,0,'','')."'";
//echo $sql;
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$dimensions = explode(",",GetEmployeeDimensionPercentage($row['employeeInfoID'],$link));
		if($_GET['dval'] == 0 && $_GET['discretize'] == 0){	
			$temp[] = array("id"=>$row['employee_associated'],
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
					"degree"=>$row['degree'],
					"age"=>$row['age'],
					"d1"=>$dimensions[0],
					"d2"=>$dimensions[1],
					"d3"=>$dimensions[2],
					"d4"=>$dimensions[3],
					"d5"=>$dimensions[4],
					"d6"=>$dimensions[5],
					"d7"=>$dimensions[6],
					"d8"=>$dimensions[7],
					"d9"=>$dimensions[8],
					"d10"=>$dimensions[9],
					"d11"=>$dimensions[10],
					"d12"=>$dimensions[11]);
		}else if($_GET['dval'] != 0 && $_GET['discretize'] != 0){
			$counter = 0;
			$divisor = 100/$_GET['discretize'];
			for($x=0;$x<$_GET['dval'];$x++){
				$min = ($x * $divisor);
				$max = (($x * $divisor)+$divisor);
				$min_age = (($x * $divisor)/100)*65;
				$max_age = ((($x * $divisor)+$divisor)/100)*65;
				//$temp[$x] = array("id"=>$x+1,"val"=>($x * $divisor)."-".(($x * $divisor)+$divisor));
			}
			//echo $min_age."->".$max_age."<br>";
			$included_dimensions = explode(",",$_GET['dimensions']);
			if($included_dimensions[0] == 1){
				if($dimensions[0] >= $min && $dimensions[0] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[1] == 1){
				if($dimensions[1] >= $min && $dimensions[1] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[2] == 1){
				if($dimensions[2] >= $min && $dimensions[2] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[3] == 1){
				if($dimensions[3] >= $min && $dimensions[3] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[4] == 1){
				if($dimensions[4] >= $min && $dimensions[4] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[5] == 1){
				if($dimensions[5] >= $min && $dimensions[5] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[6] == 1){
				if($dimensions[6] >= $min && $dimensions[6] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[7] == 1){
				if($dimensions[7] >= $min && $dimensions[7] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[8] == 1){
				if($dimensions[8] >= $min && $dimensions[8] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[9] == 1){
				if($dimensions[9] >= $min && $dimensions[9] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[10] == 1){
				if($dimensions[10] >= $min && $dimensions[10] <= $max){
					
				}else{
					$counter ++;
				}
			}
			if($included_dimensions[11] == 1){
				if($dimensions[11] >= $min && $dimensions[11] <= $max){
					
				}else{
					$counter ++;
				}
			}
			
			if($counter != 0){
				
			}else{
				//echo number_format($min_age,2,'','')."-->".number_format($max_age,0,'','')."<br>";
				// if($min_age == 0){
					// $min_age = 15;
				// }else{
					// $min_age = $min_age;
				// }
				//echo $min_age."-->".number_format($max_age,0,'','')."<br>";
				// if($row['age'] >= number_format($min_age,0,'','') || $row['age'] <= number_format($max_age,0,'','')){
					//echo $row['age'].">>>>>>".number_format($min_age,0,'','')."-->".number_format($max_age,0,'','')."<br>";
					// $temp[] = array("id"=>$row['employee_associated'],
							// "sex"=>$row['sex'],
							// "civilstatus"=>$row['civilstatus'],
							// "religion"=>$row['religion'],
							// "city"=>$row['city'],
							// "province"=>$row['province'],
							// "citizenship"=>$row['citizenship'],
							// "bloodtype"=>$row['bloodtype'],
							// "position"=>$row['position'],
							// "dept"=>$row['department'],
							// "work_years_current"=>$row['total_years_work'],
							// "work_years_previous"=>$row['work_history'],
							// "degree"=>$row['degree'],
							// "age"=>$row['age'],
							// "d1"=>$dimensions[0],
							// "d2"=>$dimensions[1],
							// "d3"=>$dimensions[2],
							// "d4"=>$dimensions[3],
							// "d5"=>$dimensions[4],
							// "d6"=>$dimensions[5],
							// "d7"=>$dimensions[6],
							// "d8"=>$dimensions[7],
							// "d9"=>$dimensions[8],
							// "d10"=>$dimensions[9],
							// "d11"=>$dimensions[10],
							// "d12"=>$dimensions[11]);
				// }else{
					//echo $min_age."-->".$max_age;
				// }
				$temp[] = array("id"=>$row['employee_associated'],
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
							"degree"=>$row['degree'],
							"age"=>$row['age'],
							"d1"=>$dimensions[0],
							"d2"=>$dimensions[1],
							"d3"=>$dimensions[2],
							"d4"=>$dimensions[3],
							"d5"=>$dimensions[4],
							"d6"=>$dimensions[5],
							"d7"=>$dimensions[6],
							"d8"=>$dimensions[7],
							"d9"=>$dimensions[8],
							"d10"=>$dimensions[9],
							"d11"=>$dimensions[10],
							"d12"=>$dimensions[11]);
			}
			
			
		}else if($_GET['dval'] == 0 && $_GET['discretize'] != 0){
			$temp[] = array("id"=>$row['employee_associated'],
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
					"degree"=>$row['degree'],
					"age"=>$row['age'],
					"d1"=>$dimensions[0],
					"d2"=>$dimensions[1],
					"d3"=>$dimensions[2],
					"d4"=>$dimensions[3],
					"d5"=>$dimensions[4],
					"d6"=>$dimensions[5],
					"d7"=>$dimensions[6],
					"d8"=>$dimensions[7],
					"d9"=>$dimensions[8],
					"d10"=>$dimensions[9],
					"d11"=>$dimensions[10],
					"d12"=>$dimensions[11]);
		}
		
	}
	echo json_encode($temp);
}else{
	
}

function GetEmployeeDimensionPercentage($id,$link){
	$sql = "SELECT * FROM retention.user_response_summary WHERE user_response_summary.user_id = '".$id."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$row = mysqli_fetch_array($data);
		return $row['d1'].",
				".$row['d2'].",
				".$row['d3'].",
				".$row['d4'].",
				".$row['d5'].",
				".$row['d6'].",
				".$row['d7'].",
				".$row['d8'].",
				".$row['d9'].",
				".$row['d10'].",
				".$row['d11'].",
				".$row['d12'];
		//echo json_encode($temp);
	}else{
		return '0,0,0,0,0,0,0,0,0,0,0,0';
	}	
}
mysqli_close($link);


?>