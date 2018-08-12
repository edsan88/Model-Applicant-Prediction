<?php
	require('../config.php');
	$sql = "SELECT * FROM retention.user_details";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		while($row = mysqli_fetch_array($data)){
			VerifyifExist($row['user_id'],$link);
		}
	}else{
		
	}
	mysqli_close($link);
	
	function VerifyifExist($id,$link){
		$sql = "SELECT * FROM retention.user_response_summary WHERE user_response_summary.user_id = '".$id."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			//return 1;
		}else{
			
			$s = "INSERT INTO retention.user_response_summary 
					VALUES(null,
							'".$id."',
							'".GetEmployeeDimensionResult($id,1,$link)."',
							'".GetEmployeeDimensionResult($id,2,$link)."',
							'".GetEmployeeDimensionResult($id,3,$link)."',
							'".GetEmployeeDimensionResult($id,4,$link)."',
							'".GetEmployeeDimensionResult($id,5,$link)."',
							'".GetEmployeeDimensionResult($id,6,$link)."',
							'".GetEmployeeDimensionResult($id,7,$link)."',
							'".GetEmployeeDimensionResult($id,8,$link)."',
							'".GetEmployeeDimensionResult($id,9,$link)."',
							'".GetEmployeeDimensionResult($id,10,$link)."',
							'".GetEmployeeDimensionResult($id,11,$link)."',
							'".GetEmployeeDimensionResult($id,12,$link)."')";
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
		echo $sql;
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			$r = mysqli_fetch_array($d);
			$total = ($r['result'] / $r['total_dimension']) * 100;
			if($dimension_id == 1){
				return $total;
			}else if($dimension_id == 2){
				return $total;
			}else if($dimension_id == 3){
				return $total;
			}else if($dimension_id == 4){
				return $total;
			}else if($dimension_id == 5){
				return $total;
			}else if($dimension_id == 6){
				return $total;
			}else if($dimension_id == 7){
				return $total;
			}else if($dimension_id == 8){
				return $total;
			}else if($dimension_id == 9){
				return $total;
			}else if($dimension_id == 10){
				return $total;
			}else if($dimension_id == 11){
				return $total;
			}else if($dimension_id == 12){
				return $total;
			}
		}else{
			return 0;
		}
	}
?>