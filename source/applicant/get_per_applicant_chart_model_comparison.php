<?php
require('../config.php');
// $sql = "SELECT applicant_prediction.*,
		// applicant_profile.first_name,
		// applicant_profile.middle_name,
		// applicant_profile.last_name		
		// FROM retention.applicant_prediction 
		// LEFT JOIN retention.applicant_profile ON 
		// applicant_profile.applicant_profile_id = applicant_prediction.applicant_id
		// WHERE applicant_prediction.support = '".$_GET['support']."'
		// AND applicant_prediction.confidence = '".$_GET['confidence']."'
		// AND applicant_prediction.applicant_id IN (".$_GET['id'].")";
$sql = "SELECT applicant_prediction.*,
		applicant_profile.first_name,
		applicant_profile.middle_name,
		applicant_profile.last_name		
		FROM retention.applicant_prediction 
		LEFT JOIN retention.applicant_profile ON 
		applicant_profile.applicant_profile_id = applicant_prediction.applicant_id
		WHERE applicant_prediction.applicant_id IN (".$_GET['id'].")";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp_val = str_replace("ACTUAL WORK YEARS","YEARS",$row['prediction_value']);
		$temp[] = array("Applicant"=>$row['last_name'].",".$row['first_name'],
						"# of Years"=>(float)str_replace(" ACTUAL WORK YEARS","",$row['prediction_value']),
						"% Value"=>((1 * 100)/1));
		// $x = json_decode($row['prediction_value']);
		// foreach($x  as $key =>$value){

			// if($key == 'answer'){
				// $temp_val = str_replace("ACTUAL WORK YEARS","YEARS",$key);
				// foreach($x  as $keyx =>$valuex){
					// if($keyx == $value){

						// $temp[] = array("Applicant"=>$row['last_name'].",".$row['first_name'],
										// "# of Years"=>(float)str_replace(" ACTUAL WORK YEARS","",$value),
										// "% Value"=>(($valuex * 100)/1));		
					// }
				// }
				
			// }
		// }
	}
	//array_pop($temp);
	echo json_encode($temp);
}else{
	//echo json_encode(array("# of Years"=>0,"% Value"=>0));
}
mysqli_close($link);
?>