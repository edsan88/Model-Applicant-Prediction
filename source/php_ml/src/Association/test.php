<?php   
set_time_limit ( 0 ) ;ini_set('memory_limit', '1024M');
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';
$link=mysqli_connect($db_host,$db_user,$db_pass);
mysqli_set_charset($link,'utf8');
include 'Apriori.php';
$s = "SELECT * FROM jserp_hrdo.position";
$d = mysqli_query($link,$s);
if(mysqli_num_rows($d)>0){
	
	while($r = mysqli_fetch_array($d)){
		//$r['positionName'];
		
		$sql = "SELECT * FROM retention.employee_profile WHERE position = '".$r['positionName']."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			//$item = 0;
			$dataset = array();
			$counter = 0;
			
			while($row = mysqli_fetch_array($data)){
				$selected_list = $_GET['sex_allowed'].",".
								$_GET['civilstatus_allowed'].",".
								$_GET['city_allowed'].",".
								$_GET['province_allowed'].",".
								$_GET['citizenship_allowed'].",".
								$_GET['position_allowed'].",".
								$_GET['department_allowed'].",".
								$_GET['work_history_allowed'].",".
								$_GET['degree_allowed'].",".
								$_GET['sex'].",".
								$_GET['d1'].",".
								$_GET['d2'].",".
								$_GET['d3'].",".
								$_GET['d4'].",".
								$_GET['d5'].",".
								$_GET['d6'].",".
								$_GET['d7'].",".
								$_GET['d8'].",".
								$_GET['d9'].",".
								$_GET['d10'].",".
								$_GET['d11'].",".
								$_GET['d12'];
				$data_list = array($row['total_years_work']);
				if($selected_list == '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0'){
					//echo "taer";	
				}else if($selected_list != '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0'){
					$x = explode(',',$selected_list);
					for($a=0;$a<count($x);$a++){
						if($x[$a] == 0){
							//echo "tae";
						}else if($x[$a] == 1){
							if($a == 0){
								array_push($data_list,$row['sex']);
								//echo $row['sex'];
							}else if($a == 1){
								array_push($data_list,$row['civilstatus']);
								//echo $row['civilstatus'];
							}else if($a == 2){
								array_push($data_list,$row['city']);
								//echo $row['city'];
							}else if($a == 3){
								array_push($data_list,$row['province']);
							}else if($a == 4){
								array_push($data_list,$row['citizenship']);
							}else if($a == 5){
								array_push($data_list,$row['position']);
							}else if($a == 6){
								array_push($data_list,$row['department']);
							}else if($a == 7){
								array_push($data_list,$row['work_history']);
							}else if($a == 8){
								array_push($data_list,$row['degree']);
							}else if($a == 9){
								array_push($data_list,$row['age']);
							}else if($a == 10){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],1,$link));
							}else if($a == 11){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],2,$link));
							}else if($a == 12){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],3,$link));
							}else if($a == 13){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],4,$link));
							}else if($a == 14){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],5,$link));
							}else if($a == 15){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],6,$link));
							}else if($a == 16){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],7,$link));
							}else if($a == 17){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],8,$link));
							}else if($a == 18){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],9,$link));
							}else if($a == 19){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],10,$link));
							}else if($a == 20){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],11,$link));
							}else if($a == 21){
								array_push($data_list,GetEmployeeDimensionResult($row['employeeInfoID'],12,$link));
							}
						}
					}
				}
				//echo "<hr>";
				//echo json_encode($data_list);
				//$dataset[] = $data_list;
				//$dataset[] = array($row['sex'].",".$row['civilstatus'].",".$row['city'].",".$row['province'].",".$row['citizenship'].",".$row['total_years_work'].",".$row['position'].",".$row['department'].",".$row['work_history'].",".$row['degree']);
				//print_r($dataset);
				//$item ++;
				////$dataset = $data_list.",";
				$samples[$counter] = $data_list;
				//echo $samples."<hr>";
				// $labels  = [];

				// include 'Apriori.php';

				// $associator = new Apriori($support = 0.5, $confidence = 1);
				// $associator->train($samples, $labels);
				// echo "<hr>";
				// print_r($associator->getRules());
				// echo "<hr>";
				// print_r($associator->apriori());
				$counter++;
				
			}
			//echo json_encode($samples);
				
				$labels  = [];
				$associator = new Apriori($support = ($_GET['support']/100), $confidence = ($_GET['confidence']/100)); 
				$associator->train($samples, $labels);
				echo "<hr>";
				$xy = $associator->getRules();
				//echo count($xy);
				for($array_count = 0;$array_count < count($xy);$array_count++){
					//echo $xy[$array_count]['antecedent'][0]."->".$xy[$array_count]['consequent'][0]." supp:".$xy[$array_count]['support']." conf:".$xy[$array_count]['confidence']."<br>";
					if(VerifyItemset($link,$r['positionName'],$xy[$array_count]['antecedent'][0].",".$xy[$array_count]['consequent'][0],$_GET['support'],$_GET['confidence']) == 1){
						
					}else{
						SaveItemset($link,$r['positionName'],$xy[$array_count]['antecedent'][0].",".$xy[$array_count]['consequent'][0],$_GET['support'],$_GET['confidence']);
					}
				}
				echo "<hr>";
				//print_r($associator->apriori());
				$xz = $associator->apriori();

				for($array_count1 = 0;$array_count1 < count($xz[2]);$array_count1++){
					echo "<br>".$xz[2][$array_count1][0]."-->".$xz[2][$array_count1][1]."<br>";
					if(VerifyRules($link,$r['positionName'],$xz[2][$array_count1][0],$xz[2][$array_count1][1],$_GET['support'],$_GET['confidence']) == 1){
						
					}else{
						SaveRules($link,$r['positionName'],$xz[2][$array_count1][0],$xz[2][$array_count1][1],$_GET['support'],$_GET['confidence']);
					}
				}
				
				
		}else{

		}
		echo "<hr>";
		unset($samples);
	}
}else{

}

