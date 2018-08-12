<?php
	require('../../config.php');
	require_once('Make_Decision_Tree.php');
	function GetTrainingData($support,$confidence,$position,$link){
	$sql = "SELECT * FROM retention.employee_associated
			LEFT JOIN retention.employee_profile ON
			employee_profile.id = employee_associated.employee_association_rules
			WHERE employee_associated.support = '".$_GET['support']."'
			AND employee_associated.confidence = '".$_GET['confidence']."'
			AND employee_profile.position = '".$_GET['position']."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			$temp =  array();
			while($row = mysqli_fetch_array($data)){
				
				$temp[] = array("sex"=>$row['sex'],
								"civilstatus"=>$row['civilstatus'],
								"religion"=>$row['religion'],
								"total_years_work"=>$row['total_years_work'],
								"work_history"=>$row['work_history'],
								"degree"=>$row['degree']);
			}
			return $temp;
		}else{
			
		}
	}
	
	function GetClassifierData($support,$confidence,$position,$link){
	$sql = "SELECT * FROM retention.employee_associated
			LEFT JOIN retention.employee_profile ON
			employee_profile.id = employee_associated.employee_association_rules
			WHERE employee_associated.support = '".$_GET['support']."'
			AND employee_associated.confidence = '".$_GET['confidence']."'
			AND employee_profile.position = '".$_GET['position']."'";
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
			$temp = "";
			while($row = mysqli_fetch_array($data)){
				if($temp == ''){
					$temp = "'total_years_work','".$row['total_years_work']."'";
				}else{
					$temp = $temp.",'".$row['total_years_work']."'";
				}
			}
			$pos_tag_holder = explode(",",$temp);
			//print_r($holder);
			$unique_pos_tag = array_values(array_unique($pos_tag_holder));
			//print_r($unique_pos_tag);
			return implode(",",$unique_pos_tag);
		}else{

		}
	}
	// 渡すデータ構造
	// $data = array();
	// $data[0]   = array("SEX"=>"MALE","AGE"=>"35","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"1 WORKING YEARS");
	// $data[1]   = array("SEX"=>"MALE","AGE"=>"12","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"1 WORKING YEARS");
	// $data[2]   = array("SEX"=>"MALE","AGE"=>"35","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"1 WORKING YEARS");
	// $data[3]   = array("SEX"=>"FEMALE","AGE"=>"26","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"1 WORKING YEARS");
	// $data[4]   = array("SEX"=>"MALE","AGE"=>"23","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"1 WORKING YEARS");
	// $data[5]   = array("SEX"=>"FEMALE","AGE"=>"31","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"2 WORKING YEARS");
	// $data[6]   = array("SEX"=>"MALE","AGE"=>"32","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"2 WORKING YEARS");
	// $data[7]   = array("SEX"=>"MALE","AGE"=>"23","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"2 WORKING YEARS");
	// $data[8]   = array("SEX"=>"FEMALE","AGE"=>"25","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"2 WORKING YEARS");
	// $data[9]   = array("SEX"=>"FEMALE","AGE"=>"29","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"2 WORKING YEARS");
	// $data[10]  = array("SEX"=>"MALE","AGE"=>"40","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"2 WORKING YEARS");
	// $data[11]  = array("SEX"=>"MALE","AGE"=>"12","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"2 WORKING YEARS");
	// $data[12]  = array("SEX"=>"MALE","AGE"=>"35","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"2 WORKING YEARS");
	// $data[13]  = array("SEX"=>"FEMALE","AGE"=>"34","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"3 WORKING YEARS");
	// $data[14]  = array("SEX"=>"MALE","AGE"=>"23","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"3 WORKING YEARS");
	// $data[15]  = array("SEX"=>"FEMALE","AGE"=>"31","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"3 WORKING YEARS");
	// $data[16]  = array("SEX"=>"FEMALE","AGE"=>"32","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"3 WORKING YEARS");
	// $data[17]  = array("SEX"=>"FEMALE","AGE"=>"23","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"4 WORKING YEARS");
	// $data[18]  = array("SEX"=>"FEMALE","AGE"=>"25","CITIZENSHIP"=>"FILIPINO","WORKING YEARS"=>"4 WORKING YEARS");
	// $data[19]  = array("SEX"=>"FEMALE","AGE"=>"29","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"4 WORKING YEARS");
	// $data[20]  = array("SEX"=>"MALE","AGE"=>"40","CITIZENSHIP"=>"AMERICAN","WORKING YEARS"=>"4 WORKING YEARS");
	// print_r($data);
	
	//print_r(GetTrainingData($link));
	// データの引き渡し
	//print_r(GetTrainingData($_GET['support'],$_GET['confidence'],$_GET['position'],$link));
	$dt = new Decision_Tree(GetTrainingData($_GET['support'],$_GET['confidence'],$_GET['position'],$link));


	//木の生成(分類木)
	//echo ;
	$tree = $dt->classify('total_years_work','0 WORKING YEARS','4 WORKING YEARS');
	//print_r(GetClassifierData($_GET['support'],$_GET['confidence'],$_GET['position'],$link));
	//$tree = $dt->classify(GetClassifierData($_GET['support'],$_GET['confidence'],$_GET['position'],$link));
	echo "-------- Decision_Tree\n"; 
	//var_dump($tree);
	
	function GetApplicantData($applicant_id,$link){
		$sql = "SELECT * FROM retention.applicant_profile WHERE applicant_profile.applicant_profile_id = '".$applicant_id."'";
		//echo $sql;
		$data = mysqli_query($link,$sql);
		if(mysqli_num_rows($data)>0){
				
			while($row = mysqli_fetch_array($data)){	
				$temp = array("sex"=>$row['sex'],
								"civilstatus"=>$row['civilstatus'],
								"religion"=>$row['religion'],
								"city"=>$row['city'],
								//"total_years_work"=>$row['total_years_work'],
								"work_history"=>$row['work_history'],
								"degree"=>$row['degree']);
			}
			return $temp;
		}else{
			
		}	
	}
	//ルールの使用方法
	// $target = array("sex"=>"FEMALE",
					// "civilstatus"=>"SINGLE",
					// "religion"=>"BAPTIST",
					// "city"=>"TAGUM CITY",
					// "province"=>"DAVAO DEL NORTE",
					// "citizenship"=>"FILIPINO",
					// "bloodtype"=>"A",
					// "position"=>"PHP PROGRAMMER",
					// "department"=>"INFORMATION AND TECHNOLOGY DEPARTMENT - COMPUTER AND COMMUNICATION SERVICES",
					// "work_history"=>"2 WORK HISTORY YEARS",
					// "degree"=>"COLLEGE");
	//print_r($target);
	//echo "<hr>";
	$target1 = GetApplicantData($_GET['applicant_id'],$link);
	//print_r($target1);
	$res = $dt->prognosis($target1);
	$res = $dt->exe_prognosis($tree,$target1);

	echo "-------- estimate\n"; 
	var_dump($res);
	mysqli_close($link);
?>

