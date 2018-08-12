<?php   
	set_time_limit ( 0 ) ;ini_set('memory_limit', '1024M');
	$db_host = 'localhost';
	$db_user = 'root';
	$db_pass = '';
	$link=mysqli_connect($db_host,$db_user,$db_pass);
	mysqli_set_charset($link,'utf8');
	include 'NaiveBayes.php';
	$s1 = "SELECT * FROM retention.applicant_profile
			WHERE applicant_profile.status = 0
			LIMIT 1";
	$d1 = mysqli_query($link,$s1);
	if(mysqli_num_rows($d1)>0){
		$r1 = mysqli_fetch_array($d1);
		$applicant_data = array();
		array_push($applicant_data,$r1['sex']);
		array_push($applicant_data,$r1['civilstatus']);
		array_push($applicant_data,$r1['religion']);
		array_push($applicant_data,$r1['city']);
		array_push($applicant_data,$r1['province']);
		array_push($applicant_data,$r1['citizenship']);
		array_push($applicant_data,$r1['bloodtype']);
		array_push($applicant_data,'');
		array_push($applicant_data,$r1['position']);
		array_push($applicant_data,$r1['department']);
		array_push($applicant_data,$r1['work_history']);
		array_push($applicant_data,$r1['degree']);
		array_push($applicant_data,$r1['age']);
		//print_r($applicant_data);
		$s = "SELECT * FROM retention.assoc_support_confidence
			WHERE assoc_support_confidence.status = 1";
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			$r = mysqli_fetch_array($d);
				$ss = "SELECT employee_profile.* FROM retention.employee_associated
						LEFT JOIN retention.employee_profile ON
						employee_profile.id = employee_association_rules
						WHERE employee_associated.status = 1
						AND employee_associated.support = '".$r['support']."'
						AND employee_associated.confidence = '".$r['confidence']."' 
						AND employee_profile.position = '".$r1['position']."'";
				$dd = mysqli_query($link,$ss);
				if(mysqli_num_rows($dd)>0){
					$counter = 0;
					while($rr = mysqli_fetch_array($dd)){
						$data_list = array();
						array_push($data_list,$rr['sex']);
						array_push($data_list,$rr['civilstatus']);
						array_push($data_list,$rr['religion']);
						array_push($data_list,$rr['city']);
						array_push($data_list,$rr['province']);
						array_push($data_list,$rr['citizenship']);
						array_push($data_list,$rr['bloodtype']);
						array_push($data_list,$rr['total_years_work']);
						array_push($data_list,$rr['position']);
						array_push($data_list,$rr['department']);
						array_push($data_list,$rr['work_history']);
						array_push($data_list,$rr['degree']);
						array_push($data_list,$rr['age']);
						$samples[$counter] = $data_list;
						$counter++;
					}
					//print_r($samples);
					echo json_encode($samples);
					echo "<hr>";
					$counter_label = 0;
					$label_array = array();
					foreach($samples as $main_count){
						array_push($label_array,$counter_label);
						$counter_label++;
					}
					echo json_encode($label_array);
					echo "<hr>";

					$classifier = new NaiveBayes();
					$classifier->train($samples,$label_array);
				
					print_r($classifier->predict($applicant_data));
					echo "<hr>";
					echo json_encode($samples[$classifier->predict($applicant_data)][7]);
					if(VerifyApplicantPrediction($link,$r1['applicant_profile_id']) == 1){
						
					}else{
						//Save
						$s_predict =  "INSERT INTO retention.applicant_prediction 
										VALUES(null,'".$r['support']."','".$r['confidence']."','".$r1['applicant_profile_id']."','".$samples[$classifier->predict($applicant_data)][7]."')";
						 mysqli_query($link,$s_predict);
						//Update Applicant Done
						$s_app_end = "UPDATE retention.applicant_profile SET applicant_profile.status = 1 
							WHERE applicant_profile.applicant_profile_id = '".$r1['applicant_profile_id']."'";
						mysqli_query($link,$s_app_end);
					}
				}else{
					
				}
			
		}else{
			
		}
	}else{
		
	}
	
	mysqli_close($link);
	
	
	function VerifyApplicantPrediction($link,$applicant_id){
		$s = "SELECT * FROM retention.applicant_prediction WHERE applicant_prediction.applicant_id = '".$applicant_id."'";
		$d = mysqli_query($link,$s);
		if(mysqli_num_rows($d)>0){
			return 1;
		}else{
			return 0;
		}
	}
	// $samples = [['male','panabo','O'], ['female','tagum','A'], ['male','tagum','A']];
	// $labels = [1, 2, 3];

	// $classifier = new NaiveBayes();
	// $classifier->train($samples, $labels);

	// print_r($classifier->predict(['female','panabo','A']));
	// return 'a'
	//var_dump($classifier->predict(['female','panabo','A'],['male','panabo','0']));
	//print_r($classifier->predict([[3, 1, 1],[1, 4, 1]));
?>