mysqli_close($link);

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
function VerifyItemset($link,$position,$itemset,$support,$confidence){
		$s = "SELECT * FROM retention.itemset 
			WHERE itemset.position = '".$position."' 
			AND itemset.itemset = '".$itemset."' 
			AND itemset.support = '".$support."' 
			AND itemset.confidence = '".$confidence."'";
		$d = mysqli_query($link,$s);	
		if(mysqli_num_rows($d)>0){
			return 1;
		}else{
			return 0;
		}
}
function SaveItemset($link,$position,$itemset,$support,$confidence){
	$s = "INSERT INTO retention.itemset VALUES(null,'".$support."','".$confidence."','".$position."','".$itemset."',0)";
	//echo $s;
	mysqli_query($link,$s);
}
function VerifyRules($link,$position,$rule1,$rule2,$support,$confidence){
	$s = "SELECT * FROM retention.employee_association_rules 
		WHERE employee_association_rules.position_name = '".$position."' 
		AND employee_association_rules.rule1 = '".$rule1."' 
		AND employee_association_rules.rule2 = '".$rule2."'		
		AND employee_association_rules.support = '".$support."' 
		AND employee_association_rules.confidence = '".$confidence."'";
	$d = mysqli_query($link,$s);	
	if(mysqli_num_rows($d)>0){
		return 1;
	}else{
		return 0;
	}
}
function SaveRules($link,$position,$rule1,$rule2,$support,$confidence){
	$s = "INSERT INTO retention.employee_association_rules 
		VALUES(null,
				'".$support."',
				'".$confidence."',
				'".$position."',
				'".$rule1."',
				'".$rule2."',
				'".($confidence*100)."',
				1)";
	mysqli_query($link,$s);
}
?>  
