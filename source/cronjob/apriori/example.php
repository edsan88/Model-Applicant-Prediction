<?php   
include 'class.apriori.php';
require('../../config.php');
 
$s = "SELECT * FROM jserp_hrdo.position";
$d = mysqli_query($link,$s);
if(mysqli_num_rows($d)>0){
	while($r = mysqli_fetch_array($d)){
		//$r['positionName'];

		$sql = "SELECT * FROM retention.employee_profile WHERE position = '".$r['positionName']."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			//$item = 0;
			//$dataset[] = array();
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
				//print_r($data_list);
				$dataset[] = array(implode(",",$data_list));
				//$dataset[] = array($row['sex'].",".$row['civilstatus'].",".$row['city'].",".$row['province'].",".$row['citizenship'].",".$row['total_years_work'].",".$row['position'].",".$row['department'].",".$row['work_history'].",".$row['degree']);
				//$item ++;
			}
			
			$Apriori = new Apriori();

			$Apriori->setMaxScan(2);       //Scan 2, 3, ...
			$Apriori->setMinSup($_GET['support']);         //Minimum support 1, 2, 3, ...
			$Apriori->setMinConf($_GET['confidence']);       //Minimum confidence - Percent 1, 2, ..., 100
			$Apriori->setDelimiter(',');
			   //Delimiter 
			$Apriori->process($dataset);
						//Frequent Itemsets
			echo '<h1>Frequent Itemsets</h1>';
			$Apriori->printFreqItemsets($r['positionName'],$link);

			echo '<h3>Frequent Itemsets Array</h3>';
			print_r($Apriori->getFreqItemsets()); 

			//Association Rules
			echo '<h1>Association Rules</h1>';
			$Apriori->printAssociationRules($r['positionName'],$link);

			echo '<h3>Association Rules Array</h3>';
			print_r($Apriori->getAssociationRules()); 
			//$dataset[] = null;
			//Save to file
			// $Apriori->saveFreqItemsets('freqItemsets.txt');
			// $Apriori->saveAssociationRules('associationRules.txt');
		}else{

		}
		echo "<hr>";
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
?>  
