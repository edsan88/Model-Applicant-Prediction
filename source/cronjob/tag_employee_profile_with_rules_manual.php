<?php
//require('../config.php');
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$link=mysqli_connect($db_host,$db_user,$db_pass);
mysqli_set_charset($link,'utf8');
// $sql = "SELECT * FROM retention.employee_association_rules
		// WHERE employee_association_rules.status = 1 
		// AND employee_association_rules.support = '".$_POST['support']."' 
		// AND employee_association_rules.confidence = '".$_POST['confidence']."'
		// GROUP BY employee_association_rules.position_name";
$sql = "SELECT * FROM retention.employee_association_rules
		WHERE employee_association_rules.status = 1 
		AND employee_association_rules.support = '".$_GET['support']."' 
		AND employee_association_rules.confidence = '".$_GET['confidence']."'
		GROUP BY employee_association_rules.position_name";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		GetPositionAssocRules($row['support'],$row['confidence'],$row['position_name'],$link);
	}
	
}else{

}
function GetPositionAssocRules($support,$confidence,$position,$link){
	$sql = "SELECT * FROM retention.employee_association_rules
			WHERE employee_association_rules.status = 1
			AND employee_association_rules.support = '".$support."' 
			AND employee_association_rules.confidence = '".$confidence."' 
			AND employee_association_rules.position_name = '".$position."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$temp = '';
		while($row = mysqli_fetch_array($data)){
			if($temp == ''){
				$temp = $row['rule1'].",".$row['rule2'];
			}else{
				$temp = $temp.",".$row['rule2'];
			} 
		}
		//var_dump($temp);
		$holder = explode(",",$temp);
		//print_r($holder);
		$unique_rules = array_values(array_unique($holder));
		print_r($unique_rules);
		SearchEmployeeProfileWithRules($support,$confidence,$unique_rules,$position,$link);
	}else{

	}
}
function SearchEmployeeProfileWithRules($support,$confidence,$array_rules,$position,$link){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.position = '".$position."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			$counter = 1;
			$array_rule_count = count($array_rules);
			$temp = $row['sex'].",".
					$row['civilstatus'].",".
					$row['religion'].",".
					$row['city'].",".
					$row['province'].",".
					$row['citizenship'].",".
					$row['bloodtype'].",".
					$row['total_years_work'].",".
					$row['position'].",".
					$row['department'].",".
					$row['work_history'].",".
					$row['degree'].",".
					$row['age'].",".
					GetEmployeeDimensionResult($row['employeeInfoID'],1,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],2,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],3,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],4,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],5,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],6,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],7,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],8,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],9,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],10,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],11,$link).",".
					GetEmployeeDimensionResult($row['employeeInfoID'],12,$link);
			$array_temp = explode(",",$temp);
			$temp_id_holder = $row['id'];
			for($x=0;$x<count($array_temp);$x++){
				//echo "<p>".print_r($array_temp)." ----->>></p>";
				if(array_search($array_temp[$x], $array_rules)){
					$counter++;
					echo "<p>".$array_temp[$x]."</p>";
				}else{
					
				}
			}
			if($counter == $array_rule_count){
				echo "<p>Found Match:".$temp_id_holder."</p>";
				TagEmployeeAssociated($support,$confidence,$temp_id_holder,$link);
				
			}else if($counter != $array_rule_count){
				echo "<p>No Match Found: $counter : $array_rule_count</p>";
			}
				// if(array_search($row['work_history'], $array_rules)){
					// $counter++;
				// }else{
					
				// }
				// if($counter == $array_rule_count){
					// echo "<p>Found Match:".$row['id']."</p>";
				// }else{
					// echo "<p>$counter , $array_rule_count</p>";
				// }
				echo "<hr>";
		}
		// if($counter == $array_rule_count){
			// echo "<p>Found Match:".$temp_id_holder."</p>";
		// }else{
			// echo "<p>$counter , $array_rule_count</p>";
		// }
	}else{
		
	}
}
function TagEmployeeAssociated($support,$confidence,$employee_association_rules,$link){
	$sql = "SELECT * FROM retention.employee_associated
			WHERE employee_associated.support = '".$support."'
			AND employee_associated/confidence = '".$confidence."'
			AND employee_associated.employee_association_rules = '".$employee_association_rules."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		$s = "UPDATE retention.employee_associated 
			SET employee_associated.support = '".$support."',
 			employee_associated.confidence = '".$confidence."',
			employee_associated.employee_association_rules = '".$employee_association_rules."'
			WHERE employee_associated.support = '".$support."'
			AND employee_associated.confidence = '".$confidence."'
			AND employee_associated.employee_association_rules = '".$employee_association_rules."'";
		mysqli_query($link,$s);
	}else{
		$s = "INSERT INTO retention.employee_associated VALUES(null,'".$support."','".$confidence."','".$employee_association_rules."',0)";
		mysqli_query($link,$s);
	}
}
function GetEmployeeDimensionResult($info_id,$dimension_id,$link){
	$s = "SELECT
			count(user_response.dimension_id) as total_dimension ,
			SUM(IF(user_response.ratings = questionnaire.ideal_response,1,0)) as result FROM retention.user_response
			LEFT JOIN retention.questionnaire ON
			questionnaire.questionnaire_id = user_response.questionnaire_id
			WHERE user_response.user_id = '".$info_id."'
			AND user_response.dimension_id = '".$dimension_id."'
			GROUP BY user_id,dimension_id";
	$d = mysqli_query($link,$s);
	if(mysqli_num_rows($d)>0){
		$r = mysqli_fetch_array($d);
		$total = ($r['result'] / $r['total_dimension']) * 100;
		if($dimension_id == 1){
			return "D1:".$total;
		}else if($dimension_id == 2){
			return "D2:".$total;
		}else if($dimension_id == 3){
			return "D3:".$total;
		}else if($dimension_id == 4){
			return "D4:".$total;
		}else if($dimension_id == 5){
			return "D5:".$total;
		}else if($dimension_id == 6){
			return "D6:".$total;
		}else if($dimension_id == 7){
			return "D7:".$total;
		}else if($dimension_id == 8){
			return "D8:".$total;
		}else if($dimension_id == 9){
			return "D9:".$total;
		}else if($dimension_id == 10){
			return "D10:".$total;
		}else if($dimension_id == 11){
			return "D11:".$total;
		}else if($dimension_id == 12){
			return "D12:".$total;
		}
		
	}else{
		return "D".$dimension_id.":0";
	}
}
mysqli_close($link);
?>