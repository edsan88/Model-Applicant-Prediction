<?php   
include 'custom.class.apriori.php';
require('../../config.php');

$s = "SELECT * FROM retention.custom_ruleset WHERE custom_ruleset.status = 0 ORDER BY custom_ruleset.custom_ruleset_id ASC LIMIT 1";
$d =  mysqli_query($link,$s);
if(mysqli_num_rows($d)>0){
	while($r = mysqli_fetch_array($d)){
		if($r['profile_selected'] == 1){
			Profile1($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 2){
			Profile2($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 3){
			Profile3($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 4){
			Profile4($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 5){
			Profile5($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 6){
			Profile6($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 7){
			Profile7($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 8){
			Profile8($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 9){
			Profile9($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}else if($r['profile_selected'] == 10){
			Profile10($link,$r['custom_ruleset_id'],$r['option'],$r['support'],$r['confidence'],$r['sex'],$r['civilstatus'],$r['city'],$r['province'],$r['citizenship'],$r['position'],$r['department'],$r['work_history'],$r['degree'],$r['age'],$r['d1'],$r['d2'],$r['d3'],$r['d4'],$r['d5'],$r['d6'],$r['d7'],$r['d8'],$r['d9'],$r['d10'],$r['d11'],$r['d12']);
			//echo "test";
		}
	}
}else{
	echo "XXX";
}

function Profile1($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.sex = '".$option."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile2($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.civilstatus = '".$option."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile3($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.city = '".$option."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile4($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.province = '".$option."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile5($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.citizenship = '".$option."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile6($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.total_years_work = '".$option."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile7($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.department = '".$option."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile8($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.work_history = '".$option." WORK HISTORY YEARS'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile9($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.degree = '".$option."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
}

function Profile10($link,$custom_ruleset_id,$option,$support,$confidence,$sex,$civilstatus,$city,$province,$citizenship,$position,$department,$work_history,$degree,$age,$d1,$d2,$d3,$d4,$d5,$d6,$d7,$d8,$d9,$d10,$d11,$d12){
	$age_list = explode("-",$option);
	$sql = "SELECT * FROM retention.employee_profile WHERE employee_profile.age >= '".$age_list[0]."' AND employee_profile.age <= '".$age_list[1]."'";
	$data = mysqli_query($link,$sql);
	if(mysqli_num_rows($data)>0){
		//$item = 0;
		//$dataset[] = array();
		while($row = mysqli_fetch_array($data)){
			$selected_list = $sex.",".
							$civilstatus.",".
							$city.",".
							$province.",".
							$citizenship.",".
							$position.",".
							$department.",".
							$work_history.",".
							$degree.",".
							$age.",".
							$d1.",".
							$d2.",".
							$d3.",".
							$d4.",".
							$d5.",".
							$d6.",".
							$d7.",".
							$d8.",".
							$d9.",".
							$d10.",".
							$d11.",".
							$d12;
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
		$Apriori->setMinSup($support);         //Minimum support 1, 2, 3, ...
		$Apriori->setMinConf($confidence);       //Minimum confidence - Percent 1, 2, ..., 100
		$Apriori->setDelimiter(',');
		   //Delimiter 
		$Apriori->process($dataset);
					//Frequent Itemsets
		echo '<h1>Frequent Itemsets</h1>';
		$Apriori->printFreqItemsets($option,$custom_ruleset_id,$link);

		echo '<h3>Frequent Itemsets Array</h3>';
		print_r($Apriori->getFreqItemsets()); 

		//Association Rules
		// echo '<h1>Association Rules</h1>';
		$Apriori->printAssociationRules($option,$custom_ruleset_id,$link);

		// echo '<h3>Association Rules Array</h3>';
		// print_r($Apriori->getAssociationRules()); 
		//$dataset[] = null;
		//Save to file
		// $Apriori->saveFreqItemsets('freqItemsets.txt');
		// $Apriori->saveAssociationRules('associationRules.txt');
	}else{

	}
	$su = "UPDATE retention.custom_ruleset SET custom_ruleset.status = 1";
	mysqli_query($link,$su);
	echo "<hr>";
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
