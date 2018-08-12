<?php
require('../config.php');
$sql = "SELECT * FROM retention.applicant_prediction
		WHERE applicant_prediction.support = '".$_GET['support']."'
		AND applicant_prediction.confidence = '".$_GET['confidence']."'
		AND applicant_prediction.applicant_id = '".$_GET['applicant']."'";
$data = mysqli_query($link,$sql);
if(mysqli_num_rows($data)>0){
	while($row = mysqli_fetch_array($data)){
		$temp_val = str_replace("ACTUAL WORK YEARS","YEARS",$row['prediction_value']);
		$temp[] = array("# of Years"=>$temp_val,
						"% Value"=>1);
		// $x = json_decode($row['prediction_value']);
		// foreach($x  as $key =>$value){
			//$echo $key."-->".$value."<hr>";
			// $temp_val = str_replace("ACTUAL WORK YEARS","YEARS",$key);
			// $temp[] = array("# of Years"=>$temp_val,
							// "% Value"=>$value);
		// }
	}
	//array_pop($temp);
	echo json_encode($temp);
}else{
	echo json_encode(array("# of Years"=>0,"% Value"=>0));
}
mysqli_close($link);
?>